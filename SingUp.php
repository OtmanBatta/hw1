<?php
  include_once "DBManager.php";
  include_once "Session.php";

  if(isset($_POST["User"]) && isset($_POST["Pass"])&& isset($_POST["Nome"])&& isset($_POST["Cognome"])&& isset($_POST["ConfPass"])&& isset($_POST["Email"])){
    
    $user = ConvertString($_POST["User"]);
    $res=QueryDB("SELECT * FROM user WHERE Username LIKE '".$user."'");
    if(mysqli_num_rows($res)>0){
      echo "Utente già registrato con questo username";
      exit;
    };
   

    $pass = ConvertString($_POST["Pass"]);
    $name = ConvertString($_POST["Nome"]);
    $surname = ConvertString($_POST["Cognome"]);
    $email = ConvertString($_POST["Email"]);
    $res=QueryDB("INSERT INTO user(Username,Nome,Cognome,Email,Password) VALUES ('".$user."','".$name."','".$surname."','".$email."','".$pass."')");
    echo "Successo";
    exit;

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstaX - Sing Up</title>
    <script src="SingUp.js" defer></script>
    <link rel="stylesheet" href="SingUp.css"/>
</head>
<body>
    <h1>Modulo per la registrazione</h1>

    <form method="POST">
        <label><h2>Username</h2><input type="text" name="User"></label>
        <label><h2>Nome</h2><input type="text" name="Nome"></label>
        <label><h2>Cognome</h2><input type="text" name="Cognome"></label>
        <label><h2>Email</h2><input type="text" name="Email"></label>
        <label><h2>Password</h2><input type="password" name="Pass"></label>
        <label><h2>Conferma Password</h2><input type="password" name="ConfPass"></label>
        <label><input type="submit" value="Registrati"></label>
    </form>
</body>
</html>