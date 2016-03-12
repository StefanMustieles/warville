<?php

require "page.inc";

$homepage = new Page();

$homepage->metadescription = '';

$postContent = '<section id="about-us">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 center">
                                <h2>Search Results</h2>';

// Gets value sent over search form
if (isset($_GET['query'])) $query = $_GET['query']; 

// Minimum length of the query if you want
$min_length = 3;

// If query length is more or equal minimum length then
if(strlen($query) >= $min_length){ 
         
    $query = htmlspecialchars($query); 
    // changes characters used in html to their equivalents, for example: < to &gt;

    require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';
    
    $db = new Zebra_Database();

    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

    $db->query('SELECT t1.item_id, t1.name, t2.name AS sub_category, LOWER(t3.name) AS category, LOWER(t4.name) AS country, CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(t1.folder_name, "/"), t2.folder_name), "/"), t4.item_id), "/"), t4.friendly_url) AS linkTo, t1.title, t1.thumbnail_image, t1.short_text, CONCAT(CONCAT(CONCAT(CONCAT(t4.folder_name, "/"), t3.folder_name), "/img/"), t1.thumbnail_image) AS image_link '
            . 'FROM items AS t1 INNER JOIN sub_categories AS t2 ON t1.sub_category_id = t2.sub_category_id INNER JOIN categories AS t3 ON t2.category_id = t3.category_id INNER JOIN countries AS t4 ON t3.country_id = t4.country_id '
            . 'WHERE t1.name LIKE ? OR t1.title LIKE ?', array('%' . $query . '%', '%' . $query . '%')
    );

    $postContent .= '<h4>' . $db->found_rows . ' result(s) found for ' . $query . '</h4>';
	
    $i = 1;

    while ($row = $db->fetch_assoc()) {

        $postContent .= '<div class="col-sm-4 col-lg-4 col-md-4 item">
                            <a href="' . $row["linkTo"] . '">    
                                <div class="thumbnail">';

        if(empty($row["thumbnail_image"]))
            $postContent .= '<img src="/assets/images/awaitingImage.jpg" alt="' . $row["title"] . '" class="thumbnail-pics">';
        else
            $postContent .= '<img src="' . $row["image_link"] . '" alt="' . $row["title"] . '" class="thumbnail-pics">';

        $postContent .='<div class="caption">
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
}
else { 
    $postContent .= "<h4>Please search again. Minimum search length is " . $min_length . ' characters.</h4>';
}

$postContent .= '</div><!--/.col-md-12-->
                </div><!--/.row-->
            </div><!--/.container-->
        </section><!--/about-us-->';

$homepage->content = $postContent;

$homepage->title = 'Search Results - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->Display();