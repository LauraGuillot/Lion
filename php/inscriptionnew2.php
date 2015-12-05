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

        <div class="row section-head">
            <div class="col full" style="top: 80px">
                <h2 style="color : #11ABB0;"> Inscription 2/3</h2> 
            </div>
        </div>


        <div class="row">

            <div class="col g-7"style="top: 80px">

                <!-- form -->
                <form name="contactForm" id="contactForm" method="post" action="validationInscription2.php">
                    <fieldset>
                        <div>
                            <h7 style="color : #FF0000;"> ERREUR - VEUILLEZ REMPLIR TOUS LES CHAMPS OBLIGATOIRES</h7>
                            <br></br>	
                        </div>
                        <div class="row section-head">

                            <h2 >Civilité</h2>
                        </div>


                        <div style="color:#3d4145; font : 14px/24px opensans-bold, sans-serif; margin : 12px 0">
                            <FORM>
                                <INPUT type="radio" name="civilite" value="1"> Mlle
                                <INPUT type="radio" name="civilite" value="2"> Mme
                                <INPUT type="radio" name="civilite" value="3" > M.
                            </FORM>
                        </div>
                        <div>
                            <label for="contactSubject">Prénom<span class="required">*</span></label>
                            <input name="prenom" type="text" id="prenom" size="35" value="" />
                        </div>

                        <div>
                            <label for="contactSubject">Nom<span class="required">*</span></label>
                            <input name="nom" type="text" id="nom" size="35" value="" />
                        </div>
                        <div class="row section-head">

                            <div class="row section-head">

                                <h2 >Statut dans le club</h2>
                            </div>

                            <div style="color:#3d4145; font : 14px/24px opensans-bold, sans-serif; margin : 12px 0">
                                <FORM>
                                    <INPUT type="radio" name="titre" value="1"> Lion
                                    <INPUT type="radio" name="titre" value="2"> Leo

                                </FORM>
                            </div>
                            <div style="color:#3d4145; font : 14px/24px opensans-bold, sans-serif; margin : 12px 0;">
                                <p></br> District<span class="required" style="color:#8B9798">*</span></p>
                            </div>
                            <div>
                                <FORM>
                                    <SELECT name="district" >
                                        <OPTION> CENTRE
                                        <OPTION> CENTRE - EST
                                        <OPTION> CENTRE - OUEST
                                        <OPTION> CENTRE - SUD
                                        <OPTION> COTE D'AZUR
                                        <OPTION> CORSE
                                        <OPTION> EST
                                        <OPTION> ILE DE FRANCE - EST
                                        <OPTION> ILE DE FRANCE - OUEST
                                        <OPTION> ILE DE FRANCE - PARIS
                                        <OPTION> NORD
                                        <OPTION> NORMANDIE
                                        <OPTION> OUEST
                                        <OPTION> SUD
                                        <OPTION> SUD-EST
                                        <OPTION> SUD-OUEST
                                        <OPTION> AUTRE
                                    </SELECT>
                                </FORM>


                            </div>

                            <div>
                                <label for="contactSubject">Club<span class="required">*</span></label>
                                <input name="club" type="text" id="club" size="35" value="" />
                            </div>
                            <div class="row section-head">

                                <h2 >Coordonnées</h2>
                            </div>
                            <div>
                                <label for="contactSubject">Rue<span class="required">*</span></label>
                                <input name="rue" type="text" id="rue" size="35" value="" />
                            </div>

                            <div>
                                <label for="contactSubject">N°<span class="required">*</span></label>
                                <input name="num" type="text" id="num" size="35" value="" />
                            </div>

                            <div>
                                <label for="contactSubject">Code Postal<span class="required">*</span></label>
                                <input name="cp" type="text" id="cp" size="5" value="" />
                            </div>

                            <div>
                                <label for="contactSubject">Ville<span class="required">*</span></label>
                                <input name="ville" type="text" id="ville" size="35" value="" />
                            </div>

                            <div>
                                <label for="contactSubject">Pays<span class="required">*</span></label>
                                <input name="pays" type="text" id="pays" size="35" value="" />
                            </div>

                            <div>
                                <label for="contactSubject">Téléphone<span class="required">*</span></label>
                                <input name="tel" type="tel" id="tel" size="35" value="" style = "padding: 18px 18px; margin : 0 0 24px 0; color : #738182; background : #CFD4D5; border : 0" />
                            </div>
                            <div>
                                <label for="contactSubject">Portable</label>
                                <input name="portable" type="tel" id="portable" size="35" value="" style = "padding: 18px 18px; margin : 0 0 24px 0; color : #738182; background : #CFD4D5; border : 0"/>
                            </div>



                            <input type="submit" name="v2" value="Valider">
                            <br></br>
                            <br></br>
                        </div>

                    </fieldset>
                </form> 

                <!-- Form End -->



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