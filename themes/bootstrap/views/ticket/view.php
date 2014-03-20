<?php
/* @var $this TicketController */
/* @var $model Ticket */


$this->breadcrumbs = array(
    'Tickets' => array('admin'),
    $model->code_ticket,
);

if (Yii::app()->session['Utilisateur'] === 'User') {
    $this->menu = array(
        // array('label' => Yii::t('/ticket/view', 'MenuModifierTicket'), 'url' => array('update', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $model->fk_statut != Constantes::STATUT_CLOSED),
        array('label' => Translate::trad('MenuMettreEnTraitementTicket'), 'url' => array('traitement', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $model->fk_statut != Constantes::STATUT_CLOSED),
        array('label' => Translate::trad('MenuCloseTicket'), 'url' => array('close', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $model->fk_statut == Constantes::STATUT_TREATMENT),
        // TODO
        array('label' => Translate::trad('MenuTicketDelete'), 'url' => array('delete', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && Yii::app()->session['Logged']->fk_fonction == Constantes::FONCTION_ADMIN)
    );
}
?>

<h1><?php echo Translate::trad('ViewTitre') . $model->code_ticket; ?></h1>
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
            'name' => 'fk_statut',
            'value' => Translate::trad(StatutTicket::model()->findByPk($model->fk_statut)->label)
        ),
        array(
            'name' => 'fk_locataire',
            'value' => Locataire::model()->findByPk($model->fk_locataire)->nom
        ),
        array(
            'name' => Translate::trad('CategTicket'),
            'value' => Translate::trad(CategorieIncident::model()->findByPk(CategorieIncident::model()->findByPk($model->fk_categorie)->fk_parent)->label)
        ),
        array(
            'name' => Translate::trad('CategorieTicket'),
            'value' => Translate::trad(CategorieIncident::model()->findByPk($model->fk_categorie)->label)
        ),
        array(
            'name' => 'fk_batiment',
            'value' => $batiment->nom . ' - ' . $batiment->adresse),
        array(
            'name' => 'fk_user',
            'value' => User::model()->findByPk($model->fk_user)->nom),
        array(
            'name' => 'fk_canal',
            'value' => Translate::trad(Canal::model()->findByPk($model->fk_canal)->label)
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
            'value' => 'Translate::trad( StatutTicket::model()->findByPk($data->fk_statut_ticket)->label);'),
    ),
));
?>
