<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") //ochrona przed wejsciem na strone przez url
{
    header("Location: ../index.php");
    exit();
}


    require_once "./connect.php";
    $sql = "DELETE FROM users WHERE `users`.`id` = '$_POST[userDeleteId]'";
    $conn->query($sql);

    //echo $conn->affected_rows; //ilosc usunietych rekordow

    if($conn->affected_rows == 0) //nie usunieto
    {
        $_SESSION['errors'] = "Nie ma takiego użytkownika!";
    }
    else
    {
        $_SESSION['notification'] = "Użytkownik został usunięty!";
    }

    echo "<script>history.back();</script>"; //wraca do poprzedniej strony i pokazuje błędy
    exit();

?>