<?php

include "constantes.php";

//Sélection du memberID
function getMemberID($bdd, $idco) {

    $sql1 = 'SELECT Member_ID FROM Connexion WHERE (Connexion_ID = :idco )';
    $stmt = $bdd->prepare($sql1, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('idco' => "$idco"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];

    return $memberID;
}

//Sélection du basketID
function getBasketID($bdd, $memberID) {

    $sql2 = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql2, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];

    return $basketID;
}

//Mise à jour des activités payées par CB
function setActivityCB($bdd, $basketID) {
    /* On met à jour les activités payées */
    $sql3 = 'UPDATE Belong SET Belong_Payement_Way = "CB" WHERE (Basket_ID = :id AND Belong_Paid =0 AND Belong_Payement_Way IS NULL)';
    $stmt = $bdd->prepare($sql3);
    $stmt->execute(array('id' => "$basketID"));

    $sql4 = 'UPDATE Belong SET Belong_Paid = 1 WHERE (Basket_ID = :id AND Belong_Payement_Way LIKE "CB")';
    $stmt = $bdd->prepare($sql4);
    $stmt->execute(array('id' => "$basketID"));

    /* On remet à 0 tous les totaux du panier */
    $sql5 = 'UPDATE Basket SET Basket_Total = 0 WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql5);
    $stmt->execute(array('id' => "$basketID"));


    $sql6 = 'UPDATE Basket SET Basket_Trip_Total = 0 WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql6);
    $stmt->execute(array('id' => "$basketID"));

    $sql6 = 'UPDATE Basket SET Basket_Meal_Total = 0 WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql6);
    $stmt->execute(array('id' => "$basketID"));
}

//Enregistrement d'une nouvelle commande
function setActivityCH($bdd, $basketID) {

    /* On met à jour les activités commandées */
    $sql3 = 'UPDATE Belong SET Belong_Payement_Way = "CH" WHERE (Basket_ID = :id AND Belong_Paid =0)';
    $stmt = $bdd->prepare($sql3);
    $stmt->execute(array('id' => "$basketID"));

    $sql3 = 'UPDATE Belong SET Belong_Date = NOW() WHERE (Basket_ID = :id AND Belong_Paid =0 AND Belong_Date IS NULL)';
    $stmt = $bdd->prepare($sql3);
    $stmt->execute(array('id' => "$basketID"));

    /* On remet à 0 tous les totaux du panier */
    $sql5 = 'UPDATE Basket SET Basket_Total = 0 WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql5);
    $stmt->execute(array('id' => "$basketID"));


    $sql6 = 'UPDATE Basket SET Basket_Trip_Total = 0 WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql6);
    $stmt->execute(array('id' => "$basketID"));

    $sql6 = 'UPDATE Basket SET Basket_Meal_Total = 0 WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql6);
    $stmt->execute(array('id' => "$basketID"));
}

//Incrémentation des capacités des activités de 1 ou 2 si il y a un follower
function setCapacity($bdd, $memberID, $basketID) {
    $sql1 = 'SELECT Count(Follower_ID) FROM Follower WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql1, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $c = $row["Count(Follower_ID)"];

    $sql = 'SELECT Activity.Activity_ID , Activity_Capacity FROM Activity  INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) WHERE (Basket_ID =' . $basketID . ' AND Belong_Paid =0 AND Belong_Payement_Way IS NULL AND Congress_ID =' . congressID . ' )';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array());


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

        $activiteID = $row["Activity_ID"];
        $cap = $row["Activity_Capacity"];
        $cap1 = "$cap" + "1" + "$c"; /* Si il y a un follower, on augmente de 2 */

        $sql2 = 'UPDATE Activity SET Activity_Capacity = :c WHERE (Activity_ID = :id AND Congress_ID =' . congressID . ' )';
        $stmt2 = $bdd->prepare($sql2);
        $stmt2->execute(array('c' => "$cap1", 'id' => "$activiteID"));
    }
}

//Vidage d'un panier
function videBasket($bdd, $basketID) {
    $sql = 'DELETE FROM Belong WHERE(Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL)';
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(':id' => "$basketID"));

    /* Remise à 0 des totaux du panier */
    $sql = 'UPDATE Basket SET Basket_Total =0 WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(':id' => "$basketID"));

    $sql = 'UPDATE Basket SET Basket_Meal_Total =0 WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(':id' => "$basketID"));

    $sql = 'UPDATE Basket SET Basket_Trip_Total =0 WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(':id' => "$basketID"));
}

