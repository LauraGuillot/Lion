<?php

$club = $_POST['club'];
$rue = $_POST['rue'];
$num = $_POST['num'];
$cadr= $_POST['cadr'];
$cp = $_POST['cp'];
$ville = $_POST['ville'];
$pays = $_POST['pays'];
$tel = $_POST['tel'];
$portable = $_POST['portable'];

 $civilite = $_POST['civilite'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$titre = $_POST['titre'];
$district = $_POST['district'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];
$mdp2 = $_POST['mdp2'];

if (empty($club) or empty($rue) or empty($num) or empty($cp) or empty($ville) or empty($pays) or empty($tel)) {
    include ("inscription2bis.php");
} else {

    include ("inscription3.php");
}


?>