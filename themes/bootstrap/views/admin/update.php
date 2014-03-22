<html>
    <head>
        <meta charset="UTF-8">
        <title>Attribution de droits à <?php echo $model->nom; ?></title>
    </head>
    <body>
        <?php
        /*
         * $model => Le user dont les droits seront ré-organisés ici
         * $rights => 
         */
        ?>
        <h1>Attribution de droits à <?php echo $model->nom . ' [' . $model->fkFonction->label . ']'; ?></h1>
        <br /><br />
        <form action="update" method="post">
            <div class="form">
                <?php
                $rights = new Rights();

                $rights->setAdmin(Droit::model()->findByAttributes(
                                array('fk_controleur' => AdminController::ID_CONTROLLER, 'fk_user' => $model->id_user))->droits);
                $rights->setBatiment(Droit::model()->findByAttributes(
                                array('fk_controleur' => BatimentController::ID_CONTROLLER, 'fk_user' => $model->id_user))->droits);
                $rights->setCategorie(Droit::model()->findByAttributes(
                                array('fk_controleur' => CategorieIncidentController::ID_CONTROLLER, 'fk_user' => $model->id_user))->droits);
                $rights->setDashboard(Droit::model()->findByAttributes(
                                array('fk_controleur' => DashboardController::ID_CONTROLLER, 'fk_user' => $model->id_user))->droits);
                $rights->setEntreprise(Droit::model()->findByAttributes(
                                array('fk_controleur' => EntrepriseController::ID_CONTROLLER, 'fk_user' => $model->id_user))->droits);
                $rights->setLieu(Droit::model()->findByAttributes(
                                array('fk_controleur' => LieuController::ID_CONTROLLER, 'fk_user' => $model->id_user))->droits);
                $rights->setLocataire(Droit::model()->findByAttributes(
                                array('fk_controleur' => LocataireController::ID_CONTROLLER, 'fk_user' => $model->id_user))->droits);
                $rights->setTicket(Droit::model()->findByAttributes(
                                array('fk_controleur' => TicketController::ID_CONTROLLER, 'fk_user' => $model->id_user))->droits);
                $rights->setTrad(Droit::model()->findByAttributes(
                                array('fk_controleur' => TradController::ID_CONTROLLER, 'fk_user' => $model->id_user))->droits);
                $rights->setUser(Droit::model()->findByAttributes(
                                array('fk_controleur' => UserController::ID_CONTROLLER, 'fk_user' => $model->id_user))->droits);
                ?>
                <table class="table table-bordered table-responsive" style="text-align: center;">
                    <tr>
                        <th style="background-color: black;"></th>
                        <th>Index</th>
                        <th>View</th>
                        <th>Admin</th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>Delete</th>
                        <th>Traitement</th>
                        <th>AddCategory</th>
                    </tr>
                    <?php $droit = $rights->getAdmin(); ?>
                    <tr>
                        <td>Admin</td>
                        <td><input type="checkbox" name="Admin[index]" <?php echo $droit & AdminController::ACTION_INDEX ? 'checked' : ''; ?> /></td> <!-- Index -->
                        <td style="background-color: #802420"></td> <!-- View -->
                        <td style="background-color: #802420"></td> <!-- Admin -->
                        <td style="background-color: #802420"></td> <!-- Create -->
                        <td><input type="checkbox" name="Admin[update]" <?php echo $droit & AdminController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td style="background-color: #802420"></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                        <td style="background-color: #802420"></td> <!-- AddCategory -->
                    </tr>
                    <?php $droit = $rights->getBatiment(); ?>
                    <tr>
                        <td>Batiment</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input type="checkbox" name="Batiment[view]" <?php echo $droit & BatimentController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input type="checkbox" name="Batiment[admin]" <?php echo $droit & BatimentController::ACTION_ADMIN ? 'checked' : ''; ?> /></td> <!-- Admin -->
                        <td><input type="checkbox" name="Batiment[create]" <?php echo $droit & BatimentController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input type="checkbox" name="Batiment[update]" <?php echo $droit & BatimentController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input type="checkbox" name="Batiment[delete]" <?php echo $droit & BatimentController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                        <td style="background-color: #802420"></td> <!-- AddCategory -->
                    </tr>
                    <?php $droit = $rights->getCategorie(); ?>
                    <tr>
                        <td>Category</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input type="checkbox" name="Category[view]" <?php echo $droit & CategorieIncidentController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input type="checkbox" name="Category[admin]" <?php echo $droit & CategorieIncidentController::ACTION_ADMIN ? 'checked' : ''; ?> /></td> <!-- Admin -->
                        <td><input type="checkbox" name="Category[create]" <?php echo $droit & CategorieIncidentController::ACTION_CREATECAT ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input type="checkbox" name="Category[update]" <?php echo $droit & CategorieIncidentController::ACTION_UPDATECAT ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input type="checkbox" name="Category[delete]" <?php echo $droit & CategorieIncidentController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                        <td style="background-color: #802420"></td> <!-- AddCategory -->
                    </tr>
                    <?php $droit = $rights->getDashboard(); ?>
                    <tr>
                        <td>Dashboard</td>
                        <td><input type="checkbox" name="DashBoard[vue]" <?php echo $droit & DashboardController::ACTION_VUE ? 'checked' : ''; ?> /></td> <!-- Index -->
                        <td style="background-color: #802420"></td> <!-- View -->
                        <td style="background-color: #802420"></td> <!-- Admin -->
                        <td style="background-color: #802420"></td> <!-- Create -->
                        <td style="background-color: #802420"></td> <!-- Update -->
                        <td style="background-color: #802420"></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                        <td style="background-color: #802420"></td> <!-- AddCategory -->
                    </tr>
                    <?php $droit = $rights->getEntreprise(); ?>
                    <tr>
                        <td>Entreprise</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input type="checkbox" name="Entreprise[view]" <?php echo $droit & EntrepriseController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input type="checkbox" name="Entreprise[admin]" <?php echo $droit & EntrepriseController::ACTION_ADMIN ? 'checked' : ''; ?> /></td> <!-- Admin -->
                        <td><input type="checkbox" name="Entreprise[create]" <?php echo $droit & EntrepriseController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input type="checkbox" name="Entreprise[update]" <?php echo $droit & EntrepriseController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input type="checkbox" name="Entreprise[delete]" <?php echo $droit & EntrepriseController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                        <td><input type="checkbox" name="Entreprise[secteur]" <?php echo $droit & EntrepriseController::ACTION_SECTEUR ? 'checked' : ''; ?> /></td> <!-- AddCategory -->
                    </tr>
                    <?php $droit = $rights->getLieu(); ?>
                    <tr>
                        <td>Lieu</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input type="checkbox" name="Lieu[view]" <?php echo $droit & LieuController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td style="background-color: #802420"></td> <!-- Admin -->
                        <td style="background-color: #802420"></td> <!-- Create -->
                        <td style="background-color: #802420"></td> <!-- Update -->
                        <td style="background-color: #802420"></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                        <td style="background-color: #802420"></td> <!-- AddCategory -->
                    </tr>
                    <?php $droit = $rights->getLocataire(); ?>
                    <tr>
                        <td>Locataire</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input type="checkbox" name="Locataire[view]" <?php echo $droit & LocataireController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input type="checkbox" name="Locataire[admin]" <?php echo $droit & LocataireController::ACTION_ADMIN ? 'checked' : ''; ?> /></td> <!-- Admin -->
                        <td><input type="checkbox" name="Locataire[create]" <?php echo $droit & LocataireController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input type="checkbox" name="Locataire[update]" <?php echo $droit & LocataireController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input type="checkbox" name="Locataire[delete]" <?php echo $droit & LocataireController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                        <td style="background-color: #802420"></td> <!-- AddCategory -->
                    </tr>
                    <?php $droit = $rights->getTicket(); ?>
                    <tr>
                        <td>Ticket</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input type="checkbox" name="Ticket[view]" <?php echo $droit & TicketController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input type="checkbox" name="Ticket[admin]" <?php echo $droit & TicketController::ACTION_ADMIN ? 'checked' : ''; ?> /></td> <!-- Admin -->
                        <td><input type="checkbox" name="Ticket[create]" <?php echo $droit & TicketController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input type="checkbox" name="Ticket[update]" <?php echo $droit & TicketController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input type="checkbox" name="Ticket[delete]" <?php echo $droit & TicketController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                        <td><input type="checkbox" name="Ticket[traitement]" <?php echo $droit & TicketController::ACTION_TRAITEMENT ? 'checked' : ''; ?> /></td> <!-- Traitement -->
                        <td style="background-color: #802420"></td> <!-- AddCategory -->
                    </tr>
                    <?php $droit = $rights->getTrad(); ?>
                    <tr>
                        <td>Trad</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input type="checkbox" name="Trad[index]" <?php echo $droit & TradController::ACTION_INDEX ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td style="background-color: #802420"></td> <!-- Admin -->
                        <td style="background-color: #802420"></td> <!-- Create -->
                        <td style="background-color: #802420"></td> <!-- Update -->
                        <td style="background-color: #802420"></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                        <td style="background-color: #802420"></td> <!-- AddCategory -->
                    </tr>
                    <?php $droit = $rights->getUser(); ?>
                    <tr>
                        <td>User</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input type="checkbox" name="User[view]" <?php echo $droit & UserController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input type="checkbox" name="User[admin]" <?php echo $droit & UserController::ACTION_ADMIN ? 'checked' : ''; ?> /></td> <!-- Admin -->
                        <td><input type="checkbox" name="User[create]" <?php echo $droit & UserController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input type="checkbox" name="User[update]" <?php echo $droit & UserController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input type="checkbox" name="User[delete]" <?php echo $droit & UserController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                        <td style="background-color: #802420"></td> <!-- AddCategory -->
                    </tr>
                </table>
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'Save',
                    'type' => 'primary',
                    'buttonType' => 'submit', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => 'large', // null, 'large', 'small' or 'mini'
                ));
                ?>
            </div>
        </form>
        <?php
        ?>
    </body>
</html>
