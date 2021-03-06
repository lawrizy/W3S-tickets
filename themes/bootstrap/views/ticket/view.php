<?php
/* @var $this TicketController */
/* @var $model Ticket */


$this->breadcrumbs = array(
    'Tickets' => array('admin'),
    $model->code_ticket,
);


$this->menu = array(
// array('label' => Yii::t('/ticket/view', 'MenuModifierTicket'), 'url' => array('update', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $model->fk_statut != Constantes::STATUT_CLOSED),
    array('label' => Translate::trad('MenuMettreEnTraitementTicket'), 'url' => array('traitement', 'id' => $model->id_ticket),
        'visible' => Yii::app()->session['Rights']->getTicket() & TicketController::ACTION_UPDATE && $model->fk_statut != Constantes::STATUT_CLOSED),
    array('label' => Translate::trad('MenuCloseTicket'), 'url' => array('close', 'id' => $model->id_ticket),
        'visible' => Yii::app()->session['Rights']->getTicket() & TicketController::ACTION_UPDATE && $model->fk_statut == Constantes::STATUT_TREATMENT),
    array('label' => Translate::trad('MenuTicketDelete'), 'url' => '#',
        'linkOptions' => array('submit' => array('delete', 'id' => $model->id_ticket), 'confirm' => 'Are you sure you want to delete this item?'),
        'visible' => Yii::app()->session['Rights']->getTicket() & TicketController::ACTION_DELETE),
        )
?>
<h1><?php echo Translate::trad('ViewTitre') . $model->code_ticket;
?></h1>
<?php
echo '<h4></br><font color="green" >' . Yii::app()->session['EmailSend'] . '</font></h4></b> ';
Yii::app()->session['EmailSend'] = '';
?>
<?php
$batiment = Batiment::model()->findByPk($model->fk_batiment);
$this->widget('bootstrap.widgets.TbDetailView', array(
    'type' => 'striped condensed bordered',
    'data' => $model,
    'attributes' => array(
        array(
            'name' => Translate::trad('StatutTicket'),
            'value' => Translate::trad($model->fkStatut->label)
        ),
        array(
            'name' => Translate::trad('LocataireTicket'),
            'value' => $model->fkLocataire->nom
        ),
        array(
            'name' => Translate::trad('CategTicket'),
            'value' => Translate::trad($model->fkCategorie->fkParent->label)
        ),
        array(
            'name' => Translate::trad('CategorieTicket'),
            'value' => Translate::trad($model->fkCategorie->label)
        ),
        array(
            'name' => Translate::trad('BatimentTicketCirc'),
            'value' => $model->fkBatiment->nom . ' - ' . $model->fkBatiment->adresse),
        array(
            'name' => Translate::trad('UserTicketCirc'),
            'value' => $model->fkUser->nom),
        array(
            'name' => Translate::trad('CanalTicketCirc'),
            'value' => Translate::trad($model->fkCanal->label)
        ),
    ),
));

echo '<br /><br />';
echo '<h1><center><u>' . Translate::trad('ViewHistoriqueTitre') . '</u></center></h1>';
$histo = new HistoriqueTicket();
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'id' => 'ticket-grid',
    'dataProvider' => $histo->searchByTicket($model->id_ticket),
    'columns' => array(
        array(
            'name' => Translate::trad('ViewHistoriqueDate'),
            'value' => '$data->date_update'),
        array(
            'name' => Translate::trad('ViewHistoriqueType'),
            'value' => 'Translate::trad($data->fkStatutTicket->label);'),
    ),
));
?>
