<!DOCTYPE html>
<!--[if lt IE 8 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 8)|!(IE)]><!--><html lang="fr"> <!--<![endif]-->
    <head>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

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
        <?php include "fonctions.php";
        afficheHeader();
        ?>
        <!-- Header End -->



        <!-- Inscription Section
          ================================================== -->

        <div class="row section-head">
            <div class="col full" style="top: 80px">
                <h2 style="color : #11ABB0;"> Inscription 2/4</h2> 
            </div>
        </div>


        <div class="row">

            <div class="col g-7"style="top: 80px">
                <?php
                $path = $_SERVER['PHP_SELF'];
                $file = basename($path);
                if (strcmp($file, 'verif2.php') == 0) {
                    echo'<h7 style="color : #FF0000;">ERREUR ! SAISIR A NOUVEAU LES INFORMATIONS </h7>';
                }
                ?>
                <!-- form -->
                <?php
                if(strcmp($file, 'verif1.php')==0){
                    
                
                echo'<form name="contactForm" id="contactForm" method="post" action="verif2.php">
                    <fieldset>';

                        
                        $email = $_POST['email'];
                        $mdp = $_POST['mdp'];
                        $mdp2 = $_POST['cmdp'];
                     
                        

                        print("<input type=\"hidden\" name=\"email\" value=\"$email\"/>");
                        print("<input type=\"hidden\" name=\"mdp\" value=\"$mdp\"/>");
                        print("<input type=\"hidden\" name=\"mdp2\" value=\"$mdp2\"/>");
                                       


                       echo' <div class="row section-head">
                            <h2 ><FONT style="color :#727374">Civilité</h2>
                        </div>

                        <div style="color:#BEBEBE; font : 14px/24px opensans-bold, sans-serif; margin : 12px 0">

                            <INPUT type="radio" name="civilite" value="1"> Mlle
                            <INPUT type="radio" name="civilite" value="2"> Mme
                            <INPUT type="radio" name="civilite" value="3" checked> M.

                        </div>

                        <div>
                            <label for="contactSubject"><FONT style="color :#BEBEBE">Prénom<span class="required">*</span></label>
                            <input name="prenom" type="text" id="prenom" size="35" value="">
                        </div>

                        <div>
                            <label for="contactSubject"><FONT style="color :#BEBEBE">Nom<span class="required">*</span></label>
                            <input name="nom" type="text" id="nom" size="35" value="">
                        </div>


                        <div class="row section-head">
                            <h2 ><FONT style="color :#727374">Statut dans le club</h2>
                        </div>

                        <div style="color:#BEBEBE; font : 14px/24px opensans-bold, sans-serif; margin : 12px 0">

                            <INPUT type="radio" name="titre" value="1" checked> Lion
                            <INPUT type="radio" name="titre" value="2" > Leo

                        </div>

                        <div style="color:#BEBEBE; font : 14px/24px opensans-bold, sans-serif; margin : 12px 0;">
                            <p></br> District<span class="required" style="color:#8B9798">*</span></p>
                        </div>

                        <div>
                            <SELECT id="district" name="district">
                                <OPTION> Choisissez votre district </OPTION>
                                <OPTION value ="CENTRE"> CENTRE </OPTION>
                                <OPTION value ="CENTRE-EST"> CENTRE-EST  </OPTION>
                                <OPTION value ="CENTRE-OUEST"> CENTRE-OUEST  </OPTION>
                                <OPTION value ="CENTRE-SUD"> CENTRE-SUD  </OPTION>
                                <OPTION value ="COTE D\'AZUR-CORSE"> COTE D\'AZUR-CORSE </OPTION>
                                <OPTION value ="EST"> EST  </OPTION>
                                <OPTION value ="ILE DE FRANCE"> ILE DE FRANCE-EST  </OPTION>
                                <OPTION value ="ILE DE FRANCE-OUEST"> ILE DE FRANCE-OUEST  </OPTION>
                                <OPTION value ="ILE DE FRANCE-PARIS"> ILE DE FRANCE-PARIS  </OPTION>
                                <OPTION value="NORD"> NORD </OPTION> 
                                <OPTION value ="NORMANDIE"> NORMANDIE  </OPTION>
                                <OPTION value ="OUEST"> OUEST  </OPTION>
                                <OPTION value ="SUD"> SUD  </OPTION>
                                <OPTION value ="SUD-EST"> SUD-EST  </OPTION>
                                <OPTION value="SUD-OUEST"> SUD-OUEST  </OPTION>
                                <OPTION value="AUTRE"> AUTRE  </OPTION>
                            </SELECT>

                        </div>                       
                            <div>
                            <input type="submit" name="v2" value="Valider">
                            <br></br>
                            <br></br>

                        </div>

                    </fieldset>
                </form>'; 
                }
                else{
                 
                 
                echo'<form name="contactForm2" id="contactForm2" method="post" action="verif2.php">
                    <fieldset>';

                        
                        $email = $_POST['email'];
                        $mdp = $_POST['mdp'];
                        $mdp2 = $_POST['mdp2'];
                     
                        $nom = $_POST['nom'];
                        $prenom = $_POST['prenom'];

                        print("<input type=\"hidden\" name=\"email\" value=\"$email\"/>");
                        print("<input type=\"hidden\" name=\"mdp\" value=\"$mdp\"/>");
                        print("<input type=\"hidden\" name=\"mdp2\" value=\"$mdp2\"/>");
                                       


                       echo' <div class="row section-head">
                            <h2 ><FONT style="color :#727374">Civilité</h2>
                        </div>

                        <div style="color:#BEBEBE; font : 14px/24px opensans-bold, sans-serif; margin : 12px 0">

                            <INPUT type="radio" name="civilite" value="1"> Mlle
                            <INPUT type="radio" name="civilite" value="2"> Mme
                            <INPUT type="radio" name="civilite" value="3" checked> M.

                        </div>

                        <div>
                            <label for="contactSubject"><FONT style="color :#BEBEBE">Prénom<span class="required">*</span></label>
                            <input name="prenom" type="text" id="prenom" size="35" value="'.$prenom.'" />
                        </div>

                        <div>
                            <label for="contactSubject"><FONT style="color :#BEBEBE">Nom<span class="required">*</span></label>
                            <input name="nom" type="text" id="nom" size="35" value="'.$nom.'" />
                        </div>


                        <div class="row section-head">
                            <h2 ><FONT style="color :#727374">Statut dans le club</h2>
                        </div>

                        <div style="color:#BEBEBE font : 14px/24px opensans-bold, sans-serif; margin : 12px 0">

                            <INPUT type="radio" name="titre" value="1" checked> Lion
                            <INPUT type="radio" name="titre" value="2" > Leo

                        </div>

                        <div style="color:#BEBEBE; font : 14px/24px opensans-bold, sans-serif; margin : 12px 0;">
                            <p></br> District<span class="required" style="color:#8B9798">*</span></p>
                        </div>

                        <div>
                            <SELECT id="district" name="district">
                                <OPTION> Choisissez votre district </OPTION>
                                <OPTION value ="CENTRE"> CENTRE </OPTION>
                                <OPTION value ="CENTRE-EST"> CENTRE-EST  </OPTION>
                                <OPTION value ="CENTRE-OUEST"> CENTRE-OUEST  </OPTION>
                                <OPTION value ="CENTRE-SUD"> CENTRE-SUD  </OPTION>
                                <OPTION value ="COTE D\'AZUR-CORSE"> COTE D\'AZUR-CORSE </OPTION>
                                <OPTION value ="EST"> EST  </OPTION>
                                <OPTION value ="ILE DE FRANCE"> ILE DE FRANCE-EST  </OPTION>
                                <OPTION value ="ILE DE FRANCE-OUEST"> ILE DE FRANCE-OUEST  </OPTION>
                                <OPTION value ="ILE DE FRANCE-PARIS"> ILE DE FRANCE-PARIS  </OPTION>
                                <OPTION value="NORD"> NORD </OPTION> 
                                <OPTION value ="NORMANDIE"> NORMANDIE  </OPTION>
                                <OPTION value ="OUEST"> OUEST  </OPTION>
                                <OPTION value ="SUD"> SUD  </OPTION>
                                <OPTION value ="SUD-EST"> SUD-EST  </OPTION>
                                <OPTION value="SUD-OUEST"> SUD-OUEST  </OPTION>
                                <OPTION value="AUTRE"> AUTRE  </OPTION>
                            </SELECT>

                        </div>                       
                            <div>
                            <input type="submit" name="v2" value="Valider">
                            <br></br>
                            <br></br>

                        </div>

                    </fieldset>
                </form>';
                }
               
                ?>
                <!-- Form End -->

            </div>

        </div>



        <!-- Contact Section End-->

        <!-- footer
        ================================================== -->

<?php affichefooter(); ?>
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
