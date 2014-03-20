<?php

class Rights {
    
    private $admin;
    private $batiment;
    private $categorie;
    private $dashboard;
    private $entreprise;
    private $lieu;
    private $locataire;
    private $ticket;
    private $trad;
    private $user;
    
    public function setAdmin($droit) {
        $this->admin = $droit;
    }
    public function setBatiment($droit) {
        $this->batiment = $droit;
    }
    public function setCategorie($droit) {
        $this->categorie = $droit;
    }
    public function setDashboard($droit) {
        $this->dashboard = $droit;
    }
    public function setEntreprise($droit) {
        $this->entreprise = $droit;
    }
    public function setLieu($droit) {
        $this->lieu = $droit;
    }
    public function setLocataire($droit) {
        $this->locataire = $droit;
    }
    public function setTicket($droit) {
        $this->ticket = $droit;
    }
    public function setTrad($droit) {
        $this->trad = $droit;
    }
    public function setUser($droit) {
        $this->user = $droit;
    }
    
    
    
    public function getAdmin() {
        return $this->admin;
    }
    public function getBatiment() {
        return $this->batiment;
    }
    public function getCategorie() {
        return $this->categorie;
    }
    public function getDashboard() {
        return $this->dashboard;
    }
    public function getEntreprise() {
        return $this->entreprise;
    }
    public function getLieu() {
        return $this->lieu;
    }
    public function getLocataire() {
        return $this->locataire;
    }
    public function getTicket() {
        return $this->ticket;
    }
    public function getTrad() {
        return $this->trad;
    }
    public function getUser() {
        return $this->user;
    }
    
}
