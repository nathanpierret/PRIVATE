<?php


use App\Modele\Modele_Utilisateur;
use App\Vue\Vue_Compte_Administration_Gerer;
use App\Vue\Vue_Connexion_Formulaire_client;
use App\Vue\Vue_Menu_Administration;
use App\Vue\Vue_Structure_BasDePage;
use App\Vue\Vue_Structure_Entete;
use App\Vue\Vue_Utilisateur_Changement_MDP;


switch ($action) {
    case "changerMDP":
        //Il a cliqué sur changer Mot de passe. Cas pas fini
        $Vue->setEntete(new Vue_Structure_Entete());
        $Vue->setMenu(new Vue_Menu_Administration($typeConnexion));
        $Vue->addToCorps(new Vue_Utilisateur_Changement_MDP("", "Gerer_monCompte"));
        break;
    case "submitModifMDP":
        //il faut récuperer le mdp en BDD et vérifier qu'ils sont identiques
        $utilisateur = Modele_Utilisateur::Utilisateur_Select_ParId($_SESSION["idUtilisateur"]);
        if ($_REQUEST["AncienPassword"] == $utilisateur["motDePasse"])
        {
            //on vérifie si le mot de passe de la BDD est le même que celui rentré
            if ($_REQUEST["NouveauPassword"] == $_REQUEST["ConfirmPassword"]) {
                $Vue->setEntete(new Vue_Structure_Entete());
                $Vue->setMenu(new Vue_Menu_Administration($typeConnexion));
                Modele_Utilisateur::Utilisateur_Modifier_motDePasse($_SESSION["idUtilisateur"], $_REQUEST["NouveauPassword"]);
                $Vue->addToCorps(new Vue_Compte_Administration_Gerer("<label><b>Votre mot de passe a bien été modifié</b></label>"));
                // Dans ce cas les mots de passe sont bons, il est donc modifier

            } else {
                $Vue->setEntete(new Vue_Structure_Entete());
                $Vue->setMenu(new Vue_Menu_Administration($typeConnexion));
                $Vue->addToCorps(new Vue_Utilisateur_Changement_MDP("<label><b>Les nouveaux mots de passe ne sont pas identiques</b></label>", "Gerer_monCompte"));
            }
        } else {
            $Vue->setEntete(new Vue_Structure_Entete());
            $Vue->setMenu(new Vue_Menu_Administration($typeConnexion));
            $Vue->addToCorps(new Vue_Utilisateur_Changement_MDP("<label><b>Vous n'avez pas saisi le bon mot de passe</b></label>", "Gerer_monCompte"));
        }
        break;
    case  "SeDeconnecter":
        //L'utilisateur a cliqué sur "se déconnecter"
        session_destroy();
        unset($_SESSION);
        $Vue->setEntete(new Vue_Structure_Entete());
        $Vue->addToCorps(new Vue_Connexion_Formulaire_client());
        break;
    case "droitAcces":
        $utilisateur = \App\Modele\Modele_Utilisateur::Utilisateur_Select_ParId($_SESSION["idUtilisateur"]);
        $fichier = fopen("./public/DonneesPersonnelles.json", "w");
        fwrite($fichier,"Données Utilisateur : ".PHP_EOL);
        foreach ($utilisateur as $key => $item) {
            fwrite($fichier,$key." : ".$item.PHP_EOL);
        }
        fclose($fichier);
        $full_path = './public/DonneesPersonnelles.json'; // chemin système (local) vers le fichier
        $file_name = basename($full_path);

        ini_set('zlib.output_compression', 0);
        $date = gmdate(DATE_RFC1123);

        header('Pragma: public');
        header('Cache-Control: must-revalidate, pre-check=0, post-check=0, max-age=0');

        header('Content-Tranfer-Encoding: none');
        header('Content-Length: '.filesize($full_path));
        header('Content-MD5: '.base64_encode(md5_file($full_path)));
        header('Content-Type: application/octetstream; name="'.$file_name.'"');
        header('Content-Disposition: attachment; filename="'.$file_name.'"');

        header('Date: '.$date);
        header('Expires: '.gmdate(DATE_RFC1123, time()+1));
        header('Last-Modified: '.gmdate(DATE_RFC1123, filemtime($full_path)));

        readfile($full_path);
        break;
    default:
        //Cas par défaut: affichage du menu des actions.
        $Vue->setEntete(new Vue_Structure_Entete());
        $Vue->setMenu(new Vue_Menu_Administration($typeConnexion));
        $Vue->addToCorps(new Vue_Compte_Administration_Gerer());
        break;
}

$Vue->setBasDePage(new Vue_Structure_BasDePage());
