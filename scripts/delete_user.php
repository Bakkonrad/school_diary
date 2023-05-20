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

    require_once "./connect.php";
    $sql = "DELETE FROM users WHERE `users`.`id` = '$_GET[userDeleteId]'";
    $conn->query($sql);

    $errors = array();

    //echo $conn->affected_rows; //ilosc usunietych rekordow

    if($conn->affected_rows == 0) //nie usunieto
    {
        $errors[] = "Nie ma takiego użytkownika!";
    }
    else
    {
        $_SESSION['notification'] = "Użytkownik został usunięty!";
    }

    $conn->close();

    $_SESSION['errors'] = $errors;

    echo "<script>history.back();</script>"; //wraca do poprzedniej strony i pokazuje błędy
    exit();

?>