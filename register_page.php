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
    <script src="script/autocomplete.js" defer></script>
</head>

<body style="background-color: #A8DADC;">
    <div class="login-container">
        <a href="index.php" class="home-logo">
            <img class="logo" src="images/logo.png">

        </a>
        <form class="form">
            <p class="form-title">Registrati</p>

            <div class="input-container">
                <label>
                    <span>
                        Inserisci Nome
                    </span>
                    <input class="input-field" type="Nome" placeholder="Enter Name" required="">
                </label>
            </div>
            <div class="input-container">
                <span>
                    Inserisci Cognome
                </span>
                <input class="input-field" type="Cognome" placeholder="Enter Surname" required="">

            </div>
            <div class="input-container">
                <label>
                    <span>
                        Inserisci email
                    </span>
                    <input class="input-field" type="email" placeholder="Enter email" required="">
                </label>

            </div>
            <div class="input-container">
                <span>
                    Inserisci indirizzo
                </span>
                <input class="input-field" type="indirizzo" placeholder="Enter Address" required="">
            <div class="input-container">
                <span>
                    Inserisci password
                </span>
                <input class="input-field" type="password" placeholder="Enter password" required="">

            </div>
            <div class="input-container">
                <span>
                    Conferma password
                </span>
                <input class="input-field" type="password" placeholder="Confirm password" required="">

            </div>
            
            <div class="imput-container" style="margin-top: 10%;">    
            <button type="submit" class="login-button">
                Registrati
            </button>
            </div>
            <p class="signup-link">
                Già registrato?
                <a href="login_page.php">Accedi</a>
            </p>
        </form>
    </div>
</body>