<?php
namespace App\Fonctions;
    function Redirect_Self_URL():void{
        unset($_REQUEST);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }

function GenereMDP($nbChar) :string {
    $chaine = "ABCDEFGHIJKLMONOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789&\"'(-_)=*!:;,{[|\]}";
    $pass = '';
    for ($i = 0; $i < $nbChar; $i++) {
        $pass .= $chaine[random_int(0,99999999) % strlen($chaine)];
    }
    return $pass;
}

function CalculComplexiteMdp($mdp) :int{
    $longueurMDP = strlen($mdp);
    $minuscules = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
    $majuscules = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
    $chiffres = ["0","1","2","3","4","5","6","7","8","9"];
    $symboles = [" ","!","\"","#","$","%","&","'","(",")","*","+",",","-",".","/",":",";","<","=",">","?","@","[","\\","]","^","_","`","{","|","}","~"];
    $symboles2 = ["Ç","ü","é","â","ä","à","ç","ê","ë","è","ï","î","Ä","É","ô","ö","û","ÿ","Ö","Ü","£","ñ","Ñ"];
    $symbolesUtilises = [];
    $nbCaracteresPossibles = 0;
    for($i=0;$i<strlen($mdp);$i++) {
        if (in_array($mdp[$i],$minuscules) and !in_array($minuscules,$symbolesUtilises)) {
            $nbCaracteresPossibles += count($minuscules);
            $symbolesUtilises[] = $minuscules;
        } elseif (in_array($mdp[$i],$majuscules) and !in_array($majuscules,$symbolesUtilises)) {
            $nbCaracteresPossibles += count($majuscules);
            $symbolesUtilises[] = $majuscules;
        } elseif (in_array($mdp[$i],$chiffres) and !in_array($chiffres,$symbolesUtilises)) {
            $nbCaracteresPossibles += count($chiffres);
            $symbolesUtilises[] = $chiffres;
        } elseif (in_array($mdp[$i],$symboles) and !in_array($symboles,$symbolesUtilises)) {
            $nbCaracteresPossibles += count($symboles);
            $symbolesUtilises[] = $symboles;
        } elseif (in_array($mdp[$i],$symboles2) and !in_array($symboles2,$symbolesUtilises)) {
            $nbCaracteresPossibles += count($symboles2);
            $symbolesUtilises[] = $symboles2;
        }
    }
    $complexite = log($nbCaracteresPossibles**$longueurMDP)/log(2)+1;
    return $complexite;
}

function envoiMailOubliMDP($to,$mdp):void {
    $subject = "Demande de réinitialisation de mot de passe.";
    $message = "Vous venez de nous demander de réinitialiser votre mot de passe suite à un oubli de votre petite tête d'imbécile.
Voici un mot de passe temporaire, donc essayez de le retenir dans votre grain de riz qui vous sert de cerveau jusqu'à pouvoir le modifier :
".$mdp;
    $headers = ["From" => "cafe@cafe.fr",
        "Content-Type" => "text/html; charset=utf-8"
        ];
    mail($to,$subject,$message,$headers);
}