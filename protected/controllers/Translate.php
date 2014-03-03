<?php

class Translate {
    
    public static function tradPetit($txt) {
        $result = TradPetit::model()->findByPk($txt);
        return $result[Yii::app()->session['_lang']];
    }
    
    public static function tradMoyen($txt) {
        $result = TradMoyen::model()->findByPk($txt);
        return $result[Yii::app()->session['_lang']];
    }
    
    public static function tradGrand($txt) {
        $result = TradGrand::model()->findByPk($txt);
        return $result[Yii::app()->session['_lang']];
    }
    
}