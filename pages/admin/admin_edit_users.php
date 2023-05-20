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
    <title>KoalaSchool | Użytkownicy</title>
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
                    <span class="brand-text"><b>dziennik</b><br>lekcyjny</span>
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
                            <input class="form-control" type="search" placeholder="szukaj"
                                aria-label="Search">
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
        <!-- <div class="content-wrapper">
            <div class="content-header">
                <div class="text-center">
                    <h1 class="m-0">Wyświetlanie użytkowników</h1>
                    <!- <h1 class="m-0"> Strona główna <small>zalogowany</small></h1> -->
                <!-- </div> /.container-fluid -->
            <!-- </div> /.content-header --> 

            <!-- Main content -->
            <div class="content">
                <div class="container">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <?php
                                if (isset($_SESSION['errors'])) //jesli jakies pole jest puste/nie zgadza sie email/nie zaakceptowano regulaminu
                                {
                                    //sprawdza czyw tablicy errors jest więcej niż 3 błędy, jesli tak to wyświetla inny komunikat
                            
                                    if (count($_SESSION['errors']) > 1 && count($_SESSION['errors']) < 3) {
                                        
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
                                    if (count($_SESSION['errors']) > 1) {
                            
                                        $error1 = $_SESSION['errors'][0];
                                        echo <<<HTML
                                        <div class="callout callout-danger">
                                        <h5>BŁĄD!</h5>
                                        <p>$error1</p>
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
                                    echo <<< HTML
                                        <div class="callout callout-success">
                                        <h5>SUKCES!</h5>
                                        <p>$_SESSION[notification]</p>
                                        </div>
                                        HTML;
                                    unset($_SESSION['notification']);
                                }
                                ?>

                                <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <h1 class="m-0">Wyświetlanie użytkowników</h1>
                                </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="example1_filter" class="dataTables_filter"><label>Szukaj:<input
                                                    type="search" class="form-control form-control-sm" placeholder="" name="search"
                                                    aria-controls="example1"></label></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1"
                                            class="table table-bordered table-striped dataTable dtr-inline"
                                            aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th class="sorting sorting_asc" tabindex="0"
                                                        aria-controls="example1" rowspan="1" colspan="1"
                                                        aria-sort="descending"
                                                        aria-label="Sortuj według Id">Id</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Sortuj według Imię">Imię</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Sortuj według Nazwisko">Nazwisko</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Sortuj według Nazwisko">Data urodzenia</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Sortuj według Login">Login</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Sortuj według Id">email</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Sortuj według Klasa">Klasa</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Sortuj według Rola">Rola</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Sortuj według Rola">Usuń</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Sortuj według Rola">Edytuj</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                                require "../../scripts/connect.php";
                                                mysqli_report(MYSQLI_REPORT_STRICT); //raportowanie o błędach w wyjątkach

                                                $recordsPerPage = 2; //ilość rekordów na stronie

                                                if(isset($_GET['page'])) //jesli jest ustawiona zmienna page
                                                {
                                                    $currentPage = $_GET['page'];
                                                }
                                                else
                                                {
                                                    $currentPage = 1;
                                                }

                                                $sql = "SELECT COUNT(*) AS allUsers FROM `users`;";  //zapytanie zliczające wszystkie rekordy
                                                $result = $conn->query($sql);
                                                $row = $result->fetch_assoc();
                                                $allUsers = $row['allUsers']; //liczba wszystkich rekordów w bazie
                                                $numberOfPages = ceil($allUsers/$recordsPerPage); //liczba stron

                                                $sql = "SELECT users.id, users.firstName, users.lastName, users.birthday, users.email, users.login, classes.class, roles.role FROM `users` JOIN `classes` ON `users`.`class` = `classes`.`class_id` JOIN `roles` ON `users`.`role` = `roles`.`role_id` LIMIT $recordsPerPage OFFSET ".($currentPage-1)*$recordsPerPage.";";
                                                $result = $conn->query($sql);

                                                if($result->num_rows == 0)
                                                {
                                                    echo "<tr><td colspan ='100%'>Brak rekordów do wyświwetlenia</td></tr>";
                                                }
                                                else // jesli sa rekordy w tabli to je wyswietl
                                                {
                                                    while($user = $result->fetch_assoc())
                                                    {
                                                        echo <<< HTML
                                                        <tr>
                                                    <td class="dtr-control sorting_1" tabindex="0">$user[id]</td>
                                                            <td>$user[firstName]</td>
                                                            <td>$user[lastName]</td>
                                                            <td>$user[birthday]</td>
                                                            <td>$user[login]</td>
                                                            <td>$user[email]</td>
                                                            <td>$user[class]</td>
                                                            <td>$user[role]</td>
                                                            <td><a href="../../scripts/delete_user.php?userDeleteId=$user[id]">Usuń</a></td>
                                                            <td><a href="../../scripts/update_user.php?userUpdateId=$user[id]">Edytuj</a></td>
                                                        </tr>
                                                    HTML;
                                                    }
                                                }
                                                $conn->close();
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="example1_info" role="status"
                                            aria-live="polite">Showing 1 to 10 of 57 entries</div>
                                    </div> -->
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                            <ul class="pagination">
                                                <?php

                                                if($currentPage == 1) //przycisk previous
                                                {
                                                    echo <<< HTML
                                                    <li class="paginate_button page-item previous disabled" id="example1_previous">
                                                        <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Poprzednia</a>
                                                    </li>
                                                    HTML;
                                                }
                                                else
                                                {
                                                    $previousPage = $currentPage - 1;
                                                    echo <<< HTML
                                                    <li class="paginate_button page-item previous" id="example1_previous">
                                                        <a href="./admin_edit_users.php?page=$previousPage" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Poprzednia</a>
                                                    </li>
                                                    HTML;
                                                }

                                                for($i=1; $i<=$numberOfPages; $i++) //przyciski z numerami stron
                                                {
                                                    echo <<< HTML
                                                    <li class="paginate_button page-item">
                                                        <a href="./admin_edit_users.php?page=$i" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">$i</a>
                                                    </li>
                                                    HTML;
                                                }

                                                if($currentPage == $numberOfPages) //przycisk next
                                                {
                                                    echo <<< HTML
                                                    <li class="paginate_button page-item next disabled" id="example1_next">
                                                        <a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Następna</a>
                                                    </li>
                                                    HTML;
                                                }
                                                else
                                                {
                                                    $nextPage = $currentPage + 1;
                                                    echo <<< HTML
                                                    <li class="paginate_button page-item next" id="example1_next">
                                                        <a href="./admin_edit_users.php?page=$nextPage" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Następna</a>
                                                    </li>
                                                    HTML;
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div> <!-- /.container-fluid -->
            </div> <!-- /.content -->
        </div> <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
            <img src="../../resources/logo.png" width="100" height="30">
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