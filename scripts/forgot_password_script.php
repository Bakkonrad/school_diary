<?php
// Path: scripts\forgot_password.php

if ($_SERVER["REQUEST_METHOD"] != "POST") { //ochrona przed wejsciem na strone przez url

    header("Location: ../index.php");
    exit();
}
else
{
    //delete session variables 
    // foreach ($_SESSION as $key => $value) {
    //     unset($_SESSION[$key]);
    // }

    session_start();
    $errors= [];

    if (empty($_POST['email'])) 
    {
        $errors[] = "Pole <b>hasło</b> nie może być puste!";
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = implode("<br>", $errors);
        echo "<script>history.back();</script>"; //wraca do poprzedniej strony i pokazuje błędy
        exit();
    }

    $email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');

    require_once "./connect.php";

    if($result = $conn->query(
        sprintf("SELECT * FROM users WHERE email = '%s'", //sprawdzenie czy istnieje taki uzytkownik
        mysqli_real_escape_string($conn,$email)))) //true
    {
        $how_many_users = $result->num_rows; //liczba znalezionych kont

            if($how_many_users == 1 ) //powinniśmy dać równe 1
            {
                $result->close(); //lub free() albo free_result()
                $_SESSION['notification'] = "Na podany adres email zostało wysłane hasło!";
                
                //downloadUserData($_SESSION['id']); //pobieramy dane uzytkownika
                echo "<script>history.back();</script>";
                exit();
                
            }
            else
            {
                $_SESSION['errors'] = "Nie ma takiego użytkownika!";
                echo "<script>history.back();</script>"; //wraca do poprzedniej strony i pokazuje błędy
                exit();
            }
    }
}

?>