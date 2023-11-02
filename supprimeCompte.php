<?php	
  include './head.php';
	include './restriction.php';
?>

<div class="container" id='profil'>

	<?php
		echo "<h2>Voulez vous vraiment supprimer votre compte #".$_SESSION['login']." ?</h2>
		Toutes vos données, projets, commenatires et évènements seront perdus.";
	?>

	<div>
		<table>
			<tr>
				<td class="choix">
					<form method="GET" action="afficheprofil.php">
						<input type="submit" value='NON' class="autre">
					</form>
				</td>

				<td class="choix">
					<form method="GET" action="supprime.php">
						<input type="submit" value='OUI'>
					</form>
				</td>
			</tr>
		</table>
	</div>
	
</div>
			
<?php
	include './foot.php';
?>