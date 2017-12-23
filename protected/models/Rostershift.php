<?php

/**
 * This is the model class for table "adm_rostershift".
 *
 * The followings are the available columns in table 'adm_rostershift':
 * @property integer $shift_id
 * @property string $shift_code
 * @property string $shift_title
 * @property string $start_time
 * @property string $end_time
 * @property string $shift_in_till
 * @property integer $is_shiftintill_nextday
 * @property integer $is_night_shift
 * @property string $halfday_secs
 * @property string $shift_in_upto
 * @property string $shft_out_upto
 * @property integer $is_shift_out_upto_nextday
 */
class Rostershift extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'adm_rostershift';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shift_title, start_time, end_time, shift_in_till', 'required'),
			array('is_shiftintill_nextday, is_night_shift, is_shift_out_upto_nextday', 'numerical', 'integerOnly'=>true),
			array('shift_code', 'length', 'max'=>2),
			array('shift_title', 'length', 'max'=>100),
			array('halfday_secs', 'length', 'max'=>10),
			array('shift_in_upto, shft_out_upto', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('shift_id, shift_code, shift_title, start_time, end_time, shift_in_till, is_shiftintill_nextday, is_night_shift, halfday_secs, shift_in_upto, shft_out_upto, is_shift_out_upto_nextday', 'safe', 'on'=>'search'),
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
			'shift_id' => 'Shift',
			'shift_code' => 'Shift Code',
			'shift_title' => 'Shift Title',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'shift_in_till' => 'Shift In Till',
			'is_shiftintill_nextday' => 'Is Shiftintill Nextday',
			'is_night_shift' => 'Is Night Shift',
			'halfday_secs' => 'Halfday Secs',
			'shift_in_upto' => 'Shift In Upto',
			'shft_out_upto' => 'Shft Out Upto',
			'is_shift_out_upto_nextday' => 'Is Shift Out Upto Nextday',
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

		$criteria->compare('shift_id',$this->shift_id);
		$criteria->compare('shift_code',$this->shift_code,true);
		$criteria->compare('shift_title',$this->shift_title,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('shift_in_till',$this->shift_in_till,true);
		$criteria->compare('is_shiftintill_nextday',$this->is_shiftintill_nextday);
		$criteria->compare('is_night_shift',$this->is_night_shift);
		$criteria->compare('halfday_secs',$this->halfday_secs,true);
		$criteria->compare('shift_in_upto',$this->shift_in_upto,true);
		$criteria->compare('shft_out_upto',$this->shft_out_upto,true);
		$criteria->compare('is_shift_out_upto_nextday',$this->is_shift_out_upto_nextday);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Rostershift the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
