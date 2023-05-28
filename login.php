<?php
  include_once "DBManager.php";
  include_once "Session.php";

  $wrongCrede=False;

  if(CheckSession()){
    header("Location: home.php");
    exit;
  }

  if(isset($_POST["User"]) && isset($_POST["Password"])){
        if($_POST["User"]!="" && $_POST["Password"]!=""){
                $user = ConvertString($_POST["User"]);
                $pass = ConvertString($_POST["Password"]);

                SetDB("localhost","root","","astax");
                $res=QueryDB("SELECT * FROM user WHERE Username LIKE '".$user."' AND Password LIKE '".$pass."'");
                if(mysqli_num_rows($res)>0){
                    CreateSession($user);
                    header("Location: home.php");
                    exit;
                }else{
                    $wrongCrede=true;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstaX - Login</title>
    <script src="login.js" defer></script>
    <link rel="stylesheet" href="login.css"/>
</head>
<body>
    <div id="OverlayBackground">
        <div class="Header">
            <img src="Icons/Logo.png">
        </div>
        <div class="FormDiv">
            <form method="POST">
                <div id="FormBorder">
                <span id="TitleForm"><?php echo date("d-M-Y ")?></span>
                <label for="User"><span>Username: </span><input id="UserField" type="text" name="User" placeholder="Inserire Username"></label>
                <label for="Password"><span>Password: </span><input id="PassField" type="password" name="Password" placeholder="Inserire Password"></label>
                <input type="submit" value="Log In" class="LoginBTN">
                <?php if($wrongCrede){echo "<h1>Credenziali Errate</h1>";} ?>
                </div>
                <h4>Non hai ancora un Account?  <a href="SingUp.php">Registrati Ora.</a></h4>
            </form>
        </div>
        </div>
</body>
</html>