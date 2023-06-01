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
                  <div class="col-sm-12 col-md-6"> 
                    <!-- wybór klas -->
                    <form action="./admin_add_grade.php" method="post">
                    <div class="input-group mb-3">
                <select class="form-control" name="class">
                <?php
                        require "../../scripts/connect.php";
                        $sql = "SELECT * FROM `classes`";
                        $result = $conn->query($sql);
                        while ($class = $result->fetch_assoc()) {
                            if ($class['class_id'] == $_POST['class']) {
                              echo "<option value='$class[class_id]' selected>$class[class]</option>";
                          } else {
                              echo "<option value='$class[class_id]'>$class[class]</option>";
                          }
                        }
                        ?>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-people-group"></span>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn bg-olive btn-block">Wybierz klasę</button>
                </div>
                    </form>
                  </div>
                </div>
                <br>
                <h3>Lista uczniów</h3>
                <?php
                  //jeśli wybrano klase to pokaż tabele z uczniami
                  if((isset($_POST['class'])) || (isset($_SESSION['class_id'])))
                  {
                    if(isset($_POST['class']))
                    {
                      $_SESSION['class_id'] = $_POST['class'];
                    }

                    echo <<<HTML
                  <div class="row">
                  <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                      <thead>
                        <tr>
                          <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Imię</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Nazwisko</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Dodaj ocenę</th>
                        </tr>
                      </thead>
                      <tbody>
                  HTML;
                  //pobranie uczniów z wybranej klasy
                  require "../../scripts/connect.php";
                  mysqli_report(MYSQLI_REPORT_STRICT); //raportowanie o błędach w wyjątkach
                  $recordsPerPage = 30; //ilość rekordów na stronie
                  if (isset($_GET['page'])) //jesli jest ustawiona zmienna page
                  {
                      $currentPage = $_GET['page'];
                  } else {
                      $currentPage = 1;
                  }

                  $sql = "SELECT COUNT(*) AS allUsers FROM `users`;"; //zapytanie zliczające wszystkich uczniów z klasy
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();
                  $allUsers = $row['allUsers']; //liczba wszystkich rekordów w bazie
                  $numberOfPages = ceil($allUsers / $recordsPerPage); //liczba stron

                  //zapytanie o dane uczniów z danej klasy
                  $sql = "SELECT * FROM `users` WHERE `class` = $_SESSION[class_id] ORDER BY `lastName` ASC LIMIT " . (($currentPage - 1) * $recordsPerPage) . ", $recordsPerPage;";
                  $result = $conn->query($sql);

                    if($result->num_rows == 0)
                    {
                        //$all_student_grades = 0;
                        echo "<tr><td colspan ='100%'>Brak uczniów w tej klasie!</td></tr>";
                        $numberOfPages = 1;
                    }
                    else // jesli sa rekordy w tabli to je wyswietl
                    {
                        while($user = $result->fetch_assoc())
                        {
                            echo <<< HTML
                              <tr>
                              <td class="dtr-control sorting_1" tabindex="0">$user[firstName]</td>
                                <td>$user[lastName]</td>
                                <td><button type="button" class="btn btn-danger"  id="delete-btn" data-toggle="modal" data-target="#addGrade$user[id]">Dodaj ocenę</button> 
                                <!-- Modal - dodanie oceny dla ucznia --> 
                                <div class="modal fade" id="addGrade$user[id]" tabindex="0" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="confirmDeleteLabel">Dodaj ocenę </h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                              <form action="../../scripts/add_grade.php" method="post">
                                              <div class="input-group mb-3">
                                                  <select class="form-control" name="subject">
                              HTML;
                                                          require "../../scripts/connect.php";
                                                          $sql = "SELECT * FROM `subjects` WHERE `class` = $_SESSION[class_id]";
                                                          $result = $conn->query($sql);
                                                          while ($subject = $result->fetch_assoc()) {
                                                              echo "<option
                                                              value='$subject[id]'>$subject[subject]</option>";
                                                          }
                                                          
                                                      echo <<< HTML
                                                      </select>
                                                      <div class="input-group-append">
                                                          <div class="input-group-text">
                                                              <span class="fa fa-people-group"></span>
                                                          </div>
                                                      </div>
                                                        </div>
                                                  </select>
                                              <div class="input-group mb-3">
                                                  <select class="form-control" name="grade">
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
                                                              <span class="fa fa-people-group"></span>
                                                          </div>
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
                                                      <button type="submit" class="btn bg-olive btn-block">Ddaj ocenę</button>
                                                  </div>
                                              
                                              </form>
                                          </div>
                                          <div class="modal-footer">
                                              <div class="row">
                                                  <div class="col-4">
                                                      <button type="button" class="btn btn-secondary" style="background-color:grey" data-dismiss="modal">Anuluj</button>
                                                  </div>
                                                  <div class="col-8">
                                                      <a href="../../scripts/add_grade.php?userDeleteId=$user[id]">
                                                          <button type="button" class="btn btn-danger" id="delete-btn">Dodaj ocenę</button>
                                                      </a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div> <!-- /.modal --></td>
                            </tr>
                        HTML;
                        }
                    }
                    $conn->close();
                    //przyciski paginacji
                    echo <<<HTML
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
                    HTML;

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
        </ul>
                      </div>
                      </div>
        HTML;
                        }
                  }
                ?>
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
</body>
</html>