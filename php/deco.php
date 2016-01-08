<?php


if (isset($_POST['bouton'])) {
include "fonctions.php";
$idco = $_POST['idco'];
deconnexion ($idco, $bdd);

}
?>