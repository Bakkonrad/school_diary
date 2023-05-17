<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KoalaSchool | Logowanie</title>

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
  <!-- /.login-logo -->
  <?php 
      
      if (isset($_SESSION['errors'])) //jesli jakies pole jest puste/nie zgadza sie email/nie zaakceptowano regulaminu
      {
        echo <<< HTML
          <div class="callout callout-danger">
          <h5>BŁĄD!</h5>
          <p>$_SESSION[errors]</p>
          </div>
          HTML;
      }
      unset($_SESSION['errors']);
      ?>
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <br>
      <a href="index.php" class="h1"><b>dziennik</b><br>lekcyjny</a><br><br>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Zaloguj się do systemu</p>

      <form action="../scripts/login.php" method="post">
        <div class="input-group mb-3">
          <input type="login" class="form-control" name="login" placeholder="login" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="hasło">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Nie wylogowuj
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Zaloguj</button> <!-- ma przejsc do skryptu gdzie sprawdzi poprawność danych -->
          </div>
          <!-- /.col -->
        </div>
      </form>
      <br>
      <p class="mb-1">
        <a href="forgot-password.php">Nie pamiętam hasła</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
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
