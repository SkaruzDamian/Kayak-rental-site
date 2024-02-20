<?php 

include "config.php";
	
$request = "";


// Read the value of $_POST
if(isset($_POST['request'])){
	$request = $_POST['request'];
}

// Add a new booking
if($request == 'addEvent'){

	$fullname = ""; 
	$phonenumber = ""; 
	$singlekayaks = ""; 
	$doublekayaks = ""; 
	$time = ""; 
	$start_date = ""; 
	$end_date = "";
	$notes="";
	if(isset($_POST['fullname'])){
		$fullname = $_POST['fullname'];
	}
	if(isset($_POST['phonenumber'])){
		$phonenumber = $_POST['phonenumber'];
	}
	if(isset($_POST['singlekayaks'])){
		$singlekayaks = $_POST['singlekayaks'];
	}
	if(isset($_POST['doublekayaks'])){
		$doublekayaks = $_POST['doublekayaks'];
	}
	if(isset($_POST['time'])){
		$time = $_POST['time'];
	}
	if(isset($_POST['start_date'])){
		$start_date = $_POST['start_date'];
	}
	if(isset($_POST['end_date'])){
		$end_date = $_POST['end_date'];
	}
	if(isset($_POST['notes'])){
		$notes = $_POST['notes'];
	}
	$response = array();
	$status = 0;
// Check if the start date is later than today's date
	if(strtotime($start_date) < strtotime(date('Y-m-d'))) {
        $response['status'] = 0;
        $response['message'] = 'Data rozpoczęcia nie może być wcześniejsza niż dzisiejsza data';
        echo json_encode($response);
        exit;
    }
	// Check if the customer exists in the customer table
    $sql_check_client = "SELECT id FROM kli WHERE CONCAT(imie, ' ', nazwisko) = '$fullname' AND telefon = '$phonenumber'";
    $result_check_client = mysqli_query($con, $sql_check_client);
    $client_row = mysqli_fetch_assoc($result_check_client);

    // If the customer doesn't exist, add a new customer to the klajenci table
    if (!$client_row) {
		// Split the fullname field into first and last name
		$name_parts = explode(" ", $fullname);
		$firstname = $name_parts[0];
		$lastname = isset($name_parts[1]) ? $name_parts[1] : ''; 
	
		// Insert record to the customer table
		$sql_insert_client = "INSERT INTO kli (imie, nazwisko, telefon) VALUES ('$firstname', '$lastname', '$phonenumber')";
		mysqli_query($con, $sql_insert_client);
	}
	

   // Check if there are enough kayaks available
    $sql_check_availability = "SELECT SUM(ilosc_kajakow_dwuosobowych) as total_double, SUM(ilosc_kajakow_jednoosobowych) as total_single
                               FROM rez
                               WHERE data_wypozyczenia = '$start_date'";
    $result_check_availability = mysqli_query($con, $sql_check_availability);
    $row_check_availability = mysqli_fetch_assoc($result_check_availability);
    $total_double = $row_check_availability['total_double'];
    $total_single = $row_check_availability['total_single'];

    if(($total_double + $doublekayaks) > 20 || ($total_single + $singlekayaks) > 20) {
        $response['status'] = 0;
        $response['message'] = 'Nie ma wystarczającej liczby dostępnych kajaków na tę datę';
        echo json_encode($response);
        exit;
    }

	$sql_insert_reservation = "INSERT INTO rez (klient_id, data_wypozyczenia, godzina_rezerwacji, ilosc_kajakow_dwuosobowych, ilosc_kajakow_jednoosobowych, uwagi)
	VALUES ((SELECT id FROM kli WHERE CONCAT(imie, ' ', nazwisko) = '$fullname'), '$start_date', '$time', $doublekayaks, $singlekayaks, '$notes')";

    if(mysqli_query($con, $sql_insert_reservation)){
        $status = 1;

        $total_price = ($doublekayaks * 110) + ($singlekayaks * 70);
        $response['status'] = 1;
        $response['message'] = 'Udana rezerwacja, cena całkowita: ' . $total_price;

    } else {
        $response['status'] = 0;
        $response['message'] = 'Nieudana rezerwacja';
    }
    echo json_encode($response);
    exit;
}

?>