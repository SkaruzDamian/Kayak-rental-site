<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja rezerwacji</title>
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
        <input type="submit" value="Pokaż formularze edycji">
    </form>

    <?php
    if(isset($_POST['phone'])){
        require('config.php');
        require('session.php');

        $phonenumber = mysqli_real_escape_string($con, $_POST['phone']);
        $sql = "SELECT kli.id, kli.imie, kli.nazwisko, rez.id AS rezerwacja_id, rez.data_wypozyczenia, rez.godzina_rezerwacji, rez.ilosc_kajakow_dwuosobowych, rez.ilosc_kajakow_jednoosobowych
                FROM kli
                INNER JOIN rez ON kli.id = rez.klient_id
                WHERE kli.telefon = '$phonenumber'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Formularze edycji rezerwacji dla klienta o numerze telefonu: $phonenumber</h2>";
            while ($row = $result->fetch_assoc()) {
                $available_kayaks = 20 - $row['ilosc_kajakow_dwuosobowych'] - $row['ilosc_kajakow_jednoosobowych'];
                $date = $row['data_wypozyczenia'];
                $sql_check_availability = "SELECT SUM(ilosc_kajakow_dwuosobowych) AS sum_two_seater, SUM(ilosc_kajakow_jednoosobowych) AS sum_single_seater
                                            FROM rez
                                            WHERE data_wypozyczenia = '$date'";
                $result_check_availability = $con->query($sql_check_availability);
                $row_check_availability = $result_check_availability->fetch_assoc();
                $total_two_seater = $row_check_availability['sum_two_seater'] + (isset($_POST['two_seater_'.$row['rezerwacja_id']]) ? $_POST['two_seater_'.$row['rezerwacja_id']] : 0);
                $total_single_seater = $row_check_availability['sum_single_seater'] + (isset($_POST['single_seater_'.$row['rezerwacja_id']]) ? $_POST['single_seater_'.$row['rezerwacja_id']] : 0);
                $available_kayaks -= ($total_two_seater + $total_single_seater);

                echo "<form method='post' action='updateReservation.php'>";
                echo "<input type='hidden' name='reservation_id' value='".$row['rezerwacja_id']."'>";
                echo "<label for='date_".$row['rezerwacja_id']."'>Data wypożyczenia:</label>";
                echo "<input type='date' id='date_".$row['rezerwacja_id']."' name='date_".$row['rezerwacja_id']."' value='".$row['data_wypozyczenia']."' disabled>";
                echo "<label for='time_".$row['rezerwacja_id']."'>Godzina rezerwacji:</label>";
                echo "<input type='time' id='time_".$row['rezerwacja_id']."' name='time_".$row['rezerwacja_id']."' value='".$row['godzina_rezerwacji']."'>";
                echo "<label for='two_seater_".$row['rezerwacja_id']."'>Ilość kajaków dwuosobowych:</label>";
                echo "<input type='number' id='two_seater_".$row['rezerwacja_id']."' name='two_seater_".$row['rezerwacja_id']."' value='".$row['ilosc_kajakow_dwuosobowych']."' min='0' max='$available_kayaks'>";
                echo "<label for='single_seater_".$row['rezerwacja_id']."'>Ilość kajaków jednoosobowych:</label>";
                echo "<input type='number' id='single_seater_".$row['rezerwacja_id']."' name='single_seater_".$row['rezerwacja_id']."' value='".$row['ilosc_kajakow_jednoosobowych']."' min='0' max='$available_kayaks'>";
                echo "<input type='submit' value='Zapisz zmiany'>";
                if($available_kayaks < 0) {
                    echo "<p class='error'>Brak wystarczającej liczby dostępnych kajaków na ten dzień.</p>";
                }
                echo "</form>";
            }
        } else {
            echo "<p>Brak rezerwacji dla podanego numeru telefonu.</p>";
        }
    }
    ?>
</div>
</body>
</html>