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



if (isset($_POST['train'])) {
    $train = 1;
} else {
    $train = 0;
}

if (isset($_POST['train'])) {
    $traindate = $_POST['traindate'];
    $trainheure = $_POST['trainheure'];
    $traindate = $traindate . " à " . $trainheure;
} else {
    $traindate = '0000-00-00';
}


switch ($civilite) {
    case 1:$civilite = "Mlle";
        break;
    case 2:$civilite = "Mme";
        break;
    case 3:$civilite = "M";
        break;
}

if ($titre == 1) {
    $titre = 1;
} else {
    $titre = 0;
}


/* Définition de la connexion à la base de données*/
$bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', '');

/* Préparation de la requête */
$stmt = $bdd->prepare("SELECT Count(Member_ID) FROM Member WHERE (Member_EMail='$email');", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));

/* Exécution de la requête */
$stmt->execute(array());

/* Exploitation des résultats */
$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$cpt = $row["Count(Member_ID)"];
echo $cpt;

if ($cpt == 0) {

//Générer une chaine de caractère unique et aléatoire
function random($n) {
    $string = "";
    $chaine = "abcdefghijklmnpqrstuvwxy";
    srand((double) microtime() * 1000000);
    for ($i = 0; $i < $n; $i++) {
        $string .= $chaine[rand() % strlen($chaine)];
    }
    return $string;
}

// Génère une chaine de longueur 70
$chaine = random(70);



if (empty($fClub) or empty($fDistrict)) {
    include("inscription3.php");
} else {
    
include ("fonctions.php");
    /* Insertion du membre dans la table personne */
    $req0 = $bdd->prepare('INSERT INTO Person (Person_Lastname, Person_Firstname) VALUES (:nom,:prenom)');
    $req0->execute(array(
        'nom' => $nom,
        'prenom' => $prenom));
 /* Récupération du district */
    
    $req5 = $bdd->prepare("SELECT District_ID FROM District WHERE (District_Name = '$district')", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req5->execute(array());
    $row = $req5->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $districtID = $row["District_ID"];

    if (strcmp($district,'AUTRE')==0){
      
    $req51 = $bdd->prepare("SELECT Count(Club_ID) FROM Club WHERE ((Club_Name LIKE :club) AND (District_ID = :district))",array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req51->execute(array(
        'district'=>$districtID,
        'club' =>$club));  
    $row = $req51->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Club_ID)"];
        
    if ($cpt == 0){
        
    $req52 = $bdd->prepare("INSERT INTO Club (District_ID, Club_Name) VALUES (:district,:club)");
    $req52->execute(array(
        'district'=>$districtID,
        'club' =>$club 
    ));}
    
    
    }
    
    
    /* Récupération du club */
   
    $req4 = $bdd->prepare("SELECT Club_ID FROM Club WHERE (Club_Name = '$club')", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req4->execute(array());
    $row = $req4->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $clubID = $row["Club_ID"];


//Récupération du person_ID
    $req22 = $bdd->prepare("SELECT Person_ID FROM Person WHERE (Person_Lastname = '$nom' AND Person_Firstname = '$prenom')", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req22->execute(array());
    $row = $req22->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $personID = $row["Person_ID"];


//Préparation du connexionID

    $req8 = $bdd->prepare("SELECT YEAR(DATE(Now()))", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req8->execute(array());
    $row = $req8->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $annee = $row["YEAR(DATE(Now()))"];

    $req82 = $bdd->prepare("SELECT MONTH(DATE(Now()))", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req82->execute(array());
    $row = $req82->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $mois = $row["MONTH(DATE(Now()))"];

    $req83 = $bdd->prepare("SELECT DAY(DATE(Now()))", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req83->execute(array());
    $row = $req83->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $day = $row["DAY(DATE(Now()))"];

    $req81 = $bdd->prepare("SELECT HOUR(Now())", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req81->execute(array());
    $row = $req81->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $heure = $row["HOUR(Now())"];

    $req84 = $bdd->prepare("SELECT MINUTE(Now())", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req84->execute(array());
    $row = $req84->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $min = $row["MINUTE(Now())"];

    $req85 = $bdd->prepare("SELECT SECOND(Now())", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req85->execute(array());
    $row = $req85->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $sec = $row["SECOND(Now())"];

    $connexion = $chaine . $day . $mois . $annee . $heure . $min . $sec;

   

    /* On ajoute le membre */
    $req11 = $bdd->prepare('INSERT INTO Member (Member_Title, Member_Status, District_ID, Club_ID, Member_Num, Member_Additional_Adress, Member_Postal_Code, Member_Street, Member_City, Member_Phone, Member_Mobile, Member_Email, Member_Position_Club, Member_Position_District, Member_By_Train, Member_Date_Train, Person_ID, Member_Password, Member_Registration_Date ) VALUES (:civilite,:titre,:districtID,:clubID,:num,:supad,:cp,:rue,:ville,:phone,:mobile,:email,:pclub,:pdistrict,:btrain,:htrain,:personID,:mdp,NOW())');
    $req11->execute(array(
        'civilite' => $civilite,
        'titre' => $titre,
        'districtID' => $districtID,
        'clubID' => $clubID,
        'num' => "$num",
        'supad' => $cadr,
        'cp' => "$cp",
        'rue' => $rue,
        'ville' => $ville,
        'phone' => "$tel",
        'mobile' => "$portable",
        'email' => $email,
        'pclub' => $fClub,
        'pdistrict' => $fDistrict,
        'btrain' => $train,
        'htrain' => $traindate,
        'personID' => $personID,
        'mdp' => $mdp));

    /* On récupère le membre ID */
    $req = $bdd->prepare("SELECT Member_ID FROM Member WHERE (Member_EMail = :mail)", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req->execute(array('mail' => "$email"));
    $row = $req->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];
    
     //Insertion dans la table connexion
    $req9 = $bdd->prepare('INSERT INTO Connexion (Connexion_ID, Last_Connexion, Member_ID ) VALUE (:chaine, NOW() , :id)');
    $req9->execute(array(
        'chaine' => "$connexion",
        'id' => "$memberID"));

    /* Si il a un follower, on l'ajoute */
    if (!(empty($nomAcc) && empty($prenomAcc))) {
        /* Insertion de l'accompagnateur dans la table personne */

        $req1 = $bdd->prepare('INSERT INTO Person (Person_Lastname, Person_Firstname) VALUES (:nomAcc,:prenomAcc)');
        $req1->execute(array(
            'nomAcc' => "$nomAcc",
            'prenomAcc' => "$prenomAcc"));

        /* Ajout de l'accompagnateur dans la table follower */
        $req2 = $bdd->prepare("SELECT Person_ID FROM Person WHERE (Person_Lastname = '$nomAcc' AND Person_Firstname = '$prenomAcc')", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $req2->execute(array());
        $row = $req2->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $accID = $row["Person_ID"];

        $req3 = $bdd->prepare("INSERT INTO Follower (Person_ID, Member_ID) VALUE (:id, :mid)");
        $req3->execute(array(
            'id' => "$accID", 'mid' => "$memberID"));
    }

    /* On lui crée un panier */
        $req12 = $bdd->prepare('INSERT INTO Basket (Basket_Total, Basket_Meal_Total, Basket_Trip_Total, Member_ID) VALUE (0,0,0,:id)');
    $req12->execute(array(
        'id' => "$memberID"));


$idco = $connexion;

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

                        <ul id="nav" class="nav"  style = "margin-left :76px">';
    print(" <li ><a href=\"http://localhost/lion/Lion/php/homeC.php?idco=$idco\">Home</a></li>");
    print(" <li ><a href=\"http://localhost/lion/Lion/php/agendaC.php?idco=$idco\">Agenda</a></li>");
    print(" <li ><a href=\"http://localhost/lion/Lion/php/infoC.php?idco=$idco\">Info</a></li>");
    print(" <li ><a href=\"http://localhost/lion/Lion/php/contactC.php?idco=$idco\">Contact</a></li>");

    print(" <li><a href=\"http://localhost/lion/Lion/php/panier.php?idco=$idco\" > Panier</a></li>");
    print(" <li><a href=\"http://localhost/lion/Lion/php/moncompte.php?idco=$idco\" > Mon compte</a></li>");
    print(" <li><a href=\"http://localhost/lion/Lion/php/deconnexion.php?idco=$idco\" > Se déconnecter</a></li>");
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
    afficheFooter();

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
}}
else{
    include ("fonctions.php");
     /* On récupère le membre ID */
    $req = $bdd->prepare("SELECT Member_ID FROM Member WHERE (Member_EMail = :mail)", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req->execute(array('mail' => "$email"));
    $row = $req->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];
    
    /*On récupère l'idco*/
    $req = $bdd->prepare("SELECT Connexion_ID FROM Connexion WHERE (Member_ID = :id)", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req->execute(array('id' => "$memberID"));
    $row = $req->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $idco = $row["Connexion_ID"];

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

                        <ul id="nav" class="nav"  style = "margin-left :76px">';
    print(" <li ><a href=\"http://localhost/lion/Lion/php/homeC.php?idco=$idco\">Home</a></li>");
    print(" <li ><a href=\"http://localhost/lion/Lion/php/agendaC.php?idco=$idco\">Agenda</a></li>");
    print(" <li ><a href=\"http://localhost/lion/Lion/php/infoC.php?idco=$idco\">Info</a></li>");
    print(" <li ><a href=\"http://localhost/lion/Lion/php/contactC.php?idco=$idco\">Contact</a></li>");

    print(" <li><a href=\"http://localhost/lion/Lion/php/panier.php?idco=$idco\" > Panier</a></li>");
    print(" <li><a href=\"http://localhost/lion/Lion/php/moncompte.php?idco=$idco\" > Mon compte</a></li>");
    print(" <li><a href=\"http://localhost/lion/Lion/php/deconnexion.php?idco=$idco\" > Se déconnecter</a></li>");
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
            <span><h2 style = "color :#FF5E4D; margin : 65px; text-align : center"> L\'inscription a déjà été validée avec ces informations <br></br>
           <center><FONT size="3.5pt " style = "color :#F0FFFF ;font-weight:normal">Vous êtes déjà inscrit </center></FONT></h2><span>
        <br></br>
        <br></br>
        <br></br>
</div>

       
     <!-- Message Section End-->

    <!-- footer
    ================================================== -->
    ';
    afficheFooter();

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

