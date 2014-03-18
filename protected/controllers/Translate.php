<?php

class Translate {

    // Translate est la classe permettant de rechercher une traduction dans la base de données.
    // Toutes les traductions sont dans une même table de la base de données, la table trad.
    // Son modèle 'Trad' est présent dans le dossier modèle et permet de rechercher un élément dans la DB
    // Le fonctionnement de la méthode est très simple, recherche dans la DB de l'enregistrement
    // et on renvoie la traduction selon la langue courante de l'application (la méthode renvoie donc un string)

    public static function trad($txt) {    // Traduit les phrases de maximum 128 caractères
        try {
            $result = Trad::model()->findByAttributes(array('code' => $txt));
            // On recherche les traductions correspondant à un certain code
            return $result[Yii::app()->session['_lang']];
            // Une fois qu'on a récupéré les traductions, on renvoie celle qui correspond à la langue courante de l'application
        } catch (CDbException $cdbe) {
            Yii::app()->user->setFlash('error', 'Connection to the database could not be established, please come back later.');
            return $txt; // Retourne le texte du code pour au moins avoir un feedback
        }
    }

}

?>