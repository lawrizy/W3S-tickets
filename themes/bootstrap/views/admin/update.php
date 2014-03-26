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
        <p id="avertissement" style="color: red; font-size: 20px; font-weight: bold;">
          /!\ Attention, certains droits dépendent d'autres droits et seront 
          donc automatiquement cochés/décochés</p>
        <?php
        CHtml::form();
//        echo CHtml::dropDownList('UserList', '', array(CHtml::listData(User::model()->findAllByAttributes
//                (array('visible' => Constantes::VISIBLE, 'fk_fonction' => Constantes::FONCTION_LOCATAIRE)),
//                'id_user', 'nom')), 
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
                        <th>Create</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                        if ($model->fk_fonction != Constantes::FONCTION_LOCATAIRE) {
                    ?>
                    <?php $droit = $rights->getBatiment(); ?>
                    <tr>
                        <td>Batiment</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input class="BatimentView" type="checkbox" name="BatimentView" <?php echo $droit & BatimentController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input class="BatimentCreate" type="checkbox" name="BatimentCreate" <?php echo $droit & BatimentController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input class="BatimentUpdate" type="checkbox" name="BatimentUpdate" <?php echo $droit & BatimentController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input class="BatimentDelete" type="checkbox" name="BatimentDelete" <?php echo $droit & BatimentController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                    </tr>
                    <?php $droit = $rights->getCategorie(); ?>
                    <tr>
                        <td>Category</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input class="CategoryView" type="checkbox" name="CategoryView" <?php echo $droit & CategorieIncidentController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input class="CategoryCreateCat" type="checkbox" name="CategoryCreate" <?php echo $droit & CategorieIncidentController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input class="CategoryUpdateCat" type="checkbox" name="CategoryUpdate" <?php echo $droit & CategorieIncidentController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input class="CategoryDelete" type="checkbox" name="CategoryDelete" <?php echo $droit & CategorieIncidentController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                    </tr>
                    <?php $droit = $rights->getDashboard(); ?>
                    <tr>
                        <td>Dashboard</td>
                        <td><input  class="DashBoardVue" type="checkbox" name="DashBoardVue" <?php echo $droit & DashboardController::ACTION_TOUS ? 'checked' : ''; ?> /></td> <!-- Index -->
                        <td style="background-color: #802420"></td> <!-- View -->
                        <td style="background-color: #802420"></td> <!-- Create -->
                        <td style="background-color: #802420"></td> <!-- Update -->
                        <td style="background-color: #802420"></td> <!-- Delete -->
                    </tr>
                    <?php $droit = $rights->getEntreprise(); ?>
                    <tr>
                        <td>Entreprise</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input  class="EntrepriseView" type="checkbox" name="EntrepriseView" <?php echo $droit & EntrepriseController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input  class="EntrepriseCreate" type="checkbox" name="EntrepriseCreate" <?php echo $droit & EntrepriseController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input  class="EntrepriseUpdate" type="checkbox" name="EntrepriseUpdate" <?php echo $droit & EntrepriseController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input  class="EntrepriseDelete" type="checkbox" name="EntrepriseDelete" <?php echo $droit & EntrepriseController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                    </tr>
                    <?php $droit = $rights->getLocataire(); ?>
                    <tr>
                        <td>Locataire</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input  class="LocataireView" type="checkbox" name="LocataireView" <?php echo $droit & LocataireController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input  class="LocataireCreate" type="checkbox" name="LocataireCreate" <?php echo $droit & LocataireController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input  class="LocataireUpdate" type="checkbox" name="LocataireUpdate" <?php echo $droit & LocataireController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input  class="LocataireDelete" type="checkbox" name="LocataireDelete" <?php echo $droit & LocataireController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                    </tr>
                    <?php $droit = $rights->getTicket(); ?>
                    <tr>
                        <td>Ticket</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input class="TicketView"  type="checkbox" name="TicketView" <?php echo $droit & TicketController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input class="TicketCreate" type="checkbox" name="TicketCreate" <?php echo $droit & TicketController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input class="TicketUpdate" type="checkbox" name="TicketUpdate" <?php echo $droit & TicketController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input class="TicketDelete" type="checkbox" name="TicketDelete" <?php echo $droit & TicketController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                    </tr>
                    <?php $droit = $rights->getUser(); ?>
                    <tr>
                        <td>User</td>
                        <td style="background-color: #802420"></td> <!-- Index -->
                        <td><input class="UserView" type="checkbox" name="UserView" <?php echo $droit & UserController::ACTION_VIEW ? 'checked' : ''; ?> /></td> <!-- View -->
                        <td><input class="UserCreate" type="checkbox" name="UserCreate" <?php echo $droit & UserController::ACTION_CREATE ? 'checked' : ''; ?> /></td> <!-- Create -->
                        <td><input class="UserUpdate" type="checkbox" name="UserUpdate" <?php echo $droit & UserController::ACTION_UPDATE ? 'checked' : ''; ?> /></td> <!-- Update -->
                        <td><input class="UserDelete" type="checkbox" name="UserDelete" <?php echo $droit & UserController::ACTION_DELETE ? 'checked' : ''; ?> /></td> <!-- Delete -->
                    </tr>
                    <?php
                        }
                    ?>
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
<?php if($model->fk_fonction == Constantes::FONCTION_LOCATAIRE){ ?>
<script>
    // TODO
</script>
<?php } else { ?>
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
        if ($(".BatimentDelete").is(':checked')) {
            $(".BatimentAdmin").attr('checked', true);
            $(".BatimentView").attr('checked', true);
    }});
    $(".BatimentCreate").click(function() {
        if ($(".BatimentCreate").is(':checked')) $(".BatimentView").attr('checked', true);
        else if (!$(".BatimentAdmin").is(':checked')) $(".BatimentView").attr('checked', false);
    });
    $(".BatimentUpdate").click(function() {
        if ($(".BatimentUpdate").is(':checked')) {
            $(".BatimentView").attr('checked', true);
            $(".BatimentAdmin").attr('checked', true);
    }});
    $(".BatimentView").click(function() {
        if ($(".BatimentView").is(':checked')) $(".BatimentAdmin").attr('checked', true);
        else $(".BatimentCreate").attr('checked', false);
    });
    $(".BatimentAdmin").click(function() {
        if (!$(".BatimentAdmin").is(':checked')) {
            $(".BatimentUpdate").attr('checked', false);
            $(".BatimentDelete").attr('checked', false);
            if (!$(".BatimentCreate").is(':checked')) $(".BatimentView").attr('checked', false);
        }
        else $(".BatimentView").attr('checked', true);
    });
    // ----------------------------- Fin Batiment ------------------------------
    
    $(".CategoryDelete").click(function() {
        if ($(".CategoryDelete").is(':checked')) {
            $(".CategoryView").attr('checked', true);
            $(".CategoryAdmin").attr('checked', true);
    }});
    $(".CategoryCreate").click(function() {
        if ($(".CategoryCreate").is(':checked')) $(".CategoryView").attr('checked', true);
        else if (!$(".CategoryAdmin").is(':checked')) $(".CategoryView").attr('checked', false);
    });
    $(".CategoryUpdate").click(function() {
        if ($(".CategoryUpdate").is(':checked')) {
            $(".CategoryView").attr('checked', true);
            $(".CategoryAdmin").attr('checked', true);
    }});
    $(".CategoryView").click(function() {
        if ($(".CategoryView").is(':checked')) $(".CategoryAdmin").attr('checked', true);
        else $(".CategoryCreate").attr('checked', false);
    });
    $(".CategoryAdmin").click(function() {
        if (!$(".CategoryAdmin").is(':checked')) {
            $(".CategoryUpdate").attr('checked', false);
            $(".CategoryDelete").attr('checked', false);
            if (!$(".CategoryCreate").is(':checked')) $(".CategoryView").attr('checked', false);
        }
        else $(".CategoryView").attr('checked', true);
    });
    // ----------------------------- Fin Category ------------------------------
    
    $(".EntrepriseDelete").click(function() {
        if ($(".EntrepriseDelete").is(':checked')) {
            $(".EntrepriseView").attr('checked', true);
            $(".EntrepriseAdmin").attr('checked', true);
    }});
    $(".EntrepriseCreate").click(function() {
        if ($(".EntrepriseCreate").is(':checked')) $(".EntrepriseView").attr('checked', true);
        else if (!$(".EntrepriseAdmin").is(':checked')) $(".EntrepriseView").attr('checked', false);
    });
    $(".EntrepriseUpdate").click(function() {
        if ($(".EntrepriseUpdate").is(':checked')) {
            $(".EntrepriseView").attr('checked', true);
            $(".EntrepriseAdmin").attr('checked', true);
    }});
    $(".EntrepriseView").click(function() {
        if ($(".EntrepriseView").is(':checked')) $(".EntrepriseAdmin").attr('checked', true);
        else $(".EntrepriseCreate").attr('checked', false);
    });
    $(".EntrepriseAdmin").click(function() {
        if (!$(".EntrepriseAdmin").is(':checked')) {
            $(".EntrepriseUpdate").attr('checked', false);
            $(".EntrepriseDelete").attr('checked', false);
            if (!$(".EntrepriseCreate").is(':checked')) $(".EntrepriseView").attr('checked', false);
        }
        else $(".EntrepriseView").attr('checked', true);
    });
    // ---------------------------- Fin Entreprise -----------------------------
    
    $(".LocataireDelete").click(function() {
        if ($(".LocataireDelete").is(':checked')) {
            $(".LocataireView").attr('checked', true);
            $(".LocataireAdmin").attr('checked', true);
    }});
    $(".LocataireCreate").click(function() {
        if ($(".LocataireCreate").is(':checked')) $(".LocataireView").attr('checked', true);
        else if (!$(".LocataireAdmin").is(':checked')) $(".LocataireView").attr('checked', false);
    });
    $(".LocataireUpdate").click(function() {
        if ($(".LocataireUpdate").is(':checked')) {
            $(".LocataireView").attr('checked', true);
            $(".LocataireAdmin").attr('checked', true);
    }});
    $(".LocataireView").click(function() {
        if ($(".LocataireView").is(':checked')) $(".LocataireAdmin").attr('checked', true);
        else $(".LocataireCreate").attr('checked', false);
    });
    $(".LocataireAdmin").click(function() {
        if (!$(".LocataireAdmin").is(':checked')) {
            $(".LocataireUpdate").attr('checked', false);
            $(".LocataireDelete").attr('checked', false);
            if (!$(".LocataireCreate").is(':checked')) $(".LocataireView").attr('checked', false);
        }
        else $(".LocataireView").attr('checked', true);
    });
    // ---------------------------- Fin Locataire ------------------------------
    
    $(".TicketDelete").click(function() {
        if ($(".TicketDelete").is(':checked')) {
            $(".TicketView").attr('checked', true);
            $(".TicketAdmin").attr('checked', true);
    }});
    $(".TicketCreate").click(function() {
        if ($(".TicketCreate").is(':checked')) $(".TicketView").attr('checked', true);
        else if (!$(".TicketAdmin").is(':checked')) $(".TicketView").attr('checked', false);
    });
    $(".TicketUpdate").click(function() {
        if ($(".TicketUpdate").is(':checked')) {
            $(".TicketView").attr('checked', true);
            $(".TicketAdmin").attr('checked', true);
    }});
    $(".TicketView").click(function() {
        if ($(".TicketView").is(':checked')) $(".TicketAdmin").attr('checked', true);
        else $(".TicketCreate").attr('checked', false);
    });
    $(".TicketAdmin").click(function() {
        if (!$(".TicketAdmin").is(':checked')) {
            $(".TicketUpdate").attr('checked', false);
            $(".TicketDelete").attr('checked', false);
            if (!$(".TicketCreate").is(':checked')) $(".TicketView").attr('checked', false);
        }
        else $(".TicketView").attr('checked', true);
    });
    // ------------------------------ Fin Ticket -------------------------------
    
    $(".UserDelete").click(function() {
        if ($(".UserDelete").is(':checked')) {
            $(".UserView").attr('checked', true);
            $(".UserAdmin").attr('checked', true);
    }});
    $(".UserCreate").click(function() {
        if ($(".UserCreate").is(':checked')) $(".UserView").attr('checked', true);
        else if (!$(".UserAdmin").is(':checked')) $(".UserView").attr('checked', false);
    });
    $(".UserUpdate").click(function() {
        if ($(".UserUpdate").is(':checked')) {
            $(".UserView").attr('checked', true);
            $(".UserAdmin").attr('checked', true);
    }});
    $(".UserView").click(function() {
        if ($(".UserView").is(':checked')) $(".UserAdmin").attr('checked', true);
        else $(".UserCreate").attr('checked', false);
    });
    $(".UserAdmin").click(function() {
        if (!$(".UserAdmin").is(':checked')) {
            $(".UserUpdate").attr('checked', false);
            $(".UserDelete").attr('checked', false);
            if (!$(".UserCreate").is(':checked')) $(".UserView").attr('checked', false);
        }
        else $(".UserView").attr('checked', true);
    });
    // ------------------------------- Fin User --------------------------------
</script>
<?php } ?>