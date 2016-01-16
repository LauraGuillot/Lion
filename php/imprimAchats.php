<?php
$idco = $_POST['idco'];
include "requetes.php";
majConnexion($bdd, $idco);


/* ----------------------------------------------------------------------------------------------- 
 *                                Achats PDF 
 * Paramètres :  $bdd - Base de données / $idco - identifiant de connexion du membre 
 * Description : 
 * Dans l'onglet MesAchats, l'utilisateur a accès à ses achats. Il peut les imprimer via un PDF généré par la fonction pdfAchats.                                   
 * ----------------------------------------------------------------------------------------------- */

function pdfAchats($bdd, $idco) {
    /* Récupération des données personnelles du membre */
    list($memberID, $nom, $prenom, $titre, $status, $district, $club, $num, $adressesup, $rue, $ville, $cp, $tel, $mobile, $mail, $positionclub, $positiondistrict, $train, $traindate) = getInfos($bdd, $idco);

    /* Récupération du follower */
    list ($fnom, $fprenom) = getFollower($bdd, $memberID);

    /* Récupération du basketID */
    $basketID = getBasketID($bdd, $memberID);

    $accompagnant = "";
    $n = 1; /* nombre de personnes */
    if (!(empty($fnom) && empty($fprenom))) {
        $accompagnant = $fprenom . " " . $fnom;
        $n = $n + 1;
    } else {
        $accompagnant = "Aucun";
    }

    /*     * ************************************************ */
    /* Récupération des repas payés et affichage */
    /*     * ************************************************** */


    $texte = '<div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Repas</FONT></h2>
         </div>';

    /* Récupération du nombre de repas réservés */
    $cpt = getNbRepasAchetes($bdd, $basketID);

    $totalrepas = 0;

    if ($cpt != 0) {

        $sql = 'SELECT  Activity_Name, YEAR(Activity_Date), MONTH(Activity_Date), DAY(Activity_Date), Activity_Hour , Belong_Price FROM Activity '
                . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
                . ' WHERE (Basket_ID = :id AND Belong_Paid = 1 AND Activity_Type_Name = "Repas" AND Congress_ID = ' . congressID . ') ORDER BY (Activity_Date)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));


        $texte = $texte . ' 
    <div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 100%; margin-left : 0;border-collapse: collapse;">             
         <TR class="row" >
                        <Td class ="col" width=120 style="border:1px solid black; background-color : #C9D2D7;text-align : center;"><FONT size="5" > <b> Date </b></FONT></Td>
                        <td class ="col" width=260 style="border:1px solid black; background-color : #C9D2D7; text-align : center;"> <FONT size="5" > <b> Intitulé </b></FONT></td>
                        <td class ="col" width=100 style="border:1px solid black ; background-color : #C9D2D7; text-align : center;"><FONT size="5" > <b> Tarif </b> </FONT></td>
                         <td class ="col" width=160 style="border:1px solid black ; background-color : #C9D2D7; text-align : center;"><FONT size="5" > <b> Nombre de personnes </b> </FONT></td>
        </TR> ';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $annee = $row["YEAR(Activity_Date)"];
            $mois = $row["MONTH(Activity_Date)"];
            $jour = $row["DAY(Activity_Date)"];
            $heure = $row["Activity_Hour"];
            $prix = $row["Belong_Price"];
            $totalrepas = "$prix" + "$totalrepas";

            if ($mois < 10) {
                $mois = "0" . $mois;
            }
            if ($jour < 10) {
                $jour = "0" . $jour;
            }
             $date = $jour . "-" . $mois . "-" . $annee." à ".$heure;
            
            $texte = $texte . ' <TR class="row" >
           <Td class ="col"  width=120 style="border:1px solid black; text-align : center;"> <FONT size="3.5" style="color : #252E43">' . $date . '</FONT> </Td>
           <td class ="col" width=260 style="border:1px solid black; text-align : center;"> <FONT size="3.5" style="color : #252E43">' . $activite . '</FONT> </td>
           <td class ="col" width=100 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43">' . $prix . ' €</FONT> </td>
         <td class ="col" width=160 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43">' . $n . ' </FONT> </td>
         </TR>';
        } $texte = $texte . ' </TABLE>
             </div>';
    } else {
        $texte = $texte . '  <div style="" > <FONT size="3.5" style="font-weight:normal;color : #707B82;" > Aucun repas réservé</FONT></div>';
    }

    /*     * ****************************************************** */
    /* Récupération des excursions payées et affichage */
    /*     * ******************************************************** */

    $texte = $texte . ' 

        <div class="row section-head">
        
            <h2 style="color : #8BB24C;"> <FONT size="5"> Excursions</FONT></h2>
         </div>';

    /* Récupération du nombre d'excursions réservées */
    $cpt2 = getNbExcursionsAchetees($bdd, $basketID);

    $totalexcursions = 0;

    if ($cpt2 != 0) {
        $sql = 'SELECT  Activity_Name, YEAR(Activity_Date), MONTH(Activity_Date), DAY(Activity_Date), Activity_Hour , Belong_Price FROM Activity '
                . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
                . ' WHERE (Basket_ID = :id AND Belong_Paid = 1 AND Activity_Type_Name = "Excursion" AND Congress_ID = ' . congressID . ') ORDER BY (Activity_Date)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));


        $texte = $texte . ' 
<div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 100%; margin-left : 0;border-collapse: collapse;">             
         <TR class="row" >
                        <Td class ="col" width=120 style="border:1px solid black; background-color : #C9D2D7;text-align : center;"><FONT size="5" > <b> Date </b></FONT></Td>
                        <td class ="col" width=260 style="border:1px solid black; background-color : #C9D2D7; text-align : center;"> <FONT size="5" > <b> Intitulé </b></FONT></td>
                        <td class ="col" width=100 style="border:1px solid black ; background-color : #C9D2D7; text-align : center;"><FONT size="5" > <b> Tarif </b> </FONT></td>
                         <td class ="col" width=160 style="border:1px solid black ; background-color : #C9D2D7; text-align : center;"><FONT size="5" > <b> Nombre de personnes </b> </FONT></td>
        </TR> ';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            $activite = $row["Activity_Name"];
            $annee = $row["YEAR(Activity_Date)"];
            $mois = $row["MONTH(Activity_Date)"];
            $jour = $row["DAY(Activity_Date)"];
            $heure = $row["Activity_Hour"];
            $prix = $row["Belong_Price"];
            

            if ($mois < 10) {
                $mois = "0" . $mois;
            }
            if ($jour < 10) {
                $jour = "0" . $jour;
            }
             $date = $jour . "-" . $mois . "-" . $annee." à ".$heure;

            $totalexcursions = $prix + $totalexcursions;
            
            $texte = $texte . ' <TR class="row" >
           <Td class ="col"  width=120 style="border:1px solid black; text-align : center;"> <FONT size="3.5" style="color : #252E43">' . $date . '</FONT> </Td>
           <td class ="col" width=260 style="border:1px solid black; text-align : center;"> <FONT size="3.5" style="color : #252E43">' . $activite . '</FONT> </td>
           <td class ="col" width=100 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43">' . $prix . ' €</FONT> </td>
         <td class ="col" width=160 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43">' . $n . ' </FONT> </td>
         </TR>';
        } $texte = $texte . ' </TABLE>
             </div>';
    } else {
        $texte = $texte . ' <div style="" > <FONT size="3.5" style="font-weight:normal;color : #707B82;" > Aucune excursion réservée</FONT></div>';
    }
    /*     * *************************** */
    /* Affichage des totaux */
    /*     * *********************** */

    $totalrepas = $n * $totalrepas;
    $totalexcursions = $n * $totalexcursions;
    $total = $totalrepas + $totalexcursions;
    $texte = $texte . ' 

       <div class="row section-head">
            <br>
            <h2 style="color : #11ABB0;" > <FONT size="5">TOTAUX</FONT></h2> 
        </div>

        <div>
            <TABLE id="tableau" border width=50% cols="2" style="border:1px solid black;width : 40%; margin-left : 0; border-collapse: collapse;" >

                <TR class="row" >
                    <Td class ="col"  width=300 height = 35 style="border:1px solid black;text-align : center;background-color : #C9D2D7;"><FONT size="4" >  <b> Total des repas </b></FONT> </Td>
                    <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43">' . $totalrepas . ' € </FONT></Td>
                </TR>
                <TR class="row" >
                    <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;background-color : #C9D2D7;"><FONT size="4" > <b> Total des excursions </b></FONT></Td>
                    <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43">' . $totalexcursions . ' € </FONT></Td>
                </TR>
                <TR class="row" >
                    <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;background-color : #C9D2D7;"><FONT size="4" > <b> Total </b> </FONT></Td>
                    <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color:#BA052C">' . $total . ' € </FONT></Td>
                </TR>
            </TABLE>
        </div>
   
