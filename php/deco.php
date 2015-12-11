  <?php if (isset($_POST['bouton'])) {
  
      $idco = $_POST['idco'];
$bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', '');   
$req0 = $bdd->prepare('UPDATE Connexion SET Connexion_Activ = 0 WHERE (Connexion_ID=:id)');
$req0->execute(array('id' => $idco));     
      
      include "home.php";}
       ?>