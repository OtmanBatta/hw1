<?php
include_once "Session.php";
include_once "DBManager.php";

if(!CheckSession()){
    header("Location: login.php");
    exit;
 }

 if(isset($_POST["User"])){
    if($_POST["User"]!=""){

        $Results = array();
        $res=QueryDB("SELECT * FROM user WHERE Username LIKE '".ConvertString($_POST["User"])."'");
        while($row=mysqli_fetch_assoc($res)){
        $Results[]=$row;
        }
        echo json_encode($Results);
    }
}
?>