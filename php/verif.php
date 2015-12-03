<?php

function verif() {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $mdp2 = $_POST['cmdp'];

    if (empty($mdp) or $mdp != $mdp2 or ! preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {
        header('Location: inscriptionnew.php');
    } else {
        header('Location: inscription2.php');
    }
}

verif();
?>





