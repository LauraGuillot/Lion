<?php


$civilite = $_POST['civilite'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$titre = $_POST['titre'];
$district = $_POST['district'];

if (empty($civilite) or empty($nom) or empty($prenom)) {
    include ("inscriptionnew2.php");
} else {

    include ("inscription2bis.php");
}

?>