<?php
session_start();

// if (!isset($_SESSION['isLogged'])) {
//     header('Location: ../index.php');
//     exit();
// }
if($_SESSION['role'] != 1 && $_SESSION['role'] != 2)
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
    $note = $_POST['note'];
    // echo "Id oceny: ".$_POST['grade']."<br>";

    if(isset($_POST['grade']) && !empty($_POST['grade']))
    {
            $grade = $_POST['grade'];
    }
    else
    {
        $errors = "Nie podano nowej oceny!";
        $_SESSION['errors'] = $errors;
        if ($_SESSION['role'] == 1)
        {
            header('Location: ../pages/admin/admin_show_grades.php');
        }
        else if ($_SESSION['role'] == 2)
        {
            header('Location: ../pages/teacher/teacher_show_grades.php');
        }
        exit();
    }

    $stmt = $conn->prepare("UPDATE `grades` SET `grade` = ?, `modified_at` = ?, `note` = ? WHERE `grades`.`operation_id` = '$gradeId'");
    $stmt->bind_param('iss', $grade, date("Y-m-d H:i:s", time()), $note );

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

    if($_SESSION['role'] == 1)
    {
        header('Location: ../pages/admin/admin_show_grades.php');
        exit();
    }
    else if ($_SESSION['role'] == 2)
    {
        header('Location: ../pages/teacher/teacher_show_grades.php');
        exit();
    }

?>