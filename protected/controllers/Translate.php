<?php

class Translate {

    // Translate est la classe permettant de rechercher une traduction dans la base de données.
    // Nous avons séparé les traductions dans la DB en 3 tables (petit, moyen et grand).
    // Nous l'avons séparé en 3 tables pour éviter d'alourdir la DB pour rien.
    // Il y a une bonne partie des traductions qui sont très petites (exemple avec les menus en haut de page),
    // d'autres de tailles moyennes (des phrases comme "Veuillez selectionner ceci pour cela")
    // et enfin de très gros textes (comme la page de bienvenue).
    // Pour rappel, même en mettant une chaîne de 1 caractère dans un varchar(10),
    // MySQL resèrve quand même 10 caractères pour ce champ. Comme il y a de très gros textes,
    // tout mettre en une table aurait été beaucoup trop lourd (stocker une chaîne de 10 caractères
    // dans un varchar(128) par exemple aurait alourdi inutilement la DB
    // Les trois fonctions fonctionnent de la même manière, recherche dans la DB de l'enregistrement
    // et on renvoie la traduction selon la langue courante de l'application

    public static function trad($txt) {    // Traduit les phrases de maximum 128 caractères 
        $result = Trad::model()->findByPk($txt);
        return $result[Yii::app()->session['_lang']];
    }

}
