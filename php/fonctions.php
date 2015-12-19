<?php
include "constantes.php";

/* ---------------------------------------------------------------------------------------------------- */
/*                            PAIEMENT PAR CB                                                         */
/* ---------------------------------------------------------------------------------------------------- */

function paiementCB($bdd, $valid, $idco) {
    if ($valid) {

        /* On récupère son member_ID */
        $sql1 = 'SELECT Member_ID FROM Connexion WHERE (Connexion_ID = :idco )';
        $stmt = $bdd->prepare($sql1, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('idco' => "$idco"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $memberID = $row["Member_ID"];

        /* On récupère son basket_ID */
        $sql2 = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id )';
        $stmt = $bdd->prepare($sql2, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('id' => "$memberID"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $basketID = $row["Basket_ID"];

        /* On met à jour les activités payées */
        $sql3 = 'UPDATE Belong SET Belong_Payement_Way = "CB" WHERE (Basket_ID = :id AND Belong_Paid =0 AND Belong_Payement_Way IS NULL)';
        $stmt = $bdd->prepare($sql3);
        $stmt->execute(array('id' => "$basketID"));

        $sql4 = 'UPDATE Belong SET Belong_Paid = 1 WHERE (Basket_ID = :id AND Belong_Payement_Way LIKE "CB")';
        $stmt = $bdd->prepare($sql4);
        $stmt->execute(array('id' => "$basketID"));

        /* On remet à 0 tous les totaux du panier */
        $sql5 = 'UPDATE Basket SET Basket_Total = 0 WHERE (Basket_ID = :id)';
        $stmt = $bdd->prepare($sql5);
        $stmt->execute(array('id' => "$basketID"));


        $sql6 = 'UPDATE Basket SET Basket_Trip_Total = 0 WHERE (Basket_ID = :id)';
        $stmt = $bdd->prepare($sql6);
        $stmt->execute(array('id' => "$basketID"));

        $sql6 = 'UPDATE Basket SET Basket_Meal_Total = 0 WHERE (Basket_ID = :id)';
        $stmt = $bdd->prepare($sql6);
        $stmt->execute(array('id' => "$basketID"));

        /* On redirige l'utilisateur vers ses achats */
        echo' 
        
<!DOCTYPE html>
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
        ================================================== -->
';



        echo' <header class="mobile">';

        echo'<div class="row"';

        echo' <div class="col full">

                    <div class="logo">';
        print(" <a href=\"http://localhost/lion/Lion/php/homeC.php?idco=$idco\" style=\"top : 4px\"><img alt=\"\" src=\"images/logo.png\" style=\"height:  50px; width: 55px; top: 4px\"></a>");
        echo'</div>

                   <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav" style = "margin-left :76px">';
        print(" <li ><a href=\"http://localhost/lion/Lion/php/homeC.php?idco=$idco\">Home</a></li>");
        print(" <li ><a href=\"http://localhost/lion/Lion/php/agendaC.php?idco=$idco\">Agenda</a></li>");
        print(" <li  ><a href=\"http://localhost/lion/Lion/php/infoC.php?idco=$idco\">Info</a></li>");
        print(" <li ><a href=\"http://localhost/lion/Lion/php/contactC.php?idco=$idco\">Contact</a></li>");


        print(" <li ><a href=\"http://localhost/lion/Lion/php/panier.php?idco=$idco\" >Panier</FONT></a></li>");
        print(" <li  class=\"active\"><a href=\"http://localhost/lion/Lion/php/moncompte.php?idco=$idco\"> Mon compte</a></li>");

        print(" <li ><a href=\"http://localhost/lion/Lion/php/deconnexion.php?idco=$idco\">Se déconnecter</a></li>");
        echo'  </ul>
                    </nav>
                </div>
            </div>';

        /* Sous onglets */
        echo'<div class="row">

        <div class="col full">

                    <nav id="nav-wrap" style="position:absolute ;right:300px  ">

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav" >';
        print(" <li  ><a href=\"http://localhost/lion/Lion/php/monCompte.php?idco=$idco\"> Informations personnelles</a></li>");
        print(" <li class=\"active\"><a href=\"http://localhost/lion/Lion/php/achats.php?idco=$idco\"> Mes achats</a></li>");
        print(" <li   ><a href=\"http://localhost/lion/Lion/php/commandes.php?idco=$idco\"> Mes commandes</a></li>");
        echo' 
         </ul>
        </nav>
                </div>
            </div>

        </header>';



        echo' 

        <!-- Header End -->

        <!-- informations Section
             ================================================== -->

        <div class="row section-head">
            <div class="col full">
                
                <br></br>
                <h2 style="margin : 65px ; color : #11ABB0; text-align : center"> Vos achats </h2>

            </div>';
        afficheAchats($bdd, $idco);
        echo' </div>

        
         
        <!-- Section End-->




        <!-- footer
        ================================================== -->';
        afficheFooter();
        echo' <!-- Footer End-->

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
    } else {

        /* On affiche une erreur */


        echo' 
        
<!DOCTYPE html>
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
        ================================================== -->
';



        echo' <header class="mobile">';

        echo'<div class="row"';

        echo' <div class="col full">

                    <div class="logo">';
        print(" <a href=\"http://localhost/lion/Lion/php/homeC.php?idco=$idco\" style=\"top : 4px\"><img alt=\"\" src=\"images/logo.png\" style=\"height:  50px; width: 55px; top: 4px\"></a>");
        echo'</div>

                   <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav" style = "margin-left :76px">';
        print(" <li ><a href=\"http://localhost/lion/Lion/php/homeC.php?idco=$idco\">Home</a></li>");
        print(" <li ><a href=\"http://localhost/lion/Lion/php/agendaC.php?idco=$idco\">Agenda</a></li>");
        print(" <li  ><a href=\"http://localhost/lion/Lion/php/infoC.php?idco=$idco\">Info</a></li>");
        print(" <li ><a href=\"http://localhost/lion/Lion/php/contactC.php?idco=$idco\">Contact</a></li>");


        print(" <li ><a href=\"http://localhost/lion/Lion/php/panier.php?idco=$idco\" >Panier</FONT></a></li>");
        print(" <li><a href=\"http://localhost/lion/Lion/php/moncompte.php?idco=$idco\"> Mon compte</a></li>");

        print(" <li ><a href=\"http://localhost/lion/Lion/php/deconnexion.php?idco=$idco\">Se déconnecter</a></li>");
        echo'  </ul>
                    </nav>
                </div>
            </div>';

        /* Sous onglets */
        echo'<div class="row">

        <div class="col full">

                    <nav id="nav-wrap" style="position:absolute ;right:300px  ">

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav" >';
        print(" <li  ><a href=\"http://localhost/lion/Lion/php/monCompte.php?idco=$idco\"> Informations personnelles</a></li>");
        print(" <li ><a href=\"http://localhost/lion/Lion/php/achats.php?idco=$idco\"> Mes achats</a></li>");
        print(" <li   ><a href=\"http://localhost/lion/Lion/php/commandes.php?idco=$idco\"> Mes commandes</a></li>");
        echo' 
         </ul>
        </nav>
                </div>
            </div>

        </header>';



        echo' 

        <!-- Header End -->

        <!-- informations Section
             ================================================== -->

        <div class="row section-head">
            <div class="col full">
                
                <br></br>
                <br></br>
                <br></br>
                <br></br>
             <center>   <h7 style="color : #FF0000;"> UNE ERREUR S\'EST PRODUITE LORS DE LA TRANSACTION, VOTRE PAIEMENT N\'A PAS PU ETRE PRIS EN COMPTE</h7>
</center>
            </div>
           
      </div>

        
         
        <!-- Section End-->




        <!-- footer
        ================================================== -->
        <?php include("footer.php"); ?>
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
}

/* ---------------------------------------------------------------------------------------------------- */
/*                            PAIEMENT PAR CH                                                        */
/* ---------------------------------------------------------------------------------------------------- */

function paiementCH($bdd, $idco) {

    /* Ajouter le mode de paiement aux activités réservées */
    /* On récupère son member_ID */
    $sql1 = 'SELECT Member_ID FROM Connexion WHERE (Connexion_ID = :idco )';
    $stmt = $bdd->prepare($sql1, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('idco' => "$idco"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];

    /* On récupère son basket_ID */
    $sql2 = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql2, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];

    /* On met à jour les activités commandées */
    $sql3 = 'UPDATE Belong SET Belong_Payement_Way = "CH" WHERE (Basket_ID = :id AND Belong_Paid =0)';
    $stmt = $bdd->prepare($sql3);
    $stmt->execute(array('id' => "$basketID"));

    $sql3 = 'UPDATE Belong SET Belong_Date = NOW() WHERE (Basket_ID = :id AND Belong_Paid =0)';
    $stmt = $bdd->prepare($sql3);
    $stmt->execute(array('id' => "$basketID"));

    /* On remet à 0 tous les totaux du panier */
    $sql5 = 'UPDATE Basket SET Basket_Total = 0 WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql5);
    $stmt->execute(array('id' => "$basketID"));


    $sql6 = 'UPDATE Basket SET Basket_Trip_Total = 0 WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql6);
    $stmt->execute(array('id' => "$basketID"));

    $sql6 = 'UPDATE Basket SET Basket_Meal_Total = 0 WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql6);
    $stmt->execute(array('id' => "$basketID"));

    /* Afficher un message indiquant la démarche à suivre à l'utilisateur */

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

                        <ul id="nav" class="nav" style = "margin-left :76px">';
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

            <h2 style = "color :#70F861; margin : 65px; text-align : center"> Commande enregistrée <br></br>
             
            <center><FONT size="3.5pt " style = "color :#F0FFFF ;font-weight:normal"> Merci d\'imprimer votre bon de commande ci-dessous et de l\'envoyer avec le chèque à l\'adresse : <br>38, rue Albert Dory - 44300 NANTES - FRANCE </center></FONT></h2>
            
        
            <center><FONT size="3.5pt " style = "color :#9F9898 ;font-weight:normal"> Vous pouvez consulter vos commandes dans Mes Commandes de l\'onglet Mon Compte. A la réception de votre chèque, votre réservation apparaitra dans la rubrique Mes Achats.  </center></FONT></h2>
        <br></br>
     
</div>';

    echo'<form name="bonDeCommande" id="contactForm" method="post"  action="bonDeCommande.php">
            <div align="center">
                <input type="submit" name="v" value="Imprimer mon bon de commande">
                 <input type="hidden"  name="idco" value="' . $idco . '">
            </div>';


    echo' <!-- Message Section End-->

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

/* ---------------------------------------------------------------------------------------------------- */
/*                           DECONNEXION                                                        */
/* ---------------------------------------------------------------------------------------------------- */

function deconnexion($idco, $bdd) {


    /* Récupération du membre id */
    $sql = 'SELECT Member_ID FROM Connexion WHERE (Connexion_ID = :idco)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('idco' => "$idco"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];

    /* Récupération du basket id */
    $sql = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];

    /* Incrémentation des capacités de toutes les activités supprimées */
    $sql1 = 'SELECT Count(Follower_ID) FROM Follower WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql1, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $c = $row["Count(Follower_ID)"];

    $sql = 'SELECT Activity.Activity_ID , Activity_Capacity FROM Activity  INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) WHERE (Basket_ID =' . $basketID . ' AND Belong_Paid =0 AND Belong_Payement_Way IS NULL AND Congress_ID =' . congressID . ' )';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array());


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

        $activiteID = $row["Activity_ID"];
        $cap = $row["Activity_Capacity"];
        $cap1 = "$cap" + "1" + "$c"; /* Si il y a un follower, on augmente de 2 */

        $sql2 = 'UPDATE Activity SET Activity_Capacity = :c WHERE (Activity_ID = :id AND Congress_ID =' . congressID . ' )';
        $stmt2 = $bdd->prepare($sql2);
        $stmt2->execute(array('c' => "$cap1", 'id' => "$activiteID"));
    }


    /* Suppression des activités non payées */
    $sql = 'DELETE FROM Belong WHERE(Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL)';
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(':id' => "$basketID"));

    /* Remise à 0 des totaux du panier */
    $sql = 'UPDATE Basket SET Basket_Total =0 WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(':id' => "$basketID"));

    $sql = 'UPDATE Basket SET Basket_Meal_Total =0 WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(':id' => "$basketID"));

    $sql = 'UPDATE Basket SET Basket_Trip_Total =0 WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(':id' => "$basketID"));

    /* Suppression de la connexion */
    $req0 = $bdd->prepare('DELETE FROM Connexion WHERE (Connexion_ID=:id)');
    $req0->execute(array('id' => $idco));

    header("Location: http://Localhost/lion/Lion/php/home.php");
}

/* ---------------------------------------------------------------------------------------------------- */
/*                           AFFICHAGE AGENDA EN MODE NON CONNECTE                                                      */
/* ---------------------------------------------------------------------------------------------------- */

/* Fontion pour afficher le tableau des repas */

function afficheRepas($bdd) {
    try {

        /* Préparation de la requête */
        $sql = 'SELECT Activity_Name, Activity_Date, Activity_Price1, Activity_Price2, Activity_Capacity FROM Activity ' .
                'INNER JOIN Activity_Type ON (Activity.Activity_Type_ID = Activity_Type.Activity_Type_ID) ' .
                'WHERE (Congress_ID =' . congressID . ' AND (Activity_Type_Name= :nom)) ORDER BY (Activity_Date);';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));

        /* Exécution de la requête */
        $stmt->execute(array(':nom' => 'Repas'));

        /* Exploitation des résultats */

        /* Création du tableau */
        echo'
    <html>
         <div>
               <center><TABLE id="tableau" cols="3" style="border:1px solid black">
                    <CAPTION> <h2>Repas<br></br></h2> </CAPTION>

                    <TR class="row" >
                        <TH class ="col" height=60 width=20% style="border:1px solid black;">Date</TH>
                        <TH class ="col" height=60 width=30% style="border:1px solid black;">Intitulé </TH>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif privilège <br>(jusqu\'au 31/03)  </th>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif plein <br>(à compter du 01/04)  </th>
                        <th class ="col" height=60 width=100.65 width=10% style="border:1px solid black"> <FONT size="2.5pt">Places restantes </FONT></th>
                     </TR>';

        /* Affichage des activités */
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            if ($row["Activity_Capacity"] > 0) {
                afficheActiviteLibre($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"], $row["Activity_Capacity"]);
            } else {
                afficheActiviteComplete($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"]);
            }
        }

        /* Fermeture du tableau */
        echo'</TABLE></center>
                        </div>
                        <br></br></html>';
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
}

/* Fontion pour afficher le tableau des excursions */

function afficheExcursions($bdd) {
    try {

        /* Préparation de la requête */
        $sql = 'SELECT Activity_Name, Activity_Date, Activity_Price1, Activity_Price2, Activity_Capacity FROM Activity ' .
                'INNER JOIN Activity_Type ON (Activity.Activity_Type_ID = Activity_Type.Activity_Type_ID) ' .
                'WHERE (Congress_ID =' . congressID . ' AND (Activity_Type_Name= :nom)) ORDER BY (Activity_Date);';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));

        /* Exécution de la requête */
        $stmt->execute(array(':nom' => 'Excursion'));

        /* Exploitation des résultats */

        /* Création du tableau */
        echo'
    <html>
         <div>
               <center><TABLE id="tableau" cols="3" style="border:1px solid black">
                    <CAPTION> <h2>Excursions<br></br></h2> </CAPTION>

                    <TR class="row" >
                        <TH class ="col" height=60 width=20% style="border:1px solid black;">Date</TH>
                        <TH class ="col" height=60 width=30% style="border:1px solid black;">Intitulé </TH>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif privilège <br>(jusqu\'au 31/03)  </th>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif plein <br>(à compter du 01/04)  </th>
                        <th class ="col" height=60 width=100.65 width=10% style="border:1px solid black"> <FONT size="2.5pt">Places restantes </FONT></th>
                     </TR>';

        /* Affichage des activités */
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            if ($row["Activity_Capacity"] > 0) {
                afficheActiviteLibre($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"], $row["Activity_Capacity"]);
            } else {
                afficheActiviteComplete($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"]);
            }
        }

        /* Fermeture du tableau */
        echo'</TABLE></center>
                        </div>
                        <br></br></html>';
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
}

/* Fontion pour afficher d'une activité libre */

function afficheActiviteLibre($nom, $date, $prix1, $prix2, $capacity) {

    echo'<TR >
                                        <Td class ="col" height =33 rowspan="2" width=20% style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF"><b>' . $date . '</b></FONT></Td>
                                        <Td class ="col" height =33 width=30% style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF">' . $nom . ' </FONT></Td>
                                        <Td class ="col" height =33 width=20% style="border:1px solid black; text-align : center"> <FONT style="color : #F0FFFF"> ' . $prix1 . ' €</FONT> </Td>
                                        <Td class ="col" height =33 width=20% style="border:1px solid black;text-align : center"><FONT style="color : #F0FFFF"> ' . $prix2 . ' €</FONT></Td>
                                        <Td class ="col" height =33 width=100.65 width=10% style="border:1px solid black;text-align : center"><FONT style="color : #70F861"> <b> ' . $capacity . ' </b></FONT></Td>
                                    </TR>';
}

/* Fontion pour afficher d'une activité complète */

function afficheActiviteComplete($nom, $date, $prix1, $prix2) {

    echo' <TR style="color: #525252;">
                                        <Td class ="col"  height =33 width=20% style="border:1px solid black; text-align : center;"><b> ' . $date . '</b></Td>
                                        <Td class ="col" height =33 width=30% style="border:1px solid black; text-align : center;"> ' . $nom . '</Td>
                                        <Td class ="col" height =33 width=20% style="border:1px solid black; text-align : center"> ' . $prix1 . ' € </Td>
                                        <Td class ="col" height =33 width=20% style="border:1px solid black;text-align : center">' . $prix2 . ' €</Td>
                                        <Td class ="col" height =33 width=100.65 style="border:1px solid black;text-align : center"><FONT style="color : #FF5E4D"> Complet </FONT></Td>
                                    </TR>';
}

/* Affichage complet de l'agenda */

function afficheAgenda($bdd) {
    /* Affichage des activités */
    echo'<html> <div class="row section-head">
        <div class="col full">
            <span><h2 style = "color :#11ABB0; margin : 65px; text-align : center">Agenda des conférences et des activités <br>
           <center><FONT size="3.5pt " style = "color :#F0FFFF ;font-weight:normal">Connectez vous pour pouvoir choisir des activités!</center></FONT></h2><span>
        </div>
        </html>';

    afficheRepas($bdd);
    afficheExcursions($bdd);
    echo'</html> </div></html>';
}

/* ---------------------------------------------------------------------------------------------------- */
/*                           AFFICHAGE AGENDA EN MODE CONNECTE                                                      */
/* ---------------------------------------------------------------------------------------------------- */

/* Fontion pour afficher le tableau des repas */

function afficheRepas2($bdd, $idco) {
    try {

        /* Préparation de la requête */
        $sql = 'SELECT Activity_Name, Activity_Date, Activity_Price1, Activity_Price2, Activity_Capacity FROM Activity ' .
                'INNER JOIN Activity_Type ON (Activity.Activity_Type_ID = Activity_Type.Activity_Type_ID) ' .
                'WHERE (Congress_ID =' . congressID . ' AND (Activity_Type_Name= :nom)) ORDER BY (Activity_Date);';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));

        /* Exécution de la requête */
        $stmt->execute(array(':nom' => 'Repas'));

        /* Exploitation des résultats */

        /* Création du tableau */
        echo'
    <html>
         <div>
               <center><TABLE id="tableau" cols="3" style="border:1px solid black">
                    <CAPTION> <h2>Repas<br></br></h2> </CAPTION>

                    <TR class="row" >
                        <TH class ="col"  height=60 width=20% style="border:1px solid black;">Date</TH>
                        <TH class ="col" height=60 width=30% style="border:1px solid black;">Intitulé </TH>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif privilège <br>(jusqu\'au 31/30)  </th>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif plein <br>(à compter du 01/04)  </th>
                        <th class ="col" height=60 width=100.65 width=10% style="border:1px solid black"> <FONT size="2.5pt">Ajouter au panier </FONT></th>
                     </TR>';

        /* Affichage des activités */
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            if ($row["Activity_Capacity"] > 0) {
                afficheActiviteLibre2($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"], $idco, $bdd);
            } else {
                afficheActiviteComplete2($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"], $idco, $bdd);
            }
        }

        /* Fermeture du tableau */
        echo'</TABLE></center>
                        </div>
                        <br></br></html>';
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
}

/* Fontion pour afficher le tableau des excursions */

function afficheExcursions2($bdd, $idco) {
    try {

        /* Préparation de la requête */
        $sql = 'SELECT Activity_Name, Activity_Date, Activity_Price1, Activity_Price2, Activity_Capacity FROM Activity ' .
                'INNER JOIN Activity_Type ON (Activity.Activity_Type_ID = Activity_Type.Activity_Type_ID) ' .
                'WHERE (Congress_ID = ' . congressID . ' AND (Activity_Type_Name= :nom)) ORDER BY (Activity_Date);';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));

        /* Exécution de la requête */
        $stmt->execute(array(':nom' => 'Excursion'));

        /* Exploitation des résultats */

        /* Création du tableau */
        echo'
    <html>
         <div>
               <center><TABLE id="tableau" cols="3" style="border:1px solid black">
                    <CAPTION> <h2>Excursions<br></br></h2> </CAPTION>

                    <TR class="row" >
                        <TH class ="col" height=60 width=20% style="border:1px solid black;">Date</TH>
                        <TH class ="col" height=60 width=30% style="border:1px solid black;">Intitulé </TH>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif privilège <br>(jusqu\'au 31/30)  </th>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif plein <br>(à compter du 01/04)  </th>
                        <th class ="col" height=60 width=100.65 width=10% style="border:1px solid black"> <FONT size="2.5pt">Ajouter au panier </FONT></th>
                     </TR>';

        /* Affichage des activités */
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            if ($row["Activity_Capacity"] > 0) {
                afficheActiviteLibre2($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"], $idco, $bdd);
            } else {
                afficheActiviteComplete2($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"], $idco, $bdd);
            }
        }

        /* Fermeture du tableau */
        echo'</TABLE></center>
                        </div>
                        <br></br></html>';
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
}

/* Fontion pour afficher d'une activité libre */

function afficheActiviteLibre2($nom, $date, $prix1, $prix2, $idco, $bdd) {

    /* On teste si l'utilisateur a déjà réseré cette activité ou non */
    /* On récupère l'id du membre */
    $sql1 = 'SELECT Member_ID FROM Connexion WHERE (Connexion_ID = :idco )';
    $stmt = $bdd->prepare($sql1, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('idco' => "$idco"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];

    /* On récupère son basket id */
    $sql2 = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql2, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];

    /* On récupère d'activité ID */
    $sql3 = 'SELECT Activity_ID FROM Activity WHERE (Activity_Name = :nom )';
    $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('nom' => "$nom"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $activiteID = $row["Activity_ID"];

    /* on regarde si l'activité est dans son panier ou non */
    $sql3 = 'SELECT count(Basket_ID) FROM Belong WHERE (Basket_ID = :Bid AND Activity_ID = :Aid )';
    $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('Bid' => "$basketID", 'Aid' => "$activiteID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["count(Basket_ID)"];

    if ($cpt != 0) {

        echo' <TR style="color: #525252;">
                                        <Td class ="col" height =66 width=20% style="border:1px solid black; text-align : center;"><b> ' . $date . '</b></Td>
                                        <Td class ="col" height =66 width=30% style="border:1px solid black; text-align : center;"> ' . $nom . '</Td>
                                        <Td class ="col" height =66 width=20% style="border:1px solid black; text-align : center"> ' . $prix1 . ' € </Td>
                                        <Td class ="col" height =66 width=20% style="border:1px solid black;text-align : center">' . $prix2 . ' €</Td>
                                        <Td class ="col" height =66 width=100.65 width=10% style="border:1px solid black;text-align : center"><FONT style="color : #70F861"> Déjà réservée </FONT></Td>
                                    </TR>';
    } else {
        echo'<TR >
                                        <Td class ="col" height=44.688  width=20% style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF"><b>' . $date . '</b></FONT></Td>
                                        <Td class ="col" height=44.688 width=30% style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF">' . $nom . ' </FONT></Td>
                                        <Td class ="col" height=44.688 width=20% style="border:1px solid black; text-align : center"> <FONT style="color : #F0FFFF"> ' . $prix1 . ' € </FONT> </Td>
                                        <Td class ="col" height=44.688 width=20% style="border:1px solid black;text-align : center"><FONT style="color : #F0FFFF"> ' . $prix2 . '€</FONT></Td>
                                        <Td class ="col" width=100.65 style ="padding:9px 36px" height=44.688 width=10% style="border:1px solid black;text-align : center">  
                                            <form action="ajoutActivite.php" method="post" onclick="alert(\'Activité ajoutée au panier\')"> 
                                                <input type="submit" style= "padding:0 ; margin-bottom : 0;margin-top : 9; height : 25px; width : 25px; background:#70F861"   name="add" value="+">
                                                 <input type="hidden"  name="activity" value="' . $nom . '">
                                                  <input type="hidden"  name="idco" value="' . $idco . '">
                                                </form>
                                        </Td>                        
         </TR>';
    }
}

/* Fontion pour afficher d'une activité complète */

function afficheActiviteComplete2($nom, $date, $prix1, $prix2, $idco, $bdd) {
    /* On teste si l'utilisateur a déjà réseré cette activité ou non */
    /* On récupère l'id du membre */
    $sql1 = 'SELECT Member_ID FROM Connexion WHERE (Connexion_ID = :idco )';
    $stmt = $bdd->prepare($sql1, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('idco' => "$idco"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];

    /* On récupère son basket id */
    $sql2 = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql2, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];

    /* On récupère d'activité ID */
    $sql3 = 'SELECT Activity_ID FROM Activity WHERE ( Activity_Name = :nom )';
    $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('nom' => "$nom"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $activiteID = $row["Activity_ID"];

    /* on regarde si l'activité est dans son panier ou non */
    $sql3 = 'SELECT count(Basket_ID) FROM Belong WHERE (Basket_ID = :Bid AND Activity_ID = :Aid )';
    $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('Bid' => "$basketID", 'Aid' => "$activiteID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["count(Basket_ID)"];


    if ($cpt == 0) {

        echo' <TR style="color: #525252;">
                                        <Td class ="col" height =33 width=20% style="border:1px solid black; text-align : center;"><b> ' . $date . '</b></Td>
                                        <Td class ="col" height =33 width=30% style="border:1px solid black; text-align : center;"> ' . $nom . '</Td>
                                        <Td class ="col" height =33 width=20% style="border:1px solid black; text-align : center"> ' . $prix1 . ' € </Td>
                                        <Td class ="col" height =33 width=20% style="border:1px solid black;text-align : center">' . $prix2 . ' €</Td>
                                        <Td class ="col" height =33 width=100.65 width=10% style="border:1px solid black;text-align : center"><FONT style="color : #FF5E4D"> Complet </FONT></Td>
                                    </TR>';
    } else {
        echo' <TR style="color: #525252;">
                                        <Td class ="col" height =66 width=20% style="border:1px solid black; text-align : center;"><b> ' . $date . '</b></Td>
                                        <Td class ="col" height =66 width=30% style="border:1px solid black; text-align : center;"> ' . $nom . '</Td>
                                        <Td class ="col" height =66 width=20% style="border:1px solid black; text-align : center"> ' . $prix1 . ' € </Td>
                                        <Td class ="col" height =66 width=20% style="border:1px solid black;text-align : center">' . $prix2 . ' €</Td>
                                        <Td class ="col" height =66 width=100.65 width=10% style="border:1px solid black;text-align : center"><FONT style="color : #70F861"> Déjà réservée </FONT></Td>
                                    </TR>';
    }
}

/* * **************Affichage de tout l'agenda****************** */

function afficheAgenda2($idco, $bdd) {


    /* Affichage des activités */
    echo'<html> <div class="row section-head">
        <div class="col full">
            <span><h2 style = "color :#11ABB0; margin : 65px; text-align : center">Agenda des conférences et des activités</h2><span>
        </div>
        </html>';

    compteurPanier($bdd, $idco);
    afficheRepas2($bdd, $idco);
    afficheExcursions2($bdd, $idco);
    echo'<html> </div></html>';
}

/* * ************** Compteur pour le panier ****************** */

function compteurPanier($bdd, $idco) {
    /* Récupération du membre id */
    $sql = 'SELECT Member_ID FROM Connexion WHERE (Connexion_ID = :idco)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':idco' => "$idco"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];

    /* Récupération du basket id */
    $sql = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];

    /* Récupération du nombre d'activités dans le panier */
    $sql = 'SELECT Count(Activity.Activity_ID) FROM Activity '
            . 'INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Congress_ID =' . congressID . ' ) ';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Activity.Activity_ID)"];

    /* Exploitation des résultats */

    if ($cpt == 0) {
        echo' 
                <div align="right">
                <TABLE id="tableau" border cols="1" style="border:1px solid #32787A; margin-left : 0; width : 10%">
                    <TR class="row" >
                        <TH class ="col" height=60 width=100 "><FONT style="color : #32787A; font-weight:normal;"> Panier vide </FONT></TH>
                    </TR>
                </TABLE>
                </div>';
    } else {
        if ($cpt == 1) {
            echo' 
                <div align="right">
                <TABLE id="tableau" border cols="1" style="border:1px solid #32787A; margin-left : 0; width : 10%">
                    <TR class="row" >
                        <TH class ="col" height=60 width=100 "><FONT style="color : #32787A; font-weight:normal;"> Panier <FONT><br><FONT size="5" style="color : #11ABB0;">' . $cpt . ' </FONT></TH>
                    </TR>
                </TABLE>
                </div>';
        } else {
            echo' 
                <div align="right">
                <TABLE id="tableau" border cols="1" style="border:1px solid #32787A; margin-left : 0; width : 10%">
                    <TR class="row" >
                        <TH class ="col" height=60 width=100 "><FONT style="color : #32787A; font-weight:normal;"> Panier <FONT><br><FONT size="5" style="color : #11ABB0;">' . $cpt . ' </FONT></TH>
                    </TR>
                </TABLE>
                </div>';
        }
    }
}

/* ---------------------------------------------------------------------------------------------------- */
/*                           AFFICHAGE ACHATS                                    */
/* ---------------------------------------------------------------------------------------------------- */

function afficheAchats($bdd, $idco) {
    /* Récupération du membreID */
    $sql = 'SELECT Member_ID FROM Connexion  WHERE (Connexion_ID = :id)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$idco"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];

    /* Récupération du basketID */
    $sql = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];

    /*     * ************************************************** */
    /* Récupération des repas payés et affichage */
    /*     * **************************************************** */


    echo'       <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Repas<FONT></h2>
         </div>';

    /* Récupération du nombre de repas réservés */
    $sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 1 AND Activity_Type_Name = "Repas" AND Congress_ID = ' . congressID . ')';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Activity.Activity_ID)"];

    $totalrepas = 0;

    if ($cpt != 0) {

        $sql = 'SELECT  Activity_Name, Activity_Date, Belong_Price FROM Activity '
                . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
                . ' WHERE (Basket_ID = :id AND Belong_Paid = 1 AND Activity_Type_Name = "Repas" AND Congress_ID = ' . congressID . ') ORDER BY (Activity_Date)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));


        echo'
<div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 70%; margin-left : 0">             
         <TR class="row" >
                        <Td class ="col"  width=30% style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B"> Date </FONT></TH>
                        <td class ="col" width=50% style="border:1px solid black; text-align : center;"> <FONT size="4" style="color : #52574B"> Intitulé </FONT></th>
                        <td class ="col" width=140.62 style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Tarif </FONT></th>
        </TR>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $date = $row["Activity_Date"];
            $prix = $row["Belong_Price"];
            $totalrepas = "$prix" + "$totalrepas";
            echo' <TR class="row" >
           <Td class ="col"  width=30% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $date . '</FONT> </TH>
           <td class ="col" width=50% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $activite . '</FONT> </th>
           <td class ="col" width=140.62 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $prix . ' € </FONT> </th>
         </TR>';
        } echo'</TABLE>
             </div>';
    } else {
        echo'  <div>
           <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > Aucun repas réservé</h2> 
        </div>';
    }

    /*     * ****************************************************** */
    /* Récupération des excursions payées et affichage */
    /*     * ******************************************************** */

    echo'

        <div class="row section-head">
        <br>
            <h2 style="color : #8BB24C;"> <FONT size="5"> Excursions<FONT></h2>
         </div>';

    /* Récupération du nombre d'excursions réservées */
    $sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 1 AND Activity_Type_Name = "Excursion" AND Congress_ID = ' . congressID . ')';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt2 = $row["Count(Activity.Activity_ID)"];

    $totalexcursions = 0;

    if ($cpt2 != 0) {
        $sql = 'SELECT  Activity_Name, Activity_Date, Belong_Price FROM Activity '
                . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
                . ' WHERE (Basket_ID = :id AND Belong_Paid = 1 AND Activity_Type_Name = "Excursion" AND Congress_ID = ' . congressID . ') ORDER BY (Activity_Date)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));


        echo'
<div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 70%; margin-left : 0">             
         <TR class="row" >
                        <Td class ="col"  width=30% style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B"> Date </FONT></TH>
                        <td class ="col" width=50% style="border:1px solid black; text-align : center;"> <FONT size="4" style="color : #52574B"> Intitulé </FONT></th>
                        <td class ="col" width=140.62 style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Tarif </FONT></th>
        </TR>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $date = $row["Activity_Date"];
            $prix = $row["Belong_Price"];

            $totalexcursions = $prix + $totalexcursions;
            echo' <TR class="row" >
           <Td class ="col"  width=30% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $date . '</FONT> </TH>
           <td class ="col" width=50% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $activite . '</FONT> </th>
           <td class ="col" width=140.62 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $prix . ' € </FONT> </th>
         </TR>';
        } echo'</TABLE>
             </div>';
    } else {
        echo'  <div>
           <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > Aucune excursion réservée</h2> 
        </div>';
    }
    /*     * *************************** */
    /* Affichage des totaux */
    /*     * *********************** */

    $total = $totalrepas + $totalexcursions;
    echo'

        <div class="row section-head">
            <br></br>
            <h2 style="color : #8BB24C;" > <FONT size="5"> Totaux <FONT></h2> 
        </div>

<div>
               <TABLE id="tableau" border width=50% cols="2" style="border:1px solid black;width : 40%; margin-left : 0" >

                    <TR class="row" >
                        <Td class ="col"  width=300 height = 35 style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B">  Total des repas </Td>
                        <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $totalrepas . ' € </FONT></Td>
                    </TR>
                    <TR class="row" >
                        <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B">  Total des excursions </Td>
                        <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $totalexcursions . ' € </FONT></Td>
                    </TR>
                    <TR class="row" >
                        <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B">  Total </b> </Td>
                        <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color:#BA052C">' . $total . ' € </FONT></Td>
                    </TR>
                    </TABLE>
                        </div>
                        <br>';
}

/* ---------------------------------------------------------------------------------------------------- */
/*                           AFFICHAGE COMMANDES                                   */
/* ---------------------------------------------------------------------------------------------------- */

function afficheCommandes($bdd, $idco) {
    /* Récupération du membreID */
    $sql = 'SELECT Member_ID FROM Connexion  WHERE (Connexion_ID = :id)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$idco"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];

    /* Récupération du basketID */
    $sql = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];

    /*     * ************************************************** */
    /* Récupération des repas payés et affichage */
    /*     * **************************************************** */


    echo'       <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Repas<FONT></h2>
         </div>';

    /* Récupération du nombre de repas réservés */
    $sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way="CH" AND Activity_Type_Name = "Repas" AND Congress_ID =' . congressID . ' )';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Activity.Activity_ID)"];

    $totalrepas = 0;

    if ($cpt != 0) {

        $sql = 'SELECT  Activity_Name, Activity_Date, Belong_Price FROM Activity '
                . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
                . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way="CH" AND Activity_Type_Name = "Repas" AND Congress_ID =' . congressID . ' ) ORDER BY (Activity_Date)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));


        echo'
