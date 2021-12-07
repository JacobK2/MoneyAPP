<?php
  session_start();
  
  if (file_exists(".config/config.php")) include_once(".config/config.php");
  if (!file_exists(".config/config.php")){
    header('Location: install.php');
    exit();
  }
  if ($dev == 1){
    ini_set( 'display_errors', 'On' );
    error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
  }
  
  if (file_exists(".config/connect.php")) require_once(".config/connect.php");
  if (!file_exists(".config/connect.php")){
    header('Location: install.php');
    exit();
  }
  if (file_exists("header.php")) include("header.php");
  if (file_exists("middle.php")) include("middle.php");
  if (file_exists("footer.php")) include("footer.php");
?>