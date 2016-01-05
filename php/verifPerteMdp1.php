<?php

$mail = $_POST['mail'];

include 'fonctions.php';

 $sql = "SELECT  Count(Member_ID) FROM Member WHERE (Member_Email = '$mail')   ";
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Member_ID)"];


if (empty($cpt)){
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
                <br><br><br>
                <div class="row section-head">
                    <div class="col full" >
                        <h2 style="color : #11ABB0;" > Nous allons vous envoyer un email pour réinitialiser votre mot de passe </h2> 
                        <h7 style="color : #FF0000;"> ADRESSE MAIL INVALIDE OU INCONNUE</h7>
</div>

                </div>
                <!-- form -->
                <form name="initMdp" id="initMdp" method="post"  action="verifPerteMdp1.php">
                    <fieldset >
                        <div>
                            <label for="contactSubject"> Adresse Mail <span class="required">*</span></label>
                            <input name="mail" type="text" id="mail" size="35" value="" />
                        </div>

                        <div>
                            <input type="submit" name="v" value="Valider">
                        </div>

                    </fieldset>
                </form> 
            </div>
        </section> <!-- Inscription Section End-->

        <!-- footer
        ================================================== -->
        <br>';
 affichefooter(); echo' 
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
 
    }else {
        include 'mailInitMdp.php';
    }