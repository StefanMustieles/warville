<?php

require_once '../config/dbconfig.php'; 
require_once 'db.php';

function LogSuccessfulLogin($crewnumber)
{
    //Test if it is a shared client
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    
    }//Is it a proxy address
    else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else{
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    //The value of $ip at this point would look something like: "192.0.34.166"
    $ip = ip2long($ip);
    //The $ip would now look something like: 1073732954
    
    //Insert logged data to db
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    $db->insert(
        'tbLogs',
        array(
            'Username' => $crewnumber,
            'IPAddress' => $ip,
        )
    );
}