//Suppression d'une connexion
function suppConnexion($bdd, $idco) {
    $req0 = $bdd->prepare('DELETE FROM Connexion WHERE (Connexion_ID=:id)');
    $req0->execute(array('id' => $idco));
}

//Sélection d'un ActivityID à partir de son nom
function getActivityID($bdd, $nom) {
    $sql3 = 'SELECT Activity_ID FROM Activity WHERE (Activity_Name = :nom )';
    $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('nom' => "$nom"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $activiteID = $row["Activity_ID"];

    return $activiteID;
}

//Test pour voir si une activité est dans un panier ou non
function estDansPanier($bdd, $activiteID, $basketID) {

    $sql3 = 'SELECT count(Basket_ID) FROM Belong WHERE (Basket_ID = :Bid AND Activity_ID = :Aid )';
    $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('Bid' => "$basketID", 'Aid' => "$activiteID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["count(Basket_ID)"];

    return $cpt;
}

//Sélection du nombre d'activités dans un panier
function comptePanier($bdd, $basketID) {
    $sql = 'SELECT Count(Activity.Activity_ID) FROM Activity '
            . 'INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Congress_ID =' . congressID . ' ) ';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Activity.Activity_ID)"];

    return $cpt;
}

//Sélection du nombre de réservations pour une activité : si un membre est accompagné, on renvoie 2 sinon on renvoie 1
function nbPersonne($bdd, $memberID) {

    list ($fnom, $fprenom) = getFollower($bdd, $memberID);

    $n = 1; /* nombre de personnes */
    if (!(empty($fnom) && empty($fprenom))) {
        $n = $n + 1;
    }

    return $n;
}

//Sélection du nombre de repas réservés par qqn
function getNbRepasAchetes($bdd, $basketID) {

    $sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 1 AND Activity_Type_Name = "Repas" AND Congress_ID = ' . congressID . ')';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Activity.Activity_ID)"];

    return $cpt;
}

//Sélection du nombre d'excursions réservées par qqn
function getNbExcursionsAchetees($bdd, $basketID) {

    $sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 1 AND Activity_Type_Name = "Excursion" AND Congress_ID = ' . congressID . ')';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Activity.Activity_ID)"];

    return $cpt;
}

//Sélection du nombre de repas réservés par qqn
function getNbRepasCommandes($bdd, $basketID) {

    $sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way="CH" AND Activity_Type_Name = "Repas" AND Congress_ID =' . congressID . ' )';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Activity.Activity_ID)"];

    return $cpt;
}

//Sélection du nombre d'excursions réservées par qqn
function getNbExcursionsCommandees($bdd, $basketID) {
    $sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way="CH" AND Activity_Type_Name = "Excursion" AND Congress_ID =' . congressID . ' )';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Activity.Activity_ID)"];

    return $cpt;
}

//Sélection des informations personnelles d'un membre
function getInfos($bdd, $idco) {
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

    return array($memberID, $nom, $prenom, $titre, $status, $district, $club, $num, $adressesup, $rue, $ville, $cp, $tel, $mobile, $mail, $positionclub, $positiondistrict, $train, $traindate);
}

//Sélection du follower d'un membre
function getFollower($bdd, $memberID) {
    $sql = 'SELECT Person_Lastname, Person_Firstname '
            . 'FROM Follower '
            . ' INNER JOIN Person ON (Person.Person_ID = Follower.Person_ID) '
            . ' INNER JOIN Member ON (Member.Member_ID = Follower.Member_ID)'
            . ' WHERE (Member.Member_ID = :id)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $fnom = $row["Person_Lastname"];
    $fprenom = $row["Person_Firstname"];

    return array($fnom, $fprenom);
}

//Sélection des totaux d'un panier
function getTotal($bdd, $basketID) {
    $sql = 'SELECT Basket_Meal_Total, Basket_Trip_Total, Basket_Total FROM Basket WHERE (Basket_ID = :id)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $totalrepas = $row["Basket_Meal_Total"];
    $totalexcursion = $row["Basket_Trip_Total"];
    $total = $row["Basket_Total"];

    return array($totalrepas, $totalexcursion, $total);
}

//Sélection du nombre de repas dans le panier
function getNbRepasPanier($bdd, $basketID) {

    $sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Repas" AND Congress_ID = ' . congressID . ')';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Activity.Activity_ID)"];

    return $cpt;
}

//Sélection du nombre d'e repas'excursions dans le panier
function getNbExcursionsPanier($bdd, $basketID) {

    $sql = 'SELECT  Count(Activity.Activity_ID) FROM Activity '
            . ' INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id AND Belong_Paid = 0 AND Belong_Payement_Way IS NULL AND Activity_Type_Name = "Excursion" AND Congress_ID = ' . congressID . ')';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Activity.Activity_ID)"];

    return $cpt;
}

