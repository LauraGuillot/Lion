<?php

<<<<<<< Updated upstream
$email = $_POST['email'];
$mdp = $_POST['mdp'];
$mdp2 = $_POST['mdp2'];
$civilite = $_POST['civilite'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$titre = $_POST['titre'];
$district = $_POST['district'];
$club = $_POST['club'];
$rue = $_POST['rue'];
$num = $_POST['num'];
$cp = $_POST['cp'];
$ville = $_POST['ville'];
$pays = $_POST['pays'];
$tel = $_POST['tel'];
$portable = $_POST['portable'];
$fClub = $_POST['fClub'];
$fDistrict = $_POST['fDistrict'];
$prenomAcc = $_POST['prenomAcc'];
$nomAcc = $_POST['nomAcc'];
$train = $_POST['train'];
$traindate = $_POST['traindate'];
$trainheure = $_POST['trainheure'];
=======
	$email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $mdp2 = $_POST['cmdp'];
	$civilite = $_POST['civilite'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $titre = $_POST['titre'];
    $district = $_POST['district'];
    $club = $_POST['club'];
    $rue = $_POST['rue'];
    $num = $_POST['num'];
    $cp = $_POST['cp'];
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];
    $tel = $_POST['tel'];
    $portable = $_POST['portable'];
    $fClub = $_POST['fClub'];
    $fDistrict = $_POST['fDistrict'];
    $prenomAcc = $_POST['prenomAcc'];
    $nomAcc = $_POST['nomAcc'];
    $train = $_POST['train'];
    $traindate = $_POST['traindate'];
    $trainheure = $_POST['trainheure'];
    

if (empty($fClub) or empty($fDistrict)) {
    include("inscriptionnew3.php");
} else {
    $bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', '');
    $req0 = $bdd->prepare('INSERT INTO Person (Person_Lastname, Person_Firstname) VALUES (:nom,:prenom)');
    $req0->execute(array(
        'nom' => "$nom",
        'prenom' => "$prenom"));

    $req1 = $bdd->prepare('INSERT INTO Person (Person_Lastname, Person_Firstname) VALUES (:nomAcc,:prenomAcc)');
    $req1->execute(array(
        'nomAcc' => "$nomAcc",
        'prenomAcc' => "$prenomAcc"));


    $req2 = $bdd->prepare("SELECT Person_ID FROM Person WHERE (Person_Lastname = '$nomAcc' AND Person_Firstname = '$prenomAcc')", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req2->execute(array(/*
        'nomAcc' => $nomAcc,
        'prenomAcc' => $prenomAcc*/));
        $row = $req2 -> fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $personID = $row["Person_ID"];


    $req3 = $bdd->prepare(' INSERT INTO Follower (Person_ID) VALUE (:id)');
    $req3->execute(array(
        'id' => "$personID",));

    include ("homeC.php");
}
?>