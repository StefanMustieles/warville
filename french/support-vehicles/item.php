<?php

require $_SERVER['DOCUMENT_ROOT'] . '/page.inc';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/templater.php';

$homepage = new Page();

$db = new Zebra_Database();

$db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

$db->query('SELECT t1.item_id, t1.name, t1.large_image, t4.name AS category_name, t5.name AS country_name, t2.file_name AS template_name, t1.year, t1.type, t1.designer, t1.numbers_produced, t1.crew, t1.main_armament, t1.ammunition_carried, t1.pay_load, t1.towed_load, t1.weight, t1.height, '
	. 't1.width, t1.length, t1.ground_clearance, t1.fording_depth, t1.obstacle_clearance, t1.trench_crossing, t1.climbing_ability, t1.cargo_capacity, t1.tow_capacity, t1.radio, t1.armour, t1.engine, t1.transmission, t1.maximum_road_range, t1.maximum_cross_country_range, t1.maximum_road_speed, t1.maximum_road_speed_trailer, '
	. 't1.maximum_cross_country_speed, t1.maximum_road_towing_speed, t1.variants, t1.notes, t1.image_source, t1.views '
        . 'FROM items AS t1 INNER JOIN templates AS t2 ON t1.template_id = t2.template_id INNER JOIN sub_categories AS t3 ON t1.sub_category_id = t3.sub_category_id INNER JOIN categories AS t4 ON t3.category_id = t4.category_id INNER JOIN countries AS t5 ON t4.country_id = t5.country_id '
        . 'WHERE t1.item_id = ?', array($_GET["itemId"])
);

while ($row = $db->fetch_assoc()) {

    $itemName = $row['name'];
    $templateName = $row['template_name'];
    $category_name = $row['category_name'];
    $country_name = $row['country_name'];
    $large_image = $row['large_image'];
    $year = $row['year'];
    $type = $row['type'];
    $designer = $row['designer'];
    $numbers_produced = $row['numbers_produced'];
    $crew = $row['crew'];
    $main_armament = $row['main_armament'];
    $ammunition_carried = $row['ammunition_carried'];
    $pay_load = $row['pay_load'];
    $towed_load = $row['towed_load'];
    $weight = $row['weight'];
    $height = $row['height'];
    $width = $row['width'];
    $length = $row['length'];
    $ground_clearance = $row['ground_clearance'];
    $fording_depth = $row['fording_depth'];
    $obstacle_clearance = $row['obstacle_clearance'];
    $trench_crossing = $row['trench_crossing'];
    $climbing_ability = $row['climbing_ability'];
    $cargo_capacity = $row['cargo_capacity'];
    $tow_capacity = $row['tow_capacity'];
    $radio = $row['radio'];
    $armour = $row['armour'];
    $engine = $row['engine'];
    $transmission = $row['transmission'];
    $maximum_road_range = $row['maximum_road_range'];
    $maximum_cross_country_range = $row['maximum_cross_country_range'];
    $maximum_road_speed = $row['maximum_road_speed'];
    $maximum_road_speed_trailer = $row['maximum_road_speed_trailer'];
    $maximum_cross_country_speed = $row['maximum_cross_country_speed'];
    $maximum_road_towing_speed = $row['maximum_road_towing_speed'];
    $variants = $row['variants'];
    $notes = $row['notes'];
    $imageSource = $row['image_source'];
    $views = $row['views'];
}

