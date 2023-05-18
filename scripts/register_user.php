<?php

function sanitizeInput($input)
{
    return (htmlentities(stripcslashes(trim($input))));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { //ochrona przed wejsciem na strone przez url
    session_start();

    // echo "<pre>";
    //     print_r($_POST);
    //     echo "</pre>";

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
    

    if (!empty($errors)) {
        $_SESSION['errors'] = implode("<br>", $errors);
        echo "<script>history.back();</script>"; //wraca do podstrony rejestracji i wyswietla bledy
        exit();
    }

    foreach ($_POST as $key => $value) { 
        ${$key} = sanitizeInput($value); //tworzenie zmiennych np.firstName
    }
    //echo $firstName;

    require_once "./connect.php";

    $stmt = $conn->prepare("INSERT INTO `users` (`firstName`, `lastName`, `birthday`, `email`, `password`, `login`,`class`,`role`) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param('sssssii', $firstName, $lastName, $birthday, $email, password_hash($password,PASSWORD_DEFAULT), $login,$class, $role );

    $stmt->execute();

    echo $stmt->affected_rows;
}
else 
{
    header("Location: ../pages/.");
}
?>

