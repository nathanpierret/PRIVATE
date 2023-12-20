<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Compte_Administration_Gerer extends Vue_Composant
{
    private string $msg;
    private string $action;

    function __construct (string $msg="", string $action= "Gerer_monCompte")
    {
        $this->msg=$msg;
        $this->action=$action;
    }


    function donneTexte(): string
    {
        $fichier = fopen("./public/DonneesPersonnelles.json","w");
        foreach ($_SESSION as $key => $item) {
            fwrite($fichier,$key." : ".$item.PHP_EOL);
        }
        fclose($fichier);
        return " 
    <H1>Gérer mon compte</H1>
    <table style='display: inline-block'>
        <tr>
            <td>
                <form style='display: contents'>
                    
                     <input type='hidden' name='case' value='$this->action'>
                     
                    <button type='submit' name='action' value='changerMDP'>Changer mot de passe </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <a href='./public/DonneesPersonnelles.json' download><button type='submit'>Droit à l'accès</button></a>
            </td>
        </tr>
        <tr>
            <td>
                <form style='display: contents'>
                    
                    <input type='hidden' name='case' value='$this->action'>
                    
                    <button type='submit' name='action' value='SeDeconnecter'>
                        Se déconnecter 
                    </button>
                </form>
            </td>
        </tr>
    </table>
    $this->msg
    ";
     }
}