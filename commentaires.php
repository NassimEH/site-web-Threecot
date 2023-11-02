<?php
include './head.php';
include './modele.php';

$co = _getConnection();

$info = _getEventInfo($co, $_GET['comm']);

if(isset($_POST['Commentaire'])){
	posterCommentaire($info['ID'], $_SESSION['login'], $txt, $co);
	header("Location:commentaires.php");
}

if(isset($_POST['suppr'])){
	supprimerCommentaire($_POST['suppr'], $_SESSION['login'], $co);
	unset($_POST['Commentaire']);
}


echo "<div class='container'>
		<h1>".$info['Titre']."</h1>
		<br>
		<p> ".$info['Description']." </p>
		<p>
			Date : le ".$info['Date']."<br>
			Lieu : ".$info['Lieu']."<br>
			Organisateur.rice : ".$info['Prenom']." ".$info['Nom']."<br>
			Type d'événement : ".$info['Type']."<br>
			Nombre de participants : ".$info['NombreParticipe']."<br>
		</p>
	</div> <br> <br> <br>
 	<h1>Commentaires</h1>
	<br>";


echo "<div class='container'>
				<form method = 'POST'>
					<label for = 'Commentaire' > Laissez un commentaire : </label> <br>
					<textarea name = 'Commentaire' rows = '4' cols = '50' ></textarea><br>
					<div class='label-right' ><input type = 'submit' value = 'Poster'></div>
				</form>
			</div>
	 	<br>
	 	<br>
	 	<br>
	 	<br>";


	$comms = _getCommentaires($co, $_GET['comm']);
	
 	while ($com = mysqli_fetch_assoc($comms)){
		echo "<div class='container'>
			Le ".$com['Poste'].", ".$com['Prenom']." ".$com['Nom']." a posté :<br>
			<br>
			<p class='container'> ".$com['contenu']." </p>";

		if(isset($_SESSION['login']) and $com['login']==$_SESSION['login']){
			echo "<br><form method = 'POST'>
				      <input type = 'hidden' name = 'suppr' value = '".$com['id']."'>
							<div class='label-right'>
			 					<input type = 'submit' value = 'Supprimer'>
			 				</div>
						</form>";
		}
		
		echo	"</div>
	 		<br>";    
	}

?> 

<?php
		include './foot.php';
?>