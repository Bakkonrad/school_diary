<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>KoalaSchool | Konto</title>

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
        <a href="teacher_main.php" class="navbar-brand">
        <span class="brand-text"><b>dziennik</b><br>lekcyjny</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
            <a href="teacher_main.php" class="nav-link">Strona główna</a>
            </li>
            <li class="nav-item">
            <a href="teacher_show_grades.php" class="nav-link">Wyświetl oceny</a>
            </li>
            <li class="nav-item">
            <a href="teacher_add_grade.php" class="nav-link">Dodaj ocenę</a>
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
            <a href="teacher_account.php" class="nav-link">
                <i class="fa fa-solid fa-user" style="color: #ffffff;"></i>
            </a>
        </li>
        </ul>
    </div>
    </nav> <!-- /.navbar -->

    <!-- Content Header (Page header) -->
    <div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <h1 class="m-0">Konto użytkownika</h1>
            <!-- <h1 class="m-0"> Strona główna <small>zalogowany</small></h1> -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
        <div class="row">
            <div class="col-lg-6">
            <div class="card card-primary card-outline">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>

                <p class="card-text">
                    Some quick example text to build on the card title and make up the bulk of the card's
                    content.
                </p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
                </div>
            </div> <!-- /.card -->
            </div> <!-- /.col-md-6 -->
            <div class="col-lg-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                <h5 class="card-title m-0">Featured</h5>
                </div>
                <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            </div> <!-- /.col-md-6 -->
        </div> <!-- /.row -->
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
