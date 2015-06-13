<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once 'db.php';

function login_check() {
    // Check if all session variables are set 
    if (isset($_SESSION['user_id'], $_SESSION['level'])) {
 
        $user_id = $_SESSION['user_id'];
        $setLevel= $_SESSION['level'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        
        $db = new Zebra_Database();
        $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $count = $db->select('Password, Level', 'tbMembers', 'CrewNumber = ?', array($user_id));

        if ($count->num_rows == 1) {
            // If the user exists get variables from result.
            while ($row = $db->fetch_assoc()) {
                // Register $level and redirect to admin area
                $password = $row['Password'];
                $level = $row['Level'];
            
                if ($setLevel == $level) {
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            }
        } else {
            // Not logged in 
            return false;
        }
    } else {
        // Not logged in 
        return false;
    }
}
