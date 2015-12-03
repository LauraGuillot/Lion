<?php

    
    $bouton1= $_POST['v1'];
    $bouton2= $_POST['v2'];
    $bouton3=$_POST['v3'];
    
	if (isset($bouton1)){
	$email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $mdp2 = $_POST['cmdp'];
    if (empty($mdp) or $mdp != $mdp2 or ! preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {
        header('Location: inscriptionnew.php');
    } else {
        header('Location: inscription2.php');
    }

}


	if (isset($bouton2)){
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
    if ( empty($nom) or empty($prenom) or empty($club) or empty($rue) or empty($num) or empty($cp) or empty($ville) or empty($pays) or empty($tel)) {
        header('Location: inscriptionnew2.php');
    } else {
        header('Location: inscription3.php');
    }
    }


	if (isset($bouton3)){
	$fClub = $_POST['fClub'];
    $fDistrict = $_POST['fDistrict'];
    $prenomAcc = $_POST['prenomAcc'];
    $nomAcc = $_POST['nomAcc'];
    $train = $_POST['train'];
    $traindate = $_POST['traindate'];
    $trainheure = $_POST['trainheure'];
    if (empty($fClub) or empty($fDistrict)) {
        header('Location: inscriptionnew3.php');
    } 
    else {
        
$bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', 'lion');
echo "ca marche mec ! ";
$req = $bdd->prepare('INSERT INTO Person (Person_Lastname, Person_Firstname) VALUES (:nom,:prenom)');
$req->execute(array(
	'nom'=>"$nom",
	'prenom'=>"$prenom"));
	

echo "ca marche vraiment";

        }}       
        
?>