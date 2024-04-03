<?php
function validChar()
{
    $specialChar = "/[<>\/&|`\"'*]/";
    foreach($_POST as $key => $value)
    {
        if(($key !== "password" && $key !== 'confirmPassword' && $key !== 'login-password') && preg_match($specialChar, $value))
        {
            return false;
        }
    }
    return true;
}

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
    if($strength && strlen($_POST['password']) >= 12)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function encrypt_id($id){
    $key = "FarfadetMalicieux";
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted_id = openssl_encrypt($id, 'aes-256-cbc', $key, 0, $iv);

    // Retourner à la fois l'ID chiffré et l'IV
    return base64_encode($iv . $encrypted_id); // Encodage base64
}

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