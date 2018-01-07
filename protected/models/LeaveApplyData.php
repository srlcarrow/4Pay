<?php

/**
 * This is the model class for table "leave_apply_data".
 *
 * The followings are the available columns in table 'leave_apply_data':
 * @property integer $lvd_id
 * @property integer $ref_lv_id
 * @property string $lvd_day
 * @property integer $lvd_is_halfday
 * @property integer $lvd_halfday_half
 */
class LeaveApplyData extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'leave_apply_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ref_lv_id, lvd_day', 'required'),
			array('ref_lv_id, lvd_is_halfday, lvd_halfday_half', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('lvd_id, ref_lv_id, lvd_day, lvd_is_halfday, lvd_halfday_half', 'safe', 'on'=>'search'),
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
			'lvd_id' => 'Lvd',
			'ref_lv_id' => 'Ref Lv',
			'lvd_day' => 'Lvd Day',
			'lvd_is_halfday' => 'Lvd Is Halfday',
			'lvd_halfday_half' => 'Lvd Halfday Half',
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

		$criteria->compare('lvd_id',$this->lvd_id);
		$criteria->compare('ref_lv_id',$this->ref_lv_id);
		$criteria->compare('lvd_day',$this->lvd_day,true);
		$criteria->compare('lvd_is_halfday',$this->lvd_is_halfday);
		$criteria->compare('lvd_halfday_half',$this->lvd_halfday_half);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LeaveApplyData the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
