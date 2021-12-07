<?php

    session_start();
    if ((!isset($_POST['email'])) || (!isset($_POST['password'])))
    {
        header('Location: login.php');
        exit();
    }
    if (file_exists(".config/connect.php")) require_once(".config/connect.php");

    if($link->connect_errno!=0)
    {
        echo "Error: ".$link->connect_errno;
    }
    else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email = htmlentities($email, ENT_QUOTES, "UTF-8");

        if($rezultat = @$link->query(sprintf("SELECT * FROM `users` WHERE `email` = '%s' AND `isActive` = '1'",mysqli_real_escape_string($link,$email))))
        {
            $ilu_userow = $rezultat->num_rows;
            if ($ilu_userow>0) {
                $wiersz = $rezultat->fetch_assoc();

                if (password_verify($password, $wiersz['password'])) 
                {
                    $_SESSION['zalogowany'] = true;                
                    $_SESSION['id'] = $wiersz['id'];
                    $_SESSION['imie'] = $wiersz['imie'];
                    $_SESSION['nazwisko'] = $wiersz['nazwisko'];
                    $_SESSION['email'] = $wiersz['email'];
                    $_SESSION['isAdmin'] = $wiersz['isAdmin'];
                    $_SESSION['isActive'] = $wiersz['isActive'];

                    unset($_SESSION['loginError']);
                    $rezultat->free_result();
                    header('Location: dashboard.php');
                } else {
                    $_SESSION['loginError'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                    header('Location: login.php');  
                }
            } else {
                $_SESSION['loginError'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                header('Location: login.php');  
            }
        }
        $link->close();
    }



?>