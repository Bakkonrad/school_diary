<?php  //wylogowanie użytkownika
    session_start();

    //ochrona przed wejsciem na strone przez url
    //$_SESSION['isLogged'] = false;
    session_unset();
    session_destroy();
    header('location: ../pages/index.php');
    exit();


?>