<?php
$idco = $_POST['idco'];
include "fonctions.php";
pdfAchats($bdd, $idco);
majConnexion($bdd, $idco);
?>