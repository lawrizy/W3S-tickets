<?php

/**
 * This is the model class for table "w3sys_batiment".
 *
 * The followings are the available columns in table 'w3sys_batiment':
 * @property integer $id_batiment
 * @property string $adresse
 * @property string $commune
 * @property integer $cp
 *
 * The followings are the available model relations:
 * @property Secteur[] $secteurs
 */
<<<<<<< HEAD:protected/models/Batiment.php
class Batiment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'w3sys_batiment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('adresse, commune, cp', 'required'),
			array('cp', 'numerical', 'integerOnly'=>true),
			array('adresse, commune', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_batiment, adresse, commune, cp', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'secteurs' => array(self::HAS_MANY, 'Secteur', 'fk_batiment'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_batiment' => 'Id Batiment',
			'adresse' => 'Adresse',
			'commune' => 'Commune',
			'cp' => 'Cp',
		);
	}
=======
class StatutTicket extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'w3sys_statut_ticket';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('label', 'length', 'max' => 64),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_statut_ticket, label', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'historiqueTickets' => array(self::HAS_MANY, 'HistoriqueTicket', 'fk_statut_ticket'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_statut_ticket' => 'Id Statut Ticket',
            'label' => 'Label',
        );
    }
>>>>>>> 11491a7f40938f72ce5a9d8c131056ced1d02d27:protected/models/StatutTicket.php

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

<<<<<<< HEAD:protected/models/Batiment.php
		$criteria->compare('id_batiment',$this->id_batiment);
		$criteria->compare('adresse',$this->adresse,true);
		$criteria->compare('commune',$this->commune,true);
		$criteria->compare('cp',$this->cp);
=======
        $criteria->compare('id_statut_ticket', $this->id_statut_ticket, true);
        $criteria->compare('label', $this->label, true);
>>>>>>> 11491a7f40938f72ce5a9d8c131056ced1d02d27:protected/models/StatutTicket.php

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return StatutTicket the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

<<<<<<< HEAD:protected/models/Batiment.php
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Batiment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
=======
>>>>>>> 11491a7f40938f72ce5a9d8c131056ced1d02d27:protected/models/StatutTicket.php
}
