<?php

if (empty($mdp) or $mdp != $mdp2 or ! preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {

    include ("inscriptionnew.php");
} else {

    include("inscription2.php");
}
?>