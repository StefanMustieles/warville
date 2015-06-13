<?php

ob_start();
require_once '../config/dbconfig.php'; 
require_once 'db.php';
require_once 'logging.php';

$user = $_POST['crewnumber'];
$pass = $_POST['password'];

if(isset($user, $pass)) {
    session_start();
    {
        $msg ='';

        $db = new Zebra_Database();
        $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $count = $db->select('Level', 'tbMembers', 'CrewNumber = ? AND Password = ?', array($user, $pass));

        if($count->num_rows == 1)
        {
            LogSuccessfulLogin($user);

            while ($row = $db->fetch_assoc()) {
                // Register $level and redirect to admin area
            
            $level = $row['Level'];
            $_SESSION['level'] = $level;
            $_SESSION['user_id'] = $user;
        
                switch ($level) 
                {
                            case "0":
                                header("location:../account/adminservices.php");
                                break;
                            case "1":
                                header("location:../account/adminfiles.php");
                                break;
                            case "2":
                                header("location:../account/adminfiles.php");
                                break;
                            case "3":
                                header("location:../account/adminfiles.php");
                                break;
                }
            }
        }
        else
        {
           $msg = "Wrong Username or Password";
           header("Location:../login.php?msg=$msg");
        }
    }
}
else {
    header("Location:../login.php?msg=Please enter a username and password");
}
ob_end_flush();