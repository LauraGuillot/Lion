<?php

$email = $_POST['email'];
$mdp = $_POST['mdp'];
$mdp2 = $_POST['cmdp'];


/* Définition de la connexion à la base de données*/
$bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', '');

/* Préparation de la requête */
$stmt = $bdd->prepare("SELECT Count(Member_ID) FROM Member WHERE (Member_EMail='$email');", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));

/* Exécution de la requête */
$stmt->execute(array());

/* Exploitation des résultats */
$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$cpt = $row["Count(Member_ID)"];


if (empty($mdp) or $mdp != $mdp2 or ! preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {
    $erreur = "ERREUR DE SAISIE ! SAISIR A NOUVEAU LES INFORMATIONS";
    include ("inscription.php");
}

if ($cpt != 0) {
    $erreur = "ADRESSE MAIL DEJA UTILISEE";
    include ("inscription.php");
} else {
    include("inscription2.php");
}
?>