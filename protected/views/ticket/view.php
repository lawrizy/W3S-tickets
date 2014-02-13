<?php
/* @var $this TicketController */
/* @var $model Ticket */

if(Yii::app()->session['Utilisateur'] === 'User')
{
    $this->breadcrumbs = array(
        'Tickets' => array('index'),
        $model->id_ticket,
    );

    $this->menu = array(
        array('label' => 'Update Ticket', 'url' => array('update', 'id' => $model->id_ticket),'visible'=>  Yii::app()->session['Utilisateur']=='User'),
    );
}
?>

<h1>View Ticket #<?php echo $model->id_ticket; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id_ticket',
        'fk_statut',
        'fk_categorie',
        'fk_lieu',
        'fk_user',
        'version',
        'commentaire',
        'fk_canal',
    ),
));
?>
