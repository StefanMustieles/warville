<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';

if(isset($_POST['action']) && !empty($_POST['action'])) {
    
    $action = $_POST['action'];
    
    switch($action) {
        case 'categories':
            $country_id = $_POST['country_id'];
            getCategtories($country_id);
            break;
        case 'sub_categories':
            $category_id = $_POST['category_id'];
            getSubCategories($category_id);
            break;
        case 'update_description':
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
            updateDescription($category_id, $description);
            break;
        case 'update_sub_description':
            $sub_category_id = $_POST['sub_category_id'];
            $description = $_POST['description'];
            updateSubDescription($sub_category_id, $description);
            break;
        case 'items':
            $sub_category_id = $_POST['sub_category_id'];
            getItems($sub_category_id);
            break;
        case 'deleteItem':
            $item_id = $_POST['item_id'];
            deleteItems($item_id);
            break;
        case 'insertAFV':
            insertAFV();
            break;
        case 'updateAFV':
            $item_id = $_POST['item_id'];
            updateAFV($item_id);
            break;
        case 'insertArtillery':
            insertArtillery();
            break;
	case 'updateArtillery':
            $item_id = $_POST['item_id'];
            updateArtillery($item_id);
            break;
	case 'insertSupportVehicle':
            insertSupportVehicle();
            break;
	case 'updateSupportVehicle':
            $item_id = $_POST['item_id'];
            updateSupportVehicle($item_id);
            break;
        case 'insertInfantryWeapon':
            insertInfantryWeapon();
            break;
        case 'updateInfantryWeapon':
            $item_id = $_POST['item_id'];
            updateInfantryWeapon($item_id);
            break;
        case 'insertDivision':
            insertDivision();
            break;
        case 'updateDivision':
            $item_id = $_POST['item_id'];
            updateDivision($item_id);
            break;
        case 'insertCompany':
            insertCompany();
            break;
        case 'updateCompany':
            $item_id = $_POST['item_id'];
            updateCompany($item_id);
            break;
    }
}

function getCategtories($country_id) {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    //Get records from database
    $db->select('category_id, name', 'categories', 'country_id = ?', array($country_id));

    //Add all records to an array
    $rows = array();
    while ($row = $db->fetch_assoc()) {
        $rows[] = $row;
    }
    
    print json_encode($rows);
}

function getSubCategories($category_id) {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    //Get records from database
    $db->query(
        'SELECT t1.sub_category_id, t1.name, t2.description FROM sub_categories AS t1 ' 
           . 'INNER JOIN categories AS t2 ON t1.category_id = t2.category_id '
                . 'WHERE t1.category_id = ?', array($category_id)
    );

    //Add all records to an array
    $rows = array();
    while ($row = $db->fetch_assoc()) {
        $rows[] = $row;
    }
    
    print json_encode($rows);
}

function updateDescription($category_id, $description) {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    $db->update(
        'categories',
        array(
            'description' => $description,
        ),
        'category_id = ?',
        array($category_id)
    );
}

function updateSubDescription($sub_category_id, $description) {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    $db->update(
        'sub_categories',
        array(
            'description' => $description,
        ),
        'sub_category_id = ?',
        array($sub_category_id)
    );
}

