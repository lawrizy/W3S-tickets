<?php

  //on inclut la librairie necessaire pour mettre en place le webservice
  require_once("lib/nusoap.php"); 
  //on initialise un nouvel objet serveur 
  $server = new soap_server();
  // on configure en donnant un nom et un Namespace 
  $server->configureWSDL('nomDuWebservice','Namespace'); 
  //on spécifie l'emplacement du namespace
  $server->wsdl->schemaTargetNamespace = 'http://emplacementDuNamespace';
  
  
  
  //on enregistre la méthode grâce à register()
  $server->register('ReturnChaine',array('ChaineString'=>'xsd:string'),   
  array('return'=>'xsd:string'),'Namespace');
 
  //nous créons ici la fonction ReturnChaine() qui correspond à la méthode créée
  function ReturnChaine($ChaineString) {
     return new soapval('return','string',$ChaineString);   
  }
 
  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
  $server->service($HTTP_RAW_POST_DATA);

?>