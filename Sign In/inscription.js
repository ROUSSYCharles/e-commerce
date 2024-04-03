// Changement de formulaire quand on clique sur le bouton en haut à droite du formulaire
document.getElementById("login-change-form").addEventListener("click",function(){
    var signInFormStyle = document.querySelector("form[name='signin-form'").style;
    var loginFormStyle = document.querySelector("form[name='login-form'").style;

    signInFormStyle.display = "block";
    loginFormStyle.display = "none";
});
document.getElementById("change-form").addEventListener("click",function(){
    var signInFormStyle = document.querySelector("form[name='signin-form'").style;
    var loginFormStyle = document.querySelector("form[name='login-form'").style;

    signInFormStyle.display = "none";
    loginFormStyle.display = "block";
});

// Verif si le mdp est fort
function passwordStrength(password){
    var strength = 0;
    var tips = "";
    var strengthPasswordStr = document.getElementById('charPassword');
    var strengthPasswordStyle = document.getElementById('passwordStrength').style;
    var passwordInputStyle = document.getElementById('password').style;
    var isStrong = false
  
    // Vérifier la longueur du mot de passe
    if (password.length < 12) {
      tips += "Le mot de passe contenir 12 caractères.<br>";
    } else {
      strength += 1;
    }
  
    // Vérifier s'il contient minuscule et majuscule
    if (password.match(/[a-z]/) && password.match(/[A-Z]/)) {
      strength += 1;
    } else {
      tips += "Utilisez des lettres minuscules et majuscules.<br>";
    }
  
    // Vérifier s'il contient au moins un chiffre
    if (password.match(/\d/)) {
      strength += 1;
    } else {
      tips += "Ajoutez au moins un chiffre.<br>";
    }
  
    // Vérifier s'il contient au moins un caractère spécial
    if (password.match(/[!@#$%^()_+\-=\[\]{};:\\,.?]+/)) {
      strength += 1;
    } else {
      tips += "Ajoutez au moins un caractère spécial. ";
    }
  
    // Affichage éléments manquant pour que le mdp soit fort et Return
    if (strength < 2) {
        strengthPasswordStr.innerHTML = "Mot de passe faible.<br>" + tips;
        strengthPasswordStyle.backgroundColor = passwordInputStyle.backgroundColor = "rgba(253, 61, 61, 0.700)";
    } else if (strength === 2) {
        strengthPasswordStr.innerHTML = "Mot de passe intermédiaire.<br>" + tips;
        strengthPasswordStyle.backgroundColor = passwordInputStyle.backgroundColor = "rgba(247, 186, 74, 0.7)";
    } else if (strength === 3) {
        strengthPasswordStr.innerHTML = "Mot de passe fort.<br>" + tips;
        strengthPasswordStyle.backgroundColor = passwordInputStyle.backgroundColor = "rgba(176, 247, 83, 0.7)";
    } else {
        strengthPasswordStr.innerHTML = "Mot de passe très fort.<br>" + tips;
        strengthPasswordStyle.backgroundColor = passwordInputStyle.backgroundColor = "rgba(119, 250, 119, 0.700)";
        isStrong = true;
    }
    return isStrong;
}

// gestion style des input lors des erreurs
function inputErrorStyle(element){
    element.style.border = "1px solid red";
    element.style.backgroundColor = "rgb(248, 136, 136, 0.712)";
    element.style.animation ="shake-horizontal 0.05s alternate";
}
function resetErrorStyle(element){
    element.style.border = "1px solid #9c9c9c";
    element.style.backgroundColor = "white";
}

var signInForm = document.getElementById("signin-form");
var loginForm = document.getElementById("login-form");

// Msg d'erreurs sur le formulaire d'inscriptions si champs vide ou mdp et mdp de confirmation différents
// Empêche l'envoie du formulaire si une erreur se produit
signInForm.addEventListener("submit", function(event)
{
    var name = document.getElementById("name").value;
    var surname = document.getElementById("surname").value;
    var mail = document.getElementById("mail").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    var nameError = document.getElementById("nameError");
    var surnameError = document.getElementById("surnameError");
    var mailError = document.getElementById("mailError");
    var passwordError = document.getElementById("passwordError");
    var confirmPasswordError = document.getElementById("confirmPasswordError");

    nameError.innerHTML= "";
    surnameError.innerHTML = "";
    mailError.innerHTML = "";
    passwordError.innerHTML = "";
    confirmPasswordError.innerHTML = "";

    if(name === "")
    {
        nameError.innerHTML = "Veuillez saisir votre nom.";
        inputErrorStyle(document.getElementById("name"));
        event.preventDefault(); // Empêcher l'envoi du formulaire
    }
    else{
        resetErrorStyle(document.getElementById("name"));
    }

    if (surname === "")
    {
        surnameError.innerHTML = "Veuillez saisir votre prénom.";
        inputErrorStyle(document.getElementById("surname"));
        event.preventDefault();
    }
    else{
        resetErrorStyle(document.getElementById("surname"));
    }

    if (mail === "")
    {
        mailError.innerHTML = "Veuillez saisir votre adresse e-mail.";
        inputErrorStyle(document.getElementById("mail"));
        event.preventDefault();
    }
    else{
        resetErrorStyle(document.getElementById("mail"));
    }

    if (password === "")
    {
        document.getElementById("charPassword").innerHTML = "";
        passwordError.innerHTML = "Veuillez saisir votre mot de passe.";
        inputErrorStyle(document.getElementById("password"));
        event.preventDefault();
    } else if (!passwordStrength(password)) {
        passwordError.innerHTML = "Mot de passe trop faible.";
        inputErrorStyle(document.getElementById("password"));
        event.preventDefault();
    }
    else{
        resetErrorStyle(document.getElementById("password"));
    }

    if (confirmPassword === "")
    {
        confirmPasswordError.innerHTML = "Veuillez confirmer votre mot de passe.";
        inputErrorStyle(document.getElementById("confirmPassword"));
        event.preventDefault();
    }
    else if (confirmPassword !== password)
    {
        confirmPasswordError.innerHTML = "Les mots de passe ne correspondent pas.";
        inputErrorStyle(document.getElementById("confirmPassword"));
        event.preventDefault();
    }
    else{
        resetErrorStyle(document.getElementById("confirmPassword"));
    }
});

// Idem pour le formulaire de connexion
loginForm.addEventListener("submit", function(event)
{
    
    var loginMail = document.getElementById("login-mail").value;
    var loginPassword = document.getElementById("login-password").value;

    var loginMailError = document.getElementById("login-mailError");
    var loginPasswordError = document.getElementById("login-passwordError");

    loginMailError.innerHTML = "";
    loginPasswordError.innerHTML = "";

    if (loginMail === "")
    {
        loginMailError.innerHTML = "Veuillez saisir votre adresse e-mail.";
        inputErrorStyle(document.getElementById("login-mail"));
        event.preventDefault();
    }
    else{
        resetErrorStyle(document.getElementById("login-mail"));
    }

    if (loginPassword === "")
    {
        document.getElementById("charPassword").innerHTML = "";
        loginPasswordError.innerHTML = "Veuillez saisir votre mot de passe.";
        inputErrorStyle(document.getElementById("login-password"));
        event.preventDefault();
    } else if (password.length < 12) {
        loginPasswordError.innerHTML = "12 caractères requis.";
        inputErrorStyle(document.getElementById("login-password"));
        event.preventDefault();
    }
    else{
        resetErrorStyle(document.getElementById("login-password"));
    }
});