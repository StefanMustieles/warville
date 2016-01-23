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
                'meta_description' => $_POST["meta_description"],
                'page_title' => $_POST["page_title"]
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

        $db->query('SELECT t1.category_id, t2.name AS country, t1.name AS category, t1.short_description, t1.description, t1.meta_description
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
                'short_description' => $_POST["short_description"],
                'description' => $_POST["description"],
                'meta_description' => $_POST["meta_description"],
                'page_title' => $_POST["page_title"]
            ),
            'category_id = ?',
            array($_POST["category_id"])
        );
        
        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }
    else if($_GET["action"] == "listSubCategories")
    {
        $count = $db->dcount('sub_category_id', 'sub_categories');

        $db->query('SELECT t1.sub_category_id, t3.name AS country, t2.name AS category, t1.name AS sub_category, t1.description, t1.seo_url, t1.meta_description, t1.page_title '
                . 'FROM sub_categories AS t1 '
                . 'INNER JOIN categories AS t2 ON t1.category_id = t2.category_id '
                . 'INNER JOIN countries AS t3 ON t2.country_id = t3.country_id');
        
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
    else if($_GET["action"] == "updateSubCategories")
    {
        $db->update(
            'sub_categories',
            array(
                'description' => $_POST["description"],
                'seo_url' => $_POST["seo_url"],
                'meta_description' => $_POST["meta_description"],
                'page_title' => $_POST["page_title"]
            ),
            'sub_category_id = ?',
            array($_POST["sub_category_id"])
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
