<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;
require_once "src\Fonctions\CSRF.php";
class Vue_Commande_Info extends Vue_Composant
{
    private array $infoCommande;
    public function __construct(array $infoCommande)
    {
        $this->infoCommande=$infoCommande;
    }

    function donneTexte(): string
    {
        return "";
    }

}