<?php


/* Connexion à la base de données */
$bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', '');

/* On sélectionne toutes les activités de la base */

/* Préparation de la requête */
$sql = 'SELECT Activity_Name FROM Activity WHERE (Congress_ID = 1 )';
$stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));

/* Exécution de la requête */
$stmt->execute(array());

/* Exploitation des résultats */

while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

    /* Si le bouton de l'activité  été appuyé, on ajoute cette activité au panier de l'utilisateur
     */
    $nom = $row["Activity_Name"];

    if (isset($_POST['add']) && strcmp($_POST['activity'],$nom)==0) {

        /* On récupère l'idco de l'utilisateur */
        $idco = $_POST['idco'];

        /* On récupère son member_ID */
        $sql1 = 'SELECT Member_ID FROM Member WHERE (Connexion_ID = :idco )';
        $stmt = $bdd->prepare($sql1, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('idco' => "$idco"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $memberID = $row["Member_ID"];

        /* On récupère son basket_ID */
        $sql2 = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id )';
        $stmt = $bdd->prepare($sql2, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('id' => "$memberID"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $basketID = $row["Basket_ID"];

        
        /* On récupère le prix, le type et l'activity_ID de l'activité choisie */
        
        $date = date("d-m-Y");
        $date1 = "31-03-2016";
        
        /*Si on est avant le 31 mars, le tarif sera le premier*/
        if (strtotime($date) <= strtotime($date1)){
          
         $sql3 = 'SELECT Activity_ID, Activity_Price1, Activity_Type_Name FROM Activity '
                 . 'INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                 . 'INNER JOIN Congress ON (Congress.Congress_ID = Activity.Congress_ID)'
                 . 'WHERE (Congress.Congress_ID = 1 AND Activity_Name = :nom )';
        $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('nom' => "$nom"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $prix = $row["Activity_Price1"];
        $activiteID = $row["Activity_ID"];
        $type = $row["Activity_Type_Name"];
        }else{ 
        /*Si on est après le 31 mars, le tarif sera le second*/
         $sql3 = 'SELECT Activity_ID, Activity_Price2, Activity_Type_Name FROM Activity '
                 . 'INNER JOIN Activity_Type ON (Activity_Type.Activity_Type_ID = Activity.Activity_Type_ID) '
                 . 'INNER JOIN Congress ON (Congress.Congress_ID = Activity.Congress_ID) '
                 . 'WHERE (Congress.Congress_ID = 1 AND Activity_Name = :nom )';
        $stmt = $bdd->prepare($sql3, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('nom' => "$nom"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $prix = $row["Activity_Price2"];
        $activiteID = $row["Activity_ID"];
        $type = $row["Activity_Type_Name"];
        }

        /* On ajoute à la table belong le basket_ID, l'activity_ID et le prix */
 
         $sql4 = 'INSERT INTO Belong (Activity_ID, Basket_ID, Belong_Price) VALUES (:activiteID, :basketID , :prix)';
        $stmt = $bdd->prepare($sql4);
        $stmt->execute(array('activiteID' => "$activiteID", 'basketID' => "$basketID", 'prix' => "$prix"));
        
        /* On met à jour le panier en calculant les totaux */
        
        /*On commence par récupérer les totaux qui nous interessent*/
        if(strcmp($type , "Repas")==0){
            $sql5 = 'SELECT Basket_Meal_Total, Basket_Total FROM Basket '
                 . ' INNER JOIN Congress ON (Congress.Congress_ID = Basket.Congress_ID) '
                 . ' WHERE (Congress.Congress_ID = 1 AND Basket_ID = :id )';
        $stmt = $bdd->prepare($sql5, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('id' => "$basketID"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $total = $row["Basket_Total"]; 
        $soustotal = $row["Basket_Meal_Total"];   
              
        }else{
             $sql5 = 'SELECT Basket_Trip_Total, Basket_Total FROM Basket'
                 . ' INNER JOIN Congress ON (Congress.Congress_ID = Basket.Congress_ID)'
                 . ' WHERE (Congress.Congress_ID = 1 AND Basket_ID = :id )';
        $stmt = $bdd->prepare($sql5, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('id' => "$basketID"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $soustotal = $row["Basket_Trip_Total"];  
        $total = $row["Basket_Total"];      
        
        }
        
        /*On met à jour le panier*/
        $total2 = "$total" + "$prix";
        $soustotal2 = "$soustotal" + "$prix";
         
         if(strcmp($type , "Repas")==0){   
        $sql6 = 'UPDATE Basket SET Basket_Meal_Total = :soustotal WHERE (Congress_ID =1 AND Basket_ID = :id)';
        $stmt = $bdd->prepare($sql6);
        $stmt->execute(array('soustotal' => "$soustotal2", 'id' => "$basketID"));         
        }else{
        $sql6 = 'UPDATE Basket SET Basket_Trip_Total = :soustotal WHERE (Congress_ID =1 AND Basket_ID = :id)';
        $stmt = $bdd->prepare($sql6);
        $stmt->execute(array('soustotal' => "$soustotal2", 'id' => "$basketID"));            
        }
        
        $sql6 = 'UPDATE Basket SET Basket_Total = :total WHERE (Congress_ID =1 AND Basket_ID = :id)';
        $stmt = $bdd->prepare($sql6);
        $stmt->execute(array('total' => "$total2", 'id' => "$basketID"));  
        
        /*On décrémente le nombre de places de l'activité*/
        $sql7 = 'SELECT Activity_Capacity  FROM Activity  WHERE (Activity_ID = :id)';         
        $stmt = $bdd->prepare($sql7, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array('id' => "$activiteID"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $cap = $row["Activity_Capacity"];  

        $sum = "$cap"-"1";
        $sql8 = 'UPDATE Activity SET Activity_Capacity = :sum WHERE (Activity_ID=:id)';
        $stmt = $bdd->prepare($sql8);
        $stmt->execute(array('sum' => "$sum", 'id' => "$activiteID")); 
        
        header("location:".  $_SERVER['HTTP_REFERER']);
    }
}

?> 