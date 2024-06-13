<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$server_name = 'localhost';
$db_user_name = 'xxUSERNAMExx';
$db_password = 'xxPSWxx';
$database_name = 'xxDBNAMExx';

$conn = mysqli_connect($server_name, $db_user_name, $db_password, $database_name);

if(!$conn) {
    die();
}

