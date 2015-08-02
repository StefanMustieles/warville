<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';

try
{
    //Open database connection
    $db = new Zebra_Database();
    $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

    if($_GET["action"] == "listCountries")
    {
        $count = $db->dcount('country_id', 'countries');

        $db->select('country_id, name, meta_description', 'countries');
        
        //Add all records to an array
        $rows = array();
        while ($row = $db->fetch_assoc()) {
            $rows[] = $row;
        }

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['TotalRecordCount'] = $count;
        $jTableResult['Records'] = $rows;
        print json_encode($jTableResult);
    }
    else if($_GET["action"] == "updateCountries")
    {
        $db->update(
            'countries',
            array(
                'meta_description' => $_POST["meta_description"]
            ),
            'country_id = ?',
            array($_POST["country_id"])
        );
        
        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }
}
catch(Exception $ex)
{
    //Return error message
    $jTableResult = array();
    $jTableResult['Result'] = "ERROR";
    $jTableResult['Message'] = $ex->getMessage();
    print json_encode($jTableResult);
}
