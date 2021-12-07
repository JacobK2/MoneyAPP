<?php
$config_file = "../.config/config.php";
$connect_file = "../.config/connect.php";
if (file_exists("../.config/config.php")) include("../.config/config.php");
if (file_exists("../.config/connect.php")) include("../.config/connect.php");
if (file_exists("../sql/insert.php")) {
    include("../sql/insert.php");
    echo "<p>Wstawiam dane do tabel bazy: ".$db_name.".</p>\n";
    mysqli_select_db($link, $db_name) or die(mysqli_error($link));
    for($i=0;$i<count($insert);$i++){
      echo "<p>".$i.". <code>".$insert[$i]."</code></p>\n";
      mysqli_query($link, $insert[$i]);
    }
    ?>
    <a href="./install5.php">Krok 5</a>
    <?php
}
else {
    echo "<p>Brak pliku sql/insert.php</p>";
    echo "<p><button class=`btn btn-info' onClick='window.location.href=window.location.href'>Odśwież stronę</button></p>";
}
?>