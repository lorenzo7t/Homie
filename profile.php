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
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAV2pCTErRiX6IWUu6Ol7gVE0U37rWWB_s&callback=initMap"></script>
</head>

<html>

<body>
    
    <div class="background">
        <?php include 'logged_header.php'; ?>
    </div>
    <?php
    $nome = $_SESSION['name'];
    $email = $_SESSION['email'];
    $indirizzo = $_SESSION['indirizzo'];
    ?>
    <div class="home-body-wrapper">
        <div class="profile-name">
            <h1>Benvenuto <span style="color: #E63946"><?php echo $nome?></span> !</h1> 
        </div>
        <div class="profile-container fixed-width">

            <div class="navigation-bar">
                <a href="#" onclick="openPage('info')">Informazioni Personali</a>
                <a href="#" onclick="openPage('ordini')">I Miei Ordini</a>
                <a href="#" onclick="openPage('contact')">Contact</a>
            </div>

            <div class="profile-content">
                <div id="info" class="page active">
                    <div class="profile-info">
                        <div id=nome >Nome: <?php echo $nome?></div>
                        <div>Email: <?php echo $email?></div>
                        <div>Indirizzo: <?php echo $indirizzo?></div>
                    </div>
                </div>
                <div id="ordini" class="page">
                    <h1>I Miei Ordini</h1>
                    <p>Learn more about us.</p>
                </div>
                <div id="contact" class="page">
                    <h1>Contact</h1>
                    <p>Contact us </p>
                </div>
            </div>
        </div>
    </div>


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

</body>

</html>