<?php 
include "config.php";

$sql = "SELECT * FROM rez";
$eventsList = mysqli_query($con, $sql);

$response = array();
$addedEvents = array(); 

while($row = mysqli_fetch_assoc($eventsList)){
    $eventId = $row['id'];
    if (!in_array($eventId, $addedEvents)) {
        $addedEvents[] = $eventId;
        $description = 'Jedynki: ' . (20 - $row['ilosc_kajakow_jednoosobowych']) . ', Dwójki: ' . (20 - $row['ilosc_kajakow_dwuosobowych']);
        $response[] = array(
            "eventid" => $eventId,
            "description" => $description,
            "start" => $row['data_wypozyczenia'],
        );
    }
}

echo json_encode($response);
exit;
?>
