<?php

/**
 * This is the model class for table "w3sys_categorie_incident".
 *
 * The followings are the available columns in table 'w3sys_categorie_incident':
 * @property string $id_categorie_incident
 * @property string $label
 * @property string $fk_parent
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
            array('label', 'required'),
            array('label', 'length', 'max' => 64),
            array('fk_parent', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_categorie_incident, label, fk_parent', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_categorie_incident' => 'Id Categorie Incident',
            'label' => 'Label',
            'fk_parent' => 'Fk Parent',
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

        $criteria->compare('id_categorie_incident', $this->id_categorie_incident, true);
        $criteria->compare('label', $this->label, true);
        $criteria->compare('fk_parent', $this->fk_parent, true);

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
