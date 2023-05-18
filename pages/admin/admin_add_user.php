<?php
    session_start();
    
    if (!isset($_SESSION['isLogged'])) {
        header('Location: ../../index.php');
        exit();
    }
    if($_SESSION['role'] != "administrator")
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
    <title>KoalaSchool | Dodawanie użytkownika</title>

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
    <nav class="main-header navbar navbar-expand-md navbar-primary navbar-dark">
        <div class="container">
        <a href="admin_main.php" class="navbar-brand">
            <span class="brand-text"><b>dziennik</b><br>lekcyjny</span>
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
                <a href="admin_edit_users.php" class="nav-link">Wyświetl lub edytuj użytkowników</a>
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
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- SEARCH FORM -->
            <form class="form-inline ml-0 ml-md-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="szukaj" aria-label="Search">
                <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                </div>
            </div>
            </form>
            <!-- ACCOUNT ICON -->
            <li class="nav-item">
            <a href="admin_account.php" class="nav-link">
                <i class="fa fa-solid fa-user-shield" style="color: #ffffff;"></i>
            </a>
            </li>
        </ul>
        </div>
    </nav> <!-- /.navbar -->

    <!-- Content Header (Page header) -->
    <div class="content-wrapper">
        <br><br>
        <!-- Main content -->
        <div class="content">
        <div class="d-flex justify-content-center align-items-center">
        <div class="register-box">
    <?php

    if (isset($_SESSION['errors'])) //jesli jakies pole jest puste/nie zgadza sie email/nie zaakceptowano regulaminu
    {
        echo <<<HTML
            <div class="callout callout-danger">
            <h5>BŁĄD!</h5>
            <p>$_SESSION[errors]</p>
            </div>
            HTML;
        //print_r($_SESSION['errors']);
        //echo "$_SESSION['errors']</div>";
    }
    unset($_SESSION['errors']);

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
    ?>

    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1 class="h1"><b>Rejestracja </b>użytkownika</h1>
        </div>
        <div class="card-body">
            <!-- <p class="login-box-msg">Rejestracja użytkownika</p> -->
            <form action="../../scripts/register_user.php" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="firstName" placeholder="Podaj imię" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="lastName" placeholder="Podaj nazwisko">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="login" placeholder="Podaj login">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Podaj email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="confirm_email" placeholder="Powtórz email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Podaj hasło">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Powtórz hasło">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="date" class="form-control" name="birthday">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-calendar"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
            <!-- <input type="text" class="form-control" name="city_id" placeholder="Podaj miasto"> -->
                <select class="form-control" name="class">
                <?php
                        require "../../scripts/connect.php";
                        $sql = "SELECT * FROM `classes`";
                        $result = $conn->query($sql);
                        while ($class = $result->fetch_assoc()) {
                            echo "<option
                            value='$class[class_id]'>$class[class]</option>";
                        }
                        ?>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa-people-group"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                <select class="form-control" name="role">
                <?php
                        require "../../scripts/connect.php";
                        $sql = "SELECT * FROM `roles`";
                        $result = $conn->query($sql);
                        while ($role = $result->fetch_assoc()) {
                            echo "<option
                            value='$role[role_id]'>$role[role]</option>";
                        }
                        ?>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa-people-group"></span>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-primary btn-block">Rejestracja</button>
                </div>
                <!-- /.col -->
                </div>
                </form>
        </div> 
        </div> <!-- /.card-body -->
        </div> <!-- /.container-fluid -->
        </div> <!-- /.content -->
    </div> <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
        KoalaSchool
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2023</strong> All rights reserved.
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
