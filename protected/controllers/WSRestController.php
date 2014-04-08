<?php

class WSRestController extends Controller {
    
    const PAS_DE_GET = -1;
    const USERWORD_INCORRECT = -2;

    public function actionCreate() {
        $a = CJSON::encode(self::PAS_DE_GET);
        if (isset($_GET['email'])) {
            $a = CJSON::encode(self::USERWORD_INCORRECT);
            $cats = CategorieIncident::model()->findAllByAttributes(array(
                'visible' => Constantes::VISIBLE
            ));
            
            if ($cats != NULL){
                $retour = array();
                foreach ($cats as $cat) {
                    $c = new CategorieIncident();
                    $c->id_categorie_incident = $cat->id_categorie_incident;
                    $c->label = $cat->label;
                    $c->fk_parent = $cat->fk_parent;
                    $c->visible = $cat->visible;
                    array_push($retour, $c);
                }
                $a = CJSON::encode($retour);
            }
                
        }
        
        
//        $cats = CategorieIncident::model()->findAllByAttributes(
//                array('visible' => Constantes::VISIBLE, 'fk_parent' => NULL));
//
//        $retour = array();
//        foreach ($cats as $cat) {
//            $c = array(
//                'id' => (string) $cat->id_categorie_incident,
//                'label' => (string) $cat->label);
//            array_push($retour, $c);
//        }
//        echo CJSON::encode($retour);
//        echo CJSON::encode($cats = CategorieIncident::model()->findByAttributes(array(
//                'visible' => Constantes::VISIBLE
//            )));
        
        $b = CJSON::encode(new Cat(1, 'test'));
        
        echo CJSON::decode($b);
        
    }

}