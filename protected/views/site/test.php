<?php
    Yii::app()->session['_lang'] = 'en';
    $client = new SoapClient("http://web3sys.com/tickets/index.php/android/websys");
    $test = $client->getPieDatas($_GET['idbat'],$_GET['langue']);
    print_r($test);
    //echo $test;
?>