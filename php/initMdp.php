<?php

$email = $_POST['mail'];
$mdp = $_POST['mdp'];
$mdp2 = $_POST['cmdp'];

include "constantes.php";

/* On teste si l'email est dans la base */
$sql = 'SELECT Count(Member_ID) FROM Member WHERE (Member_EMail = :mail)';
$stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
$stmt->execute(array('mail' => "$email"));
$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$cpt = $row["Count(Member_ID)"];

if ($cpt = 0 or empty($mdp) or $mdp != $mdp2 or ! preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {

    include ("perteMdpNew.php");
} else {
    /* On récupère l'ID du membre pour mettre à jour en toute sécurité */
    $sql = 'SELECT Member_ID FROM Member WHERE (Member_EMail = :mail)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('mail' => "$email"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $id = $row["Member_ID"];

    /* Réinitialisation du mot de passe */
    $sql = 'UPDATE Member SET Member_Password = :mdp WHERE (Member_ID= ' . $id . ')';
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array('mdp' => "$mdp"));


    /* Redirection vers la page d'inscription */
    include ("inscription.php");
}