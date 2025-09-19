<?php

class Gerer
{
    private $pdo;
    public function __construct()
    {
        $this->pdo=PdoBridge::getPdoBridge();
    }
    public function accueil():void
    {
        $message="Ce site permet d'enregistrer les participants à une épreuve.";
        include("views/v_accueil.php");
    }
    public function lister()
    {
        $les_membres=$this->pdo->getLesMembres();
        if(count($les_membres) < 1){
            $this->error("Il n'y a pas de membres dans la liste, veuillez en ajouter", "views/v_no_member_to_delete.php");
            return;
        }
        require 'views/v_listemembres.php';
    }
    public function choisir($action="modifier", $bouton="Modifier"):void
    {
        $les_membres = $this->pdo->getLesMembres();
        if(count($les_membres) < 1){
            $this->error("Il n'y a pas de membres à ". strtolower($bouton) ." dans la liste,", 
                            "views/v_no_member_to_delete.php");
            return;
        }
        require 'views/v_choisirmembre.php';
    }
   
    public function modifier():void
    {
        $id=$_REQUEST['id'];
        $unMembre=$this->pdo->getUnMembre($id);
        $unMembre=$unMembre[0];

        require "views/v_saisiemembre.php";
    }

    public function validerModif():void
    {
        $this->pdo->updateMembre($_REQUEST['id'],
                                $_REQUEST['nouveau-nom'],
                                $_REQUEST['nouveau-prenom']);
        $unMembre=$this->pdo->getUnMembre($_REQUEST['id'])[0];

        $this->lister();
    }
    
    public function ajouter():void
    {
        require "views/v_nouveau_membre.php";
    }
    public function ajouterUnMembre():void
    {
        $nom = $_REQUEST['nom'];
        $prenom = $_REQUEST['prenom'];
        $id = $this->pdo->getMaxId() + 1;
        $this->pdo->ajouterMembre($id, $nom, $prenom);
        $this->lister();
    }

    public function supprimer():void
    {
        $nbMembres = count($this->pdo->getLesMembres());
        $this->choisir("supprimerUnMembre", "Supprimer");
    }
    public function supprimerUnMembre():void
    {
        $id = $_REQUEST['id'];
        $this->pdo->supprimerMembre($id);
        $this->lister();
    }
    public function error($errorMessage = "Site en construction", $pageToShow = "views/404.php"):void
    {
        $_SESSION["message_erreur"] = $errorMessage;
        include($pageToShow);
    }
}
