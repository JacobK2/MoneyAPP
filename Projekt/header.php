<!DOCTYPE html>
<html lang="pl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php $nazwa_aplikacji; ?> Strona główna">
    <meta name="author" content="Jakub Karalus">

    <title><?php echo $nazwa_aplikacji; ?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="<?php echo $url; ?>"><?php echo $nazwa_aplikacji; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo $url; ?>">Strona główna
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php
          if (@$_SESSION['id']<>"") {
            echo "<li class=\"nav-item\">";
            echo "<a class=\"nav-link\" href=\"./dashboard.php\">Konto</a>";
            echo "</li>";
            echo "<li class=\"nav-item\">";
            echo "<a class=\"nav-link\" href=\"./logout.php\">Wyloguj się</a>";
            echo "</li>";
            echo "<li class=\"nav-item\">";
            echo "<a class=\"nav-link\" href=\"#\">Usługi</a>";
            echo "</li>";
            echo "<li class=\"nav-item\">";
            echo "<a class=\"nav-link\" href=\"#\">Kontakt</a>";
            echo "</li>";
          } else{
            echo "<li class=\"nav-item\">";
            echo "<a class=\"nav-link\" href=\"./login.php\">Konto</a>";
            echo "</li>";
            echo "<li class=\"nav-item\">";
            echo "<a class=\"nav-link\" href=\"#\">Usługi</a>";
            echo "</li>";
            echo "<li class=\"nav-item\">";
            echo "<a class=\"nav-link\" href=\"#\">Kontakt</a>";
            echo "</li>";
            
        }
        ?>
        </ul>
      </div>
    </div>
  </nav>
    <!-- Page Content -->
