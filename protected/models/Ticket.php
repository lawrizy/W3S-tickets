<?php

/**
 * This is the model class for table "w3sys_ticket".
 *
 * The followings are the available columns in table 'w3sys_ticket':
 * @property integer $id_ticket
 * @property integer $fk_statut
 * @property integer $fk_categorie
 * @property integer $fk_user
 * @property string $descriptif
 * @property string $date_intervention
 * @property integer $fk_entreprise
 * @property string $code_ticket
 * @property string $etage
 * @property string $bureau
 * @property integer $fk_batiment
 * @property integer $fk_priorite
 * @property integer $fk_locataire
 * @property integer $visible
 * @property integer $fk_canal
 *
 * The followings are the available model relations:
 * @property HistoriqueTicket[] $historiqueTickets
 * @property StatutTicket $fkStatut
 * @property CategorieIncident $fkCategorie
 * @property User $fkUser
 * @property Entreprise $fkEntreprise
 * @property Batiment $fkBatiment
 * @property Priorite $fkPriorite
 * @property User $fkLocataire
 * @property Canal $fkCanal
 */
class Ticket extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'w3sys_ticket';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
            array('fk_categorie, fk_canal, code_ticket, fk_locataire, fk_batiment, fk_priorite', 'required', 'message' => Translate::trad('Required')),
            array('fk_statut, fk_categorie, fk_user, fk_canal, fk_entreprise, fk_locataire, fk_batiment, visible, fk_priorite', 'numerical', 'integerOnly' => true,
                'message' => 'Le champs {attribute} ne peut contenir que des nombres.'),
            array('code_ticket', 'length', 'max' => 10),
            array('etage, bureau', 'length', 'max' => 45),
            array('descriptif, date_intervention', 'safe'),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
            array('id_ticket, fk_statut, fk_categorie, fk_user, descriptif, fk_canal, date_intervention, fk_entreprise, code_ticket, etage, bureau, fk_locataire, fk_batiment, visible, fk_priorite', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
        return array(
            'historiqueTickets' => array(self::HAS_MANY, 'HistoriqueTicket', 'fk_ticket'),
            'fkStatut' => array(self::BELONGS_TO, 'StatutTicket', 'fk_statut'),
            'fkCategorie' => array(self::BELONGS_TO, 'CategorieIncident', 'fk_categorie'),
            'fkUser' => array(self::BELONGS_TO, 'User', 'fk_user'),
            'fkEntreprise' => array(self::BELONGS_TO, 'Entreprise', 'fk_entreprise'),
            'fkBatiment' => array(self::BELONGS_TO, 'Batiment', 'fk_batiment'),
            'fkPriorite' => array(self::BELONGS_TO, 'Priorite', 'fk_priorite'),
            'fkLocataire' => array(self::BELONGS_TO, 'User', 'fk_locataire'),
            'fkCanal' => array(self::BELONGS_TO, 'Canal', 'fk_canal'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_ticket' => 'Id Ticket',
            'fk_statut' => 'Fk Statut',
            'fk_categorie' => 'Fk Categorie',
            'fk_user' => 'Fk User',
            'descriptif' => 'Descriptif',
            'fk_canal' => 'Fk Canal',
            'date_intervention' => 'Date Intervention',
            'fk_entreprise' => 'Fk Entreprise',
            'code_ticket' => 'Code Ticket',
            'etage' => 'Etage',
            'bureau' => 'Bureau',
            'fk_locataire' => 'Fk Locataire',
            'fk_batiment' => 'Fk Batiment',
            'visible' => 'Visible',
            'fk_priorite' => 'Fk Priorite',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
// @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id_ticket', $this->id_ticket);
        $criteria->compare('fk_statut', $this->fk_statut);
        $criteria->compare('fk_categorie', $this->fk_categorie);
        $criteria->compare('fk_user', $this->fk_user);
        $criteria->compare('descriptif', $this->descriptif, true);
        $criteria->compare('fk_canal', $this->fk_canal);
        $criteria->compare('date_intervention', $this->date_intervention, true);
        $criteria->compare('fk_entreprise', $this->fk_entreprise);
        $criteria->compare('code_ticket', $this->code_ticket, true);
        $criteria->compare('etage', $this->etage, true);
        $criteria->compare('bureau', $this->bureau, true);
        $criteria->compare('fk_locataire', $this->fk_locataire);
        $criteria->compare('fk_batiment', $this->fk_batiment);
        $criteria->compare('visible', Constantes::VISIBLE);
        $criteria->compare('fk_priorite', $this->fk_priorite);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchOpened() {
        $criteria = new CDbCriteria;

        $criteria->compare('id_ticket', $this->id_ticket);
        $criteria->compare('fk_statut', Constantes::STATUT_OPENED);
        $criteria->compare('fk_categorie', $this->fk_categorie);
        $criteria->compare('fk_user', $this->fk_user);
        $criteria->compare('descriptif', $this->descriptif, true);
        $criteria->compare('fk_canal', $this->fk_canal);
        $criteria->compare('date_intervention', $this->date_intervention, true);
        $criteria->compare('fk_entreprise', $this->fk_entreprise);
        $criteria->compare('code_ticket', $this->code_ticket, true);
        $criteria->compare('etage', $this->etage, true);
        $criteria->compare('bureau', $this->bureau, true);
        $criteria->compare('fk_locataire', $this->fk_locataire);
        $criteria->compare('fk_batiment', $this->fk_batiment);
        $criteria->compare('visible', Constantes::VISIBLE);
        $criteria->compare('fk_priorite', $this->fk_priorite);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchInProgress() {
        $criteria = new CDbCriteria;

        $criteria->compare('id_ticket', $this->id_ticket);
        $criteria->compare('fk_statut', Constantes::STATUT_TREATMENT);
        $criteria->compare('fk_categorie', $this->fk_categorie);
        $criteria->compare('fk_user', $this->fk_user);
        $criteria->compare('descriptif', $this->descriptif, true);
        $criteria->compare('fk_canal', $this->fk_canal);
        $criteria->compare('date_intervention', $this->date_intervention, true);
        $criteria->compare('fk_entreprise', $this->fk_entreprise);
        $criteria->compare('code_ticket', $this->code_ticket, true);
        $criteria->compare('etage', $this->etage, true);
        $criteria->compare('bureau', $this->bureau, true);
        $criteria->compare('fk_locataire', $this->fk_locataire);
        $criteria->compare('fk_batiment', $this->fk_batiment);
        $criteria->compare('visible', Constantes::VISIBLE);
        $criteria->compare('fk_priorite', $this->fk_priorite);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchClosed() {
        $criteria = new CDbCriteria;

        $criteria->compare('id_ticket', $this->id_ticket);
        $criteria->compare('fk_statut', Constantes::STATUT_CLOSED);
        $criteria->compare('fk_categorie', $this->fk_categorie);
        $criteria->compare('fk_user', $this->fk_user);
        $criteria->compare('descriptif', $this->descriptif, true);
        $criteria->compare('fk_canal', $this->fk_canal);
        $criteria->compare('date_intervention', $this->date_intervention, true);
        $criteria->compare('fk_entreprise', $this->fk_entreprise);
        $criteria->compare('code_ticket', $this->code_ticket, true);
        $criteria->compare('etage', $this->etage, true);
        $criteria->compare('bureau', $this->bureau, true);
        $criteria->compare('fk_locataire', $this->fk_locataire);
        $criteria->compare('fk_batiment', $this->fk_batiment);
        $criteria->compare('visible', Constantes::VISIBLE);
        $criteria->compare('fk_priorite', $this->fk_priorite);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchByLocataire($id) {
        $criteria = new CDbCriteria;

        $criteria->compare('id_ticket', $this->id_ticket);
        $criteria->compare('fk_statut', $this->fk_statut);
        $criteria->compare('fk_categorie', $this->fk_categorie);
        $criteria->compare('fk_user', $this->fk_user);
        $criteria->compare('descriptif', $this->descriptif, true);
        $criteria->compare('fk_canal', $this->fk_canal);
        $criteria->compare('date_intervention', $this->date_intervention, true);
        $criteria->compare('fk_entreprise', $this->fk_entreprise);
        $criteria->compare('code_ticket', $this->code_ticket, true);
        $criteria->compare('etage', $this->etage, true);
        $criteria->compare('bureau', $this->bureau, true);
        $criteria->compare('fk_locataire', $id);
        $criteria->compare('fk_batiment', $this->fk_batiment);
        $criteria->compare('visible', Constantes::VISIBLE);
        $criteria->compare('fk_priorite', $this->fk_priorite);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Ticket the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getStatusTicket() {
        $var = StatutTicket::model()->findByAttributes(array('fk_statut' => $this->fk_statut, 'visible' => 1));
        return $var->label;
    }

    public function getCategorieIncident() {
        $var = CategorieIncident::model()->findByAttributes(array('fk_categorie' => $this->fk_categorie, 'visible' => 1));
        return $var->label;
    }

    public function getCategorieFromSousCategorie() {
        $sousCat = CategorieIncident::model()->findByPk($this->fk_categorie);
        $cat = CategorieIncident::model()->findByPk(array('fk_parent' => $sousCat->fk_parent, 'visible' => 1));
        return $cat->id_categorie_incident;
    }

}
