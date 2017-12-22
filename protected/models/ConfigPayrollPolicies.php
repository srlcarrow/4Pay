<?php

/**
 * This is the model class for table "adm_config_payroll_policies".
 *
 * The followings are the available columns in table 'adm_config_payroll_policies':
 * @property integer $con_pp_id
 * @property string $con_pp_code
 * @property string $con_pp_description
 * @property string $con_pp_grace_period
 * @property integer $con_pp_ispay
 * @property integer $con_pp_is_enable_edit
 */
class ConfigPayrollPolicies extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'adm_config_payroll_policies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('con_pp_code, con_pp_description, con_pp_grace_period', 'required'),
			array('con_pp_ispay, con_pp_is_enable_edit', 'numerical', 'integerOnly'=>true),
			array('con_pp_code, con_pp_description', 'length', 'max'=>255),
			array('con_pp_grace_period', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('con_pp_id, con_pp_code, con_pp_description, con_pp_grace_period, con_pp_ispay, con_pp_is_enable_edit', 'safe', 'on'=>'search'),
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
			'con_pp_id' => 'Con Pp',
			'con_pp_code' => 'Con Pp Code',
			'con_pp_description' => 'Con Pp Description',
			'con_pp_grace_period' => 'Con Pp Grace Period',
			'con_pp_ispay' => 'Con Pp Ispay',
			'con_pp_is_enable_edit' => 'Con Pp Is Enable Edit',
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

		$criteria->compare('con_pp_id',$this->con_pp_id);
		$criteria->compare('con_pp_code',$this->con_pp_code,true);
		$criteria->compare('con_pp_description',$this->con_pp_description,true);
		$criteria->compare('con_pp_grace_period',$this->con_pp_grace_period,true);
		$criteria->compare('con_pp_ispay',$this->con_pp_ispay);
		$criteria->compare('con_pp_is_enable_edit',$this->con_pp_is_enable_edit);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ConfigPayrollPolicies the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
