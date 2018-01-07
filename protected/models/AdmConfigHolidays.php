<?php

/**
 * This is the model class for table "adm_config_holidays".
 *
 * The followings are the available columns in table 'adm_config_holidays':
 * @property integer $holiday_id
 * @property string $holiday_name
 * @property integer $ref_holiday_type_id
 * @property string $holiday_date
 */
class AdmConfigHolidays extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'adm_config_holidays';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('holiday_name, ref_holiday_type_id, holiday_date', 'required'),
			array('ref_holiday_type_id', 'numerical', 'integerOnly'=>true),
			array('holiday_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('holiday_id, holiday_name, ref_holiday_type_id, holiday_date', 'safe', 'on'=>'search'),
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
			'holiday_id' => 'Holiday',
			'holiday_name' => 'Holiday Name',
			'ref_holiday_type_id' => 'Ref Holiday Type',
			'holiday_date' => 'Holiday Date',
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

		$criteria->compare('holiday_id',$this->holiday_id);
		$criteria->compare('holiday_name',$this->holiday_name,true);
		$criteria->compare('ref_holiday_type_id',$this->ref_holiday_type_id);
		$criteria->compare('holiday_date',$this->holiday_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdmConfigHolidays the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
