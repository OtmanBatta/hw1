<?php 
include_once "DBManager.php";
include_once "Session.php";

if(isset($_POST['Id'])){
    $Results=array();

    $elements=QueryDB("SELECT * FROM articoli LEFT JOIN vincitori ON articoli.ID=vincitori.IDArticolo WHERE ID LIKE '".$_POST['Id']."'");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstaX - Articolo: <?php if(isset($_POST['IdArticolo'])){ echo $_POST['IdArticolo'];}else{echo "-1";}?> </title>
    <script src="SingleItem.js" defer></script>
</head>
<body>
     <input type="hidden" id="ID" name="idArticolo" value=<?php if(isset($_POST['IdArticolo'])){ echo $_POST['IdArticolo'];}else{echo "-1";}?>>
     <div id="ItemInfo"></div>

     <div class="Offer">
        <form id="Offer">
            <input type="hidden" id="User" value=<?php echo GetUserSection(); ?>>
            <label>Inserisci Somma:<input type="text" name="" id="Amount"></label>
            <input type="submit" value="Fai Offerta">
        </form>
     </div>
</body>
</html>