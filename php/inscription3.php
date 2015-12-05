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
                            <li><a href="agenda.php">Agenda</a></li>
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

        <div class="row section-head">
            <div class="col full" style="top: 80px">
                <h2 style="color : #11ABB0;"> Inscription 3/3 </h2> 
            </div>
        </div>


        <div class="row">

            <div class="col g-7"style="top: 80px">

                <!-- form -->
                <form name="contactForm" id="contactForm" method="post" action="verif.php" style = "width : 1000px">
                    <fieldset>

                        <div class="row section-head">

                            <h2 >Fonction</h2>
                        </div>
                        <div>
                            <label for="contactSubject">Au niveau club<span class="required">*</span></label>
                            <input name="fClub" type="text" id="fClub" size="35" value="" />
                        </div>

                        <div>
                            <label for="contactSubject">Au niveau district<span class="required">*</span></label>
                            <input name="fDistrict" type="text" id="fDistrict" size="35" value="" />
                        </div>

                        <div class="row section-head">

                            <h2 >Accompagnant (non-Lion)</h2>
                        </div>

                        <div>
                            <label for="contactSubject">Prénom</label>
                            <input name="prenomAcc" type="text" id="prenomAcc" size="35" value="" />
                        </div>

                        <div>
                            <label for="contactSubject">Nom</label>
                            <input name="nomAcc" type="text" id="nomAcc" size="35" value="" />
                        </div>
                        <div class="row section-head">

                            <h2 >Accueil</h2>
                        </div>

                        <div style="color:#3d4145; font : 18px/28px opensans-bold, sans-serif; margin : 12px 0">
                            <FORM>
                                <INPUT type="checkbox" name="train" value="1"> Arrivée en train (Des navettes seront disponibles pour rejoindre votre hôtel)
                            </FORM>
                        </div>

                        <div style="color:#3d4145; font : 18px/28px opensans-bold, sans-serif; margin : 12px 0">
                            <p></br> Merci de préciser votre date et heure d'arrivée : </p>
                        </div>
                        <div>
                            <label for="contactSubject">Date</label>
                            <input name="traindate" type="date" id="trainDate" size="35" value="" style = "padding: 18px 18px; margin : 0 0 15px 0; color : #738182; background : #CFD4D5; border : 0"/>
                        </div>

                        <div>
                            <label for="contactSubject">Heure</label>
                            <input name="trainheure" type="time" id="trainHeure" size="35" value="" style = "padding: 18px 18px; margin : 0 0 24px 0; color : #738182; background : #CFD4D5; border : 0"/>
                        </div>

                        <input type="submit" name="v3" value="Valider">
                        </div>

                    </fieldset>
                </form> 

                <!-- Form End -->

                <!-- contact-warning -->
                <div id="message-warning"></div>
                <!-- contact-success -->
                <div id="message-success">
                    <i class="icon-ok" href=""></i><br />
                </div>

            </div>




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