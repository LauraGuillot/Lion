<?php

$idco = $_POST['idco'];

include "constantes.php";

/* Récupération des données personnelles du membre */
$sql = 'SELECT Member_ID, Person_Lastname, Person_Firstname, Member_Title, Member_Status, District_Name, Club_Name, '
        . ' Member_Num, Member_Additional_Adress, Member_Street, Member_City, Member_Postal_Code, Member_Phone, '
        . ' Member_Mobile, Member_EMail, Member_Position_Club, Member_Position_District, Member_By_Train, Member_Date_Train '
        . ' FROM Member '
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


/* Récupération du follower */
$sql = 'SELECT Person_Lastname, Person_Firstname '
        . 'FROM Follower '
        . ' INNER JOIN Person ON (Person.Person_ID = Follower.Person_ID) '
        . ' INNER JOIN Member ON (Member.Member_ID = Follower.Member_ID)'
        . ' WHERE (Member_ID = :id)';
$stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
$stmt->execute(array(':id' => "$memberID"));
$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$fnom = $row["Person_Lastname"];
$fprenom = $row["Person_Firstname"];

/* Affichage des informations personnelles */

echo'
        <div class="row section-head">
            
            <h2 style="color : #11ABB0;" > <FONT size="5"> Vos informations personnelles <FONT></h2>
            
        </div>
        
        <div>
             <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>Civilité</u> : ' . $titre . '</h2> 
        </div>
        <div>
            <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>Nom</u> : ' . $nom . '</h2> 
        </div>
        <div>
             <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>Prenom</u> : ' . $prenom . '</h2> 
        </div>
        
        <div class="row section-head">
            <h2 style="color : #8BB24C;" > <FONT size="5">Coordonnées <FONT></h2>
         </div>
         
        <div>
            <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" >  <u>Adresse</u> : ' . $num . ' ' . $rue . ' (' . $adressesup . ') ' . $cp . ' ' . $ville . '</h2> 
        </div>
        <div>
            <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" >  <u>Téléphone</u> : ' . $tel . '</h2> 
        </div>
        <div>
            <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>Mobile</u> : ' . $mobile . '</h2> 
        </div>
        <div>
            <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>Mail</u> : ' . $mail . '</h2> 
        </div>
        
        <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Position dans le Lions Clubs <FONT></h2>
         </div>';

if ($status == 1) {
    echo'<div>
             <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>Satut</u> : Lion </h2> 
        </div>';
} else {
    echo'<div>
           <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" >  <u>Satut</u> : Leo </h2> 
        </div>';
}

echo'   <div>
            <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>District</u> : ' . $district . '</h2> 
        </div>
        <div>
           <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>Position au sein du district</u> : ' . $positiondistrict . '</h2> 
        </div>
        <div>
            <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" >  <u>Club</u> : ' . $club . '</h2> 
        </div>
        <div>
            <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > <u>Position au sein du club</u> : ' . $positionclub . '</h2> 
        </div>
        
';
if ($train == 1) {
    echo' <div class="row section-head">
            <h2 style="color : #8BB24C;"><FONT size="5"> Arrivée <FONT></h2>
         </div>
   <div>
           <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > Par train le : ' . $traindate . '</h2> 
        </div>';
} else {
    echo' <div class="row section-head">
            <h2 style="color : #8BB24C;"><FONT size="5"> Arrivée<FONT> </h2>
         </div>
   <div>
             <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" >  Libre</h2> 
        </div>';
}

echo' <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Accompagnant<FONT></h2>
         </div>
      <div>
          <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > ' . $fprenom . ' ' . $fnom . '</h2> 
        </div>';

echo'
        <div class="row section-head">
            <br></br>
            <h2 style="color : #11ABB0;" > <FONT size="5"> Activités réservées <FONT></h2> 
        </div>
        
        <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Repas<FONT></h2>
         </div>';

/* * ****************************************** */
/* Récupération des activités du panier */
/* * ********************************************** */

/* Récupération du basketID et des totaux */
$sql = 'SELECT Basket_ID, Basket_Total, Basket_Trip_Total, Basket_Meal_Total FROM Basket WHERE (Member_ID = :id )';
$stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
$stmt->execute(array(':id' => "$memberID"));
$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$basketID = $row["Basket_ID"];
$total = $row["Basket_Total"];
$totaltrip = $row["Basket_Trip_Total"];
$totalmeal = $row["Basket_Meal_Total"];

/* * ************************************************** */
/* Récupération des repas du panier et affichage */
/* * **************************************************** */

/* Récupération du nombre de repas réservés */
$sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
        . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
        . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
        . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Repas" AND Congress_ID = '.congressID.')';
$stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
$stmt->execute(array(':id' => "$basketID"));
$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$cpt = $row["Count(Activity.Activity_ID)"];


if ($cpt != 0) {

    $sql = 'SELECT  Activity_Name, Activity_Date, Belong_Price FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Repas" AND Congress_ID = '.congressID.') ORDER BY (Activity_Date)';

    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));


    echo'
