<?php

$idco = $_POST["idco"];
$idco = $_POST['idco'];
include "fonctions.php";
bonDeCommande($bdd, $idco);
majConnexion($bdd, $idco);
?>
