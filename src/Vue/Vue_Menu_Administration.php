<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Menu_Administration extends Vue_Composant
{
    public function __construct( )
    {           }
    function donneTexte(): string
    {

                return "
             <nav id='menu'>
              <ul id='menu-closed'> 
                <li><a href='?case=Gerer_utilisateur".genereVarHrefCSRF()."'>Utilisateurs</a></li>
                <li><a href='?case=Gerer_catalogue".genereVarHrefCSRF()."'>Catalogue</a></li>   
             <li><a href='?case=Gerer_entreprisesPartenaires".genereVarHrefCSRF()."'>Entreprises partenaires</a></li>
               <li><a href='?case=Gerer_Commande".genereVarHrefCSRF()."'>Commandes</a></li>
            
                <li><a href='?case=Gerer_monCompte".genereVarHrefCSRF()."'>Mon compte</a></li> 
               </ul>
            </nav> 
";
              
    }
}
