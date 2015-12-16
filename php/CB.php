<?php

$valid = TRUE;



if ($valid) {
    
    /* Définition de la connexion à la base de données*/
$bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', '');

    /* On récupère son member_ID */
    $sql1 = 'SELECT Member_ID FROM Member WHERE (Connexion_ID = :idco )';
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
    $sql3 = 'UPDATE Belong SET Belong_Payement_Way = "CB" WHERE (Basket_ID = :id AND Belong_Paid =0)';
    $stmt = $bdd->prepare($sql3);
    $stmt->execute(array('id' => "$basketID"));

    $sql4 = 'UPDATE Belong SET Belong_Paid = 1 WHERE (Basket_ID = :id AND Belong_Payement_Way="CB")';
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
    $stmt = $bdd->prepare(6);
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
    include("afficheAchats.php");
    echo' </div>

        
         
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
?>