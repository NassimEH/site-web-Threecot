<?php

function filtrer($input, $co){
		$retour = htmlentities($input);
		return mysqli_real_escape_string($co, $retour);
	}

function _getConnection()
{
	static $_conn = NULL;
	if ($_conn === NULL){
		$_conn = mysqli_connect("dwarves.iut-fbleau.fr","elhaddad","NassimPHP77550","elhaddad");
	}
	return $_conn;
}

function _getRoleParticipe($co, $idEvent, $role){
  $query = "SELECT $role FROM Event WHERE ID = $idEvent";
  $resultat = mysqli_query($co, $query);
  return mysqli_fetch_assoc($resultat)[$role] == 1;
}

function _getEvent($conn, $titre, $date=null, $pos=null)
{
	
  $query = "SELECT ID, Prenom, Nom, Description, Date, IdOrga, Lieu, Titre, Type, NombreParticipe FROM Event JOIN user WHERE Event.IdOrga = user.login";


	if(!is_null($titre)){
		$query = $query." AND Titre LIKE '%".$titre."%'";
	}
	if((!is_null($date)) and (!is_null($pos))){
		$query = $query." AND Date ".$pos."'".$date."'";
	}

	if($tri == "NombreParticipe"){
		$query = $query." ORDER BY Visiteur, Adherent, Gestionnaire DESC";
	}
	else{
		$query = $query." ORDER BY ".$tri;
	}

  $resultat = mysqli_query($conn,$query);

	return $resultat;
}

function _setAttribut($att, $val, $log, $co){
    $val = filtrer($val, $co);
    $log = filtrer($log, $co);
		$query = "UPDATE user SET ".$att." = '".$val."' WHERE login = '".$log."'";
		
		$resultat = mysqli_query($co,$query);
}

function _getProfil($log, $co){
	$query = "SELECT login, Mail, Creation, Prenom, Nom, Role, Commentaires, Evenements, Image FROM user WHERE login = '".$log."'";
	
	$resultat = mysqli_query($co,$query);

	return mysqli_fetch_assoc($resultat);
}

function _getRole($log, $co){
  
	$query = "SELECT Role FROM user WHERE login = '".$log."'";
	
	$resultat = mysqli_query($co,$query);
	$ligne = mysqli_fetch_assoc($resultat);

	return $ligne["Role"];
}
 
function inscriptionEvent($eventID, $userLogin, $co)
  {
        $insertQuery = "INSERT INTO Participant (IDEvent, IDUser) VALUES ($eventID, '$userLogin')";
      $insertResultat = mysqli_query($co, $insertQuery);
			
      if($insertResultat){
        echo '<div class="alerte">Inscription réussie</div><br><br>';
				ajouterUn("Event", $eventID, $co, "NombreParticipe");
				ajouterUn("user", $userLogin, $co, "Evenements");
        return true;
      } else {
        echo 'Inscription échouée';
        return false;
      }
    }

function desinscriptionEvent($eventID, $userLogin, $co)
{
  $deleteQuery = "DELETE FROM Participant WHERE idEvent = $eventID AND idUser = '$userLogin'";
  $deleteResultat = mysqli_query($co, $deleteQuery);

  if ($deleteResultat) {
    echo '<div class="alerte">Désinscription réussie</div><br><br>';
    soustraireUn("Event", $eventID, $co, "NombreParticipe");
    soustraireUn("user", $userLogin, $co, "Evenements");
    return true;
  } else {
    echo 'Désinscription échouée';
    return false;
  }
}


function estDejaInscrit($eventID, $userLogin, $co){
    $query = "SELECT * FROM Participant WHERE IDEvent = '$eventID' AND IDUser = '$userLogin'";
    $resultat = mysqli_query($co, $query);
		
    return (mysqli_num_rows($resultat) > 0);
}

function posterCommentaire($eventID, $userLogin, $commentaire, $co)
  {
    $eventID = filtrer($eventID, $co);
    $userLogin = filtrer($userLogin, $co);
    $commentaire = filtrer($commentaire, $co);
    $query = "INSERT INTO Commentaire (idEvent, login, contenu) VALUES ($eventID, '".$userLogin."', '".$commentaire."')";
    $resultat = mysqli_query($co,$query);
		
    if($resultat) {
			echo '<div class="alerte">Commentaire ajouté</div><br><br>';
				ajouterUn("user", $userLogin, $co, 'Commentaires');
      return true;
    } else {
      return false;
    }
  }

