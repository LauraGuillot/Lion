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
       <?php include("header1.php"); ?>
        <!-- Header End -->




        <!-- Inscription Section
          ================================================== -->




        <div class="row">

            <div class="col g-7" style="top: 80px">

                <div class="row section-head">
                    <div class="col full" >
                        <h2 style="color : #11ABB0;"> S'inscrire</h2> 
                    </div>
                </div>

                <h7 style="color : #FF0000;"> ERREUR ! SAISIR A NOUVEAU LES INFORMATIONS</h7>
                <!-- form -->
                <form name="contactForm" id="contactForm" method="post" action="verif.php" >
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
                            <button class="submit">Valider</button>
                            <span id="image-loader">
                                <img src="images/loader.gif" alt="" />
                            </span>
                        </div>

                    </fieldset>
                </form> 

                <!-- Form End -->

                <!-- contact-warning -->
                <div id="message-warning"></div>
                <!-- contact-success -->
                <div id="message-success">
                    <i class="icon-ok" href="inscription2.php"></i><br />
                </div>

            </div>


            <aside class="col g-5" style="top: 80px">

                <div class="row section-head">
                    <div class="col full" >
                        <h2 style="color : #11ABB0;"> Se connecter</h2> 
                    </div>
                </div>

                <!-- form -->
                <form name="contactForm" id="contactForm" method="post" action="" >
                    <fieldset >

                        <div>
                            <label for="contactEmail">Adresse e-mail <span class="required">*</span></label>
                            <input name="contactEmail" type="mail" id="mail" size="35" value="" style = "padding: 18px 18px; margin : 0 0 24px 0; color : #738182; background : #CFD4D5; border : 0" />
                        </div>

                        <div>
                            <label for="contactSubject">Mot de passe<span class="required">*</span></label>
                            <input name="contactSubject" type="password" id="mdp" size="35" value="" />
                        </div>


                        <div>
                            <button class="submit">Valider</button>
                            <span id="image-loader">
                                <img src="images/loader.gif" alt="" />
                            </span>
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
        <br></br>
        
        <?php include("footer.php"); ?>
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