<?php

    if($_SERVER["REQUEST_METHOD"] != "POST")
    {
        header("location: ../index.php");
        exit();
    }
    session_start();
    //print_r($_POST);
    $errors= [];

    foreach ($_POST as $key => $value)
    {
        //echo "$key: $value<br>";

        if(empty($value))
        {
            $errors[] = "Pole <b>$value</b> nie może być puste!";
        }
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = implode("<br>", $errors);
        echo "<script>history.back();</script>"; //wraca do podstrony rejestracji i wyswietla bledy
        exit();
    }

    require_once "connect.php";
    $sql = "UPDATE `users` SET `city_id` = '$_POST[city_id]', `firstName` ='$_POST[firstName]', `lastName` ='$_POST[lastName]', `birthday` ='$_POST[birthday]' WHERE `users`.`id` = '$_SESSION[userUpdateId]'";

    $conn->query($sql);

    //echo $conn->affected_rows; //1-ok 0-error

    if($conn->affected_rows == 0) //nie zaktualizowano
    {
        $_SESSION['errors'] = "Nie udało się zaktualizować użytkownika!";
    }
    else
    {
        $_SESSION['notification'] = "Użytkownik został zaktualizowany!";
    }

?>