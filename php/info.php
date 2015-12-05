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

        <!-- Info section
        ================================================== --> 

        <div class="row section-head">
            <div class="col full">
                <span><h2 style = "color :#11ABB0; margin : 65px; text-align : center">Informations pratiques</h2><span>
                        </div>

                        <div class="col one-third">
                            <h2> Dates du colloque</h2>        
                        </div>

                        <div class="col two-thirds">

                            <div class="intro" style="text-align:justify;">
                                <p> Du vendredi 23 mai au dimanche 25 mai 2016
                                    <br>
                                    <br>
                                </p>
                            </div>		
                        </div>

                        <div class="col one-third">       
                            <h2> Adresse </h2>      
                            <p> (Voir plan ci-dessous) </p>
                        </div>

                        <div class="col two-thirds">

                            <div class="intro" style="text-align:justify;">
                                <p> Cité des Congrès <br>
                                    5 rue Valmy <br>
                                    44 041 NANTES <br>
                                    FRANCE
                                </p>
                            </div>		
                        </div>
                        </div> <!-- Info Section End-->


                        <!-- Map Section
                         ================================================== -->	 
                        <section id="map">
                            <p class="map-error">Something went wrong... Unable to load map... Please try to enable javascript</p>

                        </section> <!-- Map Section End-->

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