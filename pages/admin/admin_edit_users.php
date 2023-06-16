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
    <title>KoalaSchool | Użytkownicy</title>
    <link rel="icon" type="image/x-icon" href="../../resources/logo2.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                            <a href="admin_add_grade.php" class="nav-link">Oceny</a>
                        </li>
                    </ul>
                </div> <!-- /.collapse navbar-collapse -->

                <!-- Right navbar links -->
                <div class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- ACCOUNT ICON -->
                    <div class="dropdown user user-menu open nav-item">
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
                    </div>
                </div>
            </div> <!-- /.container -->
        </nav> <!-- /.navbar -->

        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <br>
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <?php
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

                                $error1 = $_SESSION['errors'][0];
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
                        <div class="row justify-content-center">
                            <div class="col-sm-6">
                                <!-- okienko do edytowania użytownika -->
                                <?php
                                if (isset($_GET["userUpdateId"])) {
                                    require_once "../../scripts/connect.php";
                                    $_SESSION["userUpdateId"] = $_GET["userUpdateId"]; //pobiera id uzytkownika z adresu url
                                    $sql = "SELECT * FROM users WHERE id = $_SESSION[userUpdateId]"; //pobiera dane uzytkownika z bazy danych
                                    $result = $conn->query($sql);
                                    $updateUser = $result->fetch_assoc();

                                    echo <<<HTML
                                            <div class="card card-olive card-outline">
                                            <div class="card-body">
                                            <div class="float" id="close-x">
                                                <a href="admin_edit_users.php" class="btn" ><i class="fa fa-solid fa-times fa-xl" id="closeIcon"></i></a>
                                            </div>
                                            <br>
                                            <div class="card-header text-center">
                                                <h1 class="h1"><b>Edytowanie </b>użytkownika</h1>
                                            </div>
                                            <form action="../../scripts/update_user.php" method="post">
                                                <label>Imię:</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="firstName" placeholder="Podaj imię" value="$updateUser[firstName]" autofocus>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div> <!-- /.input-group-text -->
                                                    </div> <!-- /.input-group-append -->
                                                </div> <!-- /.input-group -->
                                                <label>Nazwisko:</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="lastName" placeholder="Podaj nazwisko" value="$updateUser[lastName]" >
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>

                                                    </div>
                                                </div> <!-- /.input-group -->
                                                <label>Login:</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="login" placeholder="Podaj login" value="$updateUser[login]">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user-circle"></span>
                                                        </div>
                                                    </div>
                                                </div> <!-- /.input-group -->
                                                <label>Email:</label>
                                                <div class="input-group mb-3">
                                                    <input type="email" class="form-control" name="email" placeholder="Podaj email" value="$updateUser[email]">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-envelope"></span>
                                                        </div>
                                                    </div>
                                                </div> <!-- /.input-group -->
                                                <label>Powtórz email:</label>
                                                <div class="input-group mb-3">
                                                    <input type="email" class="form-control" name="confirm_email" placeholder="Powtórz email" value="$updateUser[email]">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-envelope"></span>
                                                        </div>
                                                    </div>
                                                </div> <!-- /.input-group -->
                                                <label>Data urodzenia:</label>
                                                <div class="input-group mb-3">
                                                    <input type="date" class="form-control" name="birthday" value="$updateUser[birthday]">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-calendar"></span>
                                                        </div>
                                                    </div>
                                                </div> <!-- /.input-group -->
                                                <label>Rola:</label>
                                                <div class="input-group mb-3">
                                            <select class="form-control" name="class">
                                            HTML;
                                    require "../../scripts/connect.php";
                                    $sql = "SELECT * FROM `classes`";
                                    $result = $conn->query($sql);
                                    while ($class = $result->fetch_assoc()) {
                                        if ($class['class_id'] == $updateUser['class']) {
                                            echo "<option value='$class[class_id]' selected>$class[class]</option>";
                                        } else {
                                            echo "<option value='$class[class_id]'>$class[class]</option>";
                                        }
                                    }

                                    echo <<<HTML
                                                </select>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-users-cog"></span>
                                                    </div>
                                                </div>
                                            </div> <!-- /.input-group -->
                                            <label>Klasa:</label>
                                            <div class="input-group mb-3">
                                            <select class="form-control" name="role">
                                            HTML;
                                    require "../../scripts/connect.php";
                                    $sql = "SELECT * FROM `roles`";
                                    $result = $conn->query($sql);
                                    while ($role = $result->fetch_assoc()) {
                                        if ($role['role_id'] == $updateUser['role']) {
                                            echo "<option value='$role[role_id]' selected>$role[role]</option>";
                                        } else {
                                            echo "<option value='$role[role_id]'>$role[role]</option>";
                                        }
                                    }
                                    echo <<<HTML
                                                </select>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fa fa-users"></span>
                                                    </div>
                                                </div>
                                            </div> <!-- /.input-group -->
                                            <div class="d-flex justify-content-center align-items-center">
                                                <button type="submit" class="btn btn-olive btn-block">Zaktualizuj</button>
                                            </div> <!-- button -->
                                            </div> <!-- /.card-body -->
                                                </div> <!-- /.card -->
                                            </form>
                                            HTML;
                                }
                                ?>
                            </div> <!-- ./col -->
                        </div> <!-- ./row -->
                        <div class="card card-olive card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <h3 class="m-0">Wyświetlanie użytkowników</h3>
                                        <br>
                                    </div>
                                    <div class="col-2"></div> <!-- pusty div żeby search bar było z prawej -->
                                    <div class="col-4" style="display: flex; justify-content: flex-end">
                                        <form action="../../scripts/search_user.php" method="post">
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="name_and_surname" class="form-control"
                                                    placeholder="Podaj imię i nazwisko">
                                                <div class="input-group-append">
                                                    <button type="submit" name="searchBtn"
                                                        class="btn btn-olive">Szukaj</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> <!-- ./row -->
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <a href="./admin_add_user.php"><button type="button"
                                                class="btn btn-olive">Dodaj nowego użytkownika</button></a>
                                    </div>
                                </div>
                                <br>
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                    aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Imię</th>
                                            <th>Nazwisko</th>
                                            <th>Data urodzenia</th>
                                            <th>Login</th>
                                            <th>email</th>
                                            <th>Klasa</th>
                                            <th>Rola</th>
                                            <th>Usuń</th>
                                            <th>Edytuj</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require "../../scripts/connect.php";
                                        mysqli_report(MYSQLI_REPORT_STRICT); //raportowanie o błędach w wyjątkach
                                        
                                        $recordsPerPage = 2; //ilość rekordów na stronie
                                        
                                        if (isset($_GET['page'])) //jesli jest ustawiona zmienna page
                                        {
                                            $currentPage = $_GET['page'];
                                        } else {
                                            $currentPage = 1;
                                        }

                                        if ((isset($_SESSION['name'])) && (!empty($_SESSION['name']))) //jesli uzyto szukania 
                                        {
                                            $name = $_SESSION['name'];
                                            $surname = $_SESSION['surname'];
                                            $sql = "SELECT COUNT(*) AS allUsers FROM `users`WHERE firstName = '$name' AND lastName = '$surname';";

                                            //usuwanie zmiennych sesyjnych
                                            unset($_SESSION['name']);
                                            unset($_SESSION['surname']);
                                        } else {
                                            $sql = "SELECT COUNT(*) AS allUsers FROM `users`;"; //zapytanie zliczające wszystkie rekordy
                                        }
                                        $result = $conn->query($sql);
                                        $row = $result->fetch_assoc();
                                        $allUsers = $row['allUsers']; //liczba wszystkich rekordów w bazie
                                        $numberOfPages = ceil($allUsers / $recordsPerPage); //liczba stron
                                        
                                        if (isset($name)) {
                                            $sql = "SELECT users.id, users.firstName, users.lastName, users.birthday, users.email, users.login, classes.class, roles.role FROM `users` JOIN `classes` ON `users`.`class` = `classes`.`class_id` JOIN `roles` ON `users`.`role` = `roles`.`role_id` WHERE `users`.`firstName` = '$name' AND `users`.`lastName` = '$surname' LIMIT $recordsPerPage OFFSET " . ($currentPage - 1) * $recordsPerPage . ";";
                                        } else {
                                            $sql = "SELECT users.id, users.firstName, users.lastName, users.birthday, users.email, users.login, classes.class, roles.role FROM `users` JOIN `classes` ON `users`.`class` = `classes`.`class_id` JOIN `roles` ON `users`.`role` = `roles`.`role_id` LIMIT $recordsPerPage OFFSET " . ($currentPage - 1) * $recordsPerPage . ";";
                                        }

                                        $result = $conn->query($sql);

                                        if ($result->num_rows == 0) {
                                            echo "<tr><td colspan ='100%'>Brak rekordów do wyświwetlenia</td></tr>";
                                        } else // jesli sa rekordy w tabli to je wyswietl
                                        {
                                            while ($user = $result->fetch_assoc()) {
                                                echo <<<HTML
                                                        <tr>
                                                    <td class="dtr-control sorting_1" tabindex="0">$user[id]</td>
                                                            <td>$user[firstName]</td>
                                                            <td>$user[lastName]</td>
                                                            <td>$user[birthday]</td>
                                                            <td>$user[login]</td>
                                                            <td>$user[email]</td>
                                                            <td>$user[class]</td>
                                                            <td>$user[role]</td>
                                                            <td>
                                                            <!-- Przycisk potwierdzający usuwanie -->
                                                            <button type="button" class="btn btn-danger"  id="delete-btn" data-toggle="modal" data-target="#confirmDelete$user[id]">Usuń</button>
                                                        <!-- Modal - potwierdzenie usunięcia użytkownika, musi być tutaj żeby zbierał dane o konkretnym użytkowniku --> 
                                                        <div class="modal fade" id="confirmDelete$user[id]" tabindex="0" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="confirmDeleteLabel">Potwierdź operację</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Czy na pewno chcesz usunąć użytkownika <strong>$user[firstName] $user[lastName]</strong>?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <button type="button" class="btn" id="cancelBtn" style="background-color:grey" data-dismiss="modal">Anuluj</button>
                                                                            </div> <!-- /.col -->
                                                                            <div class="col-8">
                                                                                <a href="../../scripts/delete_user.php?userDeleteId=$user[id]">
                                                                                    <button type="button" class="btn btn-danger" id="delete-btn">Usuń użytkownika</button>
                                                                                </a>
                                                                            </div> <!-- /.col -->
                                                                        </div> <!-- /.row -->
                                                                    </div> <!-- /.modal-footer -->
                                                                </div> <!-- /.modal-content -->
                                                            </div> <!-- /.modal-dialog -->
                                                        </div> <!-- /.modal -->
                                                        </td>
                                                        <td><a href="./admin_edit_users.php?userUpdateId=$user[id]"><button type="button" class="btn btn-olive">Edytuj</button></a></td>
                                                        </tr>
                                                    HTML;
                                            }
                                        }
                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                                <br>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        <ul class="pagination">
                                            <?php

                                            if ($currentPage == 1) //przycisk previous
                                            {
                                                echo <<<HTML
                                        <li class="paginate_button page-item previous disabled" id="example1_previous">
                                            <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Poprzednia</a>
                                        </li>
                                        HTML;
                                            } else {
                                                $previousPage = $currentPage - 1;
                                                echo <<<HTML
                                        <li class="paginate_button page-item previous" id="example1_previous">
                                            <a href="./admin_edit_users.php?page=$previousPage" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Poprzednia</a>
                                        </li>
                                        HTML;
                                            }

                                            for ($i = 1; $i <= $numberOfPages; $i++) //przyciski z numerami stron
                                            {
                                                echo <<<HTML
                                        <li class="paginate_button page-item">
                                            <a href="./admin_edit_users.php?page=$i" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">$i</a>
                                        </li>
                                        HTML;
                                            }

                                            if ($currentPage >= $numberOfPages) //przycisk next
                                            {
                                                echo <<<HTML
                                        <li class="paginate_button page-item next disabled" id="example1_next">
                                            <a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Następna</a>
                                        </li>
                                        HTML;
                                            } else {
                                                $nextPage = $currentPage + 1;
                                                echo <<<HTML
                                        <li class="paginate_button page-item next" id="example1_next">
                                            <a href="./admin_edit_users.php?page=$nextPage" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Następna</a>
                                        </li>
                                        HTML;
                                            }
                                            ?>
                                            <br>
                                    </div>
                                </div>
                                </ul>
                            </div> <!-- /.paginacja -->
                        </div> <!-- /.col -->
                    </div> <!-- /.example1-wrapper -->
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.container -->
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
    <!-- DataTables  & Plugins -->
    <!-- <script src="../../plugins/datatables/jquery.dataTables.min.js"></script> -->
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>

</body>

</html>