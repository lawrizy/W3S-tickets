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
        $rights->setBatiment(Droit::model()->findByAttributes(
                        array('fk_controleur' => BatimentController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setCategorie(Droit::model()->findByAttributes(
                        array('fk_controleur' => CategorieIncidentController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setDashboard(Droit::model()->findByAttributes(
                        array('fk_controleur' => DashboardController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setEntreprise(Droit::model()->findByAttributes(
                        array('fk_controleur' => EntrepriseController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setLocataire(Droit::model()->findByAttributes(
                        array('fk_controleur' => LocataireController::ID_CONTROLLER, 'fk_user' => $id))->droits);
        $rights->setTicket(Droit::model()->findByAttributes(
                        array('fk_controleur' => TicketController::ID_CONTROLLER, 'fk_user' => $id))->droits);
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
    
    
        
    public static function createRights($id, $fonction) {
        if ($fonction == Constantes::FONCTION_LOCATAIRE) { // Droits si locataire
            $batiment = new Droit();
                $batiment->fk_controleur = BatimentController::ID_CONTROLLER;
                $batiment->fk_user = $id; $batiment->droits = Constantes::NO_RIGHT;
                if (!$batiment->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $categorie = new Droit();
                $categorie->fk_controleur = CategorieIncidentController::ID_CONTROLLER;
                $categorie->fk_user = $id; $categorie->droits = Constantes::NO_RIGHT;
                if (!$categorie->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $dashboard = new Droit();
                $dashboard->fk_controleur = DashboardController::ID_CONTROLLER;
                $dashboard->fk_user = $id; $dashboard->droits = Constantes::NO_RIGHT;
                if (!$dashboard->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $entreprise = new Droit();
                $entreprise->fk_controleur = EntrepriseController::ID_CONTROLLER;
                $entreprise->fk_user = $id; $entreprise->droits = Constantes::NO_RIGHT;
                if (!$entreprise->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $locataire = new Droit();
                $locataire->fk_controleur = LocataireController::ID_CONTROLLER;
                $locataire->fk_user = $id; $locataire->droits = Constantes::NO_RIGHT;
                if (!$locataire->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $ticket = new Droit();
                $ticket->fk_controleur = TicketController::ID_CONTROLLER;
                $ticket->fk_user = $id; $ticket->droits = TicketController::ACTION_CREATE + TicketController::ACTION_VIEW;
                if (!$ticket->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $user = new Droit();
                $user->fk_controleur = UserController::ID_CONTROLLER;
                $user->fk_user = $id; $user->droits = Constantes::NO_RIGHT;
                if (!$user->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            
        } elseif ($fonction == Constantes::FONCTION_USER) { // Droits si simple user
            $batiment = new Droit();
                $batiment->fk_controleur = BatimentController::ID_CONTROLLER; $batiment->fk_user = $id;
                $batiment->droits = Constantes::NO_RIGHT;
                if (!$batiment->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $categorie = new Droit();
                $categorie->fk_controleur = CategorieIncidentController::ID_CONTROLLER; $categorie->fk_user = $id;
                $categorie->droits = Constantes::NO_RIGHT;
                if (!$categorie->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $dashboard = new Droit();
                $dashboard->fk_controleur = DashboardController::ID_CONTROLLER; $dashboard->fk_user = $id;
                $dashboard->droits = Constantes::NO_RIGHT;
                if (!$dashboard->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $entreprise = new Droit();
                $entreprise->fk_controleur = EntrepriseController::ID_CONTROLLER; $entreprise->fk_user = $id;
                $entreprise->droits = Constantes::NO_RIGHT;
                if (!$entreprise->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $locataire = new Droit();
                $locataire->fk_controleur = LocataireController::ID_CONTROLLER; $locataire->fk_user = $id;
                $locataire->droits = LocataireController::ACTION_ADMIN + LocataireController::ACTION_VIEW;
                if (!$locataire->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $ticket = new Droit();
                $ticket->fk_controleur = TicketController::ID_CONTROLLER; $ticket->fk_user = $id;
                $ticket->droits = TicketController::ACTION_CREATE + TicketController::ACTION_VIEW + TicketController::ACTION_ADMIN + TicketController::ACTION_UPDATE;
                if (!$ticket->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $user = new Droit();
                $user->fk_controleur = UserController::ID_CONTROLLER; $user->fk_user = $id;
                $user->droits = Constantes::NO_RIGHT;
                if (!$user->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
                
        } elseif ($fonction == Constantes::FONCTION_ADMIN) { // Droits si Admin
            $batiment = new Droit();
                $batiment->fk_controleur = BatimentController::ID_CONTROLLER; $batiment->fk_user = $id;
                $batiment->droits = Constantes::NO_RIGHT;
                if (!$batiment->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $categorie = new Droit();
                $categorie->fk_controleur = CategorieIncidentController::ID_CONTROLLER; $categorie->fk_user = $id;
                $categorie->droits = Constantes::NO_RIGHT;
                if (!$categorie->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $dashboard = new Droit();
                $dashboard->fk_controleur = DashboardController::ID_CONTROLLER; $dashboard->fk_user = $id;
                $dashboard->droits = DashboardController::ACTION_TOUS;
                if (!$dashboard->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $entreprise = new Droit();
                $entreprise->fk_controleur = EntrepriseController::ID_CONTROLLER; $entreprise->fk_user = $id;
                $entreprise->droits = Constantes::NO_RIGHT;
                if (!$entreprise->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $locataire = new Droit();
                $locataire->fk_controleur = LocataireController::ID_CONTROLLER; $locataire->fk_user = $id;
                $locataire->droits = LocataireController::ACTION_ADMIN + LocataireController::ACTION_VIEW;
                if (!$locataire->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $ticket = new Droit();
                $ticket->fk_controleur = TicketController::ID_CONTROLLER; $ticket->fk_user = $id;
                $ticket->droits = TicketController::ACTION_TOUS;
                if (!$ticket->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $user = new Droit();
                $user->fk_controleur = UserController::ID_CONTROLLER; $user->fk_user = $id;
                $user->droits = Constantes::NO_RIGHT;
                if (!$user->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            
        } elseif ($fonction == Constantes::FONCTION_ROOT) { // Droits si Root
            $batiment = new Droit();
                $batiment->fk_controleur = BatimentController::ID_CONTROLLER; $batiment->fk_user = $id;
                $batiment->droits = BatimentController::ACTION_TOUS;
                if (!$batiment->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $categorie = new Droit();
                $categorie->fk_controleur = CategorieIncidentController::ID_CONTROLLER; $categorie->fk_user = $id;
                $categorie->droits = CategorieIncidentController::ACTION_TOUS;
                if (!$categorie->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $dashboard = new Droit();
                $dashboard->fk_controleur = DashboardController::ID_CONTROLLER; $dashboard->fk_user = $id;
                $dashboard->droits = DashboardController::ACTION_TOUS;
                if (!$dashboard->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $entreprise = new Droit();
                $entreprise->fk_controleur = EntrepriseController::ID_CONTROLLER; $entreprise->fk_user = $id;
                $entreprise->droits = EntrepriseController::ACTION_TOUS;
                if (!$entreprise->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $locataire = new Droit();
                $locataire->fk_controleur = LocataireController::ID_CONTROLLER; $locataire->fk_user = $id;
                $locataire->droits = LocataireController::ACTION_TOUS;
                if (!$locataire->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $ticket = new Droit();
                $ticket->fk_controleur = TicketController::ID_CONTROLLER; $ticket->fk_user = $id;
                $ticket->droits = TicketController::ACTION_TOUS;
                if (!$ticket->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            $user = new Droit();
                $user->fk_controleur = UserController::ID_CONTROLLER; $user->fk_user = $id;
                $user->droits = UserController::ACTION_TOUS;
                if (!$user->save(FALSE)) throw new Exception('Erreur lors de l\'enregistrement en base de données');
            
        } else {
            throw new Exception('Fonction invalide');
        }
    }
}
