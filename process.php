<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "Kayliw";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pobierz dane z formularza
$name = $_POST['name'];
$subject = $_POST['subject'];
$email = $_POST['email'];
$message = $_POST['message'];

// Wstaw dane do bazy danych
$sql = "INSERT INTO wiadomosci (imie, temat, email, wiadomosc) VALUES ('$name', '$subject', '$email', '$message')";



$conn->close();
?>
