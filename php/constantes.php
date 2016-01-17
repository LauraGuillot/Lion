<?php

/* Définition de la constante congressID*/
define ("congressID", "1");

/* Définition de la connexion à la base de données*/
$bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=lion;charset=utf8', 'root', 'lion');

/*Mail de l'administrateur*/
$mailAdmin = "laura.guillot@eleves.ec-nantes.fr";

/*Login et mot de passe messagerie*/
$login = "";
$password = "";

/*Serveur et port pour les mails*/
$port = 25;
$serveur = "smtps.nomade.ec-nantes.fr"; //
?>