<?php

class Constantes {
    /*
     * @Les différents champs visibles de toutes les tables sont des booléens
     */

    const INVISIBLE = 0;
    const VISIBLE = 1;

    /*
     * @Les canaux étant fixes, on stocke directement la valeur de leur id ici pour pouvoir les tester
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
    const NB_STATUT = 3;

    /*
     * Les fonctions d'un utilisateur étant fixes, on stocke directement la valeur
     * de leur id ici pour pouvoir tester quelle est la fonction d'un utilisateur
     */
    const FONCTION_USER = 1;
    const FONCTION_ADMIN = 2;
    const FONCTION_ROOT = 3;
    const FONCTION_LOCATAIRE = 4;

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
     * 11 minutes mais l'utilisateur est redirigé vers logout à la 10 ème minutes 
     * pour laisser le temps à l'AJAX de redirigé vers la bonne page afin de vider 
     * correctement la session (récuperer la langue et mettre le is_logged à false
     */
    const TIMEOUT_SESSION = 660;

    /*
     * L'entreprise par défaut à attribuer si aucune entreprise n'est lié à une certaine catégorie
     */
    const ENTREPRISE_DEFAUT = 1;

    /*
     * L'utilisateur par défaut à assigner lors de la création de ticket
     */
    const USER_DEFAUT = 1;

    /*
     * IsAjax permet de savoir si un utilisateur à été déconnecté parce que la 
     * durée de la session à expiré ou si il s'est déconnecté seul 
     * dans le cas ou c'est l'utilisateur qui s'est déconnecté aucun message n'apparait 
     * dans le cas contraire un message le lui indique 
     */
    const ISAJAX_TRUE = 1;
    const ISAJAX_FALSE = 0;

    /*
     * Code-erreur de la DB concernant par exemple l'unicité d'un champ, ...
     */
    const DB_ERROR_UNIQUE = 23000;
    
    /*
     * Constantes générales
     */
    const NO_RIGHT = 0;

}
