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
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a turpis ac ex ornare consequat ac ac ligula. Phasellus sapien metus, 
                                        luctus et efficitur vel, pretium sit amet nisi. Nullam sed varius nibh. Nunc vehicula neque sit amet urna dapibus tincidunt. 
                                        Maecenas a fringilla urna. Quisque scelerisque purus nec blandit finibus. Duis in risus vel diam mollis euismod nec nec est.
                                        Cras at accumsan ante, nec viverra tellus. Phasellus eget malesuada mi. Vivamus eu bibendum augue, quis tempus metus. Ut malesuada 
                                        enim a vehicula tempor. Aenean ac libero purus. Nulla interdum enim non erat condimentum imperdiet. Aenean mattis imperdiet leo ac 
                                        finibus. Duis quis mi a est fringilla suscipit non id elit. Morbi purus ante, varius id ante in, fringilla semper est. Morbi eu feugiat 
                                        tellus, eget elementum tellus. Nullam iaculis risus vel nibh bibendum tempus. Maecenas cursus lacinia nibh id congue.
                                    </p>
                                </div>
                            </div><!--/.row-->
                        </div><!--/.container-->
                </section><!--/#content-->

                <section id="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a turpis ac ex ornare consequat ac ac ligula. Phasellus sapien metus, 
                                    luctus et efficitur vel, pretium sit amet nisi. Nullam sed varius nibh. Nunc vehicula neque sit amet urna dapibus tincidunt. 
                                    Maecenas a fringilla urna. Quisque scelerisque purus nec blandit finibus. Duis in risus vel diam mollis euismod nec nec est.
                                    Cras at accumsan ante, nec viverra tellus. Phasellus eget malesuada mi. Vivamus eu bibendum augue, quis tempus metus. Ut malesuada 
                                    enim a vehicula tempor. Aenean ac libero purus. Nulla interdum enim non erat condimentum imperdiet. Aenean mattis imperdiet leo ac 
                                    finibus. Duis quis mi a est fringilla suscipit non id elit. Morbi purus ante, varius id ante in, fringilla semper est. Morbi eu feugiat 
                                    tellus, eget elementum tellus. Nullam iaculis risus vel nibh bibendum tempus. Maecenas cursus lacinia nibh id congue.
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">';

$db = new Zebra_Database();

$db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

$db->query('SELECT CONCAT(CONCAT(CONCAT(CONCAT(t1.folder_name, "/"), t2.folder_name), "/img/"), t4.large_image) AS folder 
FROM countries AS t1 
INNER JOIN categories AS t2 ON t1.country_id = t2.country_id
INNER JOIN sub_categories AS t3 ON t2.category_id = t3.category_id 
INNER JOIN items AS t4 ON t3.sub_category_id = t4.sub_category_id
WHERE t4.large_image IS NOT NULL AND TRIM(t4.large_image) <> ""
ORDER BY RAND() LIMIT 3');

$i = 0;

while ($row = $db->fetch_assoc()) {
    $activate = $i == 0 ? ' active' : ''; 
    
    $postContent .= '<div class="item carouselImg' . $activate  . '">
                        <img class="carouselImg" src="' . $row['folder'] . '">
                     </div>';
    $i++;
}

$postContent .= '</div>
                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
              </div> <!-- Carousel -->
        </div>
    </div><!--/.row-->
</div><!--/.container-->
</section><!--/#content-->

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Most Viewed</h3>';
                
$db->query('SELECT t4.item_id, t4.title, t4.friendly_url, t4.thumbnail_image, CONCAT(CONCAT(CONCAT(CONCAT(t1.folder_name, "/"), t2.folder_name), "/img/"), t4.large_image) AS folder
            FROM countries AS t1 
            INNER JOIN categories AS t2 ON t1.country_id = t2.country_id
            INNER JOIN sub_categories AS t3 ON t2.category_id = t3.category_id 
            INNER JOIN items AS t4 ON t3.sub_category_id = t4.sub_category_id ORDER BY t4.views DESC LIMIT 4');

$i = 0;

while ($row = $db->fetch_assoc()) {
    $postContent .= '<div class="col-sm-3 col-lg-3 col-md-3 item">
                        <a href="' . $row["item_id"] . '/' . $row["friendly_url"] . '">    
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