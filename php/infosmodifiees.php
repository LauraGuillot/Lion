<?php

include "fonctions.php";
$idco = $_POST['idco'];

                        $email = $_POST['email'];
                        $nom = $_POST['nom'];
                        $prenom = $_POST['prenom'];
                        $rue = $_POST['rue'];
                        $num = $_POST['num'];
                        $cadr = $_POST['cadr'];
                        $cp = $_POST['cp'];
                        $ville = $_POST['ville'];
                       
                        $tel = $_POST['tel'];
                        $portable = $_POST['portable'];
                    
                        
                        miseajourinfos($bdd,$idco,$email,$nom,$prenom,$rue,$num,$cadr,$cp,$ville,$tel,$portable);

 echo ' 
                        
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
';
       

 
   echo "  
         <header class=\"mobile\">

       <div class=\"row\">

         <div class=\"col full\">

                    <div class=\"logo\">
       
<a href=\"http://localhost/lion/Lion/php/homeC.php?idco=$idco\" style=\"top : 4px\"><img alt=\"\" src=\"images/logo.png\" style=\"height:  50px; width: 55px; top: 4px\"></a>
        </div>

                    <nav id=\"nav-wrap\" >

                        <a class=\"mobile-btn\" href=\"#nav-wrap\" title=\"Show navigation\">Show navigation</a>
                        <a class=\"mobile-btn\" href =\"#\"title=\"Hide navigation\">Hide navigation</a>

                        <ul id=\"nav\" class=\"nav\" style = \"margin-left :76px\"> 
        <li ><a href=\"http://localhost/lion/Lion/php/homeC.php?idco=$idco\">Home</a></li>
       <li ><a href=\"http://localhost/lion/Lion/php/agendaC.php?idco=$idco\">Agenda</a></li>
         <li  ><a href=\"http://localhost/lion/Lion/php/infoC.php?idco=$idco\">Info</a></li>
        <li ><a href=\"http://localhost/lion/Lion/php/contactC.php?idco=$idco\">Contact</a></li>

        <li ><a href=\"http://localhost/lion/Lion/php/panier.php?idco=$idco\" > Panier</a> </li>
        <li   class=\"active\"><a href=\"http://localhost/lion/Lion/php/moncompte.php?idco=$idco\" > Mon compte</a></li>
        </li>


        <li ><a href=\"http://localhost/lion/Lion/php/deconnexion.php?idco=$idco\" > Se déconnecter</a></li>

        </ul>
                    </nav>
                </div>
            </div>";

        /* Sous onglets */
       echo "<div class=\"row\">

        <div class=\"col full\">

                    <nav id=\"nav-wrap\" style=\"position:absolute ;right:300px  \">

                        <a class=\"mobile-btn\" href=\"#nav-wrap\" title=\"Show navigation\">Show navigation</a>
                        <a class=\"mobile-btn\" href=\"#\" title=\"Hide navigation\">Hide navigation</a>

                        <ul id=\"nav\" class=\"nav\" >
       <li  class=\"active\"><a href=\"http://localhost/lion/Lion/php/infoperso.php?idco=$idco\"> Informations personnelles</a></li>
        <li><a href=\"http://localhost/lion/Lion/php/achats.php?idco=$idco\"> Mes achats</a></li>
        <li   ><a href=\"http://localhost/lion/Lion/php/commandes.php?idco=$idco\"> Mes commandes</a></li>
       
         </ul>
        </nav>
                </div>
            </div>

       </header>
        




        <!-- Header End -->

        <!-- informations Section
             ================================================== -->

        <div class=\"row section-head\">
            <div class=\"col full\">
                <br></br>
                <br></br>
                <h2 style=\"margin : 65px ; color : #11ABB0; text-align : center\"> Vos informations personnelles </h2>
            </div>
";
           
          
            afficheInfos($bdd, $idco);
            majConnexion($bdd, $idco);
           
     
echo " 
     
        <form name=\"modifinfo\" id=\"mod\" method=\"post\"  action=\"infopersomodif.php\">
        <div>
            <br></br>
            
            <input type=\"submit\" name=\"boutonmodif\" value=\"Modifier mes informations\">";
            
            
            print("<input type=\"hidden\"  name=\"idco\" value=\"$idco\">");
               echo " 
               </div>
        </div>
        </form>
        </div>


        <!-- Section End-->




        <!-- footer
        ================================================== -->
<?php affichefooter(); ?>
        <!-- Footer End-->

        <!-- Java Script
        ================================================== -->
        <script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js\"></script>
        <script>window.jQuery || document.write('<script src=\"js/jquery-1.10.2.min.js\"><\/script>')</script>
        <script type=\"text/javascript\" src=\"js/jquery-migrate-1.2.1.min.js\"></script>

        <script src=\"js/scrollspy.js\"></script>
        <script src=\"js/jquery.flexslider.js\"></script>
        <script src=\"js/jquery.reveal.js\"></script>
        <script src=\"http://maps.google.com/maps/api/js?sensor=true\" type=\"text/javascript\"></script>
        <script src=\"js/gmaps.js\"></script>
        <script src=\"js/init.js\"></script>
        <script src=\"js/smoothscrolling.js\"></script>

    </body>

</html>";

