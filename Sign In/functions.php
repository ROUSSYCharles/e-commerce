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