<html>
    <head>
        <meta charset="UTF-8">
        <title>Attribution de droits à <?php echo $model->nom; ?></title>
    </head>
    <body class="DI" >
        <?php
        /*
         * $model => Le user dont les droits seront ré-organisés ici
         * $rights => Les droits du user en question
         */
        ?>
        <h1>Attribution de droits à <?php echo $model->nom . ' [' . $model->fkFonction->label . ']'; ?></h1>
        <!-- Ici on affiche le nom ainsi que la fonction du user concerné -->
        <br /><br />

        <?php
        CHtml::form();
        echo CHtml::dropDownList('UserList', '', array(CHtml::listData(User::model()->findAll(), 'id_user', 'nom')), 
            array( // Cette array définit le chargement dynamique des valeurs dans la dropDownList des sous-catégories. (Voir dropDownList suivante appelée DD_sousCat)
                'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('admin/update?id=idPost'),
                    'data' => array('idPost' => 'js:this.value'),
                    'update' => ".DI"
            ))
        );
        CHtml::endForm();
        ?>
        <form action="update?id=<?php echo $model->id_user; ?>" method="post">
            <input type="hidden" name="tmp" /> 

            <!-- Servira de variable dans l'action, pour vérifier que l'on
                 vient bien de la vue. Les autres champs n'étant que des
                 checkbox, on ne peut pas les tester dans l'action 
                 (les checkbox peuvent ne pas être cochés et donc ne pas être envoyés) -->

            <div class="form">
                <?php
                // Ici on récupère tous les droits du user en question
                $rights = RightsController::getDroits($model->id_user);
                ?>
                <table class="table table-bordered table-responsive " style="text-align: center;">
                    <tr> <!-- Les titres de toutes les colonnes -->
                        <th style="background-color: black;"></th>
                        <th>Index</th>
                        <th>View</th>
                        <th>Admin</th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>Delete</th>
                        <th>Traitement</th>
                    </tr>
                    <?php $droit = $rights->getAdmin(); ?>
                    <tr>
                        <td>Admin</td>
                        <td><input Class="AdminIndex" type="checkbox" name="AdminIndex" <?php echo $droit & AdminController::ACTION_INDEX ? 'checked' : ''; ?> /></td> <!-- Index -->
                        <td style="background-color: #802420"></td> <!-- View -->
                        <td style="background-color: #802420"></td> <!-- Admin -->
                        <td style="background-color: #802420"></td> <!-- Create -->
                        <td><input class="AdminUpdate" type="checkbox" name="AdminUpdate" <?php echo $droit & AdminController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td style="background-color: #802420"></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                    </tr>
                    <?php $droit = $rights->getBatiment(); ?>
                    <tr>
                        <td>Batiment</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input class="BatimentView" type="checkbox" name="BatimentView" <?php echo $droit & BatimentController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input class="BatimentAdmin" type="checkbox" name="BatimentAdmin" <?php echo $droit & BatimentController::ACTION_ADMIN ? 'checked' : ''; ?> /></td> <!-- Admin -->
                        <td><input class="BatimentCreate" type="checkbox" name="BatimentCreate" <?php echo $droit & BatimentController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input class="BatimentUpdate" type="checkbox" name="BatimentUpdate" <?php echo $droit & BatimentController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input class="BatimentDelete" type="checkbox" name="BatimentDelete" <?php echo $droit & BatimentController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                    </tr>
                    <?php $droit = $rights->getCategorie(); ?>
                    <tr>
                        <td>Category</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input class="CategoryView" type="checkbox" name="CategoryView" <?php echo $droit & CategorieIncidentController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input class="CategoryAdmin" type="checkbox" name="CategoryAdmin" <?php echo $droit & CategorieIncidentController::ACTION_ADMIN ? 'checked' : ''; ?> /></td> <!-- Admin -->
                        <td><input class="CategoryCreateCat" type="checkbox" name="CategoryCreate" <?php echo $droit & CategorieIncidentController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input class="CategoryUpdateCat" type="checkbox" name="CategoryUpdate" <?php echo $droit & CategorieIncidentController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input class="CategoryDelete" type="checkbox" name="CategoryDelete" <?php echo $droit & CategorieIncidentController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                    </tr>
                    <?php $droit = $rights->getDashboard(); ?>
                    <tr>
                        <td>Dashboard</td>
                        <td><input  class="DashBoardVue" type="checkbox" name="DashBoardVue" <?php echo $droit & DashboardController::ACTION_TOUS ? 'checked' : ''; ?> /></td> <!-- Index -->
                        <td style="background-color: #802420"></td> <!-- View -->
                        <td style="background-color: #802420"></td> <!-- Admin -->
                        <td style="background-color: #802420"></td> <!-- Create -->
                        <td style="background-color: #802420"></td> <!-- Update -->
                        <td style="background-color: #802420"></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                    </tr>
                    <?php $droit = $rights->getEntreprise(); ?>
                    <tr>
                        <td>Entreprise</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input  class="EntrepriseView" type="checkbox" name="EntrepriseView" <?php echo $droit & EntrepriseController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input  class="EntrepriseAdmin" type="checkbox" name="EntrepriseAdmin" <?php echo $droit & EntrepriseController::ACTION_ADMIN ? 'checked' : ''; ?> /></td> <!-- Admin -->
                        <td><input  class="EntrepriseCreate" type="checkbox" name="EntrepriseCreate" <?php echo $droit & EntrepriseController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input  class="EntrepriseUpdate" type="checkbox" name="EntrepriseUpdate" <?php echo $droit & EntrepriseController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input  class="EntrepriseDelete" type="checkbox" name="EntrepriseDelete" <?php echo $droit & EntrepriseController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                    </tr>
                    <?php $droit = $rights->getLieu(); ?>
                    <tr>
                        <td>Lieu</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input  class="LieuView" type="checkbox" name="LieuView" <?php echo $droit & LieuController::ACTION_TOUS ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td style="background-color: #802420"></td> <!-- Admin -->
                        <td style="background-color: #802420"></td> <!-- Create -->
                        <td style="background-color: #802420"></td> <!-- Update -->
                        <td style="background-color: #802420"></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                    </tr>
                    <?php $droit = $rights->getLocataire(); ?>
                    <tr>
                        <td>Locataire</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input  class="LocataireView" type="checkbox" name="LocataireView" <?php echo $droit & LocataireController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input  class="LocataireAdmin" type="checkbox" name="LocataireAdmin" <?php echo $droit & LocataireController::ACTION_ADMIN ? 'checked' : ''; ?> /></td> <!-- Admin -->
                        <td><input  class="LocataireCreate" type="checkbox" name="LocataireCreate" <?php echo $droit & LocataireController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input  class="LocataireUpdate" type="checkbox" name="LocataireUpdate" <?php echo $droit & LocataireController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input  class="LocataireDelete" type="checkbox" name="LocataireDelete" <?php echo $droit & LocataireController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                    </tr>
                    <?php $droit = $rights->getTicket(); ?>
                    <tr>
                        <td>Ticket</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input class="TicketView"  type="checkbox" name="TicketView" <?php echo $droit & TicketController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input class="TicketAdmin" type="checkbox" name="TicketAdmin" <?php echo $droit & TicketController::ACTION_ADMIN ? 'checked' : ''; ?> /></td> <!-- Admin -->
                        <td><input class="TicketCreate" type="checkbox" name="TicketCreate" <?php echo $droit & TicketController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input class="TicketUpdate" type="checkbox" name="TicketUpdate" <?php echo $droit & TicketController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input class="TicketDelete" type="checkbox" name="TicketDelete" <?php echo $droit & TicketController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                    </tr>
                    <?php $droit = $rights->getTrad(); ?>
                    <tr>
                        <td>Trad</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input class="TradIndex" type="checkbox" name="TradIndex" <?php echo $droit & TradController::ACTION_TOUS ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td style="background-color: #802420"></td> <!-- Admin -->
                        <td style="background-color: #802420"></td> <!-- Create -->
                        <td style="background-color: #802420"></td> <!-- Update -->
                        <td style="background-color: #802420"></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
                    </tr>
                    <?php $droit = $rights->getUser(); ?>
                    <tr>
                        <td>User</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input class="UserView" type="checkbox" name="UserView" <?php echo $droit & UserController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input class="UserAdmin" type="checkbox" name="UserAdmin" <?php echo $droit & UserController::ACTION_ADMIN ? 'checked' : ''; ?> /></td> <!-- Admin -->
                        <td><input class="UserCreate" type="checkbox" name="UserCreate" <?php echo $droit & UserController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input class="UserUpdate" type="checkbox" name="UserUpdate" <?php echo $droit & UserController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input class="UserDelete" type="checkbox" name="UserDelete" <?php echo $droit & UserController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                        <td style="background-color: #802420"></td> <!-- Traitement -->
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
        <?php ?>
    </body>
