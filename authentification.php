<?php	
  include './head.php';
	include './verification.php';

?>

<h1>Connection</h1>
<div class="container">
	<!-- zone de connection -->
	<form method="POST">
		<table>
			<tr>
				<td class="label-right"><label for="username">Nom d'utilisateur</label></td>
				<td><input type="text" placeholder="Connecte toi vite" name="username" required></td>
			</tr>

			<tr>
				<td class="label-right"><label for="password">Mot de passe</label></td>
				<td><input type="password" name="password" required></td>
			</tr>
		</table>

		<?php 
			if(isset($alerte)){
				echo "<div>".$alerte."</div>";
			}
		?>

		<input type="hidden" name="cache" value="cache" >

		<input type="submit" value='CONNECTION'>
		<h3> <a href="inscription.php">S'inscrire</a> </h3>
			
	</form>
</div>
			
<?php
	include './foot.php';
?>