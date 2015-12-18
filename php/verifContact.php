<?php

function verifContact() {
    $mail = $_POST['contactEmail'];
    $nom = $_POST['contactName'];
    $sujet = $_POST['contactSubject'];
    $message = $_POST['contactMessage'];

    if (empty($nom) or empty($message) or ! preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $mail)) {
        include("contact.php");
    } else {
// Message envoyé
    }
}

verifContact();
?>