<div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 70%; margin-left : 0">             
         <TR class="row" >
                        <Td class ="col"  width=30% style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B"> Date </FONT></TH>
                        <td class ="col" width=50% style="border:1px solid black; text-align : center;"> <FONT size="4" style="color : #52574B"> Intitulé </FONT></th>
                        <td class ="col" width=140.62 style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Tarif </FONT></th>
        </TR>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $date = $row["Activity_Date"];
            $prix = $row["Belong_Price"];
            $totalrepas = "$prix" + "$totalrepas";
            echo' <TR class="row" >
           <Td class ="col"  width=30% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $date . '</FONT> </TH>
           <td class ="col" width=50% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $activite . '</FONT> </th>
           <td class ="col" width=140.62 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $prix . ' € </FONT> </th>
         </TR>';
        } echo'</TABLE>
             </div>';
    } else {
        echo'  <div>
           <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > Aucun repas commandé</h2> 
        </div>';
    }

    /*     * ****************************************************** */
    /* Récupération des excursions payées et affichage */
    /*     * ******************************************************** */

    echo'

        <div class="row section-head">
        <br>
            <h2 style="color : #8BB24C;"> <FONT size="5"> Excursions<FONT></h2>
         </div>';

    /* Récupération du nombre d'excursions réservées */
    $sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way="CH" AND Activity_Type_Name = "Excursion" AND Congress_ID =' . congressID . ' )';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt2 = $row["Count(Activity.Activity_ID)"];

    $totalexcursions = 0;

    if ($cpt2 != 0) {
        $sql = 'SELECT  Activity_Name, Activity_Date, Belong_Price FROM Activity '
                . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
                . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way="CH" AND Activity_Type_Name = "Excursion" AND Congress_ID =' . congressID . ' ) ORDER BY (Activity_Date)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));


        echo'
