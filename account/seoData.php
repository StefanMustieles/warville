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
    else if($_GET["action"] == "listCategories")
    {
        $count = $db->dcount('category_id', 'categories');

        $db->query('SELECT t2.name AS country, t1.name AS category, t1.description, t1.meta_description
                    FROM categories AS t1 INNER JOIN countries AS t2 ON t1.country_id = t2.country_id');
        
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
    else if($_GET["action"] == "updateCategories")
    {
        $db->update(
            'categories',
            array(
                'description' => $_POST["description"],
                'meta_description' => $_POST["meta_description"]
            ),
            'category_id = ?',
            array($_POST["category_id"])
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
