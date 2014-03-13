<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="wide form">


    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <?php
    echo $form->label($model, 'code_ticket');
    echo $form->textField($model, 'code_ticket', array('size' => 10, 'maxlength' => 10));

    echo $form->label($model, 'fk_statut');
    echo $form->dropDownList($model, 'fk_statut', array('' => '', CHtml::listData(StatutTicket::model()->findAll(array('condition' => 'id_statut_ticket', 'order' => 'label DESC')), 'id_statut_ticket', 'label')));
    
    /*
    echo $form->label($model, 'fk_categorie');
    echo $form->dropDownList($model, 'fk_categorie', array('' => '', CHtml::listData(CategorieIncident::model()->findAllByAttributes(array('fk_parent' => NULL)), 'id_categorie_incident', 'label')));
    */
    
    echo $form->label($model, 'fk_batiment');
    echo $form->dropDownList($model, 'fk_batiment', array('' => '', CHtml::listData(Batiment::model()->findAll(), 'id_batiment', 'nom')));
    
    if (Yii::app()->session['Logged']->fk_fonction == Constantes::FONCTION_ADMIN || Yii::app()->session['Logged']->fk_fonction == Constantes::FONCTION_ROOT) {
        echo $form->label($model, 'fk_user');
        echo $form->dropDownList($model, 'fk_user', array('' => '', CHtml::listData(User::model()->findAllByAttributes(array('visible' => Constantes::VISIBLE, 'fk_fonction' => Constantes::FONCTION_USER)), 'id_user', 'nom')));
    }
    
    echo $form->label($model, 'fk_canal');
    echo $form->dropDownList($model, 'fk_canal', array('' => '', CHtml::listData(Canal::model()->findAll(), 'id_canal', 'label')));
    ?>

    <div class = "buttons">
        <?php echo CHtml::submitButton('Search');
        ?>
    </div>

<?php $this->endWidget(); ?>


</div><!-- search-form -->
