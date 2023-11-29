<?php

namespace App\Tests\unitaires;
require "./vendor/autoload.php";

use App\Modele\Modele_Utilisateur;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use App\Modele\Modele_Jeton;
use function App\Fonctions\GenererValeurToken;

class JetonTest extends TestCase
{
    #[test]
    public function ModeleJeton_JetonCreation_False()
    {
        $valeurJeton = GenererValeurToken();
        $idUtilisateur = Modele_Utilisateur::Utilisateur_Select_ParLogin("contact@kazio.com")["idUtilisateur"];
        $jeton = Modele_Jeton::Jeton_Creation($valeurJeton,$idUtilisateur,2);
        $this->assertFalse($jeton);
    }

    #[test]
    public function ModeleJeton_JetonSelect_Array()
    {
        $jeton = Modele_Jeton::Jeton_Select();
        $this->assertEquals(3,$jeton[2]["id"]);
        $this->assertEquals();
    }
}
