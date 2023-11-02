<?php
if (empty(session_id())){
	session_start();
}
?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
	<link rel="icon" type="image/png" sizes="16x16" href="images\logo.png">
	<title>ThreeCot - Trio du Tricot</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
</head>
<header>
    <div>
    	<img class="haut-gauche" src="images/banniere.png" alt="banniere">
	    <nav>
        <a class="bouton-nav" href="accueil.php">Accueil</a>
				<a class="bouton-nav" href="about.php">À propos</a>
				<a class="bouton-nav" href="events.php">Événements</a>
				<?php
					if(!isset($_SESSION["login"])){
						echo "<a class='bouton-nav' href='authentification.php'>Connexion</a>";
					}
					else{
						echo "<a class='bouton-nav' href='afficheprofil.php'>Profil</a>";
					}
				?>
			</nav>
		</div>
  </header>
	<body>
		<main>
