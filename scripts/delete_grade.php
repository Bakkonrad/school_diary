<?php
// header('Cache-Control: no cache'); //no cache
// session_cache_limiter('private_no_expire'); // works
session_start();

//jeśli nie jest wywołane metodą get
if($_SERVER['REQUEST_METHOD'] != 'GET'){
    header('Location: ../pages/index.php');
    exit();
}

//jeśli nie jesteś adminem lub nauczycielem
if($_SESSION['role'] != 1 && $_SESSION['role'] != 2){
    header('Location: ../pages/index.php');
    exit();
}

$gradeId = $_GET['gradeId'];


require_once "./connect.php";
    $sql = "DELETE FROM grades WHERE `grades`.`operation_id` = '$gradeId'";
    $conn->query($sql);

    //$errors = array();

    //echo $conn->affected_rows; //ilosc usunietych rekordow

    if($conn->affected_rows == 0) //nie usunieto
    {
        $_SESSION['errors'] = "Nie udało się usunąć oceny!";
    }
    else
    {
        $_SESSION['notification'] = "Ocena została usunięta!";
    }

    $conn->close();

    if($_SESSION['role'] == 1)
    {
        //przejscie do strony z ocenami
        header('Location: ../pages/admin/admin_show_grades.php');
        exit();
    }
    else if ($_SESSION['role'] == 2)
    {
        //przejscie do strony z ocenami
        header('Location: ../pages/teacher/teacher_show_grades.php');
        exit();
    }







?>