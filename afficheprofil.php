<?php
	include './head.php';
	include "./modele.php";
	
	include "./restriction.php";

	$co = _getConnection();
	$vals = _getProfil($_SESSION["login"], $co);	

?>

	<div class="container" id="profil">
		
		<div >
			<img class="pfp" <?php echo "src='".$vals["Image"]."' alt='Photo de Profil'" ;?>>
		</div>
		
		<div class="noms">
			<br>
			<h3><?php echo $vals["Prenom"]." ".$vals["Nom"]; ?></h3>
			<br>
			<p class="secondaire"><?php echo "#".$vals["login"]; ?></p>
		</div>
		
		<div class="stats">
			<div>
				<h3><?php echo $vals["Evenements"]; ?></h3><br>
				<p class="secondaire">Événements</p>
			</div>
			
			<div>
					<h3><?php echo $vals["Commentaires"]; ?></h3><br>
					<p class="secondaire">Commentaires</p>
			</div>
		</div>
			
			<a href="changeprofil.php"><button class="bouton">MODIFIER</button></a>
  </div>

<?php
	include './foot.php';
?>
