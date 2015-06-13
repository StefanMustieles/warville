<?php

require $_SERVER['DOCUMENT_ROOT'] . '/page.inc';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';

$homepage = new Page();

$homepage->contentpagescripts = '<script src="/assets/js/jquery.easing.js"></script>
                    <script src="/assets/js/jquery.quicksand.js"></script>
                    <script>
                    $(document).ready(function() {
                      // get the action filter option item on page load
                      var $filterType = $("#list-group a.active").attr("class");

                      // get and assign the ourHolder element to the
                      // $holder varible for use later
                      var $holder = $("div.col-md-9");

                      // clone all items within the pre-assigned $holder element
                      var $data = $holder.clone();

                      // attempt to call Quicksand when a filter option
                      // item is clicked
                      $(".list-group-item").click(function(e) {
                        // reset the active class on all the buttons
                        $(".list-group-item").removeClass("active");

                        // assign the class of the clicked filter option
                        // element to our $filterType variable
                        var $filterType = $(this).attr("id");
                        $(this).addClass("active");
                        if ($filterType == "All") {
                          // assign all li items to the $filteredData var when
                          // the All filter option is clicked
                          var $filteredData = $data.find("div");
                        }
                        else {
                          // find all li elements that have our required $filterType
                          // values for the data-type element
                          var $filteredData = $data.find("div[data-type=" + $filterType + "]");
                        }

                        // call quicksand and assign transition parameters
                        $holder.quicksand($filteredData, {
                          duration: 500,
                          easing: "easeInOutQuad"
                        });
                        return false;
                      });
                    });
                    </script>';

$db = new Zebra_Database();

$db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

$db->query('SELECT t1.description, t2.name AS country, t1.name '
        . 'FROM categories AS t1 INNER JOIN countries AS t2 ON t1.country_id = t2.country_id '
        . 'WHERE t2.country_id = ? AND t1.category_id = ?', array(3, 11)
);
												
while ($row = $db->fetch_assoc()) {

$descriptionText = $row["description"];							
$country = $row["country"];
$category = $row["name"];
}

$title = $country . ' ' . $category;

$postContent = sprintf('<section id="content">
                            <div class="container">
                                <div class="row">
                                    <ul class="breadcrumb">
                                        <li><a href="../../">Home</a></li>
                                        <li><a href="../">%s</a></li>
                                        <li class="active">%s</li>
                                    </ul>
                                 </div><!--/.row-->
                            </div><!--/.container-->
                            <div class="container">
                                <div class="row">
                                    <h1>%s</h1>
                                </div><!--/.row-->
                            </div><!--/.container-->
                            <div class="container">
                                <div class="row">
                                    <p>%s</p>
                                </div><!--/.row-->
                            </div><!--/.container-->
                    </section><!--/#content-->

				<section id="content">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p class="lead">Filters</p>
                                                    <div class="list-group">
                                                        <a id="All" class="list-group-item active">All</a>', $country, $category, $title, $descriptionText);

$db->select(
    'sub_category_id, name',
    'sub_categories',
    'category_id = ?', array(11), 'sort_order'
);
												
while ($row = $db->fetch_assoc()) {

$postContent .=	 '<a id="' . $row["sub_category_id"] . '" class="list-group-item">' . $row["name"] . '</a>';								
                                                        
}
														
$postContent .= '</div>
		</div>

		<div class="col-md-9 itemHolder">
                    <div class="row">';
						
$db->query(
    'SELECT t1.sub_category_id, t1.item_id, t1.title, t1.friendly_url, t1.thumbnail_image, t1.short_text FROM `items` AS t1 '
      . 'INNER JOIN sub_categories AS t2 ON t1.sub_category_id = t2.sub_category_id '
        . 'WHERE t2.category_id = ?', array(11)
);

$i = 1;

while ($row = $db->fetch_assoc()) {

    $postContent .= '<div class="col-sm-4 col-lg-4 col-md-4 item" data-id="id-' . $row["item_id"] . '" data-type="' . $row["sub_category_id"] . '">
                        <div class="thumbnail">
                            <img src="img/' . $row["thumbnail_image"] . '" alt="' . $row["title"] . '" class="thumbnail-pics">
                            <div class="caption">
                                <h4><a href="' . $row["item_id"] . '/' . $row["friendly_url"] . '">' . $row["title"] . '</a>
                                </h4>
                                <p>' . $row["short_text"] . '</p>
                            </div>
                        </div>
                    </div>';
    
    if($i % 3 == 0){
       $postContent .= '</div><!--/.row--><div class="row">';
    }
    $i++;
    
}
						
$postContent .= '</div><!--/.col-md-9-->
        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#content-->';

$homepage->title = $homepage->title . ' - ' . $title; 

$homepage->content = $postContent;
	
$homepage->Display();