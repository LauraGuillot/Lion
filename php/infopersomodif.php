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
        include "fonctions.php";
        $idco = $_POST['idco'];
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
        print(" <li ><a href=\"http://localhost/lion/Lion/php/homeC.php?idco=$idco\">Home</a></li>");
        print(" <li ><a href=\"http://localhost/lion/Lion/php/agendaC.php?idco=$idco\">Agenda</a></li>");
        print(" <li  ><a href=\"http://localhost/lion/Lion/php/infoC.php?idco=$idco\">Info</a></li>");
        print(" <li ><a href=\"http://localhost/lion/Lion/php/contactC.php?idco=$idco\">Contact</a></li>");

        print(" <li ><a href=\"http://localhost/lion/Lion/php/panier.php?idco=$idco\" > Panier</a>");
        print(" <li   class=\"active\"><a href=\"http://localhost/lion/Lion/php/moncompte.php?idco=$idco\" > Mon compte</a></li>");
        print("</li>");


        print(" <li ><a href=\"http://localhost/lion/Lion/php/deconnexion.php?idco=$idco\" > Se déconnecter</a></li>");

        echo'  </ul>
                    </nav>
                </div>
            </div>';

        /* Sous onglets */
        echo'<div class="row">

        <div class="col full">

                    <nav id="nav-wrap" style="position:absolute ;right:300px  ">

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav" >';
        print(" <li  class=\"active\"><a href=\"http://localhost/lion/Lion/php/infoperso.php?idco=$idco\"> Informations personnelles</a></li>");
        print(" <li><a href=\"http://localhost/lion/Lion/php/achats.php?idco=$idco\"> Mes achats</a></li>");
        print(" <li   ><a href=\"http://localhost/lion/Lion/php/commandes.php?idco=$idco\"> Mes commandes</a></li>");
        echo' 
         </ul>
        </nav>
                </div>
            </div>

       </header>';
        ?>
        
        <!-- Header End -->
        <?php
        
        /* Récupération des données personnelles du membre */
        $sql = 'SELECT Member.Member_ID, Person_Lastname, Person_Firstname, Member_Title, Member_Status, District_Name, Club_Name, '
                . ' Member_Num, Member_Additional_Adress, Member_Street, Member_City, Member_Postal_Code, Member_Phone, '
                . ' Member_Mobile, Member_EMail, Member_Position_Club, Member_Position_District, Member_By_Train, Member_Date_Train '
                . ' FROM Member'
                . ' INNER JOIN Connexion ON (Connexion.Member_ID = Member.Member_ID)  '
                . ' INNER JOIN Person ON (Person.Person_ID = Member.Person_ID) '
                . ' INNER JOIN Club ON (Club.Club_ID = Member.Club_ID) '
                . ' INNER JOIN District ON (District.District_ID = Member.District_ID) '
                . ' WHERE (Connexion_ID = :id)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('id' => "$idco"));

        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $memberID = $row["Member_ID"];
        $nom = $row["Person_Lastname"];
        $prenom = $row["Person_Firstname"];
        $titre = $row["Member_Title"];
        $status = $row["Member_Status"];
        $district = $row["District_Name"];
        $club = $row["Club_Name"];
        $num = $row["Member_Num"];
        $adressesup = $row["Member_Additional_Adress"];
        $rue = $row["Member_Street"];
        $ville = $row["Member_City"];
        $cp = $row["Member_Postal_Code"];
        $tel = $row["Member_Phone"];
        $mobile = $row["Member_Mobile"];
        $mail = $row["Member_EMail"];
        $positionclub = $row["Member_Position_Club"];
        $positiondistrict = $row["Member_Position_District"];
        $train = $row["Member_By_Train"];
        $traindate = $row["Member_Date_Train"];

        echo'
            
        <section>
        <div class="row section-head">
            <div class="col full">
                <br></br>
                <h2 style="margin : 65px ; color : #11ABB0; text-align : center"> Vos informations personnelles </h2>
            </div>
        <div class="row">
       
            <form name="contactForm" id="contactForm" method="post"  action="infosmodifiees.php">
                    <fieldset >

                        <div>
                            <label for="contactSubject"><FONT style="color :#BEBEBE">Adresse email <span class="required">*</span></label>
                             <input name="email" type="mail" id="mail" size="35" value="' . $mail . '" style = "padding: 18px 18px; margin : 0 0 24px 0; color : #738182; background : #CFD4D5; border : 0" >
                         </div>
                           

                      <div class="row section-head">
                        <h2 style="color : #8BB24C;" > <FONT size="5">Identité <FONT></h2>
                     </div>
                     
                        <div>
                            <label for="contactSubject"><FONT style="color :#BEBEBE">Prénom<span class="required">*</span></label>
                            <input name="prenom" type="text" id="prenom" size="35" value="'.$prenom.'">
                        </div>

                        <div>
                           <label for="contactSubject"><FONT style="color :#BEBEBE">Nom<span class="required">*</span></label>
                            <input name="nom" type="text" id="nom" size="35" value="'.$nom.'">
                        </div>
                        
                        <div class="row section-head">
                        <h2 style="color : #8BB24C;" > <FONT size="5">Coordonnées<FONT></h2>
                        </div>
                        
                        <div>
                            <label for="contactSubject"><FONT style="color :#BEBEBE">N°<span class="required">*</span></label>
                             <input name="num" type="text" id="num" size="35" value="'.$num.' ">
                        </div>
                          
                        <div>
                            <label for="contactSubject"><FONT style="color :#BEBEBE">Rue<span class="required">*</span></label>
                             <input name="rue" type="text" id="rue" size="35" value="'.$rue.'" >
                        </div>

                        <div>
                             <label for="contactSubject"><FONT style="color :#BEBEBE">Complément d\'adresse</label>
                             <input name="cadr" type="text" id="cadr" size="35" value="'.$adressesup.'" >
                         </div>


                        <div>
                             <label for="contactSubject"><FONT style="color :#BEBEBE">Code Postal<span class="required">*</span></label>
                             <input name="cp" type="text" id="cp" size="5" value="' . $cp . '" >
                         </div>

                    <div>
                        <label for="contactSubject"><FONT style="color :#BEBEBE">Ville<span class="required">*</span></label>
                        <input name="ville" type="text" id="ville" size="35" value="' . $ville . '" >
                    </div>

                    
                    <div>
                       <label for="contactSubject"><FONT style="color :#BEBEBE">Téléphone<span class="required">*</span></label>
                        <input name="tel" type="text" id="tel" size="35" value="' . $tel . '">
                    </div>
                    
                    <div>
                        <label for="contactSubject"><FONT style="color :#BEBEBE">Portable</label>
                        <input name="portable" type="text" id="portable" size="35" value="' . $mobile . '">
                    </div>
                    
                    <div>
                       
                        <input name="idco" type="hidden" id="idco" size="35" value="' . $idco . '" style = "padding: 18px 18px; margin : 0 0 24px 0; color : #738182; background : #CFD4D5; border : 0"/>
                    </div>
                    
                    <br></br>

                    <div>
                           <input type="submit" name="v1" value="Valider mes modifications">
                    </div>

                </fieldset>
           </form> 
        </div></div></div>
        <br></br>
         </section>      
                                
                    ';
        ?>

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
