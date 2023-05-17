<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KoalaSchool | Odzyskiwanie hasła</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
<?php 
      
      if (isset($_SESSION['errors'])) //jesli jakies pole jest puste/nie zgadza sie email/nie zaakceptowano regulaminu
      {
        echo <<< HTML
          <div class="callout callout-danger">
          <h5>BŁĄD!</h5>
          <p>$_SESSION[errors]</p>
          </div>
          HTML;
          unset($_SESSION['errors']);
      }
      
      if (isset($_SESSION['notification'])) //jesli jakies pole jest puste/nie zgadza sie email/nie zaakceptowano regulaminu
      {
        echo <<< HTML
          <div class="callout callout-success">
          <h5>SUKCES!</h5>
          <p>$_SESSION[notification]</p>
          </div>
          HTML;
          unset($_SESSION['notification']);
      }
      unset($_SESSION['errors']);
      ?>
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <br>
      <a href="index.php" class="h1"><b>dziennik</b><br>lekcyjny</a><br><br>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Podaj swojego uczniowskiego maila, aby zresetować hasło.</p>
      <form action="../scripts/forgot_password_script.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Poproś o nowe hasło</button> <!-- nic sie dzieje po kliknieciu -->
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-3 mb-1">
        <a href="index.php">Wróć do logowania</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
