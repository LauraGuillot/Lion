<?php

$mail = $_POST['mail'];
$mdp = $_POST['mdp'];

function testConnexion($bdd, $mail, $mdp) {
    try {
        /* Préparation de la requête */
        $stmt = $bdd->prepare("SELECT Person.Person_ID FROM Person INNER JOIN Member ON (Person.Person_ID = Member.Person_ID) WHERE (Member_EMail='$mail' AND Member_Password ='$mdp');", array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));

        /* Exécution de la requête */
        $stmt->execute(array());

        /* Exploitation des résultats */

        $res = $stmt->fetchAll();

        /* Si il n'y a pas de résultat, message d'erreur */
        if (count($res) == 0) {
           
            //Message d'erreur
            
        } else {/* Si il y a un résultat, connexion + mise à jour de la date de dernière connexion */
            foreach ($res as $ligne) {

                $id = $ligne["Person_ID"];
                $stmt2 = $bdd->prepare("UPDATE Connexion SET Last_Connexion = NOW() WHERE Connexion_ID =(SELECT Connexion_ID FROM Member WHERE (Person_ID = $id))");
                $stmt2->execute();
                include 'homeC.php';
            }
        }
   
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
}

$bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', '');
testConnexion($bdd, $mail, $mdp);
?>