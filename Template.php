<?php
	session_start();

	try {
		// On se connecte à MySQL
		$mysqlClient = new PDO('mysql:host=HOST:PORT;dbname=DB_NAME', 'USER', 'PASSWORD');
	} catch (Exception $e) {
		die('Erreur  : ' . $e->getMessage());
	}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/e-commerce/template.css">
	<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/e-commerce/popup.css">
    <link rel="icon" type="image/x-icon" href="LMEV Motif/mot3_cranevache.png">
	<title>LMEV</title>
</head>
<body>
	<?php	// Nav Bar -> Les boutons renvoient vers la page correspondante en cherchant le chemin de la page depuis la racine
			// 	   -> Le bouton permettant d'aller vers la page dans laquelle l'utilisateur se trouve n'est plus affiché
	?>
	<nav>
		<li><a href = "http://<?php echo $_SERVER['HTTP_HOST']; ?>/e-commerce/Catalogue/catalogue.php"<?php if(basename($_SERVER['PHP_SELF']) == 'catalogue.php') { echo ' style="display:none;"'; }?>>Catalogue</a></li>
		<li><a href = "#Promotions">Promotions</a></li>
		<li><a href = "#Contact">Contact</a></li>
		<li><a href = "http://<?php echo $_SERVER['HTTP_HOST']; ?>/e-commerce/home_page/home_page.php"<?php if(basename($_SERVER['PHP_SELF']) == 'home_page.php') { echo ' style="display:none;"'; } ?>>Accueil</a></li>
		<li><a href = "http://<?php echo $_SERVER['HTTP_HOST']; ?>/e-commerce/Sign In/Sign In.php"<?php if(basename($_SERVER['PHP_SELF']) == 'Sign In.php') { echo ' style="display:none;"'; } ?>>Connexion</a></li>

		<li><a href = "http://<?php echo $_SERVER['HTTP_HOST']; ?>/e-commerce/panier/panier.php"<?php if(basename($_SERVER['PHP_SELF']) == 'panier.php') { echo ' style="display:none;"'; } ?>>Panier</a></li>
		<li><a href = "#Profil">Profil</a></li>
	</nav>

	<footer>LEMV - 2024</footer>
</body>
</html>
