<?php

if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Bonjour,
Vous avez oublié votre mot de passe et vous voulez le réinitialiser ?
Rendez-vous sur le lien ci-dessous pour entrer un nouveau mot de passe : http://localhost/lion/Lion/php/perteMdp.php";
//==========
 
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = "Réinitialisation du mot de passe - Lions Clubs";
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"Laura \"<lolo-guillot@hotmail.fr>".$passage_ligne;
$header.= "Reply-to: \"Laura\" <lolo-guillot@hotmail.fr>".$passage_ligne; 
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========
 
//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
//==========




//Retour sur la page de connexion

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
        ================================================== -->';
        
        afficheHeader();
       echo' 
        <!-- Header End -->

        <!-- Inscription Section
          ================================================== -->
        <section>
            <div class="row">

                <div class="col g-7" style="top: 80px">

                    <div class="row section-head">
                        <div class="col full" >
                            <h2 style="color : #11ABB0;"> S\'inscrire</h2> 
                        </div>
                    </div>
';
                    
                    $path = $_SERVER['PHP_SELF'];
                    $file = basename($path);
                    if (strcmp($file, 'verif1.php') == 0) {
                        echo'<h7 style="color : #FF0000;">' . $erreur . '</h7>';
                    }
                   echo ' 
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
                </div>


                <aside class="col g-5" style="top: 80px">

                    <div class="row section-head">
                        <div class="col full" >
                            <h2 style="color : #11ABB0;"> Se connecter</h2> 
                        </div>
                    </div>

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

                            <div>
                                <br>
                                <button name="v1" id="v1" class="submit">Valider</button>
                            </div>

                        </fieldset>
                    </form> 
                </aside>

            </div>

        </section> <!-- Inscription Section End-->

        <!-- footer
        ================================================== -->
        <br>';
affichefooter(); 
     echo'   <!-- Footer End-->

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
?>