<div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 70%; margin-left : 0">             
         <TR class="row" >
                        <Td class ="col"  width=30% style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B"> Date </FONT></TH>
                        <td class ="col" width=50% style="border:1px solid black; text-align : center;"> <FONT size="4" style="color : #52574B"> Intitulé </FONT></th>
                        <td class ="col" width=140.62 style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Tarif </FONT></th>
        </TR>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $date = $row["Activity_Date"];
            $prix = $row["Belong_Price"];

            $totalexcursions = $prix + $totalexcursions;
            echo' <TR class="row" >
           <Td class ="col"  width=30% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $date . '</FONT> </TH>
           <td class ="col" width=50% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $activite . '</FONT> </th>
           <td class ="col" width=140.62 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $prix . ' € </FONT> </th>
         </TR>';
        } echo'</TABLE>
             </div>';
    } else {
        echo'  <div>
           <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > Aucune excursion commandée</h2> 
        </div>';
    }
    /*     * *************************** */
    /* Affichage des totaux */
    /*     * *********************** */

    $total = $totalrepas + $totalexcursions;
    echo'

        <div class="row section-head">
            <br></br>
            <h2 style="color : #8BB24C;" > <FONT size="5"> Totaux <FONT></h2> 
        </div>

<div>
               <TABLE id="tableau" border width=50% cols="2" style="border:1px solid black;width : 40%; margin-left : 0" >

                    <TR class="row" >
                        <Td class ="col"  width=300 height = 35 style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B">  Total des repas </Td>
                        <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $totalrepas . ' € </FONT></Td>
                    </TR>
                    <TR class="row" >
                        <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B">  Total des excursions </Td>
                        <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $totalexcursions . ' € </FONT></Td>
                    </TR>
                    <TR class="row" >
                        <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B">  Total </b> </Td>
                        <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color:#BA052C">' . $total . ' € </FONT></Td>
                    </TR>
                    </TABLE>
                        </div>
