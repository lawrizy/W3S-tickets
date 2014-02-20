<?php
/* @var $this TicketController */
/* @var $model Ticket */


$this->breadcrumbs = array(
    'Tickets' => array('index'),
    $model->id_ticket,
);

if (Yii::app()->session['Utilisateur'] === 'User') {
    $this->menu = array(
        array('label' => 'Modifier le ticket', 'url' => array('update', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $model->fk_statut != 3),
        array('label' => 'Mettre en traitement', 'url' => array('traitement', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $model->fk_statut != 3),
        array('label' => 'Cloturer le ticket', 'url' => array('close', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $model->fk_statut == 2),
    );
}
?>

<h1> Ticket :  <?php echo $model->code_ticket; ?></h1>
<?php
echo '<h4></br><font color="green" >' . Yii::app()->session['EmailSend'] . '</font></h4></b> ';
Yii::app()->session['EmailSend'] = '';
?>
<?php
$batiment = Batiment::model()->findByPk($model->fk_batiment);
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id_ticket',
        array(
            'name' => 'fk_statut',
            'value' => StatutTicket::model()->findByPk($model->fk_statut)->label
        ),
        array(
            'name' => 'Locataire',
            'value' => Locataire::model()->findByPk($model->fk_locataire)->nom
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
            'value' => $batiment->nom . ' - ' . $batiment->adresse),
        array(
            'name' => 'fk_user',
            'value' => User::model()->findByPk($model->fk_user)->nom),
        array(
            'name' => 'fk_canal',
            'value' => Canal::model()->findByPk($model->fk_canal)->label),
    ),
));

echo '<br /><br />';

$histo = new HistoriqueTicket();
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'ticket-grid',
    'dataProvider' => $histo->searchByTicket($model->id_ticket),
    // 'filter' => $model,
    'columns' => array(
        array(
            'name' => 'Date de mise &agrave; jour',
            'value' => '$data->date_update'),
        array(
            'name' => 'Intervention',
            'value' => 'StatutTicket::model()->findByPk($data->fk_statut_ticket)->label'),
    ),
));
?>
