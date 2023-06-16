<?php
session_start();

//jeśli nie jest wywołane metodą get
if($_SERVER['REQUEST_METHOD'] != 'GET'){
    header('Location: ../index.php');
    exit();
}

//jeśli nie jesteś adminem
if($_SESSION['role'] != '1'){
    header('Location: ../index.php');
    exit();
}

$gradeId = $_GET['gradeId'];

echo $gradeId;





?>