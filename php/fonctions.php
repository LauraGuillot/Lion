<?php
include "requetes.php";

/* ---------------------------------------------------------------------------------------------------- 
 *                            PAIEMENT PAR CB             
 * Paramètres : $bdd - Base de données / $valid - Booléen indiquant si la transaction est validée ou non / $idco - identifiant de connexion du membre
 * Description : 
 * Si valid est vrai, on effectue les requête suivantes : 
 * - On ajoute le mode de paiement CB aux activités réglées
 * - On met à 1 le booléen de paiement
 * - On remet à zéro tous les totaux du panier
 * Si valid est faux ,on affiche un message d'erreur.                                           
 * ---------------------------------------------------------------------------------------------------- */

function paiementCB($bdd, $valid, $idco) {
    if ($valid) {

        $memberID = getMemberID($bdd, $idco);
        $basketID = getBasketID($bdd, $memberID);
        setActivityCB($bdd, $basketID);


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

/* ---------------------------------------------------------------------------------------------------- 
 *                            PAIEMENT PAR CH    
 * Paramètres : $bdd - Base de données / $idco - identifiant de connexion du membre
 * Description : 
 * Pour une commande par chèque, on effectue les requêtes suivantes :
 * - On ajoute le mode de paiement CH à toutes les activités commandées
 * - On ajoute la date actuelle à ces activités
 * - On remet à zéro tous les totaux du panier                                                
 * ---------------------------------------------------------------------------------------------------- */

function paiementCH($bdd, $idco) {

    /* Ajouter le mode de paiement aux activités réservées */
    /* On récupère son member_ID */
    $memberID = getMemberID($bdd, $idco);

    /* On récupère son basket_ID */
    $basketID = getBasketID($bdd, $memberID);

    /* Enregistrement de la commande */
    setActivityCH($bdd, $basketID);

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
             
            <center><FONT size="3.5pt " style = "color :#F0FFFF ;font-weight:normal"> Merci d\'imprimer votre bon de commande ci-dessous et de l\'envoyer avec un chèque <br> à l\'ordre du Lions Clubs, du montant indiqué sur le bon de commande à l\'adresse : <br>38, rue Albert Dory - 44300 NANTES - FRANCE </center></FONT></h2>
            
        
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

/* ---------------------------------------------------------------------------------------------------- 
 *                           DECONNEXION  
 * Paramètres : $bdd - Base de données / $idco - identifiant de connexion du membre
 * Description :
 * A la déconnexion d'un membre, on commence par vider son panier. Ce qui implique de remettre tous les totaux à 0 et incrémenter
 * les capacités des activités qu'il avait ajoutées à son panier de 1 ou 2 si il a ou non un follower.
 * Dans un second temps, on supprime sa connexion de la table Connexion.                                                      
 * ---------------------------------------------------------------------------------------------------- */

function deconnexion($idco, $bdd) {

    /* Récupération du membre id */
    $memberID = getMemberID($bdd, $idco);

    /* Récupération du basket id */
    $basketID = getBasketID($bdd, $memberID);

    /* Incrémentation des capacités de toutes les activités supprimées */
    setCapacity($bdd, $memberID, $basketID);


    /* Suppression des activités non payées */
    videBasket($bdd, $basketID);

    /* Suppression de la connexion */
    suppConnexion($bdd, $idco);

    /* Redirection vers la page d'accueil */
    header("Location: http://Localhost/lion/Lion/php/home.php");
}

/* ---------------------------------------------------------------------------------------------------- */
/*                           AFFICHAGE AGENDA EN MODE NON CONNECTE                                                      */
/* ---------------------------------------------------------------------------------------------------- */

/* Fontion pour afficher le tableau des repas 
 * Paramètre : $bdd - Base de données
 * Description :
 * L'objectif ici est d'afficher tous les repas du congrès qui nous interesse. On sélectionne pour cela tous les repas de la base de données.
 * Puis, on affiche différemment les repas qui sont complets et ceux qui possèdent encore des places libres dans un tableau.
 * */

function afficheRepas1($bdd) {
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
                    <CAPTION> <h2><FONT style="color :#CAD1D5">Repas</FONT><br></br></h2> </CAPTION>

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

/* Fontion pour afficher le tableau des excursions 
 * Paramètre : $bdd - Base de données
 * Description :
 * L'objectif ici est d'afficher toutes les excursions du congrès qui nous interesse. On sélectionne pour cela toutes les excursions de la base de données.
 * Puis, on affiche différemment les excursions qui sont completes et celles qui possèdent encore des places libres dans un tableau.
 * */

function afficheExcursions1($bdd) {
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
                    <CAPTION> <h2><FONT style="color :#CAD1D5">Excursions</FONT><br></br></h2> </CAPTION>

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

/* Fontion pour afficher d'une activité libre 
 * Paramètre : $bdd - Base de données / $nom - Nom de l'activité / $date - Date de l'activité / $prix1 - Tarif privilège / $prix2 - Tarif plein / $capacity - Nombre de places encore libres
 * Description :
 * Pour chaque activité libre, on affiche une ligne de tableau avec son intitulé, sa date , ses tarifs (privilège et plein) et sa capacité.
 */

function afficheActiviteLibre($nom, $date, $prix1, $prix2, $capacity) {

    echo'<TR >
                                        <Td class ="col" height =33 rowspan="2" width=20% style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF"><b>' . $date . '</b></FONT></Td>
                                        <Td class ="col" height =33 width=30% style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF">' . $nom . ' </FONT></Td>
                                        <Td class ="col" height =33 width=20% style="border:1px solid black; text-align : center"> <FONT style="color : #F0FFFF"> ' . $prix1 . ' €</FONT> </Td>
                                        <Td class ="col" height =33 width=20% style="border:1px solid black;text-align : center"><FONT style="color : #F0FFFF"> ' . $prix2 . ' €</FONT></Td>
                                        <Td class ="col" height =33 width=100.65 width=10% style="border:1px solid black;text-align : center"><FONT style="color : #70F861"> <b> ' . $capacity . ' </b></FONT></Td>
                                    </TR>';
}

/* Fontion pour afficher d'une activité complète 
 * Paramètre :  $bdd - Base de données / $nom - Nom de l'activité / $date - Date de l'activité / $prix1 - Tarif privilège / $prix2 - Tarif plein 
 * Description :
 * Pour chaque activité complète, on affiche une ligne de tableau grisée avec son intitulé, sa date , ses tarifs (privilège et plein) et le mot clé "complet".
 */

function afficheActiviteComplete($nom, $date, $prix1, $prix2) {

    echo' <TR style="color: #525252;">
                                        <Td class ="col"  height =33 width=20% style="border:1px solid black; text-align : center;"><b> ' . $date . '</b></Td>
                                        <Td class ="col" height =33 width=30% style="border:1px solid black; text-align : center;"> ' . $nom . '</Td>
                                        <Td class ="col" height =33 width=20% style="border:1px solid black; text-align : center"> ' . $prix1 . ' € </Td>
                                        <Td class ="col" height =33 width=20% style="border:1px solid black;text-align : center">' . $prix2 . ' €</Td>
                                        <Td class ="col" height =33 width=100.65 style="border:1px solid black;text-align : center"><FONT style="color : #FF5E4D"> Complet </FONT></Td>
                                    </TR>';
}

/* Affichage complet de l'agenda 
 * Paramètre :  $bdd - Base de données 
 * Description :
 * On affiche tous l'agenda en utilisant les fonctions précédentes pour obtenir un tableau d'excursions et un tableau de repas
 */

function afficheAgenda($bdd) {
    /* Affichage des activités */
    echo'<html> <div class="row section-head">
        <div class="col full">
            <span><h2 style = "color :#11ABB0; margin : 65px; text-align : center">Agenda des conférences et des activités <br>
           <center><FONT size="3.5pt " style = "color :#F0FFFF ;font-weight:normal">Connectez vous pour pouvoir choisir des activités!</center></FONT></h2><span>
        </div>
        </html>';

    afficheRepas1($bdd);
    afficheExcursions1($bdd);
    echo'</html> </div></html>';
}

/* ---------------------------------------------------------------------------------------------------- */
/*                           AFFICHAGE AGENDA EN MODE CONNECTE                                                      */
/* ---------------------------------------------------------------------------------------------------- */

/* Fontion pour afficher le tableau des repas 
 * Paramètre : $bdd - Base de données / $idco - identifiant de connexion du membre
 * Description :
 * L'objectif ici est d'afficher tous les repas du congrès qui nous interesse. On sélectionne pour cela tous les repas de la base de données.
 * Puis, on affiche différemment les repas qui sont complets et ceux qui possèdent encore des places libres dans un tableau.
 * Attention, si un membre a un accompagnant et qu'il ne reste plus qu'une seule place dans un repas, il faut afficher l'activité comme étant complète.
 */

function afficheRepas2($bdd, $idco) {
    try {

        /* Récupération du memberID */
        $memberID = getMemberID($bdd, $idco);

        /* Récupération du nombre de participants */
        $n = nbPersonne($bdd, $memberID);

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
                    <CAPTION> <h2><FONT style="color :#CAD1D5">Repas</FONT><br></br></h2> </CAPTION>

                    <TR class="row" >
                        <TH class ="col"  height=60 width=20% style="border:1px solid black;">Date</TH>
                        <TH class ="col" height=60 width=30% style="border:1px solid black;">Intitulé </TH>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif privilège <br>(jusqu\'au 31/03)  </th>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif plein <br>(à compter du 01/04)  </th>
                        <th class ="col" height=60 width=100.65 width=10% style="border:1px solid black"> <FONT size="2.5pt">Ajouter au panier </FONT></th>
                     </TR>';

        /* Affichage des activités */
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $c = $row["Activity_Capacity"];
            if ($c == 0 || ($c == 1 && $n == 2)) {
                afficheActiviteComplete2($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"], $idco, $bdd);
            } else {
                afficheActiviteLibre2($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"], $idco, $bdd);
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

/* Fontion pour afficher le tableau des excursions 
 * Paramètre : $bdd - Base de données / $idco - identifiant de connexion du membre
 * Description :
 * L'objectif ici est d'afficher toutes les excursions du congrès qui nous interesse. On sélectionne pour cela toutes les excursions de la base de données.
 * Puis, on affiche différemment les excursions qui sont completes et celles qui possèdent encore des places libres dans un tableau.
 * Attention, si un membre a un accompagnant et qu'il ne reste plus qu'une seule place dans un repas, il faut afficher l'activité comme étant complète.
 */

function afficheExcursions2($bdd, $idco) {
    try {
        /* Récupération du memberID */
        $memberID = getMemberID($bdd, $idco);

        /* Récupération du nombre de participants */
        $n = nbPersonne($bdd, $memberID);

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
                    <CAPTION> <h2><FONT style="color :#CAD1D5">Excursions</FONT><br></br></h2> </CAPTION>

                    <TR class="row" >
                        <TH class ="col" height=60 width=20% style="border:1px solid black;">Date</TH>
                        <TH class ="col" height=60 width=30% style="border:1px solid black;">Intitulé </TH>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif privilège <br>(jusqu\'au 31/03)  </th>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif plein <br>(à compter du 01/04)  </th>
                        <th class ="col" height=60 width=100.65 width=10% style="border:1px solid black"> <FONT size="2.5pt">Ajouter au panier </FONT></th>
                     </TR>';

        /* Affichage des activités */
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $c = $row["Activity_Capacity"];
            if ($c == 0 || ($c == 1 && $n == 2)) {
                afficheActiviteComplete2($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"], $idco, $bdd);
            } else {
                afficheActiviteLibre2($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"], $idco, $bdd);
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

/* Fontion pour afficher d'une activité libre 
 * Paramètre : $bdd - Base de données / $nom - Nom de l'activité / $date - Date de l'activité / $prix1 - Tarif privilège / $prix2 - Tarif plein / $idco - identifiant de connexion du membre
 * Description :
 * Pour chaque activité libre, on affiche une ligne de tableau avec son intitulé, sa date , ses tarifs (privilège et plein) et un bouton pour ajouter au panier.
 * Si l'activité a déjà été réservée par le membre, on affiche la mention "Déjà réservée" à la place du bouton +.
 */

function afficheActiviteLibre2($nom, $date, $prix1, $prix2, $idco, $bdd) {

    /* On teste si l'utilisateur a déjà réseré cette activité ou non */
    /* On récupère l'id du membre */
    $memberID = getMemberID($bdd, $idco);

    /* On récupère son basket id */
    $basketID = getBasketID($bdd, $memberID);

    /* On récupère d'activité ID */
    $activiteID = getActivityID($bdd, $nom);

    /* on regarde si l'activité est dans son panier ou non */
    $cpt = estDansPanier($bdd, $activiteID, $basketID);

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

/* Fontion pour afficher d'une activité libre 
 * Paramètre : $bdd - Base de données / $nom - Nom de l'activité / $date - Date de l'activité / $prix1 - Tarif privilège / $prix2 - Tarif plein / $idco - identifiant de connexion du membre 
 * Description :
 * Pour chaque activité complète, on affiche une ligne de tableau avec son intitulé, sa date , ses tarifs (privilège et plein) et une mention "complet".
 * Si l'activité a déjà été réservée par le membre, on affiche la mention "Déjà réservée" à la place de la mention "complet".
 */

function afficheActiviteComplete2($nom, $date, $prix1, $prix2, $idco, $bdd) {
    /* On teste si l'utilisateur a déjà réseré cette activité ou non */
    /* On récupère l'id du membre */
    $memberID = getMemberID($bdd, $idco);

    /* On récupère son basket id */
    $basketID = getBasketID($bdd, $memberID);

    /* On récupère d'activité ID */
    $activiteID = getActivityID($bdd, $nom);

    /* on regarde si l'activité est dans son panier ou non */
    $cpt = estDansPanier($bdd, $activiteID, $basketID);


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

/* Affichage complet de l'agenda 
 * Paramètre :  $bdd - Base de données / $idco - identifiant de connexion du membre
 * Description :
 * On affiche tous l'agenda en utilisant les fonctions précédentes pour obtenir un tableau d'excursions et un tableau de repas
 */

function afficheAgenda2($idco, $bdd) {


    /* Affichage des activités */
    echo'<html> <div class="row section-head">
        <div class="col full">
            <span><h2 style = "color :#11ABB0; margin : 65px; text-align : center">Agenda des conférences et des activités</h2><span>
        </div>
        ';

    compteurPanier($bdd, $idco);
    afficheRepas2($bdd, $idco);
    afficheExcursions2($bdd, $idco);
    echo' </div></html>';
}

/* Affichage d'un compteur pour le panier
 * Paramètre :  $bdd - Base de données / $idco - identifiant de connexion du membre
 * Description :
 * On affiche en haut à droite de la page, un compteur indiquant le nombre d'activités dans le panier du membre
 */

function compteurPanier($bdd, $idco) {
    /* Récupération du membre id */
    $memberID = getMemberID($bdd, $idco);

    /* Récupération du basket id */
    $basketID = getBasketID($bdd, $memberID);

    /* Récupération du nombre d'activités dans le panier */
    $cpt = comptePanier($bdd, $basketID);

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
        
            echo' 
            <div align="right">
                <TABLE id="tableau" border style="border:1px solid #32787A; margin-left : 0; width : 10%">
                    <TR class="row" >      
                          <TH class ="col" height=60 width=100 ><FONT style="color : #32787A; font-weight:normal;"> Panier </FONT><br><FONT size="5" style="color : #11ABB0;">' . $cpt . ' </FONT></TH>
                   
                            <Td class ="col" height=60 width=100 >
                              <form action="agendaPanier.php" method="post" style = "margin-bottom : 0; margin-left : 10px"> 
                                   
                                   <input type="image" src="images/panier.png" " name="panier"  style= "height : 50px; width : 50px">
                                   <input type="hidden"  name="idco" value="' . $idco . '">
                                 </form>
                             </td> 
                   
                    </TR>
                </TABLE>
             </div>';
    
    }
}

/* ---------------------------------------------------------------------------------------------------- 
 *                           AFFICHAGE ACHATS    
 * Paramètres :  $bdd - Base de données / $idco - identifiant de connexion du membre
 * Description :
 * L'objectif ici est d'afficher tous les achats faits par le membre. Pour cela, on va afficher deux tableaux, un pour les repas et un pour les excursions
 * On affiche aussi les trois totaux : repas, excursions et repas+excursions.                              
 * ---------------------------------------------------------------------------------------------------- */

function afficheAchats($bdd, $idco) {
    /* Récupération du membreID */
    $memberID = getMemberID($bdd, $idco);

    /* Récupération du basketID */
    $basketID = getBasketID($bdd, $memberID);

    /* Récupération du follower */
    $n = nbPersonne($bdd, $memberID);

    /*     * ************************************************** */
    /* Récupération des repas payés et affichage */
    /*     * **************************************************** */


    echo'       <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Repas<FONT></h2>
         </div>';

    /* Récupération du nombre de repas réservés */
    $cpt = getNbRepasAchetes($bdd, $basketID);

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
    <TABLE id="tableau" border  cols="4" style="border:1px solid black;width : 80%; margin-left : 0">             
         <TR class="row" >
                        <Td class ="col"  width=20% style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B"> Date </FONT></TH>
                        <td class ="col" width=40% style="border:1px solid black; text-align : center;"> <FONT size="4" style="color : #52574B"> Intitulé </FONT></th>
                        <td class ="col" width=10% style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Tarif </FONT></th>
                         <td class ="col" width=241.23 style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Nombre de personnes</FONT></th>
        </TR>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $date = $row["Activity_Date"];
            $prix = $row["Belong_Price"];
            $totalrepas = "$prix" + "$totalrepas";
            echo' <TR class="row" >
           <Td class ="col"  width=20% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $date . '</FONT> </TH>
           <td class ="col" width=40% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $activite . '</FONT> </th>
           <td class ="col" width=10% style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $prix . ' € </FONT> </th>
         <td class ="col" width=241.23 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $n . '  </FONT> </th>
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
    $cpt2 = getNbExcursionsAchetees($bdd, $basketID);

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
    <TABLE id="tableau" border  cols="4" style="border:1px solid black;width : 80%; margin-left : 0">             
         <TR class="row" >
                         <Td class ="col"  width=20% style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B"> Date </FONT></TH>
                        <td class ="col" width=40% style="border:1px solid black; text-align : center;"> <FONT size="4" style="color : #52574B"> Intitulé </FONT></th>
                        <td class ="col" width=10% style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Tarif </FONT></th>
                         <td class ="col" width=241.23 style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Nombre de personnes</FONT></th>
        </TR>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $date = $row["Activity_Date"];
            $prix = $row["Belong_Price"];

            $totalexcursions = $prix + $totalexcursions;
            echo' <TR class="row" >
           <Td class ="col"  width=20% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $date . '</FONT> </TH>
           <td class ="col" width=40% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $activite . '</FONT> </th>
           <td class ="col" width=10% style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $prix . ' € </FONT> </th>
         <td class ="col" width=241.23 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $n . '  </FONT> </th>
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

    $totalrepas = $n * $totalrepas;
    $totalexcursions = $n * $totalexcursions;
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
    if (($cpt + $cpt2 ) != 0) {
        echo'<form name="imprimAchat" id="contactForm" method="post"  action="imprimAchats.php">
            <div align="center">
                <input type="submit" name="v" value="Imprimer">
              <input type="hidden"  name="idco" value="' . $idco . '">
            </div>';
    }
}

/* ---------------------------------------------------------------------------------------------------- 
 *                           AFFICHAGE COMMANDES    
 * Paramètres :  $bdd - Base de données / $idco - identifiant de connexion du membre
 * Description :
 * L'objectif ici est d'afficher toutes les commandes faits par le membre. Pour cela, on va afficher deux tableaux, un pour les repas et un pour les excursions
 * On affiche aussi les trois totaux des activités commandées : repas, excursions et repas+excursions.                                 
 * ---------------------------------------------------------------------------------------------------- */

function afficheCommandes($bdd, $idco) {
    /* Récupération du membreID */
    $memberID = getMemberID($bdd, $idco);

    /* Récupération du basketID */
    $basketID = getBasketID($bdd, $memberID);

    /* Récupération du follower */
    $n = nbPersonne($bdd, $memberID);

    /*     * ************************************************** */
    /* Récupération des repas payés et affichage */
    /*     * **************************************************** */


    echo'       <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Repas<FONT></h2>
         </div>';

    /* Récupération du nombre de repas réservés */
    $cpt = getNbRepasCommandes($bdd, $basketID);

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
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 80%; margin-left : 0">             
         <TR class="row" >
                        <Td class ="col"  width=20% style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B"> Date </FONT></TH>
                        <td class ="col" width=40% style="border:1px solid black; text-align : center;"> <FONT size="4" style="color : #52574B"> Intitulé </FONT></th>
                        <td class ="col" width=10% style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Tarif </FONT></th>
                         <td class ="col" width=241.23 style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Nombre de personnes</FONT></th>
        </TR>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $date = $row["Activity_Date"];
            $prix = $row["Belong_Price"];
            $totalrepas = "$prix" + "$totalrepas";
            echo' <TR class="row" >
           <Td class ="col"  width=20% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $date . '</FONT> </TH>
           <td class ="col" width=40% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $activite . '</FONT> </th>
           <td class ="col" width=10% style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $prix . ' € </FONT> </th>
         <td class ="col" width=241.23 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $n . '  </FONT> </th>
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

    $cpt2 = getNbExcursionsCommandees($bdd, $basketID);

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
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 80%; margin-left : 0">             
         <TR class="row" >
           <Td class ="col"  width=20% style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B"> Date </FONT></TH>
                        <td class ="col" width=40% style="border:1px solid black; text-align : center;"> <FONT size="4" style="color : #52574B"> Intitulé </FONT></th>
                        <td class ="col" width=10% style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Tarif </FONT></th>
                         <td class ="col" width=241.23 style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Nombre de personnes</FONT></th>
        </TR>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $date = $row["Activity_Date"];
            $prix = $row["Belong_Price"];

            $totalexcursions = $prix + $totalexcursions;
            echo' <TR class="row" >
            <Td class ="col"  width=20% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $date . '</FONT> </TH>
           <td class ="col" width=40% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $activite . '</FONT> </th>
           <td class ="col" width=10% style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $prix . ' € </FONT> </th>
         <td class ="col" width=241.23 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $n . '  </FONT> </th>
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

    $totalrepas = $n * $totalrepas;
    $totalexcursions = $n * $totalexcursions;
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
    if (($cpt + $cpt2 ) != 0) {
        echo'<form name="imprimCommandes" id="contactForm" method="post"  action="imprimCommandes.php">
            <div align="center">
                <input type="submit" name="v" value="Imprimer">
                 <input type="hidden"  name="idco" value="' . $idco . '">
            </div>';
    }
}

/* ---------------------------------------------------------------------------------------------------- 
 *                           AFFICHAGE INFOS PERSO   
 * Paramètres :  $bdd - Base de données / $idco - identifiant de connexion du membre
 * Description : 
 * On affiche ici toutes les informations personnelles du membre.                            
 * ---------------------------------------------------------------------------------------------------- */

function afficheInfos($bdd, $idco) {

    /* Récupération des données personnelles du membre */
    list($memberID, $nom, $prenom, $titre, $status, $district, $club, $num, $adressesup, $rue, $ville, $cp, $tel, $mobile, $mail, $positionclub, $positiondistrict, $train, $traindate) = getInfos($bdd, $idco);

    /* Récupération du follower */
    list ($fnom, $fprenom) = getFollower($bdd, $memberID);

    /* Affichage des données personnelles avec possibilité de modification */
    echo'
       
       
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
}

/* ---------------------------------------------------------------------------------------------------- */
/*                           AFFICHAGE PANIER                                                        */
/* ---------------------------------------------------------------------------------------------------- */


/* Fontion pour afficher le tableau des activités du panier 
 * Paramètres :  $bdd - Base de données / $idco - identifiant de connexion du membre
 * Description : 
 * On affiche toutes les activités ajoutées au panier par le client ainsi que leurs totaux.
 * Si le client a un accompagnant, les totaux sont alors doublés.
 */

function affichePanier($bdd, $idco) {
    try {

        /* Récupération du membre id */
        $memberID = getMemberID($bdd, $idco);

        /* Récupération du basket id */
        $basketID = getBasketID($bdd, $memberID);

        /* Récupération du follower : si il y a un accompagnant les tarifs sont doublés */
        $n = nbPersonne($bdd, $memberID);

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
                        <TH class ="col"   width=15% style="border:1px solid black;">Type </TH>
                        <TH class ="col"  width=15% style="border:1px solid black;"> Date </TH>
                        <th class ="col" width=20% style="border:1px solid black"> Intitulé </th>
                        <th class ="col" width= 8% style="border:1px solid black">Tarif </th>
                        <th class ="col" width= 22% style="border:1px solid black"> Nombre de personnes </th>
                        <th class ="col"   width=201.26 style="border:1px solid black"> Supprimer du panier</th>
                     </TR>';

        /* Affichage des activités */
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            afficheActivite($row["Activity_Type_Name"], $row["Activity_Name"], $row["Activity_Date"], $row["Belong_Price"], $idco, $n, $bdd);
        }

        /* Fermeture du tableau */
        echo'</TABLE></center>
                        </div>
                        <br></br></html>';

        /* Total */
        list ($totalrepas, $totalexcursion, $total) = getTotal($bdd, $basketID);
        $totalrepas = $totalrepas * $n;
        $totalexcursion = $totalexcursion * $n;
        $total = $total * $n;

        /* Affichage des totaux */
        echo'
    <html>
         <div align="right">
               <TABLE id="tableau" border width=50% cols="2" style="border:1px solid black;width : 40%; margin-left : 0" >
                 
                 <CAPTION> <h2><FONT style="color :#CAD1D5">Récapitulatif </FONT><br></h2> </CAPTION>
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

/* Fontion pour afficher d'une activité 
 * Paramètre : $bdd - Base de données / $nom - Nom de l'activité / $date - Date de l'activité / $prix - Prix à payer / $type - type de l'activité / $idco - identifiant de connexion du membre / $n - nombre de réservations
 * Description :
 * On affiche dans une ligne de tableau l'intitulé de l'activité, sa date, son prix, le nombre de places réservées et un bouton pour la supprimer du panier
 */

function afficheActivite($type, $nom, $date, $prix, $idco, $n, $bdd) {

    echo'<TR >
                                        <Td class ="col" height=44.688  width=15% style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF">' . $type . '</FONT></Td>
                                        <Td class ="col" height=44.688 width=15% style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF">' . $date . ' </FONT></Td>
                                        <Td class ="col" height=44.688 width=20% style="border:1px solid black; text-align : center"> <FONT style="color : #F0FFFF"> ' . $nom . '  </FONT> </Td>
                                        <Td class ="col" height=44.688 width=8% style="border:1px solid black;text-align : center"><FONT style="color : #F0FFFF"> ' . $prix . ' €</FONT></Td>
                                        <Td class ="col" height=44.688 width=22% style="border:1px solid black;text-align : center"><FONT style="color : #F0FFFF"> ' . $n . '</FONT></Td>
                                        <Td class ="col" width=201.26  style ="padding:9px 85px" height=44.688 width=20% style="border:1px solid black;text-align : center">  
                                            <form action="suppActivite.php" method="post"> 
                                                <input type="submit" style= "padding:0 ; margin-bottom : 0;margin-top : 9; height : 25px; width : 25px; background:#FF5E4D"   name="supp" value="-">
                                                 <input type="hidden"  name="activity" value="' . $nom . '">
                                                  <input type="hidden"  name="idco" value="' . $idco . '">
                                                </form>
                                        </Td>                        
         </TR>';
}

/* Affichage d'un bouton pour valider le panier
 * Paramètres :  $bdd - Base de données / $idco - identifiant de connexion du membre
 * Description : 
 * Une fois toutes les activités du panier affichées, on place un bouton valider qui permet de valider le panier et de passer au paiement
 * Ce bouton n'est visible que si le panier est non vide.
 */

function afficheBoutonValider($basketID, $bdd, $idco) {

    /* on regarde si l'activité est dans son panier ou non */
    $cpt = comptePanier($bdd, $basketID);

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

/* ---------------------------------------------------------------------------------------------------- 
 *                           AFFICHAGE RECAPITULATIF DU PANIER  
 * Paramètres :  $bdd - Base de données / $idco - identifiant de connexion du membre
 * Description :  
 * Une fois le panier validé, on affiche un récapitulatif du panier afin que l'utilisateur puisse vérifier ses réservations.
 * Ce récapitulatif comprend toutes les informations personnelles de l'utilisateurs et toutes les activités qui figuraient dans son panier.
 * On peut aussi y lire les différents totaux. 
 * A la suite de ce récapitulatif, se situent deux boutons :
 * - valider et payer qui permet de passer au choix du paiement
 * - imprimer qui permet d'éditer un récapitulatif PDF du panier                       
 * ---------------------------------------------------------------------------------------------------- */

function afficheRecap($bdd, $idco) {

    /* Récupération des données personnelles du membre */
    list($memberID, $nom, $prenom, $titre, $status, $district, $club, $num, $adressesup, $rue, $ville, $cp, $tel, $mobile, $mail, $positionclub, $positiondistrict, $train, $traindate) = getInfos($bdd, $idco);


    /* Récupération du follower */
    list ($fnom, $fprenom) = getFollower($bdd, $memberID);

    /* Récupération du nombre de personnes réservant l'activité */
    $n = 1;
    if (!(empty($fom) && empty($fprenom))) {
        $n = $n + 1;
    }


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
    $basketID = getBasketID($bdd, $memberID);

    list ($totalmeal, $totaltrip, $total) = getTotal($bdd, $basketID);

    $total = $n * $total;
    $totaltrip = $n * $totaltrip;
    $totalmeal = $n * $totalmeal;

    /*     * ************************************************** */
    /* Récupération des repas du panier et affichage */
    /*     * **************************************************** */

    /* Récupération du nombre de repas réservés */
    $cpt = getNbRepasPanier($bdd, $basketID);


    if ($cpt != 0) {

        $sql = 'SELECT  Activity_Name, Activity_Date, Belong_Price FROM Activity '
                . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
                . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Repas" AND Congress_ID = ' . congressID . ') ORDER BY (Activity_Date)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));


        echo'
<div>
    <TABLE id="tableau" border  cols="4" style="border:1px solid black;width : 80%; margin-left : 0">             
         <TR class="row" >
                        <Td class ="col"  width=20% style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B"> Date </FONT></TH>
                        <td class ="col" width= 40% style="border:1px solid black; text-align : center;"> <FONT size="4" style="color : #52574B"> Intitulé </FONT></th>
                        <td class ="col" width= 10% style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Tarif </FONT></th>
                        <td class ="col" width=241.23 style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Nombre de personnes </FONT></th>
        </TR>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $date = $row["Activity_Date"];
            $prix = $row["Belong_Price"];


            echo' <TR class="row" >
           <Td class ="col"  width=20% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $date . '</FONT> </TH>
           <td class ="col" width=40% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $activite . '</FONT> </th>
           <td class ="col" width=10% style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $prix . ' € </FONT> </th>
          <td class ="col" width=241.23 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $n . '  </FONT> </th>
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
    $cpt2 = getNbExcursionsPanier($bdd, $basketID);


    if ($cpt2 != 0) {
        $sql = 'SELECT  Activity_Name, Activity_Date, Belong_Price FROM Activity '
                . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
                . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Excursion" AND Congress_ID = ' . congressID . ') ORDER BY (Activity_Date)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));


        echo'
<div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 80%; margin-left : 0">             
         <TR class="row" >
                          <Td class ="col"  width=20% style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B"> Date </FONT></TH>
                        <td class ="col" width= 40% style="border:1px solid black; text-align : center;"> <FONT size="4" style="color : #52574B"> Intitulé </FONT></th>
                        <td class ="col" width= 10% style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Tarif </FONT></th>
                        <td class ="col" width=241.23 style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Nombre de personnes </FONT></th>
        </TR>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $date = $row["Activity_Date"];
            $prix = $row["Belong_Price"];

            echo' <TR class="row" >
          <Td class ="col"  width=20% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $date . '</FONT> </TH>
           <td class ="col" width=40% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $activite . '</FONT> </th>
           <td class ="col" width=10% style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $prix . ' € </FONT> </th>
          <td class ="col" width=241.23 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $n . '  </FONT> </th>
         </TR>';
        } echo'</TABLE>
             </div>';
    } else {
        echo'  <div>
           <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > Aucune excursion réservée</h2> 
        </div>';
    }

    /*     * ************************** */
    /* Affichage des totaux */
    /*     * ********************** */
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

    /*     * ******************************************* */
    /* BOUTONS */
    /*     * ******************************************** */

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

/* ---------------------------------------------------------------------------------------------------- 
 *                          AJOUT D'ACTIVITE AU PANIER  
 * Paramètres :  $bdd - Base de données / $idco - identifiant de connexion du membre / $nom - Nom de l'activité à ajouter
 * Description :
 * Cette fonction permet d'ajouter une activité au panier.
 * C'est à dire qu'elle crée une ligne dans la table belong avec l'activité à ajouter, la basketID de l'utilisateur et le prix de l'activité.
 * Ce prix varie selon la date de réservation, c'est pourquoi un test est fait pour le déterminer.
 * Par ailleurs, il faut mettre à jour les totaux du panier et décrémenter le nombre de places disponibles de l'activité.                                       
 * ---------------------------------------------------------------------------------------------------- */

function addAct($bdd, $idco, $nom) {
    /* On récupère son member_ID */
    $memberID = getMemberID($bdd, $idco);

    /* On récupère son basket_ID */
    $basketID = getBasketID($bdd, $memberID);


    /* On récupère le prix, le type et l'activity_ID de l'activité choisie */

    list ($a1, $m1, $j1, $heure1, $min1, $sec1) = dateAuj($bdd);
    $a2 = 2016;
    $j2 = 31;
    $m2 = 3;

    /* Comparaison des dates */
    $privilege = compareDate($j1, $m1, $a1, $j2, $m2, $a2);

    /* Si on est avant le 31 mars, le tarif sera le premier */
    if ($privilege == 1) {

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
    insertBelong($bdd, $activiteID, $basketID, $prix);

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

    $cpt = nbPersonne($bdd, $memberID);

    $sum = "$cap" - "$cpt";

    $sql8 = 'UPDATE Activity SET Activity_Capacity = :sum WHERE (Activity_ID=:id)';
    $stmt = $bdd->prepare($sql8);
    $stmt->execute(array('sum' => "$sum", 'id' => "$activiteID"));

    header("location:" . $_SERVER['HTTP_REFERER']);
}

/*
 * Paramètres : 
 * - j1, m1, a1 désigne le jour, le mois et l'année d'une première date
 * - j2, m2, a2 désigne le jour, le mois et l'année d'une seconde date
 * Résultat :
 * - Booléen : inf
 * Description :
 * Cette fonction renvoie 1 si la première date est plus ancienne que la seconde et 0 sinon
 */

function compareDate($j1, $m1, $a1, $j2, $m2, $a2) {
    $inf = ($a1 < $a2) || ($a1 == $a2 && $m1 < $m2) || ($a1 == $a2 && $m1 == $m2 && $j1 <= $j2);

    return $inf;
}

/* ---------------------------------------------------------------------------------------------------- 
 *                          AFFICHAGE DU PIED DE PAGE 
 * Description :
 * Cette fonction permet d'afficher le pied de page avec les icônes facebook, twitter et linkedin                                                 
 * ---------------------------------------------------------------------------------------------------- */

function afficheFooter() {
    echo' 
    <html>
        <footer>
            <div class="row">
                <div class="col g-7">
                    <ul class="copyright">
                        <li>&copy; 2016 Lions Clubs</li>
                        <li>Design by <a href="http://www.styleshout.com//" title="styleshout"> Styleshout</a></li>  
                        <br>                       
                        <a> <FONT style ="color: #444">Developped  by </FONT>Thomas MICHELS <FONT style ="color: #444">and </FONT>Laura GUILLOT <FONT style ="color: #444">, </FONT> Ecole Centrale de Nantes <a>
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

/* ---------------------------------------------------------------------------------------------------- 
 *                          AFFICHAGE DU HEADER                                                
 * Description :
 * L'affichage du header consiste à afficher les différents onglets disponibles.
 * Afin d'afficher correctement les onglets qui sont actifs, il a fallu tester l'URL de la page affichée.
 * ---------------------------------------------------------------------------------------------------- */

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

    if (strcmp($file, 'contact.php') == 0 || strcmp($file, 'verifContact.php') == 0 || strcmp($file, 'messageok.php') == 0) {
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

    if (strcmp($file, 'verifPerteMdp1.php') == 0 || strcmp($file, 'perteMdp1.php') == 0 || strcmp($file, 'initMdp.php') == 0 || strcmp($file, 'perteMdpNew.php') == 0 || strcmp($file, 'perteMdp.php') == 0 || strcmp($file, 'verif2bis.php') == 0 || strcmp($file, 'verifConnexion.php') == 0 || strcmp($file, 'verif1.php') == 0 || strcmp($file, 'verif3.php') == 0 || strcmp($file, 'verif2.php') == 0 || strcmp($file, 'inscription.php') == 0 || strcmp($file, 'inscription2.php') == 0 || strcmp($file, 'inscription3.php') == 0) {
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

/* ---------------------------------------------------------------------------------------------------- 
 *                          REINITIALISATION DU MOT DE PASSE     
 * Paramètres :  $bdd - Base de données / $email - mail du membre / $mdp - Mot de passe saisi par le membre / $mdp2 - Confirmation du mot de passe
 * Description :     
 * - Si les informations saisies sont correctes ( email appartenant à la base de données et les deux mots de passes identiques), on remplace le mot de passe du membre par le nouveau saisi
 * - Sinon, on affiche un message d'erreur.                                   
 * ---------------------------------------------------------------------------------------------------- */

function initMDP($email, $mdp, $mdp2, $bdd) {

    /* On teste si l'email est dans la base */
    $cpt = testMail($bdd, $email);

    /* Si l'email n'est pas dans la base ou si les mots de passes sont différents, on affiche un message d'erreur */
    if ($cpt = 0 or empty($mdp) or $mdp != $mdp2 or ! preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {

        header("Location: http://localhost/lion/lion/php/perteMdpNew.php");
    } else {
        /* On récupère l'ID du membre pour mettre à jour en toute sécurité */
        $id = getMemberIDMail($bdd, $email);

        /* Réinitialisation du mot de passe */
        setMdp($bdd, $id, $mdp);


        /* Redirection vers la page d'inscription */
        header("Location: http://localhost/lion/lion/php/inscription.php");
    }
}



/* ---------------------------------------------------------------------------------------------------- 
 *                          SUPPRESSION D'ACTIVITE DU PANIER        
 * Paramètres :  $bdd - Base de données / $idco - identifiant de connexion du membre / $nom - Nom de l'activité à ajouter
 * Description :
 * Cette fonction permet de supprimer une activité au panier.
 * C'est à dire qu'elle supprime de la table belong la ligne où il y a l'ID de l'activité et le basketID du membre
 * A la suppression, il faut mettre à jour les totaux du panier et incrémenter le nombre de places disponibles de l'activité ( de 2 ou 1 si il y a un accompagnant ou non)              
 * ---------------------------------------------------------------------------------------------------- */

function suppAct($bdd, $idco, $nom) {
    /* On récupère son member_ID */
    $memberID = getMemberID($bdd, $idco);

    /* On récupère son basket_ID */
    $basketID = getBasketID($bdd, $memberID);

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
    deleteAct($bdd, $activiteID, $basketID);

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

    $c = nbPersonne($bdd, $memberID);

    $sum = "$cap" + "$c"; /* si il y a un follower, on incrémente de 2 */
    $sql8 = 'UPDATE Activity SET Activity_Capacity = :sum WHERE (Activity_ID=:id)';
    $stmt = $bdd->prepare($sql8);
    $stmt->execute(array('sum' => "$sum", 'id' => "$activiteID"));

    
}

/* ---------------------------------------------------------------------------------------------------- 
 *                          VERIFICATION CONNEXION       
 * Paramètres :  $bdd - Base de données / $mail - Mail du membre / $mdp - Mot de passe du membre
 * Description :            
 * Lorsqu'un membre veut se connecter, il saisit son mail et son mot de passe. Il faut alors vérifier si ils sont corrects.
 * - Si ils sont corrects, on connecte l'utilisateur en lui créant une connexion si il n'en a pas ou en récupérant une ancienne connexion s'il en a encore une
 * - Sinon, on affiche un message d'erreur.                                 
 * ---------------------------------------------------------------------------------------------------- */

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
                                <a href="perteMdp1.php"  title="perte de mot de passe">Si vous avez perdu votre mot de passe, cliquez ici</a> 

                            </div>
                            <br>

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

                $cpt = testConnexionMembre($bdd, $memberID);

                // S'il n'y a pas de connexion, on en crée une
                if ($cpt == 0) {

                    //Création de l'id de connexion  
                    $chaine = "";
                    $c = "abcdefghijklmnpqrstuvwxy";
                    srand((double) microtime() * 1000000);
                    for ($i = 0; $i < 70; $i++) {
                        $chaine .= $c[rand() % strlen($c)];
                    }

                    list ($annee, $mois, $day, $heure, $min, $sec) = dateAuj($bdd);

                    $idco = $chaine . $day . $mois . $annee . $heure . $min . $sec;

                    //Ajout d'une nouvelle connexion                    
                    insertConnexion($bdd, $memberID, $idco);
                } else {

                    // Si une connexion est déjà active, on l'update
                    $idco = getIdco($bdd, $memberID);

                    majConnexion($bdd, $idco);
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

/* ---------------------------------------------------------------------------------------------------- 
 *                        SELECTION DES CLUBS D'UN DISTRICT  
 * Paramètres :  $bdd - Base de données / $district - Nom du district
 * Description : 
 * Cette fonction petmet d'afficher, dans un menu déroulant, tous les clubs d'un district.                                               
 * ---------------------------------------------------------------------------------------------------- */

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

/* ----------------------------------------------------------------------------------------------- 
 *                                 GESTION DES CONNEXIONS                                        
 * Paramètres :  $bdd - Base de données 
 * Description : 
 * Cette fonction sert à mettre à jour la table connexion. Lorsqu'un utilisateur connecté, n'a pas effectué de clic pendant plus de 30 min, on supprime sa connexion.
 * Cette fonction est appelée à chaque clic d'un utilisateur.
 * Ainsi, si un utilisateur quitte le site sans se déconnecter, sa connexio sera supprimée après 30 min et son panier sera vidé.
 * ----------------------------------------------------------------------------------------------- */

function gereConnexion($bdd) {
    /* On récupère la date courante */
    list($a, $mo, $j, $h, $m, $s) = dateAuj($bdd);


    /* On récupère toutes les connexions */
    $sql = 'SELECT Connexion_ID, Last_Connexion, HOUR(Last_Connexion), MINUTE(Last_Connexion), SECOND(Last_Connexion) FROM Connexion ';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array());

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

        $idco = $row['Connexion_ID'];

        $h2 = $row['HOUR(Last_Connexion)'];
        $m2 = $row['MINUTE(Last_Connexion)'];
        $s2 = $row['SECOND(Last_Connexion)'];

        $diff = ($h - $h2) + ($m - $m2) / 60 + ($s - $s2) / 3600;

        if ($diff > 0.5) {
            echo "AAAA";
            //On supprime la connexion
            
            /* Récupération du membre id */
            $memberID = getMemberID($bdd, $idco);

            /* Récupération du basket id */
            $basketID = getBasketID($bdd, $memberID);

            /* Incrémentation des capacités de toutes les activités supprimées */
            setCapacity($bdd, $memberID, $basketID);


            /* Suppression des activités non payées */
            videBasket($bdd, $basketID);

            /* Suppression de la connexion */
            suppConnexion($bdd, $idco);
        }
    }
}

gereConnexion($bdd);