function ajouterUn($relation, $id, $co, $attribut){
	$query;
	if($relation == "user"){
		$query = "UPDATE user SET ".$attribut." = ".$attribut."+1 WHERE login = '".$id."'";
	}
	if($relation == "Event"){
		$query = "UPDATE Event SET ".$attribut." = ".$attribut."+1 WHERE ID = '".$id."'";
	}
	
  $resultat = mysqli_query($co, $query);
}

function soustraireUn($relation, $id, $co, $attribut)
{
  $query;
  if ($relation == "user") {
    $query = "UPDATE user SET ".$attribut." = ".$attribut."-1 WHERE login = '".$id."'";
  }
  if ($relation == "Event") {
    $query = "UPDATE Event SET ".$attribut." = ".$attribut."-1 WHERE ID = '".$id."'";
  }

  $resultat = mysqli_query($co, $query);
}


function _getEventInfo($conn, $id)
{
	
  $query = "SELECT ID, Prenom, Nom, Description, Date, IdOrga, Lieu, Titre, Type, NombreParticipe FROM Event JOIN user WHERE Event.IdOrga = user.login AND Event.ID = ".$id;

  $resultat = mysqli_query($conn,$query);

	return mysqli_fetch_assoc($resultat);
}

function _getCommentaires($co, $eventID)
{
  $query = "SELECT id, Poste, contenu, Commentaire.login, Nom, Prenom FROM Commentaire JOIN user WHERE Commentaire.login = user.login AND idEvent = '$eventID'";
  $resultat = mysqli_query($co,$query);
	return $resultat;
}

function supprimerCommentaire($comID, $userLogin, $co)
{
  $deleteQuery = "DELETE FROM Commentaire WHERE id = $comID AND login = '$userLogin'";
  $deleteResultat = mysqli_query($co, $deleteQuery);

  if ($deleteResultat) {
    echo '<div class="alerte">Commentaire supprimé</div><br><br>';
    soustraireUn("user", $userLogin, $co, "Commentaires");
    return true;
  } else {
    echo '<div class="alerte">Commentaire supprimé</div><br><br>';
    return false;
  }
}

function _delCompte($login, $co){
	$query = "DELETE FROM user WHERE login = '".$login."'";
	$resultat = mysqli_query($co,$query);
	return $resultat;
}

function supprEvent($idEvent, $co){
  $deleteParticipationsQuery = "DELETE FROM Participant WHERE idEvent = '$idEvent'";
  $result = mysqli_query($co, $deleteParticipationsQuery);

	
	if($result){
		$updateUserQuery = "UPDATE user SET Evenements = Evenements - 1 WHERE login IN (SELECT login FROM Participant WHERE IDEvent = '$idEvent')";
  $result = mysqli_query($co, $updateUserQuery);

		if($result){
		  $deleteEventQuery = "DELETE FROM Event WHERE ID = '$idEvent'";
  	$result = mysqli_query($co, $deleteEventQuery);
			if ($result) {
	    	echo "<div class='alerte'>Événement supprimé</div><br><br>";
	  	
			}else {
				echo "Erreur lors de la suppression de l'événement. Veuillez réessayer";
			}
		}else {
    	echo "Erreur lors de la suppression de l'événement. Veuillez réessayer";
  	}
	}else {
    echo "Erreur lors de la suppression de l'événement. Veuillez réessayer";
  }
}

function _inscrire($co, $log, $mdp, $mail, $role, $prenom, $nom, $image){
		$req = "SELECT login FROM user WHERE login='$log';";
		$existe = mysqli_query($co, $req);
		$existe = mysqli_fetch_assoc($existe);
		if(isset($existe['login'])){
			echo "<p>Login déjà pris</p>";
		}	
	
		else{
			$mdp = password_hash($mdp, PASSWORD_DEFAULT);
			date_default_timezone_set('UTC');
			$creation = date('Y-m-d\TH');
			$req = "INSERT IGNORE INTO user (`login`, `password`, `Mail`, `Creation`, `Role`, `Prenom`, `Nom`, `Image`) VALUES ('$log', '$mdp', '$mail','$creation','$role','$prenom','$nom','$image');";
			$res = mysqli_query($co, $req);
			if($res){
				header("Location:authentification.php");
			}
			else{
				echo "Erreur de notre côté. Veuillez réessayer.";
			}
		}
}

function _connecter($co, $log, $mdp){
	$req = "SELECT password FROM user WHERE login='$log'";
	$res = mysqli_query($co, $req);
	$ligne = mysqli_fetch_assoc($res);
	
	if(!$ligne){
			sleep(2);
			$alerte = "Login incorrect. Veuillez réessayer.";
	}
	else{
		$pwdBD = $ligne['password'];
		return password_verify($mdp, 										$pwdBD);
	}
	return false;
}


?>


