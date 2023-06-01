<?php
  session_start();

  // jeśli użytkownik jest zalogowany to przekierowuje go do odpowiedniej strony
  // if($_SESSION['isLogged'] == true)
  // {
  //   if($_SESSION['role'] == "administrator")
  //   {
  //       header('location: ../pages/admin/admin_main.php');
  //       exit();
  //   }
  //   if($_SESSION['role'] == "nauczyciel")
  //   {
  //       header('location: ../pages/teacher/teacher_main.php');
  //       exit();
  //   }
  //   if($_SESSION['role'] == "uczeń")
  //   {
  //       header('location: ../pages/student/student_main.php');
  //       exit();
  //   }
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KoalaSchool | Logowanie</title>
  <link rel="icon" type="image/x-icon" href="../resources/logo2.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Custom style -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="hold-transition login-page">
<div class="content index-content">

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
  <div class="card card-outline card-olive">
    <div class="card-header text-center">
      <br>
      <img src="../resources/logo.png" width="200" height="60">
      <br><br>
      <h2 class="h1"><b>dziennik</b> lekcyjny</h2>
    </div>
    <div class="card-body">
      <!-- <p class="login-box-msg">Zaloguj się do systemu</p> -->

      <form action="../scripts/login.php" method="post">
        <div class="input-group mb-3">
          <input type="login" class="form-control" name="login" placeholder="login/email" autofocus>
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
        <div class="row justify-content-center">
          <!-- <div class="col-8">
            <div class="icheck-olive">
              <input type="checkbox" id="remember">
              <label for="remember">
                Nie wylogowuj
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-10">
              <button type="submit" class="btn btn-block" id="loginBtn">Zaloguj się do systemu</button> <!-- ma przejsc do skryptu gdzie sprawdzi poprawność danych -->
          </div>
          <!-- /.col -->
        </div>
      </form>
      <br>
      <div class="row justify-content-center">
        <p class="mb-1">
          <a href="forgot-password.php">Nie pamiętam hasła</a>
        </p>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
</div> <!-- /.wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
