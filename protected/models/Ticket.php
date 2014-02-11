<?php

/**
 * This is the model class for table "w3sys_ticket".
 *
 * The followings are the available columns in table 'w3sys_ticket':
 * @property string $id_ticket
 * @property string $fk_statut
 * @property string $fk_categorie
 * @property string $fk_lieu
 * @property string $fk_user
 * @property string $version
 * @property string $commentaire
 * @property integer $fk_canal
 *
 * The followings are the available model relations:
 * @property HistoriqueTicket[] $historiqueTickets
 */
<<<<<<< HEAD
class Ticket extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'w3sys_ticket';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_categorie, fk_lieu, fk_canal', 'required'),
			array('fk_canal', 'numerical', 'integerOnly'=>true),
			array('fk_statut, fk_categorie, fk_lieu, fk_user', 'length', 'max'=>10),
			array('version', 'length', 'max'=>2),
			array('commentaire', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_ticket, fk_statut, fk_categorie, fk_lieu, fk_user, version, commentaire, fk_canal', 'safe', 'on'=>'search'),
		);
	}
=======
class Ticket extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'w3sys_ticket';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fk_statut, fk_categorie, fk_lieu, fk_user', 'required'),
            array('fk_statut, fk_categorie, fk_lieu, fk_user', 'length', 'max' => 10),
            array('version', 'length', 'max' => 2),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_ticket, fk_statut, fk_categorie, fk_lieu, fk_user, version', 'safe', 'on' => 'search'),
        );
    }
>>>>>>> 11491a7f40938f72ce5a9d8c131056ced1d02d27

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'historiqueTickets' => array(self::HAS_MANY, 'HistoriqueTicket', 'fk_ticket'),
        );
    }

<<<<<<< HEAD
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_ticket' => 'Id Ticket',
			'fk_statut' => 'Fk Statut',
			'fk_categorie' => 'Fk Categorie',
			'fk_lieu' => 'Fk Lieu',
			'fk_user' => 'Fk User',
			'version' => 'Version',
			'commentaire' => 'Commentaire',
			'fk_canal' => 'Fk Canal',
		);
	}
=======
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_ticket' => 'Id Ticket',
            'fk_statut' => 'Fk Statut',
            'fk_categorie' => 'Fk Categorie',
            'fk_lieu' => 'Fk Lieu',
            'fk_user' => 'Fk User',
            'version' => 'Version',
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
		$criteria->compare('id_ticket',$this->id_ticket,true);
		$criteria->compare('fk_statut',$this->fk_statut,true);
		$criteria->compare('fk_categorie',$this->fk_categorie,true);
		$criteria->compare('fk_lieu',$this->fk_lieu,true);
		$criteria->compare('fk_user',$this->fk_user,true);
		$criteria->compare('version',$this->version,true);
		$criteria->compare('commentaire',$this->commentaire,true);
		$criteria->compare('fk_canal',$this->fk_canal);
=======
        $criteria->compare('id_ticket', $this->id_ticket, true);
        $criteria->compare('fk_statut', $this->fk_statut, true);
        $criteria->compare('fk_categorie', $this->fk_categorie, true);
        $criteria->compare('fk_lieu', $this->fk_lieu, true);
        $criteria->compare('fk_user', $this->fk_user, true);
        $criteria->compare('version', $this->version, true);
>>>>>>> 11491a7f40938f72ce5a9d8c131056ced1d02d27

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Ticket the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
