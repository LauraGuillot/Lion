<?php
$idco = $_POST['idco'];
include 'requetes.php';

function afficheRecapPDF($bdd, $idco) {
    /* Récupération des données personnelles du membre */
    $sql = 'SELECT Member.Member_ID, Person_Lastname, Person_Firstname, Member_Title, Member_Status, District_Name, Club_Name, '
            . ' Member_Num, Member_Additional_Adress, Member_Street, Member_City, Member_Postal_Code, Member_Phone, '
            . ' Member_Mobile, Member_EMail, Member_Position_Club, Member_Position_District, Member_By_Train, YEAR(Member_Date_Train), MONTH(Member_Date_Train) , DAY(Member_Date_Train)  '
            . ' FROM Member '
            . ' INNER JOIN Connexion ON (Connexion.Member_ID = Member.Member_ID) '
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
    if ($status == 0) {
        $status = "Leo";
    } else {
        $status = "Lion";
    }
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
    
    $trainannee = $row["YEAR(Member_Date_Train)"];
    $trainmois = $row["MONTH(Member_Date_Train)"];
    $trainjour = $row["DAY(Member_Date_Train)"];
   
    if ($trainmois < 10) {
        $trainmois = "0" . $trainmois;
    }
    if ($trainjour < 10) {
        $trainjour = "0" . $trainjour;
    }
    $traindate = $trainjour . "-" . $trainmois . "-" . $trainannee;
    
    if ($train == 1) {
        $resulttrain = "Arrivée en train le : $traindate";
    } else {
        $resulttrain = "Arrivée libre";
    }


    /* Récupération du follower */
    $sql = 'SELECT Person_Lastname, Person_Firstname '
            . 'FROM Follower '
            . ' INNER JOIN Person ON (Person.Person_ID = Follower.Person_ID) '
            . ' WHERE (Member_ID = :id)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $fnom = $row["Person_Lastname"];
    $fprenom = $row["Person_Firstname"];

    $accompagnant = "";
    $n = 1;
    if (!(empty($fnom) && empty($fprenom))) {
        $accompagnant = $fprenom . " " . $fnom;
        $n = $n + 1;
    } else {
        $accompagnant = "Aucun";
    }

    list($annee, $mois, $day, $heure, $min, $sec) = dateAuj($bdd);
    $dateauj = "$day" . "-" . "$mois" . "-" . "$annee";

    /*     * ****************************************** */
    /* Récupération des activités du panier */
    /*     * ********************************************** */

    /* Récupération du basketID et des totaux */
    $sql = 'SELECT Basket_ID, Basket_Total, Basket_Trip_Total, Basket_Meal_Total FROM Basket WHERE (Member_ID = :id)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];
    $total = $row["Basket_Total"];
    $total = $total * $n;
    $totaltrip = $row["Basket_Trip_Total"];
    $totaltrip = $totaltrip * $n;
    $totalmeal = $row["Basket_Meal_Total"];
    $totalmeal = $totalmeal * $n;

    /* Récupération du nombre de repas réservés */
    $sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Repas" AND Congress_ID = ' . congressID . ')';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Activity.Activity_ID)"];
    $repas = '';

    if ($cpt != 0) {

        $sql = 'SELECT  Activity_Name, YEAR(Activity_Date), MONTH(Activity_Date), DAY(Activity_Date), Belong_Price FROM Activity '
                . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
                . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Repas" AND Congress_ID = ' . congressID . ') ORDER BY (Activity_Date)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));

        $repas = $repas . ' 
<div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 100%; margin-left : 0;border-collapse: collapse;">             
         <TR class="row" >
                        <Td class ="col" width=100 style="border:1px solid black; background-color : #C9D2D7;text-align : center;"><FONT size="5" > <b> Date </b></FONT></Td>
                        <td class ="col" width=280 style="border:1px solid black; background-color : #C9D2D7; text-align : center;"> <FONT size="5" > <b> Intitulé </b></FONT></td>
                        <td class ="col" width=100 style="border:1px solid black ; background-color : #C9D2D7; text-align : center;"><FONT size="5" > <b> Tarif </b> </FONT></td>
      <td class ="col" width=160 style="border:1px solid black ; background-color : #C9D2D7; text-align : center;"><FONT size="5" > <b> Nombre de personnes </b> </FONT></td>
        </TR> ';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $annee = $row["YEAR(Activity_Date)"];
            $mois = $row["MONTH(Activity_Date)"];
            $jour = $row["DAY(Activity_Date)"];
            $prix = $row["Belong_Price"];

            if ($mois < 10) {
                $mois = "0" . $mois;
            }
            if ($jour < 10) {
                $jour = "0" . $jour;
            }
            $date = $jour . "-" . $mois . "-" . $annee;

            $repas = $repas . '<TR class="row" >
           <Td class ="col"  width=100 style="border:1px solid black; text-align : center;"> <FONT size="3.5" style="color : #252E43">' . $date . '</FONT> </Td>
           <td class ="col" width=280 style="border:1px solid black; text-align : center;"> <FONT size="3.5" style="color : #252E43">' . $activite . '</FONT> </td>
           <td class ="col" width=100 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43">' . $prix . ' €</FONT> </td>
         <td class ="col" width=160 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43">' . $n . ' </FONT> </td>
         </TR>';
        } $repas = $repas . ' </TABLE>
             </div>';
    } else {
        $repas = $repas . ' 
           <div style="" > <FONT size="3.5" style="font-weight:normal;color : #707B82;" > Aucun repas réservé</FONT></div> 
        ';
    }

    /*     * ****************************************************** */
    /* Récupération des excursions du panier et affichage */
    /*     * ******************************************************** */
    $excursion = ' ';


    /* Récupération du nombre d'excursions réservées */

    $sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Excursion" AND Congress_ID = ' . congressID . ')';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt2 = $row["Count(Activity.Activity_ID)"];


    if ($cpt2 != 0) {
        $sql = 'SELECT  Activity_Name,YEAR(Activity_Date), MONTH(Activity_Date), DAY(Activity_Date), Belong_Price FROM Activity '
                . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
                . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Excursion" AND Congress_ID = ' . congressID . ') ORDER BY (Activity_Date)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));

        $excursion = $excursion . ' 
<div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 100%; margin-left : 0;border-collapse: collapse;">             
         <TR class="row" >
                       <Td class ="col" width=100 style="border:1px solid black; background-color : #C9D2D7;text-align : center;"><FONT size="5" > <b> Date </b></FONT></Td>
                        <td class ="col" width=280 style="border:1px solid black; background-color : #C9D2D7; text-align : center;"> <FONT size="5" > <b> Intitulé </b></FONT></td>
                        <td class ="col" width=100 style="border:1px solid black ; background-color : #C9D2D7; text-align : center;"><FONT size="5" > <b> Tarif </b> </FONT></td>
                         <td class ="col" width=160 style="border:1px solid black ; background-color : #C9D2D7; text-align : center;"><FONT size="5" > <b> Nombre de personnes </b> </FONT></td>
        </TR> ';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $annee = $row["YEAR(Activity_Date)"];
            $mois = $row["MONTH(Activity_Date)"];
            $jour = $row["DAY(Activity_Date)"];
            $prix = $row["Belong_Price"];

            if ($mois < 10) {
                $mois = "0" . $mois;
            }
            if ($jour < 10) {
                $jour = "0" . $jour;
            }
            $date = $jour . "-" . $mois . "-" . $annee;

            $excursion = $excursion . '  <TR class="row" >
           <Td class ="col"  width=100 style="border:1px solid black; text-align : center;"> <FONT size="3.5" style="color : #252E43">' . $date . '</FONT> </Td>
           <td class ="col" width=280 style="border:1px solid black; text-align : center;"> <FONT size="3.5" style="color : #252E43">' . $activite . '</FONT> </td>
           <td class ="col" width=100 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43">' . $prix . ' €</FONT> </td>
         <td class ="col" width=160 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43">' . $n . ' </FONT> </td>
         </TR>';
        }$excursion = $excursion . ' </TABLE>
             </div>';
    } else {
        $excursion = $excursion . '  
           <div style="" > <FONT size="3.5" style="font-weight:normal;color : #707B82" > Aucune excursion réservée</FONT></div> ';
    }
    ob_start();
    ?>
    <page backtop="15mm" backbottom="15mm" backleft="10mm" backright="10mm">
        <div class="logo">
            <a href="" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
        </div>
        <div class="col full">
            <br>
            <h2 style="margin : 65px ; color : #252E43; text-align : center"> <FONT size="6"> Récapitulatif - Réservation d'activités - <?php echo"$dateauj" ?> </FONT></h2>

        </div>

        <div class="row section-head">      
            <h2 style="color : #11ABB0;" > <FONT size="5">INFORMATIONS PERSONNELLES </FONT></h2>
        </div>

        <div>
            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Civilité</u> : <?php echo"$titre"; ?></FONT> </div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Nom</u> :  <?php echo"$nom"; ?> </FONT></div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Prenom</u> : <?php echo"$prenom"; ?></FONT></div> 

        </div>

        <div class="row section-head">
            <h2 style="color : #8BB24C;" > <FONT size="5">Coordonnées </FONT></h2>
        </div>

        <div>
            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" >  <u>Adresse</u> : <?php echo"$num $rue ($adressesup) $cp $ville"; ?></FONT> </div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" >  <u>Téléphone</u> : <?php echo"$tel"; ?></FONT> </div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Mobile</u> : <?php echo"$mobile"; ?> </FONT></div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Mail</u> : <?php echo"$mail"; ?></FONT></div> 
        </div>

        <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Position dans le Lions Clubs </FONT></h2>
        </div>


        <div>
            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Satut</u> :<?php echo"$status"; ?></FONT></div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>District</u> : <?php echo"$district"; ?></FONT></div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Position au sein du district</u> : <?php echo"$positiondistrict"; ?></FONT></div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" >  <u>Club</u> : <?php echo"$club"; ?></FONT></div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Position au sein du club</u> : <?php echo"$positionclub"; ?></FONT></div> 
        </div>

        <div class="row section-head">
            <h2 style="color : #8BB24C;"><FONT size="5"> Arrivée </FONT></h2>
        </div>

        <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <?php echo"$resulttrain"; ?></FONT></div> 



        <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Accompagnant</FONT></h2>
        </div>
        <div>
            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <?php echo"$accompagnant"; ?></FONT></div> 
        </div>
        <page_footer backtop="5mm" backbottom="10mm" backleft="10mm" backright="10mm">
            <div  style="text-align:center"> <FONT size="3.5" style="font-weight:normal;color : #252E43; text-align:center" ><i>Page 1/2</i> </FONT></div>
        </page_footer>
    </page>
    <page backtop="15mm" backbottom="15mm" backleft="10mm" backright="10mm">
        <div class="row section-head">
            <br>
            <h2 style="color : #11ABB0;" > <FONT size="5">ACTIVITES RESERVEES</FONT></h2> 

        </div>

        <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Repas</FONT></h2>
        </div>
        <?php echo"$repas" ?>
        <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Excursions</FONT></h2>
        </div>
        <?php echo"$excursion" ?>


        <div class="row section-head">
            <br>
            <h2 style="color : #11ABB0;" > <FONT size="5">TOTAUX</FONT></h2> 
        </div>

        <div>
            <TABLE id="tableau" border width=50% cols="2" style="border:1px solid black;width : 40%; margin-left : 0; border-collapse: collapse;" >

                <TR class="row" >
                    <Td class ="col"  width=300 height = 35 style="border:1px solid black;text-align : center;background-color : #C9D2D7;"><FONT size="4" >  <b> Total des repas </b></FONT> </Td>
                    <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43"><?php echo"$totalmeal"; ?> € </FONT></Td>
                </TR>
                <TR class="row" >
                    <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;background-color : #C9D2D7;"><FONT size="4" > <b> Total des excursions </b></FONT></Td>
                    <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43"><?php echo"$totaltrip"; ?> € </FONT></Td>
                </TR>
                <TR class="row" >
                    <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;background-color : #C9D2D7;"><FONT size="4" > <b> Total </b> </FONT></Td>
                    <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color:#BA052C"><?php echo"$total" ?> € </FONT></Td>
                </TR>
            </TABLE>
        </div>
        <page_footer backtop="5mm" backbottom="10mm" backleft="10mm" backright="10mm">
            <div  style="text-align:center"> <FONT size="3.5" style="font-weight:normal;color : #252E43; text-align:center" ><i>Page 2/2</i> </FONT></div>
        </page_footer>
    </page>


    <?php
    $content = ob_get_clean();
    require('html2pdf/html2pdf.class.php');

    try {
        $pdf = new HTML2PDF('P', 'A4', 'fr');
        $pdf->writeHTML($content);
        $pdf->Output('recapitulatif.pdf');
    } catch (HTML2PDF_exception $ex) {
        die($ex);
    }
}

afficheRecapPDF($bdd, $idco);
?>