<?php
/**
 * These are the database login details
 * include_once 'db_connect.php';
 * on any php page where you need DB access
 */  
define("HOST", "localhost");     // The host you want to connect to.
define("USER", "root");    // The database username. 
define("PASSWORD", "");    // The database password. 
define("DATABASE", "amsdb");    // The database name.

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

// define("CAN_REGISTER", "any");
// define("DEFAULT_ROLE", "member");

if ($mysqli->connect_error) {
    die("Connection failed: ");
} 
//echo 'Connected to database!'; //debug




?>
