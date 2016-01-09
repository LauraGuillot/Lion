<?php

$idco = $_POST["idco"];

include 'requetes.php';
majConnexion($bdd, $idco);
/* -----------------------------------------------------------------------------------------------
 *                                BON DE COMMANDE PDF  
 * Paramètres :  $bdd - Base de données / $idco - identifiant de connexion du membre 
 * Description : 
 * Lorsqu'un membre réserve une activité et choisit le mode de paiement par chèque, un bon de commande lui est généré au format pdf.
 * Cette tâche est effectuée par la fonction bonDeCommande (à l'aide de la classe html2pdf).
 * Sur le bon de commande figurent :
 * - le numéro de commande composé de : l'identifiant du membre, la liste des identifiants des activités réservées, la date actuelle
 * - les informations personnelles du membre
 * - les activités réservées lors de cette commande
 * - les totaux                                
 * ----------------------------------------------------------------------------------------------- */

function bonDeCommande($bdd, $idco) {

    /* Récupération des données personnelles du membre */
    list($memberID, $nom, $prenom, $titre, $status, $district, $club, $num, $adressesup, $rue, $ville, $cp, $tel, $mobile, $mail, $positionclub, $positiondistrict, $train, $traindate) = getInfos($bdd, $idco);

    /* Récupération du follower */
    list ($fnom, $fprenom) = getFollower($bdd, $memberID);


    $accompagnant = "";
    $n = 1; /* nombre de personnes */
    if (!(empty($fnom) && empty($fprenom))) {
        $accompagnant = $fprenom . " " . $fnom;
        $n = $n + 1;
    } else {
        $accompagnant = "Aucun";
    }

    /* On récupère les activités commandées */

    /* Récupération du basketID  */
    $basketID = getBasketID($bdd, $memberID);


    /* Récupération des activités */

    /* On récupère la date du dernier panier */
    $belongdate = getDatePanier($bdd, $basketID);

    /* On récupère toutes les activités */
    $sql = 'SELECT  Activity.Activity_ID, Activity_Name, Activity_Date, Belong_Price FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id  AND Belong_Payement_Way ="CH" AND Congress_ID = ' . congressID . ' AND Belong_Date = :date ) ORDER BY ( Activity_Date)';

    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID", ':date' => "$belongdate"));

    $numCommande = "";

    $activite = ' 
<div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 100%; margin-left : 0;border-collapse: collapse;">             
         <TR class="row" >
                        <Td class ="col" width=100 style="border:1px solid black; background-color : #C9D2D7;text-align : center;"><FONT size="5" > <b> Date </b></FONT></Td>
                        <td class ="col" width=280 style="border:1px solid black; background-color : #C9D2D7; text-align : center;"> <FONT size="5" > <b> Intitulé </b></FONT></td>
                        <td class ="col" width=100 style="border:1px solid black ; background-color : #C9D2D7; text-align : center;"><FONT size="5" > <b> Tarif </b> </FONT></td>
                        <td class ="col" width=160 style="border:1px solid black ; background-color : #C9D2D7; text-align : center;"><FONT size="5" > <b> Nombre de personnes </b> </FONT></td>
        </TR> ';
    $total = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

        $numCommande = $numCommande . "." . $row["Activity_ID"];
        $act = $row["Activity_Name"];
        $date = $row["Activity_Date"];
        $prix = $row["Belong_Price"];
        $total = $total + $prix;


        $activite = $activite . '<TR class="row" >
           <Td class ="col"  width=100 style="border:1px solid black; text-align : center;"> <FONT size="3.5" style="color : #252E43">' . $date . '</FONT> </Td>
           <td class ="col" width=280 style="border:1px solid black; text-align : center;"> <FONT size="3.5" style="color : #252E43">' . $act . '</FONT> </td>
           <td class ="col" width=100 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43">' . $prix . ' €</FONT> </td>
         <td class ="col" width=160 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color : #252E43">' . $n . ' </FONT> </td>
         </TR> ';
    }

    $total = $total * $n;

    $activite = $activite . ' </TABLE>
             </div>';

    list($a, $mo, $j, $h, $m, $s) = dateAuj($bdd);
    $dateauj = "$j"."-"."$mo"."-"."$a";
    $numCommande = $memberID . "-" . $numCommande;
    ob_start();
    ?>

    <page backtop="15mm" backbottom="15mm" backleft="10mm" backright="10mm">
        <div class="logo">
            <a href="" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
        </div>
        <div class="col full">
            <h2 style="margin : 65px ; color : #252E43; text-align : center"> <FONT size="6"> Bon de commande n° <?php echo"$numCommande"; ?> - <?php echo"$dateauj" ?> </FONT></h2>

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

        <?php echo"$activite"; ?>

        <div class="row section-head">
            <h2 style="color : #11ABB0;" > <FONT size="5">TOTAL</FONT></h2> 
        </div>

        <div>
            <TABLE id="tableau" border width=50% cols="2" style="border:1px solid black;width : 40%; margin-left : 0; border-collapse: collapse;" >
                <TR class="row" >
                    <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;background-color : #C9D2D7;"><FONT size="4" > <b> Total </b> </FONT></Td>
                    <Td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color:#BA052C"><?php echo"$total" ?> € </FONT></Td>
                </TR>
            </TABLE>
        </div>

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
        $pdf->Output('recapitulatif.pdf');
    } catch (HTML2PDF_exception $ex) {
        die($ex);
    }
}

bonDeCommande($bdd, $idco);

?>
