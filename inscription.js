document.getElementById("form").addEventListener("submit", function(event)
{
    var name = document.getElementById("name").value;
    var surname = document.getElementById("surname").value;
    var mail = document.getElementById("mail").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm-password").value;

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

    if (name === "")
    {
        nameError.innerHTML = "Veuillez saisir votre nom.";
        event.preventDefault(); // Empêcher l'envoi du formulaire
    }

    if (surname === "")
    {
        surnameError.innerHTML = "Veuillez saisir votre prénom.";
        event.preventDefault(); // Empêcher l'envoi du formulaire
    }

    if (mail === "")
    {
        mailError.innerHTML = "Veuillez saisir votre adresse e-mail.";
        event.preventDefault(); // Empêcher l'envoi du formulaire
    }

    if (password === "")
    {
        document.getElementById("charPassword").innerHTML = "";
        passwordError.innerHTML = "Veuillez saisir votre mot de passe.";
        event.preventDefault(); // Empêcher l'envoi du formulaire
    } else if (password.length < 8) {
        passwordError.innerHTML = "8 caractères requis.";
        event.preventDefault(); // Empêcher l'envoi du formulaire
    }

    if (confirmPassword === "")
    {
        confirmPasswordError.innerHTML = "Veuillez confirmer votre mot de passe.";
        event.preventDefault(); // Empêcher l'envoi du formulaire
    }
    else if (confirmPassword !== password)
    {
        confirmPasswordError.innerHTML = "Les mots de passe ne correspondent pas.";
        event.preventDefault(); // Empêcher l'envoi du formulaire
    }
});