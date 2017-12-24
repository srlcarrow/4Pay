<?php

/**
 * This is the model class for table "emp_contacts".
 *
 * The followings are the available columns in table 'emp_contacts':
 * @property integer $con_id
 * @property integer $ref_emp_id
 * @property string $con_permenant_add
 * @property string $con_temp_add
 * @property string $con_office_email
 * @property string $con_personal_email
 * @property string $con_mobile1
 * @property string $con_mobile2
 * @property string $con_home_tel
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class EmpContacts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'emp_contacts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ref_emp_id, con_permenant_add, con_temp_add, con_office_email, con_personal_email, con_mobile1, con_mobile2, con_home_tel, created_date, created_by, updated_date, updated_by', 'required'),
			array('ref_emp_id, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('con_office_email, con_personal_email, con_mobile1, con_mobile2, con_home_tel', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('con_id, ref_emp_id, con_permenant_add, con_temp_add, con_office_email, con_personal_email, con_mobile1, con_mobile2, con_home_tel, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
			'con_id' => 'Con',
			'ref_emp_id' => 'Ref Emp',
			'con_permenant_add' => 'Con Permenant Add',
			'con_temp_add' => 'Con Temp Add',
			'con_office_email' => 'Con Office Email',
			'con_personal_email' => 'Con Personal Email',
			'con_mobile1' => 'Con Mobile1',
			'con_mobile2' => 'Con Mobile2',
			'con_home_tel' => 'Con Home Tel',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
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

		$criteria->compare('con_id',$this->con_id);
		$criteria->compare('ref_emp_id',$this->ref_emp_id);
		$criteria->compare('con_permenant_add',$this->con_permenant_add,true);
		$criteria->compare('con_temp_add',$this->con_temp_add,true);
		$criteria->compare('con_office_email',$this->con_office_email,true);
		$criteria->compare('con_personal_email',$this->con_personal_email,true);
		$criteria->compare('con_mobile1',$this->con_mobile1,true);
		$criteria->compare('con_mobile2',$this->con_mobile2,true);
		$criteria->compare('con_home_tel',$this->con_home_tel,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('updated_by',$this->updated_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmpContacts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
