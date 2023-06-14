<?php
session_start();

if (!isset($_SESSION['isLogged'])) {
    header('Location: ../index.php');
    exit();
}
if ($_SESSION['role'] != 3) {
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
                <a href="student_main.php" class="navbar-brand">
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
                            <a href="student_main.php" class="nav-link">Strona główna</a>
                        </li>
                        <li class="nav-item">
                            <a href="student_grades.php" class="nav-link">Oceny</a>
                        </li>
                        <li class="nav-item">
                            <a href="student_modified_grades.php" class="nav-link">Historia ocen</a>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- ACCOUNT ICON -->
                    <div class="dropdown user user-menu open nav-item" id="navbar-dropdown-item">
                        <a class="nav-link " data-toggle="dropdown" aria-expanded="true" id="navbar-dropdown-link">
                            <i class="fa fa-solid fa-user-graduate" id="navbar-dropdown-btn"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="../../resources/student.jpg" class="profile-user-img img-fluid img-circle" alt="User Image">
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
                                <div class="row">
                                    <div class="col-1">
                                    <i class="fa fa-people-group"></i> 
                                    </div>
                                    <div class="col-11">
                                    <span class="text-muted">klasa:</span> $_SESSION[class] <!-- trzeba zaciągnąć klasę -->
                                    </div> <!-- /.col -->
                                </div> <!-- /.row -->
                                <br>
                                </p>
                                HTML;
                                ?>
                            </li>
                            <br><br><br><br>
                            <li class="user-footer">
                                <div class="text-center" id="logout-div">
                                    <a href="../../scripts/logout.php" type="button" id="logout-btn" class="btn btn-block btn-danger"><i class="fa fa-solid fa-right-from-bracket"></i> Wyloguj</a>
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
                    <h1 class="m-0">Historia ocen</h1>
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
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th>Imię ucznia</th>
                                                    <th>Nazwisko ucznia</th>
                                                    <th>Stara ocena</th>
                                                    <th>Nowa ocena</th>
                                                    <th>Przedmiot</th>
                                                    <th>Dodał</th>
                                                    <th>Data dodania oceny</th>
                                                    <th>Data modyfikacji oceny</th>
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
            <a href="./student_add_grade.php?page=$previousPage" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Poprzednia</a>
        </li>
        HTML;
                                                }

                                                for ($i = 1; $i <= $numberOfPages; $i++) //przyciski z numerami stron
                                                {
                                                    echo <<<HTML
        <li class="paginate_button page-item">
            <a href="./student_add_grade.php?page=$i" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">$i</a>
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
            <a href="./student_add_grade.php?page=$nextPage" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Następna</a>
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
                    <div class="card card-olive card-outline">
                        <div class="card-body">
                            <h3>Historia ocen</h3>
                            <br>
                            <?php
                            echo <<<HTML
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="card card-outline card-success collapsed-card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-2">
                                                    <h6>01.06.2023</h6>
                                                </div>
                                                <div class="col-9">
                                                    <h3 class="card-title">Dodano nową ocenę z przedmiotu user[subject]!</h3>
                                                </div>
                                                <div class="col-1 card-tools">
                                                    <button type="button" class="btn btn-tool" id="toolBtn" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            Dodano ocenę user[new_grade] z przedmiotu user[subject] dnia user[grades_created_at].
                                        </div>
                                    </div> <!-- /.card-success -->
                                    </div> <!-- /.col-10 -->
                            </div> <!-- /.row -->
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="card card-outline card-danger collapsed-card">
                                        <div class="card-header">
                                        <div class="row">
                                                <div class="col-2">
                                                    <h6>01.06.2023</h6>
                                                </div>
                                                <div class="col-9">
                                                    <h3 class="card-title">Usunięto ocenę z przedmiotu user[subject]!</h3>
                                                </div>
                                                <div class="col-1 card-tools">
                                                    <button type="button" class="btn btn-tool" id="toolBtn" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            Usunięto ocenę user[old_grade] z przedmiotu user[subject] (dodaną dnia user[grades_created_at]).
                                        </div>
                                    </div>
                                </div>
                            </div>
                        HTML;
                            ?>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                    <div class="container-fluid">
                        <div class="card card-outline card-olive">
                            <div class="card-body">
                            <h3>Historia ocen</h3>
                            <br>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="timeline">

                                            <div class="time-label">
                                                <span class="bg-olive">10 Feb. 2014</span> <!-- data -->
                                            </div>


                                            <div>
                                                <i class="fas fa-plus bg-success"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> 12:05</span> <!-- godzina -->
                                                    <h3 class="timeline-header"><b>Dodano nową ocenę!</b></h3> <!-- Nauczyciel -->
                                                    <div class="timeline-body">
                                                        Dodano ocenę [ocena] z przedmiotu [przedmiot] przez [nauczyciel] 
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <i class="fas fa-times bg-danger"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> 12:05</span> <!-- godzina -->
                                                    <h3 class="timeline-header"><b>Usunięto ocenę!</b></h3>
                                                    <div class="timeline-body">
                                                        Usunięto ocenę [ocena] z przedmiotu [przedmiot] przez [nauczyciel] 
                                                    </div>
                                                </div>
                                            </div>

<!-- 
                                            <div>
                                                <i class="fas fa-comments bg-yellow"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                                    <div class="timeline-body">
                                                        Take me to your leader!
                                                        Switzerland is small and neutral!
                                                        We are more like Germany, ambitious and misunderstood!
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a class="btn btn-warning btn-sm">View comment</a>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="time-label">
                                                <span class="bg-green">3 Jan. 2014</span>
                                            </div>


                                            <div>
                                                <i class="fa fa-camera bg-purple"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                                    <div class="timeline-body">
                                                        <img src="https://placehold.it/150x100" alt="..." s10kgbb4p="">
                                                        <img src="https://placehold.it/150x100" alt="..." s10kgbb4p="">
                                                        <img src="https://placehold.it/150x100" alt="..." s10kgbb4p="">
                                                        <img src="https://placehold.it/150x100" alt="..." s10kgbb4p="">
                                                        <img src="https://placehold.it/150x100" alt="..." s10kgbb4p="">
                                                    </div>
                                                </div>
                                            </div>


                                            <div>
                                                <i class="fas fa-video bg-maroon"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> 5 days ago</span>
                                                    <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>
                                                    <div class="timeline-body">
                                                        <div class="embed-responsive embed-responsive-16by9">
                                                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" allowfullscreen=""></iframe>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a href="#" class="btn btn-sm bg-maroon">See comments</a>
                                                    </div>
                                                </div>
                                            </div> -->

                                            <div>
                                                <i class="fas fa-clock bg-gray"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
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