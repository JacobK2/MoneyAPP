<?php
$config_file = "../.config/config.php";
$connect_file = "../.config/connect.php";
if (file_exists("../.config/config.php")) include("../.config/config.php");
if (file_exists("../.config/connect.php")) include("../.config/connect.php");
$connect = "<?php
\$host=\"".$_POST['host']."\";
\$db_user=\"".$_POST['db_user']."\";
\$db_password=\"".$_POST['db_password']."\";
\$db_name=\"".$_POST['db_name']."\";
\$prefix=\"\";
\$link = @new mysqli(\$host, \$db_user, \$db_password, \$db_name);\n
?>";
function step2(){
    $config_file = "../.config/config.php";
$connect_file = "../.config/connect.php";
if (file_exists("../.config/config.php")) include("../.config/config.php");
if (file_exists("../.config/connect.php")) include("../.config/connect.php");
$connect = "<?php
\$host=\"".$_POST['host']."\";
\$db_user=\"".$_POST['db_user']."\";
\$db_password=\"".$_POST['db_password']."\";
\$db_name=\"".$_POST['db_name']."\";
\$prefix=\"\";\n
// Create connection\n
\$link = @new mysqli(\$host, \$db_user, \$db_password, \$db_name);\n
// Check connection\n
if (\$link->connect_error) {\n
    die(\"Connection failed: \" . \$link->connect_error);\n
}\n
// echo \"Connected successfully\";
?>";
    if (is_writable($connect_file)) {
        if (!$handle = fopen($connect_file, 'w')) {
             echo "Nie mogę otworzyć pliku ($connect_file)";
             echo "<p><a href=\"#\">Odśwież stronę</button></p>";
             exit;
        }
        if (fwrite($handle, $connect) === FALSE) {
            echo "Nie mogę zapisać do pliku ($connect_file)";
            echo "<p><a href=\"#\">Odśwież stronę</button></p>";
            exit;
        }
        echo "Krok 2 zakończony zapisano do pliku: ($connect_file)\n<a href=\"./install3.php\">Krok 3</a>";
        fclose($handle);
    } 
    else {
        echo "Plik $connect_file jest niezapisywalny.";
    }

}

if (!empty($_POST['host']) && !empty($_POST['db_user']) && !empty($_POST['db_password']) && !empty($_POST['db_name'])){
    step2();
    exit();
}
else{
    header('Location: ../install.php');
    exit();
}
?>