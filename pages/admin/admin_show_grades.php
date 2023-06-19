<?php
// session_cache_limiter('private, must-revalidate');
// session_cache_expire(60); //
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
    <title>KoalaSchool | Oceny ucznia</title>
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
                <a href="admin_main.php" class="navbar-brand">
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
            </div>
        </nav> <!-- /.navbar -->

        <!-- Content Header (Page header) -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container">
                <?php
                    if (isset($_SESSION['errors'])) //jesli nie udało się dodać oceny
                    {
                        echo <<< HTML
                            <br>
                            <div class="callout callout-success">
                            <h5>BŁĄD!</h5>
                            <p>$_SESSION[errors]</p>
                            </div>
                            HTML;
                        unset($_SESSION['errors']);
                    }
                    if (isset($_SESSION['notification'])) //jesli udało się dodać ocenę
                    {
                    echo <<< HTML
                        <br>
                        <div class="callout callout-success">
                        <h5>SUKCES!</h5>
                        <p>$_SESSION[notification]</p>
                        </div>
                        HTML;
                    unset($_SESSION['notification']);
                    }
                    ?>
                    <br>
                    <div class="card card-outline card-olive">
                        <!-- /.card-header -->
                        <div class="card-body">
                        <?php
                        if(isset($_POST['student_id']))
                        {
                            $_SESSION['studentId'] = $_POST['student_id'];
                        }
                            $studentId = $_SESSION['studentId'];
                            // Zapytanie o dane uczniów z danej klasy
                            require "../../scripts/connect.php";
                            $sql = "SELECT * FROM grades JOIN types_of_grades ON grades.`grade` = types_of_grades.`id` JOIN users ON grades.`added_by` = users.`id` WHERE grades.`student` = '$studentId';";
                            $result = $conn->query($sql);
                            
                            // Pobierz imię ucznia na podstawie $studentId
                            $sql1 = "SELECT firstName, lastName FROM users WHERE id = '$studentId';";
                            $result1 = $conn->query($sql1);
                            $row1= $result1->fetch_assoc();

                            echo <<<HTML
                            <div class="row">
                                <div class="col-8">
                                    <h3>Oceny ucznia: <b>$row1[firstName] $row1[lastName]</b></h3>
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
                                        <p>Kliknij na ocenę, aby wyświetlić więcej informacji oraz móc ją edytować.</p>
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
                            HTML;
                                                    if(isset($_POST['student_id']))
                                                    {
                                                        $_SESSION['studentId'] = $_POST['student_id'];
                                                    }
                                                        $studentId = $_SESSION['studentId'];
                                                        // Zapytanie o dane uczniów z danej klasy
                                                        require "../../scripts/connect.php";
                                                        $sql = "SELECT * FROM grades JOIN types_of_grades ON grades.`grade` = types_of_grades.`id` JOIN users ON grades.`added_by` = users.`id` WHERE grades.`student` = '$studentId';";
                                                        $result = $conn->query($sql);
                                                        
                                                        if ($result->num_rows == 0) {
                                                            echo "<tr><td colspan='2'>Brak ocen!</td></tr>";
                                                        } else {
                                                            $gradesBySubject = array();
                                                            while ($row = $result->fetch_assoc()) {
                                                                $subjectId = $row['subject'];
                                                                $grade = $row['grade'];
                                                                $addedBy = $row['firstName'] . " " . $row['lastName'];
                                                                $date = $row['created_at'];
                                                                $modificationDate = $row['modified_at'];
                                                                $note = $row['note'];
                                                                $gradeId = $row['operation_id'];

                                                                // Sprawdź, czy istnieje już tablica ocen dla danego przedmiotu
                                                                if (!isset($gradesBySubject[$subjectId])) {
                                                                    $gradesBySubject[$subjectId] = array();
                                                                }

                                                                // Dodaj ocenę do tablicy ocen dla danego przedmiotu
                                                                $gradesBySubject[$subjectId][] = array(
                                                                    'grade' => $grade,
                                                                    'addedBy' => $addedBy,
                                                                    'date' => $date,
                                                                    'modificationDate' => $modificationDate,
                                                                    'note' => $note,
                                                                    'gradeId' => $gradeId
                                                                );
                                                            }

                                                            // Wyświetl oceny dla poszczególnych przedmiotów
                                                            foreach ($gradesBySubject as $subjectId => $grades) {
                                                                $sql2 = "SELECT * FROM subjects WHERE id = '$subjectId';";
                                                                $result2 = $conn->query($sql2);
                                                                $row2 = $result2->fetch_assoc();
                                                                $subject = $row2['name'];

                                                                echo "<tr>";
                                                                echo "<td><h5>" . $row2['name'] . "</h5></td>";
                                                                echo "<td>";
                                                                $index = 1;

                                                                foreach ($grades as $gradeData) {
                                                                    $modalId = "gradeInfo-$subjectId-$index"; // Unikalny identyfikator modalu
                                                                    $editModalId = "editGrade-$subjectId-$index"; // Unikalny identyfikator modalu edycji
                                                                    $grade = $gradeData['grade'];
                                                                    echo '<button type="button" id="gradeBtn" class="btn btn-olive" data-toggle="modal" data-target="#' . $modalId . '">' . $grade . '</button>';
                                                                    $index++; // Zwiększenie indeksu dla kolejnego modalu
                                                                }

                                                                echo "</td>";
                                                                echo "</tr>";
                                                            
                                                                // Wyświetl modale
                                                                $index = 1;
                                                                foreach ($grades as $gradeData) {
                                                                    $modalId = "gradeInfo-$subjectId-$index"; // Unikalny identyfikator modalu z informacjami o ocenie
                                                                    $editModalId = "editGrade-$subjectId-$index"; // Unikalny identyfikator modalu edycji
                                                                    echo <<<HTML
                                                                    <!-- Modal z info o ocenie -->
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
                                                                                    <p>Ocena: <b>{$gradeData['grade']}</b></p>
                                                                                    <p>Przedmiot: <b>{$subject}</b></p>
                                                                                    <p>Nauczyciel: <b>{$gradeData['addedBy']}</b></p>
                                                                                    <p>Data wystawienia: <b>{$gradeData['date']}</b></p>
                                            HTML;
                                                                                    if ($gradeData['modificationDate'] != null) {
                                                                                        echo "<p>Data modyfikacji: <b>". $gradeData['modificationDate'] ."</b></p>";
                                                                                    }
                                                                    echo <<<HTML
                                                                                    <p>Notatka: <b>{$gradeData['note']}</b></p>
                                                                                </div>
                                                                                <div class="modal-footer justify-content-between">
                                                                                    <button type="button" class="btn" id="cancelBtn" data-dismiss="modal">Anuluj</button>
                                                                                    <button type="button" class="btn" data-dismiss="modal" data-toggle="modal" data-target="#$editModalId" >Edytuj</button>
                                                                                    <a href="../../scripts/delete_grade.php?gradeId=$gradeData[gradeId]" class="btn" id="delete-btn">Usuń</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Modal do edycji oceny -->
                                                                    <div class="modal fade" id="$editModalId" aria-modal="true" role="dialog">
                                                                        <div class="modal-dialog modal-sm">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">Edycja oceny <b>$gradeData[grade]</b> z przedmiotu <b>$subject</b></h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">×</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                <label for="grade">Wybierz nową ocenę</label>
                                                                                <form action="../../scripts/modify_grade.php?gradeId=$gradeData[gradeId]" method="post">
                                                                                <div class="input-group mb-3">
                                                                                <select class="form-control" name="grade">
                                                                                <option hidden selected value >$gradeData[grade]</option>
                                                                    HTML;
                                                                                    require "../../scripts/connect.php";
                                                                                    $sql = "SELECT * FROM `types_of_grades`";
                                                                                    $result = $conn->query($sql);
                                                                                    while ($type_of_grade = $result->fetch_assoc()) {
                                                                                        echo "<option
                                                                                        value='$type_of_grade[id]'>$type_of_grade[grade]</option>";
                                                                                    }
                                                                                    echo <<< HTML
                                                                                    </select>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text">
                                                                                            <span class="fa fa-list-ol"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer justify-content-between">
                                                                                <button type="button" class="btn" id="cancelBtn" data-dismiss="modal">Anuluj</button>
                                                                                <button type="submit" class="btn">Zmodyfikuj</button>
                                                                            </div>
                                                                        </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
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
                                <div class="row">
                                    <div class="col-3">
                                        <a href="admin_modify_grades.php" class="btn btn-olive">Powrót do widoku uczniów</a>
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