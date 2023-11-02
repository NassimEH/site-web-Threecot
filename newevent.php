<?php	
  include './head.php';
  include './restriction.php';
	if(!isset($_SESSION["login"])){
		header("Location: ./events.php");
	}

	include './modele.php';
?>


 <?php 
  $co = _getConnection();


	$Titre = "";
	$Description = "";
	$Date = "";
  $date = "";
	$Lieu = "";
	$Type = "";
	$sets = 0;
	$co = _getConnection();
	
	// check que les cases sont remplies
	if(!empty($_POST['Titre'])){
		$Titre = filtrer($_POST['Titre'], $co);
		$sets += 1;
	}
	if(!empty($_POST['Description'])){
		$Description = filtrer($_POST['Description'], $co);
		$sets += 1;
	}
	if(!empty($_POST['date'])){
		$date = $_POST['date'];
		$sets += 1;
	}
	if(!empty($_POST['Lieu'])){
		$Lieu = filtrer($_POST['Lieu'],$co);
		$sets += 1;
	}
	if(!empty($_POST['Type'])){
		$Type = $_POST['Type'];
		$sets += 1;    
    
	}
  if(!empty($_POST['Roles'])){
    $valeurCheckbox = $_POST['Roles'];
    //$string = implode($valeurCheckbox,",");
		$gestionnaire = 0;
		$adherent = 0;
		$visiteur = 0;
		foreach($valeurCheckbox as $role){
			if($role == 'Gestionnaire'){
				$gestionnaire= 1;
			}
	    if($role == 'Adherent'){
				$adherent = 1;
			}
	    if($role == 'Visiteur'){
				$visiteur = 1;
		}
    $sets += 1;
  }
	}

  $Date = date("Y-m-d", strtotime($date));

	// si tt les cases sont remplies
	if($sets == 6){
    $req = "INSERT IGNORE INTO Event (`Titre`, `Date`, `Lieu`, `IdOrga`, `Description`, `Type`, `Gestionnaire`, `Adherent`, `Visiteur`) VALUES ('$Titre', '$Date', '$Lieu','".$_SESSION['login']."','$Description','$Type','$gestionnaire', '$adherent', '$visiteur')";
		$res = mysqli_query($co, $req);
		if($res){
			echo '<div class="alerte">Événement créé</div><br><br>';
			header("Location:events.php");
		}
		else{
			echo "Erreur de notre côté. Veuillez réessayer.";
		}
  }

   
	echo "

<h1>Création d'un nouvel événement</h1>
<div class='container'>
	<table>
		<form method='POST'>
			<tr>
				<td class='label-right'><label for='Titre'>Titre</label></td>
				<td><input type='text' name='Titre' placeholder='Titre' required></td>
			</tr>

			<tr>
				<td class='label-right'><label for='Description'>Description</label></td>
				<td><textarea name='Description' rows='5' cols='50' maxlength='300' placeholder='Description' required></textarea></td>
			</tr>

			<tr>
				<td class='label-right'><label for='Date'>Date</label></td>
				<td> <input id='date' name='date' type='date' placeholder='jj/mm/aaaa'required></td>
			</tr>

			<tr>
				<td class='label-right'><label for='Lieu'>Lieu</label></td>
				<td> <input type='text' name='Lieu' placeholder='Lieu' required></td>
			</tr>

			<tr>
	 			<td class='label-right'><label for='Type'>Type d'événement</label></td>
				<td><select class='select1' name='Type' required>
					<option value='Réunion de service'>Réunion de service</option>
					<option value='Tricot papotage'>Tricot papotage</option>
					<option value='Cours'>Cours</option>
					<option value='Présentation des projets'>Présentation des projets</option>
					<option value='Vente de nos Créations'>Vente de nos Créations</option>
					<option value='Autre' selected>Autre</option>
				</select></td>
			</tr>

			<tr>
	 			<td class='label-right'><label for='Roles[]'>Participants</label></td>
				<td>
		 			<input name='Roles[]' type='checkbox' value='Gestionnaire'>    Gestionnaires<br>
					<input name='Roles[]' type='checkbox' value='Adherent'>    Adhérents<br>
					<input name='Roles[]' type='checkbox' value='Visiteur'>    Visiteurs
    		<br><br>
				</td>
			</tr>
	    <tr>
	    	<td> <input type='submit' value='Créer'></td>
	    </tr>
		</form>
	</table>
</div>";
?> 

<?php
include './foot.php';
?>