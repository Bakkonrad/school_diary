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
  <title>KoalaSchool | Dodawanie ocen</title>

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
              <a href="admin_main.php" class="nav-link">Strona główna</a>
            </li>
            <li class="nav-item">
              <a href="admin_edit_users.php" class="nav-link">Użytkownicy</a>
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
        <div class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <!-- ACCOUNT ICON -->
          <div class="dropdown user user-menu open nav-item">
            <a class="nav-link" data-toggle="dropdown" aria-expanded="true">
            <span class="fa fa-stack">
              <i class="fa fa-thin fa-circle fa-stack-2x"></i>
              <i class="fa fa-solid fa-user-shield fa-stack-1x fa-inverse" id="navbar-dropdown-btn"></i>
            </span>
            </a>
            <ul class="dropdown-menu" >
              <li class="user-header">
                <img src="../../resources/admin.jpg" class="img-circle" alt="User Image">
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
                    <a href="../../scripts/logout.php" type="button" id="logout-btn" class="btn btn-block btn-danger" >Wyloguj</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
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
                    <form action="./admin_add_grade.php" method="post">
                      <label>Szukaj ocen ucznia:<input type="text" class="form-control form-control-sm" name="student" placeholder="Login ucznia" aria-controls="example1"></label>
                      <button type="submit" class="btn btn-secondary btn-sm" name="search">Szukaj</button>
                    </form>
                      <div class="d-flex justify-content-center align-items-center">
                                                <a href="./admin_add_grade.php?addGrade=true"><button type="submit" class="btn bg-olive btn-block" >Dodaj ocenę</button></a>
                                            </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- okienko do edytowania użytownika -->
                                        <?php
                                            if(isset($_GET["addGrade"]) && ($_GET["addGrade"] == "true")) //jeśli w adresie url jest zmienna addGrade
                                            {
                                                require_once "../../scripts/connect.php";
                                                
                                                echo <<< HTML
                                                <div class="card card-primary">
                                                <!-- <div class="card-header text-center">
                                                  <h3>Dodaj ocenę</h3>
                                                </div> -->
                                                <form action="../../scripts/add_grade.php" method="post">
                                            <div class="input-group mb-3">
                                            <select class="form-control" name="class" id="class">
                                            HTML;
                                                    
                                                    require "../../scripts/connect.php";
                                                    $sql = "SELECT * FROM `classes`";
                                                    $result = $conn->query($sql);
                                                    while ($class = $result->fetch_assoc()) {
                                                        echo "<option
                                                        value='$class[class_id]'>$class[class]</option>";
                                                    }
                                                    echo <<< HTML
                                                </select>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-people-group"></span>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3" >
                                                <select class="form-control" name="student" id="student">

                                                </select>
                                            <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-people-group"></span>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="input-group mb-3">
                                            <select class="form-control" name="subject" id="subject">
                                            HTML;
                                                    
                                                    require "../../scripts/connect.php";
                                                    $sql = "SELECT * FROM `subjects`";
                                                    $result = $conn->query($sql);
                                                    while ($subject = $result->fetch_assoc()) {
                                                        echo "<option
                                                        value='$subject[id]'>$subject[name]</option>";
                                                    }
                                                    echo <<< HTML
                                                </select>
                                            <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-people-group"></span>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                            <select class="form-control" name="grade" id="grade">
                                            HTML;
                                                    
                                                    require "../../scripts/connect.php";
                                                    $sql = "SELECT * FROM `types_of_grades`";
                                                    $result = $conn->query($sql);
                                                    while ($grade = $result->fetch_assoc()) {
                                                        echo "<option
                                                        value='$grade[id]'>$grade[grade]</option>";
                                                    }
                                                    echo <<< HTML
                                                </select>
                                            <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-people-group"></span>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                  <input type="text" class="form-control" name="note" placeholder="Notatka">
                                                  <div class="input-group-append">
                                                      <div class="input-group-text">
                                                          <span class="fas fa-user"></span>
                                                      </div>
                                                  </div>
                                              </div>
                                            <!-- /.col -->
                                            <div class="d-flex justify-content-center align-items-center">
                                                <button type="submit" class="btn bg-olive btn-block">Dodaj ocenę</button>
                                            </div>
                                            <!-- /.col -->
                                            </div>
                                            </form>
                                            </div>
                                            HTML;
                                            }
                                            ?>
                                        <!-- okienko do edytowania użytownika -->
                <div class="row">
                  <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                      <thead>
                        <tr>
                          <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Imię ucznia</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Nazwisko ucznia</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Login ucznia</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Ocena</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Notatka</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Przedmiot</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Dodał</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Data dodania oceny</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Edytuj</th>
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

                                    
                                    if((isset($_POST['student'])) && (!empty($_POST['student'])))
                                    {
                                      $student = $_POST['student'];

                                      $sql = "SELECT COUNT(*) FROM `users`WHERE `users`.`login` = '$student';";  //zapytanie zliczające wszystkie rekordy
                                      $result = $conn->query($sql);
                                      $row = $result->fetch_assoc();
                                      $student_exists = $row['COUNT(*)']; //liczba wszystkich rekordów w bazie

                                      if($student_exists == 0)
                                      {
                                        echo <<< HTML
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Uwaga!</strong> Uczeń o podanym loginie nie istnieje w bazie danych.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                        </button>
                                        HTML;
                                      }
                                      
                                      $sql = "SELECT COUNT(*) AS all_student_grades FROM `grades` JOIN `users` ON `grades`.`student` = `users`.id WHERE `users`.`login` = '$student';";  //zapytanie zliczające wszystkie rekordy
                                      $result = $conn->query($sql);
                                      $row = $result->fetch_assoc();
                                      $all_modified_grades = $row['all_student_grades']; //liczba wszystkich rekordów w bazie
                                      $numberOfPages = ceil($all_modified_grades / $recordsPerPage); //liczba stron
  
                                      $sql = "SELECT users.login,users.firstName, users.lastName, grades.grade, grades.note, grades.subject, grades.added_by, grades.created_at, grades.operation_id FROM `users` JOIN `grades` ON `users`.`id` = `grades`.`student` WHERE `users`.`login` = '$student' ORDER BY `grades`.`created_at` DESC LIMIT $recordsPerPage OFFSET " . ($currentPage - 1) * $recordsPerPage . ";";
  
                                      $result = $conn->query($sql);

                                      if($result->num_rows == 0)
                                      {
                                          //$all_student_grades = 0;
                                          echo "<tr><td colspan ='100%'>Brak ocen!</td></tr>";
                                      }
                                      else // jesli sa rekordy w tabli to je wyswietl
                                      {
                                          while($user = $result->fetch_assoc())
                                          {
                                              echo <<< HTML
                                              <tr>
                                          <td class="dtr-control sorting_1" tabindex="0">$user[firstName]</td>
                                                  <td>$user[lastName]</td>
                                                  <td>$user[login]</td>
                                                  <td>$user[grade]</td>
                                                  <td>$user[note]</td>
                                                  <td>$user[subject]</td>
                                                  <td>$user[added_by]</td>
                                                  <td>$user[created_at]</td>
                                                  <td><a href="./admin_modify_grade.php?user=$operation_id[operation_id]">Edytuj</a></td>
                                              </tr>
                                          HTML;
                                          }
                                      }
                                      $conn->close();
                                    }
                                    
                                    //jeśli został wybrany student ale nie ma takiego w bazie
                                    // elseif((isset($_POST['student'])) && (!empty($_POST['student'])) && ($student_exists == 0))
                                    // {
                                    //   echo "<tr><td colspan ='100%'>Nie ma takiego ucznia!</td></tr>";
                                    //   $numberOfPages = 1; //liczba stron kiedy nie ma takiego ucznia
                                    // }
                                    else
                                    {
                                      echo "<tr><td colspan ='100%'>Podaj imię i nazwisko ucznia!</td></tr>";
                                      $numberOfPages = 1; //liczba stron kiedy nie podano danych do wyszukania
                                    }
                        ?>
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
            <a href="./admin_add_grade.php?page=$previousPage" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Poprzednia</a>
        </li>
        HTML;
                        }

                        for ($i = 1; $i <= $numberOfPages; $i++) //przyciski z numerami stron
                        {
                          echo <<<HTML
        <li class="paginate_button page-item">
            <a href="./admin_add_grade.php?page=$i" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">$i</a>
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
            <a href="./admin_add_grade.php?page=$nextPage" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Następna</a>
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
      <img src="../../resources/logo.png" width="100" height="32">
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

  <script>
  // Pobieranie uczniów na podstawie wybranej klasy
  function getStudentsByClass() {
    var selectedClass = document.getElementById("class").value;

    // Wywołanie żądania AJAX, aby pobrać uczniów z serwera
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() { 
      if (this.readyState == 4 && this.status == 200) {
        var students = JSON.parse(this.responseText);

        // Wyczyść listę uczniów
        var studentSelect = document.getElementById("student");
        studentSelect.innerHTML = "";

        // Dodaj nowych uczniów do listy
        for (var i = 0; i < students.length; i++) {
          var studentOption = document.createElement("option");
          studentOption.value = students[i].id;
          studentOption.text = students[i].name;
          studentSelect.appendChild(studentOption);
        }
      }
    };
    
    // Przesyłanie danych do skryptu PHP, który pobierze uczniów
    xmlhttp.open("GET", "../../scripts/get_students.php?class=" + selectedClass, true);
    xmlhttp.send();
  }
  // Dodaj wywołanie funkcji getStudentsByClass() na zmianę wybranej klasy
  document.getElementById("class").addEventListener("change", getStudentsByClass);
</script>

</body>


</html>