</html>
<script>
    $(".AdminUpdate").click(function() {
        if ($(".AdminUpdate").is(':checked')) {
            $(".AdminIndex").attr('checked', true);
            $(".AdminUpdate").attr('checked', true);
    }});
    $(".AdminIndex").click(function() {
        if (!$(".AdminIndex").is(':checked')) $(".AdminUpdate").attr('checked', false);
    });
    // ------------------------------ Fin Admin --------------------------------
    
    $(".BatimentDelete").click(function() {
        if ($(".BatimentDelete").is(':checked')) $(".BatimentAdmin").attr('checked', true);
    });
    $(".BatimentCreate").click(function() {
        if ($(".BatimentCreate").is(':checked')) $(".BatimentView").attr('checked', true);
    });
    $(".BatimentUpdate").click(function() {
        if ($(".BatimentUpdate").is(':checked')) {
            $(".BatimentView").attr('checked', true);
            $(".BatimentAdmin").attr('checked', true);
    }});
    $(".BatimentView").click(function() {
        if ($(".BatimentView").is(':checked'))  $(".BatimentAdmin").attr('checked', true);
        else {
            $(".BatimentCreate").attr('checked', false);
            $(".BatimentUpdate").attr('checked', false);
    }});
    $(".BatimentAdmin").click(function() {
        if (!$(".BatimentAdmin").is(':checked')) {
            $(".BatimentView").attr('checked', false);
            $(".BatimentUpdate").attr('checked', false);
            $(".BatimentCreate").attr('checked', false);
            $(".BatimentDelete").attr('checked', false);

    }});
    // ----------------------------- Fin Batiment ------------------------------
    

</script>