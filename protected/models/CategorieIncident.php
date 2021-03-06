<?php

/**
 * This is the model class for table "w3sys_categorie_incident".
 *
 * The followings are the available columns in table 'w3sys_categorie_incident':
 * @property integer $id_categorie_incident
 * @property string $label
 * @property integer $fk_parent
 * @property integer $fk_priorite
 * @property integer $visible
 * @property integer $fk_entreprise
 *
 * The followings are the available model relations:
 * @property CategorieIncident $fkParent
 * @property CategorieIncident[] $categorieIncidents
 * @property Priorite $fkPriorite
 * @property Entreprise $fkEntreprise
 * @property Ticket[] $tickets
 */
class CategorieIncident extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'w3sys_categorie_incident';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
            array('label, fk_priorite', 'required', 'message' => 'Le champs {attribute} ne peut être vide.'),
            array('fk_parent, fk_priorite, fk_entreprise', 'numerical', 'integerOnly' => true, 'message' => 'Veuillez n\'entrer qu\'un nombre dans le champ suivant : {attribute}'),
            array('label', 'length', 'max' => 64),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
            array('id_categorie_incident, label, fk_parent, fk_priorite, fk_entreprise', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
        return array(
            'fkParent' => array(self::BELONGS_TO, 'CategorieIncident', 'fk_parent'),
            'categorieIncidents' => array(self::HAS_MANY, 'CategorieIncident', 'fk_parent'),
            'fkPriorite' => array(self::BELONGS_TO, 'Priorite', 'fk_priorite'),
            'fkEntreprise' => array(self::BELONGS_TO, 'Entreprise', 'fk_entreprise'),
            'tickets' => array(self::HAS_MANY, 'Ticket', 'fk_categorie'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_categorie_incident' => 'Id Categorie Incident',
            'label' => 'Label',
            'fk_parent' => Translate::trad("CategorieParente"),
            'fk_priorite' => Translate::trad("Priority"),
            'fk_entreprise' => Translate::trad("EntrepriseAssociee"),
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

        $criteria->compare('id_categorie_incident', $this->id_categorie_incident);
        $criteria->compare('label', $this->label, true);
        $criteria->compare('fk_parent', $this->fk_parent);
        $criteria->compare('fk_priorite', $this->fk_priorite);
        $criteria->compare('fk_entreprise',$this->fk_entreprise);
        $criteria->compare('visible', Constantes::VISIBLE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CategorieIncident the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
