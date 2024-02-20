<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuń rezerwacje</title>
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
    </nav>
</header>
<div class="container">
    <form method="post">
        <label for="phone">Numer telefonu klienta:</label>
        <input type="text" id="phone" name="phone" placeholder="Wpisz numer telefonu...">
        <label for="date">Data rezerwacji:</label>
        <input type="date" id="date" name="date">
        <input type="submit" value="Usuń rezerwacje">
    </form>

    <?php
    if(isset($_POST['phone']) && isset($_POST['date'])){
        require('config.php');
        require('session.php');

        $phonenumber = mysqli_real_escape_string($con, $_POST['phone']);
        $date = mysqli_real_escape_string($con, $_POST['date']);

        $sql_check_client = "SELECT id FROM kli WHERE telefon = '$phonenumber'";
        $result_check_client = $con->query($sql_check_client);
        if ($result_check_client->num_rows > 0) {
            $row_check_client = $result_check_client->fetch_assoc();
            $client_id = $row_check_client['id'];

            $sql_delete_reservation = "DELETE FROM rez WHERE klient_id = '$client_id' AND data_wypozyczenia = '$date'";
            if ($con->query($sql_delete_reservation) === TRUE) {
                echo "<p>Rezerwacje dla numeru telefonu: $phonenumber i daty: $date zostały pomyślnie usunięte.</p>";
            } else {
                echo "<p>Błąd podczas usuwania rezerwacji: " . $con->error . "</p>";
            }
        } else {
            echo "<p>Nie ma klienta o podanym numerze telefonu.</p>";
        }
    }
    ?>
</div>
</body>
</html>