<br>';
}

/* ---------------------------------------------------------------------------------------------------- */
/*                           AFFICHAGE INFOS PERSO                                 */
/* ---------------------------------------------------------------------------------------------------- */

function afficheInfos($bdd, $idco) {

    /* Récupération des données personnelles du membre */
    $sql = 'SELECT Member_ID, Person_Lastname, Person_Firstname, Member_Title, Member_Status, District_Name, Club_Name, '
            . ' Member_Num, Member_Additional_Adress, Member_Street, Member_City, Member_Postal_Code, Member_Phone, '
            . ' Member_Mobile, Member_EMail, Member_Position_Club, Member_Position_District, Member_By_Train, Member_Date_Train '
            . ' FROM Member'
            . ' INNER JOIN Connexion ON (Connexion.Member_ID = Member.Member_ID)  '
            . ' INNER JOIN Person ON (Person.Person_ID = Member.Person_ID) '
            . ' INNER JOIN Club ON (Club.Club_ID = Member.Club_ID) '
            . ' INNER JOIN District ON (District.District_ID = Member.District_ID) '
            . ' WHERE (Connexion_ID = :id)';

    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$idco"));

    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];
    $nom = $row["Person_Lastname"];
    $prenom = $row["Person_Firstname"];
    $titre = $row["Member_Title"];
    $status = $row["Member_Status"];
    $district = $row["District_Name"];
    $club = $row["Club_Name"];
    $num = $row["Member_Num"];
    $adressesup = $row["Member_Additional_Adress"];
    $rue = $row["Member_Street"];
    $ville = $row["Member_City"];
    $cp = $row["Member_Postal_Code"];
    $tel = $row["Member_Phone"];
    $mobile = $row["Member_Mobile"];
    $mail = $row["Member_EMail"];
    $positionclub = $row["Member_Position_Club"];
    $positiondistrict = $row["Member_Position_District"];
    $train = $row["Member_By_Train"];
    $traindate = $row["Member_Date_Train"];


    /* Récupération du follower */
    $sql = 'SELECT Person_Lastname, Person_Firstname '
            . 'FROM Follower '
            . ' INNER JOIN Person ON (Person.Person_ID = Follower.Person_ID) '
            . ' INNER JOIN Member ON (Member.Member_ID = Follower.Member_ID)'
            . ' WHERE (Member_ID = :id)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $fnom = $row["Person_Lastname"];
    $fprenom = $row["Person_Firstname"];

    /* Affichage des données personnelles avec possibilité de modification */
}

/* ---------------------------------------------------------------------------------------------------- */
/*                           AFFICHAGE PANIER                                                        */
/* ---------------------------------------------------------------------------------------------------- */


/* Fontion pour afficher le tableau des activités du panier */

function affichePanier($bdd, $idco) {
    try {

        /* Récupération du membre id */
        $sql = 'SELECT Member_ID FROM Connexion WHERE (Connexion_ID = :idco)';
        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':idco' => "$idco"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $memberID = $row["Member_ID"];

        /* Récupération du basket id */
        $sql = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id)';
        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$memberID"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $basketID = $row["Basket_ID"];

        /* Récupération des activités non payées */
        $sql = 'SELECT Activity_Type_Name, Activity_Name, Activity_Date, Belong_Price FROM Activity '
                . 'INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . 'INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
                . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Congress_ID =' . congressID . ') ORDER BY (Activity_Date)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));
        /* Exploitation des résultats */

        /* Création du tableau */
        echo'
    <html>
         <div>
               <center><TABLE id="tableau" cols="3" style="border:1px solid black">
                 

                    <TR class="row" >
                        <TH class ="col"   width=20% style="border:1px solid black;">Type </TH>
                        <TH class ="col"  width=20% style="border:1px solid black;"> Date </TH>
                        <th class ="col" width=20% style="border:1px solid black"> Intitulé </th>
                        <th class ="col" width=15% style="border:1px solid black">Tarif </th>
                        <th class ="col"   width=25% style="border:1px solid black"> Supprimer du panier</th>
                     </TR>';

        /* Affichage des activités */
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            afficheActivite($row["Activity_Type_Name"], $row["Activity_Name"], $row["Activity_Date"], $row["Belong_Price"], $idco, $bdd);
        }

        /* Fermeture du tableau */
        echo'</TABLE></center>
                        </div>
                        <br></br></html>';

        /* Total */
        $sql = 'SELECT Basket_Meal_Total, Basket_Trip_Total, Basket_Total FROM Basket WHERE (Basket_ID = :id)';
        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $totalrepas = $row["Basket_Meal_Total"];
        $totalexcursion = $row["Basket_Trip_Total"];
        $total = $row["Basket_Total"];

        /* Affichage des totaux */
        echo'
    <html>
         <div align="right">
               <TABLE id="tableau" border width=50% cols="2" style="border:1px solid black;width : 40%; margin-left : 0" >
                 
                 <CAPTION> <h2>Récapitulatif <br></h2> </CAPTION>
                    <TR class="row" >
                        <TH class ="col"   width=300 style="border:1px solid black; text-align : center;"> Total des repas </TH>
                        <Td class ="col"  width=101 style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF">' . $totalrepas . ' € </FONT></TH>
                    </TR>
                    <TR class="row" >
                        <TH class ="col"   width=300 style="border:1px solid black; text-align : center;"> Total des excursions </TH>
                        <Td class ="col"  width=101 style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF">' . $totalexcursion . ' € </FONT></TH>
                    </TR>
                    <TR class="row" >
                        <TH class ="col"   width=300 style="border:1px solid black; text-align : center;"><b> Total </b> </TH>
                        <Td class ="col"  width=101 style="border:1px solid black; text-align : center;"> <FONT style="color : #11ABB0"><b>' . $total . ' € </b></FONT></TH>
                    </TR>
                    </TABLE>
                        </div>
                        <br>';

        afficheBoutonValider($basketID, $bdd, $idco);

        echo' </form></html>';
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
}

/* Fontion pour afficher d'une activité */

function afficheActivite($type, $nom, $date, $prix, $idco, $bdd) {

    echo'<TR >
                                        <Td class ="col" height=44.688  width=20% style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF">' . $type . '</FONT></Td>
                                        <Td class ="col" height=44.688 width=20% style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF">' . $date . ' </FONT></Td>
                                        <Td class ="col" height=44.688 width=20% style="border:1px solid black; text-align : center"> <FONT style="color : #F0FFFF"> ' . $nom . '  </FONT> </Td>
                                        <Td class ="col" height=44.688 width=15% style="border:1px solid black;text-align : center"><FONT style="color : #F0FFFF"> ' . $prix . '€</FONT></Td>
                                        <Td class ="col" width=100.65 style ="padding:9px 115px" height=44.688 width=25% style="border:1px solid black;text-align : center">  
                                            <form action="suppActivite.php" method="post"> 
                                                <input type="submit" style= "padding:0 ; margin-bottom : 0;margin-top : 9; height : 25px; width : 25px; background:#FF5E4D"   name="supp" value="-">
                                                 <input type="hidden"  name="activity" value="' . $nom . '">
                                                  <input type="hidden"  name="idco" value="' . $idco . '">
                                                </form>
                                        </Td>                        
         </TR>';
}

/* Affichage d'un bouton pour valider le panier */

function afficheBoutonValider($basketID, $bdd, $idco) {
    /* on regarde si l'activité est dans son panier ou non */
    $sql3 = 'SELECT count(Belong.Activity_ID) FROM Belong INNER JOIN Activity ON (Activity.Activity_ID = Belong.Activity_ID)'
            . 'WHERE (Basket_ID = :id AND Congress_ID =' . congressID . ' AND Belong_Paid =0 AND Belong_Payement_Way IS NULL)';
    $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["count(Belong.Activity_ID)"];

    if ($cpt != 0) {
        echo'<form name="validPanier" id="contactForm" method="post"  action="recapitulatifPanier.php">
            <div align="right">
                <input type="submit" name="v" value="Valider">
                 <input type="hidden"  name="idco" value="' . $idco . '">
            </div>';
    } else {
        echo'
            <div>
                <br></br>
            </div>';
    }
}

/* ---------------------------------------------------------------------------------------------------- */
/*                           AFFICHAGE RECAPITULATIF DU PANIER                            */
/* ---------------------------------------------------------------------------------------------------- */

