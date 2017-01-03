<?php

require "page.inc";
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';

$homepage = new Page();

$homepage->contentpagescripts = '<script type="text/javascript">
                                $("#myCarousel").carousel({
                                    interval: 4000
                                });

                                // handles the carousel thumbnails
                                $("[id^=carousel-selector-]").click( function(){
                                  var id_selector = $(this).attr("id");
                                  var id = id_selector.substr(id_selector.length -1);
                                  id = parseInt(id);
                                  $("#myCarousel").carousel(id);
                                  $("[id^=carousel-selector-]").removeClass("selected");
                                  $(this).addClass("selected");
                                });

                                // when the carousel slides, auto update
                                $("#myCarousel").on("slid", function (e) {
                                  var id = $(".item.active").data("slide-number");
                                  id = parseInt(id);
                                  $("[id^=carousel-selector-]").removeClass("selected");
                                  $("[id=carousel-selector-"+id+"]").addClass("selected");
                                });
                                </script>';

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

                <!-- main slider carousel -->
                <div class="row">
                    <div class="col-md-12" id="slider">
                    <div class="col-md-12" id="carousel-bounding-box">
                        <div id="myCarousel" class="carousel slide">
                            <!-- main slider carousel items -->
                            <div class="carousel-inner">
                                <div class="active item center" data-slide-number="0">
                                    <div class="col-md-4">
                                        <a href="/american/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-us larger"></div>
                                            <div class="caption">
                                                <h3>American Army</h3>
                                                <p><i>"This we\'ll defend"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/belgian/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-be larger"></div>
                                            <div class="caption">
                                                <h3>Belgian Army</h3>
                                                <p><i>"Armée Belge"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/british/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-gb larger"></div>
                                            <div class="caption">
                                                <h3>British Army</h3>
                                                <p><i>"Royal British Army"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="item center" data-slide-number="1">
                                    <div class="col-md-4">
                                        <a href="/bulgarian/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-bg larger"></div>
                                            <div class="caption">
                                                <h3>Bulgarian Army</h3>
                                                <p><i>"Роял Българска армия"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/czechoslovakian/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-cz larger"></div>
                                            <div class="caption">
                                                <h3>Czechoslovakian Army</h3>
                                                <p><i>"Československá armada"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/danish/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-dk larger"></div>
                                            <div class="caption">
                                                <h3>Danish Army</h3>
                                                <p><i>"Hæren"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="item center" data-slide-number="2">
                                    <div class="col-md-4">
                                        <a href="/dutch/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-nl larger"></div>
                                            <div class="caption">
                                                <h3>Dutch Army</h3>
                                                <p><i>"Koninklijke Landmacht"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/dutch-east-indies/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-an larger"></div>
                                            <div class="caption">
                                                <h3>Dutch East Indies Army</h3>
                                                <p><i>"Koninklijk Nederlands Indisch Leger"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/estonian/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-ee larger"></div>
                                            <div class="caption">
                                                <h3>Estonian Army</h3>
                                                <p><i>"Maavägi"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="item center" data-slide-number="3">
                                    <div class="col-md-4">
                                        <a href="/finnish/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-fi larger"></div>
                                            <div class="caption">
                                                <h3>Finnish Army</h3>
                                                <p><i>"Maavoimat"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/french/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-fr larger"></div>
                                            <div class="caption">
                                                <h3>French Army</h3>
                                                <p><i>"Armée de Terre"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/german/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-de larger"></div>
                                            <div class="caption">
                                                <h3>German Army</h3>
                                                <p><i>"Heer"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="item center" data-slide-number="4">
                                    <div class="col-md-4">
                                        <a href="/greek/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-gr larger"></div>
                                            <div class="caption">
                                                <h3>Greek Army</h3>
                                                <p><i>"Maavoimat"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/hungarian/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-hu larger"></div>
                                            <div class="caption">
                                                <h3>Hungarian Army</h3>
                                                <p><i>"Magyar Királyi Honvédség"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/italian/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-it larger"></div>
                                            <div class="caption">
                                                <h3>Italian Army</h3>
                                                <p><i>"Esercito Italiano"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="item center" data-slide-number="5">
                                    <div class="col-md-4">
                                        <a href="/japanese/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-jp larger"></div>
                                            <div class="caption">
                                                <h3>Japanese Army</h3>
                                                <p><i>"Dai-Nippon Teikoku Rikugun"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/latvian/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-lv larger"></div>
                                            <div class="caption">
                                                <h3>Latvian Army</h3>
                                                <p><i>"Nacionālie Bruņotie Spēki"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/lithuanian/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-lt larger"></div>
                                            <div class="caption">
                                                <h3>Lithuanian Army</h3>
                                                <p><i>"Lietuvos Respublikos kariuomenės"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="item center" data-slide-number="6">
                                    <div class="col-md-4">
                                        <a href="/norwegian/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-no larger"></div>
                                            <div class="caption">
                                                <h3>Norwegian Army</h3>
                                                <p><i>"Forsvaret"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/polish/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-pl larger"></div>
                                            <div class="caption">
                                                <h3>Polish Army</h3>
                                                <p><i>"Wojsko Polskie"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/romanian/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-ro larger"></div>
                                            <div class="caption">
                                                <h3>Romanian Army</h3>
                                                <p><i>"Armata Regală Română"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="item center" data-slide-number="7">
                                    <div class="col-md-4">
                                        <a href="/russian/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-ru larger"></div>
                                            <div class="caption">
                                                <h3>Russian Army</h3>
                                                <p><i>Советская Армия, Sovetskaya Armiya</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/swedish/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-se larger"></div>
                                            <div class="caption">
                                                <h3>Swedish Army</h3>
                                                <p><i>"Armén"</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/yugoslavian/">
                                        <div class="thumbnail">
                                            <div class="flag flag-icon-background flag-icon-yg larger"></div>
                                            <div class="caption">
                                                <h3>Yugoslavian Army</h3>
                                                <p><i>Jugoslavenska vojska</i></p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- main slider carousel nav controls -->
                                <div class="col-md-4 col-xs-4 text-right"><a class="glyphicon glyphicon-chevron-left" href="#myCarousel" data-slide="prev"></a></div>
                                <div class="col-md-4 col-xs-4 center carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <li data-target="#myCarousel" data-slide-to="2"></li>
                                    <li data-target="#myCarousel" data-slide-to="3"></li>
                                    <li data-target="#myCarousel" data-slide-to="4"></li>
                                    <li data-target="#myCarousel" data-slide-to="5"></li>
                                    <li data-target="#myCarousel" data-slide-to="6"></li>
                                    <li data-target="#myCarousel" data-slide-to="7"></li>
                                </div>
                                <div class="col-md-4 col-xs-4 text-left"><a class="glyphicon glyphicon-chevron-right" href="#myCarousel" data-slide="next"></a></div>
                            </div>
                        </div>
                        </div>
                    <!--/main slider carousel-->
                    </div><!--/.col-md-12-->
                </div><!--/.row-->

                <div class="row">
                    <div class="col-md-12">
                        <p>
                            Vehicles which were initially used to plough through mud at the same pace as infantry men, soon 
                            became faster and more manoeuvrable and therefore left the infantry behind, which called for the 
                            motorisation of infantry units. Artillery too was transformed by motorisation and the invention of 
                            the self-propelled gun. We also see the emergence of a vast range of fast firing anti-aircraft guns.
                        </p>
                        <p>
                            So I hope you can find what you are looking for and my goal is to expand the site and even further 
                            as time goes on, especially as more data becomes available, because I regard this site as an ongoing 
                            process, so it is still very much "work in progress".
                        </p>
                        <p>
                            <h2>Tanks of World War 2</h2>
                            This site also contains detailed information on all tanks used during world war 2 for every country involved
                            in the conflict. We detail everything from the weight, engine size, number of crew carried to the exact number
                            produced during the war.
                            
                            Use these quick links to navigate to the numerous armoured vehicles used by the main players during WW2.
                            <br /><br />
                            <ul class="list-group row">
                                <li class="list-group-item col-xs-4"><a href="https://www.quartermastersection.com/american/afvs/tanks">American Tanks</a></li>
                                <li class="list-group-item col-xs-4"><a href="https://www.quartermastersection.com/british/afvs/tanks">British Tanks</a></li>
                                <li class="list-group-item col-xs-4"><a href="https://www.quartermastersection.com/german/afvs/tanks">German Tanks</a></li>
                                <li class="list-group-item col-xs-4"><a href="https://www.quartermastersection.com/italian/afvs/tanks">Italian Tanks</a></li>
                                <li class="list-group-item col-xs-4"><a href="https://www.quartermastersection.com/japanese/afvs/tanks">Japanese Tanks</a></li>
                                <li class="list-group-item col-xs-4"><a href="https://www.quartermastersection.com/russian/afvs/tanks">Russian Tanks</a></li>
                            </ul>
                         </p>    
                    </div>
                </div><!--/.row-->
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
 
$homepage->canonical = '<link rel="canonical" href="https://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->Display();
