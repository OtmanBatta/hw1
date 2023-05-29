<?php 
include_once "DBManager.php";

if(isset($_POST['SearchValue'])){

    $Results=array();

    $elements=QueryDB("SELECT * FROM articoli WHERE Titolo LIKE '%".ConvertString($_POST['SearchValue'])."%'");
    while($row=mysqli_fetch_assoc($elements)){
       $Results[]=$row;
    }

    echo json_encode($Results);
}else{
    echo "no result";
}
?>