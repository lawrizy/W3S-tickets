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
 * @property integer $fk_langue
 * @property integer $visible
 *
 * The followings are the available model relations:
 * @property Droit[] $droits
 * @property HistoriqueTicket[] $historiqueTickets
 * @property Lieu[] $lieus
 * @property Ticket[] $ticketsUser
 * @property Ticket[] $ticketsLocataire
 * @property Fonction $fkFonction
 * @property Langue $fkLangue
 */
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
            array('nom, email, password, fk_fonction, fk_langue', 'required'),
            array('fk_fonction, fk_langue, visible', 'numerical', 'integerOnly' => true),
            array('nom, email', 'length', 'max' => 64),
            array('password', 'length', 'max' => 32,'min'=>4),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_user, nom, email, password, fk_fonction, fk_langue, visible', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
        return array(
            'droits' => array(self::HAS_MANY, 'Droit', 'fk_user'),
            'historiqueTickets' => array(self::HAS_MANY, 'HistoriqueTicket', 'fk_user'),
            'lieus' => array(self::HAS_MANY, 'Lieu', 'fk_locataire'),
            'ticketsUser' => array(self::HAS_MANY, 'Ticket', 'fk_user'),
            'ticketsLocataire' => array(self::HAS_MANY, 'Ticket', 'fk_locataire'),
            'fkFonction' => array(self::BELONGS_TO, 'Fonction', 'fk_fonction'),
            'fkLangue' => array(self::BELONGS_TO, 'Langue', 'fk_langue'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_user' => Translate::trad('IdUser'),
            'nom' => Translate::trad('NomUser'),
            'email' => Translate::trad('EmailUser'),
            'password' => Translate::trad('MdpUser'),
            'fk_fonction' => Translate::trad('FonctionUser'),
            'fk_langue' => Translate::trad('LanguageUser'),
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
    public function searchUserAdmin() {
// @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id_user', $this->id_user);
        $criteria->compare('nom', $this->nom, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('fk_fonction', $this->fk_fonction = Constantes::FONCTION_USER);
        $criteria->compare('fk_langue', $this->fk_langue);
        $criteria->compare('visible', Constantes::VISIBLE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchLocataire() {
// @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id_user', $this->id_user);
        $criteria->compare('nom', $this->nom, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('fk_fonction', $this->fk_fonction = Constantes::FONCTION_LOCATAIRE);
        $criteria->compare('fk_langue', $this->fk_langue);
        $criteria->compare('visible', Constantes::VISIBLE);

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