<div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 70%; margin-left : 0">             
         <TR class="row" >
                        <Td class ="col"  width=30% style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B"> Date </FONT></TH>
                        <td class ="col" width=50% style="border:1px solid black; text-align : center;"> <FONT size="4" style="color : #52574B"> Intitulé </FONT></th>
                        <td class ="col" width=140.62 style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Tarif </FONT></th>
        </TR>';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

        $activite = $row["Activity_Name"];
        $date = $row["Activity_Date"];
        $prix = $row["Belong_Price"];

        echo' <TR class="row" >
           <Td class ="col"  width=30% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $date . '</FONT> </TH>
           <td class ="col" width=50% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $activite . '</FONT> </th>
           <td class ="col" width=140.62 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $prix . ' € </FONT> </th>
         </TR>';
    } echo'</TABLE>
             </div>';
} else {
    echo'  <div>
           <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > Aucun repas réservé</h2> 
        </div>';
}



/* * ****************************************************** */
/* Récupération des excursions du panier et affichage */
/* * ******************************************************** */

echo'

        <div class="row section-head">
        <br>
            <h2 style="color : #8BB24C;"> <FONT size="5"> Excursions<FONT></h2>
         </div>';

/* Récupération du nombre d'excursions réservées */
$sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
        . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
        . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
        . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Excursion" AND Congress_ID = '.congressID.')';
$stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
$stmt->execute(array(':id' => "$basketID"));
$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$cpt2 = $row["Count(Activity.Activity_ID)"];


if ($cpt2 != 0) {
    $sql = 'SELECT  Activity_Name, Activity_Date, Belong_Price FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Excursion" AND Congress_ID = '.congressID.') ORDER BY (Activity_Date)';

    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));


    echo'
<div>
    <TABLE id="tableau" border  cols="3" style="border:1px solid black;width : 70%; margin-left : 0">             
         <TR class="row" >
                        <Td class ="col"  width=30% style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B"> Date </FONT></TH>
                        <td class ="col" width=50% style="border:1px solid black; text-align : center;"> <FONT size="4" style="color : #52574B"> Intitulé </FONT></th>
                        <td class ="col" width=140.62 style="border:1px solid black ; text-align : center;"><FONT size="4" style="color : #52574B"> Tarif </FONT></th>
        </TR>';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

        $activite = $row["Activity_Name"];
        $date = $row["Activity_Date"];
        $prix = $row["Belong_Price"];

        echo' <TR class="row" >
           <Td class ="col"  width=30% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $date . '</FONT> </TH>
           <td class ="col" width=50% style="border:1px solid black; text-align : center;"> <FONT size="3.5">' . $activite . '</FONT> </th>
           <td class ="col" width=140.62 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $prix . ' € </FONT> </th>
         </TR>';
    } echo'</TABLE>
             </div>';
} else {
    echo'  <div>
           <tr style="" > <FONT size="3.5" style="font-weight:normal;color : #C6CCBB;" > Aucune excursion réservée</h2> 
        </div>';
}

/* * *************************** */
/* Affichage des totaux */
/* * *********************** */
echo'

        <div class="row section-head">
            <br></br>
            <h2 style="color : #11ABB0;" > <FONT size="5"> Totaux <FONT></h2> 
        </div>

<div>
               <TABLE id="tableau" border width=50% cols="2" style="border:1px solid black;width : 40%; margin-left : 0" >

                    <TR class="row" >
                        <Td class ="col"  width=300 height = 35 style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B">  Total des repas </Td>
                        <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $totalmeal . ' € </FONT></Td>
                    </TR>
                    <TR class="row" >
                        <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B">  Total des excursions </Td>
                        <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $totaltrip . ' € </FONT></Td>
                    </TR>
                    <TR class="row" >
                        <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B">  Total </b> </Td>
                        <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color:#BA052C">' . $total . ' € </FONT></Td>
                    </TR>
                    </TABLE>
                        </div>
                        <br>';

/***********************************************/
/*BOUTONS*/
/************************************************/

 if (!($cpt = 0 && $cpt2=0)) {
        echo'
            
<div>
 <TABLE id="tableau" border width=50% cols="2" style="width : 100%; margin-left : 0" >

     <TR class="row" >
            <Td class ="col"  width=200 height = 35 style=" text-align : left;"><FONT size="4" style="color : #52574B">  
            <form name="validPanier" id="contactForm" method="post"  action="paiement.php">
                 <input type="submit" name="v" value="Valider et payer">
                 <input type="hidden"  name="idco" value="' . $idco . '">
           </form> 
            </Td>      
 
           <Td class ="col"  width=200 height = 35 style=" text-align : left;"><FONT size="4" style="color : #52574B">  
            <form name="imprim" id="contactForm" method="post"  action="recapPDF.php">
                 <input type="submit" name="i" value="Imprimer">
                 <input type="hidden"  name="idco" value="' . $idco . '">
           </form> 
            </Td> 
    </TR>
                    
    </TABLE>
    <br>
 </div>';
                
 }










?>