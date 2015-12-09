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
$cadr = $_POST['cadr'];
$cp = $_POST['cp'];
$ville = $_POST['ville'];
$pays = $_POST['pays'];
$tel = $_POST['tel'];
$portable = $_POST['portable'];
$fClub = $_POST['fClub'];
$fDistrict = $_POST['fDistrict'];
$prenomAcc = $_POST['prenomAcc'];
$nomAcc = $_POST['nomAcc'];

if (isset($_POST['train'])){
$train = "true";
}else{
   $train ="false"; 
}
$traindate = $_POST['traindate'];
$trainheure = $_POST['trainheure'];


switch ($civilite) {
    case 1:$civilite = "Mlle";
        break;
    case 2:$civilite = "Mme";
        break;
    case 3:$civilite = "M";
        break;
}

if ($titre == 1) {
    $titre = "true";
} else {
    $titre = "false";
}

//Générer une chaine de caractère unique et aléatoire

function random($car) {
    $string = "";
    $chaine = "abcdefghijklmnpqrstuvwxy";
    srand((double) microtime() * 1000000);
    for ($i = 0; $i < $car; $i++) {
        $string .= $chaine[rand() % strlen($chaine)];
    }
    return $string;
}

// APPEL
// Génère une chaine de longueur 20
$chaine = random(70);



