<?php

require $_SERVER['DOCUMENT_ROOT'] . '/page.inc';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';

$homepage = new Page();

$homepage->contentpagescripts = '<script src="/assets/js/listedItems.js" type="text/javascript"></script>';

$db = new Zebra_Database();

$db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

$uri = $_SERVER["REQUEST_URI"];
$uriParts = explode("/", $uri);
$isSubCategory = true;

if($uriParts[3] == '' || strpos($uriParts[3], 'index') !== FALSE) {
    $isSubCategory = false;
}

if(!$isSubCategory) {
    $db->query('SELECT t1.description, t2.name AS country, t1.name, "" AS sub_category, t1.meta_description, t1.page_title '
            . 'FROM categories AS t1 INNER JOIN countries AS t2 ON t1.country_id = t2.country_id '
            . 'WHERE t2.country_id = ? AND t1.category_id = ?', array(1, 4));
}
else {
    $db->query('SELECT t1.description, t3.name AS country, t2.name, t1.name AS sub_category, t1.meta_description, t1.page_title '
             . 'FROM sub_categories AS t1 INNER JOIN categories AS t2 ON t1.category_id = t2.category_id '
             . 'INNER JOIN countries AS t3 ON t2.country_id = t3.country_id '
             . 'WHERE t3.country_id = ? AND t1.seo_url = LOWER(?)', array(1, $uriParts[3]));
}
												
while ($row = $db->fetch_assoc()) {

$descriptionText = $row["description"];							
$country = $row["country"];
$category = $row["name"];
$sub_category = $row["sub_category"];
$metaDescription = $row["meta_description"];
$page_title = $row["page_title"];
}

$homepage->metadescription = $metaDescription;

$postContent = sprintf('<section id="content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="breadcrumb">
                                            <li><a href="../../">Home</a></li>
                                            <li><a href="../">%s</a></li>', $country);
if(!$isSubCategory) {
    $postContent .= sprintf('<li class="active">%s</li>', $category);
    $title = $country . ' ' . $category;
}
else {
    $postContent .= sprintf('<li><a href="' . substr($_SERVER['REQUEST_URI'], 0, strripos($_SERVER['REQUEST_URI'], "/")) . '/">%s</a></li>
                             <li class="active">%s</li>', $category, $sub_category);
    $title = $country . ' ' . $sub_category;
}

$postContent .= sprintf('</ul>
                        <h1 id="contentHeader">%s</h1>
                        <p id="description">%s</p>
                    </div>
                </div><!--/.row-->
            </div><!--/.container-->
    </section><!--/#content-->

    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div>
                    <p class="lead">Filters</p>
                        <div class="list-group">
                            <a id="All" class="list-group-item%s">All</a>', $title, $descriptionText, $isSubCategory == false ? ' active' : '');

$db->select(
    'sub_category_id, name, seo_url',
    'sub_categories',
    'category_id = ? AND active = 1', array(4), 'sort_order'
);
												
while ($row = $db->fetch_assoc()) {

    if($isSubCategory && $uriParts[3] == $row["seo_url"])
        $postContent .=	 '<a id="' . $row["sub_category_id"] . '" href="' . $row["seo_url"] . '" class="list-group-item active">' . $row["name"] . '</a>';
    else
        $postContent .=	 '<a id="' . $row["sub_category_id"] . '" href="' . $row["seo_url"] . '" class="list-group-item">' . $row["name"] . '</a>';                                                       
}
														
$postContent .= '</div>
                 <div>
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- LHN Responsive Advert -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-9723853993452546"
                         data-ad-slot="5519182518"
                         data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                 </div>
                </div>
		</div>

		<div class="col-md-9 itemHolder">
                    <div class="row">';
						
if(!$isSubCategory) {
    $db->query(
        'SELECT t1.sub_category_id, t1.item_id, t1.title, t1.friendly_url, t1.thumbnail_image, t1.short_text FROM `items` AS t1 '
          . 'INNER JOIN sub_categories AS t2 ON t1.sub_category_id = t2.sub_category_id '
            . 'WHERE t2.category_id = ? GROUP BY t1.sub_category_id, t1.item_id ORDER BY t2.sort_order, t1.display_order', array(4)
    );
}
else {
    $db->query(
        'SELECT t1.sub_category_id, t1.item_id, t1.title, t1.friendly_url, t1.thumbnail_image, t1.short_text FROM `items` AS t1 '
          . 'INNER JOIN sub_categories AS t2 ON t1.sub_category_id = t2.sub_category_id '
            . 'WHERE t2.category_id = ? AND t2.seo_url = LOWER(?) ORDER BY t2.sort_order, t1.display_order', array(4, $uriParts[3])
    );
}

$i = 1;

while ($row = $db->fetch_assoc()) {

    $postContent .= '<div class="col-sm-4 col-lg-4 col-md-4 item" data-id="id-' . $row["item_id"] . '" data-type="' . $row["sub_category_id"] . '">
                        <a href="' . $row["item_id"] . '/' . $row["friendly_url"] . '">    
                            <div class="thumbnail">';

    if(empty($row["thumbnail_image"]))
        $postContent .= '<img src="/assets/images/awaitingImage.jpg" alt="' . $row["title"] . '" class="thumbnail-pics">';
    else
        $postContent .= '<img src="img/' . $row["thumbnail_image"] . '" alt="' . $row["title"] . '" class="thumbnail-pics">';
    
    $postContent .='<div class="caption">
                        <h4>' . $row["title"] . '</h4>
                        <p>' . $row["short_text"] . '</p>
                    </div>
                </div>
            </a>
        </div>';
    
    if($i % 3 == 0){
       $postContent .= '<div class="clearfix visible-xs-block"></div>';
    }
    $i++;
}
						
$postContent .= '</div><!--/.row-->
        </div><!--/.col-md-9-->
    </div><!--/.container-->
</section><!--/#content-->';

if(empty($page_title)) $homepage->title = $title . ' - ' . $homepage->title;
else $homepage->title = $page_title;

$homepage->canonical = '<link rel="canonical" href="https://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->content = $postContent;
	
$homepage->Display();