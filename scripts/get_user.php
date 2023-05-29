<?php
// session_start();
//
//zabezpiecz jak nie ma metody post
if(!isset($_POST['class'])){
    echo "Nie ma klasy";
    exit();
}

?>