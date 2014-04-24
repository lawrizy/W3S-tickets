<?php
    Yii::app()->session['_lang'] = 'en';
    //$client = new SoapClient("http://web3sys.com/tickets/index.php/android/websys");
    //$test = $client->getPieDatas($_GET['idbat'],$_GET['langue']);
    //print_r($test);
    //echo $test;
    
//    $user = User::model()->findByPk(1);
//    
//    echo $user->nom;
//    print_r($user->droits);
//    foreach ($user->droits as $droit) {
//        echo $droit->fk_controleur . '<br />';
//        
//    }
    
    
    
    $model = Batiment::model()->findByPk(1);
    $lieux = $model->lieux;
    foreach($model->lieux as $k => $lieu) {
        print_r($lieu);
        if ($lieu->visible == 1) unset($lieux[$k]);
        //$lieu->save();
        echo '<br /><br />';
    }
    echo '-------------------------------------------------------------------<br />';
    echo '-------------------------------------------------------------------<br />';
    echo '-------------------------------------------------------------------<br />';
    print_r($lieux);
    

    echo '-------------------------------------------------------------------<br />';
    echo '-------------------------------------------------------------------<br />';
    echo '-------------------------------------------------------------------<br />';
    echo '-------------------------------------------------------------------<br />';
    echo '-------------------------------------------------------------------<br />';
    echo '-------------------------------------------------------------------<br />';
    
    $model = Batiment::model()->findByPk(1);
    foreach($model->lieux as $k => $lieu) {
        print_r($lieu);
        echo '<br /><br />';
    }

    
?>