function getItems($sub_category_id) {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    $db->query('SELECT description ' 
            . 'FROM sub_categories '
            . 'WHERE sub_category_id = ?', array($sub_category_id)
    );

    $elements = array();
    
    while ($row = $db->fetch_assoc()) {
        $elements[] = utf8_encode($row["description"]);							
    }
    
    //Get records from database
    $db->query(
        'SELECT t1.item_id, t1.name, IFNULL(t1.title, "") AS title, t1.friendly_url, IFNULL(t1.thumbnail_image, "") AS thumbnail_image, IFNULL(t1.image_source, "") AS image_source, t1.short_text, IFNULL(t1.year, "") AS year, IFNULL(t1.type, "") AS type, IFNULL(t1.designer, "") AS designer, IFNULL(t1.numbers_produced, "") AS numbers_produced, IFNULL(t1.crew, "") AS crew, IFNULL(t1.main_armament, "") AS main_armament, IFNULL(t1.sponson_traverse, "") AS sponson_traverse, IFNULL(t1.elevation, "") AS elevation, '
            . 'IFNULL(t1.turret_traverse, "") AS turret_traverse, IFNULL(t1.gun_traverse, "") AS gun_traverse, IFNULL(t1.breech, "") AS breech, IFNULL(t1.recoil, "") AS recoil, IFNULL(t1.maximum_range, "") AS maximum_range, IFNULL(t1.armour_penetration, "") AS armour_penetration, IFNULL(t1.secondary_armament, "") AS secondary_armament, IFNULL(t1.smoke_discharger, "") AS smoke_discharger, IFNULL(t1.ammunition_carried, "") AS ammunition_carried, IFNULL(t1.height, "") AS height, IFNULL(t1.width, "") AS width, '
            . 'IFNULL(t1.length, "") AS length, IFNULL(t1.grenade_types, "") AS grenade_types, IFNULL(t1.weight, "") AS weight, IFNULL(t1.ground_clearance, "") AS ground_clearance, IFNULL(t1.fording_depth, "") AS fording_depth, IFNULL(t1.trench_crossing, "") AS trench_crossing, IFNULL(t1.obstacle_clearance, "") AS obstacle_clearance, IFNULL(t1.climbing_ability, "") AS climbing_ability, '
            . 'IFNULL(t1.radio, "") AS radio, IFNULL(t1.armour, "") AS armour, IFNULL(t1.engine, "") AS engine, IFNULL(t1.transmission, "") AS transmission, IFNULL(t1.maximum_road_range, "") AS maximum_road_range, IFNULL(t1.maximum_cross_country_range, "") AS maximum_cross_country_range, IFNULL(t1.maximum_water_range, "") AS maximum_water_range, IFNULL(t1.maximum_water_speed, "") AS maximum_water_speed, IFNULL(t1.maximum_road_speed, "") AS maximum_road_speed, IFNULL(t1.maximum_road_speed, "") AS maximum_road_speed, IFNULL(t1.maximum_cross_country_speed, "") AS maximum_cross_country_speed, '
            . 'IFNULL(t1.maximum_road_speed, "") AS maximum_road_speed, IFNULL(t1.maximum_cross_country_speed, "") AS maximum_cross_country_speed, IFNULL(t1.maximum_road_towing_speed, "") AS maximum_road_towing_speed, IFNULL(t1.calibre, "") AS calibre, IFNULL(t1.barrel_length, "") AS barrel_length, IFNULL(t1.carriage, "") AS carriage, IFNULL(t1.gun_shield, "") AS gun_shield, IFNULL(t1.gun_mounts, "") AS gun_mounts, IFNULL(t1.trailers, "") AS trailers, IFNULL(t1.gun_sight, "") AS gun_sight, IFNULL(t1.blank_cartridge, "") AS blank_cartridge, IFNULL(t1.muzzle_velocity, "") AS muzzle_velocity, '
            . 'IFNULL(t1.fuel_capacity, "") AS fuel_capacity, IFNULL(t1.armoured_plate, "") AS armoured_plate, IFNULL(t1.round_weight, "") AS round_weight, IFNULL(t1.magazine_capacity, "") AS magazine_capacity, IFNULL(t1.maximum_ceiling, "") AS maximum_ceiling, IFNULL(t1.maximum_ground_range, "") AS maximum_ground_range, IFNULL(t1.maximum_rate_of_fire, "") AS maximum_rate_of_fire, IFNULL(t1.bayonet, "") AS bayonet, IFNULL(t1.traction, "") AS traction, '
            . 'IFNULL(t1.pay_load, "") AS pay_load, IFNULL(t1.towed_load, "") AS towed_load, IFNULL(t1.maximum_road_speed_trailer, "") AS maximum_road_speed_trailer, IFNULL(t1.cartridge_weight, "") AS cartridge_weight, IFNULL(t1.operation, "") AS operation, IFNULL(t1.cooling_system, "") AS cooling_system, IFNULL(t1.sights, "") AS sights, IFNULL(t1.feed, "") AS feed, IFNULL(t1.practical_rate_of_fire, "") AS practical_rate_of_fire, IFNULL(t1.rate_of_fire, "") AS rate_of_fire, '
            . 'IFNULL(t1.minimum_range, "") AS minimum_range, IFNULL(t1.effective_range, "") AS effective_range, IFNULL(t1.maximum_range, "") AS maximum_range, IFNULL(t1.variants, "") AS variants, IFNULL(t1.notes, "") AS notes, IFNULL(t1.content, "") AS content '
            . 'FROM `items` AS t1 INNER JOIN sub_categories AS t2 ON t1.sub_category_id = t2.sub_category_id INNER JOIN templates AS t3 ON t1.template_id = t3.template_id '
            . 'WHERE t2.sub_category_id = ?', array($sub_category_id)
    );

    //Add all records to an array
    while ($row = $db->fetch_assoc()) {
        $elements[] = $row;
    }
    
    print json_encode($elements);
}

