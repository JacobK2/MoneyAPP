<?php
  if (file_exists("lib/counter.php")) require_once("lib/counter.php");

?>
      </div>
    </div>
  </div>

  <div class="py-5 bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-center">
          <p>Z naszych usług skorzystało już <?php echo $ilu_userow; ?> osób!</p>
          <p>Naszą aplikację pobrano już <?php echo(rand(10,100)); ?> razy! Pobierz i Ty!</p>
          <p>Zeskanuj kod qr aby pobrać aplikację z Play store</p>
          <p><?php echo $brand; ?></p>
          <p><?php echo $siedziba; ?></p>
          <p>Telefon kontaktowy: <?php  echo $phone;?></p>
        </div>
        <div class="col-md-6 text-center">
          <img src="<?php echo $qr; ?>" alt="Kod qr">
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