';
    list($a, $mo, $j, $h, $m, $s) = dateAuj($bdd);
    $dateauj = "$j" . "-" . "$mo" . "-" . "$a";
    ob_start();
    ?>

    <page backtop="15mm" backbottom="15mm" backleft="10mm" backright="10mm">
        <div class="logo">
            <a href="" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
        </div>
        <div class="col full">
            <h2 style="margin : 65px ; color : #252E43; text-align : center"> <FONT size="6"> Récapitulatif des activités réservées - <?php echo"$dateauj" ?> </FONT></h2>

        </div>

        <div class="row section-head">      
            <h2 style="color : #11ABB0;" > <FONT size="5">INFORMATIONS PERSONNELLES </FONT></h2>
        </div>

        <div>
            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Civilité</u> : <?php echo"$titre"; ?></FONT> </div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Nom</u> :  <?php echo"$nom"; ?> </FONT></div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Prenom</u> : <?php echo"$prenom"; ?></FONT></div> 

        </div>


        <div>
            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" >  <u>Adresse</u> : <?php echo"$num $rue ($adressesup) $cp $ville"; ?></FONT> </div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" >  <u>Téléphone</u> : <?php echo"$tel"; ?></FONT> </div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Mobile</u> : <?php echo"$mobile"; ?> </FONT></div> 

            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Mail</u> : <?php echo"$mail"; ?></FONT></div> 
            <div style="" > <FONT size="3.5" style="font-weight:normal;color : #252E43;" > <u>Accompagnant</u> : <?php echo"$accompagnant"; ?></FONT></div> 
        </div>

        <div class="row section-head">
            <h2 style="color : #11ABB0;" > <FONT size="5">ACTIVITES RESERVEES</FONT></h2> 
        </div>

        <?php echo"$texte"; ?>


        <page_footer backtop="5mm" backbottom="10mm" backleft="10mm" backright="10mm">
            <div  style="text-align:center"> <FONT size="3.5" style="font-weight:normal;color : #252E43; text-align:center" ><i>Page 1/1</i> </FONT></div>
        </page_footer>
    </page>


    <?php
    $content = ob_get_clean();
    require('html2pdf/html2pdf.class.php');

    try {
        $pdf = new HTML2PDF('P', 'A4', 'fr');
        $pdf->writeHTML($content);
        $pdf->Output('recapitulatifAchats.pdf');
    } catch (HTML2PDF_exception $ex) {
        die($ex);
    }
}

pdfAchats($bdd, $idco);
?>