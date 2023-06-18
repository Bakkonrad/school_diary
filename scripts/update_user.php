<?php
session_start();
function sanitizeInput($input)
{
    return (htmlentities(stripcslashes(trim($input))));
}

// if (!isset($_SESSION['isLogged'])) {
//     header('Location: ../index.php');
//     exit();
// }
if($_SESSION['role'] != 1)
{
    header("Location: ../pages/index.php");
    exit();
}
    //print_r($_POST);
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        header("Location: ../pages/index.php");
        exit();
    }

    $requiredFields = ["firstName", "lastName", "birthday", "email", "confirm_email","login", "class", "role"]; //tablica z wymaganymi polami
    $errors= [];
    $userUpdateId = $_SESSION['userUpdateId'];

    foreach ($requiredFields as $key => $value) {
    if (empty($_POST[$value])) {
        $errors[] = "Pole <b>$value</b> nie może być puste!";
    }
    }
    if ($_POST['email'] != $_POST['confirm_email']) {
        $errors[] = "Pola <b>email</b> i <b>potwierdź email</b> muszą być takie same!";
    }
    //czy login posiada conajmniej 3 znaki
    if (strlen($_POST['login']) < 3) {
        $errors[] = "Pole <b>login</b> musi mieć co najmniej 3 znaki!";
    }
    //czy login posiada maksymalnie 30 znaków
    if (strlen($_POST['login']) > 30) {
        $errors[] = "Pole <b>login</b> może mieć maksymalnie 30 znaków!";
    }
    //czy login zawiera tylko znaki alfanumeryczne
    if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['login'])) {
        $errors[] = "Pole <b>login</b> może zawierać tylko znaki alfanumeryczne!";
    }
    //czy email jest poprawny
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Pole <b>email</b> musi być poprawnym adresem email!";
    }
    //czy data urodzenia jest wcześniejsza niż dzisiejszy dzień
    if (strtotime($_POST['birthday']) > strtotime(date("Y-m-d"))) {
        $errors[] = "Pole <b>data urodzenia</b> nie może być późniejsza niż dzisiejszy dzień!";
    }

    require_once "./connect.php";
    $result = $conn->query("SELECT id FROM users WHERE email = '$_POST[email]' AND id != '$userUpdateId'"); //sprawdzamy czy istnieje już konto przypisane do tego adresu email i czy nie jest to aktualizowane konto

    $howManyEmails = $result->num_rows;
    if($howManyEmails > 0)
    {
        $errors[] = "Istnieje już inne konto przypisane do tego adresu email!";
    }

    $result = $conn->query("SELECT id FROM users WHERE LOWER(login) = '$_POST[login]' AND id != '$userUpdateId'");
    $howManyLogins = $result->num_rows;
    if($howManyLogins > 0)
    {
        $errors[] = "Istnieje już inne konto przypisane do tego loginu!";
    }

    if (!empty($errors)) {
        //$_SESSION['errors'] = implode("<br>", $errors);
        $_SESSION['errors'] = $errors;
        echo "<script>history.back();</script>"; //wraca do podstrony rejestracji i wyswietla bledy
        exit();
    }

    foreach ($_POST as $key => $value) { 
        ${$key} = sanitizeInput($value); //tworzenie zmiennych np.firstName
    }


    $stmt = $conn->prepare("UPDATE `users` SET `firstName` = ?, `lastName` = ?, `birthday` = ?, `email` = ?, `login` = ?, `class` = ?, `role` = ? WHERE `users`.`id` = '$userUpdateId'");
    $stmt->bind_param('sssssii', $firstName, $lastName, $birthday, $email,strtolower($login),$class, $role );

    $stmt->execute();

    //echo $stmt->affected_rows;

    if ($stmt->affected_rows > 0) {
        $_SESSION['notification'] = "Udało się zaktualizować użytkownika!";
        echo "<script>history.back();</script>"; //wraca do podstrony rejestracji i wyswietla bledy
    }
    else {
        $errors = "Nie udało się zaktualizować użytkownika!";
        $_SESSION['errors'] = $errors;
        echo "<script>history.back();</script>"; //wraca do podstrony rejestracji i wyswietla bledy
    }

    $conn->close();

?>