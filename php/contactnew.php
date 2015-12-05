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
                            <li class="active"><a href="contact.php">Contact</a></li>

                            <li><a href="inscription.php" style="font-weight:bold; align :right""><FONT size="4pt">Connexion/Inscription</FONT></a></li>
                        </ul>

                    </nav>

                </div>

            </div>

        </header> <!-- Header End -->


        <!-- Contact Section
          ================================================== -->


        <div class="row section-head">
            <div class="col full">
                <h2 style="margin : 65px ; color : #11ABB0; text-align : center"> Contact Us</h2>

            </div>
        </div>

        <div class="row">

            <div class="col g-7">

                <!-- form -->
                <form name="contactForm" id="contactForm" method="post" action="verifContact.php">
                    <fieldset>
                        <h7 style="color : #FF0000;"> ERREUR ! SAISIR A NOUVEAU LES INFORMATIONS</h7>
                        <div>
                            <label for="contactName">Nom <span class="required">*</span></label>
                            <input name="contactName" type="text" id="contactName" size="35" value="" />
                        </div>

                        <div>
                            <label for="contactEmail">E-mail <span class="required">*</span></label>
                            <input name="contactEmail" type="text" id="contactEmail" size="35" value="" />
                        </div>

                        <div>
                            <label for="contactSubject">Sujet</label>
                            <input name="contactSubject" type="text" id="contactSubject" size="35" value="" />
                        </div>

                        <div>
                            <label  for="contactMessage">Message <span class="required">*</span></label>
                            <textarea name="contactMessage"  id="contactMessage" rows="15" cols="50" ></textarea>
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

                <h3>Contactez-nous en utilisant le formulaire ci-contre ou bien à l'adresse ci-dessous.</br></h3>

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