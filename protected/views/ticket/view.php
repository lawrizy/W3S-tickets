<?php
/* @var $this TicketController */
/* @var $model Ticket */


//$this->breadcrumbs = array(
//    'Tickets' => array('index'),
//    $model->id_ticket,
//);

if (Yii::app()->session['Utilisateur'] === 'User') {
    $this->menu = array(
       // array('label' => Yii::t('/ticket/view', 'MenuModifierTicket'), 'url' => array('update', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $model->fk_statut != 3),
        array('label' => Yii::t('/ticket/view', 'MenuMettreEnTraitementTicket'), 'url' => array('traitement', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $model->fk_statut != 3),
        array('label' => Yii::t('/ticket/view', 'MenuCloseTicket'), 'url' => array('close', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $model->fk_statut == 2),
    );
}
?>

<h1><?php echo Yii::t('/ticket/view', 'ViewTitre') . $model->code_ticket; ?></h1>
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
            'value' => Yii::t('/model/statutTicket', StatutTicket::model()->findByPk($model->fk_statut)->label)
        ),
        array(
            'name' => 'fk_locataire',
            'value' => Locataire::model()->findByPk($model->fk_locataire)->nom
        ),
        array(
            'name' => Yii::t('/model/ticket', 'CategTicket'),
            'value' => Yii::t('/model/categorieIncident', CategorieIncident::model()->findByPk(CategorieIncident::model()->findByPk($model->fk_categorie)->fk_parent)->label)
        ),
        array(
            'name' => Yii::t('/model/ticket', 'CategorieTicket'),
            'value' => Yii::t('/model/categorieIncident', CategorieIncident::model()->findByPk($model->fk_categorie)->label)
        ),
        array(
            'name' => 'fk_batiment',
            'value' => $batiment->nom . ' - ' . $batiment->adresse),
        array(
            'name' => 'fk_user',
            'value' => User::model()->findByPk($model->fk_user)->nom),
        array(
            'name' => 'fk_canal',
            'value' => Yii::t('/model/canal', Canal::model()->findByPk($model->fk_canal)->label)
        ),
    ),
));

echo '<br /><br />';
echo '<h1><center><u>' . Yii::t('/ticket/view', 'ViewHistoriqueTitre') . '</u></center></h1>';
$histo = new HistoriqueTicket();
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'ticket-grid',
    'dataProvider' => $histo->searchByTicket($model->id_ticket),
    // 'filter' => $model,
    'columns' => array(
        array(
            'name' => Yii::t('/ticket/view', 'ViewHistoriqueDate'),
            'value' => '$data->date_update'),
        array(
            'name' => Yii::t('/ticket/view', 'ViewHistoriqueType'),
            'value' => 'Yii::t(\'/model/statutTicket\', StatutTicket::model()->findByPk($data->fk_statut_ticket)->label);'),
    ),
));
?>