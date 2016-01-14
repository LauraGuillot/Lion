<?php

include "constantes.php";

/*
 * Ce fichier comporte la majorité des requêtes SQL qui sont utilisées dans le fichiers fonctions.php
 */

/* getMemberID
 * Paramètres : $bdd - base de données / $idco - identifiant de connexion du membre
 * Résultat : $memberID - identifiant du membre
 * Description : obtention de l'identifiant du membre à partir de son identifiant de connexion
 */

function getMemberID($bdd, $idco) {

    $sql1 = 'SELECT Member_ID FROM Connexion WHERE (Connexion_ID = :idco )';
    $stmt = $bdd->prepare($sql1, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('idco' => "$idco"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $memberID = $row["Member_ID"];

    return $memberID;
}

/* getBasketID
 * Paramètres : $bdd - base de données / $memberID - identifiant du membre
 * Résultat : $basketID - identifiant du panier du membre
 * Description : obtention du basketID à partir de l'identifiant du membre
 */

function getBasketID($bdd, $memberID) {

    $sql2 = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id )';
    $stmt = $bdd->prepare($sql2, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $basketID = $row["Basket_ID"];

    return $basketID;
}

/* setActivityCB
 * Paramètres : $bdd - base de données / $basketID - identifiant du panier du membre
 * Description : 
 * - Mise à jour du mode de paiement des activités payées : CB
 * - Mise à jour du booléen de paiement des activités payées
 * - Remise à 0 des totaux du panier
 */

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

/* setActivityCH
 * Paramètres : $bdd - base de données / $basketID - identifiant du panier du membre
 * Description : 
 * - Mise à jour du mode de paiement des activités commandées : CH
 * - Mise à jour de la date de commande 
 * - Remise à 0 des totaux du panier
 */

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

/* setCapacity
 * Paramètres : $bdd - base de données / $memberID - identifiant du membre / $basketID - identifiant du panier du membre
 * Description : 
 * Incrémentation des capacités des activités qui sont dans le panier de 1 ou 2 si il y a ou non un follower.
 */

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

/* videBasket
 * Paramètres : $bdd - base de données / $idco - identifiant de connexion du membre 
 * Description : 
 * - Suppression de toutes les activités du panier
 * - Remise à 0 des totaux
 */

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

/* suppConnexion
 * Paramètres : $bdd - base de données / $idco - identifiant de connexion du membre 
 * Description : 
 * Suppression d'une connexion d'un membre
 */
function suppConnexion($bdd, $idco) {
    $req0 = $bdd->prepare('DELETE FROM Connexion WHERE (Connexion_ID=:id)');
    $req0->execute(array('id' => $idco));
}


/* getActivityID
 * Paramètres : $bdd - base de données / $nom - nom de l'activité
 * Résultat : $activiteID - Identifiant de l'activité
 * Description : obtention de l'identifiant d'une activité à partir de son nom
 */
function getActivityID($bdd, $nom) {
    $sql3 = 'SELECT Activity_ID FROM Activity WHERE (Activity_Name = :nom )';
    $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('nom' => "$nom"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $activiteID = $row["Activity_ID"];

    return $activiteID;
}


/* estDans Panier
 * Paramètres : $bdd - base de données / $activiteID - Identifiant d'une activité / $basketId - Identifiant d'un panier
 * Résultat : $cpt - Compteur valant  0 ou 1 suivant si l'activité en paramètre est dans le panier en paramètre ou non
 */
function estDansPanier($bdd, $activiteID, $basketID) {

    $sql3 = 'SELECT count(Basket_ID) FROM Belong WHERE (Basket_ID = :Bid AND Activity_ID = :Aid )';
    $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('Bid' => "$basketID", 'Aid' => "$activiteID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["count(Basket_ID)"];

    return $cpt;
}


/* comptePanier
 * Paramètres : $bdd - base de données / $basketId - Identifiant d'un panier
 * Résultat : $cpt - Compteur
 * Description : fonction renvoyant le nombre d'activités dans un panier
 */
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

/* nbPersonne
 * Paramètres : $bdd - base de données / $memberID - Membre Id
 * Résultat : $n - Compteur
 * Description : Cette fonction renvoie un entier valant 1 si le membre n'a pas d'accompagnant et 2 sinon
 */
function nbPersonne($bdd, $memberID) {

    list ($fnom, $fprenom) = getFollower($bdd, $memberID);

    $n = 1; /* nombre de personnes */
    if (!(empty($fnom) && empty($fprenom))) {
        $n = $n + 1;
    }

    return $n;
}

/* getNbRepasAchetes
 * Paramètres : $bdd - base de données / $basketId - Identifiant d'un panier
 * Résultat : $cpt - Compteur
 * Description : fonction renvoyant le nombre de repas achetés par un membre
 */
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

/* getNbExcursionsAchetees
 * Paramètres : $bdd - base de données / $basketId - Identifiant d'un panier
 * Résultat : $cpt - Compteur
 * Description : fonction renvoyant le nombre d'excursions achetées par un membre
 */
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

/* getNbRepasCommandes
 * Paramètres : $bdd - base de données / $basketId - Identifiant d'un panier
 * Résultat : $cpt - Compteur
 * Description : fonction renvoyant le nombre de repas commandés par un membre
 */
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

/* getNbExcursionsCommandees
 * Paramètres : $bdd - base de données / $basketId - Identifiant d'un panier
 * Résultat : $cpt - Compteur
 * Description : fonction renvoyant le nombre d'excursions commandées par un membre
 */
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

/* getInfos
 * Paramètres : $bdd - base de données / $idco - Identifiant de connexion d'un membre
 * Résultats :    
 * - $memberID - identifiant du membre
 * - $nom - Nom du membre
 * - $prenom - Prénom du membre
 * - $titre - Civilité du membre (M., Melle, Mme)
 * - $status - Status du membre dans le clud ( 1 pour Lion et 2 pour Leo)
 * - $district - District ID du membre
 * - $club - Club ID du membre
 * - $num - Numéro de rue du membre
 * - $adressesup - Complément d'adresse du membre
 * - $rue - Rue du membre
 * - $ville - ville du membre
 * - $cp - Code postal du membre
 * - $tel - Téléphone du membre
 * - $mobile - Mobile du membre
 * - $mail - Adresse mail du membre
 * - $positionclub - Position du membre au sein du club
 * - $positiondistrict - Position du membre au sein du dustrict
 * - $train - Booléen valant 1 si le membre arrive par train et 0 sinon
 * - $traindate - Date de l'arrivée par train
 */
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

/* getFollower
 * Paramètres : $bdd - base de données / $memberID - Identifiant d'un membre
 * Résultats :    
 * - $fnom - Nom de l'accompagnant du membre 
 * - $fprenom - Prénom de l'accompagnant du membre
 */
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

/* getTotal
 * Paramètres : $bdd - base de données / $basketID - Identifiant d'un panier
 * Résultats :    
 * - $totalrepas -  Total des repas dans le panier
 * - $totalexcursion - Total des excursions dans le panier
 * - $total - Total des activités dans le panier
 */
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

/* getNbRepasPanier
 * Paramètres : $bdd - base de données / $basketId - Identifiant d'un panier
 * Résultat : $cpt - Compteur
 * Description : fonction renvoyant le nombre de repas dans le panier d'un membre
 */
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

/* getNbExcursionsPanier
 * Paramètres : $bdd - base de données / $basketId - Identifiant d'un panier
 * Résultat : $cpt - Compteur
 * Description : fonction renvoyant le nombre d'e repas'excursions dans le panier d'un membre
 */
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

/* insertBelong
 * Paramètres : $bdd - base de données / $basketId - Identifiant d'un panier / $activiteID - identifiant d'ue activité / $prix - Tarif 
 * Description : cette fonction insère une ligne dans la table belong avec les deux identifiants en paramètre et le prix. Le booléen Belong_Paid est mis à 0.
 */
function insertBelong($bdd, $activiteID, $basketID, $prix) {
    $sql4 = 'INSERT INTO Belong (Activity_ID, Basket_ID, Belong_Price, Belong_Paid) VALUES (:activiteID, :basketID , :prix, 0)';
    $stmt = $bdd->prepare($sql4);
    $stmt->execute(array('activiteID' => "$activiteID", 'basketID' => "$basketID", 'prix' => "$prix"));
}


/* testMail
 * Paramètres : $bdd - base de données / $email - Mail 
 * Résultat : $cpt - Compteur
 * Description : Cette fonction renvoie 1 si le mail en paramètre appartient à un membre du site et 0 sinon
 */
function testMail($bdd, $email) {

    $sql = 'SELECT Count(Member_ID) FROM Member WHERE (Member_EMail = :mail)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('mail' => "$email"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row["Count(Member_ID)"];

    return $cpt;
}

/* setMdp
 * Paramètres : $bdd - base de données / $id - Identifiant d'un membre / $mdp - Mot de passe
 * Description : Mise à jour du mot de passe du membre passé en paramètre.
 */
function setMdp($bdd, $id, $mdp) {
    $sql = 'UPDATE Member SET Member_Password = :mdp WHERE (Member_ID= ' . $id . ')';
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array('mdp' => "$mdp"));
}

/* getMemberIDMail
 * Paramètres : $bdd - base de données / $email - Mail 
 * Résultat : $id - Identifiant d'un membre
 * Description : Récupération de l'identifiant d'un membre à partir de son adresse mail
 */
function getMemberIDMail($bdd, $email) {

    $sql = 'SELECT Member_ID FROM Member WHERE (Member_EMail = :mail)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array('mail' => "$email"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $id = $row["Member_ID"];

    return $id;
}

/* deleteAct
 * Paramètres : $bdd - base de données / $activiteId - Identifiant d'une activité / $basketID - Identifiant d'un panier 
 * Description : Suppression d'une ligne dans la table belong ( la ligne avec les deux identifiants passés en paramètre)
 */
function deleteAct($bdd, $activiteID, $basketID) {
    $sql4 = 'DELETE FROM Belong WHERE (Activity_ID = :aid AND Basket_ID = :bid)';
    $stmt = $bdd->prepare($sql4);
    $stmt->execute(array('aid' => "$activiteID", 'bid' => "$basketID"));
}

/* dateAuj
 * Paramètres : $bdd - base de données 
 * Résultat : 
 * - $annee - Année 
 * - $mois - Mois
 * - $day - Jour
 * - $heure - Heure
 * - $min - Minutes
 * - $sec - Secondes
 * Description : Récupération de la date et l'heure courantes
 */
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

    
    //Ajout d'un 0 pour les mois et jours inférieurs à 10
    if ($mois < 10) {
        $mois = "0" . $mois;
    }
    if ($day < 10) {
        $day = "0" . $day;
    }
    
    return array($annee, $mois, $day, $heure, $min, $sec);
}

/* testConnexionMembre
 * Paramètres : $bdd - base de données / $memberID - Identifiant d'un membre 
 * Résultat : $cpt - Compteur
 * Description : Fonction renvoyant 1 si le membre est connecté et 0 sinon
 */
function testConnexionMembre($bdd, $memberID) {

    $sql = 'SELECT Count(Connexion_ID) FROM Connexion WHERE (Member_ID = :id) ';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row['Count(Connexion_ID)'];

    return $cpt;
}

/*insertConnexion
 * Paramètres : $bdd - base de données / $memberID - Identifiant d'un membre / $idco - Identifiant de connexion
 * Description : Ajout d'une connexion pour un membre
 */
function insertConnexion($bdd, $memberID, $idco) {
    $req9 = $bdd->prepare('INSERT INTO Connexion (Connexion_ID, Last_Connexion, Member_ID ) VALUE (:chaine,NOW(), :id)');
    $req9->execute(array(
        'chaine' => "$idco",
        'id' => "$memberID"));
}

/* getIdco
 * Paramètres : $bdd - base de données / $memberID - Identifiant d'un membre 
 * Résultat : $idco - Identifiant de connexion
 * Description : Fonction renvoyant l'identifiant de connexion d'un membre à partir de son identifiant
 */
function getIdco($bdd, $memberID) {

    $sql = 'SELECT Connexion_ID FROM Connexion WHERE (Member_ID = :id) ';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $idco = $row['Connexion_ID'];

    return $idco;
}


/* majConnexion
 * Paramètres : $bdd - base de données /$idco - Identifiant de connexion 
 * Description : Fonction mettant à jour la table connexion en mettant à jour la date de dernière activité d'un membre.
 * Un membre qui n'a plus de connexion (inactivité > 30min) est redirigé vers la page d'accueil.
 */
function majConnexion($bdd, $idco) {
    
    $sql = 'SELECT Count(Member_ID) FROM Connexion WHERE (Connexion_ID = :id) ';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$idco"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $cpt = $row['Count(Member_ID)'];
    
    //Si le membre n'a plus de connexion : on le redirige vers l'accueil
    if ($cpt == 0){
        header("Location: http://Localhost/lion/Lion/php/home.php");
    }else{ //On met à jour sa date de dernier clic
    
    $req9 = $bdd->prepare("UPDATE Connexion SET Last_Connexion= NOW() WHERE (Connexion_ID =:idco)");
    $req9->execute(array(
        'idco' => "$idco"));
}}

/*now
 * Paramètres : $bdd - base de données 
 * Résultat : $now - Date
 * Description : Récupération de la date courante
 */ 
function now($bdd) {
    $sql = 'SELECT NOW()';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array());
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $now = $row['NOW()'];

    return $now;
}

/*getDatePanier
 * Paramètres : $bdd - base de données / $basketId - Identifiant du panier
 * Résultat : $belongdate - Date 
 * Description : Récupération de la date du dernier panier
 */ 
function getDatePanier($bdd, $basketID) {

    $sql = 'SELECT Belong_Date FROM Activity '
            . ' INNER JOIN Belong ON (Belong.Activity_ID = Activity.Activity_ID) '
            . ' WHERE (Basket_ID = :id  AND Belong_Payement_Way="CH" AND Congress_ID = ' . congressID . ') ORDER BY (Belong_Date) DESC';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$basketID"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $belongdate = $row["Belong_Date"];

    return $belongdate;
}

/*miseajourinfos
 * Paramètres : 
 * $bdd - base de données 
 * - $nom - Nom du membre
 * - $prenom - Prénom du membre
 * - $num - Numéro de rue du membre
 * - $adressesup - Complément d'adresse du membre
 * - $rue - Rue du membre
 * - $ville - ville du membre
 * - $cp - Code postal du membre
 * - $tel - Téléphone du membre
 * - $mobile - Mobile du membre
 * - $mail - Adresse mail du membre
 * Description : Mise à jour des informations du membre dont l'identifiant de connexion est passé en paramètre
 */ 
function miseajourinfos($bdd,$idco,$email,$nom,$prenom,$rue,$num,$cadr,$cp,$ville,$tel,$portable) {

    $memberid = getMemberID($bdd, $idco);

  $sql = 'SELECT Person_ID FROM Member WHERE (Member_ID = :id)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute(array(':id' => "$memberid"));
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    $personid = $row["Person_ID"];
 
 
 $sql2 = 'UPDATE Member SET Member_Email= :email ,Member_Street = :street,Member_Postal_Code = :cp,Member_Additional_Adress = :cadr,Member_City = :city,Member_Phone = :phone,Member_Mobile = :mobile,Member_Num = :num WHERE (Member_ID = :id)';
        $stmt = $bdd->prepare($sql2);
        $stmt->execute(array('email' => "$email",'street' => "$rue",'cp' => "$cp",'cadr' => "$cadr",'city' => "$ville",'phone' => "$tel",'mobile' => "$portable", 'num' => "$num" ,'id' => "$memberid"));

$sql2 = 'UPDATE Person SET Person_Lastname= :nom ,Person_Firstname= :prenom WHERE (Person_ID = :id)';
$stmt = $bdd->prepare($sql2);
$stmt->execute(array('nom' => "$nom",'prenom' => "$prenom",'id' => "$personid"));

   
        
}