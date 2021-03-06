<?php

/**
 * This is the model class for table "w3sys_historique_ticket".
 *
 * The followings are the available columns in table 'w3sys_historique_ticket':
 * @property integer $id_historique_ticket
 * @property string $date_update
 * @property integer $fk_ticket
 * @property integer $fk_statut_ticket
 * @property integer $fk_user
 *
 * The followings are the available model relations:
 * @property Ticket $fkTicket
 * @property StatutTicket $fkStatutTicket
 * @property User $fkUser
 */
class HistoriqueTicket extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'w3sys_historique_ticket';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
            array('date_update, fk_ticket, fk_statut_ticket, fk_user', 'required', 'message' => 'Le champs {attribute} ne peut être vide.'),
            array('fk_ticket, fk_statut_ticket, fk_user', 'numerical', 'integerOnly' => true, 'message' => 'Le champs {attribute} ne peut contenir que des nombres.'),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
            array('id_historique_ticket, date_update, fk_ticket, fk_statut_ticket, fk_user', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
        return array(
            'fkTicket' => array(self::BELONGS_TO, 'Ticket', 'fk_ticket'),
            'fkStatutTicket' => array(self::BELONGS_TO, 'StatutTicket', 'fk_statut_ticket'),
            'fkUser' => array(self::BELONGS_TO, 'User', 'fk_user'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_historique_ticket' => 'Id Historique Ticket',
            'date_update' => 'Date Update',
            'fk_ticket' => 'Fk Ticket',
            'fk_statut_ticket' => 'Fk Statut Ticket',
            'fk_user' => 'Fk User',
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

        $criteria->compare('id_historique_ticket', $this->id_historique_ticket);
        $criteria->compare('date_update', $this->date_update, true);
        $criteria->compare('fk_ticket', $this->fk_ticket);
        $criteria->compare('fk_statut_ticket', $this->fk_statut_ticket);
        $criteria->compare('fk_user', $this->fk_user);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchByTicket($idTicket) {
// @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id_historique_ticket', $this->id_historique_ticket);
        $criteria->compare('date_update', $this->date_update, true);
        $criteria->compare('fk_ticket', $idTicket);
        $criteria->compare('fk_statut_ticket', $this->fk_statut_ticket);
        $criteria->compare('fk_user', $this->fk_user);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return HistoriqueTicket the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
