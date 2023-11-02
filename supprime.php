<?php	
  include './head.php';
	include './restriction.php';
	include './modele.php';

	$co = _getConnection();
	$log = $_SESSION['login'];
	session_destroy();

	$suppr = _delCompte($log, $co);

	if($suppr){
		echo " <div class='container'>
			<h1>Votre compte, #".$log." a été supprimé.</h1>
	 		<a href='accueil.php'><button class='bouton'>Retour au menu</button></a>
		</div>";
	}
	else{
		echo " <div class='container'>
			<h1>Erreur : votre compte n'a pas été supprimé.</h1>
	 		<a href='supprimeCompte.php'><button class='bouton'>Retour au menu de suppression</button></a>
		</div>";
	}
		
	include './foot.php';
?>