$tpl =  new templater($_SERVER['DOCUMENT_ROOT'] . '/templates/' . $templateName);
if(!isset($year) || trim($year)==='') {
    $tpl->set("showyear", "class=\"hideData\"");
}
else {
    $tpl->set("year", $year);
    $tpl->set("showyear", "class=\"showData\"");
}
if(!isset($type) || trim($type)==='') {
    $tpl->set("showtype", "class=\"hideData\"");
}
else {
    $tpl->set("type", $type);
    $tpl->set("showtype", "class=\"showData\"");
}
if(!isset($designer) || trim($designer)==='') {
    $tpl->set("showdesigner", "class=\"hideData\"");
}
else {
    $tpl->set("designer", $designer);
    $tpl->set("showdesigner", "class=\"showData\"");
}
if(!isset($numbers_produced) || trim($numbers_produced)==='') {
    $tpl->set("shownumbers", "class=\"hideData\"");
}
else {
    $tpl->set("numbers_produced", $numbers_produced);
    $tpl->set("shownumbers", "class=\"showData\"");
}
if(!isset($crew) || trim($crew)==='') {
    $tpl->set("showcrew", "class=\"hideData\"");
}
else {
    $tpl->set("crew", $crew);
    $tpl->set("showcrew", "class=\"showData\"");
}
if(!isset($main_armament) || trim($main_armament)==='') {
    $tpl->set("showarmament", "class=\"hideData\"");
}
else {
    $tpl->set("main_armament", $main_armament);
    $tpl->set("showarmament", "class=\"showData\"");
}
if(!isset($ammunition_carried) || trim($ammunition_carried)==='') {
    $tpl->set("showammunition", "class=\"hideData\"");
}
else {
    $tpl->set("ammunition_carried", $ammunition_carried);
    $tpl->set("showammunition", "class=\"showData\"");
}
if(!isset($pay_load) || trim($pay_load)==='') {
    $tpl->set("showpayload", "class=\"hideData\"");
}
else {
    $tpl->set("pay_load", $pay_load);
    $tpl->set("showpayload", "class=\"showData\"");
}
if(!isset($towed_load) || trim($towed_load)==='') {
    $tpl->set("showtowedload", "class=\"hideData\"");
}
else {
    $tpl->set("towed_load", $towed_load);
    $tpl->set("showtowedload", "class=\"showData\"");
}
if(!isset($weight) || trim($weight)==='') {
    $tpl->set("showweight", "class=\"hideData\"");
}
else {
    $tpl->set("weight", $weight);
    $tpl->set("showweight", "class=\"showData\"");
}
if(!isset($height) || trim($height)==='') {
    $tpl->set("showheight", "class=\"hideData\"");
}
else {
    $tpl->set("height", $height);
    $tpl->set("showheight", "class=\"showData\"");
}
if(!isset($width) || trim($width)==='') {
    $tpl->set("showwidth", "class=\"hideData\"");
}
else {
    $tpl->set("width", $width);
    $tpl->set("showwidth", "class=\"showData\"");
}
if(!isset($length) || trim($length)==='') {
    $tpl->set("showlength", "class=\"hideData\"");
}
else {
    $tpl->set("length", $length);
    $tpl->set("showlength", "class=\"showData\"");
}
if(!isset($ground_clearance) || trim($ground_clearance)==='') {
    $tpl->set("showground", "class=\"hideData\"");
}
else {
    $tpl->set("ground_clearance", $ground_clearance);
    $tpl->set("showground", "class=\"showData\"");
}
if(!isset($fording_depth) || trim($fording_depth)==='') {
    $tpl->set("showfording", "class=\"hideData\"");
}
else {
    $tpl->set("fording_depth", $fording_depth);
    $tpl->set("showfording", "class=\"showData\"");
}
if(!isset($obstacle_clearance) || trim($obstacle_clearance)==='') {
    $tpl->set("showobstacle", "class=\"hideData\"");
}
else {
    $tpl->set("obstacle_clearance", $obstacle_clearance);
    $tpl->set("showobstacle", "class=\"showData\"");
}
if(!isset($climbing_ability) || trim($climbing_ability)==='') {
    $tpl->set("showclimbing", "class=\"hideData\"");
}
else {
    $tpl->set("climbing_ability", $climbing_ability);
    $tpl->set("showclimbing", "class=\"showData\"");
}
if(!isset($cargo_capacity) || trim($cargo_capacity)==='') {
    $tpl->set("showcargocapacity", "class=\"hideData\"");
}
else {
    $tpl->set("cargo_capacity", $cargo_capacity);
    $tpl->set("showcargocapacity", "class=\"showData\"");
}
if(!isset($tow_capacity) || trim($tow_capacity)==='') {
    $tpl->set("showtowcapacity", "class=\"hideData\"");
}
else {
    $tpl->set("tow_capacity", $tow_capacity);
    $tpl->set("showtowcapacity", "class=\"showData\"");
}
if(!isset($radio) || trim($radio)==='') {
    $tpl->set("showradio", "class=\"hideData\"");
}
else {
    $tpl->set("radio", $radio);
    $tpl->set("showradio", "class=\"showData\"");
}
if(!isset($armour) || trim($armour)==='') {
    $tpl->set("showarmour", "class=\"hideData\"");
}
else {
    $tpl->set("armour", $armour);
    $tpl->set("showarmour", "class=\"showData\"");
}
if(!isset($engine) || trim($engine)==='') {
    $tpl->set("showengine", "class=\"hideData\"");
}
else {
    $tpl->set("engine", $engine);
    $tpl->set("showengine", "class=\"showData\"");
}
if(!isset($transmission) || trim($transmission)==='') {
    $tpl->set("showtransmission", "class=\"hideData\"");
}
else {
    $tpl->set("transmission", $transmission);
    $tpl->set("showtransmission", "class=\"showData\"");
}
if(!isset($maximum_road_range) || trim($maximum_road_range)==='') {
    $tpl->set("showmaxrange", "class=\"hideData\"");
}
else {
    $tpl->set("maximum_road_range", $maximum_road_range);
    $tpl->set("showmaxrange", "class=\"showData\"");
}
if(!isset($maximum_cross_country_range) || trim($maximum_cross_country_range)==='') {
    $tpl->set("showmaxcrosscountryrange", "class=\"hideData\"");
}
else {
    $tpl->set("maximum_cross_country_range", $maximum_cross_country_range);
    $tpl->set("showmaxcrosscountryrange", "class=\"showData\"");
}
if(!isset($maximum_road_speed) || trim($maximum_road_speed)==='') {
    $tpl->set("showmaxspeed", "class=\"hideData\"");
}
else {
    $tpl->set("maximum_road_speed", $maximum_road_speed);
    $tpl->set("showmaxspeed", "class=\"showData\"");
}
if(!isset($maximum_road_speed_trailer) || trim($maximum_road_speed_trailer)==='') {
    $tpl->set("showmaxspeedtrailer", "class=\"hideData\"");
}
else {
    $tpl->set("maximum_road_speed_trailer", $maximum_road_speed_trailer);
    $tpl->set("showmaxspeedtrailer", "class=\"showData\"");
}
if(!isset($maximum_cross_country_speed) || trim($maximum_cross_country_speed)==='') {
    $tpl->set("showmaxcrosscountry", "class=\"hideData\"");
}
else {
    $tpl->set("maximum_cross_country_speed", $maximum_cross_country_speed);
    $tpl->set("showmaxcrosscountry", "class=\"showData\"");
}
if(!isset($maximum_road_towing_speed) || trim($maximum_road_towing_speed)==='') {
    $tpl->set("showmaxroadtowingspeed", "class=\"hideData\"");
}
else {
    $tpl->set("maximum_road_towing_speed", $maximum_road_towing_speed);
    $tpl->set("showmaxroadtowingspeed", "class=\"showData\"");
}
if(!isset($variants) || trim($variants)==='') {
    $tpl->set("showvariants", "class=\"hideData\"");
}
else {
    $tpl->set("variants", $variants);
    $tpl->set("showvariants", "class=\"showData\"");
}
if(!isset($notes) || trim($notes)==='') {
    $tpl->set("shownotes", "class=\"hideData\"");
}
else {
    $tpl->set("notes", $notes);
    $tpl->set("shownotes", "class=\"showData\"");
}
$imageCaption = "";
if(!isset($imageSource) || trim($imageSource)==='') {
    $imageCaption = "";
}
else {
    $imageCaption = "Image: " . $imageSource;
}

