<?php
session_start();

if (!isset($_SESSION['isLogged'])) {
    header('Location: ../index.php');
    exit();
}
if ($_SESSION['role'] != 2) {
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
                            <span class="fa fa-stack">
                                <i class="fa fa-thin fa-circle fa-stack-2x"></i>
                                <i class="fa fa-solid fa-chalkboard-user fa-stack-1x fa-inverse" id="navbar-dropdown-btn"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="user-header">
                                <img src="../../resources/teacher.jpg" class="img-circle" alt="User Image">
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
                                    <a href="../../scripts/logout.php" type="button" id="logout-btn" class="btn btn-block btn-danger">Wyloguj</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div> <!-- ./right-nav -->
            </div>
        </nav> <!-- /.navbar -->

        <div class="content-wrapper">
            <br>
            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card card-olive card-outline">
                                <div class="card-body">
                                    <h4>Co chcesz zrobić?</h4>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3">
                                            <a href="teacher_modified_grades.php" class="btn" id="m_page_btn">
                                            <i class="fa fa-solid fa-graduation-cap fa-xl"></i><br><h6>Wyświetl<br>historię ocen</h6></a>
                                        </div>
                                        <div class="col-3">
                                            <a href="teacher_add_grade.php" class="btn" id="m_page_btn">
                                            <i class="fa fa-solid fa-plus fa-xl"></i><br><h6>Dodaj<br>ocenę</h6></a>
                                        </div>
                                    </div> <!-- /.row -->
                                    <h2> </h2>
                                    <br><br>
                                </div> <!-- /.card-body -->
                            </div> <!-- /.card -->
                        </div> <!-- /.col -->
                        <div class="col-lg-4">
                            <div class="card card-olive card-outline">
                                <div class="card-body">
                                    <h2>Witaj,
                                        <?php
                                        echo <<< HTML
                                            $_SESSION[firstName]</h2>
                                            <p class="card-text">dzisiejsza data: <b>
                                        HTML;
                                        $dzien = date('d');
                                        $dzien_tyg = date('l');
                                        $miesiac = date('n');
                                        $rok = date('Y');

                                        $miesiac_pl = array(1 => 'stycznia', 'lutego', 'marca', 'kwietnia', 'maja', 'czerwca', 'lipca', 'sierpnia', 'września', 'października', 'listopada', 'grudnia');

                                        $dzien_tyg_pl = array('Monday' => 'poniedziałek', 'Tuesday' => 'wtorek', 'Wednesday' => 'środa', 'Thursday' => 'czwartek', 'Friday' => 'piątek', 'Saturday' => 'sobota', 'Sunday' => 'niedziela');
                                    
                                        echo $dzien_tyg_pl[$dzien_tyg].", ".$dzien." ".$miesiac_pl[$miesiac]." ".$rok."r.";
                                        // echo date("l, d M Y"); // po angielsku
                                    ?>
                                    </b></p>
                                    <br>
                                    <h4>Słówko na dzisiaj:</h4>
                                    <p>
                                        <script src="https://wordsmith.org/words/word.js" type="text/javascript"></script>
                                    </p>
                                </div> <!-- /.card-body -->
                            </div> <!-- /.card -->
                        </div> <!-- /.col -->
                    </div> <!-- /.row -->
                </div> <!-- /.container-fluid -->
            </div> <!-- /.content -->
        </div> <!-- /.content-wrapper -->

    </div>
        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                <img src="../../resources/logo.png" width="100" height="32">
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2023</strong> Wszelkie prawa zastrzeżone.
        </footer>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>

</body>

</html>