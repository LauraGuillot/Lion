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

        <?php include "fonctions.php";
        afficheHeader();
        ?>
    </head>



    <body data-spy="scroll" data-target="#nav-wrap">

        <div class="row section-head">
            <div class="col full" style="top: 80px">
                <h2 style="color : #11ABB0;"> Inscription 3/4</h2> 
            </div>
        </div>


        <div class="row">

            <div class="col g-7"style="top: 80px">


                <?php
                $path = $_SERVER['PHP_SELF'];
                $file = basename($path);
                if (strcmp($file, 'verif2bis.php') == 0) {
                    echo'<h7 style="color : #FF0000;">ERREUR ! SAISIR A NOUVEAU LES INFORMATIONS </h7>';
                }
                ?>

                <?php
                if(strcmp($file, 'verif2.php')==0){
                echo'
                <form name="contactForm" id="contactForm" method="post" action="verif2bis.php">';

                
                    $email = $_POST['email'];
                    $mdp = $_POST['mdp'];
                    $mdp2 = $_POST['mdp2'];
                    $civilite = $_POST['civilite'];
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $titre = $_POST['titre'];
                    $district = $_POST['district'];
                    
                    
                    
                   

                    print("<input type=\"hidden\" name=\"email\" value=\"$email\"/>");
                    print("<input type=\"hidden\" name=\"mdp\" value=\"$mdp\"/>");
                    print("<input type=\"hidden\" name=\"mdp2\" value=\"$mdp2\"/>");
                    print("<input type=\"hidden\" name=\"civilite\" value=\"$civilite\"/>");
                    print("<input type=\"hidden\" name=\"nom\" value=\"$nom\"/>");
                    print("<input type=\"hidden\" name=\"prenom\" value=\"$prenom\"/>");
                    print("<input type=\"hidden\" name=\"titre\" value=\"$titre\"/>");
                    print("<input type=\"hidden\" name=\"district\" value=\"$district\"/>");
                    

echo'
                    <div style="color:#3d4145; font : 14px/24px opensans-bold, sans-serif; margin : 12px 0;">
                        <p></br> Club<span class="required" style="color:#8B9798">*</span></p>
                    </div>';

                  
                    afficheClub($bdd, $district);
                     
echo'
                    <div class="row section-head">
                        <h2 >Coordonnées</h2>
                    </div>

                    <div>
                        <label for="contactSubject">N°<span class="required">*</span></label>
                        <input name="num" type="text" id="num" size="35" value="" />
                    </div>
                    <div>
                        <label for="contactSubject">Rue<span class="required">*</span></label>
                        <input name="rue" type="text" id="rue" size="35" value="" />
                    </div>

                    <div>
                        <label for="contactSubject">Complément d\'adresse</label>
                        <input name="cadr" type="text" id="cadr" size="5" value="" />
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


                    <input type="submit" name="v2bis" value="Valider">
                    <br></br>
                    <br></br>

            </div>

        </form>

                </div>';}
                else{
                    echo'
                <form name="contactForm" id="contactForm" method="post" action="verif2bis.php">';

                
                    $email = $_POST['email'];
                    $mdp = $_POST['mdp'];
                    $mdp2 = $_POST['mdp2'];
                    $civilite = $_POST['civilite'];
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $titre = $_POST['titre'];
                    $district = $_POST['district'];
                    
                    
                    $rue = $_POST['rue'];
                    $num = $_POST['num'];
                    $cp = $_POST['cp'];
                    $ville = $_POST['ville'];
                    $pays = $_POST['pays'];
                    $tel = $_POST['tel'];
                   

                    print("<input type=\"hidden\" name=\"email\" value=\"$email\"/>");
                    print("<input type=\"hidden\" name=\"mdp\" value=\"$mdp\"/>");
                    print("<input type=\"hidden\" name=\"mdp2\" value=\"$mdp2\"/>");
                    print("<input type=\"hidden\" name=\"civilite\" value=\"$civilite\"/>");
                    print("<input type=\"hidden\" name=\"nom\" value=\"$nom\"/>");
                    print("<input type=\"hidden\" name=\"prenom\" value=\"$prenom\"/>");
                    print("<input type=\"hidden\" name=\"titre\" value=\"$titre\"/>");
                    print("<input type=\"hidden\" name=\"district\" value=\"$district\"/>");
                    

echo'
                    <div style="color:#3d4145; font : 14px/24px opensans-bold, sans-serif; margin : 12px 0;">
                        <p></br> Club<span class="required" style="color:#8B9798">*</span></p>
                    </div>';

                    
                    afficheClub($bdd, $district);
                     
echo'
                    <div class="row section-head">
                        <h2 >Coordonnées</h2>
                    </div>

                    <div>
                        <label for="contactSubject">N°<span class="required">*</span></label>
                        <input name="num" type="text" id="num" size="35" value='.$num.' />
                    </div>
                    <div>
                        <label for="contactSubject">Rue<span class="required">*</span></label>
                        <input name="rue" type="text" id="rue" size="35" value='.$rue.' />
                    </div>

                    <div>
                        <label for="contactSubject">Complément d\'adresse</label>
                        <input name="cadr" type="text" id="cadr" size="5" value="" />
                    </div>


                    <div>
                        <label for="contactSubject">Code Postal<span class="required">*</span></label>
                        <input name="cp" type="text" id="cp" size="5" value='.$cp.' />
                    </div>

                    <div>
                        <label for="contactSubject">Ville<span class="required">*</span></label>
                        <input name="ville" type="text" id="ville" size="35" value='.$ville.'/>
                    </div>

                    <div>
                        <label for="contactSubject">Pays<span class="required">*</span></label>
                        <input name="pays" type="text" id="pays" size="35" value='.$pays.' />
                    </div>

                    <div>
                        <label for="contactSubject">Téléphone<span class="required">*</span></label>
                        <input name="tel" type="tel" id="tel" size="35" value='.$tel.' style = "padding: 18px 18px; margin : 0 0 24px 0; color : #738182; background : #CFD4D5; border : 0" />
                    </div>
                    <div>
                        <label for="contactSubject">Portable</label>
                        <input name="portable" type="tel" id="portable" size="35" value="" style = "padding: 18px 18px; margin : 0 0 24px 0; color : #738182; background : #CFD4D5; border : 0"/>
                    </div>


                    <input type="submit" name="v2bis" value="Valider">
                    <br></br>
                    <br></br>

            </div>

        </form>';
                        
                }
?>

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