<?php  
    include 'db_connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Landing</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="icon" href="img/icons/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/icons/favicon.ico" type="image/x-icon">
    <script src="script/autocomplete.js" defer></script>
    <script src="script/maps.js" defer></script>
    <script src="script/animations.js" defer></script>
</head>

<body style="background-color: #A8DADC;">
    <div class="login-container">
    <a href="index.php" class="homie-logo">
            <img class="logo" src="img/logo_new.png">
    </a>
    <form class="form"  style="height: 15vw" action="send_reset_email.php" method="POST">
    <p class="form-title ">Inserisci la mail per reimpostare la password</p>
    <div class="input-container">
        <label>Email </label>
        <input id="abc" class="input-field" type="email" placeholder="Enter email" required="" name="email" id="email">
    </div>
    <button type="submit" class="login-button">
        Invia
    </button>
</body>
