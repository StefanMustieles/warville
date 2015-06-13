<?php

require $_SERVER['DOCUMENT_ROOT'] . '/page.inc';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/templater.php';

$homepage = new Page();

$db = new Zebra_Database();

$db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

$db->query(
    'SELECT t1.item_id, t1.name, t1.large_image, t4.name AS category_name, t5.name AS country_name, t2.file_name AS template_name, t1.content, t1.image_source '
      . 'FROM `items` AS t1 INNER JOIN templates AS t2 ON t1.template_id = t2.template_id INNER JOIN sub_categories AS t3 ON t1.sub_category_id = t3.sub_category_id INNER JOIN categories AS t4 ON t3.category_id = t4.category_id INNER JOIN countries AS t5 ON t4.country_id = t5.country_id '
        . 'WHERE t1.item_id = ?', array($_GET["itemId"])
);

while ($row = $db->fetch_assoc()) {

    $itemName = $row['name'];
    $large_image = $row['large_image'];
    $category_name = $row['category_name'];
    $country_name = $row['country_name'];
    $templateName = $row['template_name'];
    $content = $row['content'];
    $imageSource = $row['image_source'];
}

$tpl =  new templater($_SERVER['DOCUMENT_ROOT'] . '/templates/' . $templateName);
$tpl->set("content", $content);
$imageCaption;
if(!isset($imageSource) || trim($imageSource)==='') {
    $imageCaption = "";
}
else {
    $imageCaption = "Image: " . $imageSource;
}

$content = '<section id="content">
                <div class="container">
                    <div class="row">
                        <ul class="breadcrumb">
                            <li><a href="../../../">Home</a></li>
                            <li><a href="../../">%s</a></li>
                            <li><a href="../">%s</a></li>
                            <li class="active">%s</li>
                        </ul>

                        <h1>%s</h1>
                            <div class="col-md-12">
                                <div class="thumbnail clearfix">
                                    <img src="../img/' . $large_image . '" alt="%s" class="img-responsive pull-left largeImage">
                                    <div class="caption largeImageCaption" class="pull-right">'
                                        . $imageCaption .
                                    '</div>
                                </div>
                                <div class="caption-full">'
                                     . $tpl->output() . 
                                '</div>
                            </div><!--/.col-md-12-->
                    </div><!--/.row-->
                </div><!--/.container-->
            </section><!--/#content-->';

$pageContent = sprintf($content, $country_name, $category_name, $itemName, $itemName, $itemName);

$homepage->content = $pageContent;

$homepage->Display();