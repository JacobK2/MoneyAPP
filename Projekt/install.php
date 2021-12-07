<?php
$config_file = ".config/config.php";
$connect_file = ".config/connect.php";
if (file_exists(".config/config.php")) include(".config/config.php");
if (file_exists(".config/connect.php")) include(".config/connect.php");

function form_install_1(){
?>
<!DOCTYPE html>
<html lang="pl">

    <head>
    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Install Strona główna">
        <meta name="author" content="Jakub Karalus">
    
        <title>Install</title>
    </head>
    <div class="col-6" style="margin:auto">
        <h1>Instalator : KROK1</h1>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

            <form action="install/install2.php" method="POST">
            <input type="hidden" name="prefix" value="">
                <div class="form-group row">
                    <label class="col-5 col-form-label" for="host">Nazwa lub adres serwera</label> 
                    <div class="col-7">
                        <input id="host" name="host" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="db_user" class="col-5 col-form-label">Nazwa użytkownika</label> 
                        <div class="col-7">
                            <input id="db_user" name="db_user" type="text" class="form-control">
                        </div>
                </div>
                <div class="form-group row">
                    <label for="db_password" class="col-5 col-form-label">Hasło</label> 
                        <div class="col-7">
                            <input id="db_password" name="db_password" type="text" class="form-control">
                        </div>
                </div>
                <div class="form-group row">
                    <label for="db_name" class="col-5 col-form-label">Nazwa bazy danych</label> 
                        <div class="col-7">
                            <input id="db_name" name="db_name" type="text" class="form-control">
                        </div>
                </div>
                <!-- <div class="form-group row">
                    <label for="prefix" class="col-5 col-form-label">Prefix tabeli</label> 
                        <div class="col-7">
                    <input id="prefix" name="prefix" type="text" class="form-control">
                    </div>
                </div>  -->
                <button type="submit" class="btn btn-primary btn-user btn-block">Krok 2</button>
        </form>
    </div>
</body>
    
</html>
<?php
}

if(file_exists($config_file) && file_exists($connect_file)){
    if(is_writable($config_file) && is_writable($connect_file)){
        form_install_1();
        exit();  
    }
    else {
        echo "<h1>Instalator : KROK 1</h1>";
        echo "<p>Zmień uprawnienia do pliku <code>".$config_file."</code><br>np. <code>chmod o+w ".$config_file."</code></p>";
        echo "<p>Zmień uprawnienia do pliku <code>".$connect_file."</code><br>np. <code>chmod o+w ".$connect_file."</code></p>";
        echo "<p><button class=`btn btn-info' onClick='window.location.href=window.location.href'>Odśwież stronę</button></p>";
    }
}
else{
    echo "<h1>Instalator : KROK 1</h1>";
    echo "<p>Stwórz plik <code>".$config_file."</code><br>np. <code>touch ".$config_file."</code></p>";
    echo "<p>Stwórz plik <code>".$connect_file."</code><br>np. <code>touch ".$connect_file."</code></p>";
    echo "<p><button class=`btn btn-info' onClick='window.location.href=window.location.href'>Odśwież stronę</button></p>";
}
?>