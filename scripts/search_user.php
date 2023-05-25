<?php
session_start();

//jeśli skrypt nie został wywołany metodą POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: ../index.php");
    exit();
}

$name_and_surname = $_POST['name_and_surname'];
//podzielić na imię i nazwisko
$name_and_surname = explode(" ", $name_and_surname);
$_SESSION['name'] = $name_and_surname[0];
$_SESSION['surname'] = $name_and_surname[1];


$conn->close();
//exit();




?>