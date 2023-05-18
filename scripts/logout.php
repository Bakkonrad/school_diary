<?php  //wylogowanie użytkownika
    session_start();

    //ochrona przed wejsciem na strone przez url
    //$_SESSION['isLogged'] = false;
    session_unset(); //czyszczenie zmiennych sesyjnych
    session_destroy();  //niszczenie sesji
    header('location: ../pages/index.php');
    exit();


?>