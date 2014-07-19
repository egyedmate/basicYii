<?php

/**
* This is the model class for table "user_type".
*
* The followings are the available columns in table 'user_type':
    * @property string $id
    * @property string $ent_name
    *
    * The followings are the available model relations:
            * @property Users[] $users
    */
class UserType extends CActiveRecord
{
/**
* @return string the associated database table name
*/
public function tableName()
{
return 'user_type';
}

public static function label($n = 1) {
if($n == 1){
return Yii::t('user_type', 'UserType', $n);
}else{
return Yii::t('user_type', 'UserTypes', $n);
}
}

/**
* @return array validation rules for model attributes.
*/
public function rules()
{
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
return array(
// NOTE BY MATE: If it possible please use scenario and default value

// array('ent_name', 'default', 'value' => Yii::app()->params[''], 'on' => 'insert_user_type'),
// array('ent_name', 'default', 'value' => Yii::app()->params[''], 'on' => 'update_user_type'),

    array('ent_name', 'required'),
    array('ent_name', 'length', 'max'=>255),
 
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
array('id, ent_name', 'safe', 'on'=>'search'),
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
    'users' => array(self::HAS_MANY, 'Users', 'type_id'),
);
}

/**
* @return array customized attribute labels (name=>label)
*/
public function attributeLabels()
{
return array(
    'id' => Yii::t('user_type','ID'),
    'ent_name' => Yii::t('user_type','Ent Name'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('ent_name',$this->ent_name,true);

return new CActiveDataProvider($this, array(
'criteria'=>$criteria,
));
}

/**
* Returns the static model of the specified AR class.
* Please note that you should have this exact method in all your CActiveRecord descendants!
* @param string $className active record class name.
* @return UserType the static model class
*/
public static function model($className=__CLASS__)
{
return parent::model($className);
}
}
