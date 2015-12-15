<?php
$idco = $_GET['idco'];

/* Connexion à la base de données */
$bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', '');

/* Récupération du membreID */
$sql = 'SELECT Member_ID FROM Member  WHERE (Connexion_ID = :id)';
$stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
$stmt->execute(array('id' => "$idco"));
$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$memberID = $row["Member_ID"];

/* Récupération du basketID*/
$sql = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id AND Congress_ID = 1)';
$stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
$stmt->execute(array(':id' => "$memberID"));
$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$basketID = $row["Basket_ID"];

/* * ************************************************** */
/* Récupération des repas payés et affichage */
/* * **************************************************** */

 
 echo'       <div class="row section-head">
            <h2 style="color : #8BB24C;"> <FONT size="5">Repas<FONT></h2>
         </div>';
             
/* Récupération du nombre de repas réservés */
$sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
        . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
        . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
        . ' WHERE (Basket_ID = :id AND Belong_Paid = 1 AND Activity_Type_Name = "Repas")';
$stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
$stmt->execute(array(':id' => "$basketID"));
$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$cpt = $row["Count(Activity.Activity_ID)"];

$totalrepas=0;

if ($cpt != 0) {

    $sql = 'SELECT  Activity_Name, Activity_Date, Belong_Price FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 1 AND Activity_Type_Name = "Repas") ORDER BY (Activity_Date)';

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
        $totalrepas="$prix"+"$totalrepas";
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
/* Récupération des excursions payées et affichage */
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
        . ' WHERE (Basket_ID = :id AND Belong_Paid = 1 AND Activity_Type_Name = "Excursion")';
$stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
$stmt->execute(array(':id' => "$basketID"));
$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$cpt2 = $row["Count(Activity.Activity_ID)"];

$totalexcursions = 0;

if ($cpt2 != 0) {
    $sql = 'SELECT  Activity_Name, Activity_Date, Belong_Price FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 1 AND Activity_Type_Name = "Excursion") ORDER BY (Activity_Date)';

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

        $totalexcursions = $prix+$totalexcursions;
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

$total = $totalrepas+$totalexcursions;
echo'

        <div class="row section-head">
            <br></br>
            <h2 style="color : #8BB24C;" > <FONT size="5"> Totaux <FONT></h2> 
        </div>

<div>
               <TABLE id="tableau" border width=50% cols="2" style="border:1px solid black;width : 40%; margin-left : 0" >

                    <TR class="row" >
                        <Td class ="col"  width=300 height = 35 style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B">  Total des repas </Td>
                        <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $totalrepas . ' € </FONT></Td>
                    </TR>
                    <TR class="row" >
                        <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B">  Total des excursions </Td>
                        <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5">' . $totalexcursions . ' € </FONT></Td>
                    </TR>
                    <TR class="row" >
                        <Td class ="col"  width=300 height = 35  style="border:1px solid black;text-align : center;"><FONT size="4" style="color : #52574B">  Total </b> </Td>
                        <td class ="col" width=101 style="border:1px solid black; text-align : center;"><FONT size="3.5" style="color:#BA052C">' . $total . ' € </FONT></Td>
                    </TR>
                    </TABLE>
                        </div>
                        <br>';
?>