<?php

function sanitizeInput($input)
{
    return (htmlentities(stripcslashes(trim($input))));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { //ochrona przed wejsciem na strone przez url
    session_start();

    //print_r($_POST);
    $requiredFields = ["firstName", "lastName", "birthday", "email", "confirm_email","password", "confirm_password", "login", "class", "role"]; //tablica z wymaganymi polami
    $errors= [];
    foreach ($requiredFields as $key => $value) {
    if (empty($_POST[$value])) {
        $errors[] = "Pole <b>$value</b> nie może być puste!";
    }
    }
    if ($_POST['email'] != $_POST['confirm_email']) {
        $errors[] = "Pola <b>email</b> i <b>potwierdź email</b> muszą być takie same!";
    }
    if ($_POST['password'] != $_POST['confirm_password']) {
        $errors[] = "Pola <b>hasło</b> i <b>potwierdź hasło</b> muszą być takie same!";
    }
    //czy haslo ma co najmniej 8 znakow
    if (strlen($_POST['password']) < 8) {
        $errors[] = "Pole <b>hasło</b> musi mieć co najmniej 8 znaków!";
    }
    //czy haslo ma co najmniej 1 cyfre
    if (!preg_match("#[0-9]+#", $_POST['password'])) {
        $errors[] = "Pole <b>hasło</b> musi zawierać co najmniej jedną cyfrę!";
    }
    //czy haslo ma co najmniej 1 duza litere
    if (!preg_match("#[A-Z]+#", $_POST['password'])) {
        $errors[] = "Pole <b>hasło</b> musi zawierać co najmniej jedną dużą literę!";
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

    require "./connect.php";
    $result = $conn->query("SELECT id FROM users WHERE email = '$_POST[email]'");

    $howManyEmails = $result->num_rows;
    if($howManyEmails > 0)
    {
        $errors[] = "Istnieje już konto przypisane do tego adresu email!";
    }

    $result = $conn->query("SELECT id FROM users WHERE LOWER(login) = '$_POST[login]'");
    $howManyLogins = $result->num_rows;
    if($howManyLogins > 0)
    {
        $errors[] = "Istnieje już konto przypisane do tego loginu!";
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
    //echo $firstName;

    //require "./connect.php";

    $stmt = $conn->prepare("INSERT INTO `users` (`firstName`, `lastName`, `birthday`, `email`, `password`, `login`,`class`,`role`) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param('ssssssii', $firstName, $lastName, $birthday, $email, password_hash($password,PASSWORD_DEFAULT), strtolower($login),$class, $role );

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
}
else 
{
    header("Location: ../pages/.");
}
?>

