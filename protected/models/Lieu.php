<?php

/**
 * This is the model class for table "w3sys_lieu".
 *
 * The followings are the available columns in table 'w3sys_lieu':
 * @property string $id_lieu
 * @property integer $etage
 * @property string $appartement
 * @property string $fk_locataire
 * @property integer $fk_batiment
 */
class Lieu extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'w3sys_lieu';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
            array('fk_locataire, fk_batiment', 'required'),
            array('etage, fk_batiment', 'numerical', 'integerOnly' => true),
            array('appartement', 'length', 'max' => 5),
            array('fk_locataire', 'length', 'max' => 10),
            // The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
            array('id_lieu, etage, appartement, fk_locataire, fk_batiment', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {


        return array('Lieux' => array(self::HAS_ONE, 'Batiment', 'fk_batiment'),
            'loc' => array(self::HAS_ONE, 'Locataire', 'fk_locataire')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_lieu' => 'Id Lieu',
            'etage' => 'Etage n°',
            'appartement' => 'Numéro de l\'appartement',
            'fk_locataire' => 'Numéro de locataire',
            'fk_batiment' => 'Numéro de bâtiment',
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


        $criteria->compare('id_lieu', $this->id_lieu, true);
        $criteria->compare('etage', $this->etage);
        $criteria->compare('appartement', $this->appartement, true);
        $criteria->compare('fk_locataire', $this->fk_locataire, true);
        $criteria->compare('fk_batiment', $this->fk_batiment);
        $criteria->select = 'l.*,b.*';
        $criteria->join = 'INNER JOIN w3sys_batiment b ON l.fk_batiment=b.id_batiment';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Lieu the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getAdresse() {
        $var = Batiment::model()->findByPk($this->fk_batiment);
       $var1= Locataire::model()->findByPk(2);
        return $var->adresse . ', ' . $var->cp . ' ' . $var->commune . ' apt ' . $this->appartement . '/' . $this->etage;
    }

    public function getLocataire() {
        return Locataire::model()->findByPk($this->fk_locataire);
    }

}
