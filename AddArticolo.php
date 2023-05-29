<?php 
include_once "Session.php";
include_once "DBManager.php";

if(!CheckSession()){
    header("Location: login.php");
    exit;
}

$token="000439f371f21ba7e041e6dcb8e57212";

if(isset($_POST['Titolo'])  && isset($_POST['Descrizione'])&& isset($_POST['Utente'])&& isset($_POST['Data'])&& isset($_FILES['Media'])){
    $file = new CURLFile($_FILES['Media']['tmp_name'],$_FILES['Media']['type']);
    $dati = array("key" => $token, "media" => $file);
        
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://thumbsnap.com/api/upload");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $dati);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = json_decode(curl_exec($curl),true);
    curl_close($curl);

    if(isset($result['data']['thumb'])){

        if(QueryDB("INSERT INTO articoli(ID,Titolo,Descrizione,Data,Utente,UrlImmagine) VALUES (NULL,'".ConvertString($_POST['Titolo'])."','".ConvertString($_POST['Descrizione'])."','".ConvertString($_POST['Data'])."','".ConvertString($_POST['Utente'])."','".$result['data']['thumb']."')")){
            echo "<h1>Articolo Aggiungo Con Successo</h1>";
            exit;
        }
        else{
            echo "<h1>Errore nel caricamento dei dati nel database</h1>";
            exit;
        }
    }else{
        echo "<h1>Errore nel caricamento dei dati</h1>";
        exit;
    }

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
    <script src="./js/AddArticolo.js" defer></script>
    <link rel="stylesheet" href="./css/AddArticolo.css">
    <title>AstaX - Aggiungi Articolo</title>
</head>
<body>
    <div id="Header">
    <a href="home.php"><-- Torna alla home</a><h1>VENDI ARTICOLO</h1> <h2></h2>
    </div>
    <div id="Risultato"></div>
    <div id="Form">
    <form method="POST" enctype="multipart/form-data">
        <label><h2>Titolo</h2><input type="text" name="Titolo" id="Titolo"></label>
        <label><h2>Descrizione</h2><textarea name="Descrizione" id="Descrizione" cols="30" rows="10"></textarea></label>
        <label><h2>Immagine</h2><input type="file" name="Media" id="Media"></label> 
        <input type="hidden" name="Utente" value=<?php echo GetUserSection(); ?>>
        <input type="hidden" name="Data" value=<?php echo date("Y-m-d")?>>
        <label><input type="submit" value="Aggiungi"></label>
    </form>
    </div>
</body>
</html>