<?php

use App\Modele\Modele_Commande;
use App\Modele\Modele_Salarie;
use App\Vue\Vue_Compte_Administration_Gerer;
use App\Vue\Vue_Connexion_Formulaire_client;
use App\Vue\Vue_Menu_Entreprise_Salarie;
use App\Vue\Vue_Structure_BasDePage;
use App\Vue\Vue_Structure_Entete;
use App\Vue\Vue_Utilisateur_Changement_MDP;


switch ($action) {
    case "changerMDP":
        //Il a cliqué sur changer Mot de passe. Cas pas fini
        $Vue->setEntete(new Vue_Structure_Entete());
        $quantiteMenu = Modele_Commande::Panier_Quantite($_SESSION["idEntreprise"]);
        $Vue->setMenu(new Vue_Menu_Entreprise_Salarie($quantiteMenu));
        $Vue->addToCorps(new Vue_Utilisateur_Changement_MDP("", "Gerer_MonCompte_Salarie"));
        break;
    case "submitModifMDP":
        //il faut récuperer le mdp en BDD et vérifier qu'ils sont identiques
        $salarie = Modele_Salarie::Salarie_Select_byId($_SESSION["idSalarie"]);
        $utilisateur_salarie = \App\Modele\Modele_Utilisateur::Utilisateur_Select_ParLogin($salarie["mail"]);
        if ($_REQUEST["AncienPassword"] == $utilisateur_salarie["motDePasse"]) {
            //on vérifie si le mot de passe de la BDD est le même que celui rentré
            if ($_REQUEST["NouveauPassword"] == $_REQUEST["ConfirmPassword"]) {
                if (\App\Fonctions\CalculComplexiteMdp($_REQUEST["NouveauPassword"]) >= 90) {
                    $Vue->setEntete(new Vue_Structure_Entete());
                    $quantiteMenu = Modele_Commande::Panier_Quantite($_SESSION["idEntreprise"]);
                    $Vue->setMenu(new Vue_Menu_Entreprise_Salarie($quantiteMenu));
                    Modele_Salarie::Salarie_Modifier_motDePasse($_SESSION["idSalarie"], $_REQUEST["NouveauPassword"]);
                    \App\Modele\Modele_Utilisateur::Utilisateur_Modifier_ObligationModifMDP($utilisateur_salarie["idUtilisateur"],0);
                    \App\Modele\Modele_Utilisateur::Utilisateur_Modifier_MDPTemp($utilisateur_salarie["idUtilisateur"],"");
                    $Vue->addToCorps(new Vue_Compte_Administration_Gerer("<br><label><b>Votre mot de passe a bien été modifié</b></label>", "Gerer_MonCompte_Salarie"));
                    // Dans ce cas les mots de passe sont bons, il est donc modifier
                } else {
                    if (\App\Fonctions\CalculComplexiteMdp($_REQUEST["NouveauPassword"]) < 64 ) {
                        $Vue->setEntete(new Vue_Structure_Entete());
                        $quantiteMenu = Modele_Commande::Panier_Quantite($_SESSION["idEntreprise"]);
                        $Vue->setMenu(new Vue_Menu_Entreprise_Salarie($quantiteMenu));
                        $Vue->addToCorps(new Vue_Utilisateur_Changement_MDP("<label><b>Le nouveau mot de passe est très faible. Essayez un mot de passe plus fort.</b></label>", "Gerer_monCompte"));
                    } elseif (\App\Fonctions\CalculComplexiteMdp($_REQUEST["NouveauPassword"]) < 80) {
                        $Vue->setEntete(new Vue_Structure_Entete());
                        $quantiteMenu = Modele_Commande::Panier_Quantite($_SESSION["idEntreprise"]);
                        $Vue->setMenu(new Vue_Menu_Entreprise_Salarie($quantiteMenu));
                        $Vue->addToCorps(new Vue_Utilisateur_Changement_MDP("<label><b>Le nouveau mot de passe est faible. Essayez un mot de passe plus fort.</b></label>", "Gerer_monCompte"));
                    } else {
                        $Vue->setEntete(new Vue_Structure_Entete());
                        $quantiteMenu = Modele_Commande::Panier_Quantite($_SESSION["idEntreprise"]);
                        $Vue->setMenu(new Vue_Menu_Entreprise_Salarie($quantiteMenu));
                        $Vue->addToCorps(new Vue_Utilisateur_Changement_MDP("<label><b>Le nouveau mot de passe est de force moyenne. Essayez un mot de passe plus fort.</b></label>", "Gerer_monCompte"));
                    }
                }


            } else {
                $Vue->setEntete(new Vue_Structure_Entete());
                $quantiteMenu = Modele_Commande::Panier_Quantite($_SESSION["idEntreprise"]);
                $Vue->setMenu(new Vue_Menu_Entreprise_Salarie($quantiteMenu));

                $Vue->addToCorps(new Vue_Utilisateur_Changement_MDP("<br><label><b>Les nouveaux mots de passe ne sont pas identiques</b></label>", "Gerer_MonCompte_Salarie"));
            }
        } else {
            $Vue->setEntete(new Vue_Structure_Entete());
            $quantiteMenu = Modele_Commande::Panier_Quantite($_SESSION["idEntreprise"]);
            $Vue->setMenu(new Vue_Menu_Entreprise_Salarie($quantiteMenu));

            $Vue->addToCorps(new Vue_Utilisateur_Changement_MDP("<label><b>Vous n'avez pas saisi le bon mot de passe</b></label>", "Gerer_MonCompte_Salarie"));
        }
        break;
    case "SeDeconnecter":
        //L'utilisateur a cliqué sur "se déconnecter"
        session_destroy();
        unset($_SESSION);
        $Vue->setEntete(new Vue_Structure_Entete());
        $Vue->addToCorps(new Vue_Connexion_Formulaire_client());
        break;
    default :
        //Cas par défaut: affichage du menu des actions.
        $Vue->setEntete(new Vue_Structure_Entete());
        $quantiteMenu = Modele_Commande::Panier_Quantite($_SESSION["idEntreprise"]);
        $Vue->setMenu(new Vue_Menu_Entreprise_Salarie($quantiteMenu));
        $Vue->addToCorps(new Vue_Compte_Administration_Gerer("", "Gerer_MonCompte_Salarie"));
}


$Vue->setBasDePage(new Vue_Structure_BasDePage());
