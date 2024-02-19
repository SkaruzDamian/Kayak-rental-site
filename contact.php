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


    <title>Kajaki u Daniela</title>
    <style>
    
.contact {
    display: flex;
    justify-content: space-between;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); 
 
}


.contact-form {
    flex: 1; 
    padding: 20px;
    border-left: 1px solid #ddd; 
}

.contact h2 {
    font-size: 24px;
    margin-bottom: 20px;
}


.contact label {
    display: block;
    font-size: 16px;
    margin-bottom: 5px;
}

.contact input[type="text"],
.contact input[type="email"],
.contact textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

.contact textarea {
    height: 150px;
}


.contact button[type="submit"] {
    background-color: #007BFF;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
}

.contact button[type="submit"]:hover {
    background-color: #0056b3; 
}

        </style>
</head>
<body>
    
<?php
    require("menu.php")
    ?>
     <div class="contact">
        <div class="contact-info">
            <h3>Numer kontaktowy:</h3>
            +48 123 456 789
            <br>
            <br>
            <a style="color:blue;" href="https://www.facebook.com/KajakiLiw/"><i class="fa fa-facebook"></i> Facebook Page</a>
           <br>
           <br>
            <a style="color:green;" href="https://www.google.pl/maps/place/KAYLIW+Kajaki+i+Pychówki+Liwiec+Patrycja+Majewska/@52.37397,21.9710136,18.46z/data=!4m6!3m5!1s0x471f159faf990023:0x426264dc76a99b01!8m2!3d52.3741807!4d21.9696988!16s%2Fg%2F11q1m97pdc?entry=ttu"><i class="fa fa-map-marker"></i> Nasza lokalizacja</a>
        </div>
        <div class="contact-form">
            <h2>Skontaktuj się z nami</h2>
            <form action="process.php" method="POST">
                <label for="name">Imię:</label>
                <input type="text" id="name" name="name" required>
                <label for="subject">Temat:</label>
                <input type="text" id="subject" name="subject" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Wiadomość:</label>
                <textarea id="message" name="message" required></textarea>
                <button type="submit">Wyślij</button>
            </form>
        </div>
    </div>


</body>
<?php
    require("footer.php")
    ?>