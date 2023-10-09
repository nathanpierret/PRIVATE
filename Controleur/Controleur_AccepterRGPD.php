<?php

use App\Modele\Modele_Utilisateur;
use App\Vue\Vue_Accepter_RGPD;
use App\Vue\Vue_Connexion_Formulaire_client;
use App\Vue\Vue_ConsentementRGPD;
use App\Vue\Vue_Menu_Administration;
use App\Vue\Vue_Structure_Entete;


switch ($action) {
    case "Se connecter":
        $Vue->setEntete(new Vue_Structure_Entete());
        $Vue->addToCorps(new Vue_ConsentementRGPD());
        $Vue->addToCorps(new Vue_Accepter_RGPD());
        break;
    case "submitAccepterRGPD":
        Modele_Utilisateur::Utilisateur_AccepterRGPD($_SESSION["idUtilisateur"]);
    case "submitRefuserRGPD":
        session_destroy();
        unset($_SESSION);
        $Vue->setEntete(new Vue_Structure_Entete());
        $Vue->addToCorps(new Vue_Connexion_Formulaire_client());
        break;
}