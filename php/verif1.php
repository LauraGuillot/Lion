<?php

$email = $_POST['email'];
$mdp = $_POST['mdp'];
$mdp2 = $_POST['cmdp'];

echo "$email";
print("<meta charset=\"utf-8\">");
print("<head>");
print("<body>");
print("<form name=\"contactForm2\" id=\"contactForm2\" method=\"post\" action=\"verif2.php\">");

print("<input type=\"hidden\" name=\"email\" value=\"$email\"/>");
print("<input type=\"hidden\" name=\"mdp\" value=\"$mdp\"/>");
print("<input type=\"hidden\" name=\"mdp2\" value=\"$mdp2\"/>");print("</form>");

print("</body>");
print("</html>"); 


if (empty($mdp) or $mdp != $mdp2 or ! preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {
       
    include ("inscriptionnew.php");
 
} else {

include("inscription2.php");

   
}



?>