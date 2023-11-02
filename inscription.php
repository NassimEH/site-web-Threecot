<?php
	include './head.php';
	include './modele.php';
	$log = "";
	$mdp = "";
	$mail = "";
	$role = "";
	$prenom = "";
	$nom = "";
  $image = "";
	$sets = 0;
	$co = _getConnection();
	
	// check que les cases sont remplies
	if(!empty($_POST['nom'])){
		$nom = filtrer($_POST['nom'], $co);
		$sets += 1;
	}
	if(!empty($_POST['prenom'])){
		$prenom =filtrer( $_POST['prenom'], $co);
		$sets += 1;
	}
	if(!empty($_POST['login'])){
		$log = filtrer($_POST['login'], $co);
		$sets += 1;
	}
	if(!empty($_POST['mdp'])){
		$mdp = filtrer($_POST['mdp'], $co);
		$sets += 1;
	}
	if(!empty($_POST['mail'])){
		$mail = filtrer($_POST['mail'], $co);
		$sets += 1;
	}
	if(!empty($_POST['role'])){
	  if($_POST['role'] == 'Adherent'){
	    $role = 'Adherent';
	    $sets += 1;
	  }else{
	    if($_POST['role'] == 'Visiteur'){
	      $role ='Visiteur';
	      $sets += 1;
	    }else{
	    if($_POST['role'] == 'Gestionnaire'){
	      $role ='Gestionnaire';
	      $sets += 1;
	    }
	  }
	}
}
if(!empty($_POST['image'])){
		$image = filtrer($_POST['image'], $co);
	}
	
	// si tt les cases sont remplies
	if($sets == 6){
		_inscrire($co, $log, $mdp, $mail, $role, $prenom, $nom, $image);
	}


	
	echo "<div class='container'>
	 	<form method='POST'>
			<table>
        <tr>
					<td class='label-right'><label for='image'>Image</label></td>
					<td><input type='text' name='image' value='./images/defaut_pfp.png' placeholder='Url pdp' ></td>
				</tr>
    
				<tr>
					<td class='label-right'><label for='prenom'>Prenom</label></td>
					<td><input type='text' name='prenom' value='".$prenom."' placeholder='Isabelle' required></td>
				</tr>
				
					<td class='label-right'><label for='nom'>Nom de famille</label></td>
					<td><input type='text' name='nom' value='".$nom."' placeholder='Deschamps' required></td>
				</tr>
				
				<tr>
					<td class='label-right'><label for='login'>Identifiant (privé)</label></td>
					<td><input type='text' name='login' value='".$log."' placeholder='La_Reine_du_Tricot' required></td>
				</tr>
				
				<tr>
					<td class='label-right'><label for='mdp'>Mot de passe</label></td>
					<td><input type='password' name='mdp' value='".$mdp."' placeholder='Mot de passe' required></td>
				</tr>
				
				<tr>
					<td class='label-right'><label for='mail'>Adresse mail (privée)</label></td>
					<td><input type='email' name='mail' value='".$mail."' placeholder='E-mail' required></td>
				</tr>
				
				<tr>
					<td class='label-right'><label for='role'>Role</label></td>
					<td>
		 				<input type='radio' name='role' value='Gestionnaire'>  Gestionnaire - Vous pourrez créer des événements <br>
						<input type='radio' name='role' value='Adherent'>  Adhérent - Vous pourrez publier des commentaires <br>
						<input type='radio' name='role' value='Visiteur'>  Visiteur - Vous ne pouvez que regarder les commentaires
					</td>
				</tr>
			</table>
			<input type='submit' value='INSCRIPTION'>
		</form>
		<a href='authentification.php'>Se connecter</a>
  </div>";
	
	include 'foot.php';
?>

