<?php
$idco = $_POST['idco'];
include "fonctions.php";
pdfCommandes($bdd, $idco);
majConnexion($bdd, $idco);
?>