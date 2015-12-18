<?php

$mail = $_POST['mail'];
$mdp = $_POST['mdp'];

include "fonctions.php";
testConnexion($bdd, $mail, $mdp);
?>