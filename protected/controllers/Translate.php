<?php

class Translate {
    
    public static function tradPetit($txt) {      //traduit les phrases de maximum 32 caractères
        $result = TradPetit::model()->findByPk($txt); 
        return $result[Yii::app()->session['_lang']];
    }
    
    public static function tradMoyen($txt) {   //traduit les phrases de maximum 64 caractères
        $result = TradMoyen::model()->findByPk($txt);
        return $result[Yii::app()->session['_lang']];
    }
    
    public static function tradGrand($txt) {  // traduit les phrases de maximum de 128 caractères 
        $result = TradGrand::model()->findByPk($txt);
        return $result[Yii::app()->session['_lang']];
    }
    
}