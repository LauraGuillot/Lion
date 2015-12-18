<?php

include "fonctions.php";

if (isset($_POST['bouton'])) {

    $idco = $_POST['idco'];
deconnexion ($idco, $bdd);
}
?>