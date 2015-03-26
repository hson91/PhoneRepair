<?php

/**
 * This is the model class for table "configs_app".
 *
 * The followings are the available columns in table 'configs_app':
 * @property integer $id
 * @property integer $device_serial
 * @property string $image
 * @property string $logo
 * @property string $hotline
 * @property integer $version
 * @property integer $status
 */
class ConfigsApp extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConfigsApp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'configs_app';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('device_serial, image, logo, hotline, version, status', 'required'),
			array('device_serial, version, status', 'numerical', 'integerOnly'=>true),
			array('image, logo', 'length', 'max'=>255),
			array('hotline', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, device_serial, image, logo, hotline, version, status', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'device_serial' => 'Device Serial',
			'image' => 'Image',
			'logo' => 'Logo',
			'hotline' => 'Hotline',
			'version' => 'Version',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('device_serial',$this->device_serial);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('hotline',$this->hotline,true);
		$criteria->compare('version',$this->version);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}