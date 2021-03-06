<?php
$path = $_SERVER['PHP_SELF'];
$file = basename($path);

if (strcmp($file, 'verifContactC.php') == 0) {
   $idco = $_POST['idco'];
} else {
    $idco = $_GET['idco']; 
}
include "fonctions.php";
majConnexion($bdd, $idco);
?>

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

        <?php
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
        print(" <li class=\"active\"><a href=\"http://localhost/lion/Lion/php/contactC.php?idco=$idco\">Contact</a></li>");

        print(" <li><a href=\"http://localhost/lion/Lion/php/panier.php?idco=$idco\" >Panier</a></li>");
        print(" <li ><a href=\"http://localhost/lion/Lion/php/moncompte.php?idco=$idco\" >Mon compte</a></li>");
        print(" <li><a href=\"http://localhost/lion/Lion/php/deconnexion.php?idco=$idco\" >Se déconnecter</a></li>");
        echo'  </ul>
                    </nav>
                </div>
            </div>

        </header>';
        ?>
        <!-- Header End -->


        <!-- Contact Section
          ================================================== -->


        <div class="row section-head">
            <div class="col full">
                <h2 style="margin : 65px ; color : #11ABB0; text-align : center"> Contact Us</h2>

            </div>
        </div>

        <div class="row">

            <div class="col g-7">
<?php
$path = $_SERVER['PHP_SELF'];
$file = basename($path);
if (strcmp($file, 'verifContactC.php') == 0) {
    echo'<h7 style="color : #FF0000;">ERREUR ! SAISIR A NOUVEAU LES INFORMATIONS </h7>';
}
?>
                <!-- form -->
                <form name="contactForm" id="contactForm" method="post" action="verifContactC.php">
                    <fieldset>

                        <div>
                            <label for="contactName"><FONT style="color :#BEBEBE">Nom <span class="required">*</span></label>
                            <input name="contactName" type="text" id="contactName" size="35" value="" />
                        </div>

                        <div>
                            <label for="contactEmail"><FONT style="color :#BEBEBE">E-mail <span class="required">*</span></label>
                            <input name="contactEmail" type="text" id="contactEmail" size="35" value="" />
                        </div>

                        <div>
                            <label for="contactSubject"><FONT style="color :#BEBEBE">Sujet</label>
                            <input name="contactSubject" type="text" id="contactSubject" size="35" value="" />
                        </div>

                        <div>
                            <label  for="contactMessage"><FONT style="color :#BEBEBE">Message <span class="required">*</span></label>
                            <textarea name="contactMessage"  id="contactMessage" rows="15" cols="50" ></textarea>
                        </div>

                        <div>

<?php print("   <input name=\"idco\" type=\"hidden\" id=\"idco\" size=\"35\" value=\"$idco\" />"); ?>
                        </div>


                        <div>
                            <button class="submit">Envoyer</button>
                            <span id="image-loader">
                                <img src="images/loader.gif" alt="" />
                            </span>
                        </div>

                    </fieldset>
                </form> <!-- Form End -->

                <!-- contact-warning -->
                <div id="message-warning"></div>
                <!-- contact-success -->
                <div id="message-success">
                    <i class="icon-ok"></i>Votre message a bien été envoyé, Merci!<br />
                </div>

            </div>


            <aside class="col g-5">

                <h3><FONT style="color :#949596">Contactez-nous en utilisant le formulaire ci-contre ou bien à l'adresse ci-dessous.</br></h3>

                <p> </p>

                <p style="text-align : center">
                    <b> Lions Clubs International <br/>
                        Maison des Lions de France <br/>
                        295, rue Saint Jacques <br/>
                        75005 Paris - FRANCE <br/></b>
                </p>

                <p style="text-align : center">
                    <b> Téléphone: 01 46 34 14 10<br /></b>

                </p><br />



            </aside>

        </div>

    </section> <!-- Contact Section End-->

    <!-- footer
    ================================================== -->
<?php
affichefooter();
?>
    <!-- Footer End-->

    <!-- Java Script
    ================================================== -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.10.2.min.js"><\/script>')</script>
    <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>

    <script src="js/scrollspy.js"></script>
    <script src="js/jquery.flexslider.js"></script>
    <script src="js/jquery.reveal.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
    <script src="js/gmaps.js"></script>
    <script src="js/init.js"></script>
    <script src="js/smoothscrolling.js"></script>

</body>

</html>