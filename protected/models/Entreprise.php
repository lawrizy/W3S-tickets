<?php

/**
 * This is the model class for table "w3sys_entreprise".
 *
 * The followings are the available columns in table 'w3sys_entreprise':
 * @property integer $id_entreprise
 * @property string $nom
 * @property string $adresse
 * @property string $tva
 * @property string $commune
 * @property integer $cp
 * @property string $tel
 * @property integer $visible
 *
 * The followings are the available model relations:
 * @property CategorieIncident[] $categorieIncidents
 * @property Ticket[] $tickets
 */
class Entreprise extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'w3sys_entreprise';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
            array('nom, adresse, tva, commune, cp, tel', 'required'),
            array('cp, visible', 'numerical', 'integerOnly' => true),
            array('nom, adresse, tva, commune, tel', 'length', 'max' => 45),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
            array('id_entreprise, nom, adresse, tva, commune, cp, tel, visible', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
        return array(
            'categorieIncidents' => array(self::HAS_MANY, 'CategorieIncident', 'fk_entreprise'),
            'tickets' => array(self::HAS_MANY, 'Ticket', 'fk_entreprise'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_entreprise' => 'Id Entreprise',
            'nom' => Translate::trad("NomLoc"),
            'adresse' => Translate::trad("Adresse"),
            'tva' => Translate::trad("TVA"),
            'commune' => Translate::trad("Commune"),
            'cp' => Translate::trad("CodePostal"),
            'tel' => Translate::trad("Phone"),
            'visible' => 'Visible',
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

        $criteria->compare('id_entreprise', $this->id_entreprise);
        $criteria->compare('nom', $this->nom, true);
        $criteria->compare('adresse', $this->adresse, true);
        $criteria->compare('tva', $this->tva, true);
        $criteria->compare('commune', $this->commune, true);
        $criteria->compare('cp', $this->cp);
        $criteria->compare('tel', $this->tel, true);
        $criteria->compare('visible', Constantes::VISIBLE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Entreprise the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
