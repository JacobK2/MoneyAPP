<?php
$host="localhost";
$db_user="jkaralus";
$db_password="380950";
$db_name="jkaralus";
$prefix="";

// Create connection

$link = @new mysqli($host, $db_user, $db_password, $db_name);

// Check connection

if ($link->connect_error) {

    die("Connection failed: " . $link->connect_error);

}

// echo "Connected successfully";
?>