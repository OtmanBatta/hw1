<?php
include_once "DBManager.php";


if(isset($_POST['IdArticolo'])&&isset($_POST['Username'])&&isset($_POST['Valore'])){
    $res=QueryDB("SELECT * FROM vincitori WHERE IDArticolo = '".ConvertString($_POST['IdArticolo'])."'");

    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        if($row['Offerta']<$_POST['Valore']){
            if(QueryDB("UPDATE vincitori SET Username ='".ConvertString($_POST['Username'])."', Offerta = '".ConvertString($_POST['Valore'])."' WHERE IDArticolo = '".ConvertString($_POST['IdArticolo'])."'")){
                echo "Offerta Aggiornata con successo";
                exit;
            }else{
                echo "C'e stato qualche problema con l'inserimento dei dati";
                exit;
            }
        }
        else{
           echo "Inserire una Offerta Maggiore";
           exit;
        }

    }else{
        if(QueryDB("INSERT INTO vincitori (IDArticolo,Username,Offerta) VALUES ('".ConvertString($_POST['IdArticolo'])."','".ConvertString($_POST['Username'])."','".ConvertString($_POST['Valore'])."')")){
            echo "Offerta inserita con successo";
            exit;
        }else{
            echo "C'e stato qualche problema con l'inserimento dei dati";
            exit;
        }
    }

}
?>