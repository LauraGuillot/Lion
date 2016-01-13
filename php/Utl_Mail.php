<?php
//----------------------------------------------------------------------
//  Nom 		: Utl_Mail.php
//  Description	: Utilitaire pour la gestion de l'envoi de messages
//  Auteurs		: Jean-Yves Martin
//  Date		: 18/06/2010
//  Der modif	: 18/06/2010
//  Projet		: 
//  Historique  :
//  	Jean-Yves Martin	18/06/2010	creation du fichier
//----------------------------------------------------------------------

//  -----------------------------------------------------------------------
//  Nom         : sendMail
//  Description : envoie automatiquement un mail
//  Parametres  :
//  Resultat	: 
//  Historique  :
//  	Jean-Yves Martin	18/06/2010	Creation de la fonction
//  -----------------------------------------------------------------------
function sendMail($serveur, $port, $login, $password, $Emetteur, $Destinataire, $Subject = "", $Message="")
{	
	// On va pouvoir envoyer un message
	$ListeDestinataires = "";
	if (is_array($Destinataire)) {
		foreach ($Destinataire as $unDestinataire) {
			if ($ListeDestinataires != "")
				$ListeDestinataires .= ",";
			$ListeDestinataires .= $unDestinataire;
		}
		$ListeDestinataires = $Destinataire;
	}
	else
		$ListeDestinataires = array($Destinataire);
			
	if ((count($ListeDestinataires) > 0) && ($Message != "")) {
		// On prend le message
		$headers["From"]    = $Emetteur;
		$headers["To"]      = $ListeDestinataires;		
		$headers["Cc"]      = array($Emetteur);
		$headers["Subject"] = $Subject; 

		$params["host"] = $serveur; 
		$params["port"] = $port; 
		$params["auth"] = false; 
		$params["username"] = $login; 
		$params["password"] = $password; 

		sendMailToServer($params, $headers, $Message);
	}
}

//  -----------------------------------------------------------------------
//  Nom         : sendMailToServer
//  Description : Implémente un protocole SMTP minimal
//  Parametres  :
//  Resultat	: 
//  Historique  :
//  	Jean-Yves Martin	18/09/2010	Creation de la fonction
//  -----------------------------------------------------------------------
function sendMailToServer($params, $headers, $Message)
{
	// Ouverture de la connexion au serveur
	$sock = fSockOpen($params["host"], $params["port"]); 
	if ($sock) { 
		socket_set_timeout($sock, 5, 0); 
		$s = fgets($sock, 512);
		
		// Message de connexion
		fputs($sock, "HELO ".$params["host"]."\r\n"); 
		$s = fgets($sock, 512); 

		// De qui provient le message
		fputs($sock, "MAIL FROM: <".$headers["From"].">\r\n"); 
		$s = fgets($sock, 512); 

		// Liste des destinataire - chacun avec une instruction de connexion
		for ($j = 0; $j < 2; $j++) {
			if ($j == 0)
				$field = "Cc";
			else
				$field = "To";

			$liste = "";
			if (is_array($headers[$field])) {
				foreach ($headers[$field] as $unDestinataire) {
					if ($unDestinataire != "") {
						fputs($sock, "RCPT TO: $unDestinataire\r\n"); 
						$s = fgets($sock, 512); 
					}
				}
			} else if ($headers[$field] != "") {
				$unDestinataire = $headers[$field];
				fputs($sock, "RCPT TO: $unDestinataire\r\n"); 
				$s = fgets($sock, 512); 
			}
		}
		
		
		// Le message lui même
		fputs($sock, "DATA\r\n"); 
		$s = fgets($sock, 512); 
			// Entête du message
			if ($headers["Subject"] != "")
				fputs($sock, "Subject: ".$headers["Subject"]."\r\n"); 
			else
				fputs($sock, "Subject: Message From Server\r\n"); 
			if ($headers["From"] != "")
				fputs($sock, "From: ".$headers["From"]."\r\n"); 
			for ($j = 0; $j < 2; $j++) {
				if ($j == 0)
					$field = "Cc";
				else
					$field = "To";
	
				$liste = "";
				if (is_array($headers[$field])) {
					foreach ($headers[$field] as $unDestinataire) {
						if ($unDestinataire != "") {
							if ($liste != "") $liste .= ",";
							$liste .= $unDestinataire;
						}
					}
				} else if ($headers[$field] != "") {
					$liste = $headers[$field];
				}
				
				if (strlen($liste) >=1024)
					$liste = "";
				if ($liste != "")
					fputs($sock, "$field: $liste\r\n"); 
			}
			
			// Le contenu du message est passé en HTML	
			fputs($sock, "Content-Type: text/html; charset=utf-8\r\n");
			fputs($sock, "<html>\r\n");
			fputs($sock, "<head>\r\n");
			fputs($sock, "</head>\r\n");
			fputs($sock, "<body>\r\n");
			fputs($sock, $Message."\r\n"); 
			fputs($sock, "</body>\r\n");
			fputs($sock, "</html>\r\n");
			
		// Fermeture des données
		fputs($sock, ".\r\n"); 
		$s = fgets($sock, 512); 

		// On quitte la connexion
		fputs($sock, "QUIT\r\n"); 
		$s = fgets($sock, 512); 

		fclose($sock);
	} 
}


?>