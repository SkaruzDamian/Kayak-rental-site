<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mitr">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="fullcalendar/dist/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <title>Kajaki u Daniela</title>
    <style>
 
.fc-button-primary {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
}
#calendar-container {
    background-color: rgb(169,169,169);
    border: 2px solid #ccc; 
    border-radius: 10px; 
    padding: 20px; 
   margin: 20px auto;
    max-width: 1200px; 
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
}

.fc-button-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}


.swal2-modal {
    background-color: #f8f9fa;
    color: #495057;
}

.swal2-input {
    margin-bottom: 10px;
}

.swal2-popup {
    border-radius: 10px;
}

.swal2-icon {
    color: #dc3545;
}

.swal2-title {
    font-size: 20px;
}


          </style>
</head>
<body>

<?php
    require("menu.php")
    ?>
<?php 
$currentData = date('Y-m-d');
?>

<div id='calendar-container'>
    <div id='calendar'></div>
</div>


<?php
    require("footer.php")
    ?>
   
   <script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var addedEvents = []; 

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialDate: '<?= $currentData ?>',
        height: '600px',
        selectable: true,
        buttonText: {
            today: 'Dzisiejsza data'
        },
        editable: true,
        locale: 'pl',
        dayMaxEvents: true, 
        events: {
            url: 'fetchevents.php',
            method: 'POST',
            success: function(response) {
                var events = [];
                response.forEach(function(event) {
                    if (!addedEvents.includes(event.eventid)) {
                        events.push({
                            id: event.eventid,
                            title: event.description, 
                            start: event.start
                        });
                        addedEvents.push(event.eventid); 
                    }
                });
                calendar.addEventSource(events);
            },
            error: function() {
                alert('Błąd pobierania danych z bazy danych');
            }
        },
        select: function(arg) { // Create Event

            // Alert box to add event
            Swal.fire({
                title: 'Zarezerwuj kajaki',
                showCancelButton: true,
                cancelButtonText: 'Anuluj',
                confirmButtonText: 'Dodaj',
                html:
                    '<input id="fullname" class="swal2-input" placeholder="Imię i nazwisko" style="width: 84%;"  >' +
                    '<input id="phonenumber" class="swal2-input" placeholder="Numer telefonu" style="width: 84%;"  >' +
                    '<input id="singlekayaks" class="swal2-input" type="number" min="0" placeholder="Liczba kajaków jednoosobowych" style="width: 84%;"  >' +
                    '<input id="doublekayaks" class="swal2-input" type="number" min="0" placeholder="Liczba kajaków dwuosobowych" style="width: 84%;"  >' +
                    '<input id="time" class="swal2-input" type="time" placeholder="Godzina" style="width: 84%;"  >' +
                    '<textarea id="notes" class="swal2-input" placeholder="Uwagi" style="width: 84%; resize: vertical;"></textarea>',
                focusConfirm: false,
                preConfirm: () => {
                    return [
                        document.getElementById('fullname').value,
                        document.getElementById('phonenumber').value,
                        document.getElementById('singlekayaks').value,
                        document.getElementById('doublekayaks').value,
                        document.getElementById('time').value,
                        document.getElementById('notes').value
                    ]
                }
            }).then((result) => {

                if (result.isConfirmed) {

                    var fullname = result.value[0].trim();
                    var phonenumber = result.value[1].trim();
                    var singlekayaks = result.value[2].trim();
                    var doublekayaks = result.value[3].trim();
                    var time = result.value[4].trim();
                    var notes = result.value[5].trim();
                    var start_date = arg.startStr;
                    var end_date = arg.endStr;
				

                    if(fullname != '' && phonenumber != '' && time != ''){
                        if(singlekayaks==''){
                            singlekayaks=0;
                        }
                        if(doublekayaks==''){
                            doublekayaks=0;
                        }
						
                        // AJAX - Add event
                        $.ajax({
                            url: 'ajaxfile.php',
                            type: 'post',
                            data: {request: 'addEvent', fullname: fullname, phonenumber: phonenumber, singlekayaks: singlekayaks, doublekayaks: doublekayaks, time: time, start_date: start_date,end_date: end_date, notes: notes},
                            dataType: 'json',
                            success: function(response){
                                if(response.status == 1){
                                    // Add event
                                    calendar.addEvent({
                                        eventid: response.eventid,
                                        title: 'Rezerwacja udana',
                                        description: 'Imię i nazwisko: ' + fullname + '\nNumer telefonu: ' + phonenumber + '\nLiczba kajaków jednoosobowych: ' + singlekayaks + '\nLiczba kajaków dwuosobowych: ' + doublekayaks + '\nGodzina: ' + time + '\nUwagi: ' + notes,
                                        start: arg.start,
                                        end: arg.end,
                                        allDay: arg.allDay
                                    });
                                    // Alert message
                                    Swal.fire(response.message,'','success');
                                }else{
                                    // Alert message
                                    Swal.fire(response.message,'','error');
                                }
                            }
                        });
			
                    }

                }
            });

            calendar.unselect();
        },
        eventContent: function(arg) {
            if (arg.isPast) {
                return false; // if the event is in the past, do not display it
            } else {
                return {
                    html: '<div style="font-weight: bold">' + arg.event.title + '</div>'
                };
            }
        },
    });

    calendar.render();
});

</script>


</body>
        </html>