<?php

/**
 * This is the model class for table "att_allattendance".
 *
 * The followings are the available columns in table 'att_allattendance':
 * @property integer $id
 * @property string $emp_no
 * @property string $checktime
 * @property string $machine_serial_no
 * @property string $branch_id
 * @property integer $status
 * @property integer $punch_by
 */
class Allattendance extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'att_allattendance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emp_no, checktime, machine_serial_no, branch_id, status', 'required'),
			array('status, punch_by', 'numerical', 'integerOnly'=>true),
			array('emp_no, machine_serial_no, branch_id', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, emp_no, checktime, machine_serial_no, branch_id, status, punch_by', 'safe', 'on'=>'search'),
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
			'emp_no' => 'Emp No',
			'checktime' => 'Checktime',
			'machine_serial_no' => 'Machine Serial No',
			'branch_id' => 'Branch',
			'status' => 'Status',
			'punch_by' => 'Punch By',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('emp_no',$this->emp_no,true);
		$criteria->compare('checktime',$this->checktime,true);
		$criteria->compare('machine_serial_no',$this->machine_serial_no,true);
		$criteria->compare('branch_id',$this->branch_id,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('punch_by',$this->punch_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Allattendance the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
