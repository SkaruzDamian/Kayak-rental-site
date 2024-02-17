<?php
// Połączenie z bazą danych
$servername = "localhost";
$username = "username"; // Zmień na swoją nazwę użytkownika
$password = "password"; // Zmień na swoje hasło
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
$sql = "INSERT INTO Wiadomość (imie, temat, email, wiadomosc) VALUES ('$name', '$subject', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Wiadomość została wysłana poprawnie.";
} else {
    echo "Błąd podczas wysyłania wiadomości: " . $conn->error;
}

$conn->close();
?>
