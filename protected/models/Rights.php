<?php

/*
 * Cette classe servira pour la gestion des droits dynamiques.
 * Plutôt que de faire une recherche dans la DB à chaque fois qu'on passe par les accessRules,
 * on instancie cet objet avec les valeurs des droits de l'utilisateur qui se log
 * et on met cet objet comme variable de session (tout ça dans le UserIdentity,
 * lorsqu'une personne se log).
 * Dans cette classe les droits sont divisés par controleur et sont tous des integer
 * (voir méthode 'setDroits()' dans 'UserIdentity' et méthode 'AccessRules()' dans les controleurs)
 */
class Rights {

    /*
     * Chaque variable correspond aux droits sur un contrôleur (le nom de la
     * variable correpond au nom du contrôleur)
     */
    private $batiment;
    private $categorie;
    private $dashboard;
    private $entreprise;
    private $locataire;
    private $ticket;
    private $user;
    
    //--------------------------------------------------------------------------
    //---------------------------- Getters & Setters ---------------------------
    //--------------------------------------------------------------------------
    public function setBatiment($droit) { $this->batiment = $droit; }
    public function setCategorie($droit) { $this->categorie = $droit; }
    public function setDashboard($droit) { $this->dashboard = $droit; }
    public function setEntreprise($droit) { $this->entreprise = $droit; }
    public function setLocataire($droit) { $this->locataire = $droit; }
    public function setTicket($droit) { $this->ticket = $droit; }
    public function setUser($droit) { $this->user = $droit; }
    //--------------------------------------------------------------------------
    public function getBatiment() { return $this->batiment; }
    public function getCategorie() { return $this->categorie; }
    public function getDashboard() { return $this->dashboard; }
    public function getEntreprise() { return $this->entreprise; }
    public function getLocataire() { return $this->locataire; }
    public function getTicket() { return $this->ticket; }
    public function getUser() { return $this->user; }

}
?>