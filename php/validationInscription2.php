<?php

function validation2() {

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

        //Mettre les informations dans la base de données
    }
}

validation2();
?>