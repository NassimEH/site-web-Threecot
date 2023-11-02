<?php
	if(!isset($_SESSION["login"])){
		header("Location: ./authentification.php");
	}
?>