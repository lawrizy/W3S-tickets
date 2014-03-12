<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyApp
 *
 * @author User
 */
class MyApp {

    public static function beginRequest() {
        try
        {
            Yii::app()->language = Yii::app()->session['_lang'];
        } catch(CDbException $cdbe)
        {
            Yii::app()->user->setFlash('error', 'Connection to dabatase failed, we\'re working on it!');
        }
    }

}
