<?php require_once("../template.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inscription.css">
    <link rel="stylesheet" href="../popup.css">
    <link rel="icon" type="image/x-icon" href="../LMEV Motif/mot3_cranevache.png">
    <title>Inscription</title>
</head>
<body oncontextmenu="return false">

    <section class="form-sign-in">
        <form method="post" id="signin-form" name="signin-form">
            <h1>Créer un compte</h1>
            <label for="name">Votre nom</label>
            <div class="input">
                <input type="text" id="name" name = "name" onkeypress="verifChar(event)" placeholder="Nom" data-error-for="nameError">
                <span id="nameError" class="error"></span>
            </div>

            <label for="surname">Votre prénom</label>
            <div class="input">
                <input type="text" id="surname" name = "surname" onkeypress="verifChar(event)" placeholder="Prénom" data-error-for="surnameError">
                <span id="surnameError" class="error"></span>
            </div>

            <label for="mail">Adresse e-mail</label>
            <div class="input">
                <input type="email" id="mail" name = "mail" onkeypress="verifChar(event)" placeholder="Adresse e-mail" data-error-for="mailError">
                <span id="mailError" class="error"></span>
                <!-- verification format adresse e-mail -->
                <?php
                $mailFormatError ="";
                if(isset($_POST["register"]) && !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
                {
                    $mailFormatError = "Format de l'adresse email invalide.";
                }
                ?>
                <span id='mailFormatError' class='error'><?php echo $mailFormatError ?></span>
            </div>

            <label for="password">Mot de passe</label>
            <div class="input">
                <input type="password" id="password" name = "password" onkeypress="verifChar(event)" placeholder="Au moins 8 caractères" data-error-for="passwordError">
                <span id="passwordError" class="error"></span>
                <span id="charPassword"> Les mots de passe doivent au moins avoir 8 caractères.</span>
            </div>

            <label for="confirmPassword">Entrez le mot de passe à nouveau</label>
            <div class="input">
                <input type="password" id="confirmPassword" name = "confirmPassword" onkeypress="verifChar(event)" placeholder="Confirmer le mot de passe" data-error-for="confirmPasswordError">
                <span id="confirmPasswordError" class="error"></span>
            </div>

            <div class="button">
                <button type="submit" name="register" value="Sign-In">Continuer</button>
            </div>
            <span> En créant un compte, vous acceptez les conditions de vente du Monde Est Vache.</span>
        </form>
    </section>
    
    <?php
    function verifChar()
    {
        $specialStr = "<>/&|`\"'*";
        $specialChar = str_split($specialStr);
        foreach($_POST as $key => $value)
        {
            $valueChar = str_split($value);
            foreach($valueChar as $v)
            {
                foreach($specialChar as $c)
                {
                    if($v == $c && ($key !== "password" && $key !== 'confirmPassword' && $key !== 'login-password'))
                    {
                        return true;
                    }
                }
            }
        }
    }
    try
    {
        if(isset($_POST["register"]) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) && verifChar() == false)
        {
            $name = strtoupper(htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8'));
            $surname = htmlspecialchars($_POST["surname"], ENT_QUOTES, 'UTF-8');
            $mail = htmlspecialchars($_POST["mail"], ENT_QUOTES, 'UTF-8');
            $options = [
                'cost' => 12,];
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT, $options);
            //Requête update bdd
            $SignInQuery= "INSERT into client(nom_clt, prenom_clt, mail_clt, mdp)
            VALUES ('$name', '$surname', '$mail', '$password')";
            $SignIn = $mysqlClient->prepare($SignInQuery);
            $SignIn->execute();
        }
    }
    // Popup si un utilisateur utilise déjà l'adresse e-mail saisie
    catch (PDOException $e)
    {
        if ($e->errorInfo[1] === 1062)
        {
            // Gérer l'erreur d'intégrité de contrainte
            $MailDupli = "Cette adresse e-mail est déjà utilisée.\nVeuillez en choisir une autre.";

            echo
            '<div id="popup" class="popup">
                <div class="popup-content">
                    <div id="error-message" class="error-message">'
                    .nl2br($MailDupli).
                    '</div>
                </div>
            </div>';
        }
    }
	?>

    <section class="login-form">
            <form method="post" id="login-form" name="login-form">
                <h1>Connexion</h1>
                <div class="button">
                    <button type="button" id="change-form" name="change-form" value="change-form">S'inscrire</button>
                </div>

                <label for="mail">Adresse e-mail</label>
                <div class="input">
                    <input type="email" id="login-mail" name = "login-mail" onkeypress="verifChar(event)" placeholder="Adresse e-mail" data-error-for="login-mailError">
                    <span id="login-mailError" class="error"></span>
                    <?php
                    $mailFormatError ="";
                    if(isset($_POST["login"]) && !filter_var($_POST['login-mail'], FILTER_VALIDATE_EMAIL))
                    {
                        $mailFormatError = "Format de l'adresse email invalide.";
                    }
                    ?>
                    <span id='mailFormatError' class='error'><?php echo $mailFormatError ?></span>
                </div>

                <label for="password">Mot de passe</label>
                <div class="input">
                    <input type="password" id="login-password" name = "login-password" onkeypress="verifChar(event)" placeholder="Mot de passe" data-error-for="login-passwordError">
                    <span id="login-passwordError" class="error"></span>
                </div>

                <div class="button">
                    <button type="submit" name="login" value="login">Continuer</button>
                </div>
                <span> En cliquant sur Continuer, vous acceptez les conditions de vente du Monde Est Vache.</span>
            </form>
        </section>

        <?php
        if(isset($_POST["login"]) && !filter_var($_POST['login-mail'], FILTER_VALIDATE_EMAIL) && verifChar() == false)
        {
            var_dump($_POST);
            $loginMail = htmlspecialchars($_POST["login-mail"], ENT_QUOTES, 'UTF-8');
            $loginPassword = $_POST["login-password"];

            $emailCheck = $mysqlClient->prepare("SELECT COUNT(*) AS emailCount FROM client WHERE mail_clt='$loginMail'");
            $emailCheck -> execute();
            $emailCheck = $emailCheck -> fetch();
            if($emailCheck['emailCount'] != 1)
            {
                echo
                '<div id="popup" class="popup">
                    <div class="popup-content">
                        <div id="error-message" class="error-message">Aucun compte ne correspond à cette adresse e-mail.</div>
                    </div>
                </div>';
            }
            else{
                $passwordCheck = $mysqlClient->prepare("SELECT mdp FROM client WHERE mail_clt='$loginMail'");
                $passwordCheck -> execute();
                $passwordCheck = $passwordCheck -> fetch();
                if(password_verify($loginPassword, $passwordCheck['mdp'])){
                    echo
                    '<div id="popup" class="popup">
                        <div class="popup-content">
                            <div id="error-message" class="error-message">Mot de passe invalide.</div>
                        </div>
                    </div>';
                }
                else {
                    $account = $mysqlClient->prepare("SELECT * FROM client WHERE mail_clt = '$loginMail' AND mdp = '$loginPassword'");
                    $account -> execute();
                    $account = $account -> fetch();

                    $_SESSION['id'] = $account['id'];
                    $_SESSION['mail_clt'] = $account['mail_clt'];

                    echo
                    '<div id="popup" class="popup">
                        <div class="popup-content">
                            <div id="error-message" class="error-message">Bienvenue '.$account['nom_clt']." ".$account['prenom_clt'].'</div>
                        </div>
                    </div>';
                }
            }
        }
        ?>
    <!--<script src="inscription.js"></script>
    <script src="../verifChar.js"></script>-->
    <script src="../popup.js"></script>
</body>
</html>