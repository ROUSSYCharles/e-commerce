<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inscription.css">
    <link rel="icon" type="image/x-icon" href="images/mot3_cranevache.png">
    <title>Inscription</title>
</head>

<?php
try {
	// On se connecte à MySQL
	$mysqlClient = new PDO('mysql:host=localhost:3306;dbname=lmv;charset=utf8', 'root', '');
} catch (Exception $e) {
	die('Erreur  : ' . $e->getMessage());
}
?>

<body>
    <div class="logo">
        <img src="images/mot3_cranevache.png" alt="logo">
    </div>

    <section class="form">
        <form method="post" id="form">
            <h1>Créer un compte</h1>

            <label for="name">Votre nom</label>
            <div class="input">
                <input type="text" id="name" name = "name" placeholder="Nom">
                <span id="nameError" class="error"></span>
            </div>

            <label for="surname">Votre prénom</label>
            <div class="input">
                <input type="text" id="surname" name = "surname" placeholder="Prénom">
                <span id="surnameError" class="error"></span>
            </div>

            <label for="mail">Adresse e-mail</label>
            <div class="input">
                <input type="email" id="mail" name = "mail" placeholder="Adresse e-mail">
                <span id="mailError" class="error"></span>
            </div>

            <label for="password">Mot de passe</label>
            <div class="input">
                <input type="password" id="password" name = "password" placeholder="Au moins 8 caractères">
                <span id="passwordError" class="error"></span>
                <span id="charPassword"> Les mots de passe doivent au moins avoir 8 caractères.</span>
            </div>

            <label for="confirmPassword">Entrez le mot de passe à nouveau</label>
            <div class="input">
                <input type="password" id="confirmPassword" name = "confirmPassword" placeholder="Confirmer le mot de passe">
                <span id="confirmPasswordError" class="error"></span>
            </div>

            <div class="button">
                <button type="submit" name="register" value="Sign-Up">Continuer</button>
            </div>
            <span> En créant un compte, vous acceptez les conditions de vente du Monde Est Vache.</span>
        </form>
    </section>

    <footer>
        <span>2024 - LeMondeEstVache.fr</span>
    </footer>

    <script src="inscription.js"></script>

    <?php
		if (isset($_POST["register"])):

			$name = $_POST["name"];
            $surname = $_POST["surname"];
			$mail = $_POST["mail"];
			$password = hash("sha256", $_POST["password"]);
			//Requête update bdd
			$QuerySignIn = "INSERT into client(nom_clt, prenom_clt, mail_clt, mdp)
			VALUES ('$name', '$surname', '$mail', '$password')";
			$SignIn = $mysqlClient->prepare($QuerySignIn);
			$SignIn->execute();
		endif;
	?>
</body>
</html>