<!DOCTYPE html>

<head>
    <title>Profilo Utente</title>
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
    <script src="script/map.js" defer></script>
    <script src="script/filters.js" defer></script>
    <script src="script/profile-edit.js" defer></script>
    <script src="script/check_password.js" defer></script>
    <script src="script/change_password.js" defer></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAV2pCTErRiX6IWUu6Ol7gVE0U37rWWB_s&callback=initMap"></script>
    <script>
    function openPage(pageName) {
            var i, pages;
            pages = document.getElementsByClassName("page");
            for (i = 0; i < pages.length; i++) {
                pages[i].classList.remove("active");
            }
            document.getElementById(pageName).classList.add("active");
        }
    </script>
</head>

<html>

<body>

    <div class="background">
        <?php include 'logged_header.php'; ?>
    </div>
    <?php
    $nome = htmlspecialchars($_SESSION['name']);
    $email = htmlspecialchars($_SESSION['email']);
    $indirizzo = htmlspecialchars($_SESSION['indirizzo']);
    $cognome = htmlspecialchars($_SESSION['cognome']);
    $userId = htmlspecialchars($_SESSION['userid']);
    ?>
    <div class="home-body-wrapper">
        <div class="profile-name">
            <h1>Benvenuto <span style="color: #E63946"><?php echo $nome ?></span> !</h1>
        </div>
        <div class="profile-container fixed-width" style="border-right: 1px solid black;">

            <div class="navigation-bar">
                <a href="#" onclick="openPage('profile-info')">Informazioni Personali</a>
                <a href="#" onclick="openPage('ordini')">I Miei Ordini</a>
                <a href="#" onclick="openPage('contact')">Contact</a>
            </div>

            <div class="profile-content">
                <div id="profile-info" class="page active">

                    <form id="profileForm">
                        <h1>Informazioni Personali</h1>
                        <?php echo "<h1> $cognome </h1>" ?>
                        <div class="input-container">
                            <label for="nome">Nome: </label>
                            <input type="text" id="nome" name="nome" value="<?php echo $nome ?>" disabled>
                        </div>
                        <div class="input-container">
                            <label for="cognome">Cognome:</label>
                            <input type="text" id="cognome" name="cognome" value="<?php echo  $cognome  ?>" disabled>
                        </div>
                        <div class="input-container">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo $email ?>" disabled>
                        </div>
                        <div class="input-container">
                            <label for="indirizzo">Indirizzo:</label>
                            <input type="text" id="indirizzo" name="indirizzo" value="<?php echo $indirizzo ?>" disabled>
                        </div>
                        <div class="button-container">
                            <button type="button" id="editButton">Modifica</button>
                            <button type="submit" id="saveButton" style="display: none;">Salva</button>
                            <button type="button" id="cancelButton" style="display: none;">Annulla</button>
                        </div>
                    </form>
                    <p id="responseMessage"></p>
                    <a href="#" onclick="openPage('change_password')">Cambia Password</a>
                </div>
                <div id="ordini" class="page">
                    <h1>I Miei Ordini</h1>
                    <?php
                    // Fetch the orders from the database
                    $query = "SELECT * FROM homie.orders WHERE user_id = '$userId'";
                    $result = $conn->query($query);

                    // Check if there are any orders
                    if ($result->num_rows > 0) {
                        // Loop through the orders and create the HTML elements
                        while ($row = $result->fetch_assoc()) {
                            $pro_id = htmlspecialchars($row['pro_id']);
                            $orderDate = htmlspecialchars($row['date']);
                            $details = htmlspecialchars($row['details']);
                                if(htmlspecialchars(
                                    $row['accepted']) == 0){
                                        $completed = "Non accettato";
                                    } else if(htmlspecialchars(
                                        $row['completed']) == 0){
                                            $completed = "Accettato In attesa";
                                    } else {
                                            $completed = "Completato";
                                    }

                            // Create the HTML elements for each order
                            echo '<div class="order">';
                            echo '<h2>Order ID: ' . $pro_id . '</h2>';
                            echo '<p>Date: ' . $orderDate . '</p>';
                            echo '<p>Details: ' . $details . '</p>';
                            echo '<p>Status: ' . $completed . '</p>';
                            echo '</div>';
                        }
                    } else {
                        // Display a message if there are no orders
                        echo '<p>No orders found.</p>';
                    }
                    ?>
                </div>
                <div id="contact" class="page">
                    <h1>Contact</h1>
                    <p>Contact us </p>
                </div>
                <div id="change_password" class="page">
                    <h1>Change Password</h1>
                    <form id="changePasswordForm">
                        <div class="input-container">
                            <label for="old_password">Old Password:</label>
                            <input type="password" id="old_password" name="old_password" required>
                        </div>
                        <div class="input-container">
                            <label for="new_password">New Password:</label>
                            <input type="password" id="password" name="new_password" required>
                        </div>
                        <div class="input-container">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" id="confirm_password" name="confirm_password" required onkeyup="checkPassword()">
                        </div>
                        <p id="password_error" style="color: red;"></p>
                        <p id="passwordresponseMessage"></p>
                        <div class="button-container">
                            <button type="submit" class="login-button"disabled>Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<!--     <script>
        function openPage(pageName) {
            var i, pages;
            pages = document.getElementsByClassName("page");
            for (i = 0; i < pages.length; i++) {
                pages[i].classList.remove("active");
            }
            document.getElementById(pageName).classList.add("active");
        }
    </script> -->

</body>

</html>