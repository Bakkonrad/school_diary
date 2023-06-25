<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] != "POST") { //ochrona przed wejsciem na strone przez url

        header("Location: ../pages/index.php");
        exit();
    }

    //jeśli nie podano wszystkich danych
    if (!isset($_POST['grade']) || !isset($_POST['subject'])) {
        $_SESSION['errors'] = "Nie podano wszystkich danych!";
        echo "<script>history.back();</script>"; //wraca do podstrony rejestracji i wyswietla bledy
        exit();
    }

    foreach ($_POST as $key => $value) {
        ${$key} = $value; //tworzenie zmiennych np.firstName
    }



    require_once "connect.php";
    //dodawanie oceny do tabeli grades
    $stmt = $conn->prepare("INSERT INTO `grades` (`grade`, `note`, `subject`, `student`, `added_by`) VALUES (?,?,?,?,?)");
    $stmt->bind_param('isiii', $grade, $note, $subject, $user_id, $_SESSION['id']);
    $stmt->execute();

    // dodanie informacji o dodaniu oceny do tabeli history_of_grades aby potem wykorzystać tą informacje w historii modyfikacji ocen
    // $stmt = $conn->prepare("INSERT INTO `history_of_grades` (`grade_id`, `student`, `new_grade`,`added_by`) VALUES (?,?,?,?)");
    // $stmt->bind_param('iiii', $grade_id, $student, $grade, $added_by);
    // $stmt->execute();

    // echo $stmt->affected_rows;

    if ($stmt->affected_rows > 0) {
        $_SESSION['notification'] = "Udało się dodać ocenę!";
    }
    else {
        $_SESSION['errors'] = "Nie udało się dodać oceny!";
    }
    $conn->close();

    if($_SESSION['role'] == 1)
    {
        //przejscie do strony z ocenami
        header('Location: ../pages/admin/admin_modify_grades.php');
        exit();
    }
    else if ($_SESSION['role'] == 2)
    {
        //przejscie do strony z ocenami
        header('Location: ../pages/teacher/teacher_modify_grades.php');
        exit();
    }


    ?>

