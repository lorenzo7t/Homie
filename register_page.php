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

<body>
    <div class="register-container">
        <a href="index.php" class="home-logo">
            <img class="logo" src="images/logo.png">

        </a>
        <form class="register-form">
            <p class="register-form-title">Registrati</p>

            <div class="register-input-container">
                <label>
                    <span>
                        Inserisci Nome
                    </span>
                    <input type="Nome" placeholder="Enter Name" required="">
                </label>
            </div>
            <div class="register-input-container">
                <span>
                    Inserisci Cognome
                </span>
                <input type="Cognome" placeholder="Enter Surname" required="">

            </div>
            <div class="register-input-container">
                <label>
                    <span>
                        Inserisci email
                    </span>
                    <input type="email" placeholder="Enter email" required="">
                </label>

            </div>
            <div class="register-input-container">
                <span>
                    Inserisci indirizzo
                </span>
                <input type="indirizzo" placeholder="Enter Address" required="">
            <div class="register-input-container">
                <span>
                    Inserisci password
                </span>
                <input type="password" placeholder="Enter password" required="">

            </div>
            <div class="register-input-container">
                <span>
                    Conferma password
                </span>
                <input type="password" placeholder="Confirm password" required="">

            </div>
            
            <div class="register-imput-container">    
            <button type="submit" class="submit">
                Registrati
            </button>
            </div>
            <p class="register-signup-link">
                Già registrato?
                <a href="login_page.php">Accedi</a>
            </p>
        </form>
    </div>
</body>