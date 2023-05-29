<?php 
include_once "Session.php";

if(!CheckSession()){
   header("Location: login.php");
   exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./js/Profilo.js" defer></script>
    <link rel="stylesheet" href="./css/Profilo.css">
    <title>Astax - <?php echo GetUserSection()?></title>
</head>
<body>
    <div id="Return">
    <a href="home.php"><-- Torna Alla Home</a>
    </div>
    <input type="hidden" id="User" value=<?php echo GetUserSection()?>>
    <div id="InfoUser"></div>
    <div id="Content">
        <h1>I Tuoi Articoli</h1>
        <div id="UserArticles"></div>
        <h1>Le Tue Offerte</h1>
        <div id="UserOffers"></div>
    </div>
    <form action="LogOut.php"><input type="submit" id="LogOut" value="Log Out"></form>
</body>
</html>