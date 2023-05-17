<?php
    function downloadData($id) //pobieranie danych o użytkowniku do zmiennych sesyjych
    {
        require_once "./connect.php";
        $sql = "SELECT users.id, users.firstName, users.lastName, users.birthday, users.email, users.login, classes.class, roles.role FROM `users` JOIN `classes` ON `users`.`class` = `classes`.`class_id` JOIN `roles` ON `users`.`role` = `roles`.`role_id` WHERE users.id = 3;";

        $result = $conn->query($sql);
        
        foreach ($_SESSION as $key => $value) 
        {
            ${$key} = $value; //tworzenie zmiennych np.firstName
        }
    }

if ($_SERVER["REQUEST_METHOD"] != "POST") { //ochrona przed wejsciem na strone przez url

    header('location: ../pages/adding_user.php');
} 
else 
{
    session_start();
    $errors= [];

    if (!isset($_POST['username'])) 
    {
        $errors[] = "Pole <b>login</b> nie może być puste!";
    }
    if (!isset($_POST['password'])) 
    {
        $errors[] = "Pole <b>hasło</b> nie może być puste!";
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = implode("<br>", $errors);
        echo "<script>history.back();</script>"; //wraca do poprzedniej strony i pokazuje błędy
        exit();
    }

    $login = htmlentities($login, ENT_QUOTES, 'UTF-8');
    $haslo = htmlentities($haslo, ENT_QUOTES, 'UTF-8');

    require_once "./connect.php";

    if($rezultat = $conn->query(
        sprintf("SELECT * FROM users WHERE (login = '%s' OR email = '%s') AND password = '%s'", //sprawdzenie czy istnieje taki uzytkownik
        mysqli_real_escape_string($conn,$login),
        mysqli_real_escape_string($conn,$login),
        mysqli_real_escape_string($conn,$haslo)))) //true
    {
        $ilu_userow = $rezultat->num_rows; //liczba znalezionych kont

            if($ilu_userow == 1) //powinniśmy dać równe 1
            {
                $_SESSION['isLogged'] = true; //zmienna do sprawdzania czy jestesmy zalogowani
                $_SESSION['id'] = $rezultat->fetch_assoc()['id']; //pobieramy id uzytkownika
                
                downloadData($_SESSION['id']); //pobieramy dane uzytkownika
                $rezultat->close(); //lub free() albo free_result()
                header('location: ../pages/adding_user.php'); // przechodzimy do strony głównej po zalogowaniu
            }
            else
            {
                $errors[] = "Nieprawidłowy login lub hasło!";
                $_SESSION['errors'] = implode("<br>", $errors);
                echo "<script>history.back();</script>"; //wraca do poprzedniej strony i pokazuje błędy
                exit();
                }
            }
        
    }

?>