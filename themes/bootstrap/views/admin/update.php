<html>
    <head>
        <meta charset="UTF-8">
        <title>Attribution de droits à <?php echo $model->nom; ?></title>
    </head>
    <body>
        <div>
            <?php

            $this->breadcrumbs = array(
                'admin' => '../admin',
                Translate::trad("admin"),
            );
            
            /*
             * $model => Le user dont les droits seront ré-organisés ici
             * $rights => Les droits du user en question
             */
            CHtml::form();
            echo CHtml::dropDownList('UserList', '', array(CHtml::listData($this->getUserForRights(), 'id_user', 'nom')), array(// Cette array définit le chargement dynamique des valeurs dans la dropDownList des sous-catégories. (Voir dropDownList suivante appelée DD_sousCat)
                'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('admin/update?id=idPost'),
                    'data' => array('idPost' => 'js:this.value'),
                    'update' => ".DI"
                ))
            );
            CHtml::endForm();
            ?>
            <img class="loadingSous" src="../../assets/7d883f12/img/loading.gif">
        </div>
        <div class="DI">
            <?php $this->renderPartial('_ajaxUpdate', array('model' => $model)); ?>
        </div>
    </body>
</html>
