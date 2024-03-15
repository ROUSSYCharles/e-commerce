document.getElementById("change-form").addEventListener("click",function(){
    let signInFormStyle = document.querySelector("form[name='signin-form'").style;
    let loginFormStyle = document.querySelector("form[name='login-form'").style;

    signInFormStyle.display = "block";
    loginFormStyle.display = "none";
});

function inputErrorStyle(element){
    element.style.border = "1px solid red";
    element.style.backgroundColor = "rgb(248, 136, 136, 0.712)";
    element.style.animation ="shake-horizontal 0.05s alternate";
}

var signInForm = document.getElementById("signin-form");
var loginForm = document.getElementById("login-form");
signInForm.addEventListener("submit", function(event)
{
    let name = document.getElementById("name").value;
    let surname = document.getElementById("surname").value;
    let mail = document.getElementById("mail").value;
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;

    let nameError = document.getElementById("nameError");
    let surnameError = document.getElementById("surnameError");
    let mailError = document.getElementById("mailError");
    let passwordError = document.getElementById("passwordError");
    let confirmPasswordError = document.getElementById("confirmPasswordError");

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

    if (surname === "")
    {
        surnameError.innerHTML = "Veuillez saisir votre prénom.";
        inputErrorStyle(document.getElementById("surname"));
        event.preventDefault();
    }

    if (mail === "")
    {
        mailError.innerHTML = "Veuillez saisir votre adresse e-mail.";
        inputErrorStyle(document.getElementById("mail"));
        event.preventDefault();
    }

    if (password === "")
    {
        document.getElementById("charPassword").innerHTML = "";
        passwordError.innerHTML = "Veuillez saisir votre mot de passe.";
        inputErrorStyle(document.getElementById("password"));
        event.preventDefault();
    } else if (password.length < 8) {
        passwordError.innerHTML = "8 caractères requis.";
        inputErrorStyle(document.getElementById("password"));
        event.preventDefault();
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
});

loginForm.addEventListener("submit", function(event)
{
    
    let loginMail = document.getElementById("login-mail").value;
    let loginPassword = document.getElementById("login-password").value;

    let loginMailError = document.getElementById("login-mailError");
    let loginPasswordError = document.getElementById("login-passwordError");

    loginMailError.innerHTML = "";
    loginPasswordError.innerHTML = "";

    if (loginMail === "")
    {
        loginMailError.innerHTML = "Veuillez saisir votre adresse e-mail.";
        inputErrorStyle(document.getElementById("login-mail"));
        event.preventDefault();
    }

    if (loginPassword === "")
    {
        document.getElementById("charPassword").innerHTML = "";
        loginPasswordError.innerHTML = "Veuillez saisir votre mot de passe.";
        inputErrorStyle(document.getElementById("login-password"));
        event.preventDefault();
    } else if (password.length < 8) {
        loginPasswordError.innerHTML = "8 caractères requis.";
        inputErrorStyle(document.getElementById("login-password"));
        event.preventDefault();
    }
});