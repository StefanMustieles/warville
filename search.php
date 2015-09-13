<?php

require "page.inc";

$homepage = new Page();

$homepage->metadescription = '';

$postContent = '<section id="about-us">
                    <div class="container">
                        <div class="center">
                            <h2>Search Results</h2>
                            <p class="lead text-left">';

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

    $db->query('SELECT t1.item_id, t1.name, t2.name AS sub_category, LOWER(t3.name) AS category, LOWER(t4.name) AS country, t1.friendly_url, t1.title, t1.thumbnail_image '
            . 'FROM items AS t1 INNER JOIN sub_categories AS t2 ON t1.sub_category_id = t2.sub_category_id INNER JOIN categories AS t3 ON t2.category_id = t3.category_id INNER JOIN countries AS t4 ON t3.country_id = t4.country_id '
            . 'WHERE t1.name LIKE ? OR t1.title LIKE ?', array('%' . $query . '%', '%' . $query . '%')
    );

	$postContent .= '<h4>' . $db->found_rows . ' result(s) found</h4>
						<div class="table-responsive">
						  <table class="table">';
	
    while ($row = $db->fetch_assoc()) {
		$href = '/' . $row["country"] . '/' . $row["category"] . '/' . $row["item_id"] . '/' . $row["friendly_url"];
        $postContent .= '<tr><td><a href="' . $href . '" class="thumbnail"><img src="' . $row["country"] . '/' . $row["category"] . '/img/' . $row["thumbnail_image"] . '" alt="'. $row["title"] .'"></a></td><td><a href="' . $href . '">' . $row["name"] . '</a></td></tr>';
    }
	
	$postContent .= '</table>
					</div>';
}
else { 
    $postContent .= "<h4>Please search again. Minimum search length is " . $min_length . ' characters.</h4>';
}

$postContent .= '</p>
                </div>
            </div><!--/.container-->
        </section><!--/about-us-->';

$homepage->content = $postContent;

$homepage->title = 'Search Results - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->Display();