<?php

function validation3() {

    $fClub = $_POST['fClub'];
    $fDistrict = $_POST['fDistrict'];
    $prenomAcc = $_POST['prenomAcc'];
    $nomAcc = $_POST['nomAcc'];
    $train = $_POST['train'];
    $traindate = $_POST['traindate'];
    $trainheure = $_POST['trainheure'];


    if (empty($fClub) or empty($fDistrict)) {
        header('Location: inscriptionnew3.php');
    } else {
        // Retourner sur la page d'accueil
        // Afficher les onglets monCompte et panier
        //Mettre les informations dans la base de données
    }
}

validation3();
?>