<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';

$sub_category_id = $_GET["id"];
$url = $_GET["cid"];

if(isset($url, $sub_category_id)) {
    $db = new Zebra_Database();

    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

    $elements = array();
    
    if($sub_category_id != "All") {
        
        $db->query('SELECT t1.name AS sub_category, t1.description, t3.name AS country ' 
                . 'FROM sub_categories AS t1 INNER JOIN categories AS t2 ON t1.category_id = t2.category_id '
                . 'INNER JOIN countries AS t3 ON t2.country_id = t3.country_id '
                . 'WHERE t1.sub_category_id = ?', array($sub_category_id)
        );

        while ($row = $db->fetch_assoc()) {

            $elements[] = $row["country"] . ' ' . $row["sub_category"];
            $elements[] = utf8_encode($row["description"]);							
        }

        $db->query(
            'SELECT sub_category_id, item_id, title, friendly_url, thumbnail_image, short_text '
              . 'FROM `items` '
                . 'WHERE sub_category_id = ?', array($sub_category_id)
        );
    }
    else {
        $db->query('SELECT t2.category_id, t2.name AS category, t2.description, t3.name AS country ' 
                . 'FROM categories AS t2 INNER JOIN countries AS t3 ON t2.country_id = t3.country_id '
                . 'WHERE LOWER(t3.name) = ?', array($url)
        );

        while ($row = $db->fetch_assoc()) {
            $category_id = $row["category_id"];
            $elements[] = $row["country"] . ' ' . $row["category"];
            $elements[] = utf8_encode($row["description"]);							
        }

        $db->query(
            'SELECT sub_category_id, item_id, title, friendly_url, thumbnail_image, short_text '
              . 'FROM `items` AS t1 INNER JOIN sub_categories AS t2 ON t1.sub_category_id = t2.sub_category_id '
                . 'INNER JOIN categories AS t3 ON t2.category_id = t3.category_id '
                    . 'WHERE category_id = ?', array($category_id)
        );
    }

    $i = 1;

    while ($row = $db->fetch_assoc()) {

        $elements[] = '<div class="col-sm-4 col-lg-4 col-md-4 item" data-id="id-' . $row["item_id"] . '" data-type="' . $row["sub_category_id"] . '">
                            <div class="thumbnail">
                                <img src="img/' . $row["thumbnail_image"] . '" alt="' . $row["title"] . '" class="thumbnail-pics">
                                <div class="caption">
                                    <h4><a href="' . $row["item_id"] . '/' . $row["friendly_url"] . '">' . $row["title"] . '</a>
                                    </h4>
                                    <p>' . $row["short_text"] . '</p>
                                </div>
                            </div>
                        </div>';

        if($i % 3 == 0){
           $elements[] = '<div class="clearfix visible-xs-block"></div>';
        }
        $i++;
    }
    
    echo json_encode($elements);
}