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
                            <li class="active"><a href="agenda.php">Agenda</a></li>
                            <li><a href="info.php">Informations pratiques</a></li>
                            <li><a href="contact.php">Contact</a></li>

                            <li><a href="inscription.php" style="font-weight:bold; align :right""><FONT size="4pt">Connexion/Inscription</FONT></a></li>
                        </ul>

                    </nav>

                </div>

            </div>

        </header> <!-- Header End -->

        <!-- Planning Section
          ================================================== -->
       
   <?php include("affichageAgenda1.php"); ?>
        
                    <!-- Section End -->

                    <!-- footer
                    ================================================== -->
                    <?php include("footer.php"); ?>
                    <!-- Footer End-->





                    </body>

                    </html>