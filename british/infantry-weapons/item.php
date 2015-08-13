<?php

require $_SERVER['DOCUMENT_ROOT'] . '/page.inc';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/templater.php';

$homepage = new Page();

$db = new Zebra_Database();

$db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

$db->query(
    'SELECT t1.item_id, t1.name, t1.large_image, t4.name AS category_name, t5.name AS country_name, t2.file_name AS template_name, t1.year, t1.type, t1.designer, t1.numbers_produced, t1.crew, t1.calibre, t1.elevation, t1.gun_traverse, t1.cartridge_weight, t1.round_weight, t1.barrel_length, t1.length, t1.grenade_types, t1.weight, t1.gun_mounts, '
	. 't1.operation, t1.cooling_system, t1.sights, t1.feed, t1.rate_of_fire, t1.maximum_rate_of_fire, t1.blank_cartridge, t1.muzzle_velocity, t1.fuel_capacity, t1.minimum_range, t1.effective_range, t1.maximum_range, t1.armour_penetration, t1.bayonet, t1.traction, t1.variants, t1.notes, t1.image_source '
        . 'FROM `items` AS t1 INNER JOIN templates AS t2 ON t1.template_id = t2.template_id INNER JOIN sub_categories AS t3 ON t1.sub_category_id = t3.sub_category_id INNER JOIN categories AS t4 ON t3.category_id = t4.category_id INNER JOIN countries AS t5 ON t4.country_id = t5.country_id '
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
    $calibre = $row['calibre'];
    $elevation = $row['elevation'];
    $gun_traverse = $row['gun_traverse'];
    $cartridge_weight = $row['cartridge_weight'];
    $round_weight = $row['round_weight'];
    $barrel_length = $row['barrel_length'];
    $length = $row['length'];
    $grenade_types = $row['grenade_types'];
    $mount = $row['gun_mounts'];
    $weight = $row['weight'];
    $operation = $row['operation'];
    $cooling = $row['cooling_system'];
    $sights = $row['sights'];
    $feed = $row['feed'];
    $rate_of_fire = $row['rate_of_fire'];
    $maximum_rate_of_fire = $row['maximum_rate_of_fire'];
    $blank_cartridge = $row['blank_cartridge'];
    $muzzle_velocity = $row['muzzle_velocity'];
    $fuel_capacity = $row['fuel_capacity'];
    $minimum_range = $row['minimum_range'];
    $effective_range = $row['effective_range'];
    $maximum_range = $row['maximum_range'];
    $armour_penetration = $row['armour_penetration'];
    $bayonet = $row['bayonet'];
    $traction = $row['traction'];
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
if(!isset($calibre) || trim($calibre)==='') {
    $tpl->set("showcalibre", "class=\"hideData\"");
}
else {
    $tpl->set("calibre", $calibre);
    $tpl->set("showcalibre", "class=\"showData\"");
}
if(!isset($elevation) || trim($elevation)==='') {
    $tpl->set("showelevation", "class=\"hideData\"");
}
else {
    $tpl->set("elevation", $elevation);
    $tpl->set("showelevation", "class=\"showData\"");
}
if(!isset($gun_traverse) || trim($gun_traverse)==='') {
    $tpl->set("showguntraverse", "class=\"hideData\"");
}
else {
    $tpl->set("gun_traverse", $gun_traverse);
    $tpl->set("showguntraverse", "class=\"showData\"");
}
if(!isset($cartridge_weight) || trim($cartridge_weight)==='') {
    $tpl->set("showcartridgeweight", "class=\"hideData\"");
}
else {
    $tpl->set("cartridge_weight", $cartridge_weight);
    $tpl->set("showcartridgeweight", "class=\"showData\"");
}
if(!isset($round_weight) || trim($round_weight)==='') {
    $tpl->set("showroundweight", "class=\"hideData\"");
}
else {
    $tpl->set("round_weight", $round_weight);
    $tpl->set("showroundweight", "class=\"showData\"");
}
if(!isset($barrel_length) || trim($barrel_length)==='') {
    $tpl->set("showbarrel", "class=\"hideData\"");
}
else {
    $tpl->set("barrel_length", $barrel_length);
    $tpl->set("showbarrel", "class=\"showData\"");
}
if(!isset($length) || trim($length)==='') {
    $tpl->set("showlength", "class=\"hideData\"");
}
else {
    $tpl->set("length", $length);
    $tpl->set("showlength", "class=\"showData\"");
}
if(!isset($grenade_types) || trim($grenade_types)==='') {
    $tpl->set("showgrenades", "class=\"hideData\"");
}
else {
    $tpl->set("grenade_types", $grenade_types);
    $tpl->set("showgrenades", "class=\"showData\"");
}
if(!isset($mount) || trim($mount)==='') {
    $tpl->set("showmount", "class=\"hideData\"");
}
else {
    $tpl->set("mount", $mount);
    $tpl->set("showmount", "class=\"showData\"");
}
if(!isset($weight) || trim($weight)==='') {
    $tpl->set("showweight", "class=\"hideData\"");
}
else {
    $tpl->set("weight", $weight);
    $tpl->set("showweight", "class=\"showData\"");
}
if(!isset($operation) || trim($operation)==='') {
    $tpl->set("showoperation", "class=\"hideData\"");
}
else {
    $tpl->set("operation", $operation);
    $tpl->set("showoperation", "class=\"showData\"");
}
if(!isset($cooling) || trim($cooling)==='') {
    $tpl->set("showcooling", "class=\"hideData\"");
}
else {
    $tpl->set("cooling", $cooling);
    $tpl->set("showcooling", "class=\"showData\"");
}
if(!isset($sights) || trim($sights)==='') {
    $tpl->set("showsight", "class=\"hideData\"");
}
else {
    $tpl->set("sights", $sights);
    $tpl->set("showsight", "class=\"showData\"");
}
if(!isset($feed) || trim($feed)==='') {
    $tpl->set("showfeed", "class=\"hideData\"");
}
else {
    $tpl->set("feed", $feed);
    $tpl->set("showfeed", "class=\"showData\"");
}
if(!isset($rate_of_fire) || trim($rate_of_fire)==='') {
    $tpl->set("showpracticalratefire", "class=\"hideData\"");
}
else {
    $tpl->set("practical_rate_of_fire", $rate_of_fire);
    $tpl->set("showpracticalratefire", "class=\"showData\"");
}
if(!isset($maximum_rate_of_fire) || trim($maximum_rate_of_fire)==='') {
    $tpl->set("showmaxratefire", "class=\"hideData\"");
}
else {
    $tpl->set("maximum_rate_of_fire", $maximum_rate_of_fire);
    $tpl->set("showmaxratefire", "class=\"showData\"");
}
if(!isset($blank_cartridge) || trim($blank_cartridge)==='') {
    $tpl->set("showblank", "class=\"hideData\"");
}
else {
    $tpl->set("blank_cartridge", $blank_cartridge);
    $tpl->set("showblank", "class=\"showData\"");
}
if(!isset($muzzle_velocity) || trim($muzzle_velocity)==='') {
    $tpl->set("showvelocity", "class=\"hideData\"");
}
else {
    $tpl->set("muzzle_velocity", $muzzle_velocity);
    $tpl->set("showvelocity", "class=\"showData\"");
}
if(!isset($fuel_capacity) || trim($fuel_capacity)==='') {
    $tpl->set("showfuel", "class=\"hideData\"");
}
else {
    $tpl->set("fuel_capacity", $fuel_capacity);
    $tpl->set("showfuel", "class=\"showData\"");
}
if(!isset($minimum_range) || trim($minimum_range)==='') {
    $tpl->set("showminrange", "class=\"hideData\"");
}
else {
    $tpl->set("minimum_range", $minimum_range);
    $tpl->set("showminrange", "class=\"showData\"");
}
if(!isset($effective_range) || trim($effective_range)==='') {
    $tpl->set("showrange", "class=\"hideData\"");
}
else {
    $tpl->set("effective_range", $effective_range);
    $tpl->set("showrange", "class=\"showData\"");
}
if(!isset($maximum_range) || trim($maximum_range)==='') {
    $tpl->set("showmaxrange", "class=\"hideData\"");
}
else {
    $tpl->set("maximum_range", $maximum_range);
    $tpl->set("showmaxrange", "class=\"showData\"");
}
if(!isset($armour_penetration) || trim($armour_penetration)==='') {
    $tpl->set("showarmourpenetration", "class=\"hideData\"");
}
else {
    $tpl->set("armour_penetration", $armour_penetration);
    $tpl->set("showarmourpenetration", "class=\"showData\"");
}
if(!isset($bayonet) || trim($bayonet)==='') {
    $tpl->set("showbayonet", "class=\"hideData\"");
}
else {
    $tpl->set("bayonet", $bayonet);
    $tpl->set("showbayonet", "class=\"showData\"");
}
if(!isset($traction) || trim($traction)==='') {
    $tpl->set("showtraction", "class=\"hideData\"");
}
else {
    $tpl->set("traction", $traction);
    $tpl->set("showtraction", "class=\"showData\"");
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

$homepage->title = $itemName . ' - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->content = $pageContent;

$homepage->Display();