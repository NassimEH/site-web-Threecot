<?php	

  include './head.php';
	include "./restriction.php";
	
?>

<div class="container">
	
	<h1>Voulez vous vraiment vous déconnecter ?</h1>

	<div>
		<table>
			<tr>
				<td class="choix">
					<form method="GET" action="afficheprofil.php">
						<input type="submit" value='NON' id="autre">
					</form>
				</td>

				<td class="choix">
					<form method="GET" action="deconnecte.php">
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