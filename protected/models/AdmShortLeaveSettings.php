<?php

/**
 * This is the model class for table "adm_short_leave_settings".
 *
 * The followings are the available columns in table 'adm_short_leave_settings':
 * @property integer $short_lv_id
 * @property integer $short_lv_duration
 * @property integer $max_leaves_per_day
 * @property integer $max_leaves_per_month
 * @property integer $max_leaves_per_year
 * @property integer $is_halfday_on_sameday
 * @property integer $is_extended
 * @property integer $is_halfday_deduct_for_late
 * @property string $short_lv_halfday_grace_mins
 * @property integer $short_leave_availability
 */
class AdmShortLeaveSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'adm_short_leave_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('short_lv_duration, max_leaves_per_day, max_leaves_per_month, max_leaves_per_year, is_halfday_on_sameday, is_extended, is_halfday_deduct_for_late, short_leave_availability', 'numerical', 'integerOnly'=>true),
			array('short_lv_halfday_grace_mins', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('short_lv_id, short_lv_duration, max_leaves_per_day, max_leaves_per_month, max_leaves_per_year, is_halfday_on_sameday, is_extended, is_halfday_deduct_for_late, short_lv_halfday_grace_mins, short_leave_availability', 'safe', 'on'=>'search'),
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
			'short_lv_id' => 'Short Lv',
			'short_lv_duration' => 'Short Lv Duration',
			'max_leaves_per_day' => 'Max Leaves Per Day',
			'max_leaves_per_month' => 'Max Leaves Per Month',
			'max_leaves_per_year' => 'Max Leaves Per Year',
			'is_halfday_on_sameday' => 'Is Halfday On Sameday',
			'is_extended' => 'Is Extended',
			'is_halfday_deduct_for_late' => 'Is Halfday Deduct For Late',
			'short_lv_halfday_grace_mins' => 'Short Lv Halfday Grace Mins',
			'short_leave_availability' => 'Short Leave Availability',
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

		$criteria->compare('short_lv_id',$this->short_lv_id);
		$criteria->compare('short_lv_duration',$this->short_lv_duration);
		$criteria->compare('max_leaves_per_day',$this->max_leaves_per_day);
		$criteria->compare('max_leaves_per_month',$this->max_leaves_per_month);
		$criteria->compare('max_leaves_per_year',$this->max_leaves_per_year);
		$criteria->compare('is_halfday_on_sameday',$this->is_halfday_on_sameday);
		$criteria->compare('is_extended',$this->is_extended);
		$criteria->compare('is_halfday_deduct_for_late',$this->is_halfday_deduct_for_late);
		$criteria->compare('short_lv_halfday_grace_mins',$this->short_lv_halfday_grace_mins,true);
		$criteria->compare('short_leave_availability',$this->short_leave_availability);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdmShortLeaveSettings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
