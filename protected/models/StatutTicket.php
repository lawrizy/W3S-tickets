<?php

/**
 * This is the model class for table "w3sys_statut_ticket".
 *
 * The followings are the available columns in table 'w3sys_statut_ticket':
 * @property integer $id_statut_ticket
 * @property string $label
 *
 * The followings are the available model relations:
 * @property HistoriqueTicket[] $historiqueTickets
 * @property Ticket[] $tickets
 */
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
            array('label', 'required', 'message' => Translate::trad('Required')),
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
            'tickets' => array(self::HAS_MANY, 'Ticket', 'fk_statut'),
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

        $criteria->compare('id_statut_ticket', $this->id_statut_ticket, true);
        $criteria->compare('label', $this->label, true);

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

}
