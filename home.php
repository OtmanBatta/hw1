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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="home.js" defer></script>
    <link rel="stylesheet" href="home.css">
    <title>Astax - Home</title>
</head>
<body>
    <div id="SearchDiv">
        <div>
            <input type="text" name="SearchValue" id="SearchBar">
            <input type="button" id="SearchButton" value="Cerca">
        </div>
        <div id="SearchResults">

        </div>
    </div>
    <a href="AddArticolo.php">Vendi Articolo</a>
    <form><input type="submit" value="Log Out"></form>
</body>
</html>