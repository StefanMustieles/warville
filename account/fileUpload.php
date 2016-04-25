<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/KLogger.php';

$db = new Zebra_Database();

$db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

$db->query('SELECT t2.folder_name AS country, t1.folder_name '
        . 'FROM categories AS t1 INNER JOIN countries AS t2 ON t1.country_id = t2.country_id '
        . 'WHERE t2.country_id = ? AND t1.category_id = ?', array($_POST['country'], $_POST['maincategory'])
);
												
while ($row = $db->fetch_assoc()) {						
    $country = $row["country"];
    $category = $row["folder_name"];
}

$log = new KLogger($_SERVER['DOCUMENT_ROOT'] . "/logs/log.txt", KLogger::DEBUG);

if(move_uploaded_file($_FILES["filename"]["tmp_name"], "../" . strtolower($country) . "/" . $category . "/img/" . $_FILES["filename"]["name"])) 
{
    $log->LogDebug("File uploaded correctly. " . "../" . strtolower($country) . "/" . $category . "/img/" . $_FILES["filename"]["name"]);
} 
else
{
    $log->LogDebug("File didn't upload. " . "../" . strtolower($country) . "/" . $category . "/img/" . $_FILES["filename"]["name"]);$log->LogDebug(is_writable("../" . strtolower($country) . "/" . $category . "/img/"));
}