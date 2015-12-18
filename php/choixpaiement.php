<?php

$choix = $_POST["choix"];
$idco = $_POST["idco"];
include "fonctions.php";

if ($choix == 2) {
    paiementCH($bdd, $idco);
}
if ($choix == 1) {
    $valid = TRUE;
    paiementCB($bdd, $valid, $idco);
}
?>