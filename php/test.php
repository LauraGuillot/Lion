   
<?php
 $bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', '');
 $b=1;
    $sql = 'SELECT Belong.Activity_ID , Activity_Capacity FROM Belong  INNER JOIN Activity ON (Belong.Activity_ID = Activity.Activity_ID) WHERE (Belong.Basket_ID ='.$b.' AND Belong_Paid =0)';
    $stmt = $bdd->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $stmt->execute();
    
     
    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $activiteID = $row["Activity_ID"];
        echo"$activiteID";
        $cap = $row["Activity_Capacity"];
        $cap1 = $cap + 1;
        echo"$cap";
        echo"$cap1";
   

    
    ?>