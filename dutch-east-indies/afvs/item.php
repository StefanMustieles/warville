<?php

require $_SERVER['DOCUMENT_ROOT'] . '/page.inc';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/templater.php';

$homepage = new Page();

$db = new Zebra_Database();

$db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

$db->query(
    'SELECT t1.item_id, t1.name, t1.large_image, t4.name AS category_name, t5.name AS country_name, t2.file_name AS template_name, t1.year, t1.designer, t1.type, t1.numbers_produced, t1.crew, t1.main_armament, t1.sponson_traverse, t1.elevation, t1.turret_traverse, '
	. 't1.gun_traverse, t1.gun_mounts, t1.maximum_range, t1.armour_penetration, t1.gun_sight, t1.secondary_armament, t1.smoke_discharger, t1.ammunition_carried, t1.height, t1.width, t1.length, t1.weight, t1.ground_clearance, '
	. 't1.fording_depth, t1.trench_crossing, t1.obstacle_clearance, t1.climbing_ability, t1.radio, t1.armour, t1.engine, t1.transmission, t1.maximum_road_range, t1.maximum_cross_country_range, ' 
	. 't1.maximum_road_speed, t1.maximum_water_range, t1.maximum_water_speed, t1.maximum_cross_country_speed, t1.variants, t1.notes, t1.image_source '
        . 'FROM `items` AS t1 INNER JOIN templates AS t2 ON t1.template_id = t2.template_id INNER JOIN sub_categories AS t3 ON t1.sub_category_id = t3.sub_category_id INNER JOIN categories AS t4 ON t3.category_id = t4.category_id INNER JOIN countries AS t5 ON t4.country_id = t5.country_id '
        . 'WHERE t1.item_id = ?', array($_GET["itemId"])
);