function deleteItems($item_id) {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
       
    //Delete record from database
    $db->delete('items', 'item_id = ?', array($item_id));
}

function insertAFV() {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    $db->insert(
        'items',
        array(
            'sub_category_id' => $_POST["sub_category_id"],
            'name' => $_POST["name"],
            'title' => $_POST["title"],
            'friendly_url' => $_POST["friendly_url"],
            'thumbnail_image' => $_POST["image"],
            'large_image' => $_POST["image"],
            'image_source' => $_POST["image_source"],
            'short_text' => $_POST["short_text"],
            'template_id' => 1,
            'year' => $_POST["year"],
            'designer' => $_POST["designer"],
            'type' => $_POST["type"],
            'numbers_produced' => $_POST["numbers_produced"],
            'crew' => $_POST["crew"],
            'main_armament' => $_POST["main_armament"],
            'sponson_traverse' => $_POST["sponson_traverse"],
            'elevation' => $_POST["elevation"],
            'turret_traverse' => $_POST["turret_traverse"],
            'gun_traverse' => $_POST["gun_traverse"],
            'gun_mounts' => $_POST["gun_mounts"],
            'maximum_range' => $_POST["maximum_range"],
            'armour_penetration' => $_POST["armour_penetration"],
            'gun_sight' => $_POST["gun_sight"],
            'secondary_armament' => $_POST["secondary_armament"],
            'smoke_discharger' => $_POST["smoke_discharger"],
            'ammunition_carried' => $_POST["ammunition_carried"],
            'height' => $_POST["height"],
            'width' => $_POST["width"],
            'length' => $_POST["length"],
            'weight' => $_POST["weight"],
            'ground_clearance' => $_POST["ground_clearance"],
            'armour_penetration' => $_POST["armour_penetration"],
            'fording_depth' => $_POST["fording_depth"],
            'trench_crossing' => $_POST["trench_crossing"],
            'obstacle_clearance' => $_POST["obstacle_clearance"],
            'climbing_ability' => $_POST["climbing_ability"],
            'radio' => $_POST["radio"],
            'armour' => $_POST["armour"],
            'engine' => $_POST["engine"],
            'transmission' => $_POST["transmission"],
            'maximum_road_range' => $_POST["maximum_road_range"],
            'maximum_cross_country_range' => $_POST["maximum_cross_country_range"],
            'maximum_road_speed' => $_POST["maximum_road_speed"],
            'maximum_water_range' => $_POST["maximum_water_range"],
            'maximum_water_speed' => $_POST["maximum_water_speed"],
            'maximum_cross_country_speed' => $_POST["maximum_cross_country_speed"],
            'variants' => $_POST["variants"],
            'notes' => $_POST["notes"],
        )
    );
}

