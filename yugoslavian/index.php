<?php

require $_SERVER['DOCUMENT_ROOT'] . '/page.inc';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';

$homepage = new Page();

$db = new Zebra_Database();

$db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

$db->select(
    'name, description, meta_description',
    'countries',
    'country_id = ?', array(24)
);

while ($row = $db->fetch_assoc()) {
    $name = $row['name'];
    $description = $row['description'];
    $meta_description = $row['meta_description'];
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
                                </div>
                            </div><!--/.row-->
                        </div><!--/.container-->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>%s Military Force</h1>
                                </div>
                            </div><!--/.row-->
                        </div><!--/.container-->
                        <div class="container">
                            <div class="row">
                                <p>
                                    %s
                                </p>
                            </div><!--/.row-->
                        </div><!--/.container-->
                        </section><!--/#content-->

                        <section id="content">
                        <div class="container">', $name, $name, $description);

$db->select(
    'name, folder_name',
    'categories',
    'country_id = ?', array(24)
);

while ($row = $db->fetch_assoc()) {

$postContent .=	 '<div class="row">
            <div class="col-md-7">
                <a href="' . $row["folder_name"] . '/">
                    <img class="img-responsive" src="http://placehold.it/700x300" alt="">
                </a>
            </div>
            <div class="col-md-5">
                <h3>' . $row["name"] . '</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, odit velit cumque vero doloremque repellendus distinctio maiores rem expedita a nam vitae modi quidem similique ducimus! Velit, esse totam tempore.</p>
                <a class="btn btn-primary" href="' . $row["folder_name"] . '/">View More <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
        <!-- /.row -->

        <hr>';								
                                                        
}

$postContent .= '</div><!--/#container-->
            </section><!--/#content-->';

$homepage->title =  $name . ' Military Force - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->content = $postContent;

$homepage->Display();