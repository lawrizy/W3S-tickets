<?php

/**
* This is the model class for table "w3sys_session".
*
* The followings are the available columns in table 'w3sys_session':
    * @property integer $id_session
    * @property string $fk_yiisession
    * @property string $email
    *
    * The followings are the available model relations:
            * @property Yiisession $fkYiisession
    */
class Session extends CActiveRecord
{
/**
* @return string the associated database table name
*/
public function tableName()
{
return 'w3sys_session';
}

/**
* @return array validation rules for model attributes.
*/
public function rules()
{
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
return array(
    array('fk_yiisession, email', 'required'),
    array('fk_yiisession', 'length', 'max'=>32),
    array('email', 'length', 'max'=>64),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
array('id_session, fk_yiisession, email', 'safe', 'on'=>'search'),
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
    'fkYiisession' => array(self::BELONGS_TO, 'Yiisession', 'fk_yiisession'),
);
}

/**
* @return array customized attribute labels (name=>label)
*/
public function attributeLabels()
{
return array(
    'id_session' => 'Id Session',
    'fk_yiisession' => 'Fk Yiisession',
    'email' => 'Email',
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

		$criteria->compare('id_session',$this->id_session);
		$criteria->compare('fk_yiisession',$this->fk_yiisession,true);
		$criteria->compare('email',$this->email,true);

return new CActiveDataProvider($this, array(
'criteria'=>$criteria,
));
}

/**
* Returns the static model of the specified AR class.
* Please note that you should have this exact method in all your CActiveRecord descendants!
* @param string $className active record class name.
* @return Session the static model class
*/
public static function model($className=__CLASS__)
{
return parent::model($className);
}
}
