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
    const ID_PHONE = 1;
    const ID_WEB = 2;
    
    /*
     * Les statuts des tickets étant fixes, on stocke directement la valeur
     * de leur id ici pour pouvoir les tester
     */
    const ID_OPENED = 1;
    const ID_TREATMENT = 2;
    const ID_CLOSED = 3;
    
    /*
     * Les fonctions d'un utilisateur étant fixes, on stocke directement la valeur
     * de leur id ici pour pouvoir tester quelle est la fonction d'un utilisateur
     */
    const ID_USER = 1;
    const ID_ADMIN = 2;
    const ID_ROOT = 3;
    
    /*
     * Les langues étant fixes, on stocke directement la valeur de leur id ici pour pouvoir les tester
     */
    const ID_FR = 1;
    const ID_EN = 2;
    const ID_NL = 3;
    
    /*
     * Les priorités des catégories étant fixes, on stocke directement la valeur
     * de leur id ici pour pouvoir tester les priorités
     */
    const ID_LOW = 1;
    const ID_MEDIUM = 2;
    const ID_HIGH = 3;
    
}