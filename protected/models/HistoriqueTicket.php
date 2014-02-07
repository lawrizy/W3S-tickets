<?php

/**
 * This is the model class for table "w3sys_historique_ticket".
 *
 * The followings are the available columns in table 'w3sys_historique_ticket':
 * @property integer $id_historique_ticket
 * @property string $date_update
 * @property string $commentaire
 * @property string $id_ticket
 * @property string $id_statut_ticket
 *
 * The followings are the available model relations:
 * @property Ticket $idTicket
 * @property StatutTicket $idStatutTicket
 */
class HistoriqueTicket extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'w3sys_historique_ticket';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_historique_ticket, date_update, id_ticket, id_statut_ticket', 'required'),
			array('id_historique_ticket', 'numerical', 'integerOnly'=>true),
			array('id_ticket, id_statut_ticket', 'length', 'max'=>10),
			array('commentaire', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_historique_ticket, date_update, commentaire, id_ticket, id_statut_ticket', 'safe', 'on'=>'search'),
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
			'idTicket' => array(self::BELONGS_TO, 'Ticket', 'id_ticket'),
			'idStatutTicket' => array(self::BELONGS_TO, 'StatutTicket', 'id_statut_ticket'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_historique_ticket' => 'Id Historique Ticket',
			'date_update' => 'Date Update',
			'commentaire' => 'Commentaire',
			'id_ticket' => 'Id Ticket',
			'id_statut_ticket' => 'Id Statut Ticket',
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

		$criteria->compare('id_historique_ticket',$this->id_historique_ticket);
		$criteria->compare('date_update',$this->date_update,true);
		$criteria->compare('commentaire',$this->commentaire,true);
		$criteria->compare('id_ticket',$this->id_ticket,true);
		$criteria->compare('id_statut_ticket',$this->id_statut_ticket,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistoriqueTicket the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
