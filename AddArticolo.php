<?php 
include_once "Session.php";
include_once "DBManager.php";

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
        if(QueryDB("INSERT INTO articoli(ID,Titolo,Descrizione,Data,Utente,UrlImmagine) VALUES (NULL,'".$_POST['Titolo']."','".$_POST['Descrizione']."','".$_POST['Data']."','".$_POST['Utente']."','".$result['data']['thumb']."')")){
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="AddArticolo.js" defer></script>
    <link rel="stylesheet" href="AddArticolo.css">
    <title>AstaX - Aggiungi Articolo</title>
</head>
<body>
    <div id="Risultato"></div>
    <form method="POST" enctype="multipart/form-data">
        <label><h2>Titolo</h2><input type="text" name="Titolo" id="Titolo"></label>
        <label><h2>Descrizione</h2><input type="text" name="Descrizione" id="Descrizione"></label>
        <label><h2>Immagine</h2><input type="file" name="Media" id="Media"></label> 
        <input type="hidden" name="Utente" value=<?php echo GetUserSection(); ?>>
        <input type="hidden" name="Data" value=<?php echo date("Y-m-d")?>>
        <label><input type="submit" value="Aggiungi"></label>
    </form>
</body>
</html>