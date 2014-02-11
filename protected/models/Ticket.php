<?php

/**
 * This is the model class for table "w3sys_ticket".
 *
 * The followings are the available columns in table 'w3sys_ticket':
 * @property string $id_ticket
 * @property string $fk_statut
 * @property string $fk_categorie
 * @property string $fk_lieu
 * @property string $fk_user
 * @property string $version
 * @property string $commentaire
 * @property integer $fk_canal
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
            array('fk_canal', 'numerical', 'integerOnly' => true),
            array('fk_statut, fk_categorie, fk_lieu, fk_user', 'length', 'max' => 10),
            array('version', 'length', 'max' => 2),
            array('commentaire', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_ticket, fk_statut, fk_categorie, fk_lieu, fk_user, version, commentaire, fk_canal', 'safe', 'on' => 'search'),
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
            'lsdfldf' => array(self::HAS_ONE, 'StatutTicket', 'fk_statut')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_ticket' => 'Numéro du ticket',
            'fk_statut' => 'Statut du ticket',
            'fk_categorie' => 'Catégorie de l\'incident',
            'fk_lieu' => 'Lieu',
            'fk_user' => 'Utilisateur',
            'version' => 'Version',
            'commentaire' => 'Commentaire',
            'fk_canal' => 'Canal de création',
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

        $criteria->compare('id_ticket', $this->id_ticket, true);
        $criteria->compare('fk_statut', $this->fk_statut, true);
        $criteria->compare('fk_categorie', $this->fk_categorie, true);
        $criteria->compare('fk_lieu', $this->fk_lieu, true);
        $criteria->compare('fk_user', $this->fk_user, true);
        $criteria->compare('version', $this->version, true);
        $criteria->compare('commentaire', $this->commentaire, true);
        $criteria->compare('fk_canal', $this->fk_canal);

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
