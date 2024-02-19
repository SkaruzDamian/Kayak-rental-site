<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "Kayliw";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$subject = $_POST['subject'];
$email = $_POST['email'];
$message = $_POST['message'];

$sql = "INSERT INTO wiadomosci (imie, temat, email, wiadomosc) VALUES ('$name', '$subject', '$email', '$message')";



$conn->close();
?>
