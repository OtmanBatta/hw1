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
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./js/home.js" defer></script>
    <link rel="stylesheet" href="./css/home.css">
    <title>Astax - Home</title>
</head>
<body>
    <div class="Header">
    <a href="AddArticolo.php">Vendi Articolo</a>
        <img src="Icons/Logo.png">
        <a href="Profilo.php">Profilo</a>
    </div>  
    <div id="SearchDiv">
        <div id="SearchInput">
            <h3> Dici cosa stai cercando: </h3><input type="text" name="SearchValue" id="SearchBar">
            <input type="button" id="SearchButton" value="Cerca">
        </div>
        <div id="SearchResults">
        </div>
    </div>
</body>
</html>