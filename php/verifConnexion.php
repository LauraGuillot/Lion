<?php

$mail = $_POST['mail'];
$mdp = $_POST['mdp'];

function testConnexion($bdd, $mail, $mdp) {
    try {
        /* Préparation de la requête */
        $stmt = $bdd->prepare("SELECT Person.Person_ID FROM Person INNER JOIN Member ON (Person.Person_ID = Member.Person_ID) WHERE (Member_EMail='$mail' AND Member_Password ='$mdp');", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));

        /* Exécution de la requête */
        $stmt->execute(array());

        /* Exploitation des résultats */

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
            include("header1.php");

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
        } else {/* Si il y a un résultat, connexion + mise à jour de la date de dernière connexion */
            foreach ($res as $ligne) {

                $id = $ligne["Person_ID"];
                $stmt2 = $bdd->prepare("UPDATE Connexion SET Last_Connexion = NOW() WHERE Connexion_ID =(SELECT Connexion_ID FROM Member WHERE (Person_ID = $id))");
                $stmt2->execute();

                $req3 = $bdd->prepare("SELECT Connexion_ID FROM Member WHERE (Person_ID = $id)", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
                $req3->execute(array());
                $row = $req3->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
                $idco = $row["Connexion_ID"];
     
            }
            
            echo"<a href=\"http://localhost/lion/Lion/php/homeC.php?idco=$idco\" > Connexion effectuée ! </a>"; 

           /* include 'homeC.php';*/
        }
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
}

$bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', '');
testConnexion($bdd, $mail, $mdp);
?>