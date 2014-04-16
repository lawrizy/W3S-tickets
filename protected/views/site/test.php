<?php
    Yii::app()->session['_lang'] = 'en';
    $client = new SoapClient("http://192.168.1.20/W3S-tickets/index.php/android/websys");
    $test = $client->getBarsDatas2($_GET['idbat'],$_GET['langue']);
    print_r($test);
    //echo $test;
?>