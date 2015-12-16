<?php

$choix=$_POST["choix"];
$idco = $_POST["idco"];


if ($choix==2){
    include "CH.php";
}
if ($choix==1){
    include "CB.php";
}

?>