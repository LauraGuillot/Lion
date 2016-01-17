<?php


$civilite = $_POST['civilite'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$titre = $_POST['titre'];
$district = $_POST['district'];
echo "$district";
if (empty($civilite) or empty($nom) or empty($prenom) or empty($district)) {
   
    include ("inscription2.php");
} else {

    include ("inscription2bis.php");
}

?>