<?php
    Yii::app()->session['_lang'] = 'en';
    $client = new SoapClient("http://192.168.1.20/W3S-tickets/index.php/android/websys?wsdl");
    echo print_r($client->getPieDatas($_GET['idbat']),$_GET['langue']);
?>