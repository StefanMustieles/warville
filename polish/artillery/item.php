<?php

require $_SERVER['DOCUMENT_ROOT'] . '/page.inc';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/templater.php';

$homepage = new Page();

$db = new Zebra_Database();

$db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

$db->query(
    'SELECT t1.item_id, t1.name, t1.large_image, t4.name AS category_name, t5.name AS country_name, t2.file_name AS template_name, t1.year, t1.type, t1.designer, t1.numbers_produced, t1.calibre, t1.barrel_length, t1.carriage, t1.gun_shield, t1.height, t1.width, t1.length, '
    . 't1.gun_mounts, t1.trailers, t1.elevation, t1.turret_traverse, t1.breech, t1.recoil, t1.gun_sight, t1.muzzle_velocity, t1.feed, t1.rate_of_fire, t1.practical_rate_of_fire, t1.armoured_plate, t1.weight, t1.round_weight, t1.magazine_capacity, '
    . 't1.maximum_ceiling, t1.maximum_range, t1.maximum_ground_range, t1.rate_of_fire, t1.maximum_rate_of_fire, t1.armour_penetration, t1.crew, t1.traction, t1.variants, t1.notes, t1.image_source, t1.views '
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
    $calibre = $row['calibre'];
    $barrel_length = $row['barrel_length'];
    $carriage = $row['carriage'];
    $gun_shield = $row['gun_shield'];
    $height = $row['height'];
    $width = $row['width'];
    $length = $row['length'];
    $gun_mounts = $row['gun_mounts'];
    $trailers = $row['trailers'];
    $elevation = $row['elevation'];
    $turret_traverse = $row['turret_traverse'];
    $breech = $row['breech'];
    $recoil = $row['recoil'];
    $gun_sight = $row['gun_sight'];
    $muzzle_velocity = $row['muzzle_velocity'];
    $feed = $row['feed'];
    $practical_rate_of_fire = $row['practical_rate_of_fire'];
    $armoured_plate = $row['armoured_plate'];
    $weight = $row['weight'];
    $round_weight = $row['round_weight'];
    $magazine_capacity = $row['magazine_capacity'];
    $maximum_ceiling = $row['maximum_ceiling'];
    $maximum_range = $row['maximum_range'];
    $maximum_ground_range = $row['maximum_ground_range'];
    $rate_of_fire = $row['rate_of_fire'];
    $maximum_rate_of_fire = $row['maximum_rate_of_fire'];
    $armour_penetration = $row['armour_penetration'];
    $crew = $row['crew'];
    $traction = $row['traction'];
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
if(!isset($calibre) || trim($calibre)==='') {
    $tpl->set("showcalibre", "class=\"hideData\"");
}
else {
    $tpl->set("calibre", $calibre);
    $tpl->set("showcalibre", "class=\"showData\"");
}
if(!isset($barrel_length) || trim($barrel_length)==='') {
    $tpl->set("showbarrel", "class=\"hideData\"");
}
else {
    $tpl->set("barrel_length", $barrel_length);
    $tpl->set("showbarrel", "class=\"showData\"");
}
if(!isset($carriage) || trim($carriage)==='') {
    $tpl->set("showcarriage", "class=\"hideData\"");
}
else {
    $tpl->set("carriage", $carriage);
    $tpl->set("showcarriage", "class=\"showData\"");
}
if(!isset($gun_shield) || trim($gun_shield)==='') {
    $tpl->set("showgunshield", "class=\"hideData\"");
}
else {
    $tpl->set("gun_shield", $gun_shield);
    $tpl->set("showgunshield", "class=\"showData\"");
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
if(!isset($gun_mounts) || trim($gun_mounts)==='') {
    $tpl->set("showmounts", "class=\"hideData\"");
}
else {
    $tpl->set("gun_mounts", $gun_mounts);
    $tpl->set("showmounts", "class=\"showData\"");
}
if(!isset($trailers) || trim($trailers)==='') {
    $tpl->set("showtrailers", "class=\"hideData\"");
}
else {
    $tpl->set("trailers", $trailers);
    $tpl->set("showtrailers", "class=\"showData\"");
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
if(!isset($breech) || trim($breech)==='') {
    $tpl->set("showbreech", "class=\"hideData\"");
}
else {
    $tpl->set("breech", $breech);
    $tpl->set("showbreech", "class=\"showData\"");
}
if(!isset($recoil) || trim($recoil)==='') {
    $tpl->set("showrecoil", "class=\"hideData\"");
}
else {
    $tpl->set("recoil", $recoil);
    $tpl->set("showrecoil", "class=\"showData\"");
}
if(!isset($gun_sight) || trim($gun_sight)==='') {
    $tpl->set("showsight", "class=\"hideData\"");
}
else {
    $tpl->set("gun_sight", $gun_sight);
    $tpl->set("showsight", "class=\"showData\"");
}
if(!isset($muzzle_velocity) || trim($muzzle_velocity)==='') {
    $tpl->set("showvelocity", "class=\"hideData\"");
}
else {
    $tpl->set("muzzle_velocity", $muzzle_velocity);
    $tpl->set("showvelocity", "class=\"showData\"");
}
if(!isset($feed) || trim($feed)==='') {
    $tpl->set("showfeed", "class=\"hideData\"");
}
else {
    $tpl->set("feed", $feed);
    $tpl->set("showfeed", "class=\"showData\"");
}
if(!isset($practical_rate_of_fire) || trim($practical_rate_of_fire)==='') {
    $tpl->set("showpracticalratefire", "class=\"hideData\"");
}
else {
    $tpl->set("practical_rate_of_fire", $practical_rate_of_fire);
    $tpl->set("showpracticalratefire", "class=\"showData\"");
}
if(!isset($armoured_plate) || trim($armoured_plate)==='') {
    $tpl->set("showplate", "class=\"hideData\"");
}
else {
    $tpl->set("armoured_plate", $armoured_plate);
    $tpl->set("showplate", "class=\"showData\"");
}
if(!isset($weight) || trim($weight)==='') {
    $tpl->set("showweight", "class=\"hideData\"");
}
else {
    $tpl->set("weight", $weight);
    $tpl->set("showweight", "class=\"showData\"");
}
if(!isset($round_weight) || trim($round_weight)==='') {
    $tpl->set("showround", "class=\"hideData\"");
}
else {
    $tpl->set("round_weight", $round_weight);
    $tpl->set("showround", "class=\"showData\"");
}
if(!isset($magazine_capacity) || trim($magazine_capacity)==='') {
    $tpl->set("showcapacity", "class=\"hideData\"");
}
else {
    $tpl->set("magazine_capacity", $magazine_capacity);
    $tpl->set("showcapacity", "class=\"showData\"");
}
if(!isset($maximum_ceiling) || trim($maximum_ceiling)==='') {
    $tpl->set("showceiling", "class=\"hideData\"");
}
else {
    $tpl->set("maximum_ceiling", $maximum_ceiling);
    $tpl->set("showceiling", "class=\"showData\"");
}
if(!isset($maximum_range) || trim($maximum_range)==='') {
    $tpl->set("showmaxrange", "class=\"hideData\"");
}
else {
    $tpl->set("maximum_range", $maximum_range);
    $tpl->set("showmaxrange", "class=\"showData\"");
}
if(!isset($maximum_ground_range) || trim($maximum_ground_range)==='') {
    $tpl->set("showmaxgroundrange", "class=\"hideData\"");
}
else {
    $tpl->set("maximum_ground_range", $maximum_ground_range);
    $tpl->set("showmaxgroundrange", "class=\"showData\"");
}
if(!isset($rate_of_fire) || trim($rate_of_fire)==='') {
    $tpl->set("showrateoffire", "class=\"hideData\"");
}
else {
    $tpl->set("rate_of_fire", $rate_of_fire);
    $tpl->set("showrateoffire", "class=\"showData\"");
}
if(!isset($maximum_rate_of_fire) || trim($maximum_rate_of_fire)==='') {
    $tpl->set("showmaxrate", "class=\"hideData\"");
}
else {
    $tpl->set("maximum_rate_of_fire", $maximum_rate_of_fire);
    $tpl->set("showmaxrate", "class=\"showData\"");
}
if(!isset($armour_penetration) || trim($armour_penetration)==='') {
    $tpl->set("showarmourpen", "class=\"hideData\"");
}
else {
    $tpl->set("armour_penetration", $armour_penetration);
    $tpl->set("showarmourpen", "class=\"showData\"");
}
if(!isset($crew) || trim($crew)==='') {
    $tpl->set("showcrew", "class=\"hideData\"");
}
else {
    $tpl->set("crew", $crew);
    $tpl->set("showcrew", "class=\"showData\"");
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

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$db->update('items', 
            array('views' => $views + 1),
            'item_id = ?', array($_GET["itemId"]));

$homepage->Display();