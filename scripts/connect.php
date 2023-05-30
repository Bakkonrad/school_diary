<?php

$conn = new mysqli("localhost", "root", "", "school_diary");

if ($conn->connect_error) { // Check connection to database 
    die("Connection failed: " . $conn->connect_error);
}

?>