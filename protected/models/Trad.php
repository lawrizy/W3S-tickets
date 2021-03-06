<?php

/**
 * This is the model class for table "w3sys_trad".
 *
 * The followings are the available columns in table 'w3sys_trad':
 * @property integer $id
 * @property string $fr
 * @property string $en
 * @property string $nl
 * @property string $code
 */
class Trad extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'w3sys_trad';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
            array('code, fr, en, nl', 'required'), // Tous les champs sont requis lors de la création d'une traduction
            array('code', 'length', 'max' => 64),
            array('fr, en, nl', 'length', 'max' => 128),

// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
            array('code, fr, en, nl', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Identifiant',
            'code' => Translate::trad('TradCode'),
            'fr' => Translate::trad('Fr'),
            'en' => Translate::trad('En'),
            'nl' => Translate::trad('Nl'),
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
    public function search()
    {
// @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
    
        $criteria->compare('id', $this->id, true);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('fr', $this->fr, true);
        $criteria->compare('en', $this->en, true);
        $criteria->compare('nl', $this->nl, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Trad the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