//Insertion d'une activité dans le panier
function insertBelong($bdd, $activiteID, $basketID, $prix) {
    $sql4 = 'INSERT INTO Belong (Activity_ID, Basket_ID, Belong_Price, Belong_Paid) VALUES (:activiteID, :basketID , :prix, 0)';
    $stmt = $bdd->prepare($sql4);
    $stmt->execute(array('activiteID' => "$activiteID", 'basketID' => "$basketID", 'prix' => "$prix"));
}

//Test si un mail appartient à un membre
function testMail($bdd, $email) {

    $sql = 'SELECT Count(Member_ID) FROM Member WHERE (Member_EMail = :mail)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('mail' => "$email"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Member_ID)"];

    return $cpt;
}

//Mise à jour d'un mot de passe
function setMdp($bdd, $id, $mdp) {
    $sql = 'UPDATE Member SET Member_Password = :mdp WHERE (Member_ID= ' . $id . ')';
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array('mdp' => "$mdp"));
}

//Sélection de l'id d'un membre à partir de son mail
function getMemberIDMail($bdd, $email) {

    $sql = 'SELECT Member_ID FROM Member WHERE (Member_EMail = :mail)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('mail' => "$email"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $id = $row["Member_ID"];

    return $id;
}

//Suppression d'une activité du panier
function deleteAct($bdd, $activiteID, $basketID) {
    $sql4 = 'DELETE FROM Belong WHERE (Activity_ID = :aid AND Basket_ID = :bid)';
    $stmt = $bdd->prepare($sql4);
    $stmt->execute(array('aid' => "$activiteID", 'bid' => "$basketID"));
}

//Récupération de la date actuelle
function dateAuj($bdd) {

    $req8 = $bdd->prepare("SELECT YEAR(DATE(Now()))", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req8->execute(array());
    $row = $req8->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $annee = $row["YEAR(DATE(Now()))"];

    $req82 = $bdd->prepare("SELECT MONTH(DATE(Now()))", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req82->execute(array());
    $row = $req82->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $mois = $row["MONTH(DATE(Now()))"];

    $req83 = $bdd->prepare("SELECT DAY(DATE(Now()))", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req83->execute(array());
    $row = $req83->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $day = $row["DAY(DATE(Now()))"];

    $req81 = $bdd->prepare("SELECT HOUR(Now())", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req81->execute(array());
    $row = $req81->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $heure = $row["HOUR(Now())"];

    $req84 = $bdd->prepare("SELECT MINUTE(Now())", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req84->execute(array());
    $row = $req84->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $min = $row["MINUTE(Now())"];

    $req85 = $bdd->prepare("SELECT SECOND(Now())", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req85->execute(array());
    $row = $req85->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $sec = $row["SECOND(Now())"];

    return array($annee, $mois, $day, $heure, $min, $sec);
}

//Test si une connexion est active pour un membre
function testConnexionMembre($bdd, $memberID) {

    $sql = 'SELECT Count(Connexion_ID) FROM Connexion WHERE (Member_ID = :id) ';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row['Count(Connexion_ID)'];

    return $cpt;
}

//Insertion d'une connexion
function insertConnexion($bdd, $memberID, $idco) {
    $req9 = $bdd->prepare('INSERT INTO Connexion (Connexion_ID, Last_Connexion, Member_ID ) VALUE (:chaine,NOW(), :id)');
    $req9->execute(array(
        'chaine' => "$idco",
        'id' => "$memberID"));
}

//Sélection de l'identifiant de connexion d'un membre
function getIdco($bdd, $memberID) {

    $sql = 'SELECT Connexion_ID FROM Connexion WHERE (Member_ID = :id) ';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $idco = $row['Connexion_ID'];

    return $idco;
}

//Mise à jour de la date de connexion
function majConnexion($bdd, $idco) {
    $req9 = $bdd->prepare("UPDATE Connexion SET Last_Connexion= NOW() WHERE (Connexion_ID =:idco)");
    $req9->execute(array(
        'idco' => "$idco"));
}

//Récupération de la date courante 
function now($bdd){
    $sql = 'SELECT NOW()';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array());
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $now = $row['NOW()'];
    
    return $now;
}

//Récupération de la date du dernier panier
function getDatePanier ($bdd, $basketID){
    
    $sql = 'SELECT Belong_Date FROM Activity '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id  AND Belong_Payement_Way="CH" AND Congress_ID = ' . congressID . ') ORDER BY (Belong_Date) DESC';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $belongdate = $row["Belong_Date"];
    
    return $belongdate;
}