function afficheRecap($bdd, $idco) {
    /* Récupération des données personnelles du membre */
    $sql = 'SELECT Member.Member_ID, Person_Lastname, Person_Firstname, Member_Title, Member_Status, District_Name, Club_Name, '
            . ' Member_Num, Member_Additional_Adress, Member_Street, Member_City, Member_Postal_Code, Member_Phone, '
            . ' Member_Mobile, Member_EMail, Member_Position_Club, Member_Position_District, Member_By_Train, Member_Date_Train '
            . ' FROM Member '
            . ' INNER JOIN Connexion ON (Connexion.Member_ID = Member.Member_ID) '
            . ' INNER JOIN Person ON (Person.Person_ID = Member.Person_ID) '
            . ' INNER JOIN Club ON (Club.Club_ID = Member.Club_ID) '
            . ' INNER JOIN District ON (District.District_ID = Member.District_ID) '
            . ' WHERE (Connexion_ID = :id)';

    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$idco"));

    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];
    $nom = $row["Person_Lastname"];
    $prenom = $row["Person_Firstname"];
    $titre = $row["Member_Title"];
    $status = $row["Member_Status"];
    $district = $row["District_Name"];
    $club = $row["Club_Name"];
    $num = $row["Member_Num"];
    $adressesup = $row["Member_Additional_Adress"];
    $rue = $row["Member_Street"];
    $ville = $row["Member_City"];
    $cp = $row["Member_Postal_Code"];
    $tel = $row["Member_Phone"];
    $mobile = $row["Member_Mobile"];
    $mail = $row["Member_EMail"];
    $positionclub = $row["Member_Position_Club"];
    $positiondistrict = $row["Member_Position_District"];
    $train = $row["Member_By_Train"];
    $traindate = $row["Member_Date_Train"];


    /* Récupération du follower */
    $sql = 'SELECT Person_Lastname, Person_Firstname '
            . 'FROM Follower '
            . ' INNER JOIN Person ON (Person.Person_ID = Follower.Person_ID) '
            . ' INNER JOIN Member ON (Member.Member_ID = Follower.Member_ID)'
            . ' WHERE (Member_ID = :id)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $fnom = $row["Person_Lastname"];
    $fprenom = $row["Person_Firstname"];

    /* Affichage des informations personnelles */

    echo'
        <div class="row section-head">
            
            <h2 style="color : #11ABB0;" > <FONT size="5"> Vos informations personnelles <FONT></h2>
            
        </div>
        
        <div>
             <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>Civilité</u> : ' . $titre . '</h2> 
        </div>
        <div>
            <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>Nom</u> : ' . $nom . '</h2> 
        </div>
        <div>
             <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>Prenom</u> : ' . $prenom . '</h2> 
        </div>
        
        <div class="row section-head">
            <h2 style="color : #8BB24C;" > <FONT size="5">Coordonnées <FONT></h2>
         </div>
         
        <div>
            <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" >  <u>Adresse</u> : ' . $num . ' ' . $rue . ' (' . $adressesup . ') ' . $cp . ' ' . $ville . '</h2> 
        </div>
        <div>
            <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" >  <u>Téléphone</u> : ' . $tel . '</h2> 
        </div>
        <div>
            <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>Mobile</u> : ' . $mobile . '</h2> 
        </div>
        <div>
            <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>Mail</u> : ' . $mail . '</h2> 
        </div>
        
        <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Position dans le Lions Clubs <FONT></h2>
         </div>';

    if ($status == 1) {
        echo'<div>
             <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>Satut</u> : Lion </h2> 
        </div>';
    } else {
        echo'<div>
           <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" >  <u>Satut</u> : Leo </h2> 
        </div>';
    }

    echo'   <div>
            <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>District</u> : ' . $district . '</h2> 
        </div>
        <div>
           <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>Position au sein du district</u> : ' . $positiondistrict . '</h2> 
        </div>
        <div>
            <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" >  <u>Club</u> : ' . $club . '</h2> 
        </div>
        <div>
            <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>Position au sein du club</u> : ' . $positionclub . '</h2> 
        </div>
        
';
    if ($train == 1) {
        echo' <div class="row section-head">
            <h2 style="color : #8BB24C;"><FONT size="5"> Arrivée <FONT></h2>
         </div>
   <div>
           <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > Par train le : ' . $traindate . '</h2> 
        </div>';
    } else {
        echo' <div class="row section-head">
            <h2 style="color : #8BB24C;"><FONT size="5"> Arrivée<FONT> </h2>
         </div>
   <div>
             <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" >  Libre</h2> 
        </div>';
    }

    echo' <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Accompagnant<FONT></h2>
         </div>
      <div>
          <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > ' . $fprenom . ' ' . $fnom . '</h2> 
        </div>';

    echo'
        <div class="row section-head">
            <br></br>
            <h2 style="color : #11ABB0;" > <FONT size="5"> Activités réservées <FONT></h2> 
        </div>
        
        <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Repas<FONT></h2>
         </div>';

    /*     * ****************************************** */
    /* Récupération des activités du panier */
    /*     * ********************************************** */

    /* Récupération du basketID et des totaux */
    $sql = 'SELECT Basket_ID, Basket_Total, Basket_Trip_Total, Basket_Meal_Total FROM Basket WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];
    $total = $row["Basket_Total"];
    $totaltrip = $row["Basket_Trip_Total"];
    $totalmeal = $row["Basket_Meal_Total"];

    /*     * ************************************************** */
    /* Récupération des repas du panier et affichage */
    /*     * **************************************************** */

    /* Récupération du nombre de repas réservés */
    $sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Repas" AND Congress_ID = ' . congressID . ')';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Activity.Activity_ID)"];


    if ($cpt != 0) {

        $sql = 'SELECT  Activity_Name, Activity_Date, Belong_Price FROM Activity '
                . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
                . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Repas" AND Congress_ID = ' . congressID . ') ORDER BY (Activity_Date)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));


        echo'
<div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 70%; margin-left : 0">             
         <TR class="row" >
                        <Td class ="col"  width=30% style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B"> Date </FONT></TH>
                        <td class ="col" width=50% style="border:1px solid black; text-align : center;"> <FONT size="4" style="color : #52574B"> Intitulé </FONT></th>
                        <td class ="col" width=140.62 style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Tarif </FONT></th>
        </TR>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $date = $row["Activity_Date"];
            $prix = $row["Belong_Price"];

            echo' <TR class="row" >
           <Td class ="col"  width=30% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $date . '</FONT> </TH>
           <td class ="col" width=50% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $activite . '</FONT> </th>
           <td class ="col" width=140.62 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $prix . ' € </FONT> </th>
         </TR>';
        } echo'</TABLE>
             </div>';
    } else {
        echo'  <div>
           <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > Aucun repas réservé</h2> 
        </div>';
    }



    /*     * ****************************************************** */
    /* Récupération des excursions du panier et affichage */
    /*     * ******************************************************** */

    echo'

        <div class="row section-head">
        <br>
            <h2 style="color : #8BB24C;"> <FONT size="5"> Excursions<FONT></h2>
         </div>';

    /* Récupération du nombre d'excursions réservées */
    $sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Excursion" AND Congress_ID = ' . congressID . ')';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt2 = $row["Count(Activity.Activity_ID)"];


    if ($cpt2 != 0) {
        $sql = 'SELECT  Activity_Name, Activity_Date, Belong_Price FROM Activity '
                . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
                . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Excursion" AND Congress_ID = ' . congressID . ') ORDER BY (Activity_Date)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));


        echo'
<div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 70%; margin-left : 0">             
         <TR class="row" >
                        <Td class ="col"  width=30% style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B"> Date </FONT></TH>
                        <td class ="col" width=50% style="border:1px solid black; text-align : center;"> <FONT size="4" style="color : #52574B"> Intitulé </FONT></th>
                        <td class ="col" width=140.62 style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Tarif </FONT></th>
        </TR>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $date = $row["Activity_Date"];
            $prix = $row["Belong_Price"];

            echo' <TR class="row" >
           <Td class ="col"  width=30% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $date . '</FONT> </TH>
           <td class ="col" width=50% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $activite . '</FONT> </th>
           <td class ="col" width=140.62 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $prix . ' € </FONT> </th>
         </TR>';
        } echo'</TABLE>
             </div>';
    } else {
        echo'  <div>
           <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > Aucune excursion réservée</h2> 
        </div>';
    }

    /*     * *************************** */
    /* Affichage des totaux */
    /*     * *********************** */
    echo'

        <div class="row section-head">
            <br></br>
            <h2 style="color : #11ABB0;" > <FONT size="5"> Totaux <FONT></h2> 
        </div>

<div>
               <TABLE id="tableau" border width=50% cols="2" style="border:1px solid black;width : 40%; margin-left : 0" >

                    <TR class="row" >
                        <Td class ="col"  width=300 height = 35 style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B">  Total des repas </Td>
                        <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $totalmeal . ' € </FONT></Td>
                    </TR>
                    <TR class="row" >
                        <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B">  Total des excursions </Td>
                        <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $totaltrip . ' € </FONT></Td>
                    </TR>
                    <TR class="row" >
                        <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B">  Total </b> </Td>
                        <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color:#BA052C">' . $total . ' € </FONT></Td>
                    </TR>
                    </TABLE>
                        </div>
                        <br>';

    /*     * ******************************************** */
    /* BOUTONS */
    /*     * ********************************************* */

    if (!($cpt = 0 && $cpt2 = 0)) {
        echo'
            
<div>
 <TABLE id="tableau" border width=50% cols="2" style="width : 100%; margin-left : 0" >

     <TR class="row" >
            <Td class ="col"  width=200 height = 35 style=" text-align : left;"><FONT size="4" style="color : #52574B">  
            <form name="validPanier" id="contactForm" method="post"  action="paiement.php">
                 <input type="submit" name="v" value="Valider et payer">
                 <input type="hidden"  name="idco" value="' . $idco . '">
           </form> 
            </Td>      
 
           <Td class ="col"  width=200 height = 35 style=" text-align : left;"><FONT size="4" style="color : #52574B">  
            <form name="imprim" id="contactForm" method="post"  action="recapPDF.php">
                 <input type="submit" name="i" value="Imprimer">
                 <input type="hidden"  name="idco" value="' . $idco . '">
           </form> 
            </Td> 
    </TR>
                    
    </TABLE>
    <br>
 </div>';
    }
}

/* ---------------------------------------------------------------------------------------------------- */
/*                          AJOUT D'ACTIVITE AU PANIER                                         */
/* ---------------------------------------------------------------------------------------------------- */

