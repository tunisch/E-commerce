<?php
session_start();
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["admin_username"]) || $_SESSION["admin_id"] === null){
    header("Location: admin_login.php");
    exit;
}
?>