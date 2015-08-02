<?php

require "page.inc";

$homepage = new Page();

$homepage->metadescription = '';

$postContent = '<section id="about-us">
                    <div class="container">
                        <div class="center">
                            <h2>Search Results</h2>
                            <p class="lead">';

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

    $db->query('SELECT name '
            . 'FROM items '
            . 'WHERE name LIKE ? OR title LIKE ?', array('%' . $query . '%', '%' . $query . '%')
    );

    while ($row = $db->fetch_assoc()) {
        
    }

    $postContent .= '<h4>' . $db->found_rows . ' result(s) found</h4>';
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