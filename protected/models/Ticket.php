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
 * @property integer $fk_canal
 * @property string $date_intervention
 * @property integer $fk_entreprise
 * @property string $code_ticket
 * @property string $etage
 * @property string $bureau
 * @property integer $fk_locataire
 * @property integer $fk_batiment
 *
 * The followings are the available model relations:
 * @property HistoriqueTicket[] $historiqueTickets
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
            array('fk_categorie, fk_canal, fk_locataire, fk_batiment', 'required', 'message' => Translate::trad('Required')),
            array('fk_statut, fk_categorie, fk_user, fk_canal, fk_entreprise, fk_locataire, fk_batiment', 'numerical', 'integerOnly' => true,
                'message' => 'Le champs {attribute} ne peut contenir que des nombres.'),
            array('code_ticket', 'length', 'max' => 10),
            array('etage, bureau', 'length', 'max' => 45),
            array('descriptif, date_intervention', 'safe'),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
            array('id_ticket, fk_statut, fk_categorie, fk_user, descriptif, fk_canal, date_intervention, fk_entreprise, code_ticket, etage, bureau, fk_locataire, fk_batiment', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_ticket' => Translate::trad('IdTicket'),
            'fk_statut' => Translate::trad('StatutTicket'),
            'fk_categorie' => Translate::trad('CategorieTicket'),
            'fk_user' => Translate::trad('UserTicket'),
            'descriptif' => Translate::trad('DescriptifTicket'),
            'fk_canal' => Translate::trad('CanalTicket'),
            'date_intervention' => Translate::trad('DateInterventionTicket'),
            'fk_entreprise' => Translate::trad('EntrepriseTicket'),
            'code_ticket' => Translate::trad('CodeTicket'),
            'etage' => Translate::trad('EtageTicket'),
            'bureau' => Translate::trad('BureauTicket'),
            'fk_locataire' => Translate::trad('LocataireTicket'),
            'fk_batiment' => Translate::trad('BatimentTicket'),
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
        $criteria->compare('code_ticket', $this->code_ticket);
        $criteria->compare('fk_statut', $this->fk_statut);
        $criteria->compare('fk_categorie', $this->fk_categorie);
        $criteria->compare('fk_batiment', $this->fk_batiment);
        $criteria->compare('fk_user', $this->fk_user);
        $criteria->compare('descriptif', $this->descriptif, true);
        $criteria->compare('fk_canal', $this->fk_canal);
        $criteria->compare('fk_entreprise', $this->fk_entreprise);
        $criteria->compare('date_intervention', $this->date_intervention, true);
        // Pour l'instant, ne recherche que les Ticket dont la visibilité est à 1
        $criteria->compare('visible', 1);
        //$criteria->compare('visible', $this->visible);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchOpened() {
        $criteria = new CDbCriteria;

        $criteria->compare('id_ticket', $this->id_ticket);
        $criteria->compare('code_ticket', $this->code_ticket);
        $criteria->compare('fk_statut', $this->fk_statut = 1);
        $criteria->compare('fk_categorie', $this->fk_categorie);
        $criteria->compare('fk_batiment', $this->fk_batiment);
        $criteria->compare('fk_user', $this->fk_user);
        $criteria->compare('descriptif', $this->descriptif, true);
        $criteria->compare('fk_canal', $this->fk_canal);
        $criteria->compare('fk_entreprise', $this->fk_entreprise);
        $criteria->compare('date_intervention', $this->date_intervention, true);
        // Pour l'instant, ne recherche que les Ticket dont la visibilité est à 1
        $criteria->compare('visible', 1);
        //$criteria->compare('visible', $this->visible);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchInProgress() {
        $criteria = new CDbCriteria;

        $criteria->compare('id_ticket', $this->id_ticket);
        $criteria->compare('code_ticket', $this->code_ticket);
        $criteria->compare('fk_statut', $this->fk_statut = 2);
        $criteria->compare('fk_categorie', $this->fk_categorie);
        $criteria->compare('fk_batiment', $this->fk_batiment);
        $criteria->compare('fk_user', $this->fk_user);
        $criteria->compare('descriptif', $this->descriptif, true);
        $criteria->compare('fk_canal', $this->fk_canal);
        $criteria->compare('fk_entreprise', $this->fk_entreprise);
        $criteria->compare('date_intervention', $this->date_intervention, true);
        // Pour l'instant, ne recherche que les Ticket dont la visibilité est à 1
        $criteria->compare('visible', 1);
        //$criteria->compare('visible', $this->visible);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchClosed() {
        $criteria = new CDbCriteria;

        $criteria->compare('id_ticket', $this->id_ticket);
        $criteria->compare('code_ticket', $this->code_ticket);
        $criteria->compare('fk_statut', $this->fk_statut = 3);
        $criteria->compare('fk_categorie', $this->fk_categorie);
        $criteria->compare('fk_batiment', $this->fk_batiment);
        $criteria->compare('fk_user', $this->fk_user);
        $criteria->compare('descriptif', $this->descriptif, true);
        $criteria->compare('fk_canal', $this->fk_canal);
        $criteria->compare('fk_entreprise', $this->fk_entreprise);
        $criteria->compare('date_intervention', $this->date_intervention, true);
        // Pour l'instant, ne recherche que les Ticket dont la visibilité est à 1
        $criteria->compare('visible', 1);
        //$criteria->compare('visible', $this->visible);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchByLocataire($id) {
        $criteria = new CDbCriteria;

        $criteria->compare('id_ticket', $this->id_ticket);
        $criteria->compare('code_ticket', $this->code_ticket);
        $criteria->compare('fk_statut', $this->fk_statut);
        $criteria->compare('fk_categorie', $this->fk_categorie);
        $criteria->compare('fk_batiment', $this->fk_batiment);
        $criteria->compare('fk_user', $this->fk_user);
        $criteria->compare('descriptif', $this->descriptif, true);
        $criteria->compare('fk_canal', $this->fk_canal);
        $criteria->compare('fk_entreprise', $this->fk_entreprise);
        $criteria->compare('date_intervention', $this->date_intervention, true);
        $criteria->compare('fk_locataire', $this->fk_locataire = $id);
        // Pour l'instant, ne recherche que les Ticket dont la visibilité est à 1
        $criteria->compare('visible', 1);
        //$criteria->compare('visible', $this->visible);

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
