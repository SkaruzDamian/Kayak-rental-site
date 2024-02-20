<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj rezerwację</title>
    <link rel="stylesheet" href="panelStyles.css">
    <style>
        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="date"], input[type="time"], input[type="number"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<header>
    <h1>Panel</h1>
    <nav>
        <a href="indexPanel.php">Główna strona/klienci</a>
        <a href="delete.php">Usuń rezerwacje</a>
        <a href="edit.php">Edytuj rezerwacje</a>
        <a href="logout.php">Wyloguj</a>
        <a href="addReservation.php">Dodaj rezerwację</a>
    </nav>
</header>
<div class="container">
    <?php
    require('config.php');
    require('session.php');

    if(isset($_POST['phone']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['two_seater']) && isset($_POST['single_seater'])){
        $phonenumber = mysqli_real_escape_string($con, $_POST['phone']);
        $date = mysqli_real_escape_string($con, $_POST['date']);
        $time = mysqli_real_escape_string($con, $_POST['time']);
        $two_seater = mysqli_real_escape_string($con, $_POST['two_seater']);
        $single_seater = mysqli_real_escape_string($con, $_POST['single_seater']);

        $sql_check_client = "SELECT id FROM kli WHERE telefon = '$phonenumber'";
        $result_check_client = $con->query($sql_check_client);
        if ($result_check_client->num_rows > 0) {
            $row_check_client = $result_check_client->fetch_assoc();
            $client_id = $row_check_client['id'];
        } else {
            $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
            $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
            $sql_add_client = "INSERT INTO kli (imie, nazwisko, telefon) VALUES ('$firstname', '$lastname', '$phonenumber')";
            if ($con->query($sql_add_client) === TRUE) {
                $client_id = $con->insert_id;
            } else {
                echo "<p>Błąd podczas dodawania klienta: " . $con->error . "</p>";
            }
        }

        $sql_add_reservation = "INSERT INTO rez (klient_id, data_wypozyczenia, godzina_rezerwacji, ilosc_kajakow_dwuosobowych, ilosc_kajakow_jednoosobowych)
                                VALUES ('$client_id', '$date', '$time', '$two_seater', '$single_seater')";
        if ($con->query($sql_add_reservation) === TRUE) {
            echo "<p>Rezerwacja została pomyślnie dodana.</p>";
        } else {
            echo "<p>Błąd podczas dodawania rezerwacji: " . $con->error . "</p>";
        }
    }
    ?>

    <form method="post">
        <label for="phone">Numer telefonu klienta:</label>
        <input type="text" id="phone" name="phone" placeholder="Wpisz numer telefonu...">
        <label for="firstname">Imię klienta:</label>
        <input type="text" id="firstname" name="firstname" placeholder="Wpisz imię...">
        <label for="lastname">Nazwisko klienta:</label>
        <input type="text" id="lastname" name="lastname" placeholder="Wpisz nazwisko...">
        <label for="date">Data rezerwacji:</label>
        <input type="date" id="date" name="date">
        <label for="time">Godzina rezerwacji:</label>
        <input type="time" id="time" name="time">
        <label for="two_seater">Ilość kajaków dwuosobowych:</label>
        <input type="number" id="two_seater" name="two_seater" min="0">
        <label for="single_seater">Ilość kajaków jednoosobowych:</label>
        <input type="number" id="single_seater" name="single_seater" min="0">
        <input type="submit" value="Dodaj rezerwację">
    </form>
</div>
</body>
</html>
