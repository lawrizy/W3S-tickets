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
        array('label' => Translate::tradPetit('MenuMettreEnTraitementTicket'), 'url' => array('traitement', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $model->fk_statut != 3),
        array('label' => Translate::tradPetit('MenuCloseTicket'), 'url' => array('close', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && $model->fk_statut == 2),
        
        // TODO
        array('label' => Translate::tradPetit('MenuTicketDelete'), 'url' => array('delete', 'id' => $model->id_ticket), 'visible' => Yii::app()->session['Utilisateur'] == 'User' && Yii::app()->session['Logged']->fk_fonction == 2)
    );
}
?>

<h1><?php echo Translate::tradPetit('ViewTitre') . $model->code_ticket; ?></h1>
<?php
echo '<h4></br><font color="green" >' . Yii::app()->session['EmailSend'] . '</font></h4></b> ';
Yii::app()->session['EmailSend'] = '';
?>
<?php
$batiment = Batiment::model()->findByPk($model->fk_batiment);
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'fk_statut',
            'value' => Translate::tradPetit( StatutTicket::model()->findByPk($model->fk_statut)->label)
        ),
        array(
            'name' => 'fk_locataire',
            'value' => Locataire::model()->findByPk($model->fk_locataire)->nom
        ),
        array(
            'name' => Translate::tradPetit( 'CategTicket'),
            'value' => Translate::tradMoyen(CategorieIncident::model()->findByPk(CategorieIncident::model()->findByPk($model->fk_categorie)->fk_parent)->label)
        ),
        array(
            'name' => Translate::tradPetit( 'CategorieTicket'),
            'value' => Translate::tradMoyen( CategorieIncident::model()->findByPk($model->fk_categorie)->label)
        ),
        array(
            'name' => 'fk_batiment',
            'value' => $batiment->nom . ' - ' . $batiment->adresse),
        array(
            'name' => 'fk_user',
            'value' => User::model()->findByPk($model->fk_user)->nom),
        array(
            'name' => 'fk_canal',
            'value' => Translate::tradPetit( Canal::model()->findByPk($model->fk_canal)->label)
        ),
    ),
));

echo '<br /><br />';
echo '<h1><center><u>' . Yii::t('/ticket/view', 'ViewHistoriqueTitre') . '</u></center></h1>';
$histo = new HistoriqueTicket();
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'ticket-grid',
    'dataProvider' => $histo->searchByTicket($model->id_ticket),
    'columns' => array(
        array(
            'name' => Translate::tradPetit('ViewHistoriqueDate'),
            'value' => '$data->date_update'),
        array(
            'name' => Translate::tradPetit( 'ViewHistoriqueType'),
            'value' => 'Translate::tradPetit( StatutTicket::model()->findByPk($data->fk_statut_ticket)->label);'),
    ),
));
?>