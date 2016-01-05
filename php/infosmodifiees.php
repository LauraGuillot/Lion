<?php

include "fonctions.php";
$idco = $_POST['idco'];

                        $email = $_POST['email'];
                        $nom = $_POST['nom'];
                        $prenom = $_POST['prenom'];
                        $rue = $_POST['rue'];
                        $num = $_POST['num'];
                        $cadr = $_POST['cadr'];
                        $cp = $_POST['cp'];
                        $ville = $_POST['ville'];
                        $pays = $_POST['pays'];
                        $tel = $_POST['tel'];
                        $portable = $_POST['portable'];
                    
                        
                        miseajourinfos($bdd,$idco,$email,$nom,$prenom,$rue,$num,$cadr,$cp,$ville,$pays,$tel,$portable);

?>