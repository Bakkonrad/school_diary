<?php
    function downloadData($id) //pobieranie danych o użytkowniku do zmiennych sesyjych
    {
        require "./connect.php";

        $sql = "SELECT users.id, users.firstName, users.lastName, users.birthday, users.email, users.login, classes.class, roles.role FROM `users` JOIN `classes` ON `users`.`class` = `classes`.`class_id` JOIN `roles` ON `users`.`role` = `roles`.`role_id` WHERE users.id = 3;";

        if($result = $conn->query($sql))
        {
            $row = $result->fetch_assoc();
            $_SESSION['firstName'] = $row['firstName'];
            $_SESSION['lastName'] = $row['lastName'];
            $_SESSION['birthday'] = $row['birthday'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['login'] = $row['login'];
            $_SESSION['class'] = $row['class'];
            $_SESSION['role'] = $row['role'];
        }
        else
        {
            echo "Błąd: " . $conn->error;
        }
        
    }

if ($_SERVER["REQUEST_METHOD"] != "POST") { //ochrona przed wejsciem na strone przez url

    echo "<script>history.back();</script>";
}
else 
{
    session_start();
    $errors= [];

    if (empty($_POST['login'])) 
    {
        $errors[] = "Pole <b>login</b> nie może być puste!";
    }
    if (empty($_POST['password'])) 
    {
        $errors[] = "Pole <b>hasło</b> nie może być puste!";
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = implode("<br>", $errors);
        echo "<script>history.back();</script>"; //wraca do poprzedniej strony i pokazuje błędy
        exit();
    }

    $login = htmlentities($_POST['login'], ENT_QUOTES, 'UTF-8');
    $haslo = htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8');

    require_once "./connect.php";

    if($rezultat = $conn->query(
        sprintf("SELECT * FROM users WHERE login = '%s' AND password = '%s'", //sprawdzenie czy istnieje taki uzytkownik
        mysqli_real_escape_string($conn,$login),
        mysqli_real_escape_string($conn,$haslo)))) //true
    {
        $ilu_userow = $rezultat->num_rows; //liczba znalezionych kont

            if($ilu_userow == 1) //powinniśmy dać równe 1
            {
                $_SESSION['isLogged'] = true; //zmienna do sprawdzania czy jestesmy zalogowani
                $_SESSION['id'] = $rezultat->fetch_assoc()['id']; //pobieramy id uzytkownika
                downloadData($_SESSION['id']); //pobieramy dane uzytkownika
                $_SESSION['role'] = 3;
                $rezultat->close(); //lub free() albo free_result()
                
                if($_SESSION['role'] == 1)
                {
                    header('location: ../pages/admin/admin_account.php');
                }
                if($_SESSION['role'] == 2)
                {
                    header('location: ../pages/teacher/teacher_account.php');
                }
                if($_SESSION['role'] == 3)
                {
                    header('location: ../pages/student/student_account.php');
                }
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