<?php
$this->pageTitle = Yii::app()->name . ' - Admin';
?>

<h1><?php echo Translate::tradPetit('GestionApplication'); ?></h1>
<br /><br />

<p>
    <b><?php echo Translate::tradPetit('ViewTitre'); ?></b>
<ul>
    <li><a href="ticket/admin"><?php echo Translate::tradPetit('ListeTicket'); ?></a> <?php echo Translate::tradGrand('ExplicationTicket'); ?> </li>
    <li><a href="locataire/admin"><?php echo Translate::tradPetit('CreerTicket'); ?></a></li>
</ul>
</p>

<br />
<p>
    <b><?php echo Translate::tradPetit('BatimentTicket') . ' :'; ?></b>
<ul>
    <li><a href="batiment/admin"><?php echo Translate::tradPetit('ListBatiment'); ?></a> <?php echo Translate::tradGrand('ExplicationBatiment'); ?></li>
    <li><a href="batiment/create"><?php echo Translate::tradPetit('CreateBatiment'); ?></a></li>
</ul>
</p>

<br />
<p>
    <b><?php echo Translate::tradPetit('LocataireTicket').' :'; ?></b>
<ul>
    <li><a href="locataire/admin"><?php echo Translate::tradPetit('ListLocataire'); ?></a> (pour voir, modifier ou supprimer un Locataire)</li>
    <li><a href="locataire/create">Créer un nouveau Locataire</a></li>
</ul>

</p>

<br />
<p>
    <b>Utilisateur:</b>
<ul>
    <li><a href="user/admin">Liste des Utilisateurs</a> (pour voir, modifier ou supprimer un Utilisateur)</li>
    <li><a href="user/create">Créer un nouvel Utilisateur</a></li>
</ul>

</p>

<br />
<p>
    <b>Sous-traîtant:</b>
<ul>
    <li><a href="entreprise/admin">Liste des Sous-Traitants</a> (pour voir, modifier ou supprimer un Sous-Traitant)</li>
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