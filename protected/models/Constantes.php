<?php

class Constantes {
    
    /*
     * Les différents champs visibles de toutes les tables sont des booléens
     */
    const INVISIBLE = 0;
    const VISIBLE = 1;
    
    /*
     * Les canaux étant fixes, on stocke directement la valeur de leur id ici pour pouvoir les tester
     */
    const CANAL_PHONE = 1;
    const CANAL_WEB = 2;
    
    /*
     * Les statuts des tickets étant fixes, on stocke directement la valeur
     * de leur id ici pour pouvoir les tester
     */
    const STATUT_OPENED = 1;
    const STATUT_TREATMENT = 2;
    const STATUT_CLOSED = 3;
    
    /*
     * Les fonctions d'un utilisateur étant fixes, on stocke directement la valeur
     * de leur id ici pour pouvoir tester quelle est la fonction d'un utilisateur
     */
    const FONCTION_USER = 1;
    const FONCTION_ADMIN = 2;
    const FONCTION_ROOT = 3;
    
    /*
     * Les langues étant fixes, on stocke directement la valeur de leur id ici pour pouvoir les tester
     */
    const LANGUE_FR = 1;
    const LANGUE_EN = 2;
    const LANGUE_NL = 3;
    
    /*
     * Les priorités des catégories étant fixes, on stocke directement la valeur
     * de leur id ici pour pouvoir tester les priorités
     */
    const PRIORITE_LOW = 1;
    const PRIORITE_MEDIUM = 2;
    const PRIORITE_HIGH = 3;
    /*
     * La durée de la session etant fixe on la stocke directement ici
     */
    const TIMEOUT_SESSION=600; 
    
    /*
     * 
     */
    const ENTREPRISE_DEFAUT = 1;
}