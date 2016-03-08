<?php

require "page.inc";
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';

$homepage = new Page();

$homepage->metadescription = '';

$postContent = '<div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>Welcome to the Quartermaster Section</h1>
                                </div>
                            </div><!--/.row-->
                        </div><!--/.container-->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        The Quartermaster Section is a base for information regarding weapons and vehicles from the period 
                                        1920-1950. This was the time when nations were re-arming and developing new military technology and 
                                        many of these modern weapons shared the battlefield with weapons that were developed at the turn of 
                                        the century.
                                    </p>
                                    <p>    
                                        This was a fascinating era for military enthusiasts and saw the development and structures of various 
                                        TO&Es, which was different from nation to nation. What was startling was the way support weapons became 
                                        light enough to be carried into battle by infantry men and anti-tank assets became more lethal with 
                                        introduction of the hollow charge round.
                                    </p>
                                </div>
                            </div><!--/.row-->
                        </div><!--/.container-->
                </section><!--/#content-->

                <section id="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                            
                            </div><!--/.col-md-12-->
                        </div><!--/.row-->
                    </div><!--/.container-->
                </section><!--/#content-->

                <section id="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    Vehicles which were initially used to plough through mud at the same pace as an infantry men, soon 
                                    became faster and more manoeuvrable and therefore left the infantry behind, which called of the 
                                    motorisation of infantry units. Artillery too was transformed by motorisation and the invention of 
                                    the self-propelled gun. We also see the emergence of a vast range of fast firing anti-aircraft guns.
                                </p>
                                <p>
                                    So I hope you can find what you are looking for and my goal is to expand the site and even further 
                                    as time goes on, especially as more data becomes available, because I regard this site as an ongoing 
                                    process, so it is still very much "work in progress".
                                </p>
                            </div>
                        </div><!--/.row-->
                    </div><!--/.container-->
                </section><!--/#content-->

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Most Viewed</h3>';
                
$db = new Zebra_Database();

$db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

$db->query('SELECT t4.title, CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(t1.folder_name, "/"), t2.folder_name), "/"), t4.item_id), "/"), t4.friendly_url) AS linkTo, t4.thumbnail_image, CONCAT(CONCAT(CONCAT(CONCAT(t1.folder_name, "/"), t2.folder_name), "/img/"), t4.large_image) AS folder
            FROM countries AS t1 
            INNER JOIN categories AS t2 ON t1.country_id = t2.country_id
            INNER JOIN sub_categories AS t3 ON t2.category_id = t3.category_id 
            INNER JOIN items AS t4 ON t3.sub_category_id = t4.sub_category_id ORDER BY t4.views DESC LIMIT 4');

$i = 0;

while ($row = $db->fetch_assoc()) {
    $postContent .= '<div class="col-sm-3 col-lg-3 col-md-3 item">
                        <a href="' . $row["linkTo"] . '">    
                            <div class="thumbnail">';

    if(empty($row["thumbnail_image"]))
        $postContent .= '<img src="/assets/images/awaitingImage.jpg" alt="' . $row["title"] . '" class="thumbnail-pics">';
    else
        $postContent .= '<img src="' . $row["folder"] . '" alt="' . $row["title"] . '" class="thumbnail-pics">';
    
    $postContent .='<div class="caption">
                        <h4>' . $row["title"] . '</h4>
                    </div>
                </div>
            </a>
        </div>';
    
    $i++;
}

$postContent .='</div>
        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#content-->';

$homepage->content = $postContent;
 
$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->Display();