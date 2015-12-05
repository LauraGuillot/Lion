
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

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li><a href="home.php">Home</a></li>
                            <li><a href="agenda.php">Agenda</a></li>
                            <li><a href="info.php">Informations pratiques</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li align="right"><a href="panier.php" style="font-weight:bold; align :right"><FONT size="4pt"> Panier</FONT></a></li>
                            <li align="right"><a href="panier.php" style="font-weight:bold; align :right"><FONT size="4pt"> Mon compte</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header> <!-- Header End -->

        <!-- Choix paiement Section
             ================================================== -->
        <br>
        <div class="row section-head">
            <div class="col full">
                <h2 style="margin : 65px ; color : #11ABB0; text-align : center"> Choisissez votre mode de paiement </h2>

            </div>
        </div>

    <center>
        <form name="PaiementForm" id="PaiementForm" method="post" action="">
            <fieldset>
                <div style="color:#3d4145; font : 20px/30px opensans-bold, sans-serif; margin : 12px 0">
                    <FORM>
                        <INPUT width=450px type="radio" name="typePaiement" value="1" checked> Carte bleue <br></br>        
                        <INPUT width=450px type="radio" name="typePaiement" value="2"> Chèque
                    </FORM>
                </div>


                <br></br>
                <input type="submit" name="valid" value="Valider">

            </fieldset>
        </form>   
    </center>

    <br></br>
    <!-- Section End-->


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
