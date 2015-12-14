


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
        $idco = $_GET['idco'];

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
        print(" <li class=\"active\"><a href=\"http://localhost/lion/Lion/php/homeC.php?idco=$idco\">Home</a></li>");
        print(" <li ><a href=\"http://localhost/lion/Lion/php/agendaC.php?idco=$idco\">Agenda</a></li>");
        print(" <li ><a href=\"http://localhost/lion/Lion/php/infoC.php?idco=$idco\">Info</a></li>");
        print(" <li ><a href=\"http://localhost/lion/Lion/php/contactC.php?idco=$idco\">Contact</a></li>");

        print(" <li><a href=\"http://localhost/lion/Lion/php/panier.php?idco=$idco\" > Panier</a></li>");
        print(" <li><a href=\"http://localhost/lion/Lion/php/moncompte.php?idco=$idco\" > Mon compte</a></li>");
print(" <li><a href=\"http://localhost/lion/Lion/php/deconnexion.php?idco=$idco\" >Se déconnecter</a></li>");
        echo'  </ul>
                    </nav>
                </div>
            </div>

        </header>';
        ?>

        <!-- Header End -->
        <!-- Intro Section
            ================================================== -->
        <section id="intro">

            <!-- Flexslider Start-->
            <div id="intro-slider" class="flexslider">

                <ul class="slides">

                    <!-- Slide -->
                    <li>
                        <div class="row">
                            <div class="col full">
                                <div class="slider-text">
                                    <h2>Bienvenue sur le site de réservations d'activités du 
                                        <br>colloque Nantais organisé par le Lions Clubs<FONT size="5pt">®</FONT></h2>

                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Slide -->
                    <li>
                        <div class="row">
                            <div class="col full">
                                <div class="slider-text">
                                    <h2><FONT size="7pt"> Ne ratez pas cet événement !</FONT>
                                        <br><FONT size="6pt"><span>Du vendredi 23 Mai au dimanche 25 Mai 2016</span></FONT><br/></h2>

                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
            <!-- Flexslider End-->

        </section> <!-- Intro Section End-->


        <!-- Services Section
        ================================================== -->
        <section id="services">

            <div class="row section-head">

                <div class="col one-third">
                    <h2>Le Lions Club</h2>
                    <p class="desc">Présentation</p>
                </div>

                <div class="col two-thirds">

                    <div class="intro" style="text-align:justify; text-indent: 50px;">
                        <p>Sans considération d’ethnie, de religion ou de politique, les Lions interviennent aux niveaux local, régional, national et international afin d’apporter des solutions concrètes à des problématiques sociales, médicales, éducatives et environnementales. </br>
                        </p>
                    </div>	

                    <div class="intro" style="text-align:justify; text-indent: 50px;">
                        <p>Les campagnes de collecte de fonds permettent, grâce à l’engagement des Lions, de lancer des programmes de grande envergure. Des causes qui font sens mobilisent ses membres qui organisent, promeuvent et animent les 5 000 manifestations annuelles proposées dans l’Hexagone. </p>
                    </div>

                    <div class="intro" style="text-align:justify; text-indent: 50px;">
                        <p>Ces actes concrets visent à apporter soutien et écoute aux plus démunis et à améliorer leur vie. </p>
                    </div>

                    <div class="intro" style="text-align:justify; text-indent: 50px;">
                        <p>Encourager le civisme, la compréhension entre les peuples, être fidèle au code de déontologie du club, participer à une plate-forme de libre discussion sur tous les sujets d’intérêt commun, favoriser la fraternisation et la convivialité entre les clubs, telles sont les grandes missions que chaque Lion remplit afin d’être utile au plus grand nombre.</p> 
                    </div> 

                </div>

            </div>



        </section> <!-- Services Section End -->




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