<?php
  session_start();
  if (!file_exists(".config/config.php")){
    header('Location: install.php');
    exit();
}
if (!file_exists(".config/connect.php")){
    header('Location: install.php');
    exit();
}
  
  if (file_exists(".config/config.php")) include_once(".config/config.php");
  if ($dev == 1){
    ini_set( 'display_errors', 'On' );
    error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
  }
  if (file_exists(".config/connect.php")) require_once(".config/connect.php");
  
  if (!isset($_SESSION['zalogowany'])) {
      header('Location: index.php');
      exit();
  }

  if (file_exists("dash_header.php")) include("dash_header.php");
  if (file_exists("dash_middle.php")) include("dash_middle.php");
  if (file_exists("dash_footer.php")) include("dash_footer.php");

?>

