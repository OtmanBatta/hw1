<?php 
include_once "DBManager.php";
include_once "Session.php";

if(!CheckSession()){
    header("Location: login.php");
    exit;
}

if(isset($_POST['Id'])){
    $Results=array();

    $elements=QueryDB("SELECT * FROM articoli LEFT JOIN vincitori ON articoli.ID=vincitori.IDArticolo WHERE ID LIKE '".ConvertString($_POST['Id'])."'");
    while($row=mysqli_fetch_assoc($elements)){
       $Results[]=$row;
    }

    echo json_encode($Results);
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
    <title>AstaX - Articolo: <?php if(isset($_POST['IdArticolo'])){ echo $_POST['IdArticolo'];}else{echo "-1";}?> </title>
    <script src="./js/SingleItem.js" defer></script>
    <link rel="stylesheet" href="./css/SingleItem.css">
</head>
<body>
     <a href="home.php"><--Torna Alla Home</a>
     <input type="hidden" id="ID" name="idArticolo" value=<?php if(isset($_POST['IdArticolo'])){ echo $_POST['IdArticolo'];}else{echo "-1";}?>>
     <div id="ItemInfo"></div>
     <div id="Offer">
        <form id="FOffer">
            <input type="hidden" id="User" value=<?php echo GetUserSection(); ?>>
            <label>Inserisci Somma:<input type="text" name="" id="Amount"></label>
            <input type="submit" id="OffertaBTN" value="Fai Offerta">
        </form>
     </div>
</body>
</html>