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
    <title>KoalaSchool | Historia ocen</title>
    <link rel="icon" type="image/x-icon" href="../../resources/logo2.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
                <a href="teacher_main.php" class="navbar-brand">
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
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
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
                </ul>
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
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <!-- <div class="col-sm-12 col-md-6">
                    <div class="dt-buttons btn-group flex-wrap"> 
                      <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example1" type="button">
                        <span>Copy</span>
                      </button> 
                      <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example1" type="button">
                        <span>CSV</span>
                      </button> 
                      <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button">
                        <span>Excel</span>
                      </button> 
                      <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button">
                        <span>PDF</span>
                      </button> 
                      <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1" type="button">
                        <span>Print</span>
                      </button>
                      <div class="btn-group">
                        <button class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="example1" type="button" aria-haspopup="true" aria-expanded="false">
                          <span>Column visibility</span>
                          <span class="dt-down-arrow"></span>
                        </button>
                      </div>
                    </div>
                  </div> -->
                                    <div class="col-sm-12 col-md-6">
                                        <div id="example1_filter" class="dataTables_filter">
                                            <label>Szukaj ocen ucznia:<input type="search"
                                                    class="form-control form-control-sm"
                                                    placeholder="Imię i nazwisko ucznia"
                                                    aria-controls="example1"></label>
                                        </div>
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
                                                        aria-sort="ascending"
                                                        aria-label="Rendering engine: activate to sort column descending">
                                                        Imię ucznia</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">Nazwisko
                                                        ucznia</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        Stara ocena</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Engine version: activate to sort column ascending">
                                                        Nowa ocena</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">
                                                        Przedmiot</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Dodał
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Data
                                                        dodania oceny</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Data
                                                        modyfikacji oceny</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                //require_once "connect.php"; 
                                                require "../../scripts/connect.php";
                                                mysqli_report(MYSQLI_REPORT_STRICT); //raportowanie o błędach w wyjątkach
                                                
                                                $recordsPerPage = 2; //ilość rekordów na stronie
                                                
                                                if (isset($_GET['page'])) //jesli jest ustawiona zmienna page
                                                {
                                                    $currentPage = $_GET['page'];
                                                } else {
                                                    $currentPage = 1;
                                                }

                                                $sql = "SELECT COUNT(*) AS all_modified_grades FROM `history_of_grades`;"; //zapytanie zliczające wszystkie rekordy
                                                $result = $conn->query($sql);
                                                $row = $result->fetch_assoc();
                                                $all_modified_grades = $row['all_modified_grades']; //liczba wszystkich rekordów w bazie
                                                $numberOfPages = ceil($all_modified_grades / $recordsPerPage); //liczba stron
                                                
                                                $sql = "SELECT users.firstName, users.lastName, hog.old_grade, hog.new_grade, grades.subject, hog.added_by, grades.created_at as `grades_created_at`, hog.created_at as `hog_created_at` FROM `users` JOIN `grades` ON `users`.`id` = `grades`.`student` JOIN `history_of_grades` hog ON `grades`.`operation_id` = `hog`.`grade_id` ORDER BY `hog`.`created_at` DESC LIMIT $recordsPerPage OFFSET " . ($currentPage - 1) * $recordsPerPage . ";";

                                                $result = $conn->query($sql);

                                                if ($result->num_rows == 0) {
                                                    echo "<tr><td colspan ='100%'>Brak rekordów do wyświwetlenia</td></tr>";
                                                } else // jesli sa rekordy w tabli to je wyswietl
                                                {
                                                    while ($user = $result->fetch_assoc()) {
                                                        echo <<<HTML
                                                        <tr>
                                                    <td class="dtr-control sorting_1" tabindex="0">$user[firstName]</td>
                                                            <td>$user[lastName]</td>
                                                            <td>$user[old_grade]</td>
                                                            <td>$user[new_grade]</td>
                                                            <td>$user[subject]</td>
                                                            <td>$user[added_by]</td>
                                                            <td>$user[grades_created_at]</td>
                                                            <td>$user[hog_created_at]</td>
                                                        </tr>
                                                    HTML;
                                                    }
                                                }
                                                $conn->close();


                                                ?>

                                                <!-- <tr class="odd">
                          <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                          <td>Firefox 1.0</td>
                          <td>Win 98+ / OSX.2+</td>
                          <td>1.7</td>
                          <td>A</td>
                        </tr>
                        <tr class="even">
                          <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                          <td>Firefox 1.5</td>
                          <td>Win 98+ / OSX.2+</td>
                          <td>1.8</td>
                          <td>A</td>
                        </tr>
                        <tr class="odd">
                          <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                          <td>Firefox 2.0</td>
                          <td>Win 98+ / OSX.2+</td>
                          <td>1.8</td>
                          <td>A</td>
                        </tr>
                        <tr class="even">
                          <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                          <td>Firefox 3.0</td>
                          <td>Win 2k+ / OSX.3+</td>
                          <td>1.9</td>
                          <td>A</td>
                        </tr>
                        <tr class="odd">
                          <td class="sorting_1 dtr-control">Gecko</td>
                          <td>Camino 1.0</td>
                          <td>OSX.2+</td>
                          <td>1.8</td>
                          <td>A</td>
                        </tr>
                        <tr class="even">
                          <td class="sorting_1 dtr-control">Gecko</td>
                          <td>Camino 1.5</td>
                          <td>OSX.3+</td>
                          <td>1.8</td>
                          <td>A</td>
                        </tr>
                        <tr class="odd">
                          <td class="sorting_1 dtr-control">Gecko</td>
                          <td>Netscape 7.2</td>
                          <td>Win 95+ / Mac OS 8.6-9.2</td>
                          <td>1.7</td>
                          <td>A</td>
                        </tr>
                        <tr class="even">
                          <td class="sorting_1 dtr-control">Gecko</td>
                          <td>Netscape Browser 8</td>
                          <td>Win 98SE+</td>
                          <td>1.7</td>
                          <td>A</td>
                        </tr>
                        <tr class="odd">
                          <td class="sorting_1 dtr-control">Gecko</td>
                          <td>Netscape Navigator 9</td>
                          <td>Win 98+ / OSX.2+</td>
                          <td>1.8</td>
                          <td>A</td>
                        </tr>
                        <tr class="even">
                          <td class="sorting_1 dtr-control">Gecko</td>
                          <td>Mozilla 1.0</td>
                          <td>Win 95+ / OSX.1+</td>
                          <td>1</td>
                          <td>A</td>
                        </tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <!-- <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div> -->
                                    </div>
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
            <a href="./teacher_add_grade.php?page=$previousPage" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Poprzednia</a>
        </li>
        HTML;
                                                }

                                                for ($i = 1; $i <= $numberOfPages; $i++) //przyciski z numerami stron
                                                {
                                                    echo <<<HTML
        <li class="paginate_button page-item">
            <a href="./teacher_add_grade.php?page=$i" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">$i</a>
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
            <a href="./teacher_add_grade.php?page=$nextPage" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Następna</a>
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