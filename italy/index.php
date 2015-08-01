<?php

require $_SERVER['DOCUMENT_ROOT'] . '/page.inc';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';

$homepage = new Page();

$postContent = '<section id="content">
                        <div class="container">
                            <div class="row">
                                <ul class="breadcrumb">
                                    <li><a href="../">Home</a></li>
                                    <li class="active">Italian</li>
                                </ul>
                            </div><!--/.row-->
                        </div><!--/.container-->
                        <div class="container">
                            <div class="row">
                                <h1>Italian Military Force</h1>
                            </div><!--/.row-->
                        </div><!--/.container-->
                        <div class="container">
                            <div class="row">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a turpis ac ex ornare consequat ac ac ligula. Phasellus sapien metus, 
                                    luctus et efficitur vel, pretium sit amet nisi. Nullam sed varius nibh. Nunc vehicula neque sit amet urna dapibus tincidunt. 
                                    Maecenas a fringilla urna. Quisque scelerisque purus nec blandit finibus. Duis in risus vel diam mollis euismod nec nec est.
                                    Cras at accumsan ante, nec viverra tellus. Phasellus eget malesuada mi. Vivamus eu bibendum augue, quis tempus metus. Ut malesuada 
                                    enim a vehicula tempor. Aenean ac libero purus. Nulla interdum enim non erat condimentum imperdiet. Aenean mattis imperdiet leo ac 
                                    finibus. Duis quis mi a est fringilla suscipit non id elit. Morbi purus ante, varius id ante in, fringilla semper est. Morbi eu feugiat 
                                    tellus, eget elementum tellus. Nullam iaculis risus vel nibh bibendum tempus. Maecenas cursus lacinia nibh id congue.
                                </p>
                            </div><!--/.row-->
                        </div><!--/.container-->
                        </section><!--/#content-->

                        <section id="content">
                        <div class="container">';

$db = new Zebra_Database();

$db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

$db->select(
    'name, folder_name',
    'categories',
    'country_id = ?', array(14)
);

while ($row = $db->fetch_assoc()) {

$postContent .=	 '<div class="row">
            <div class="col-md-7">
                <a href="' . $row["folder_name"] . '/">
                    <img class="img-responsive" src="http://placehold.it/700x300" alt="">
                </a>
            </div>
            <div class="col-md-5">
                <h2>' . $row["name"] . '</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, odit velit cumque vero doloremque repellendus distinctio maiores rem expedita a nam vitae modi quidem similique ducimus! Velit, esse totam tempore.</p>
                <a class="btn btn-primary" href="' . $row["folder_name"] . '/">View More <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
        <!-- /.row -->

        <hr>';								
                                                        
}

$postContent .= '</div><!--/#container-->
            </section><!--/#content-->';

$homepage->title =  'Italian Military Force - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->content = $postContent;

$homepage->Display();