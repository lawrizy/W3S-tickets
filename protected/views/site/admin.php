<?php
$this->pageTitle = Yii::app()->name . ' - Admin';

?>

<h1>Gestion de l'application</h1>
<br /><br />

<p>
    <b>Ticket:</b>
    <ul>
        <li><a href="../ticket/admin?var=admin">Modification d'un Ticket</a></li>
        <li><a href="../ticket/admin">Liste des Tickets</a> (pour voir, traiter, clôturer ou supprimer un Ticket)</li>
        <li><a href="../locataire/admin">Créer un nouveau Ticket</a></li>
    </ul>
</p>

<br />
<p>
    <b>Bâtiment:</b>
    <ul>
        <li><a href="../batiment/admin">Modification d'un Bâtiment</a></li>
        <li><a href="../batiment/admin">Liste des Bâtiments</a> (pour voir, modifier ou supprimer un Bâtiment)</li>
        <li><a href="../batiment/create">Créer un nouveau Bâtiment</a></li>
    </ul>
</p>

<br />
<p>
    <b>Locataire:</b>
    <ul>
        <li><a href="../locataire/admin">Modification d'un Locataire</a></li>
        <li><a href="../locataire/admin">Liste des Locataires</a> (pour voir, modifier ou supprimer un Locataire)</li>
        <li><a href="../locataire/create">Créer un nouveau Locataire</a></li>
    </ul>

</p>

<br />
<p>
    <b>Utilisateur:</b>
    <ul>
        <li><a href="../user/admin">Modification d'un Utilisateur</a></li>
        <li><a href="../user/admin">Liste des Utilisateurs</a> (pour voir, modifier ou supprimer un Utilisateur)</li>
        <li><a href="../user/create">Créer un nouvel Utilisateur</a></li>
    </ul>

</p>

<br />
<p>
    <b>Sous-traîtant:</b>
    <ul>
        <li><a href="../entreprise/admin">Modification d'un Sous-Traitant</a></li>
        <li><a href="../entreprise/admin">Liste des Sous-Traitants</a> (pour voir, modifier ou supprimer un Sous-Traitant)</li>
        <li><a href="../entreprise/create">Rajouter un Sous-Traitant</a></li>
    </ul>
</p>
    
<br />
<p>
    <b>Catégorie:</b>
    <ul>
        <li><a href="../categorieIncident/admin">Modification d'une Catégorie</a></li>
        <li><a href="../categorieIncident/admin">Liste des Catégories</a> (pour voir, modifier ou supprimer une catégorie)</li>
        <li><a href="../categorieIncident/create">Rajouter une Catégorie</a></li>
    </ul>
</p>