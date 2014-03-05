<?php
$this->pageTitle = Yii::app()->name . ' - Admin';
?>

<h1><?php echo Translate::trad('GestionApplication'); ?></h1>
<br /><br />

<p>
    <b><?php echo Translate::trad('ViewTitre'); ?></b>
<ul>
    <li><a href="ticket/admin"><?php echo Translate::trad('ListeTicket'); ?></a> <?php echo Translate::trad('ExplicationTicket'); ?> </li>
    <li><a href="locataire/admin"><?php echo Translate::trad('CreerTicket'); ?></a></li>
</ul>
</p>

<br />
<p>
    <b><?php echo Translate::trad('BatimentTicket') . ' :'; ?></b>
<ul>
    <li><a href="batiment/admin"><?php echo Translate::trad('ListBatiment'); ?></a> <?php echo Translate::trad('ExplicationBatiment'); ?></li>
    <li><a href="batiment/create"><?php echo Translate::trad('CreateBatiment'); ?></a></li>
</ul>
</p>

<br />
<p>
    <b><?php echo Translate::trad('LocataireTicket') . ' :'; ?></b>
<ul>
    <li><a href="locataire/admin"><?php echo Translate::trad('ListLocataire'); ?></a> <?php echo Translate::trad('ExplicationLocataire'); ?></li>
    <li><a href="locataire/create"><?php echo Translate::trad('CreerLocataire'); ?></a></li>
</ul>

</p>

<br />
<p>
    <b><?php echo Translate::trad('Utilisateur'); ?>&nbsp;:</b>
<ul>
    <li><a href="user/admin"><?php echo Translate::trad('ListUtilisateur'); ?></a>&nbsp;<?php echo Translate::trad('ExplicationLocataire'); ?> </li>
    <li><a href="user/create"><?php echo Translate::trad('CreerUtilisateur'); ?></a></li>
</ul>

</p>

<br />
<p>
    <b><?php echo Translate::trad('SousTraitant'); ?>&nbsp;:</b>
<ul>
    <li><a href="entreprise/admin"><?php echo Translate::trad('ListeSousTraitant'); ?></a> (pour voir, modifier ou supprimer un Sous-Traitant)</li>
    <li><a href="entreprise/create">Rajouter un Sous-Traitant</a></li>
</ul>
</p>

<br />
<p>
    <b>Catégorie:</b>
<ul>
    <li><a href="categorieIncident/admin">Liste des Catégories</a> (pour voir, modifier ou supprimer une catégorie)</li>
    <li><a href="categorieIncident/create">Rajouter une Catégorie</a></li>
</ul>
</p>