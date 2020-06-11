<?php
$host       = "localhost";
$username   = "master";
$password   = "";
$dbname     = "shoes_master"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
$options    = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
?>