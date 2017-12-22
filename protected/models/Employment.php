<?php

/**
 * This is the model class for table "emp_employment".
 *
 * The followings are the available columns in table 'emp_employment':
 * @property integer $empl_id
 * @property integer $ref_emp_id
 * @property string $empl_joined_date
 * @property integer $ref_employment_type
 * @property integer $ref_branch_id
 * @property integer $ref_designation
 * @property integer $ref_section_id
 * @property integer $ref_employment_category
 * @property integer $ref_attendance_group
 * @property string $empl_employment_status
 * @property string $empl_resigned_date
 * @property integer $is_generalshift_emp
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class Employment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'emp_employment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ref_emp_id, empl_joined_date, ref_employment_type, ref_branch_id, ref_designation, ref_section_id, ref_employment_category, ref_attendance_group, empl_employment_status, empl_resigned_date, is_generalshift_emp, created_date, created_by, updated_date, updated_by', 'required'),
			array('ref_emp_id, ref_employment_type, ref_branch_id, ref_designation, ref_section_id, ref_employment_category, ref_attendance_group, is_generalshift_emp, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('empl_employment_status', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('empl_id, ref_emp_id, empl_joined_date, ref_employment_type, ref_branch_id, ref_designation, ref_section_id, ref_employment_category, ref_attendance_group, empl_employment_status, empl_resigned_date, is_generalshift_emp, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
			'empl_id' => 'Empl',
			'ref_emp_id' => 'Ref Emp',
			'empl_joined_date' => 'Empl Joined Date',
			'ref_employment_type' => 'Ref Employment Type',
			'ref_branch_id' => 'Ref Branch',
			'ref_designation' => 'Ref Designation',
			'ref_section_id' => 'Ref Section',
			'ref_employment_category' => 'Ref Employment Category',
			'ref_attendance_group' => 'Ref Attendance Group',
			'empl_employment_status' => 'Empl Employment Status',
			'empl_resigned_date' => 'Empl Resigned Date',
			'is_generalshift_emp' => 'Is Generalshift Emp',
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

		$criteria->compare('empl_id',$this->empl_id);
		$criteria->compare('ref_emp_id',$this->ref_emp_id);
		$criteria->compare('empl_joined_date',$this->empl_joined_date,true);
		$criteria->compare('ref_employment_type',$this->ref_employment_type);
		$criteria->compare('ref_branch_id',$this->ref_branch_id);
		$criteria->compare('ref_designation',$this->ref_designation);
		$criteria->compare('ref_section_id',$this->ref_section_id);
		$criteria->compare('ref_employment_category',$this->ref_employment_category);
		$criteria->compare('ref_attendance_group',$this->ref_attendance_group);
		$criteria->compare('empl_employment_status',$this->empl_employment_status,true);
		$criteria->compare('empl_resigned_date',$this->empl_resigned_date,true);
		$criteria->compare('is_generalshift_emp',$this->is_generalshift_emp);
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
	 * @return Employment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}