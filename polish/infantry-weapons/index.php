<?php

require $_SERVER['DOCUMENT_ROOT'] . '/page.inc';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';

$homepage = new Page();

$homepage->contentpagescripts = '<script src="/assets/js/listedItems.js" type="text/javascript"></script>';

$db = new Zebra_Database();

$db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

$db->query('SELECT t1.description, t2.name AS country, t1.name, t1.meta_description '
        . 'FROM categories AS t1 INNER JOIN countries AS t2 ON t1.country_id = t2.country_id '
        . 'WHERE t2.country_id = ? AND t1.category_id = ?', array(20, 67)
);
												
while ($row = $db->fetch_assoc()) {

$descriptionText = $row["description"];							
$country = $row["country"];
$category = $row["name"];
$metaDescription = $row["meta_description"];
}

$homepage->metadescription = $metaDescription;

$title = $country . ' ' . $category;

$postContent = sprintf('<div id="loading"></div>
                        <section id="content">
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
                                    <h1 id="contentHeader">%s</h1>
                                </div><!--/.row-->
                            </div><!--/.container-->
                            <div class="container">
                                <div class="row">
                                    <p id="description">%s</p>
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
    'sub_category_id, name, seo_url',
    'sub_categories',
    'category_id = ?', array(67), 'sort_order'
);
												
while ($row = $db->fetch_assoc()) {

$postContent .=	 '<a id="' . $row["sub_category_id"] . '" href="' . $row["seo_url"] . '" class="list-group-item">' . $row["name"] . '</a>';								
                                                        
}
														
$postContent .= '</div>
		</div>

		<div class="col-md-9 itemHolder">
                    <div class="row">';
						
$db->query(
    'SELECT t1.sub_category_id, t1.item_id, t1.title, t1.friendly_url, t1.thumbnail_image, t1.short_text FROM `items` AS t1 '
      . 'INNER JOIN sub_categories AS t2 ON t1.sub_category_id = t2.sub_category_id '
        . 'WHERE t2.category_id = ?', array(67)
);

$i = 1;

while ($row = $db->fetch_assoc()) {

    $postContent .= '<div class="col-sm-4 col-lg-4 col-md-4 item" data-id="id-' . $row["item_id"] . '" data-type="' . $row["sub_category_id"] . '">
                        <a href="' . $row["item_id"] . '/' . $row["friendly_url"] . '">    
                            <div class="thumbnail">
                                <img src="img/' . $row["thumbnail_image"] . '" alt="' . $row["title"] . '" class="thumbnail-pics">
                                <div class="caption">
                                    <h4>' . $row["title"] . '</h4>
                                    <p>' . $row["short_text"] . '</p>
                                </div>
                            </div>
                        </a>
                    </div>';
    
    if($i % 3 == 0){
       $postContent .= '<div class="clearfix visible-xs-block"></div>';
    }
    $i++;
}
						
$postContent .= '</div><!--/.row-->
        </div><!--/.col-md-9-->
    </div><!--/.container-->
</section><!--/#content-->';

$homepage->title = $title . ' - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />'; 

$homepage->content = $postContent;
	
$homepage->Display();