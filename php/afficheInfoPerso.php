<?php
$idco = $_GET['idco'];

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

/*Affichage des données personnelles avec possibilité de modification*/
