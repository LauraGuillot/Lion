  <?php if (isset($_POST['bouton'])) {
  
$idco = $_POST['idco'];

/*On met à 0 le booléen de connexion*/
$bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', '');   
$req0 = $bdd->prepare('UPDATE Connexion SET Connexion_Activ = 0 WHERE (Connexion_ID=:id)');
$req0->execute(array('id' => $idco));     

/*On vide le panier*/
  /* Récupération du membre id */
        $sql = 'SELECT Member_ID FROM Member WHERE (Connexion_ID = :idco)';
        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':idco' => "$idco"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $memberID = $row["Member_ID"];

        /* Récupération du basket id */
        $sql = 'SELECT Basket_ID FROM Basket WHERE (Member_ID = :id AND Congress_ID = 1)';
        $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $stmt->execute(array(':id' => "$memberID"));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $basketID = $row["Basket_ID"];
        
        /*Suppression des activités non payées*/
         $sql = 'DELETE FROM Belong WHERE(Basket_ID = :id)';
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array(':id' => "$basketID"));

        /*Remise à 0 des totaux du panier*/
         $sql = 'UPDATE Basket SET Basket_Total =0 WHERE (Basket_ID = :id)';
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array(':id' => "$basketID"));
        
        $sql = 'UPDATE Basket SET Basket_Meal_Total =0 WHERE (Basket_ID = :id)';
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array(':id' => "$basketID"));
        
        $sql = 'UPDATE Basket SET Basket_Trip_Total =0 WHERE (Basket_ID = :id)';
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array(':id' => "$basketID"));
        
      include "home.php";}
       ?>