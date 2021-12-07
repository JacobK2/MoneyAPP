<?php
    session_start();
    if (file_exists(".config/config.php")) include_once(".config/config.php");
    if (!file_exists(".config/config.php")){
        header('Location: install.php');
        exit();
    }
    if (!file_exists(".config/connect.php")){
        header('Location: install.php');
        exit();
    }
    if (isset($_SESSION['zalogowany'])) {
        header('Location: dashboard.php');
        exit();
    }

    if (isset($_POST['email']))
    {
        //Założenie udanej walidacji
        $validation=true;

        //Sprawdź poprawność imienia
        $imie = $_POST['imie'];

        //Sprawdzenie długości imienia
        if ((strlen($imie)<3) || (strlen($imie)>50)) {
            $validation = false;
            $_SESSION['e_imie'] = "Imię musi posiadać od 3 do 50 znaków!";
        }

        //Sprawdzenie poprawności nazwiska
        $nazwisko = $_POST['nazwisko'];
        //Sprawdzenie długości nazwiska
        if ((strlen($nazwisko)<3) || (strlen($nazwisko)>100)) {
            $validation = false;
            $_SESSION['e_imie'] = "Nazwisko musi posiadać od 3 do 100 znaków!";
        }

        //Sprawdź poprawność emaila
        $email = $_POST['email'];
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

        if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email)) {
            $validation=false;
            $_SESSION['e_email']="Podaj poprawny adres e-mail!";
        }

        //Sprawdź poprawność hasła
        $haslo1 = $_POST['password1'];
        $haslo2 = $_POST['password2'];

        if ((strlen($haslo1)<4) || (strlen($haslo1)>20)) {
            $validation=false;
            $_SESSION['e_haslo'] = "Hasło musi posiadać od 4 do 20 znaków!";
        }

        if ($haslo1!=$haslo2) {
            $validation=false;
            $_SESSION['e_haslo'] = "Podane hasła nie są identyczne!";
        }

        $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);


        if (file_exists(".config/connect.php")) require_once(".config/connect.php");

        mysqli_report(MYSQLI_REPORT_STRICT);

        try {
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if($polaczenie->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }
            else {
                $rezultat = $polaczenie->query("SELECT id FROM users WHERE email='$email'");

                if (!$rezultat) {
                    throw new Exception($polaczenie->error);
                }
                $ile_takich_maili = $rezultat->num_rows;
                if ($ile_takich_maili>0) {
                    $validation=false;
                    $_SESSION['e_email']="Istnieje już takie konto!";
                }
                if($validation==true){
                    if ($polaczenie->query("INSERT INTO users VALUES (NULL, '$imie', '$nazwisko', '$email', '$haslo_hash', 1, 1)")) {
                        $_SESSION['udanarejestracja']=true;
                        header("Location: login.php");
                    }
                    else {
                        throw new Exception($polaczenie->error);
                    }
                }

                $polaczenie->close();
            }
        } catch (Exception $ex) {
            $_SESSION['e_ex']= 'Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!';
            if ($dev == 1) {
                $_SESSION['e_ex'].= '<br />Informacja deweloperska: '.$ex;
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="pl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php $brand; ?> Strona główna">
    <meta name="author" content="Jakub Karalus">

    <title><?php echo $brand; ?> Rejestracja</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Stwórz konto!</h1>
                            </div>
                            <form class="user" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="imie" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Imię" required>
                                            <?php 
                                            
                                            if (isset($_SESSION['e_imie'])) {
                                                echo '<p class="text-danger">'.$_SESSION['e_imie'].'</p>';
                                                unset($_SESSION['e_imie']);
                                            }
                                            
                                            ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="nazwisko" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Nazwisko" required>
                                            <?php 
                                            if (isset($_SESSION['e_nazwisko'])) {
                                                echo '<p class="text-danger">'.$_SESSION['e_nazwisko'].'</p>';
                                                unset($_SESSION['e_nazwisko']);
                                            }
                                            ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name ="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email" required>
                                        <?php 
                                            if (isset($_SESSION['e_email'])) {
                                                echo '<p class="text-danger">'.$_SESSION['e_email'].'</p>';
                                                unset($_SESSION['e_email']);
                                            }
                                        ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password1" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Hasło" required>
                                            <?php 
                                            if (isset($_SESSION['e_haslo'])) {
                                                echo '<p class="text-danger">'.$_SESSION['e_haslo'].'</p>';
                                                unset($_SESSION['e_haslo']);
                                            }
                                            ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="password2" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Powtórz hasło" required>
                                            <?php 
                                            if (isset($_SESSION['e_ex'])) {
                                                echo '<p class="text-danger">'.$_SESSION['e_ex'].'</p>';
                                                unset($_SESSION['e_ex']);
                                            }
                                            ?>
                                    </div>
                                </div>
                                <input type="submit" value="Zarejestruj się" class="btn btn-primary btn-user btn-block">  
                                <hr>
                                <a href="index.php" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Zarejestruj się za pomocą konta Google
                                </a>
                                <a href="index.php" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Zarejestruj się za pomocą konta Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Nie pamiętasz hasła?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Już posiadasz konto? Zaloguj się!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>