<?php

/**
 * This is the model class for table "w3sys_secteur".
 *
 * The followings are the available columns in table 'w3sys_secteur':
 * @property integer $fk_entreprise
 * @property integer $id_secteur
 * @property integer $fk_categorie
 * @property integer $visible
 *
 * The followings are the available model relations:
 * @property Entreprise $fkEntreprise
 * @property CategorieIncident $fkCategorie
 */
class Secteur extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'w3sys_secteur';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
            array('fk_entreprise, fk_categorie', 'required', 'message' => 'Le champs {attribute} ne peut être vide.'),
            array('fk_entreprise, fk_categorie, visible', 'numerical', 'integerOnly' => true, 'message' => 'Le champs {attribute} ne peut contenir que des nombres.'),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
            array('fk_entreprise, id_secteur, fk_categorie, visible', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
        return array(
            'fkEntreprise' => array(self::BELONGS_TO, 'Entreprise', 'fk_entreprise'),
            'fkCategorie' => array(self::BELONGS_TO, 'CategorieIncident', 'fk_categorie'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'fk_entreprise' => 'Fk Entreprise',
            'id_secteur' => 'Id Secteur',
            'fk_categorie' => 'Fk Categorie',
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

        $criteria->compare('fk_entreprise', $this->fk_entreprise);
        $criteria->compare('id_secteur', $this->id_secteur);
        $criteria->compare('fk_categorie', $this->fk_categorie);
        $criteria->compare('visible', Constantes::VISIBLE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Secteur the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
