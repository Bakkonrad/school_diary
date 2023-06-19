<?php
session_start();

// if (!isset($_SESSION['isLogged'])) {
//     header('Location: ../index.php');
//     exit();
// }
if($_SESSION['role'] != 1)
{
    header("Location: ../pages/index.php");
    exit();
}
//print_r($_POST);
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    header("Location: ../pages/index.php");
    exit();
}

    require_once "connect.php";
    $gradeId = $_GET['gradeId'];
    // echo "Id oceny: ".$_POST['grade']."<br>";

    $stmt = $conn->prepare("UPDATE `grades` SET `grade` = ?, `modified_at` = ? WHERE `grades`.`operation_id` = '$gradeId'");
    $stmt->bind_param('is', $_POST['grade'], date("Y-m-d H:i:s", time()) );

    $stmt->execute();

    // echo $stmt->affected_rows;

    if ($stmt->affected_rows > 0) {
        $_SESSION['notification'] = "Udało się zaktualizować ocenę!";
    }
    else {
        $errors = "Nie udało się zaktualizować oceny!";
        $_SESSION['errors'] = $errors;
    }

    $conn->close();

    //przejscie do strony z ocenami
    header('Location: ../pages/admin/admin_show_grades.php');
    exit();
?>