if($location = substr(dirname($_SERVER['PHP_SELF']), 1))
    $dirlist = explode('/', $location);
else
    $dirlist = array();

$count = array_push($dirlist, basename($_SERVER['PHP_SELF']));

$address = 'https://'.$_SERVER['HTTP_HOST'];

$content = '<section id="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li><a href="' . $address . '">Home</a></li>
                                <li><a href="' .($address .= '/'.$dirlist[0]) . '/">%s</a></li>
                                <li><a href="' .($address .= '/'.$dirlist[1]) . '/">%s</a></li>
                                <li class="active">%s</li>
                            </ul>
                            <h1>%s</h1>
                        </div><!--/.col-md-12-->
                    </div><!--/.row-->
                </div><!--/.container-->
            </section><!--/#content-->
            <section id="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="thumbnail clearfix">';
                            
    if(empty($large_image))
        $content .= '<img src="/assets/images/awaitingImage.jpg" alt="%s" class="img-responsive pull-left largeImage">';
    else
        $content .= '<img src="../img/' . $large_image . '" alt="%s" class="img-responsive pull-left largeImage">';
                                
        $content .= '<div class="caption largeImageCaption" class="pull-right">'
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

$homepage->title = $itemName . ' - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="https://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$db->update('items', 
            array('views' => $views + 1),
            'item_id = ?', array($_GET["itemId"]));

$homepage->Display();