<?php

require $_SERVER['DOCUMENT_ROOT'] . '/page.inc';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';

$homepage = new Page();

$db = new Zebra_Database();

$db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

$db->select('name, description, meta_description, page_title',
    'countries',
    'country_id = ?', array(22));

while ($row = $db->fetch_assoc()) {
    $name = $row['name'];
    $description = $row['description'];
    $meta_description = $row['meta_description'];
    $page_title = $row['page_title'];
}

$homepage->metadescription = $meta_description;

$postContent = sprintf('<section id="content">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="breadcrumb">
                                        <li><a href="../">Home</a></li>
                                        <li class="active">%s</li>
                                    </ul>
                                    <h1>%s Army</h1>
                                    <p>%s</p>
                                </div><!--/.col-md-12-->
                            </div><!--/.row-->

                            <div class="row">
                                <div class="col-md-12">', $name, $name, $description);

$db->query('SELECT CONCAT(t2.name, " ", t1.name) AS name, t1.folder_name, t1.short_description
            FROM categories AS t1 INNER JOIN countries AS t2 ON t1.country_id = t2.country_id
            WHERE t1.country_id = ?', array(22));

$i=1;

while ($row = $db->fetch_assoc()) {

$postContent .= '<a href="' . $row["folder_name"] . '/">
    <div class="col-md-6">
        <h2>' . $row["name"] . '</h2>
        <img src="img/' . $row["name"] . '.jpg" class="img-responsive countryBoxes" alt="' . $row["name"] . '">
    </div></a>';

    if($i % 2 == 0){
       $postContent .= '<div class="clearfix visible-xs-block"></div><hr />';
    }
    $i++;
}

$postContent .= '</div><!--/.col-md-12-->
                </div><!--/.row-->
            </div><!--/#container-->
        </section><!--/#content-->';

if(empty($page_title)) $homepage->title = $name . ' Army - ' . $homepage->title;
else $homepage->title = $page_title;

$homepage->canonical = '<link rel="canonical" href="https://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->content = $postContent;

$homepage->Display();