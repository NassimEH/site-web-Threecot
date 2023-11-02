<?php
	include './head.php';
	include './modele.php';
	include './restriction.php';

	$co = _getConnection();
	$vals = _getProfil($_SESSION["login"], $co);	

	if(isset($_POST["changer"])){
		if(!empty($_POST["firstName"])){
			_setAttribut("Prenom", $_POST["firstName"], $_SESSION["login"], $co);
		}
		if(!empty($_POST["lastName"])){
			_setAttribut("Nom", $_POST["lastName"], $_SESSION["login"], $co);
		}
		if(!empty($_POST["mail"])){
			_setAttribut("Mail", $_POST["mail"], $_SESSION["login"], $co);
		}
		if(!empty($_POST["login"])){
			_setAttribut("login", $_POST["login"], $_SESSION["login"], $co);
		}
		if(!empty($_POST["password"])){
			_setAttribut("password", password_hash($_POST["password"]), $_SESSION["login"], $co);
		}
		if(!empty($_POST["role"])){
			_setAttribut("Role", $_POST["role"], $_SESSION["login"], $co);
		}
    if(!empty($_POST["image"])){
			_setAttribut("Image", $_POST["image"], $_SESSION["login"], $co);
		}
		header("Location:afficheprofil.php");
	}

	echo"<div>
      <h1> Profil </h1>
			
      <form class='container' method='POST'>

	 			<table>
        <tr>
					<td class='label-right'><label for='image'>Image</label></td>
					<td><input type='text' name='image' value='".$vals["Image"]."' placeholder='Url pdp' ></td>
				</tr>
        	<tr>
	      		<td class='label-right'><label for='firstName'>Prénom</label></td>
	      		<td><input type='text' id='firstName' name='firstName' placeholder ='".$vals["Prenom"]."'><td>
				 	</tr>

 					<tr>
			      <td class='label-right'><label for='lastName'>Nom</label></td>
			      <td><input type='text' id='lastName' name='lastName' placeholder ='".$vals["Nom"]."'></td>
					</tr>
			
					<tr>
						<td class='label-right'><label for='mail'>E-mail</label></td>
			      <td><input type='email' id='mail' name='mail' placeholder ='".$vals["Mail"]."'></td>
					</tr>
			
					<tr>
						<td class='label-right'><label for='login'>Login</label></td>
			      <td><input type='text' id='login' name='login' placeholder ='".$vals["login"]."'></td>
					</tr>
			
			      <td class='label-right'><label for='password'>Mot de passe</label></td>
			      <td><input type='password' id='password' name='password'></td>
					</tr>
	
					<tr>
						<td class='label-right'><label for='role'>Role</label></td>
						<td><input type='radio' name='role' value='Gestionnaire'>  Gestionnaire    
				  	<br><input type='radio' name='role' value='Adherent'>  Adhérent    
				  	<br><input type='radio' name='role' value='Visiteur'>  Visiteur</td>
					</tr>
		 		</table>
		 
				<input type='hidden' name='changer' value='2'>
	
				<input type='submit' value='Enregistrer les changements'>
        
      </form>
    </div>";
		
	include './foot.php';

?>