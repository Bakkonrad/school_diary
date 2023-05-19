<?php
    
    function downloadUserData($id) //pobieranie danych o użytkowniku do zmiennych sesyjych , na ten moment nie używane
    {
        require "./connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT); //raportowanie o błędach w wyjątkach

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
            throw new Exception(mysqli_connect_errno()); //rzuć nowym wyjątkiem z nr błędu
        }
        
    }

if ($_SERVER["REQUEST_METHOD"] != "POST") { //ochrona przed wejsciem na strone przez url

    header("Location: ../index.php");
    exit();
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
        //zapisanie pierwszego błędu do zmiennej sesyjnej
        //$_SESSION['errors'] = $errors[0];
        $_SESSION['errors'] = implode("<br>", $errors);
        echo "<script>history.back();</script>"; //wraca do poprzedniej strony i pokazuje błędy
        exit();
    }

    $login = htmlentities($_POST['login'], ENT_QUOTES, 'UTF-8'); //zabezpieczenie przed wstrzykiwaniem sql
    $passsword = $_POST['password']; 

    require "./connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT); //raportowanie o błędach w wyjątkach

    if($result = $conn->query(
        sprintf("SELECT * FROM users WHERE login = '%s' OR email = '%s'",
        mysqli_real_escape_string($conn,$login),
        mysqli_real_escape_string($conn,$login)))) //true
    {
        $how_many_users = $result->num_rows; //liczba znalezionych kont

            if($how_many_users == 1 ) //powinniśmy dać równe 1
            {
                $row = $result->fetch_assoc(); //pobieramy dane z bazy

                if(password_verify($passsword, $row['password'])) //sprawdzamy czy hasło jest prawidłowe
                {
                    //print_r($result->fetch_assoc());
                    $_SESSION['isLogged'] = true; //zmienna do sprawdzania czy jestesmy zalogowani
                    $_SESSION['id'] = $row['id']; //pobieramy id uzytkownika
                    $_SESSION['firstName'] = $row['firstName'];
                    $_SESSION['lastName'] = $row['lastName'];
                    $_SESSION['birthday'] = $row['birthday'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['login'] = $row['login'];
                    $_SESSION['class'] = $row['class'];
                    $_SESSION['role'] = $row['role'];
                    //downloadUserData($_SESSION['id']); //pobieramy dane uzytkownika
                    $result->close(); //lub free() albo free_result()
                    
                    if($row['role'] == "1")
                    {
                        header('location: ../pages/admin/admin_main.php');
                        // exit();
                    }
                    if($row['role'] == "2")
                    {
                        header('location: ../pages/teacher/teacher_main.php');
                        // exit();
                    }
                    if($row['role'] == "3")
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