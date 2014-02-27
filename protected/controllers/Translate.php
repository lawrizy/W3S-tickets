<?php

class Translate {
    
    public static function trad($txt) {
        $result = Trad::model()->findByPk($txt);
        return $result[Yii::app()->session['Language']];
    }
    
    public static function tradText($txt) {
        $result = TradTexte::model()->findByPk($txt);
        return $result[Yii::app()->session['Language']];
    }
    
}