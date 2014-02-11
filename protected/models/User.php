<?php

/**
 * This is the model class for table "w3sys_user".
 *
 * The followings are the available columns in table 'w3sys_user':
 * @property integer $id_user
 * @property string $nom
 * @property string $email
 * @property string $password
 * @property integer $fk_fonction
 *
 * The followings are the available model relations:
 * @property Fonction $fkFonction
 */
<<<<<<< HEAD
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'w3sys_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nom, email, password, fk_fonction', 'required'),
			array('fk_fonction', 'numerical', 'integerOnly'=>true),
			array('nom, email', 'length', 'max'=>64),
			array('password', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user, nom, email, password, fk_fonction', 'safe', 'on'=>'search'),
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
			'fkFonction' => array(self::BELONGS_TO, 'Fonction', 'fk_fonction'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => 'Id User',
			'nom' => 'Nom',
			'email' => 'Email',
			'password' => 'Password',
			'fk_fonction' => 'Fk Fonction',
		);
	}
=======
class User extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'w3sys_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nom, prenom, email, password', 'required'),
            array('nom, prenom, email', 'length', 'max' => 64),
            array('password', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_user, nom, prenom, email, password', 'safe', 'on' => 'search'),
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
            'id_user' => 'Id User',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'email' => 'Email',
            'password' => 'Password',
        );
    }
>>>>>>> 11491a7f40938f72ce5a9d8c131056ced1d02d27

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

<<<<<<< HEAD
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('nom',$this->nom,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('fk_fonction',$this->fk_fonction);
=======
        $criteria->compare('id_user', $this->id_user);
        $criteria->compare('nom', $this->nom, true);
        $criteria->compare('prenom', $this->prenom, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
>>>>>>> 11491a7f40938f72ce5a9d8c131056ced1d02d27

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
