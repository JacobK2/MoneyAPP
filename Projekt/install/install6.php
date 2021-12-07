<?php
$config_file = "../.config/config.php";
$connect_file = "../.config/connect.php";
if (file_exists("../.config/config.php")) include("../.config/config.php");
if (file_exists("../.config/connect.php")) include("../.config/connect.php");
function step6(){
    $config_file = "../.config/config.php";
$connect_file = "../.config/connect.php";
if (file_exists("../.config/config.php")) include("../.config/config.php");
if (file_exists("../.config/connect.php")) include("../.config/connect.php");
    $file2=fopen($config_file,"w");
    $config = "<?php \n//Konfiguracja aplikacji\n
        \$url=\"".$_POST['url']."\";
        \$nazwa_aplikacji=\"".$_POST['nazwa_aplikacji']."\";
        \$data_utworzenia=\"".$_POST['data_utworzenia']."\";
        \$wersja=\"".$_POST['wersja']."\";
        \$brand=\"".$_POST['brand']."\";
        \$siedziba=\"".$_POST['siedziba']."\";
        \$phone=\"".$_POST['phone']."\";
        \$qr=\"".$_POST['url']."img/QR.jpg\";
        \$dev= 1;\n?>";
        if (is_writable($config_file)) {
            if (!$handle = fopen($config_file, 'a')) {
                 echo "Nie mogę otworzyć pliku ($config_file)";
                 echo "<p><a href=\"#\">Odśwież stronę</button></p>";
                 exit;
            }
            if (fwrite($handle, $config) === FALSE) {
                echo "Nie mogę zapisać do pliku ($config_file)";
                echo "<p><a href=\"#\">Odśwież stronę</button></p>";
                exit;
            }
            echo "Sukces, zapisano (<code>konfigurację</code>) do pliku (".$config_file.")"; 
            echo "<a href=\"./install7.php\">Krok 7</a>";
            fclose($handle);
        
        } else {
            echo "Plik $config_file jest niezapisywalny.";
        }
    }

    if (!empty($_POST['nazwa_aplikacji']) && !empty($_POST['data_utworzenia']) && !empty($_POST['wersja']) && !empty($_POST['brand']) && !empty($_POST['siedziba']) && !empty($_POST['phone'])){
        step6();
        exit();
    }
    else {
        header('Location: install5.php');  
    }
?>