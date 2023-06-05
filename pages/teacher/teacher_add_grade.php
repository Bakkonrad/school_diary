<?php
    session_start();

    if (!isset($_SESSION['isLogged'])) {
        header('Location: ../index.php');
        exit();
    }
    if($_SESSION['role'] != 2)
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
    <title>KoalaSchool | Dodawanie ocen</title>
    <link rel="icon" type="image/x-icon" href="../../resources/logo2.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link href="../../plugins/fontawesome-free/css/fontawesome.css" rel="stylesheet">
    <link href="../../plugins/fontawesome-free/css/brands.css" rel="stylesheet">
    <link href="../../plugins/fontawesome-free/css/solid.css" rel="stylesheet">
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
        <a href="teacher_main.php" class="navbar-brand">
            <img src="../../resources/logo2.png" id="navLogo">
            <span class="brand-text"><b>dziennik</b> lekcyjny</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
            <a href="teacher_main.php" class="nav-link">Strona główna</a>
            </li>
            <li class="nav-item">
            <a href="teacher_modified_grades.php" class="nav-link">Historia ocen</a>
            </li>
            <li class="nav-item">
            <a href="teacher_add_grade.php" class="nav-link">Dodaj ocenę</a>
            </li>
        </ul>
        </div>

        <!-- Right navbar links -->
        <div class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- ACCOUNT ICON -->
            <div class="dropdown user user-menu open nav-item">
                <a class="nav-link" data-toggle="dropdown" aria-expanded="true">
                    <i class="fa fa-solid fa-chalkboard-user" id="navbar-dropdown-btn"></i>
                </a>
                <ul class="dropdown-menu" >
                    <li class="user-header">
                    <img src="../../resources/teacher.jpg" class="profile-user-img img-fluid img-circle" alt="User Image">
                    <?php
                        echo <<< HTML
                        <p>
                                <h5><b>$_SESSION[firstName] $_SESSION[lastName]</b></h5>
                                <span class="text-muted">$_SESSION[email]</span>
                                </p>
                                <hr>
                                <div style="text-align:left">
                                    <p>
                                    <div class="row">
                                        <div class="col-1">
                                        <i class="fas fa-user"></i> 
                                        </div>
                                        <div class="col-11">
                                        <span class="text-muted">login:</span> $_SESSION[login]
                                    </div> <!-- /.col -->
                                </div> <!-- /.row -->
                                <br>
                                </p>
                  HTML;
                ?>
              </li>
              <br><br><br>
              <li class="user-footer">
                <div class="text-center" id="logout-div">
                    <a href="../../scripts/logout.php" type="button" id="logout-btn" class="btn btn-block btn-danger" ><i class="fa fa-solid fa-right-from-bracket"></i> Wyloguj</a>
                    </div>
                    </li>
                </ul>
            </div>
        </div> <!-- ./right-nav -->
    </div>
    </nav> <!-- /.navbar -->

    <!-- Content Header (Page header) -->
    <div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <h1 class="m-0">Dodawanie ocen</h1>
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
</div> <!-- ./wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    <img src="../../resources/logo.png" width="100" height="32">
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023</strong> Wszelkie prawa zastrzeżone.
    </footer>


    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>
