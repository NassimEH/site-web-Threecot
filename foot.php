<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</main>
</body>
<footer>
	<div id="footer-container">
    <div class="footer logo">
      
    </div>
    <div class="liens-footer">
      <img src="images/logo.png" alt="Logo ThreeCot" >
			<?php
				if(!isset($_SESSION["login"])){
					echo "<a href='authentification.php'>Se connecter</a>";
				}
				else{
					echo "<a href='afficheprofil.php'>Mon profil</a>";
					echo "<a href='deconnexion.php'>Se déconnecter</a>";
				}


				if(!isset($_SESSION["login"])){
					echo "<a href='inscription.php'> Créer un compte </a>";
				}
				else{
					echo "<a href='supprimeCompte.php'> Supprimer mon compte </a>";
				}
			?>
      <a href="accueil.php"> Accueil </a>
      <a href="about.php"> A propos </a>
      <a href="events.php"> Nos évènements </a>
      

    </div>
  </br>
    <div class="footer-social">
      <a href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwjep8bFiqz_AhUXTaQEHZVLD0YQ3yx6BAgfEAI&url=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3DdQw4w9WgXcQ&usg=AOvVaw0aHtehaphMhOCAkCydRLZU" id="Facebook">Facebook</a>
      <a href="https://twitter.com/CryptoNassim" id="Twitter">Twitter</a>
      <a href="https://www.instagram.com/dillament/?hl=fr" id="Instagram">Instagram </a>
    </div>
  </div>
</footer>
</html>