<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] != "POST") { //ochrona przed wejsciem na strone przez url

        header("Location: ../index.php");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO `grades` (`grade`, `note`, `subject`, `student`, `added_by`) VALUES (?,?,?,?,?)");
    $stmt->bind_param('isiii', $grade, $note, $subject, $student, $added_by);

    $stmt->execute();

    //echo $stmt->affected_rows;

    if ($stmt->affected_rows > 0) {
        $_SESSION['notification'] = "Rejestracja przebiegła pomyślnie!";
        echo "<script>history.back();</script>"; //wraca do podstrony rejestracji i wyswietla bledy
    }
    else {
        $_SESSION['errors'] = "Nie udało się zarejestrować użytkownika!";
        echo "<script>history.back();</script>"; //wraca do podstrony rejestracji i wyswietla bledy
    }

