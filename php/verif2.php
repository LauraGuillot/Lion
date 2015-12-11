<?php

$email = $_POST['email'];
$mdp = $_POST['mdp'];
$mdp2 = $_POST['mdp2'];
$civilite = $_POST['civilite'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$titre = $_POST['titre'];
$district = $_POST['district'];

echo "$email";

print("<meta charset=\"utf-8\">");
print("<head>");

print("<body>");


print("<form name=\"contactForm3\" id=\"contactForm3\" method=\"post\" action=\"verif2bis.php\">");

print("<input type=\"hidden\" name=\"email\" value=\"$email\"/>");
print("<input type=\"hidden\" name=\"mdp\" value=\"$mdp\"/>");
print("<input type=\"hidden\" name=\"mdp2\" value=\"$mdp2\"/>");
print("<input type=\"hidden\" name=\"civilite\" value=\"$civilite\"/>");
print("<input type=\"hidden\" name=\"nom\" value=\"$nom\"/>");
print("<input type=\"hidden\" name=\"prenom\" value=\"$prenom\"/>");
print("<input type=\"hidden\" name=\"titre\" value=\"$titre\"/>");
print("<input type=\"hidden\" name=\"district\" value=\"$district\"/>");
print("</form>");
print("</body>");
print("</html>");

if (empty($civilite) or empty($nom) or empty($prenom)) {
    include ("inscriptionnew2.php");
} else {

    include ("inscription2bis.php");
}

?>