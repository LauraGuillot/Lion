<?php

$club = $_POST['club'];
$rue = $_POST['rue'];
$num = $_POST['num'];
$cadr= $_POST['cadr'];
$cp = $_POST['cp'];
$ville = $_POST['ville'];
$pays = $_POST['pays'];
$tel = $_POST['tel'];
$portable = $_POST['portable'];

if (empty($club) or empty($rue) or empty($num) or empty($cp) or empty($ville) or empty($pays) or empty($tel)) {
    include ("inscription2bisnew.php");
} else {

    include ("inscription3.php");
}


?>