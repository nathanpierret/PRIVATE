<?php

//il faudra décommenter l'extension sodium de php.ini, et faire un composer update dans le terminal de phpstorm

//Création de la séquence aléatoire à la base du mot de passe
$octetsAleatoires = openssl_random_pseudo_bytes (12) ;
//Transformation de la séquence binaire en caractères alpha
$motDePasse = sodium_bin2base64($octetsAleatoires, SODIUM_BASE64_VARIANT_ORIGINAL);
echo $motDePasse.PHP_EOL;

function passgen1($nbChar)
{
    $chaine = "ABCDEFGHIJKLMONOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789&é\"'(-è_çà)=$^*ù!:;,~#{[|`\^@]}¤€";
    $pass = '';
    for ($i = 0; $i < $nbChar; $i++) {
        $pass .= $chaine[random_int(0,99999999) % strlen($chaine)];
    }
    return $pass;
}
for ($i=0;$i<100;$i++) {
    $mdp = passgen1(15);
    echo $mdp.PHP_EOL;
}
