<?php

function verifContact() {
    $mail = $_POST['contactEMail'];
    $nom = $_POST['contactName'];
    $sujet = $_POST['contactSubject'];
    $message = $_POST['contactMessage'];

    if (empty($nom) or empty($message) or ! preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $mail)) {
        header('Location: contactnew.php');
    } else {
// Message envoyé
    }
}

verifContact();
?>

