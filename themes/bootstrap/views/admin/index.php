<?php
$this->pageTitle = Yii::app()->name . ' - Admin';
?>

<h1><?php echo Translate::trad('GestionApplication'); ?></h1>
<br /><br />

<p>
    <b><?php echo Translate::trad('ViewTitre'); ?></b>
<ul>
    <li><a href="ticket/admin"><?php echo Translate::trad('ListeTicket'); ?></a>&nbsp;<?php echo Translate::trad('ExplicationTicket'); ?></li>
    <li><a href="locataire/admin"><?php echo Translate::trad('CreerTicket'); ?></a></li>
</ul>
</p>

<br />
<p>
    <b><?php echo Translate::trad('BatimentTicket') . ' :'; ?></b>
<ul>
    <li><a href="batiment/admin"><?php echo Translate::trad('ListBatiment'); ?></a>&nbsp;<?php echo Translate::trad('ExplicationBatiment'); ?></li>
    <li><a href="batiment/create"><?php echo Translate::trad('CreateBatiment'); ?></a></li>
</ul>
</p>

<br />
<p>
    <b><?php echo Translate::trad('LocataireTicket') . ' :'; ?></b>
<ul>
    <li><a href="locataire/admin"><?php echo Translate::trad('ListLocataire'); ?></a>&nbsp;<?php echo Translate::trad('ExplicationLocataire'); ?></li>
    <li><a href="locataire/create"><?php echo Translate::trad('CreerLocataire'); ?></a></li>
</ul>

</p>

<br />
<p>
    <b><?php echo Translate::trad('Utilisateur'); ?>&nbsp;:</b>
<ul>
    <li><a href="user/admin"><?php echo Translate::trad('ListUtilisateur'); ?></a>&nbsp;<?php echo Translate::trad('ExplicationUtilisateur'); ?></li>
    <li><a href="user/create"><?php echo Translate::trad('CreerUtilisateur'); ?></a></li>
</ul>

</p>

<br />
<p>
    <b><?php echo Translate::trad('SousTraitant'); ?>&nbsp;:</b>
<ul>
    <li><a href="entreprise/admin"><?php echo Translate::trad('ListeSousTraitant'); ?></a>&nbsp;<?php echo Translate::trad('ExplicationEntreprise'); ?></li>
    <li><a href="entreprise/create">Rajouter un Sous-Traitant</a></li>
</ul>
</p>

<br />
<p>
    <b><?php echo Translate::trad('CategTicket') ?>:</b>
<ul>
    <li><a href="categorieIncident/admin"><?php echo Translate::trad('ListCategorie'); ?></a>&nbsp;<?php echo Translate::trad('ExplicationCategorie'); ?></li>
    <li><a href="categorieIncident/createCat"><?php echo Translate::trad('AjouterCategorie'); ?></a></li>
    <li><a href="categorieIncident/createSousCat"><?php echo Translate::trad('AjouterSousCategorie'); ?></a></li>
</ul>
</p>

<p>
    <b>I18N:</b>
<ul>
    <li><a href="trad/addTraduction"><?php echo Translate::trad('AjouterNouvelleTraduction'); ?></a></li>
    <li><a href="trad/modifyTraduction"><?php echo Translate::trad('ModifierTradExistante'); ?></a></li>
</ul>
</p>
<p>
    <b><?php echo Translate::trad('ChangerDroits'); ?>:</b>
<ul>
    <?php $id_user= Yii::app()->session['Logged']->id_user; ?>
    <li><a href="admin/update?id=<?php echo $id_user?>"><?php echo Translate::trad('ChangerDroitsUtilisateur'); ?></a></li>
</ul>
</p>