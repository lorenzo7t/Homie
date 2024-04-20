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
    <script src="script/maps.js" defer></script>
    <script src="script/animations.js" defer></script>
</head>
<body>
    <div class="main-page-top">
        <?php include 'header.php'; ?>
        <?php include 'landing_search_box.php'; ?>
        <?php include 'footer.php'; ?>
    </div>
    <div class="main-page-bottom">
        <?php include 'landing_description.php'; ?>
    </div>
</body>
</html>