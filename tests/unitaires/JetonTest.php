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
    public function ModeleJeton_JetonCreation_True()
    {
        $valeurJeton = GenererValeurToken();
        $idUtilisateur = Modele_Utilisateur::Utilisateur_Select_ParLogin("contact@kazio.com")["idUtilisateur"];
        $jeton = Modele_Jeton::Jeton_Creation($valeurJeton,$idUtilisateur,2);
        $this->assertTrue($jeton);
    }

    #[test]
    public function ModeleJeton_JetonSelect_Array()
    {
        $jeton = Modele_Jeton::Jeton_Select();
        $this->assertEquals(3,$jeton[1]["id"]);
        $this->assertEquals(3,$jeton[1]["codeAction"]);
        $this->assertEquals("7KTCDFkFpbs+kCmzHLUC+g9CoxG7Ae1Sg5gxDZCzrmdHrQ44cspBYLbcxsL5MqaxLa7DzSBRO7/UBn+5w3L1b+L/fvfUAD2E5uWah0zWC42LDB1qauTqnWW5QUYdmrHeQYakON9D+YT4AQFux++eg6TBrjUGrxrMKPqdL15wE7imELviF39R4A81JTpPz0wXrKaWJ4AlXHAOWDUe4p1d4DeN03aCRO2puzfkfJn0n5RfIlSAPWMHtyeq/+rz+PrtnjyQbz5/6fzqhQpj2tNYnUNE5pf3IjNDb2HrpaL6kfpPW1xoHoIpaCRtse32BamhBaaAZ2MNt999Ojt2uphLfg==", $jeton[1]["valeur"]);
        $this->assertEquals(684,$jeton[1]["idUtilisateur"]);
        $this->assertEquals("2023-12-13 15:42:48",$jeton[1]["dateFin"]);
    }

    #[test]
    public function ModeleJeton_JetonSelectParId_Array()
    {
        $jeton = Modele_Jeton::Jeton_Select_ParId(2);
        $this->assertEquals(2,$jeton["id"]);
        $this->assertEquals(2,$jeton["codeAction"]);
        $this->assertEquals("7KTCDFkFpbs+kCmzHLUC+g9CoxG7Ae1Sg5gxDZCzrmdHrQ44cspBYLbcxsL5MqaxLa7DzSBRO7/UBn+5w3L1b+L/fvfUAD2E5uWah0zWC42LDB1qauTqnWW5QUYdmrHeQYakON9D+YT4AQFux++eg6TBrjUGrxrMKPqdL15wE7imELviF39R4A81JTpPz0wXrKaWJ4AlXHAOWDUe4p1d4DeN03aCRO2puzfkfJn0n5RfIlSAPWMHtyeq/+rz+PrtnjyQbz5/6fzqhQpj2tNYnUNE5pf3IjNDb2HrpaL6kfpPW1xoHoIpaCRtse32BamhBaaAZ2MNt999Ojt2uphLfg==", $jeton["valeur"]);
        $this->assertEquals(684,$jeton["idUtilisateur"]);
        $this->assertEquals("2023-12-13 15:42:48",$jeton["dateFin"]);
    }

    #[test]
    public function ModeleJeton_JetonModifier_True()
    {
        $jeton = Modele_Jeton::Jeton_Modifier(2,"7KTCDFkFpbs+kCmzHLUC+g9CoxG7Ae1Sg5gxDZCzrmdHrQ44cspBYLbcxsL5MqaxLa7DzSBRO7/UBn+5w3L1b+L/fvfUAD2E5uWah0zWC42LDB1qauTqnWW5QUYdmrHeQYakON9D+YT4AQFux++eg6TBrjUGrxrMKPqdL15wE7imELviF39R4A81JTpPz0wXrKaWJ4AlXHAOWDUe4p1d4DeN03aCRO2puzfkfJn0n5RfIlSAPWMHtyeq/+rz+PrtnjyQbz5/6fzqhQpj2tNYnUNE5pf3IjNDb2HrpaL6kfpPW1xoHoIpaCRtse32BamhBaaAZ2MNt999Ojt2uphLfg==",3,684);
        $this->assertTrue($jeton);
        $jeton2 = Modele_Jeton::Jeton_Select_ParId(2);
        $this->assertEquals(3,$jeton2["codeAction"]);
    }

    #[test]
    public function ModeleJeton_JetonSupprimer_True()
    {
        $jeton = Modele_Jeton::Jeton_Supprimer(2);
        $this->assertTrue($jeton);
        $jeton2 = Modele_Jeton::Jeton_Select_ParId(2);
        $this->assertEmpty($jeton2);
    }
}