function updateAFV($item_id) {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    $db->update(
        'items',
        array(
            'name' => $_POST["name"],
            'title' => $_POST["title"],
            'friendly_url' => $_POST["friendly_url"],
            'thumbnail_image' => $_POST["image"],
            'large_image' => $_POST["image"],
            'image_source' => $_POST["image_source"],
            'short_text' => $_POST["short_text"],
            'year' => $_POST["year"],
            'type' => $_POST["type"],
            'designer' => $_POST["designer"],
            'numbers_produced' => $_POST["numbers_produced"],
            'crew' => $_POST["crew"],
            'main_armament' => $_POST["main_armament"],
            'sponson_traverse' => $_POST["sponson_traverse"],
            'elevation' => $_POST["elevation"],
            'turret_traverse' => $_POST["turret_traverse"],
            'gun_traverse' => $_POST["gun_traverse"],
            'gun_mounts' => $_POST["gun_mounts"],
            'maximum_range' => $_POST["maximum_range"],
            'armour_penetration' => $_POST["armour_penetration"],
            'secondary_armament' => $_POST["secondary_armament"],
            'smoke_discharger' => $_POST["smoke_discharger"],
            'ammunition_carried' => $_POST["ammunition_carried"],
            'height' => $_POST["height"],
            'width' => $_POST["width"],
            'length' => $_POST["length"],
            'weight' => $_POST["weight"],
            'ground_clearance' => $_POST["ground_clearance"],
            'armour_penetration' => $_POST["armour_penetration"],
            'fording_depth' => $_POST["fording_depth"],
            'trench_crossing' => $_POST["trench_crossing"],
            'obstacle_clearance' => $_POST["obstacle_clearance"],
            'climbing_ability' => $_POST["climbing_ability"],
            'radio' => $_POST["radio"],
            'armour' => $_POST["armour"],
            'engine' => $_POST["engine"],
            'transmission' => $_POST["transmission"],
            'maximum_road_range' => $_POST["maximum_road_range"],
            'maximum_cross_country_range' => $_POST["maximum_cross_country_range"],
            'maximum_road_speed' => $_POST["maximum_road_speed"],
            'maximum_water_range' => $_POST["maximum_water_range"],
            'maximum_water_speed' => $_POST["maximum_water_speed"],
            'maximum_cross_country_speed' => $_POST["maximum_cross_country_speed"],
            'variants' => $_POST["variants"],
            'notes' => $_POST["notes"],
        ),
        'item_id = ?',
        array($item_id)
    );
}

function insertArtillery() {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    $db->insert(
        'items',
        array(
            'sub_category_id' => $_POST["sub_category_id"],
            'name' => $_POST["name"],
            'title' => $_POST["title"],
            'friendly_url' => $_POST["friendly_url"],
            'thumbnail_image' => $_POST["image"],
            'large_image' => $_POST["image"],
            'image_source' => $_POST["image_source"],
            'short_text' => $_POST["short_text"],
            'template_id' => 3,
            'year' => $_POST["year"],
            'type' => $_POST["type"],
            'designer' => $_POST["designer"],
            'numbers_produced' => $_POST["numbers_produced"],
            'calibre' => $_POST["calibre"],
            'barrel_length' => $_POST["barrel_length"],
            'carriage' => $_POST["carriage"],
            'gun_shield' => $_POST["gun_shield"],
            'height' => $_POST["height"],
            'width' => $_POST["width"],
            'length' => $_POST["length"],
            'gun_mounts' => $_POST["gun_mounts"],
            'trailers' => $_POST["trailers"],
            'elevation' => $_POST["elevation"],
            'turret_traverse' => $_POST["turret_traverse"],
            'breech' => $_POST["breech"],
            'recoil' => $_POST["recoil"],
            'gun_sight' => $_POST["gun_sight"],
            'muzzle_velocity' => $_POST["muzzle_velocity"],
            'feed' => $_POST["feed"],
            'practical_rate_of_fire' => $_POST["practical_rate_of_fire"],
            'armoured_plate' => $_POST["armoured_plate"],
            'weight' => $_POST["weight"],
            'round_weight' => $_POST["round_weight"],
            'magazine_capacity' => $_POST["magazine_capacity"],
            'maximum_ceiling' => $_POST["maximum_ceiling"],
            'maximum_range' => $_POST["maximum_range"],
            'maximum_ground_range' => $_POST["maximum_ground_range"],
            'rate_of_fire' => $_POST["rate_of_fire"],
            'maximum_rate_of_fire' => $_POST["maximum_rate_of_fire"],
            'armour_penetration' => $_POST["armour_penetration"],
            'crew' => $_POST["crew"],
            'traction' => $_POST["traction"],
            'variants' => $_POST["variants"],
            'notes' => $_POST["notes"],
        )
    );
}

