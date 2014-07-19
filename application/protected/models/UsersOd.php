<?php

/**
 * This is the model class for table "users_od".
 *
 * The followings are the available columns in table 'users_od':
 * @property integer $id
 * @property string $ent_name
 * @property string $email
 * @property string $login_name
 * @property integer $type_id
 * @property string $password
 * @property integer $enabled
 *
 * The followings are the available model relations:
 * @property UserType $type
 * @property XmlFiles[] $xmlFiles
 * @property XmlFiles[] $xmlFiles1
 * @property DUMMY - xmlFilesVersioned[] $dUMMY - xmlFilesVersioneds
 */
class UsersOd extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'users_od';
    }

    public static function label($n = 1) {
        if ($n == 1) {
            return Yii::t('users_od', 'UsersOd', $n);
        } else {
            return Yii::t('users_od', 'UsersOds', $n);
        }
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
// NOTE BY MATE: If it possible please use scenario and default value
// array('ent_name', 'default', 'value' => Yii::app()->params[''], 'on' => 'insert_UsersOd'),
// array('ent_name', 'default', 'value' => Yii::app()->params[''], 'on' => 'update_UsersOd'),
// array('type_id', 'default', 'value' => Yii::app()->params[''], 'on' => 'insert_UsersOd'),
// array('type_id', 'default', 'value' => Yii::app()->params[''], 'on' => 'update_UsersOd'),
// array('password', 'default', 'value' => Yii::app()->params[''], 'on' => 'insert_UsersOd'),
// array('password', 'default', 'value' => Yii::app()->params[''], 'on' => 'update_UsersOd'),
// array('enabled', 'default', 'value' => Yii::app()->params[''], 'on' => 'insert_UsersOd'),
// array('enabled', 'default', 'value' => Yii::app()->params[''], 'on' => 'update_UsersOd'),

            array('ent_name, type_id, password, enabled', 'required'),
            array('type_id, enabled', 'numerical', 'integerOnly' => true),
            array('ent_name, email, login_name, password', 'length', 'max' => 255),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
            array('id, ent_name, email, login_name, type_id, password, enabled', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
        return array(
            'type' => array(self::BELONGS_TO, 'UserType', 'type_id'),
            'xmlFiles' => array(self::HAS_MANY, 'XmlFiles', 'modifieduser_id'),
            'xmlFiles1' => array(self::HAS_MANY, 'XmlFiles', 'owner'),
            'dUMMY - xmlFilesVersioneds' => array(self::HAS_MANY, 'DUMMY - xmlFilesVersioned', 'modified_user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('UsersOd', 'ID'),
            'ent_name' => Yii::t('UsersOd', 'Ent Name'),
            'email' => Yii::t('UsersOd', 'Email'),
            'login_name' => Yii::t('UsersOd', 'Login Name'),
            'type_id' => Yii::t('UsersOd', 'Type'),
            'password' => Yii::t('UsersOd', 'Password'),
            'enabled' => Yii::t('UsersOd', 'Enabled'),
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

        $criteria->compare('id', $this->id);
        $criteria->compare('ent_name', $this->ent_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('login_name', $this->login_name, true);
        $criteria->compare('type_id', $this->type_id);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('enabled', $this->enabled);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UsersOd the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
