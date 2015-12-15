<?php
$email = $_POST['email'];
$mdp = $_POST['mdp'];
$mdp2 = $_POST['cmdp'];

echo "$email";
echo "$mdp";
echo "$mdp2";
if (empty($mdp) or $mdp != $mdp2 or ! preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {
    if (empty($mdp) or $mdp != $mdp2){
     include ("inscriptionnew.php");
    }
} else {
    include("inscription2.php");
    }

?>