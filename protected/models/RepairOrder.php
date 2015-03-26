<?php

/**
 * This is the model class for table "RepairOrder".
 *
 * The followings are the available columns in table 'repair_order':
 * @property integer $id
 * @property string $email
 * @property string $device_serial
 * @property string $device_name
 * @property integer $status
 */
class RepairOrder extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RepairOrder the static model class
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
		return 'repair_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('device_serial, status', 'required'),
			array('device_serial', 'length', 'max'=>12,'min'=>12),
			array('id,email, device_serial, device_name, comments, device_token, status', 'safe'),
			array('id,email, device_serial, device_name, comments, device_token, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'address' => 'Address',
			'device_serial' => 'Device Serial',
			'device_name' => 'Device Name',
            'comments' => 'Comments',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('device_serial',$this->device_serial,true);
		$criteria->compare('device_name',$this->device_name,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}