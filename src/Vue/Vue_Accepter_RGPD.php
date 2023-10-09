<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Accepter_RGPD extends Vue_Composant
{

    private string $action;
    private string $msg;

    function __construct(string $msg="", string $case="Controleur_AccepterRGPD")
    {
        $this->msg=$msg;
        $this->case=$case;
    }

    function donneTexte(): string
    {
        $str="    <form style='display: contents'>
        
<table style='display: inline-block'> 

        <h1>Pour continuer à accéder à notre site, veuillez accepter le consentement RGPD.</h1>
        <tr>
            <td>
                <input type='hidden' name='case' value='$this->case'>
            </td>
        </tr>
        <tr>
            <td>
                <div><input type='checkbox' id='droitOppo' name='droitOppo'> <label for='droitOppo'>Je souhaite que mes données personnelles ne soient pas utilisées pour des traitements non-obligatoires.</label></div>
            </td>
        </tr>
        <tr>
            <td>
                <button type='submit' id='submitAccepterRGPD' name='action' value='submitAccepterRGPD'>
                 J'accepte
                 </button>
            </td>
            <td>
                <button type='submit' id='submitRefuserRGPD' name='action' value='submitRefuserRGPD'>
                 Je refuse
                 </button>
            </td>
        </tr>
    </form>$this->msg";
        return $str;
    }
}