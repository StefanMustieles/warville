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
        
        $db->query('SELECT t1.name AS sub_category, t1.description, t3.name AS country, t1.page_title ' 
                . 'FROM sub_categories AS t1 INNER JOIN categories AS t2 ON t1.category_id = t2.category_id '
                . 'INNER JOIN countries AS t3 ON t2.country_id = t3.country_id '
                . 'WHERE t1.sub_category_id = ?', array($sub_category_id)
        );

        while ($row = $db->fetch_assoc()) {

            $elements[] = $row["country"] . ' ' . $row["sub_category"];
            $elements[] = $row["page_title"];
            $elements[] = utf8_encode($row["description"]);							
        }

        $db->query('SELECT t1.sub_category_id, t1.item_id, t1.title, t1.friendly_url, t1.thumbnail_image, t1.short_text '
                   . 'FROM items AS t1 INNER JOIN sub_categories AS t2 ON t1.sub_category_id = t2.sub_category_id '
                   . 'WHERE t1.sub_category_id = ? ORDER BY t1.display_order, t2.sort_order', array($sub_category_id)
        );
    }
    else {
        $mainCategory = $_GET["category"];
        
        $db->query('SELECT t1.name AS category, t1.description, t2.name AS country, t1.page_title '
                    . 'FROM categories AS t1 '
                    . 'INNER JOIN countries AS t2 ON t1.country_id = t2.country_id '
                    . 'WHERE LOWER(t2.name) = ? AND LOWER(t1.name) = ?', array($url, $mainCategory)
        );

        while ($row = $db->fetch_assoc()) {
            
            $elements[] = $row["country"] . ' ' . $row["category"];
            $elements[] = $row["page_title"];
            $elements[] = utf8_encode($row["description"]);							
        }

        $db->query(
            'SELECT t1.sub_category_id, t1.item_id, t1.title, t1.friendly_url, t1.thumbnail_image, t1.short_text '
                . 'FROM items AS t1 INNER JOIN sub_categories AS t2 ON t1.sub_category_id = t2.sub_category_id '
                . 'INNER JOIN categories AS t3 ON t2.category_id = t3.category_id '
                . 'INNER JOIN countries AS t4 ON t3.country_id = t4.country_id '
                . 'WHERE LOWER(t4.name) = ? AND LOWER(t3.name) = ? GROUP BY t1.sub_category_id, t1.item_id ORDER BY t2.sort_order, t1.display_order', array($url, $mainCategory)
        );
    }

    $i = 1;

    while ($row = $db->fetch_assoc()) {

        $postContent = '<div class="col-sm-4 col-lg-4 col-md-4 item" data-id="id-' . $row["item_id"] . '" data-type="' . $row["sub_category_id"] . '">
                        <a href="' . $row["item_id"] . '/' . $row["friendly_url"] . '">    
                            <div class="thumbnail">';
                
        if(empty($row["thumbnail_image"]))
            $postContent .= '<img src="/assets/images/awaitingImage.jpg" alt="' . $row["title"] . '" class="thumbnail-pics">';
        else
            $postContent .= '<img src="img/' . $row["thumbnail_image"] . '" alt="' . $row["title"] . '" class="thumbnail-pics">';
        
        $postContent .= '<div class="caption">
                                    <h4>' . $row["title"] . '</h4>
                                    <p>' . $row["short_text"] . '</p>
                                </div>
                            </div>
                        </a>
                    </div>';

        $elements[] = $postContent;
        
        if($i % 3 == 0){
           $elements[] = '<div class="clearfix visible-xs-block"></div>';
        }
        $i++;
    }
    
    echo json_encode($elements);
}