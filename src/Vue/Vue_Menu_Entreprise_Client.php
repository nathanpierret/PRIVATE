<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;
require_once "src\Fonctions\CSRF.php";
class Vue_Menu_Entreprise_Client extends Vue_Composant
{
    public function __construct()
    {
    }

    function donneTexte(): string
    {
        return "
<nav id='menu'>
  <ul id='menu-closed'>  
    <li><a href='?case=Gerer_Entreprise".genereVarHrefCSRF()."'>Compte d'entreprise</a></li> 
    
  </ul>
</nav> ";
    }
}

