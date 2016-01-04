!DOCTYPE html>
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
        afficheHeader();
        ?>
        <!-- Header End -->
        <?php
        include "fonctions.php";
        $idco = $_POST['idco'];
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
         <form name="contactForm" id="contactForm" method="post"  action="infosmodifiees.php">
       <fieldset >

                            <div>
                                <label for="contactEmail">Adresse email <span class="required">*</span></label>
                                <input name="email" type="mail" id="mail" size="35" value='.$mail.' style = "padding: 18px 18px; margin : 0 0 24px 0; color : #738182; background : #CFD4D5; border : 0" />

                            </div>
                           
                        <div>
                            <label for="contactSubject">Prénom<span class="required">*</span></label>
                            <input name="prenom" type="text" id="prenom" size="35" value='.$prenom.'/>
                        </div>

                        <div>
                            <label for="contactSubject">Nom<span class="required">*</span></label>
                            <input name="nom" type="text" id="nom" size="35" value='.$prenom.'/>
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
                        <input name="cadr" type="text" id="cadr" size="5" value='.$adressesup.' />
                    </div>


                    <div>
                        <label for="contactSubject">Code Postal<span class="required">*</span></label>
                        <input name="cp" type="text" id="cp" size="5" value='.$cp.' />
                    </div>

                    <div>
                        <label for="contactSubject">Ville<span class="required">*</span></label>
                        <input name="ville" type="text" id="ville" size="35" value='.$ville.' />
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
                        <input name="portable" type="tel" id="portable" size="35" value='.$mobile.' style = "padding: 18px 18px; margin : 0 0 24px 0; color : #738182; background : #CFD4D5; border : 0"/>
                    </div>
                    
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