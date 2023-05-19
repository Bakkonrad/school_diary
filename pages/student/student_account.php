<?php
    session_start();

    if (!isset($_SESSION['isLogged'])) {
        header('Location: ../index.php');
        exit();
    }
    if($_SESSION['role'] != 3)
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
<title>KoalaSchool | Konto</title>
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-olive navbar-dark">
        <div class="container">
        <a href="student_main.php" class="navbar-brand">
            <span class="brand-text"><b>dziennik</b><br>lekcyjny</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a href="student_main.php" class="nav-link">Strona główna</a>
            </li>
            <li class="nav-item">
                <a href="student_grades.php" class="nav-link">Oceny</a>
            </li>
            <li class="nav-item">
                <a href="student_statistics.php" class="nav-link">Statystyki</a>
            </li>
            </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- SEARCH FORM -->
            <form class="form-inline ml-0 ml-md-3">
            <div class="input-group input-group-sm">
                <input class="form-control" type="search" placeholder="szukaj" aria-label="Search">
                <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                </div>
            </div>
            </form>
            <!-- ACCOUNT ICON -->
            <li class="nav-item">
            <a href="student_account.php" class="nav-link">
                <i class="fa fa-solid fa-user-graduate" style="color: #ffffff;"></i>
            </a>
            </li>
        </ul>
        </div>
    </nav> <!-- /.navbar -->

    <!-- Content Header (Page header) -->
    <div class="content-wrapper">
        <div class="content-header">
        <div class="container">
                <h1 class="m-0">Konto użytkownika</h1>
                <!-- <h1 class="m-0"> Strona główna <small>zalogowany</small></h1> -->
        </div> <!-- /.container-fluid -->
        </div> <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
        <div class="container">
            <div class="row">
                <!-- przycisk do wylogowania -->
                <div class="col-lg-3">
                    <form action="../../scripts/logout.php" method="post">
                        <button type="submit" name="logout" class="btn btn-block btn-danger">Wyloguj się</button>
                    </form>
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
        </div> <!-- /.content -->
    </div> <!-- /.content-wrapper -->
    </div> <!-- ./wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
        <img src="../../resources/5dde1da915414cb9969ecfb744fedfb6.png" width="100" height="30">
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

