// Empêche la saisie des caractères spéciaux présents dans la variable specialChar
function verifChar(event) { 		
    var keyCode = event.which ? event.which : event.keyCode;
    var touche = String.fromCharCode(keyCode);

    var specialChar = "<>/&|`\"'*";
    var inputElement = event.target; // Récupère l'élément de formulaire sur lequel l'événement est déclenché
    var errorElementId = inputElement.dataset.errorFor; // Récupère l'ID de l'élément erreur associé

    var errorElement = document.getElementById(errorElementId); // Récupère l'élément erreur correspondant

    if((specialChar.indexOf(touche) >= 0 && errorElementId !== "passwordError" && errorElementId !== "confirmPasswordError") || (specialChar.indexOf(touche) >= 0 && (errorElementId == "passwordError" ||  errorElementId == "confirmPasswordError") && inputElement.type == "text"))
    {
        errorElement.innerHTML = "Le caractère " + touche + " est invalide.";
        event.preventDefault();
        if(errorElementId == "passwordError")
        {
            document.getElementById("charPassword").innerHTML = "";
        }
    }
    else
    {
        errorElement.innerHTML = "";
    }
}
document.addEventListener('paste', function(event)
{
    event.preventDefault(); // Empêche de coller (un caractère spécial par exemple)
});