function addAct($bdd, $idco, $nom) {
    /* On récupère son member_ID */
    $sql1 = 'SELECT Member_ID FROM Connexion WHERE (Connexion_ID = :idco )';
    $stmt = $bdd->prepare($sql1, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('idco' => "$idco"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];

    /* On récupère son basket_ID */
    $sql2 = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql2, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];


    /* On récupère le prix, le type et l'activity_ID de l'activité choisie */

    $date = date("d-m-Y");
    $date1 = "31-03-2016";

    /* Si on est avant le 31 mars, le tarif sera le premier */
    if (strtotime($date) <= strtotime($date1)) {

        $sql3 = 'SELECT Activity_ID, Activity_Price1, Activity_Type_Name FROM Activity '
                . 'INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . 'WHERE (Congress_ID =' . congressID . ' AND Activity_Name = :nom )';
        $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('nom' => "$nom"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $prix = $row["Activity_Price1"];
        $activiteID = $row["Activity_ID"];
        $type = $row["Activity_Type_Name"];
    } else {
        /* Si on est après le 31 mars, le tarif sera le second */
        $sql3 = 'SELECT Activity_ID, Activity_Price2, Activity_Type_Name FROM Activity '
                . 'INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . 'WHERE (Congress_ID =' . congressID . '  AND Activity_Name = :nom )';
        $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('nom' => "$nom"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $prix = $row["Activity_Price2"];
        $activiteID = $row["Activity_ID"];
        $type = $row["Activity_Type_Name"];
    }

    /* On ajoute à la table belong le basket_ID, l'activity_ID et le prix */

    $sql4 = 'INSERT INTO Belong (Activity_ID, Basket_ID, Belong_Price, Belong_Paid) VALUES (:activiteID, :basketID , :prix, 0)';
    $stmt = $bdd->prepare($sql4);
    $stmt->execute(array('activiteID' => "$activiteID", 'basketID' => "$basketID", 'prix' => "$prix"));

    /* On met à jour le panier en calculant les totaux */

    /* On commence par récupérer les totaux qui nous interessent */
    if (strcmp($type, "Repas") == 0) {
        $sql5 = 'SELECT Basket_Meal_Total, Basket_Total FROM Basket '
                . ' WHERE (Basket_ID = :id )';
        $stmt = $bdd->prepare($sql5, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('id' => "$basketID"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $total = $row["Basket_Total"];
        $soustotal = $row["Basket_Meal_Total"];
    } else {
        $sql5 = 'SELECT Basket_Trip_Total, Basket_Total FROM Basket'
                . ' WHERE (Basket_ID = :id )';
        $stmt = $bdd->prepare($sql5, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('id' => "$basketID"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $soustotal = $row["Basket_Trip_Total"];
        $total = $row["Basket_Total"];
    }

    /* On met à jour le panier */
    $total2 = "$total" + "$prix";
    $soustotal2 = "$soustotal" + "$prix";

    if (strcmp($type, "Repas") == 0) {
        $sql6 = 'UPDATE Basket SET Basket_Meal_Total = :soustotal WHERE (Basket_ID = :id)';
        $stmt = $bdd->prepare($sql6);
        $stmt->execute(array('soustotal' => "$soustotal2", 'id' => "$basketID"));
    } else {
        $sql6 = 'UPDATE Basket SET Basket_Trip_Total = :soustotal WHERE (Basket_ID = :id)';
        $stmt = $bdd->prepare($sql6);
        $stmt->execute(array('soustotal' => "$soustotal2", 'id' => "$basketID"));
    }

    $sql6 = 'UPDATE Basket SET Basket_Total = :total WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql6);
    $stmt->execute(array('total' => "$total2", 'id' => "$basketID"));

    /* On décrémente le nombre de places de l'activité */
    $sql7 = 'SELECT Activity_Capacity  FROM Activity  WHERE (Activity_ID = :id)';
    $stmt = $bdd->prepare($sql7, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$activiteID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cap = $row["Activity_Capacity"];


    $sql1 = 'SELECT Count(Follower_ID) FROM Follower WHERE (Member_ID = :id)';
    $stmt = $bdd->prepare($sql1, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Follower_ID)"];


    $sum = "$cap" - "1" - "$cpt"; /* S'il y a un follower, on décrémente une place de plus */
    $sql8 = 'UPDATE Activity SET Activity_Capacity = :sum WHERE (Activity_ID=:id)';
    $stmt = $bdd->prepare($sql8);
    $stmt->execute(array('sum' => "$sum", 'id' => "$activiteID"));

    header("location:" . $_SERVER['HTTP_REFERER']);
}

/* ---------------------------------------------------------------------------------------------------- */
/*                          AFFICHAGE DU PIED DE PAGE                                                  */
/* ---------------------------------------------------------------------------------------------------- */

function afficheFooter() {
    echo' 
    <html>
        <footer>
            <div class="row">
                <div class="col g-7">
                    <ul class="copyright">
                        <li>&copy; 2016 Lions Clubs</li>
                        <li>Design by <a href="http://www.styleshout.com//" title="styleshout"> Styleshout</a></li>               
                    </ul>
                </div>

                <div class="col g-5 pull-right">
                    <ul class="social-links">
                        <li><a href="https://www.facebook.com/LionsClubsdeFrance"><i class="icon-facebook"></i></a></li>
                        <li><a href="https://twitter.com/LionsFRANCE"><i class="icon-twitter"></i></a></li>                   
                        <li><a href="https://www.linkedin.com/company/lions-clubs-de-france"><i class="icon-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </html>';
}

/* ---------------------------------------------------------------------------------------------------- */
/*                          AFFICHAGE DU HEADER                                                */
/* ---------------------------------------------------------------------------------------------------- */

function afficheHeader() {

    /* Le eader est différent selon la page sur laquelle on se trouve */
    /* On récupère donc le nom de la page et on affiche différemment seon ce nom */

    $path = $_SERVER['PHP_SELF'];
    $file = basename($path);

    if (strcmp($file, 'home.php') == 0 || strcmp($file, 'deco.php') == 0) {
        echo' 
    <html>
         <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="home.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li class="active"><a href="home.php">Home</a></li>
                            <li><a href="agenda.php">Agenda</a></li>
                            <li><a href="info.php">Informations pratiques</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li align="right"><a href="inscription.php" style="font-weight:bold; align :right"><FONT size="4pt">Connexion/Inscription</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header>
       
    </html>';
    }

    if (strcmp($file, 'agenda.php') == 0) {
        echo' 
    <html>
         <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="home.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li ><a href="home.php">Home</a></li>
                            <li class="active"><a href="agenda.php">Agenda</a></li>
                            <li><a href="info.php">Informations pratiques</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li align="right"><a href="inscription.php" style="font-weight:bold; align :right"><FONT size="4pt">Connexion/Inscription</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header>
       
    </html>';
    }

    if (strcmp($file, 'contact.php') == 0 || strcmp($file, 'verifContact.php') == 0) {
        echo' 
    <html>
         <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="home.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li ><a href="home.php">Home</a></li>
                            <li ><a href="agenda.php">Agenda</a></li>
                            <li><a href="info.php">Informations pratiques</a></li>
                            <li class="active"><a href="contact.php">Contact</a></li>
                            <li align="right"><a href="inscription.php" style="font-weight:bold; align :right"><FONT size="4pt">Connexion/Inscription</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header>
       
    </html>';
    }

    if (strcmp($file, 'info.php') == 0) {
        echo' 
    <html>
         <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="home.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li ><a href="home.php">Home</a></li>
                            <li ><a href="agenda.php">Agenda</a></li>
                            <li class="active"><a href="info.php">Informations pratiques</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li align="right"><a href="inscription.php" style="font-weight:bold; align :right"><FONT size="4pt">Connexion/Inscription</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header>
       
    </html>';
    }

    if (strcmp($file, 'initMdp.php') == 0 || strcmp($file, 'perteMdpNew.php') == 0 || strcmp($file, 'perteMdp.php') == 0 || strcmp($file, 'verif2bis.php') == 0 || strcmp($file, 'verifConnexion.php') == 0 || strcmp($file, 'verif1.php') == 0 || strcmp($file, 'verif3.php') == 0 || strcmp($file, 'verif2.php') == 0 || strcmp($file, 'inscription.php') == 0 || strcmp($file, 'inscription2.php') == 0 || strcmp($file, 'inscription3.php') == 0) {
        echo' 
    <html>
         <header class="mobile">
            <div class="row">
                <div class="col full">
                    <div class="logo">
                        <a href="home.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>
                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li ><a href="home.php">Home</a></li>
                            <li ><a href="agenda.php">Agenda</a></li>
                            <li><a href="info.php">Informations pratiques</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li class="active" align="right"><a href="inscription.php" style="font-weight:bold; align :right"><FONT size="4pt">Connexion/Inscription</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header>
       
    </html>';
    }
}

/* ---------------------------------------------------------------------------------------------------- */
/*                          REINITIALISATION DU MOT DE PASSE                                              */
/* ---------------------------------------------------------------------------------------------------- */

function initMDP($email, $mdp, $mdp2, $bdd) {
    /* On teste si l'email est dans la base */
    $sql = 'SELECT Count(Member_ID) FROM Member WHERE (Member_EMail = :mail)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('mail' => "$email"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Member_ID)"];

    if ($cpt = 0 or empty($mdp) or $mdp != $mdp2 or ! preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {

        header("Location: http://localhost/lion/lion/php/perteMdpNew.php");
    } else {
        /* On récupère l'ID du membre pour mettre à jour en toute sécurité */
        $sql = 'SELECT Member_ID FROM Member WHERE (Member_EMail = :mail)';
        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('mail' => "$email"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $id = $row["Member_ID"];

        /* Réinitialisation du mot de passe */
        $sql = 'UPDATE Member SET Member_Password = :mdp WHERE (Member_ID= ' . $id . ')';
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array('mdp' => "$mdp"));


        /* Redirection vers la page d'inscription */
        header("Location: http://localhost/lion/lion/php/inscription.php");
    }
}

/* ---------------------------------------------------------------------------------------------------- */
/*                          AFFICHAGE DU RECAPITULATIF PDF DU PANIER                           */
/* ---------------------------------------------------------------------------------------------------- */

function afficheRecapPDF($bdd, $idco) {
    /* Récupération des données personnelles du membre */
    $sql = 'SELECT Member.Member_ID, Person_Lastname, Person_Firstname, Member_Title, Member_Status, District_Name, Club_Name, '
            . ' Member_Num, Member_Additional_Adress, Member_Street, Member_City, Member_Postal_Code, Member_Phone, '
            . ' Member_Mobile, Member_EMail, Member_Position_Club, Member_Position_District, Member_By_Train, Member_Date_Train '
            . ' FROM Member '
            . ' INNER JOIN Connexion ON (Connexion.Member_ID = Member.Member_ID) '
            . ' INNER JOIN Person ON (Person.Person_ID = Member.Person_ID) '
            . ' INNER JOIN Club ON (Club.Club_ID = Member.Club_ID) '
            . ' INNER JOIN District ON (District.District_ID = Member.District_ID) '
            . ' WHERE (Connexion_ID = :id)';

    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$idco"));

    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];
    $nom = $row["Person_Lastname"];
    $prenom = $row["Person_Firstname"];
    $titre = $row["Member_Title"];
    $status = $row["Member_Status"];
    if ($status == 0) {
        $status = "Leo";
    } else {
        $status = "Lion";
    }
    $district = $row["District_Name"];
    $club = $row["Club_Name"];
    $num = $row["Member_Num"];
    $adressesup = $row["Member_Additional_Adress"];
    $rue = $row["Member_Street"];
    $ville = $row["Member_City"];
    $cp = $row["Member_Postal_Code"];
    $tel = $row["Member_Phone"];
    $mobile = $row["Member_Mobile"];
    $mail = $row["Member_EMail"];
    $positionclub = $row["Member_Position_Club"];
    $positiondistrict = $row["Member_Position_District"];

    $train = $row["Member_By_Train"];
    $traindate = $row["Member_Date_Train"];

    if ($train == 1) {
        $resulttrain = "Arrivée en train le : $traindate";
    } else {
        $resulttrain = "Arrivée libre";
    }


    /* Récupération du follower */
    $sql = 'SELECT Person_Lastname, Person_Firstname '
            . 'FROM Follower '
            . ' INNER JOIN Person ON (Person.Person_ID = Follower.Person_ID) '
            . ' INNER JOIN Member ON (Member.Member_ID = Follower.Member_ID)'
            . ' WHERE (Member_ID = :id)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $fnom = $row["Person_Lastname"];
    $fprenom = $row["Person_Firstname"];

    $accompagnant = "";

    if (!(empty($fnom) && empty($fprenom))) {
        $accompagnant = $fprenom . " " . $fnom;
    } else {
        $accompagnant = "Aucun";
    }

    $dateauj = date("d-m-Y");

    /*     * ****************************************** */
    /* Récupération des activités du panier */
    /*     * ********************************************** */

    /* Récupération du basketID et des totaux */
    $sql = 'SELECT Basket_ID, Basket_Total, Basket_Trip_Total, Basket_Meal_Total FROM Basket WHERE (Member_ID = :id)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];
    $total = $row["Basket_Total"];
    $totaltrip = $row["Basket_Trip_Total"];
    $totalmeal = $row["Basket_Meal_Total"];

    /* Récupération du nombre de repas réservés */
    $sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Repas" AND Congress_ID = ' . congressID . ')';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Activity.Activity_ID)"];
    $repas = '';

    if ($cpt != 0) {

        $sql = 'SELECT  Activity_Name, Activity_Date, Belong_Price FROM Activity '
                . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
                . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Repas" AND Congress_ID = ' . congressID . ') ORDER BY (Activity_Date)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));

        $repas = $repas . ' 
<div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 100%; margin-left : 0;border-collapse: collapse;">             
         <TR class="row" >
                        <Td class ="col" width=100 style="border:1px solid black; background-color : #C9D2D7;text-align : center;"><FONT size="5" > <b> Date </b></FONT></Td>
                        <td class ="col" width=320 style="border:1px solid black; background-color : #C9D2D7; text-align : center;"> <FONT size="5" > <b> Intitulé </b></FONT></td>
                        <td class ="col" width=140 style="border:1px solid black ; background-color : #C9D2D7; text-align : center;"><FONT size="5" > <b> Tarif </b> </FONT></td>
        </TR> ';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $date = $row["Activity_Date"];
            $prix = $row["Belong_Price"];

            $repas = $repas . '<TR class="row" >
           <Td class ="col"  width=100 style="border:1px solid black; text-align : center;"> <FONT size="3.5" style="color : #252E43">' . $date . '</FONT> </Td>
           <td class ="col" width=320 style="border:1px solid black; text-align : center;"> <FONT size="3.5" style="color : #252E43">' . $activite . '</FONT> </td>
           <td class ="col" width=140 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43">' . $prix . ' €</FONT> </td>
         </TR> ';
        } $repas = $repas . ' </TABLE>
             </div>';
    } else {
        $repas = $repas . ' 
           <div style="" > <FONT size="3.5" style="font-weight:normal;color : #707B82;" > Aucun repas réservé</FONT></div> 
        ';
    }

    /*     * ****************************************************** */
    /* Récupération des excursions du panier et affichage */
    /*     * ******************************************************** */
    $excursion = ' ';


    /* Récupération du nombre d'excursions réservées */

    $sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Excursion" AND Congress_ID = ' . congressID . ')';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt2 = $row["Count(Activity.Activity_ID)"];


    if ($cpt2 != 0) {
        $sql = 'SELECT  Activity_Name, Activity_Date, Belong_Price FROM Activity '
                . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
                . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Excursion" AND Congress_ID = ' . congressID . ') ORDER BY (Activity_Date)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));

        $excursion = $excursion . ' 
<div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 100%; margin-left : 0;border-collapse: collapse;">             
         <TR class="row" >
                        <Td class ="col" width=100 style="border:1px solid black; background-color : #C9D2D7;text-align : center;"><FONT size="5" > <b> Date </b></FONT></Td>
                        <td class ="col" width=320 style="border:1px solid black; background-color : #C9D2D7; text-align : center;"> <FONT size="5" > <b> Intitulé </b></FONT></td>
                        <td class ="col" width=140 style="border:1px solid black ; background-color : #C9D2D7; text-align : center;"><FONT size="5" > <b> Tarif </b> </FONT></td>
        </TR> ';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $date = $row["Activity_Date"];
            $prix = $row["Belong_Price"];

            $excursion = $excursion . '  <TR class="row" >
           <Td class ="col"  width=100 style="border:1px solid black; text-align : center;"> <FONT size="3.5" style="color : #252E43">' . $date . '</FONT> </Td>
           <td class ="col" width=320 style="border:1px solid black; text-align : center;"> <FONT size="3.5" style="color : #252E43">' . $activite . '</FONT> </td>
           <td class ="col" width=140 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43">' . $prix . ' €</FONT> </td>
         </TR> ';
        }$excursion = $excursion . ' </TABLE>
             </div>';
    } else {
        $excursion = $excursion . '  
           <div style="" > <FONT size="3.5" style="font-weight:normal;color : #707B82" > Aucune excursion réservée</FONT></div> ';
    }
    ob_start();
    ?>
    <page backtop="15mm" backbottom="15mm" backleft="10mm" backright="10mm">
        <div class="logo">
            <a href="" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
        </div>
        <div class="col full">
            <br>
            <h2 style="margin : 65px ; color : #252E43; text-align : center"> <FONT size="6"> Récapitulatif - Réservation d'activités - <?php echo"$dateauj" ?> </FONT></h2>

        </div>

        <div class="row section-head">      
            <h2 style="color : #11ABB0;" > <FONT size="5">INFORMATIONS PERSONNELLES </FONT></h2>
        </div>

        <div>
            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Civilité</u> : <?php echo"$titre"; ?></FONT> </div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Nom</u> :  <?php echo"$nom"; ?> </FONT></div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Prenom</u> : <?php echo"$prenom"; ?></FONT></div> 

        </div>

        <div class="row section-head">
            <h2 style="color : #8BB24C;" > <FONT size="5">Coordonnées </FONT></h2>
        </div>

        <div>
            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" >  <u>Adresse</u> : <?php echo"$num $rue ($adressesup) $cp $ville"; ?></FONT> </div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" >  <u>Téléphone</u> : <?php echo"$tel"; ?></FONT> </div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Mobile</u> : <?php echo"$mobile"; ?> </FONT></div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Mail</u> : <?php echo"$mail"; ?></FONT></div> 
        </div>

        <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Position dans le Lions Clubs </FONT></h2>
        </div>


        <div>
            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Satut</u> :<?php echo"$status"; ?></FONT></div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>District</u> : <?php echo"$district"; ?></FONT></div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Position au sein du district</u> : <?php echo"$positiondistrict"; ?></FONT></div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" >  <u>Club</u> : <?php echo"$club"; ?></FONT></div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Position au sein du club</u> : <?php echo"$positionclub"; ?></FONT></div> 
        </div>

        <div class="row section-head">
            <h2 style="color : #8BB24C;"><FONT size="5"> Arrivée </FONT></h2>
        </div>

        <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <?php echo"$resulttrain"; ?></FONT></div> 



        <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Accompagnant</FONT></h2>
        </div>
        <div>
            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <?php echo"$accompagnant"; ?></FONT></div> 
        </div>
        <page_footer backtop="5mm" backbottom="10mm" backleft="10mm" backright="10mm">
            <div  style="text-align:center"> <FONT size="3.5" style="font-weight:normal;color : #252E43; text-align:center" ><i>Page 1/2</i> </FONT></div>
        </page_footer>
    </page>
    <page backtop="15mm" backbottom="15mm" backleft="10mm" backright="10mm">
        <div class="row section-head">
            <br>
            <h2 style="color : #11ABB0;" > <FONT size="5">ACTIVITES RESERVEES</FONT></h2> 

        </div>

        <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Repas</FONT></h2>
        </div>
        <?php echo"$repas" ?>
        <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Excursions</FONT></h2>
        </div>
        <?php echo"$excursion" ?>


        <div class="row section-head">
            <br>
            <h2 style="color : #11ABB0;" > <FONT size="5">TOTAUX</FONT></h2> 
        </div>

        <div>
            <TABLE id="tableau" border width=50% cols="2" style="border:1px solid black;width : 40%; margin-left : 0; border-collapse: collapse;" >

                <TR class="row" >
                    <Td class ="col"  width=300 height = 35 style="border:1px solid black;text-align : center;background-color : #C9D2D7;"><FONT size="4" >  <b> Total des repas </b></FONT> </Td>
                    <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43"><?php echo"$totalmeal"; ?> € </FONT></Td>
                </TR>
                <TR class="row" >
                    <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;background-color : #C9D2D7;"><FONT size="4" > <b> Total des excursions </b></FONT></Td>
                    <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43"><?php echo"$totaltrip"; ?> € </FONT></Td>
                </TR>
                <TR class="row" >
                    <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;background-color : #C9D2D7;"><FONT size="4" > <b> Total </b> </FONT></Td>
                    <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color:#BA052C"><?php echo"$total" ?> € </FONT></Td>
                </TR>
            </TABLE>
        </div>
        <page_footer backtop="5mm" backbottom="10mm" backleft="10mm" backright="10mm">
            <div  style="text-align:center"> <FONT size="3.5" style="font-weight:normal;color : #252E43; text-align:center" ><i>Page 2/2</i> </FONT></div>
        </page_footer>
    </page>


    <?php
    $content = ob_get_clean();
    require('html2pdf/html2pdf.class.php');

    try {
        $pdf = new HTML2PDF('P', 'A4', 'fr');
        $pdf->writeHTML($content);
        $pdf->Output('recapitulatif.pdf');
    } catch (HTML2PDF_exception $ex) {
        die($ex);
    }
}

/* ---------------------------------------------------------------------------------------------------- */
/*                          SUPPRESSION D'ACTIVITE DU PANIER                       */
/* ---------------------------------------------------------------------------------------------------- */

function suppAct($bdd, $idco, $nom) {
    /* On récupère son member_ID */
    $sql1 = 'SELECT Member_ID FROM Connexion WHERE (Connexion_ID = :idco )';
    $stmt = $bdd->prepare($sql1, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('idco' => "$idco"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];

    /* On récupère son basket_ID */
    $sql2 = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql2, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];

    /* On récupère les données relatives à l'activité */
    $sql3 = 'SELECT Activity_ID, Activity_Type_Name FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity.Activity_Type_ID = Activity_Type.Activity_Type_ID) '
            . ' WHERE (Activity_Name = :nom AND Congress_ID = ' . congressID . ' )';
    $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('nom' => "$nom"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $activiteID = $row["Activity_ID"];
    $type = $row["Activity_Type_Name"];

    /* On récupère le prix qui est dans le panier */
    $sql3 = 'SELECT Belong_Price FROM Belong WHERE (Activity_ID = :aid AND Basket_ID = :bid)';
    $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('aid' => "$activiteID", 'bid' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $prix = $row["Belong_Price"];


    /* On supprime de la table belong le basket_ID, l'activity_ID et le prix */

    $sql4 = 'DELETE FROM Belong WHERE (Activity_ID = :aid AND Basket_ID = :bid)';
    $stmt = $bdd->prepare($sql4);
    $stmt->execute(array('aid' => "$activiteID", 'bid' => "$basketID"));

    /* On met à jour le panier en calculant les totaux */

    /* On commence par récupérer les totaux qui nous interessent */
    if (strcmp($type, "Repas") == 0) {
        $sql5 = 'SELECT Basket_Meal_Total, Basket_Total FROM Basket '
                . ' WHERE (Basket_ID = :id )';
        $stmt = $bdd->prepare($sql5, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('id' => "$basketID"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $total = $row["Basket_Total"];
        $soustotal = $row["Basket_Meal_Total"];
    } else {
        $sql5 = 'SELECT Basket_Trip_Total, Basket_Total FROM Basket'
                . ' WHERE ( Basket_ID = :id )';
        $stmt = $bdd->prepare($sql5, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('id' => "$basketID"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $soustotal = $row["Basket_Trip_Total"];
        $total = $row["Basket_Total"];
    }

    /* On met à jour le panier */
    $total2 = "$total" - "$prix";
    $soustotal2 = "$soustotal" - "$prix";

    if (strcmp($type, "Repas") == 0) {
        $sql6 = 'UPDATE Basket SET Basket_Meal_Total = :soustotal WHERE ( Basket_ID = :id)';
        $stmt = $bdd->prepare($sql6);
        $stmt->execute(array('soustotal' => "$soustotal2", 'id' => "$basketID"));
    } else {
        $sql6 = 'UPDATE Basket SET Basket_Trip_Total = :soustotal WHERE ( Basket_ID = :id)';
        $stmt = $bdd->prepare($sql6);
        $stmt->execute(array('soustotal' => "$soustotal2", 'id' => "$basketID"));
    }

    $sql6 = 'UPDATE Basket SET Basket_Total = :total WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql6);
    $stmt->execute(array('total' => "$total2", 'id' => "$basketID"));

    /* On incrémente le nombre de places de l'activité */
    $sql7 = 'SELECT Activity_Capacity  FROM Activity  WHERE (Activity_ID = :id)';
    $stmt = $bdd->prepare($sql7, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$activiteID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cap = $row["Activity_Capacity"];

    $sql1 = 'SELECT Count(Follower_ID) FROM Follower WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql1, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $c = $row["Count(Follower_ID)"];

    $sum = "$cap" + "1" + "$c"; /* si il y a un follower, on incrémente de 2 */
    $sql8 = 'UPDATE Activity SET Activity_Capacity = :sum WHERE (Activity_ID=:id)';
    $stmt = $bdd->prepare($sql8);
    $stmt->execute(array('sum' => "$sum", 'id' => "$activiteID"));

    header("location:" . $_SERVER['HTTP_REFERER']);
}

/* ---------------------------------------------------------------------------------------------------- */
/*                          VERIFICATION CONNEXION                                                    */
/* ---------------------------------------------------------------------------------------------------- */

function testConnexion($bdd, $mail, $mdp) {
    try {

        $stmt = $bdd->prepare("SELECT Member_ID FROM Member WHERE (Member_EMail='$mail' AND Member_Password ='$mdp');", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array());
        $res = $stmt->fetchAll();

        /* Si il n'y a pas de résultat, message d'erreur */
        if (count($res) == 0) {
            /* On réaffiche la page avec un message d'erreur */

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
            afficheHeader();

            echo'<!-- Header End -->




        <!-- Inscription Section
          ================================================== -->

        <div class="row">

            <div class="col g-7" style="top: 80px">

                <div class="row section-head">
                    <div class="col full" >
                        <h2 style="color : #11ABB0;"> S\'inscrire</h2> 
                    </div>
                </div>

                <!-- form -->
                <form name="contactForm" id="contactForm" method="post"  action="verif1.php">
                    <fieldset >

                        <div>
                            <label for="contactEmail">Adresse email <span class="required">*</span></label>
                            <input name="email" type="mail" id="mail" size="35" value="" style = "padding: 18px 18px; margin : 0 0 24px 0; color : #738182; background : #CFD4D5; border : 0" />

                        </div>

                        <div>
                            <label for="contactSubject">Mot de passe<span class="required">*</span></label>
                            <input name="mdp" type="password" id="mdp" size="35" value="" />
                        </div>

                        <div>
                            <label for="contactSubject">Confirmation du mot de passe<span class="required">*</span></label>
                            <input name="cmdp" type="password" id="cmdp" size="35" value="" />
                        </div>



                        <div>
                            <input type="submit" name="v1" value="Valider">
                        </div>

                    </fieldset>
                </form> 

                <!-- Form End -->



            </div>


            <aside class="col g-5" style="top: 80px">

                <div class="row section-head">
                    <div class="col full" >
                        <h2 style="color : #11ABB0;"> Se connecter</h2> 
                    </div>
                </div>
                 <h7 style="color : #FF0000;"> ERREUR ! MAIL OU MOT DE PASSE INCORRECT</h7>

                <!-- form -->
                <form name="contactForm" id="contactForm" method="post" action="verifConnexion.php" >
                    <fieldset >

                        <div>
                            <label for="mail">Adresse e-mail <span class="required">*</span></label>
                            <input name="mail" type="mail" id="mail" size="35" value="" style = "padding: 18px 18px; margin : 0 0 24px 0; color : #738182; background : #CFD4D5; border : 0" />
                        </div>

                        <div>
                            <label for="mdp">Mot de passe<span class="required">*</span></label>
                            <input name="mdp" type="password" id="mdp" size="35" value="" />
                        </div>


                        <div>
                            <button name="v1" id="v1" class="submit">Valider</button>

                        </div>

                    </fieldset>
                </form> 

                <!-- Form End -->

                <!-- contact-warning -->
                <div id="message-warning"></div>
                <!-- contact-success -->
                <div id="message-success">
                    <i class="icon-ok" ></i><br />
                </div>

            </aside>

        </div>

    </section> <!-- Contact Section End-->

    <!-- footer
    ================================================== -->
    <br>';
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
        } else {/* Si il y a un résultat, connexion + mise à jour de la date de dernière connexion */
            foreach ($res as $ligne) {

                $memberID = $ligne["Member_ID"];

                /* On regarde si sa connexion est encore active */

                $sql = 'SELECT Count(Connexion_ID) FROM Connexion WHERE (Member_ID = :id) ';
                $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
                $stmt->execute(array(':id' => "$memberID"));
                $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
                $cpt = $row['Count(Connexion_ID)'];
                // S'il n'y a pas de connexion, on en crée une
                if ($cpt == 0) {

                    //Création de l'id de connexion  
                    $chaine = "";
                    $c = "abcdefghijklmnpqrstuvwxy";
                    srand((double) microtime() * 1000000);
                    for ($i = 0; $i < 70; $i++) {
                        $chaine .= $c[rand() % strlen($c)];
                    }
                    //Récupération de la date actuelle
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


                    $idco = $chaine . $day . $mois . $annee . $heure . $min . $sec;

                    $req9 = $bdd->prepare('INSERT INTO Connexion (Connexion_ID, Last_Connexion, Member_ID ) VALUE (:chaine,NOW(), :id)');
                    $req9->execute(array(
                        'chaine' => "$idco",
                        'id' => "$memberID"));
                } else {
                    // Si une connexion est déjà active, on l'update
                    $sql = 'SELECT Connexion_ID FROM Connexion WHERE (Member_ID = :id) ';
                    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
                    $stmt->execute(array(':id' => "$memberID"));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
                    $idco = $row['Connexion_ID'];

                    $req9 = $bdd->prepare("UPDATE Connexion SET Last_Connexion= NOW() WHERE (Connexion_ID =:idco)");
                    $req9->execute(array(
                        'idco' => "$idco"));
                }
            }

            /* On affiche un message pour dire que la connexion est OK */

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

                        <ul id="nav" class="nav" style = "margin-left :76px">';
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
            <span><h2 style = "color :#70F861; margin : 65px; text-align : center"> Connexion réussie <br></br>
           <center><FONT size="3.5pt " style = "color :#F0FFFF ;font-weight:normal">Vous pouvez désormais vous inscrire à des activités dans l\'onglet "Agenda" </center></FONT></h2><span>
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
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
}

/* ---------------------------------------------------------------------------------------------------- */
/*                        SELECTION DES CLUBS D'UN DISTRICT                                                  */
/* ---------------------------------------------------------------------------------------------------- */

function afficheClub($bdd, $district) {
    try {

        /* Préparation de la requête */
        $sql = 'SELECT Club_Name FROM Club ' .
                'INNER JOIN District ON (District.District_ID = Club.District_ID) ' .
                'WHERE (District_Name = :district) ORDER BY (Club_Name);';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));

        /* Exécution de la requête */
        $stmt->execute(array(':district' => "$district"));

        /* Exploitation des résultats */
        print("<div>");
        print("<SELECT id=\"club\" name=\"club\">");
        /* Affichage des activités */
        echo '<OPTION value ="Choisissez votre club">Choisissez votre club</OPTION>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $nom = $row["Club_Name"];
            echo '<OPTION value ="' . $nom . '">' . $nom . '</OPTION>';
        }

        print("</SELECT>");
        print("</div>");
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
}

/* ----------------------------------------------------------------------------------------------- */
/*                                 GESTION DES CONNEXIONS                                        */
/* ----------------------------------------------------------------------------------------------- */

function gereConnexion($bdd) {
    /* On récupère la date courante */
    $sql = 'SELECT NOW()';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array());
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $now = $row['NOW()'];

    $date1 = new DateTime($now);


    /* On récupère toutes les connexions */
    $sql = 'SELECT Connexion_ID, Last_Connexion FROM Connexion ';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array());

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

        $idco = $row['Connexion_ID'];
        $date = $row['Last_Connexion'];

        $date2 = new DateTime($date);

        $dteDiff = $date1->diff($date2);
        $diff = $dteDiff->format("%H:%I:%S");

        if ($diff > "00:30:00") {
            //On supprime la connexion
            deconnexion($idco, $bdd);
        }
    }
}

gereConnexion($bdd);

/* ----------------------------------------------------------------------------------------------- */
/*                                MISE A JOUR DE LAST CONNEXION                                     */
/* ----------------------------------------------------------------------------------------------- */

function majConnexion($bdd, $idco) {
    $req9 = $bdd->prepare("UPDATE Connexion SET Last_Connexion= NOW() WHERE (Connexion_ID =:idco)");
    $req9->execute(array(
        'idco' => "$idco"));
}

/* ----------------------------------------------------------------------------------------------- */
/*                                BON DE COMMANDE PDF                                    */
/* ----------------------------------------------------------------------------------------------- */

function bonDeCommande($bdd, $idco) {
    /* On récupère le nom, le prénom et les coordonnées du client */

    $sql = 'SELECT Member.Member_ID, Person_Lastname, Person_Firstname, Member_Title, '
            . ' Member_Num, Member_Additional_Adress, Member_Street, Member_City, Member_Postal_Code, Member_Phone, '
            . ' Member_Mobile, Member_EMail '
            . ' FROM Member '
            . ' INNER JOIN Connexion ON (Connexion.Member_ID = Member.Member_ID) '
            . ' INNER JOIN Person ON (Person.Person_ID = Member.Person_ID) '
            . ' WHERE (Connexion_ID = :id)';

    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$idco"));

    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];
    $nom = $row["Person_Lastname"];
    $prenom = $row["Person_Firstname"];
    $titre = $row["Member_Title"];
    $num = $row["Member_Num"];
    $adressesup = $row["Member_Additional_Adress"];
    $rue = $row["Member_Street"];
    $ville = $row["Member_City"];
    $cp = $row["Member_Postal_Code"];
    $tel = $row["Member_Phone"];
    $mobile = $row["Member_Mobile"];
    $mail = $row["Member_EMail"];


    /* On récupère les activités commandées */


    /* Récupération du basketID et des totaux */
    $sql = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];


    /* Récupération des activités */

    /* On récupère la date du dernier panier */
    $sql = 'SELECT Belong_Date FROM Activity '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id  AND Belong_Payement_Way="CH" AND Congress_ID = ' . congressID . ') ORDER BY (Belong_Date)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $belongdate = $row["Belong_Date"];

    /* On récupère toutes les activités */
    $sql = 'SELECT  Activity.Activity_ID, Activity_Name, Activity_Date, Belong_Price FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id  AND Belong_Payement_Way ="CH" AND Congress_ID = ' . congressID . ' AND Belong_Date = :date ) ORDER BY ( Activity_Date)';

    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID", ':date' => "$belongdate"));

    $numCommande = "";

    $activite = ' 
<div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 100%; margin-left : 0;border-collapse: collapse;">             
         <TR class="row" >
                        <Td class ="col" width=100 style="border:1px solid black; background-color : #C9D2D7;text-align : center;"><FONT size="5" > <b> Date </b></FONT></Td>
                        <td class ="col" width=320 style="border:1px solid black; background-color : #C9D2D7; text-align : center;"> <FONT size="5" > <b> Intitulé </b></FONT></td>
                        <td class ="col" width=140 style="border:1px solid black ; background-color : #C9D2D7; text-align : center;"><FONT size="5" > <b> Tarif </b> </FONT></td>
        </TR> ';
    $total = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

        $numCommande = $numCommande . ".". $row["Activity_ID"] ;
        $nom = $row["Activity_Name"];
        $date = $row["Activity_Date"];
        $prix = $row["Belong_Price"];
        $total = $total + $prix;


        $activite = $activite . '<TR class="row" >
           <Td class ="col"  width=100 style="border:1px solid black; text-align : center;"> <FONT size="3.5" style="color : #252E43">' . $date . '</FONT> </Td>
           <td class ="col" width=320 style="border:1px solid black; text-align : center;"> <FONT size="3.5" style="color : #252E43">' . $nom . '</FONT> </td>
           <td class ="col" width=140 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43">' . $prix . ' €</FONT> </td>
         </TR> ';
    } 
    
 $activite = $activite . ' </TABLE>
             </div>';

    $dateauj = date("d-m-Y");
    $numCommande = $memberID."-".$numCommande  ;
    ob_start();
    ?>

    <page backtop="15mm" backbottom="15mm" backleft="10mm" backright="10mm">
        <div class="logo">
            <a href="" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
        </div>
        <div class="col full">
            <h2 style="margin : 65px ; color : #252E43; text-align : center"> <FONT size="6"> Bon de commande n° <?php echo"$numCommande"; ?> - <?php echo"$dateauj" ?> </FONT></h2>

        </div>

        <div class="row section-head">      
            <h2 style="color : #11ABB0;" > <FONT size="5">INFORMATIONS PERSONNELLES </FONT></h2>
        </div>

        <div>
            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Civilité</u> : <?php echo"$titre"; ?></FONT> </div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Nom</u> :  <?php echo"$nom"; ?> </FONT></div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Prenom</u> : <?php echo"$prenom"; ?></FONT></div> 

        </div>


        <div>
            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" >  <u>Adresse</u> : <?php echo"$num $rue ($adressesup) $cp $ville"; ?></FONT> </div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" >  <u>Téléphone</u> : <?php echo"$tel"; ?></FONT> </div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Mobile</u> : <?php echo"$mobile"; ?> </FONT></div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Mail</u> : <?php echo"$mail"; ?></FONT></div> 
        </div>

        <div class="row section-head">
            <h2 style="color : #11ABB0;" > <FONT size="5">ACTIVITES RESERVEES</FONT></h2> 
        </div>

    <?php echo"$activite"; ?>

        <div class="row section-head">
            <h2 style="color : #11ABB0;" > <FONT size="5">TOTAL</FONT></h2> 
        </div>

        <div>
            <TABLE id="tableau" border width=50% cols="2" style="border:1px solid black;width : 40%; margin-left : 0; border-collapse: collapse;" >
                <TR class="row" >
                    <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;background-color : #C9D2D7;"><FONT size="4" > <b> Total </b> </FONT></Td>
                    <Td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color:#BA052C"><?php echo"$total" ?> € </FONT></Td>
                </TR>
            </TABLE>
        </div>
        
        <page_footer backtop="5mm" backbottom="10mm" backleft="10mm" backright="10mm">
            <div  style="text-align:center"> <FONT size="3.5" style="font-weight:normal;color : #252E43; text-align:center" ><i>Page 1/1</i> </FONT></div>
        </page_footer>
    </page>


    <?php
    $content = ob_get_clean();
    require('html2pdf/html2pdf.class.php');

    try {
        $pdf = new HTML2PDF('P', 'A4', 'fr');
        $pdf->writeHTML($content);
        $pdf->Output('recapitulatif.pdf');
    } catch (HTML2PDF_exception $ex) {
        die($ex);
    }
}
