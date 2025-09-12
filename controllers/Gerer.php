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
        require 'views/v_listemembres.php';
    }
    public function choisir():void
    {
        $les_membres = $this->pdo->getLesMembres();
        $action = "modifier";
        $bouton = "Modifier";
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
        $id=$_REQUEST['id'];
        $nom=$_REQUEST['nouveau-nom'];
        $prenom=$_REQUEST['nouveau-prenom'];
        $unMembre=$this->pdo->getUnMembre($id);
        $unMembre=$unMembre[0];
        $unMembre->pdo->updateMembre($id,$nom,$prenom);
        require "views/v_listemembres.php";
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
        require "views/v_accueil.php";
    }

    public function supprimer():void
    {
        $les_membres = $this->pdo->getLesMembres();
        $action = "supprimerUnMembre";
        $bouton = "Supprimer";
        require "views/v_choisirmembre.php";
    }
    public function supprimerUnMembre():void
    {
        $id = $_REQUEST['id'];
        $this->pdo->supprimerMembre($id);
        require "views/v_listemembres.php";
    }
    public function error():void
    {
        $_SESSION["message_erreur"] = "Site en construction";
        include("views/404.php");
    }
}
