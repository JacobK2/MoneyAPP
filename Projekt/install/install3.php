<?php
$config_file = "../.config/config.php";
$connect_file = "../.config/connect.php";
if (file_exists("../.config/config.php")) include("../.config/config.php");
if (file_exists("../.config/connect.php")) include("../.config/connect.php");
if (file_exists("../sql/sql.php")) {
    include("../sql/sql.php");
    echo "Tworzę tabele bazy: ".$db_name.".<br>\n";
    echo "<a href=\"./install4.php\">Krok 4</a>";
    mysqli_select_db($link, $db_name) or die(mysqli_error($link));
    for($i=0;$i<count($create);$i++){
        echo "<p>".$i.". <code>".$create[$i]."</code></p>\n";
        mysqli_query($link, $create[$i]);
    }
    echo "<a href=\"./install4.php\">Krok 4</a>";
}
else{
    echo "<p>Brak pliku ../sql/sql.php</p>";
    echo "<p><button class=`btn btn-info' onClick='window.location.href=window.location.href'>Odśwież stronę</button></p>";
    exit;
}
?>