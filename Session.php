<?php

function CreateSession($User){
    session_start();
    $_SESSION["User"]=$User;
}

function CheckSession(){
    CheckSessionActive();
    return isset($_SESSION['User']);
}

function DestroySession(){
    CheckSessionActive();
    session_destroy();
}

function CheckSessionActive(){
    if(!isset($_SESSION)){
        session_start();
    }
}

function GetUserSection(){
    CheckSessionActive();
    if(CheckSession()){
        return $_SESSION['User'];
    }else{
        return "Nessun Utente in sessione";
    }
}
?>