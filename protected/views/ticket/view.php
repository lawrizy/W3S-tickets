<?php
/* @var $this TicketController */
/* @var $model Ticket */

if (Yii::app()->session['Utilisateur'] === 'User') {
    $this->breadcrumbs = array(
        'Tickets' => array('index'),
        $model->id_ticket,
    );

    $this->menu = array(
        array('label' => 'Modifier le ticket', 'url' => array('update', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User'),
        array('label' => 'Mettre en traitement', 'url' => array('traitement', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User'),
        array('label' => 'Cloturer le ticket', 'url' => array('close', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $model->fk_statut == 2),
    );
}
?>

<h1>View Ticket #<?php echo $model->id_ticket; ?></h1>
<?php
echo '<h4></br><font color="green" >' . Yii::app()->session['EmailSend'] . '</font></h4></b> ';
Yii::app()->session['EmailSend'] = '';
?>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id_ticket',
        array(
            'name' => 'fk_statut',
            'value' => StatutTicket::model()->findByPk($model->fk_statut)->label
        ),
        array(
            'name' => 'Categorie',
            'value' => CategorieIncident::model()->findByPk(CategorieIncident::model()->findByPk($model->fk_categorie)->fk_parent)->label
        ),
        array(
            'name' => 'Sous-Categorie',
            'value' => CategorieIncident::model()->findByPk($model->fk_categorie)->label
        ),
        array(
            'name' => 'fk_batiment',
            'value' => Batiment::model()->findByPk($model->fk_batiment)->adresse),
        array(
            'name' => 'fk_user',
            'value' => User::model()->findByPk($model->fk_user)->nom),
        array(
            'name' => 'descriptif',
            'value' => $model->descriptif),
        array(
            'name' => 'fk_canal',
            'value' => Canal::model()->findByPk($model->fk_canal)->label),
        array(
            'name' => 'code_ticket',
            'value' => $model->code_ticket),
    ),
));
?>
