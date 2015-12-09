<?php

/* * ****************************************** */
/* Fontion pour afficher le tableau des repas */
/* * ****************************************** */

function afficheRepas($bdd) {
    try {

        /* Préparation de la requête */
        $sql = 'SELECT Activity_Name, Activity_Date, Activity_Price1, Activity_Price2, Activity_Capacity FROM Activity ' .
                'INNER JOIN Activity_Type ON (Activity.Activity_Type_ID = Activity_Type.Activity_Type_ID) ' .
                'WHERE (Congress_ID = 1 AND (Activity_Type_Name= :nom)) ORDER BY (Activity_Date);';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));

        /* Exécution de la requête */
        $stmt->execute(array(':nom' => 'Repas'));

        /* Exploitation des résultats */

        /* Création du tableau */
        echo'
    <html>
         <div>
               <center><TABLE id="tableau" cols="3" style="border:1px solid black">
                    <CAPTION> <h2>Repas<br></br></h2> </CAPTION>

                    <TR class="row" >
                        <TH class ="col" height=60 width=20% style="border:1px solid black;">Date</TH>
                        <TH class ="col" height=60 width=30% style="border:1px solid black;">Intitulé </TH>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif privilège <br>(jusqu\'au 31/30)  </th>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif plein <br>(à compter du 01/04)  </th>
                        <th class ="col" height=60 width=100.65 width=10% style="border:1px solid black"> <FONT size="2.5pt">Places restantes </FONT></th>
                     </TR>';

        /* Affichage des activités */
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            if ($row["Activity_Capacity"] > 0) {
                afficheActiviteLibre($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"],$row["Activity_Capacity"]);
            } else {
                afficheActiviteComplete($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"]);
            }
        }

        /* Fermeture du tableau */
        echo'</TABLE></center>
                        </div>
                        <br></br></html>';
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
}

/* * ************************************************ */
/* Fontion pour afficher le tableau des excursions */
/* * *********************************************** */

function afficheExcursions($bdd) {
    try {

        /* Préparation de la requête */
        $sql = 'SELECT Activity_Name, Activity_Date, Activity_Price1, Activity_Price2, Activity_Capacity FROM Activity ' .
                'INNER JOIN Activity_Type ON (Activity.Activity_Type_ID = Activity_Type.Activity_Type_ID) ' .
                'WHERE (Congress_ID = 1 AND (Activity_Type_Name= :nom)) ORDER BY (Activity_Date);';

        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));

        /* Exécution de la requête */
        $stmt->execute(array(':nom' => 'Excursion'));

        /* Exploitation des résultats */

        /* Création du tableau */
        echo'
    <html>
         <div>
               <center><TABLE id="tableau" cols="3" style="border:1px solid black">
                    <CAPTION> <h2>Excursions<br></br></h2> </CAPTION>

                    <TR class="row" >
                        <TH class ="col" height=60 width=20% style="border:1px solid black;">Date</TH>
                        <TH class ="col" height=60 width=30% style="border:1px solid black;">Intitulé </TH>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif privilège <br>(jusqu\'au 31/30)  </th>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif plein <br>(à compter du 01/04)  </th>
                        <th class ="col" height=60 width=100.65 width=10% style="border:1px solid black"> <FONT size="2.5pt">Places restantes </FONT></th>
                     </TR>';

        /* Affichage des activités */
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            if ($row["Activity_Capacity"] > 0) {
                afficheActiviteLibre($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"], $row["Activity_Capacity"]);
            } else {
                afficheActiviteComplete($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"]);
            }
        }

        /* Fermeture du tableau */
        echo'</TABLE></center>
                        </div>
                        <br></br></html>';
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
}

/* * ************************************************ */
/* Fontion pour afficher d'une activité libre */
/* * *********************************************** */

function afficheActiviteLibre($nom, $date, $prix1, $prix2, $capacity) {

    echo'<TR >
                                        <Td class ="col" height =33 rowspan="2" width=20% style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF"><b>' . $date . '</b></FONT></Td>
                                        <Td class ="col" height =33 width=30% style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF">' . $nom . ' </FONT></Td>
                                        <Td class ="col" height =33 width=20% style="border:1px solid black; text-align : center"> <FONT style="color : #F0FFFF"> ' . $prix1 . ' € </FONT> </Td>
                                        <Td class ="col" height =33 width=20% style="border:1px solid black;text-align : center"><FONT style="color : #F0FFFF"> ' . $prix2 . '€</FONT></Td>
                                        <Td class ="col" height =33 width=100.65 width=10% style="border:1px solid black;text-align : center"><FONT style="color : #70F861"> <b> '.$capacity.' </b></FONT></Td>
                                    </TR>';
}

/* * ************************************************ */
/* Fontion pour afficher d'une activité complète */
/* * *********************************************** */

function afficheActiviteComplete($nom, $date, $prix1, $prix2) {

    echo' <TR style="color: #525252;">
                                        <Td class ="col"  height =33 width=20% style="border:1px solid black; text-align : center;"><b> ' . $date . '</b></Td>
                                        <Td class ="col" height =33 width=30% style="border:1px solid black; text-align : center;"> ' . $nom . '</Td>
                                        <Td class ="col" height =33 width=20% style="border:1px solid black; text-align : center"> ' . $prix1 . ' € </Td>
                                        <Td class ="col" height =33 width=20% style="border:1px solid black;text-align : center">' . $prix2 . ' €</Td>
                                        <Td class ="col" height =33 width=100.65 style="border:1px solid black;text-align : center"><FONT style="color : #FF5E4D"> Complet </FONT></Td>
                                    </TR>';
}

function afficheAgenda() {

    /* Conexion à la base de données */
    $bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', '');

    /* Affichage des activités */
    echo'<html> <div class="row section-head">
        <div class="col full">
            <span><h2 style = "color :#11ABB0; margin : 65px; text-align : center">Agenda des conférences et des activités <br>
           <center><FONT size="3.5pt " style = "color :#F0FFFF ;font-weight:normal">Connectez vous pour pouvoir choisir des activités!</center></FONT></h2><span>
        </div>
        </html>';
    
    afficheRepas($bdd);
    afficheExcursions($bdd);
   echo'</html> </div></html>';
}

afficheAgenda();
?> 