function updateArtillery($item_id) {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    $db->update(
        'items',
        array(
            'name' => $_POST["name"],
            'title' => $_POST["title"],
            'friendly_url' => $_POST["friendly_url"],
            'thumbnail_image' => $_POST["image"],
            'large_image' => $_POST["image"],
            'image_source' => $_POST["image_source"],
            'short_text' => $_POST["short_text"],
            'year' => $_POST["year"],
            'type' => $_POST["type"],
            'designer' => $_POST["designer"],
            'numbers_produced' => $_POST["numbers_produced"],
            'calibre' => $_POST["calibre"],
            'barrel_length' => $_POST["barrel_length"],
            'carriage' => $_POST["carriage"],
            'gun_shield' => $_POST["gun_shield"],
            'height' => $_POST["height"],
            'width' => $_POST["width"],
            'length' => $_POST["length"],
            'gun_mounts' => $_POST["gun_mounts"],
            'trailers' => $_POST["trailers"],
            'elevation' => $_POST["elevation"],
            'turret_traverse' => $_POST["turret_traverse"],
            'breech' => $_POST["breech"],
            'recoil' => $_POST["recoil"],
            'gun_sight' => $_POST["gun_sight"],
            'muzzle_velocity' => $_POST["muzzle_velocity"],
            'feed' => $_POST["feed"],
            'practical_rate_of_fire' => $_POST["practical_rate_of_fire"],
            'armoured_plate' => $_POST["armoured_plate"],
            'weight' => $_POST["weight"],
            'round_weight' => $_POST["round_weight"],
            'magazine_capacity' => $_POST["magazine_capacity"],
            'maximum_ceiling' => $_POST["maximum_ceiling"],
            'maximum_range' => $_POST["maximum_range"],
            'maximum_ground_range' => $_POST["maximum_ground_range"],
            'rate_of_fire' => $_POST["rate_of_fire"],
            'maximum_rate_of_fire' => $_POST["maximum_rate_of_fire"],
            'armour_penetration' => $_POST["armour_penetration"],
            'crew' => $_POST["crew"],
            'traction' => $_POST["traction"],
            'variants' => $_POST["variants"],
            'notes' => $_POST["notes"],
        ),
        'item_id = ?',
        array($item_id)
    );
}

function insertSupportVehicle() {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    $db->insert(
        'items',
        array(
            'sub_category_id' => $_POST["sub_category_id"],
            'name' => $_POST["name"],
            'title' => $_POST["title"],
            'friendly_url' => $_POST["friendly_url"],
            'thumbnail_image' => $_POST["image"],
            'large_image' => $_POST["image"],
            'image_source' => $_POST["image_source"],
            'short_text' => $_POST["short_text"],
            'template_id' => 4,
            'year' => $_POST["year"],
            'type' => $_POST["type"],
            'designer' => $_POST["designer"],
            'numbers_produced' => $_POST["numbers_produced"],
            'crew' => $_POST["crew"],
            'barrel_length' => $_POST["barrel_length"],
            'main_armament' => $_POST["main_armament"],
            'ammunition_carried' => $_POST["ammunition_carried"],
            'pay_load' => $_POST["pay_load"],
            'towed_load' => $_POST["towed_load"],
            'weight' => $_POST["weight"],
            'height' => $_POST["height"],
            'width' => $_POST["width"],
            'length' => $_POST["length"],
            'ground_clearance' => $_POST["ground_clearance"],
            'fording_depth' => $_POST["fording_depth"],
            'obstacle_clearance' => $_POST["obstacle_clearance"],
            'trench_crossing' => $_POST["trench_crossing"],
            'climbing_ability' => $_POST["climbing_ability"],
            'radio' => $_POST["radio"],
            'armour' => $_POST["armour"],
            'engine' => $_POST["engine"],
            'transmission' => $_POST["transmission"],
            'maximum_road_range' => $_POST["maximum_road_range"],
            'maximum_cross_country_range' => $_POST["maximum_cross_country_range"],
            'maximum_road_speed' => $_POST["maximum_road_speed"],
            'maximum_road_speed_trailer' => $_POST["maximum_road_speed_trailer"],
            'maximum_cross_country_speed' => $_POST["maximum_cross_country_speed"],
            'maximum_road_towing_speed' => $_POST["maximum_road_towing_speed"],
            'variants' => $_POST["variants"],
            'notes' => $_POST["notes"],
        )
    );
}

