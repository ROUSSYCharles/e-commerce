<?php
// Fonction permettant d'éviter les injections de code
function validChar()
{
    // regex avec les caractères spéciaux
    $specialChar = "/[<>\/&|`\"'*]/";
    foreach($_POST as $key => $value)
    {
        if(($key !== "password" && $key !== 'confirmPassword' && $key !== 'login-password') && preg_match($specialChar, $value))
        {
            return false; // une des valeur contient un des caractères présent dans le regex
        }
    }
    return true; // aucun caractère spécial du regex n'est présent
}

// Force du mdp lors de l'inscription
function passwordStrength()
{
    $passwordChars = ["/[a-z]/", "/[A-Z]/", "/\d/", "/[!@#$%^()_+\-=\[\]{};:\\,.?]+/"];
    $strength = 0;
    foreach($passwordChars as $passwordChar)
    {
        if(preg_match($passwordChar, $_POST['password']))
        {
            $strength ++;
        }
    }
    if($strength != 0 && strlen($_POST['password']) >= 12)
    {
        return true; // le mdp contient les différents types de char du regex et contient 12 char minimum
    }
    else
    {
        return false; // mdp trop faible
    }
}

// Chiffrement de l'id des motifs qui passe dans l'URL dans la page produit.php
function encrypt_id($id){
    $key = "FarfadetMalicieux";
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted_id = openssl_encrypt($id, 'aes-256-cbc', $key, 0, $iv);

    // Retourner à la fois l'ID chiffré et l'IV
    return base64_encode($iv . $encrypted_id); // Encodage base64
}

// Déchiffrement
function decrypt_id($encrypted_id) {
    $key = "FarfadetMalicieux";
    // Décodage base64
    $encrypted_id = base64_decode($encrypted_id);
    // Extraire l'IV et l'ID chiffré
    $iv = substr($encrypted_id, 0, openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted_id = substr($encrypted_id, openssl_cipher_iv_length('aes-256-cbc'));
    // Déchiffrer l'ID avec la clé et l'IV
    $decrypted_id = openssl_decrypt($encrypted_id, 'aes-256-cbc', $key, 0, $iv);
    return $decrypted_id;
}

// Vérif si un produit est présent dans le panier
function produitInPanier($id_pdt) {
    if(isset($_SESSION['panier'])) {
        foreach($_SESSION['panier'] as $produit) {
            if($produit['id_pdt'] == $id_pdt) {
                return true; // Le produit est présent dans le panier
            }
        }
    }
    return false; // Le produit n'est pas présent dans le panier
}