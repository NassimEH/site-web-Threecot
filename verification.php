<?php
if ( empty(session_id()) ) session_start();

include './modele.php';
$sets = 0;
$co = _getConnection();

if(isset($_POST['cache'])){
	// On vérifie que tous les champs sont remplis
	if(!empty($_POST['username'])){
		$log = $_POST['username'];
		$sets += 1;
	}
	if(!empty($_POST['password'])){
		$mdp = $_POST['password'];
		$sets += 1;
	}
	
	// Si tous les champs sont remplis
	if($sets == 2){
		$resultat = _connecter($co, $log, $mdp);
	
		// On vérifie que le login existe
		if($resultat){
			if(!isset($_SESSION["login"])){
				$_SESSION["login"] = $log;
			}
			
			//header("Location:accueil.php");
			
			if(!isset($_SESSION["role"])){
				$_SESSION["role"] = _getRole($log, $co);
			}
		}
		else{
			sleep(2);
			$alerte = "Mot de passe incorrect. Veuillez réessayer.";
		}
	}
	else{
		sleep(2);
		$alerte = "Veuillez remplir tous les champs.";
	}
}
?>