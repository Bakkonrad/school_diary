<?php  
session_start();



    $selectedClass = $_GET['class'];
    require "./connect.php";
    $sql = "SELECT * FROM users WHERE class = '$_GET[class]' AND role = 3;";
    $result = $conn->query($sql);
    $students = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $students = array('id' => $row['id'], 'name' => $row['firstName'].' '.$row['lastName'] );
        }
    }
    echo json_encode($students);
    $conn->close();
    //exit();
    
    //print_r($students);

// Pobierz uczniów na podstawie przesłanej klasy


// Tutaj wykonaj odpowiednie zapytanie do bazy danych lub inne operacje, aby pobrać uczniów danej klasy

// Przykładowa lista uczniów
// $students = array(
//     array('id' => 1, 'name' => 'Jan Kowalski'),
//     array('id' => 2, 'name' => 'Anna Nowak'),
//    Dodaj więcej uczniów dla innych klas
// );

// Zwróć dane w formacie JSON
?>

