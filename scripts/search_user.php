<?php
session_start();

//jeśli skrypt nie został wywołany metodą POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: ../index.php");
    exit();
}

$name_and_surname = $_POST['name_and_surname'];
//podzielić na imię i nazwisko
//sprawdzenie czy podano dwa wyrazy
if (substr_count($name_and_surname, " ") != 1) {
    $_SESSION['errors'][0] = "Podaj imię i nazwisko";
    echo "<script>history.back();</script>"; //wraca do poprzedniej strony
    exit();
}
$name_and_surname = explode(" ", $name_and_surname);
$_SESSION['name'] = $name_and_surname[0];
$_SESSION['surname'] = $name_and_surname[1];

echo "<script>history.back();</script>"; //wraca do poprzedniej strony
//exit();




?>