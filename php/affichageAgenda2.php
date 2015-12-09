<?php

$idco = $_GET['idco'];


/* * ****************************************** */
/* Fontion pour afficher le tableau des repas */
/* * ****************************************** */

function afficheRepas($bdd, $idco) {
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
                        <TH class ="col"  height=60 width=20% style="border:1px solid black;">Date</TH>
                        <TH class ="col" height=60 width=30% style="border:1px solid black;">Intitulé </TH>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif privilège <br>(jusqu\'au 31/30)  </th>
                        <th class ="col" height=60 width=20% style="border:1px solid black">Tarif plein <br>(à compter du 01/04)  </th>
                        <th class ="col" height=60 width=100.65 width=10% style="border:1px solid black"> <FONT size="2.5pt">Ajouter au panier </FONT></th>
                     </TR>';

        /* Affichage des activités */
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            if ($row["Activity_Capacity"] > 0) {
                afficheActiviteLibre($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"], $idco, $bdd);
            } else {
                afficheActiviteComplete($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"], $idco, $bdd);
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

function afficheExcursions($bdd, $idco) {
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
                        <th class ="col" height=60 width=100.65 width=10% style="border:1px solid black"> <FONT size="2.5pt">Ajouter au panier </FONT></th>
                     </TR>';

        /* Affichage des activités */
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

            if ($row["Activity_Capacity"] > 0) {
                afficheActiviteLibre($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"], $idco, $bdd);
            } else {
                afficheActiviteComplete($row["Activity_Name"], $row["Activity_Date"], $row["Activity_Price1"], $row["Activity_Price2"], $idco, $bdd);
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

function afficheActiviteLibre($nom, $date, $prix1, $prix2, $idco, $bdd) {

    /* On teste si l'utilisateur a déjà réseré cette activité ou non */
    /* On récupère l'id du membre */
    $sql1 = 'SELECT Member_ID FROM Member WHERE (Connexion_ID = :idco )';
    $stmt = $bdd->prepare($sql1, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('idco' => "$idco"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];

    /* On récupère son basket id */
    $sql2 = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql2, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];

    /* On récupère d'activité ID */
    $sql3 = 'SELECT Activity_ID FROM Activity WHERE (Activity_Name = :nom )';
    $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('nom' => "$nom"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $activiteID = $row["Activity_ID"];

    /* on regarde si l'activité est dans son panier ou non */
    $sql3 = 'SELECT count(Basket_ID) FROM Belong WHERE (Basket_ID = :Bid AND Activity_ID = :Aid )';
    $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('Bid' => "$basketID", 'Aid' => "$activiteID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["count(Basket_ID)"];

    if ($cpt != 0) {

        echo' <TR style="color: #525252;">
                                        <Td class ="col" height =66 width=20% style="border:1px solid black; text-align : center;"><b> ' . $date . '</b></Td>
                                        <Td class ="col" height =66 width=30% style="border:1px solid black; text-align : center;"> ' . $nom . '</Td>
                                        <Td class ="col" height =66 width=20% style="border:1px solid black; text-align : center"> ' . $prix1 . ' € </Td>
                                        <Td class ="col" height =66 width=20% style="border:1px solid black;text-align : center">' . $prix2 . ' €</Td>
                                        <Td class ="col" height =66 width=100.65 width=10% style="border:1px solid black;text-align : center"><FONT style="color : #70F861"> Déjà réservée </FONT></Td>
                                    </TR>';
    } else {
        echo'<TR >
                                        <Td class ="col" height=44.688  width=20% style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF"><b>' . $date . '</b></FONT></Td>
                                        <Td class ="col" height=44.688 width=30% style="border:1px solid black; text-align : center;"> <FONT style="color : #F0FFFF">' . $nom . ' </FONT></Td>
                                        <Td class ="col" height=44.688 width=20% style="border:1px solid black; text-align : center"> <FONT style="color : #F0FFFF"> ' . $prix1 . ' € </FONT> </Td>
                                        <Td class ="col" height=44.688 width=20% style="border:1px solid black;text-align : center"><FONT style="color : #F0FFFF"> ' . $prix2 . '€</FONT></Td>
                                        <Td class ="col" width=100.65 style ="padding:9px 36px" height=44.688 width=10% style="border:1px solid black;text-align : center">  
                                            <form action="ajoutActivite.php" method="post" onclick="alert(\'Activité ajoutée au panier\')"> 
                                                <input type="submit" style= "padding:0 ; margin-bottom : 0;margin-top : 9; height : 25px; width : 25px; background:#70F861"   name="add" value="+">
                                                 <input type="hidden"  name="activity" value="' . $nom . '">
                                                  <input type="hidden"  name="idco" value="' . $idco . '">
                                                </form>
                                        </Td>                        
         </TR>';
    }
}

/* * ************************************************ */
/* Fontion pour afficher d'une activité complète */
/* * *********************************************** */

function afficheActiviteComplete($nom, $date, $prix1, $prix2, $idco, $bdd) {
    /* On teste si l'utilisateur a déjà réseré cette activité ou non */
    /* On récupère l'id du membre */
    $sql1 = 'SELECT Member_ID FROM Member WHERE (Connexion_ID = :idco )';
    $stmt = $bdd->prepare($sql1, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('idco' => "$idco"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];

    /* On récupère son basket id */
    $sql2 = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql2, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];

    /* On récupère d'activité ID */
    $sql3 = 'SELECT Activity_ID FROM Activity WHERE ( Activity_Name = :nom )';
    $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('nom' => "$nom"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $activiteID = $row["Activity_ID"];

    echo"$activiteID";
    /* on regarde si l'activité est dans son panier ou non */
    $sql3 = 'SELECT count(Basket_ID) FROM Belong WHERE (Basket_ID = :Bid AND Activity_ID = :Aid )';
    $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('Bid' => "$basketID", 'Aid' => "$activiteID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["count(Basket_ID)"];
echo"$cpt";

    if ($cpt == 0) {

        echo' <TR style="color: #525252;">
                                        <Td class ="col" height =33 width=20% style="border:1px solid black; text-align : center;"><b> ' . $date . '</b></Td>
                                        <Td class ="col" height =33 width=30% style="border:1px solid black; text-align : center;"> ' . $nom . '</Td>
                                        <Td class ="col" height =33 width=20% style="border:1px solid black; text-align : center"> ' . $prix1 . ' € </Td>
                                        <Td class ="col" height =33 width=20% style="border:1px solid black;text-align : center">' . $prix2 . ' €</Td>
                                        <Td class ="col" height =33 width=100.65 width=10% style="border:1px solid black;text-align : center"><FONT style="color : #FF5E4D"> Complet </FONT></Td>
                                    </TR>';
    } else {
        echo' <TR style="color: #525252;">
                                        <Td class ="col" height =66 width=20% style="border:1px solid black; text-align : center;"><b> ' . $date . '</b></Td>
                                        <Td class ="col" height =66 width=30% style="border:1px solid black; text-align : center;"> ' . $nom . '</Td>
                                        <Td class ="col" height =66 width=20% style="border:1px solid black; text-align : center"> ' . $prix1 . ' € </Td>
                                        <Td class ="col" height =66 width=20% style="border:1px solid black;text-align : center">' . $prix2 . ' €</Td>
                                        <Td class ="col" height =66 width=100.65 width=10% style="border:1px solid black;text-align : center"><FONT style="color : #70F861"> Déjà réservée </FONT></Td>
                                    </TR>';
    }
}

function afficheAgenda($idco) {

    /* Conexion à la base de données */
    $bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', '');

    /* Affichage des activités */
    echo'<html> <div class="row section-head">
        <div class="col full">
            <span><h2 style = "color :#11ABB0; margin : 65px; text-align : center">Agenda des conférences et des activités</h2><span>
        </div>
        </html>';

    afficheRepas($bdd, $idco);
    afficheExcursions($bdd, $idco);
    echo'<html> </div></html>';
}

afficheAgenda($idco);
?> 