A la racine :  
  functions.php -> regroupe les différentes fonctions php utilisées sur le site  
  popup.css / popup.js -> code lié aux popup du site  
  template.php / template.css -> template appliqué à toutes les autres pages avec un require_once  
  verifChar.js -> code JS permettant d'empêcher l'utilisateur de taper ces caractères <>/&|`"'*  
  LMV.sql -> BDD  
  
------------------------------------------------------------------------------------------------------------------------------------------------  
  
Sign In :  
  Sign In.php -> formulaires de connexion et d'inscription  
  inscription.js -> code gérant :  
                    - la force du mot de passe  
                    - si les champs ne sont pas vides  
                    - le changement de formulaire quand on clique sur le bouton fait pour  
                      
------------------------------------------------------------------------------------------------------------------------------------------------  
  
  Catalogue :  
    Catalogue.php -> Affiche les différents motifs disponibles,  
                     cliquer sur un motif nous renvoie à la page produit.php avec les produits liés à ce motif             
    Produit.php -> Affiche une liste des produits liés au motif et permet d'ajouter le produit choisis au panier grâce à une variable de session  

panier -> Affiche la liste des produits dans le panier et permet de supprimer un produit du panier  
  
------------------------------------------------------------------------------------------------------------------------------------------------  
  
home_page :  
  home_page.php -> accueil (vide)  
  
LMEV Motif -> Répertoire avec tous les motifs de la boutique  
