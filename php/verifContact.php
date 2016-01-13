<?php

function verifContact() {
    $mail = $_POST['contactEmail'];
    $nom = $_POST['contactName'];
    $sujet = $_POST['contactSubject'];
    $message = $_POST['contactMessage'];

    if (empty($nom) or empty($message) or ! preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $mail)) {
        include("contact.php");
    } else {

include 'Utl_Mail.php' ;
 include "fonctions.php";
 
$Message = $message;
$Subject = $sujet;

$Destinataire = $mailAdmin;
$Emetteur = $mail;

 sendMail($serveur, $port, $login, $password, $Emetteur, $Destinataire, $Subject , $Message);
 
 include "messageok.php";
    }
}

verifContact();
?>

