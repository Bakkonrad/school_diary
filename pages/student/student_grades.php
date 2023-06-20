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
    <title>KoalaSchool | Oceny</title>
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
                    </ul>
                </div>

                <!-- Right navbar links -->
                <div class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
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
                            <i class="fa fa-users"></i> 
                            </div>
                            <div class="col-11">
                            <span class="text-muted">klasa:</span> $_SESSION[class] <!-- trzeba zaciągnąć klasę -->
                            </div> <!-- /.col -->
                        </div> <!-- /.row -->
                        <br>
                    </p>
                </div>
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
                </div>
            </div>
        </nav> <!-- /.navbar -->

        <!-- Content Header (Page header) -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <br>
                    <div class="card card-outline card-olive">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-8">
                                    <h3>Twoje oceny</h3>
                                </div>
                                <div class="col-4">
                                    <div class="card card-outline card-olive shadow collapsed-card" >
                                        <div class="card-header">
                                            <h5 class="card-title">Informacja</h5>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" id="toolBtn" data-card-widget="collapse"><i class="fas fa-plus" ></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body" id="card-info">
                                        <p>Kliknij na ocenę, aby wyświetlić więcej informacji.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <br>
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:30%">Przedmiot</th>
                                                            <th>Oceny</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        // Zapytanie o dane uczniów z danej klasy
                                                        require "../../scripts/connect.php";
                                                        $sql = "SELECT * FROM `grades` JOIN `types_of_grades` ON `grades`.`grade` = `types_of_grades`.`id` JOIN `users` ON `grades`.`added_by` = `users`.`id` WHERE `grades`.`student` = '$_SESSION[id]';";
                                                        $result = $conn->query($sql);

                                                        if ($result->num_rows == 0) {
                                                            echo "<tr><td colspan ='2'>Brak ocen!</td></tr>";
                                                        } else {
                                                            $gradesBySubject = array();

                                                            while ($row = $result->fetch_assoc()) {
                                                                $subjectId = $row['subject'];
                                                                $grade = $row['grade'];
                                                                $addedBy = $row['firstName'] . " " . $row['lastName'];
                                                                $date = $row['created_at'];
                                                                $note = $row['note'];

                                                                // Sprawdź, czy istnieje już tablica ocen dla danego przedmiotu
                                                                if (!isset($gradesBySubject[$subjectId])) {
                                                                    $gradesBySubject[$subjectId] = array();
                                                                }

                                                                // Dodaj ocenę do tablicy ocen dla danego przedmiotu
                                                                $gradesBySubject[$subjectId][] = array(
                                                                    'grade' => $grade,
                                                                    'addedBy' => $addedBy,
                                                                    'date' => $date,
                                                                    'note' => $note
                                                                );
                                                                // $gradesBySubject[$subjectId][] = $grade;
                                                            }

                                                            // Wyświetl oceny dla poszczególnych przedmiotów
                                                            foreach ($gradesBySubject as $subjectId => $grades) {
                                                                $sql2 = "SELECT * FROM `subjects` WHERE `id` = '$subjectId';";
                                                                $result2 = $conn->query($sql2);
                                                                $row2 = $result2->fetch_assoc();

                                                                echo "<tr>";
                                                                echo "<td><h5>" . $row2['name'] . "</h5></td>";
                                                                echo "<td>";
                                                                $index = 1;
                                                                
                                                                foreach ($grades as $gradeData) {
                                                                    $modalId = "gradeInfo-$subjectId-$index"; // Unikalny identyfikator modalu
                                                                    $grade = $gradeData['grade'];
                                                                    echo '<button type="button" id="gradeBtn" class="btn btn-olive" data-toggle="modal" data-target="#' . $modalId . '">' . $grade . '</button>';
                                                                    $index++; // Zwiększenie indeksu dla kolejnego modalu
                                                                }

                                                                echo "</td>";
                                                                echo "</tr>";

                                                                $index = 1;
                                                                foreach ($grades as $gradeData) {
                                                                    $modalId = "gradeInfo-$subjectId-$index";
                                                                    echo <<< HTML
                                                                    <div class="modal fade" id="$modalId" aria-modal="true" role="dialog">
                                                                        <div class="modal-dialog modal-sm">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">Więcej informacji</h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">×</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p>Ocena: <b>$gradeData[grade]</b></p>
                                                                                    <p>Przedmiot: <b>$row2[name]</b></p>
                                                                                    <p>Dodane przez: <b>$gradeData[addedBy]</b></p>
                                                                                    <p>Data wystawienia: <b>$gradeData[date]</b></p>
                                                                                    <p>Notatka: <b>$gradeData[note]</b></p>
                                                                                </div>
                                                                                </div>

                                                                            </div>

                                                                            </div> <!-- /.modal -->
                                                                    HTML;
                                                                                $index++; // Zwiększenie indeksu dla kolejnego modalu
                                                                            }
                                                                }
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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