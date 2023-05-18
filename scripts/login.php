<?php
    function downloadUserData($id) //pobieranie danych o użytkowniku do zmiennych sesyjych
    {
        require "./connect.php";

        $sql = "SELECT users.id, users.firstName, users.lastName, users.birthday, users.email, users.login, classes.class, roles.role FROM `users` JOIN `classes` ON `users`.`class` = `classes`.`class_id` JOIN `roles` ON `users`.`role` = `roles`.`role_id` WHERE users.id = '$id';";

        if($result = $conn->query($sql)) //tworzenie zmiennych sesyjnych z danymi uzytkownika
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

    header("Location: ../index.php");
    exit();
}
else 
{
    //delete session variables 
    // foreach ($_SESSION as $key => $value) {
    //     unset($_SESSION[$key]);
    // }

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
        //zapisanie pierwszego błędu do zmiennej sesyjnej
        //$_SESSION['errors'] = $errors[0];
        $_SESSION['errors'] = implode("<br>", $errors);
        echo "<script>history.back();</script>"; //wraca do poprzedniej strony i pokazuje błędy
        exit();
    }

    $login = htmlentities($_POST['login'], ENT_QUOTES, 'UTF-8');
    $password = htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8');

    require_once "./connect.php";

    if($result = $conn->query(
        sprintf("SELECT * FROM users WHERE login = '%s' AND password = '%s'", //sprawdzenie czy istnieje taki uzytkownik
        mysqli_real_escape_string($conn,$login),
        mysqli_real_escape_string($conn,$password))))
        //mysqli_real_escape_string($conn,password_hash($password,PASSWORD_DEFAULT))))) //true
    {
        $how_many_users = $result->num_rows; //liczba znalezionych kont

            if($how_many_users == 1 ) //powinniśmy dać równe 1
            {
                $_SESSION['isLogged'] = true; //zmienna do sprawdzania czy jestesmy zalogowani
                $_SESSION['id'] = $result->fetch_assoc()['id']; //pobieramy id uzytkownika
                downloadUserData($_SESSION['id']); //pobieramy dane uzytkownika
                $result->close(); //lub free() albo free_result()
                
                if($_SESSION['role'] == "administrator")
                {
                    header('location: ../pages/admin/admin_main.php');
                    // exit();
                }
                if($_SESSION['role'] == "nauczyciel")
                {
                    header('location: ../pages/teacher/teacher_main.php');
                    // exit();
                }
                if($_SESSION['role'] == "uczeń")
                {
                    header('location: ../pages/student/student_main.php');
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