function updateSupportVehicle($item_id) {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    $db->update(
        'items',
        array(
            'name' => $_POST["name"],
            'title' => $_POST["title"],
            'friendly_url' => $_POST["friendly_url"],
            'thumbnail_image' => $_POST["image"],
            'large_image' => $_POST["image"],
            'image_source' => $_POST["image_source"],
            'short_text' => $_POST["short_text"],
            'year' => $_POST["year"],
            'type' => $_POST["type"],
            'designer' => $_POST["designer"],
            'numbers_produced' => $_POST["numbers_produced"],
            'crew' => $_POST["crew"],
            'barrel_length' => $_POST["barrel_length"],
            'main_armament' => $_POST["main_armament"],
            'ammunition_carried' => $_POST["ammunition_carried"],
            'pay_load' => $_POST["pay_load"],
            'towed_load' => $_POST["towed_load"],
            'weight' => $_POST["weight"],
            'height' => $_POST["height"],
            'width' => $_POST["width"],
            'length' => $_POST["length"],
            'ground_clearance' => $_POST["ground_clearance"],
            'fording_depth' => $_POST["fording_depth"],
            'obstacle_clearance' => $_POST["obstacle_clearance"],
            'trench_crossing' => $_POST["trench_crossing"],
            'climbing_ability' => $_POST["climbing_ability"],
            'radio' => $_POST["radio"],
            'armour' => $_POST["armour"],
            'engine' => $_POST["engine"],
            'transmission' => $_POST["transmission"],
            'maximum_road_range' => $_POST["maximum_road_range"],
            'maximum_cross_country_range' => $_POST["maximum_cross_country_range"],
            'maximum_road_speed' => $_POST["maximum_road_speed"],
            'maximum_road_speed_trailer' => $_POST["maximum_road_speed_trailer"],
            'maximum_cross_country_speed' => $_POST["maximum_cross_country_speed"],
            'maximum_road_towing_speed' => $_POST["maximum_road_towing_speed"],
            'variants' => $_POST["variants"],
            'notes' => $_POST["notes"],
        ),
        'item_id = ?',
        array($item_id)
    );
}

function insertInfantryWeapon() {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    $db->insert(
        'items',
        array(
            'sub_category_id' => $_POST["sub_category_id"],
            'name' => $_POST["name"],
            'title' => $_POST["title"],
            'friendly_url' => $_POST["friendly_url"],
            'thumbnail_image' => $_POST["image"],
            'large_image' => $_POST["image"],
            'image_source' => $_POST["image_source"],
            'short_text' => $_POST["short_text"],
            'template_id' => 2,
            'year' => $_POST["year"],
            'type' => $_POST["type"],
            'designer' => $_POST["designer"],
            'numbers_produced' => $_POST["numbers_produced"],
            'crew' => $_POST["crew"],
            'calibre' => $_POST["calibre"],
            'elevation' => $_POST["elevation"], 
            'gun_traverse' => $_POST["gun_traverse"], 
            'cartridge_weight' => $_POST["cartridge_weight"],
            'round_weight' => $_POST["round_weight"],
            'barrel_length' => $_POST["barrel_length"],
            'length' => $_POST["length"],
            'grenade_types' => $_POST["grenade_types"],
            'gun_mounts' => $_POST["gun_mounts"],
            'weight' => $_POST["weight"],
            'operation' => $_POST["operation"],
            'cooling_system' => $_POST["cooling_system"],
            'sights' => $_POST["sights"],
            'feed' => $_POST["feed"],
            'rate_of_fire' => $_POST["rate_of_fire"],
            'maximum_rate_of_fire' => $_POST["maximum_rate_of_fire"],
            'blank_cartridge' => $_POST["blank_cartridge"],
            'muzzle_velocity' => $_POST["muzzle_velocity"],
            'fuel_capacity' => $_POST["fuel_capacity"],
            'minimum_range' => $_POST["minimum_range"],
            'effective_range' => $_POST["effective_range"],
            'maximum_range' => $_POST["maximum_range"],
            'armour_penetration' => $_POST["armour_penetration"],
            'bayonet' => $_POST["bayonet"],
            'traction' => $_POST["traction"],
            'variants' => $_POST["variants"],
            'notes' => $_POST["notes"],
        )
    );
}

