<?php
$host       = "192.168.5.36";
$username   = "master";
$password   = "";
$dbname     = "shose_master"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname;port=3306"; // will use later
$options    = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
?>