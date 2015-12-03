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
        <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="home.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap">

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li ><a href="home.php">Home</a></li>
                            <li ><a href="agenda.php">Agenda</a></li>
                            <li><a href="info.php">Informations pratiques</a></li>
                            <li><a href="contact.php">Contact</a></li>

                            <li class="active"><a href="inscription.php" style="font-weight:bold; align :right""><FONT size="4pt">Connexion/Inscription</FONT></a></li>
                        </ul>

                    </nav>

                </div>

            </div>

        </header> <!-- Header End -->




        <!-- Inscription Section
          ================================================== -->





        <div class="row">

            <div class="col g-7" style="top: 80px">

                <div class="row section-head">
                    <div class="col full" >
                        <h2 style="color : #11ABB0;"> S'inscrire</h2> 
                    </div>
                </div>

                <!-- form -->
                <form name="contactForm" id="contactForm" method="post"  action="verif.php">
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
                            <button name="v1" id="v1" class="submit">Valider</button>
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
    <footer>

        <div class="row">

            <br> <div class="col g-7">
                <ul class="copyright">
                    <li>&copy; 2014 Kreative</li>
                    <li>Design by <a href="http://www.styleshout.com/" title="Styleshout">Styleshout</a></li>               
                </ul>
            </div>

            <div class="col g-5 pull-right">
                <ul class="social-links">
                    <li><a href="#"><i class="icon-facebook"></i></a></li>
                    <li><a href="#"><i class="icon-twitter"></i></a></li>
                    <li><a href="#"><i class="icon-google-plus-sign"></i></a></li>
                    <li><a href="#"><i class="icon-linkedin"></i></a></li>
                    <li><a href="#"><i class="icon-skype"></i></a></li>
                    <li><a href="#"><i class="icon-rss-sign"></i></a></li>
                </ul>
            </div>

        </div>

    </footer> <!-- Footer End-->

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