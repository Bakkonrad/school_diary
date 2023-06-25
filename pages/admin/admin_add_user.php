<?php
session_start();

if (!isset($_SESSION['isLogged'])) {
    header('Location: ../index.php');
    exit();
}
if ($_SESSION['role'] != 1) {
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
    <link rel="icon" type="image/x-icon" href="../../resources/logo2.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link href="../../plugins/fontawesome-free/css/fontawesome.css" rel="stylesheet">
    <link href="../../plugins/fontawesome-free/css/brands.css" rel="stylesheet">
    <link href="../../plugins/fontawesome-free/css/solid.css" rel="stylesheet">
    <!-- Custom style -->
    <link rel="stylesheet" href="../css/style.css">
        <script>
    function clearForm() {
        document.getElementById("registerUser").reset();
    }
    </script>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-olive navbar-dark">
            <div class="container">
                <a href="admin_main.php" class="navbar-brand">
                    <img src="../../resources/logo2.png" id="navLogo">
                    <span class="brand-text"><b>dziennik</b> lekcyjny</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
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
                            <a href="admin_add_subject.php" class="nav-link">Dodawanie przedmiotów</a>
                        </li>
                        <li class="nav-item">
                            <a href="admin_modify_grades.php" class="nav-link">Oceny</a>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- ACCOUNT ICON -->
                    <li class="dropdown user user-menu open nav-item">
                        <a class="nav-link" data-toggle="dropdown" aria-expanded="true">
                            <i class="fa fa-solid fa-user-shield" id="navbar-dropdown-btn"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="../../resources/admin.jpg" class="profile-user-img img-fluid img-circle"
                                    alt="User Image">
                                <?php
                                echo <<<HTML
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
                                    <a href="../../scripts/logout.php" type="button" id="logout-btn"
                                        class="btn btn-block btn-danger"><i
                                            class="fa fa-solid fa-right-from-bracket"></i> Wyloguj</a>
                                </div>
                            </li>
                        </ul>
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
                        //jeśli nie ma błędów to wywołaj funkcję clearForm() 
                        if (!isset($_SESSION['errors'])) {
                            $reset = true;
                        }

                        if (isset($_SESSION['errors'])) //jesli jakies pole jest puste/nie zgadza sie email/nie zaakceptowano regulaminu
                        {
                            //sprawdza czyw tablicy errors jest więcej niż 3 błędy, jesli tak to wyświetla inny komunikat
                        
                            if (count($_SESSION['errors']) > 1 && count($_SESSION['errors']) < 4) {

                                $error1 = $_SESSION['errors'][0];
                                $error2 = $_SESSION['errors'][1];
                                echo <<<HTML
            <div class="callout callout-danger">
            <h5>BŁĄD!</h5>
            <p>$error1</p>
            <p>$error2</p>
            </div>
            HTML;

                            }
                            if (count($_SESSION['errors']) > 4) {

                                //$error1 = $_SESSION['errors'][0];
                                echo <<<HTML
            <div class="callout callout-danger">
            <h5>BŁĄD!</h5>
            <p>Uzupełnij wszystkie pola!</p>
            </div>
            HTML;
                            }
                            if (count($_SESSION['errors']) == 1) {

                                $error1 = $_SESSION['errors'][0];
                                echo <<<HTML
            <div class="callout callout-danger">
            <h5>BŁĄD!</h5>
            <p>$error1</p>
            </div>
            HTML;
                            }

                        }
                        unset($_SESSION['errors']);

                        if (isset($_SESSION['notification'])) //jesli jakies pole jest puste/nie zgadza sie email/nie zaakceptowano regulaminu
                        {
                            echo <<<HTML
            <div class="callout callout-success">
            <h5>SUKCES!</h5>
            <p>$_SESSION[notification]</p>
            </div>
            HTML;
                            unset($_SESSION['notification']);
                        }
                        ?>

                        <div class="card card-outline card-olive">
                            <div class="card-header text-center">
                                <h1 class="h1"><b>Dodawanie </b>użytkownika</h1>
                            </div>
                            <div class="card-body">
                                <!-- <p class="login-box-msg">Rejestracja użytkownika</p> -->
                                <form id="registerUser" action="../../scripts/register_user.php" method="post">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="firstName"
                                            placeholder="Podaj imię" autofocus>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="lastName"
                                            placeholder="Podaj nazwisko">
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
                                                <span class="fas fa-user-circle"></span>
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
                                        <input type="email" class="form-control" name="confirm_email"
                                            placeholder="Powtórz email">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Podaj hasło">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="confirm_password"
                                            placeholder="Powtórz hasło">
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
                                        <select class="form-control" name="role">
                                        <option disabled selected value> -- wybierz rolę -- </option>
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
                                                <span class="fa fa-users-cog"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <select class="form-control" name="class">
                                        <option disabled selected value> -- wybierz klasę -- </option>
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
                                                <span class="fas fa-users"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button type="submit" class="btn btn-olive btn-block">Dodaj użytkownika</button>
                                    </div>
                                    <!-- /.col -->
                                    <?php
                                    if($reset = true)
                                    {
                                        echo '<script>clearForm();</script>';
                                    }
                                    ?>
                            </div>
                            </form>
                        </div>
                    </div> <!-- /.card-body -->
                </div> <!-- /.container-fluid -->
                <br>
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