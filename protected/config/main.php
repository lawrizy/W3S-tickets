<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('chartjs', dirname(__FILE__) . '/../extensions/yii-chartjs');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Ticket System',
    // preloading 'log' component
    'preload' => array
        (
        'log',
        'chartjs',
        'yiimail',
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.controllers.Translate',
        'ext.yii-mail.YiiMailMessage',
    //'application.extensions.yii-mail.YiiMailMessage',
    ),
    //'theme' => 'classic',
    'theme' => 'bootstrap',
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'generatorPaths' => array(
                'bootstrap.gii',
            ),
            'class' => 'system.gii.GiiModule',
            'password' => 'giipass',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'session' => array(
            'class' => 'CDbHttpSession',
            'timeout' => 5,
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
        ),
        'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
            'transportType' => 'smtp',
            'transportOptions' => array(
                'host' => 'ssl0.ovh.net',
                'encryption' => 'ssl', // use ssl
                //TODO changer l'adresse mail utilisée pour envoyer les mails
                'username' => 'emmanuel@web3sys.com',
                'password' => 'oscuro87',
                'port' => 465, // ssl port for gmail
            ),
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => false,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        /*
          'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ),
          // uncomment the following to use a MySQL database
         */
        'db' => array(
            'connectionString' => 'mysql:host=192.168.1.25;dbname=db_ticketing',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning, trace',
                    'logFile' => 'application.log',
                    'categories' => 'cron',
                ),
//            'routes' => array(
//                'class' => 'CFileLogRoute',
//                'levels' => 'trace, info',
//                'logFile' => 'application.log',
//                'categories' => 'cron',
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
        // Ajout du composant chart JS pour afficher des graphiques, etc..
        'chartjs' => array
            (
            'class' => 'chartjs.components.ChartJs',
        )
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
    'onBeginRequest' => array('MyApp', 'beginRequest'),
);