if (empty($fClub) or empty($fDistrict)) {
    include("inscriptionnew3.php");
} else {
    $bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', '');
    $req0 = $bdd->prepare('INSERT INTO Person (Person_Lastname, Person_Firstname) VALUES (:nom,:prenom)');
    $req0->execute(array(
        'nom' => "$nom",
        'prenom' => "$prenom"));

    $req1 = $bdd->prepare('INSERT INTO Person (Person_Lastname, Person_Firstname) VALUES (:nomAcc,:prenomAcc)');
    $req1->execute(array(
        'nomAcc' => "$nomAcc",
        'prenomAcc' => "$prenomAcc"));


    $req2 = $bdd->prepare("SELECT Person_ID FROM Person WHERE (Person_Lastname = '$nomAcc' AND Person_Firstname = '$prenomAcc')", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req2->execute(array());
    $row = $req2->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $personID = $row["Person_ID"];


    $req3 = $bdd->prepare('INSERT INTO Follower (Person_ID) VALUE (:id)');
    $req3->execute(array(
        'id' => "$personID",));


    $req4 = $bdd->prepare("SELECT Club_ID FROM Club WHERE (Club_Name = '$club')", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req4->execute(array());
    $row = $req4->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $clubID = $row["Club_ID"];

    $req5 = $bdd->prepare("SELECT District_ID FROM District WHERE (District_Name = '$district')", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req5->execute(array());
    $row = $req5->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $districtID = $row["District_ID"];



    $req6 = $bdd->prepare("SELECT Follower_ID FROM Follower WHERE (Person_ID = '$personID')", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req6->execute(array());
    $row = $req6->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $followerID = $row["Follower_ID"];


    $req7 = $bdd->prepare("SELECT Person_ID FROM Person WHERE (Person_Lastname = '$nom' AND Person_Firstname = '$prenom')", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req7->execute(array());
    $row = $req7->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $personID2 = $row["Person_ID"];



    $req8 = $bdd->prepare("SELECT DATE_FORMAT(NOW(),'%c-%d-%Y %h:%i %p')", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req8->execute(array());
    $row = $req8->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $date = $row["DATE_FORMAT(NOW(),'%c-%d-%Y %h:%i %p')"];


    $req9 = $bdd->prepare('INSERT INTO Connexion (Connexion_ID,Last_Connexion) VALUE (:chaine,:Last_Connexion)');
    $req9->execute(array(
        'chaine' => "$chaine$date",
        'Last_Connexion' => "$date",));

    $req10 = $bdd->prepare("SELECT Connexion_ID FROM Connexion WHERE (Last_Connexion = '$date')", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req10->execute(array());
    $row = $req10->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $connexion = $row["Connexion_ID"];


    $req11 = $bdd->prepare('INSERT INTO Member (Member_Title, Member_Satus, District_ID, Club_ID, Member_Num, Member_Additional_Adress, Member_Postal_Code, Member_Street, Member_City, Member_Phone, Member_Mobile, Member_Email, Member_Position_Club, Member_Position_District, Member_By_Train, Member_Date_Train, Connexion_ID,Person_ID, Follower_ID, Member_Password ) VALUES (:civilite,:status,:districtID,:clubID,:num,:supad,:cp,:rue,:ville,:phone,:mobile,:email,:pclub,:pdistrict,:btrain,:htrain,:connexion,:personID2,:personID,:mdp)');
    $req11->execute(array(
        'civilite' => "$civilite",
        'status' => "$titre",
        'districtID' => "$districtID",
        'clubID' => "$clubID",
        'num' => "$num",
        'supad' => "$cadr",
        'cp' => "$cp",
        'rue' => "$rue",
        'ville' => "$ville",
        'phone' => "$tel",
        'mobile' => "$portable",
        'email' => "$email",
        'pclub' => "$fClub",
        'pdistrict' => "$fDistrict",
        'btrain' => "$train",
        'htrain' => "$traindate",
        'connexion' => "$connexion",
        'personID2' => "$personID2",
        'personID' => "$personID",
        'mdp' => "$mdp",));


    /* echo "$civilite\n";
      echo "$status\n";
      echo "$districtID\n";
      echo "$clubID\n";
      echo "$num\n";
      echo "$supad\n";
      echo "$cp\n";
      echo "$rue\n";
      echo "$ville\n";
      echo "$tel\n";
      echo "$portable\n";
      echo "$email\n";
      echo "$fClub\n";
      echo "$fDistrict\n";
      echo "$train\n";
      echo "$traindate\n";
      echo "$connexion\n";

      echo "$personID2\n";
      echo "$personID\n";
      echo "$mdp\n";



     */


    $idco = $chaine.$date ;

    echo'<!DOCTYPE html>
<!--[if lt IE 8 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 8)|!(IE)]><!--><html lang="fr"> <!--<![endif]-->
    <head>


        <!--- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <title>Lions Club</title>
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Mobile Specific Metas
       ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- CSS
   ================================================== -->
        <link rel="stylesheet" href="css/base.css">
        <link rel="stylesheet" href="css/layout.css">

        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Favicons
             ================================================== -->
        <link rel="shortcut icon" href="logo.png" >


    </head>

    <body data-spy="scroll" data-target="#nav-wrap">


        <!-- Header
        ================================================== -->';

    echo' <header class="mobile">';

    echo'<div class="row"';

    echo' <div class="col full">

                    <div class="logo">';
    print(" <a href=\"http://localhost/lion/Lion/php/homeC.php?idco=$idco\" style=\"top : 4px\"><img alt=\"\" src=\"images/logo.png\" style=\"height:  50px; width: 55px; top: 4px\"></a>");
    echo'</div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">';
    print(" <li ><a href=\"http://localhost/lion/Lion/php/homeC.php?idco=$idco\">Home</a></li>");
    print(" <li ><a href=\"http://localhost/lion/Lion/php/agendaC.php?idco=$idco\">Agenda</a></li>");
    print(" <li ><a href=\"http://localhost/lion/Lion/php/infoC.php?idco=$idco\">Info</a></li>");
    print(" <li ><a href=\"http://localhost/lion/Lion/php/contactC.php?idco=$idco\">Contact</a></li>");

    print(" <li><a href=\"http://localhost/lion/Lion/php/panier.php?idco=$idco\" style=\"font-weight:bold; align :right\"><FONT size=\"4pt\"> Panier</FONT></a></li>");
    print(" <li><a href=\"http://localhost/lion/Lion/php/moncompte.php?idco=$idco\" style=\"font-weight:bold; align :right\"><FONT size=\"4pt\"> Mon compte</FONT></a></li>");
    print(" <li><a href=\"http://localhost/lion/Lion/php/deconnexion.php?idco=$idco\" style=\"font-weight:bold; align :right\"><FONT size=\"4pt\"> Se déconnecter</FONT></a></li>");
    echo'  </ul>
                    </nav>
                </div>
            </div>

        </header>';

    echo'<!-- Header End -->




        <!-- Message Section
          ================================================== -->

        <div class="row section-head">
        <div class="col full">
        <br></br>
        <br></br>
            <span><h2 style = "color :#70F861; margin : 65px; text-align : center"> Inscription réussie <br></br>
           <center><FONT size="3.5pt " style = "color :#F0FFFF ;font-weight:normal">Vous pouvez désormais vous inscrire à des activités dans l\'onglet "Agenda" et consulter vos informations personnelles sur votre compte. </center></FONT></h2><span>
        <br></br>
        <br></br>
        <br></br>
</div>

       
     <!-- Message Section End-->

    <!-- footer
    ================================================== -->
    ';
    include("footer.php");

    echo '
    <!-- Footer End-->

    <!-- Java Script
    ================================================== -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write(\'<script src="js/jquery-1.10.2.min.js"><\/script>\')</script>
    <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>

    <script src="js/scrollspy.js"></script>
    <script src="js/jquery.flexslider.js"></script>
    <script src="js/jquery.reveal.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
    <script src="js/gmaps.js"></script>
    <script src="js/init.js"></script>
    <script src="js/smoothscrolling.js"></script>

</body>

</html>';
}
?>