while ($row = $db->fetch_assoc()) {

    $itemName = $row['name'];
    $large_image = $row['large_image'];
    $category_name = $row['category_name'];
    $country_name = $row['country_name'];
    $templateName = $row['template_name'];
    $year = $row['year'];
    $type = $row['type'];
    $designer = $row['designer'];
    $numbers_produced = $row['numbers_produced'];
    $crew = $row['crew'];
    $main_armament = $row['main_armament'];
    $sponson_traverse = $row['sponson_traverse'];
    $elevation = $row['elevation'];
    $turret_traverse = $row['turret_traverse'];
    $gun_traverse = $row['gun_traverse'];
    $gun_mounts = $row['gun_mounts'];
    $maximum_range = $row['maximum_range'];
    $armour_penetration = $row['armour_penetration'];
    $gun_sight = $row['gun_sight'];
    $secondary_armament = $row['secondary_armament'];
    $smoke_discharger = $row['smoke_discharger'];
    $ammunition_carried = $row['ammunition_carried'];
    $height = $row['height'];
    $width = $row['width'];
    $length = $row['length'];
    $weight = $row['weight'];
    $ground_clearance = $row['ground_clearance'];
    $fording_depth = $row['fording_depth'];
    $trench_crossing = $row['trench_crossing'];
    $obstacle_clearance = $row['obstacle_clearance'];
    $climbing_ability = $row['climbing_ability'];
    $radio = $row['radio'];
    $armour = $row['armour'];
    $engine = $row['engine'];
    $transmission = $row['transmission'];
    $maximum_road_range = $row['maximum_road_range'];
    $maximum_cross_country_range = $row['maximum_cross_country_range'];
    $maximum_road_speed = $row['maximum_road_speed'];
    $maximum_water_range = $row['maximum_water_range'];
    $maximum_water_speed = $row['maximum_water_speed'];
    $maximum_cross_country_speed = $row['maximum_cross_country_speed'];
    $variants = $row['variants'];
    $notes = $row['notes'];
    $imageSource = $row['image_source'];
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
if(!isset($sponson_traverse) || trim($sponson_traverse)==='') {
    $tpl->set("showsponson", "class=\"hideData\"");
}
else {
    $tpl->set("sponson_traverse", $sponson_traverse);
    $tpl->set("showsponson", "class=\"showData\"");
}
if(!isset($elevation) || trim($elevation)==='') {
    $tpl->set("showelevation", "class=\"hideData\"");
}
else {
    $tpl->set("elevation", $elevation);
    $tpl->set("showelevation", "class=\"showData\"");
}
if(!isset($turret_traverse) || trim($turret_traverse)==='') {
    $tpl->set("showturret", "class=\"hideData\"");
}
else {
    $tpl->set("turret_traverse", $turret_traverse);
    $tpl->set("showturret", "class=\"showData\"");
}
if(!isset($gun_traverse) || trim($gun_traverse)==='') {
    $tpl->set("showguntraverse", "class=\"hideData\"");
}
else {
    $tpl->set("gun_traverse", $gun_traverse);
    $tpl->set("showguntraverse", "class=\"showData\"");
}
if(!isset($gun_mounts) || trim($gun_mounts)==='') {
    $tpl->set("showmounts", "class=\"hideData\"");
}
else {
    $tpl->set("gun_mounts", $gun_mounts);
    $tpl->set("showmounts", "class=\"showData\"");
}
if(!isset($maximum_range) || trim($maximum_range)==='') {
    $tpl->set("showrange", "class=\"hideData\"");
}
else {
    $tpl->set("maximum_range", $maximum_range);
    $tpl->set("showrange", "class=\"showData\"");
}
if(!isset($armour_penetration) || trim($armour_penetration)==='') {
    $tpl->set("showarmourpen", "class=\"hideData\"");
}
else {
    $tpl->set("armour_penetration", $armour_penetration);
    $tpl->set("showarmourpen", "class=\"showData\"");
}
if(!isset($gun_sight) || trim($gun_sight)==='') {
    $tpl->set("showgunsight", "class=\"hideData\"");
}
else {
    $tpl->set("gun_sight", $gun_sight);
    $tpl->set("showgunsight", "class=\"showData\"");
}
if(!isset($secondary_armament) || trim($secondary_armament)==='') {
    $tpl->set("showsecondary", "class=\"hideData\"");
}
else {
    $tpl->set("secondary_armament", $secondary_armament);
    $tpl->set("showsecondary", "class=\"showData\"");
}
if(!isset($smoke_discharger) || trim($smoke_discharger)==='') {
    $tpl->set("showsmoke", "class=\"hideData\"");
}
else {
    $tpl->set("smoke_discharger", $smoke_discharger);
    $tpl->set("showsmoke", "class=\"showData\"");
}
if(!isset($ammunition_carried) || trim($ammunition_carried)==='') {
    $tpl->set("showammunition", "class=\"hideData\"");
}
else {
    $tpl->set("ammunition_carried", $ammunition_carried);
    $tpl->set("showammunition", "class=\"showData\"");
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
if(!isset($weight) || trim($weight)==='') {
    $tpl->set("showweight", "class=\"hideData\"");
}
else {
    $tpl->set("weight", $weight);
    $tpl->set("showweight", "class=\"showData\"");
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
if(!isset($trench_crossing) || trim($trench_crossing)==='') {
    $tpl->set("showtrench", "class=\"hideData\"");
}
else {
    $tpl->set("trench_crossing", $trench_crossing);
    $tpl->set("showtrench", "class=\"showData\"");
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
if(!isset($maximum_water_range) || trim($maximum_water_range)==='') {
    $tpl->set("showmaxwaterrange", "class=\"hideData\"");
}
else {
    $tpl->set("maximum_water_range", $maximum_water_range);
    $tpl->set("showmaxwaterrange", "class=\"showData\"");
}
if(!isset($maximum_water_speed) || trim($maximum_water_speed)==='') {
    $tpl->set("showmaxwaterspeed", "class=\"hideData\"");
}
else {
    $tpl->set("maximum_water_speed", $maximum_water_speed);
    $tpl->set("showmaxwaterspeed", "class=\"showData\"");
}
if(!isset($maximum_cross_country_speed) || trim($maximum_cross_country_speed)==='') {
    $tpl->set("showmaxcrosscountry", "class=\"hideData\"");
}
else {
    $tpl->set("maximum_cross_country_speed", $maximum_cross_country_speed);
    $tpl->set("showmaxcrosscountry", "class=\"showData\"");
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
$imageCaption;
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

$address = 'http://'.$_SERVER['HTTP_HOST'];

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

$homepage->title = $itemName . ' - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->Display();