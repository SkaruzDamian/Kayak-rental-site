<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="panelStyles.css">
    <title>Panel</title>
    <style>
     
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
    <form method="post">
        <label for="phone">Wyszukaj po numerze telefonu:</label>
        <input type="text" id="phone" name="phone" placeholder="Wpisz numer telefonu...">
        <input type="submit" value="Szukaj">
        <a href="indexPanel.php?all=true" class="button">Wszystkie rezerwacje</a>
    </form>
    <?php
        require('config.php');
        require('session.php');
        $results_per_page = 20;

        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

        $offset = ($current_page - 1) * $results_per_page;

        if(isset($_GET['all']) && $_GET['all'] == 'true'){
            $sql = "SELECT kli.imie, kli.nazwisko, kli.telefon, rez.data_wypozyczenia, rez.godzina_rezerwacji
                    FROM rez
                    INNER JOIN kli ON rez.klient_id = kli.id
                    LIMIT $offset, $results_per_page";
        } elseif(isset($_POST['phone'])){
            $phonenumber = mysqli_real_escape_string($con, $_POST['phone']);
            $sql = "SELECT kli.imie, kli.nazwisko, kli.telefon, rez.data_wypozyczenia, rez.godzina_rezerwacji
                    FROM rez
                    INNER JOIN kli ON rez.klient_id = kli.id
                    WHERE kli.telefon = '$phonenumber'
                    LIMIT $offset, $results_per_page";
        } else {
            $sql = "SELECT kli.imie, kli.nazwisko, kli.telefon, rez.data_wypozyczenia, rez.godzina_rezerwacji
                    FROM rez
                    INNER JOIN kli ON rez.klient_id = kli.id
                    LIMIT $offset, $results_per_page";
        }
        
        $result = $con->query($sql);
        
        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Numer telefonu</th>
                        <th>Data</th>
                        <th>Godzina</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["imie"]."</td>
                        <td>".$row["nazwisko"]."</td>
                        <td>".$row["telefon"]."</td>
                        <td>".$row["data_wypozyczenia"]."</td>
                        <td>".$row["godzina_rezerwacji"]."</td>
                    </tr>";
            }
            echo "</table>";

            $sql = "SELECT COUNT(*) AS total FROM rez";
            $result_count = $con->query($sql);
            $row_count = $result_count->fetch_assoc();
            $total_pages = ceil($row_count["total"] / $results_per_page);

            echo "<div class='pagination'>";
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='indexPanel.php?page=".$i."'";
                if ($i == $current_page) echo " class='active'";
                echo ">".$i."</a>";
            }
            echo "</div>";
        } else {
            echo "<p>Brak wyników</p>";
        }
    ?>
</div>
</body>
</html>
