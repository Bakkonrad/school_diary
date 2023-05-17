<?php
    session_start();
    echo $_SESSION['id'];

    foreach($_SESSION as $key => $value)
    {
        echo $key . " " . $value . "<br>";
    }
?>