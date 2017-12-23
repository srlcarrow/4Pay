<?php

class AdmBranch extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'adm_branch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('br_name', 'required'),
			array('br_tel, br_no_employees, br_fax', 'numerical', 'integerOnly'=>true),
			array('br_name, br_address, br_code', 'length', 'max'=>200),
			array('br_active', 'length', 'max'=>10),
			array('br_day, br_longitude, br_latitude', 'length', 'max'=>255),
			array('br_email', 'length', 'max'=>50),
			array('br_worktimestart, br_worktimeend', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('br_id, br_name, br_address, br_tel, br_no_employees, br_active, br_code, br_fax, br_day, br_worktimestart, br_worktimeend, br_email, br_longitude, br_latitude', 'safe', 'on'=>'search'),
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
			'br_id' => 'Br',
			'br_name' => 'Br Name',
			'br_address' => 'Br Address',
			'br_tel' => 'Br Tel',
			'br_no_employees' => 'Br No Employees',
			'br_active' => 'Br Active',
			'br_code' => 'Br Code',
			'br_fax' => 'Br Fax',
			'br_day' => 'Br Day',
			'br_worktimestart' => 'Br Worktimestart',
			'br_worktimeend' => 'Br Worktimeend',
			'br_email' => 'Br Email',
			'br_longitude' => 'Br Longitude',
			'br_latitude' => 'Br Latitude',
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

		$criteria->compare('br_id',$this->br_id);
		$criteria->compare('br_name',$this->br_name,true);
		$criteria->compare('br_address',$this->br_address,true);
		$criteria->compare('br_tel',$this->br_tel);
		$criteria->compare('br_no_employees',$this->br_no_employees);
		$criteria->compare('br_active',$this->br_active,true);
		$criteria->compare('br_code',$this->br_code,true);
		$criteria->compare('br_fax',$this->br_fax);
		$criteria->compare('br_day',$this->br_day,true);
		$criteria->compare('br_worktimestart',$this->br_worktimestart,true);
		$criteria->compare('br_worktimeend',$this->br_worktimeend,true);
		$criteria->compare('br_email',$this->br_email,true);
		$criteria->compare('br_longitude',$this->br_longitude,true);
		$criteria->compare('br_latitude',$this->br_latitude,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdmBranch the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
