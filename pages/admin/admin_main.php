<?php
    session_start();

    if (!isset($_SESSION['isLogged'])) {
        header('Location: ../index.php');
        exit();
    }
    if($_SESSION['role'] != 1)
    {
        header("Location: ../index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KoalaSchool | Strona główna</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Custom style -->
  <link rel="stylesheet" href="../css/style.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-olive navbar-dark">
    <div class="container">
      <a href="admin_main.php" class="navbar-brand">
        <img src="../../resources/logo2.png" width="40" height="40">
        <span class="brand-text"><b>dziennik</b> lekcyjny</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="admin_main.php" class="nav-link">Strona główna</a>
          </li>
          <li class="nav-item">
            <a href="admin_edit_users.php" class="nav-link">Użytkownicy</a>
          </li>
          <li class="nav-item">
            <a href="admin_add_user.php" class="nav-link">Dodawanie użytkownika</a>
          </li>
          <li class="nav-item">
            <a href="admin_add_grade.php" class="nav-link">Dodawanie ocen</a>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <div class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- ACCOUNT ICON -->
        <div class="dropdown user user-menu open nav-item">
            <a class="nav-link" data-toggle="dropdown" aria-expanded="true">
            <span class="fa fa-stack">
              <i class="fa fa-thin fa-circle fa-stack-2x"></i>
              <i class="fa fa-solid fa-user-shield fa-stack-1x fa-inverse" id="navbar-dropdown-btn"></i>
            </span>
            </a>
            <ul class="dropdown-menu" >
              <li class="user-header">
                <img src="../../resources/admin.jpg" class="img-circle" alt="User Image">
                <?php
                  echo <<< HTML
                    <p><b>imię i nazwisko: </b>$_SESSION[firstName] $_SESSION[lastName]</p>
                    <hr>
                    <p><b>email: </b>$_SESSION[email]</p>
                    <p style="margin-bottom: 20px;"><b>login: </b>$_SESSION[login]</p>
                  HTML;
                ?>
              </li>
              <br><br><br>
              <li class="user-footer">
                <div class="text-center" id="logout-div">
                    <a href="../../scripts/logout.php" type="button" id="logout-btn" class="btn btn-block btn-danger" >Wyloguj</a>
                </div>
              </li>
            </ul>
          </div>
      </div>
    </div>
  </nav> <!-- /.navbar -->

  <!-- Content Header (Page header) -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
            <h1 class="m-0"> Strona główna</h1>
            <!-- <h1 class="m-0"> Strona główna <small>zalogowany</small></h1> -->
      </div> <!-- /.container-fluid -->
    </div> <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="card card-olive card-outline">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>

                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div> <!-- /.card -->
          </div> <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card card-olive card-outline">
              <div class="card-header">
                <h5 class="card-title m-0">Featured</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-olive">Go somewhere</a>
              </div>
            </div>
          </div> <!-- /.col-md-6 -->
        </div> <!-- /.row -->
      </div> <!-- /.container-fluid -->
    </div> <!-- /.content -->
  </div> <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    <img src="../../resources/logo.png" width="100" height="32">
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023</strong> Wszelkie prawa zastrzeżone.
  </footer>
</div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>
