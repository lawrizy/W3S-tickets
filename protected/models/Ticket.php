<?php

/**
 * This is the model class for table "w3sys_ticket".
 *
 * The followings are the available columns in table 'w3sys_ticket':
 * @property integer $id_ticket
 * @property integer $fk_statut
 * @property integer $fk_categorie
 * @property integer $fk_lieu
 * @property integer $fk_user
 * @property string $commentaire
 * @property integer $fk_canal
 * @property integer $fk_secteur
 * @property string $date_intervention
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
            array('fk_categorie, fk_lieu, fk_canal', 'required'),
            array('fk_statut, fk_categorie, fk_lieu, fk_user, fk_canal, fk_secteur', 'numerical', 'integerOnly' => true),
            array('commentaire, date_intervention', 'safe'),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
            array('id_ticket, fk_statut, fk_categorie, fk_lieu, fk_user, commentaire, fk_canal, fk_secteur, date_intervention', 'safe', 'on' => 'search'),
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
            'id_ticket' => 'Numéro ticket',
            'fk_statut' => 'Statut',
            'fk_categorie' => 'Sous - Catégorie',
            'fk_lieu' => 'Lieu',
            'fk_user' => 'Utilisateur',
            'commentaire' => 'Commentaire',
            'fk_canal' => 'Voie de création',
            'fk_secteur' => 'Entreprise',
            'date_intervention' => 'Date  Intervention',
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
        $criteria->compare('fk_lieu', $this->fk_lieu);
        $criteria->compare('fk_user', $this->fk_user);
        $criteria->compare('commentaire', $this->commentaire, true);
        $criteria->compare('fk_canal', $this->fk_canal);
        $criteria->compare('fk_secteur', $this->fk_secteur);
        $criteria->compare('date_intervention', $this->date_intervention, true);

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
        $var = StatutTicket::model()->findByPk($this->fk_statut);
        return $var->label;
    }

    public function getCategorieIncident() {
        $var = CategorieIncident::model()->findByPk($this->fk_categorie);
        return $var->label;
    }

    public function getLieu() {
        $var = Lieu::model()->findByPk($this->fk_lieu);
        $var1 = Batiment::model()->findByPk($var->fk_batiment);
        //  $var1 = Locataire::model()->findByPk(2);
        return $var1->adresse . ', ' . $var1->cp . ' ' . $var1->commune . ' apt ' . $var->appartement . '/' . $var->etage;
    }

}
