<?php

/**
 * This is the model class for table "w3sys_lieu".
 *
 * The followings are the available columns in table 'w3sys_lieu':
 * @property string $id_lieu
 * @property string $adresse
 * @property string $ville
 * @property string $id_locataire
 */
class Lieu extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'w3sys_lieu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_lieu, adresse, ville, id_locataire', 'required'),
			array('id_lieu, id_locataire', 'length', 'max'=>10),
			array('adresse, ville', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_lieu, adresse, ville, id_locataire', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_lieu' => 'Id Lieu',
			'adresse' => 'Adresse',
			'ville' => 'Ville',
			'id_locataire' => 'Id Locataire',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id_lieu',$this->id_lieu,true);
		$criteria->compare('adresse',$this->adresse,true);
		$criteria->compare('ville',$this->ville,true);
		$criteria->compare('id_locataire',$this->id_locataire,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Lieu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
