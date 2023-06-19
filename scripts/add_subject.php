<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(!isset($_POST['subject']) || empty($_POST['subject'])) {
        $_SESSION['errors'] = "Nie podano nazwy przedmiotu!";
        echo "<script>history.back();</script>"; //wraca do podstrony rejestracji i wyswietla bledy
        exit();
    }
    
    foreach ($_POST as $key => $value) {
        ${$key} = $value; //tworzenie zmiennych np.firstName
    }

    $subject = strtolower($subject);

    require "./connect.php";
    $result = $conn->query("SELECT id FROM subjects WHERE name = '$subject' AND class = '$class_subject'");

    $ifSubjectExist = $result->num_rows;
    if($ifSubjectExist > 0)
    {
        $_SESSION['errors'] = "Klasa ma już taki przedmiot!";
        echo "<script>history.back();</script>"; //wraca do podstrony rejestracji i wyswietla bledy
        exit();
    }

    require "./connect.php";

    $stmt = $conn->prepare("INSERT INTO `subjects` (`teacher`, `class`, `name`) VALUES (?,?,?)");
    $stmt->bind_param('iis', $teacher, $class_subject, $subject);
    $stmt->execute();

    //echo $stmt->affected_rows;

    if ($stmt->affected_rows > 0) {
        $_SESSION['notification'] = "Udało się dodać przedmiot!";
        echo "<script>history.back();</script>"; //wraca do podstrony rejestracji i wyswietla bledy
    }
    else {
        $_SESSION['errors'] = "Nie udało się dodać przedmiotu!";
        echo "<script>history.back();</script>"; //wraca do podstrony rejestracji i wyswietla bledy
    }

    $conn->close();

}


?>