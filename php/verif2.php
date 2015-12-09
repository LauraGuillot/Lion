<?php

$email = $_POST['email'];
$mdp = $_POST['mdp'];
$mdp2 = $_POST['mdp2'];
$civilite = $_POST['civilite'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$titre = $_POST['titre'];
$district = $_POST['district'];
$club = $_POST['club'];
$rue = $_POST['rue'];
$num = $_POST['num'];
$cadr= $_POST['cadr'];
$cp = $_POST['cp'];
$ville = $_POST['ville'];
$pays = $_POST['pays'];
$tel = $_POST['tel'];
$portable = $_POST['portable'];

print("<meta charset=\"utf-8\">");
print("<head>");

print("<body>");


print("<form name=\"contactForm3\" id=\"contactForm3\" method=\"post\" action=\"verif3.php\">");

print("<input type=\"hidden\" name=\"email\" value=\"$email\"/>");
print("<input type=\"hidden\" name=\"mdp\" value=\"$mdp\"/>");
print("<input type=\"hidden\" name=\"mdp2\" value=\"$mdp2\"/>");
print("<input type=\"hidden\" name=\"civilite\" value=\"$civilite\"/>");
print("<input type=\"hidden\" name=\"nom\" value=\"$nom\"/>");
print("<input type=\"hidden\" name=\"prenom\" value=\"$prenom\"/>");
print("<input type=\"hidden\" name=\"titre\" value=\"$titre\"/>");
print("<input type=\"hidden\" name=\"district\" value=\"$district\"/>");
print("<input type=\"hidden\" name=\"club\" value=\"$club\"/>");
print("<input type=\"hidden\" name=\"rue\" value=\"$rue\"/>");
print("<input type=\"hidden\" name=\"num\" value=\"$num\"/>");
print("<input type=\"hidden\" name=\"cadr\" value=\"$cadr\"/>");
print("<input type=\"hidden\" name=\"cp\" value=\"$cp\"/>");
print("<input type=\"hidden\" name=\"ville\" value=\"$ville\"/>");
print("<input type=\"hidden\" name=\"pays\" value=\"$pays\"/>");
print("<input type=\"hidden\" name=\"tel\" value=\"$tel\"/>");
print("<input type=\"hidden\" name=\"portable\" value=\"$portable\"/>");

if (empty($civilite) or empty($nom) or empty($prenom) or empty($club) or empty($rue) or empty($num) or empty($cp) or empty($ville) or empty($pays) or empty($tel)) {
    include ("inscriptionnew2.php");
} else {

    include ("inscription3.php");
}

print("</form>");

print("</body>");

print("</html>");
?>