<?php

$email = $_POST['mail'];
$mdp = $_POST['mdp'];
$mdp2 = $_POST['cmdp'];

include "fonctions.php";
initMDP ($email, $mdp, $mdp2, $bdd);

?>