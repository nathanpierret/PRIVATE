<?php

namespace App\Modele;

use App\Utilitaire\Singleton_ConnexionPDO;
use PDO;

class Modele_Jeton
{
    /**
     * @param $connexionPDO : connexion à la base de données
     * @return mixed : le tableau des Jetons ou null (something went wrong...)
     */
    static function Jeton_Select()
    {
        $connexionPDO = Singleton_ConnexionPDO::getInstance();
        $requetePreparee = $connexionPDO->prepare('select * from `token` order by id');
        $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
        $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
        return $tableauReponse;
    }

    /**
     * @param $idJeton
     * @return mixed
     */
    static function Jeton_Select_ParId($idJeton)
    {
        $connexionPDO = Singleton_ConnexionPDO::getInstance();
        $requetePreparee = $connexionPDO->prepare('select * from `token` where id = :paramId');
        $requetePreparee->bindParam('paramId', $idJeton);
        $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
        $jeton = $requetePreparee->fetch(PDO::FETCH_ASSOC);
        return $jeton;
    }

    /**
     * @param $token
     * @return mixed
     */
    static function Jeton_Select_ParToken($token)
    {
        $connexionPDO = Singleton_ConnexionPDO::getInstance();
        $requetePreparee = $connexionPDO->prepare('select * from `token` where valeur = :paramToken');
        $requetePreparee->bindParam('paramToken',$token);
        $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
        $jeton = $requetePreparee->fetch(PDO::FETCH_ASSOC);
        return $jeton;
    }

    /**
     * @param $valeurJeton
     * @param $idUtilisateur
     * @param $codeAction
     * @return mixed
     */
    static function Jeton_Creation($valeurJeton,$idUtilisateur,$codeAction)
    {
        $dateFin = (new \DateTime())->add(\DateInterval::createFromDateString("14 days"))->format("d/m/Y H:i:s");
        $connexionPDO = Singleton_ConnexionPDO::getInstance();
        $requetePreparee = $connexionPDO->prepare('INSERT INTO `token` (`valeur`,`codeAction`,`idUtilisateur`,`dateFin`) 
                                                         VALUES (:valeurJeton, :codeAction, :idUtilisateur,:dateFin);');
        $requetePreparee->bindParam('valeurJeton',$valeurJeton);
        $requetePreparee->bindParam('codeAction',$codeAction);
        $requetePreparee->bindParam('idUtilisateur',$idUtilisateur);
        $requetePreparee->bindParam('dateFin',$dateFin);
        $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
        return $reponse;
    }

    /**
     * @param $idJeton
     * @return mixed
     */
    static function Jeton_Supprimer($idJeton)
    {
        $connexionPDO = Singleton_ConnexionPDO::getInstance();
        $requetePreparee = $connexionPDO->prepare('delete token.* from `token` where id = :paramId');
        $requetePreparee->bindParam('paramId', $idJeton);
        $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
        return $reponse;
    }

    static function Jeton_Modifier($idJeton,$valeurJeton,$codeAction,$idUtilisateur)
    {
        $connexionPDO = Singleton_ConnexionPDO::getInstance();
        $requetePreparee = $connexionPDO->prepare('UPDATE `token` SET `valeur`= :paramValeur, `codeAction`= :paramAction, `idUtilisateur`= :paramUtilisateur
                                                          WHERE `id`= :paramId');
        $requetePreparee->bindParam('paramValeur',$valeurJeton);
        $requetePreparee->bindParam('paramAction',$codeAction);
        $requetePreparee->bindParam('paramUtilisateur',$idUtilisateur);
        $requetePreparee->bindParam('paramId',$idJeton);
        $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
        return $reponse;
    }
}