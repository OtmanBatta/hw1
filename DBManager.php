<?php
 
static $Hostname="localhost";
static $username="root";
static $password="";
static $database="astax";

function QueryDB($Query){
    global $Hostname;
    global $username;
    global $password;
    global $database;

    $connection = mysqli_connect($Hostname,$username,$password,$database) or die ("Errore: ".mysqli_error($connection));

    $res=mysqli_query($connection,$Query);
    mysqli_close($connection);
    return $res;
}

function SetDB($host,$user,$pass,$dbname){
    global $Hostname;
    global $username;
    global $password;
    global $database;

    $Hostname=$host;
    $username=$user;
    $password=$pass;
    $database=$dbname;
}

function ConvertString($String){
    global $Hostname;
    global $username;
    global $password;
    global $database;

    $connection = mysqli_connect($Hostname,$username,$password,$database) or die ("Errore: ".mysqli_error($connection));
    $ConvertedString = mysqli_real_escape_string($connection,$String);
    mysqli_close($connection);

    return $ConvertedString;
}

?>