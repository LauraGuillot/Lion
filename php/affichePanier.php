<?php

$idco = $_GET['idco'];


/* * ****************************************************** */
/* Fontion pour afficher le tableau des activités du panier */
/* * ****************************************************** */

function affiche($bdd, $idco) {
    try {

        /* Récupération du membre id */
        $sql = 'SELECT Member_ID FROM Member WHERE (Connexion_ID = :idco)';
        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':idco' => "$idco"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $memberID = $row["Member_ID"];

        /* Récupération du basket id */
        $sql = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id AND Congress_ID = 1)';
        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$memberID"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $basketID = $row["Basket_ID"];

        /* Récupération du basket id */
        $sql = 'SELECT Activity_Type_Name, Activity_Name, Activity_Date, Belong_Price FROM Activity '
                . 'INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                . 'INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
                . ' WHERE (Basket_ID = :id) ORDER BY (Activity_Date)';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));
        /* Exploitation des résultats */

        /* Création du tableau */
        echo'
    <html>
         <div>
               <center><TABLE id="tableau" cols="3" style="border:1px solid black">
                 

                    <TR class="row" >
                        <TH class ="col"   width=20% style="border:1px solid black;">Type </TH>
                        <TH class ="col"  width=20% style="border:1px solid black;"> Date </TH>
                        <th class ="col" width=20% style="border:1px solid black"> Intitulé </th>
                        <th class ="col" width=15% style="border:1px solid black">Tarif </th>
                        <th class ="col"   width=25% style="border:1px solid black"> Supprimer du panier</th>
                     </TR>';

        /* Affichage des activités */
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            afficheActivite($row["Activity_Type_Name"], $row["Activity_Name"], $row["Activity_Date"], $row["Belong_Price"], $idco, $bdd);
        }

        /* Fermeture du tableau */
        echo'</TABLE></center>
                        </div>
                        <br></br></html>';

        /* Total */
        $sql = 'SELECT Basket_Meal_Total, Basket_Trip_Total, Basket_Total FROM Basket WHERE (Basket_ID = :id AND Congress_ID = 1)';
        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$basketID"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $totalrepas = $row["Basket_Meal_Total"];
        $totalexcursion = $row["Basket_Trip_Total"];
        $total = $row["Basket_Total"];

        /* Affichage des totaux */
        echo'
    <html>
         <div align="right">
               <TABLE id="tableau" border width=50% cols="2" style="border:1px solid black;width : 40%; margin-left : 0" >
                 
                 <CAPTION> <h2>Récapitulatif <br></h2> </CAPTION>
                    <TR class="row" >
                        <TH class ="col"   width=300 style="border:1px solid black; text-align : center;"> Total des repas </TH>
                        <Td class ="col"  width=101 style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF">' . $totalrepas . ' € </FONT></TH>
                    </TR>
                    <TR class="row" >
                        <TH class ="col"   width=300 style="border:1px solid black; text-align : center;"> Total des excursions </TH>
                        <Td class ="col"  width=101 style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF">' . $totalexcursion . ' € </FONT></TH>
                    </TR>
                    <TR class="row" >
                        <TH class ="col"   width=300 style="border:1px solid black; text-align : center;"><b> Total </b> </TH>
                        <Td class ="col"  width=101 style="border:1px solid black; text-align : center;"> <FONT style="color : #11ABB0"><b>' . $total . ' € </b></FONT></TH>
                    </TR>
                    </TABLE>
                        </div>
                        <br>
                        
<form name="validPanier" id="contactForm" method="post"  action="">
            <div align="right">
                <input type="submit" name="v" value="Valider">
            </div>
        </form></html>';
        
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
}

/* * ************************************************ */
/* Fontion pour afficher d'une activité libre */
/* * *********************************************** */

function afficheActivite($type, $nom, $date, $prix, $idco, $bdd) {

    echo'<TR >
                                        <Td class ="col" height=44.688  width=20% style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF">' . $type . '</FONT></Td>
                                        <Td class ="col" height=44.688 width=20% style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF">' . $date . ' </FONT></Td>
                                        <Td class ="col" height=44.688 width=20% style="border:1px solid black; text-align : center"> <FONT style="color : #F0FFFF"> ' . $nom . '  </FONT> </Td>
                                        <Td class ="col" height=44.688 width=15% style="border:1px solid black;text-align : center"><FONT style="color : #F0FFFF"> ' . $prix . '€</FONT></Td>
                                        <Td class ="col" width=100.65 style ="padding:9px 115px" height=44.688 width=25% style="border:1px solid black;text-align : center">  
                                            <form action="" method="post" onclick="alert(\'Activité supprimée du panier\')"> 
                                                <input type="submit" style= "padding:0 ; margin-bottom : 0;margin-top : 9; height : 25px; width : 25px; background:#FF5E4D"   name="supp" value="-">
                                                 <input type="hidden"  name="activity" value="' . $nom . '">
                                                  <input type="hidden"  name="idco" value="' . $idco . '">
                                                </form>
                                        </Td>                        
         </TR>';
}

/* Conexion à la base de données */
$bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', '');

affiche($bdd, $idco);
?> 