function updateInfantryWeapon($item_id) {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    $db->update(
        'items',
        array(
            'name' => $_POST["name"],
            'title' => $_POST["title"],
            'friendly_url' => $_POST["friendly_url"],
            'thumbnail_image' => $_POST["image"],
            'large_image' => $_POST["image"],
            'image_source' => $_POST["image_source"],
            'short_text' => $_POST["short_text"],
            'year' => $_POST["year"],
            'type' => $_POST["type"],
            'designer' => $_POST["designer"],
            'numbers_produced' => $_POST["numbers_produced"],
            'crew' => $_POST["crew"],
            'calibre' => $_POST["calibre"],
            'elevation' => $_POST["elevation"], 
            'gun_traverse' => $_POST["gun_traverse"], 
            'cartridge_weight' => $_POST["cartridge_weight"],
            'round_weight' => $_POST["round_weight"],
            'barrel_length' => $_POST["barrel_length"],
            'length' => $_POST["length"],
            'grenade_types' => $_POST["grenade_types"],
            'gun_mounts' => $_POST["gun_mounts"],
            'weight' => $_POST["weight"],
            'operation' => $_POST["operation"],
            'cooling_system' => $_POST["cooling_system"],
            'sights' => $_POST["sights"],
            'feed' => $_POST["feed"],
            'rate_of_fire' => $_POST["rate_of_fire"],
            'maximum_rate_of_fire' => $_POST["maximum_rate_of_fire"],
            'blank_cartridge' => $_POST["blank_cartridge"],
            'muzzle_velocity' => $_POST["muzzle_velocity"],
            'fuel_capacity' => $_POST["fuel_capacity"],
            'minimum_range' => $_POST["minimum_range"],
            'effective_range' => $_POST["effective_range"],
            'maximum_range' => $_POST["maximum_range"],
            'armour_penetration' => $_POST["armour_penetration"],
            'bayonet' => $_POST["bayonet"],
            'traction' => $_POST["traction"],
            'variants' => $_POST["variants"],
            'notes' => $_POST["notes"],
        ),
        'item_id = ?',
        array($item_id)
    );
}

function insertDivision() {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    $db->insert(
        'items',
        array(
            'sub_category_id' => $_POST["sub_category_id"],
            'name' => $_POST["name"],
            'title' => $_POST["title"],
            'friendly_url' => $_POST["friendly_url"],
            'thumbnail_image' => $_POST["image"],
            'large_image' => $_POST["image"],
            'image_source' => $_POST["image_source"],
            'short_text' => $_POST["short_text"],
            'template_id' => 6,
            'content' => $_POST["content"],
        )
    );
}

function updateDivision($item_id) {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    $db->update(
        'items',
        array(
            'name' => $_POST["name"],
            'title' => $_POST["title"],
            'friendly_url' => $_POST["friendly_url"],
            'thumbnail_image' => $_POST["image"],
            'large_image' => $_POST["image"],
            'image_source' => $_POST["image_source"],
            'short_text' => $_POST["short_text"],
            'content' => $_POST["content"],
        ),
        'item_id = ?',
        array($item_id)
    );
}

function insertCompany() {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    $db->insert(
        'items',
        array(
            'sub_category_id' => $_POST["sub_category_id"],
            'name' => $_POST["name"],
            'title' => $_POST["title"],
            'friendly_url' => $_POST["friendly_url"],
            'thumbnail_image' => $_POST["image"],
            'large_image' => $_POST["image"],
            'image_source' => $_POST["image_source"],
            'short_text' => $_POST["short_text"],
            'template_id' => 5,
            'content' => $_POST["content"],
        )
    );
}

function updateCompany($item_id) {
    
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    $db->update(
        'items',
        array(
            'name' => $_POST["name"],
            'title' => $_POST["title"],
            'friendly_url' => $_POST["friendly_url"],
            'thumbnail_image' => $_POST["image"],
            'large_image' => $_POST["image"],
            'image_source' => $_POST["image_source"],
            'short_text' => $_POST["short_text"],
            'content' => $_POST["content"],
        ),
        'item_id = ?',
        array($item_id)
    );
}