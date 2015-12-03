<?php
function connexion(){
try{

$bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', 'lion');
echo "ca marche mec ! ";
$bdd->exec('INSERT INTO Member(Member_Email,Member_Password) VALUES(\'okok\', \'liolion\')');
echo "ca marche vraiment";
}

catch(Exception $e)
 {
 die('Erreur : ' . $e->getMessage());
}
}
connexion();
?>
