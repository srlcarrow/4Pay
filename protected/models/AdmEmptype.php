<?php

/**
 * This is the model class for table "adm_emptype".
 *
 * The followings are the available columns in table 'adm_emptype':
 * @property integer $etype_id
 * @property string $emp_type
 * @property string $period
 * @property string $probation_duration
 * @property integer $work_duration
 * @property integer $resignation_duration
 */
class AdmEmptype extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'adm_emptype';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emp_type, period, probation_duration, resignation_duration', 'required'),
			array('work_duration, resignation_duration', 'numerical', 'integerOnly'=>true),
			array('emp_type, period, probation_duration', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('etype_id, emp_type, period, probation_duration, work_duration, resignation_duration', 'safe', 'on'=>'search'),
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
			'etype_id' => 'Etype',
			'emp_type' => 'Emp Type',
			'period' => 'Period',
			'probation_duration' => 'Probation Duration',
			'work_duration' => 'Work Duration',
			'resignation_duration' => 'Resignation Duration',
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

		$criteria->compare('etype_id',$this->etype_id);
		$criteria->compare('emp_type',$this->emp_type,true);
		$criteria->compare('period',$this->period,true);
		$criteria->compare('probation_duration',$this->probation_duration,true);
		$criteria->compare('work_duration',$this->work_duration);
		$criteria->compare('resignation_duration',$this->resignation_duration);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdmEmptype the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
