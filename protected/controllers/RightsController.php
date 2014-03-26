<?php


class RightsController {
    
        /*
     * Cette méthode sert à retrouver les droits de l'utilisateur qui se log.
     * Elle est appelée à partir de la méthode 'authenticate' plus haut.
     * Cette méthode reçoit donc en paramètre l'id de la personne pour qui on 
     * recherche les droits et instancie un objet 'Rights'.
     * On stocke dans cet objet tous les droits que ce user a sur tous les 
     * controleurs en faisant la recherche dans la DB des droits selon le user
     * et le controleur.
     * Une fois que c'est fait, on renvoie l'objet 'Rights' que l'on a créé.
     * (pour détails, voir classe 'Rights' elle-même et les méthodes
     * 'accessRules()' dans les controleurs)
     */

    public static function getDroits($id) {
        $rights = new Rights();

        // Ici on recherche les droits pour chaque contrôleur pour l'id du user reçu en paramètre
//        $rights->setAdmin(Droit::model()->findByAttributes(
//                        array('fk_controleur' => AdminController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setBatiment(Droit::model()->findByAttributes(
                        array('fk_controleur' => BatimentController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setCategorie(Droit::model()->findByAttributes(
                        array('fk_controleur' => CategorieIncidentController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setDashboard(Droit::model()->findByAttributes(
                        array('fk_controleur' => DashboardController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setEntreprise(Droit::model()->findByAttributes(
                        array('fk_controleur' => EntrepriseController::ID_CONTROLLER, 'fk_user' => $id))->droits);
//        $rights->setLieu(Droit::model()->findByAttributes(
//                        array('fk_controleur' => LieuController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setLocataire(Droit::model()->findByAttributes(
                        array('fk_controleur' => LocataireController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setTicket(Droit::model()->findByAttributes(
                        array('fk_controleur' => TicketController::ID_CONTROLLER, 'fk_user' => $id))->droits);
//        $rights->setTrad(Droit::model()->findByAttributes(
//                        array('fk_controleur' => TradController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setUser(Droit::model()->findByAttributes(
                        array('fk_controleur' => UserController::ID_CONTROLLER, 'fk_user' => $id))->droits);

        return $rights;
    }
    
    /*
     * $id = $id_user de la personne pour laquelle on doit sauver ces droits
     * $rights = objet de type Rights contenant tous les droits à sauvegarder
     */
    public static function  saveRights($id, $rights) {
        
    }
}
