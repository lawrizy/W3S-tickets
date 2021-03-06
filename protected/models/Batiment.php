<?php

/**
 * This is the model class for table "w3sys_batiment".
 *
 * The followings are the available columns in table 'w3sys_batiment':
 * @property integer $id_batiment
 * @property string $adresse
 * @property string $commune
 * @property integer $cp
 * @property string $nom
 * @property integer $cpt
 * @property string $code
 * @property integer $visible
 */
 /* The followings are the available model relations:
 * @property Lieu[] $lieux
  *@property Ticket[] $tickets
 */
class Batiment extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'w3sys_batiment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
            array('adresse, commune, cp, nom, code', 'required'),
            array('cp, cpt, visible', 'numerical', 'integerOnly' => true),
            array('adresse, commune, nom', 'length', 'max' => 45),
            array('code', 'length', 'max' => 4),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
            array('id_batiment, adresse, commune, cp, nom, cpt, code, visible', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
        return array(
            'lieux' => array(self::HAS_MANY, 'Lieu', 'fk_batiment'),
            'tickets'=>array(self::HAS_MANY,'Ticket','fk_batiment')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_batiment' => 'Id Batiment',
            'adresse' => Translate::trad("Adresse"),
            'commune' => Translate::trad("Commune"),
            'cp' => Translate::trad("CodePostal"),
            'nom' => Translate::trad("NomLoc"),
            'cpt' => 'Cpt',
            'code' => 'Code',
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

        $criteria->compare('id_batiment', $this->id_batiment);
        $criteria->compare('adresse', $this->adresse, true);
        $criteria->compare('commune', $this->commune, true);
        $criteria->compare('cp', $this->cp);
        $criteria->compare('nom', $this->nom, true);
        $criteria->compare('cpt', $this->cpt);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('visible', Constantes::VISIBLE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Batiment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
