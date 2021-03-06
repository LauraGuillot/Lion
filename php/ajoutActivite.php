<?php
include "fonctions.php";
/* On sélectionne toutes les activités de la base */

/* Préparation de la requête */
$sql = 'SELECT Activity_Name FROM Activity WHERE (Congress_ID = ' . congressID . '  )';
$stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));

/* Exécution de la requête */
$stmt->execute(array());

/* Exploitation des résultats */

while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

    /* Si le bouton de l'activité  été appuyé, on ajoute cette activité au panier de l'utilisateur
     */
    $nom = $row["Activity_Name"];

    if (isset($_POST['add']) && strcmp($_POST['activity'], $nom) == 0) {

        /* On récupère l'idco de l'utilisateur */
        $idco = $_POST['idco'];
        
        /*On ajoute l'activité au panier*/
        addAct($bdd, $idco, $nom);
    }
}
?> 