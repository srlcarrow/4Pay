<?php

/**
 * This is the model class for table "att_attendance".
 *
 * The followings are the available columns in table 'att_attendance':
 * @property string $atten_id
 * @property integer $ref_emp_id
 * @property string $day
 * @property string $date_in
 * @property string $punch_in
 * @property string $date_out
 * @property string $punch_out
 * @property string $early_time
 * @property string $late_time
 * @property string $early_living
 * @property string $over_time
 * @property integer $ref_shift_id
 * @property integer $is_approved_attendance
 * @property string $punch_in_location
 * @property string $punch_out_location
 * @property integer $punch_in_status
 * @property integer $punch_out_status
 */
class Attendance extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'att_attendance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ref_emp_id, day, punch_in_status, punch_out_status', 'required'),
			array('ref_emp_id, ref_shift_id, is_approved_attendance, punch_in_status, punch_out_status', 'numerical', 'integerOnly'=>true),
			array('punch_in_location, punch_out_location', 'length', 'max'=>100),
			array('date_in, punch_in, date_out, punch_out, early_time, late_time, early_living, over_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('atten_id, ref_emp_id, day, date_in, punch_in, date_out, punch_out, early_time, late_time, early_living, over_time, ref_shift_id, is_approved_attendance, punch_in_location, punch_out_location, punch_in_status, punch_out_status', 'safe', 'on'=>'search'),
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
			'atten_id' => 'Atten',
			'ref_emp_id' => 'Ref Emp',
			'day' => 'Day',
			'date_in' => 'Date In',
			'punch_in' => 'Punch In',
			'date_out' => 'Date Out',
			'punch_out' => 'Punch Out',
			'early_time' => 'Early Time',
			'late_time' => 'Late Time',
			'early_living' => 'Early Living',
			'over_time' => 'Over Time',
			'ref_shift_id' => 'Ref Shift',
			'is_approved_attendance' => 'Is Approved Attendance',
			'punch_in_location' => 'Punch In Location',
			'punch_out_location' => 'Punch Out Location',
			'punch_in_status' => 'Punch In Status',
			'punch_out_status' => 'Punch Out Status',
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

		$criteria->compare('atten_id',$this->atten_id,true);
		$criteria->compare('ref_emp_id',$this->ref_emp_id);
		$criteria->compare('day',$this->day,true);
		$criteria->compare('date_in',$this->date_in,true);
		$criteria->compare('punch_in',$this->punch_in,true);
		$criteria->compare('date_out',$this->date_out,true);
		$criteria->compare('punch_out',$this->punch_out,true);
		$criteria->compare('early_time',$this->early_time,true);
		$criteria->compare('late_time',$this->late_time,true);
		$criteria->compare('early_living',$this->early_living,true);
		$criteria->compare('over_time',$this->over_time,true);
		$criteria->compare('ref_shift_id',$this->ref_shift_id);
		$criteria->compare('is_approved_attendance',$this->is_approved_attendance);
		$criteria->compare('punch_in_location',$this->punch_in_location,true);
		$criteria->compare('punch_out_location',$this->punch_out_location,true);
		$criteria->compare('punch_in_status',$this->punch_in_status);
		$criteria->compare('punch_out_status',$this->punch_out_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Attendance the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
