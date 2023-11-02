<?php
include './head.php';
include './modele.php';

$co = _getConnection();

if(isset($_POST['participe'])){
	$inscription = inscriptionEvent($_POST['participe'], $_SESSION['login'], $co);
}
if(isset($_POST['participePlus'])){
	$desinscription = desinscriptionEvent($_POST['participePlus'], $_SESSION['login'], $co);
}
if(isset($_POST['suppr'])){
	$supprimer = supprEvent($_POST['suppr'], $co);
}

?>

<h1>Liste des événements</h1>
	<br>

<div class = "en-haut">
	
	<h3>Recherche</h3>
	<form method ="get" >
		<table>
      

			<tr>
				<td class="label-right"><label for="t">Titre</label></td>
			  <td><input type = "text" name = "t"></td>
			  <td rowspan="3" class="label-right"><button type="submit">Rechercher</button><td>
			</tr>

	
			<tr>
				<td class="label-right"><label for="d">Date</label></td>
			  <td>
					<select name="position">
						<option value="=">Le </option>
						<option value="<">Avant le</option>
						<option value=">">Après le</option>
					</select>
					<input type = "date" name = "d">
				</td>
			</tr>
	
			<tr>
				<td class="label-right"><label for='Type'>Trier par </label></td>
				<td>
					<select name='tri'>
						<option value='Titre'>Titre</option>
						<option value='Date' selected>Date</option>
						<option value='Lieu'>Lieu</option>
						<option value='Prenom'>Organisateur.rice</option>
						<option value='Type'>Type d'événement</option>
						<!--<option value='Participants'>Type de participants</option>-->
					<option value='NombreParticipe'>Type de participants</option>
				</select></td>
			</tr>
		</table>
	</form>
</div>
<br>
<br>
<br>

<?php
    if (isset($_SESSION["role"])){
      if($_SESSION["role"]=="Gestionnaire"){
        echo "<h3> <a href='newevent.php'><button class='bouton' id='newEv'>Nouvel événement</button></a><br> <br> </h3>";	
      }
    }
?>
 
<?php
	$tri = 'Date';
	if(isset($_GET['tri'])){
		$tri = $_GET['tri'];
	}

	$t = null;
	$d = null;
	$pos = null;

	if (!empty($_GET['t'])) {
	  $t = $_GET['t'];
	}
	if (!empty($_GET['d'])) {
	  $d = $_GET['d'];
	  $pos = $_GET['position'];
		$events=_getEvent($co $tri, $t, $d, $pos);
	}
	else{
		$events=_getEvent($co, $tri, $t);
	}

 	while ($event = mysqli_fetch_assoc($events)){
		// Les infos
    echo "<div class='container'><br>
    	<h2> ".$event['Titre']." </h2>
		 	<br>
			<p> ".$event['Description']." </p>
	 		<br>
			Date : le ".$event['Date']."<br>
			Lieu : ".$event['Lieu']."<br>
			Organisateur.rice : ".$event['Prenom']." ".$event['Nom']."<br>
			Type d'événement : ".$event['Type']."<br>
	 		Nombre de participants : ".$event['NombreParticipe']."<br>
		<table>
			<tr>";

		if(isset($_SESSION['login'])){
			if(!estDejaInscrit($event['ID'], $_SESSION['login'], $co)){
				if(_getRoleParticipe($co, $event['ID'],  $_SESSION['role'])){
					// Participer
		    	echo "<td class='label-right'>
						<form method = 'POST'>
				      <input type = 'hidden' name = 'participe' value = '".$event['ID']."'>
							<input type = 'submit' value = 'Je participe'>
						</form>
					</td>";
				}
			}
			else{
				// Se désinscrire
		    echo "<td class='label-right'>
						<form method = 'POST'>
				      <input type = 'hidden' name = 'participePlus' value = '".$event['ID']."'>
							<input type = 'submit' value = 'Je ne participe plus'>
						</form>
					</td>";
			}
		}
		
		// Commentaires
    echo "<td class='label-right'>
					<form method = 'GET' action='commentaires.php'>
				    <input type = 'hidden' name = 'comm' value = '".$event['ID']."'>
						<input type = 'submit' value = 'Commentaires'>
				  </form>
				</td>";

		if(isset($_SESSION['role'])){
			if($_SESSION['role']=="Gestionnaire"){
				// Supprimer
		    echo "<td class='label-right'>
						<form method = 'POST'>
				      <input type = 'hidden' name = 'suppr' value = '".$event['ID']."'>
							<input type = 'submit' value = 'Supprimer'>
						</form>
					</td>";
			}
		}	
		
		echo "</tr>
			</table>
		</div>
	 	<br>
	 	<br>
	 	<br>";
  } 
?> 

<br>
<br>		

<?php
		include './foot.php';
?>