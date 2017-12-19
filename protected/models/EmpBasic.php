<?php

/**
 * This is the model class for table "emp_basic".
 *
 * The followings are the available columns in table 'emp_basic':
 * @property integer $emp_id
 * @property string $empno
 * @property string $attendance_no
 * @property string $epf_no
 * @property string $emp_title
 * @property string $emp_display_name
 * @property string $emp_full_name
 * @property string $emp_name_with_initials
 * @property string $emp_gender
 * @property string $emp_civil_status
 * @property string $emp_dob
 * @property string $ref_race
 * @property string $emp_nic
 * @property integer $ref_religion
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class EmpBasic extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'emp_basic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('empno, attendance_no, epf_no, emp_title, emp_display_name, emp_full_name, emp_name_with_initials, emp_gender, emp_civil_status, emp_dob, ref_race, emp_nic, ref_religion, created_date, created_by, updated_date, updated_by', 'required'),
			array('ref_religion, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('empno, attendance_no, epf_no, emp_title, emp_gender, emp_civil_status, emp_dob, ref_race, emp_nic', 'length', 'max'=>255),
			array('emp_display_name, emp_full_name, emp_name_with_initials', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('emp_id, empno, attendance_no, epf_no, emp_title, emp_display_name, emp_full_name, emp_name_with_initials, emp_gender, emp_civil_status, emp_dob, ref_race, emp_nic, ref_religion, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
			'emp_id' => 'Emp',
			'empno' => 'Empno',
			'attendance_no' => 'Attendance No',
			'epf_no' => 'Epf No',
			'emp_title' => 'Emp Title',
			'emp_display_name' => 'Emp Display Name',
			'emp_full_name' => 'Emp Full Name',
			'emp_name_with_initials' => 'Emp Name With Initials',
			'emp_gender' => 'Emp Gender',
			'emp_civil_status' => 'Emp Civil Status',
			'emp_dob' => 'Emp Dob',
			'ref_race' => 'Ref Race',
			'emp_nic' => 'Emp Nic',
			'ref_religion' => 'Ref Religion',
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

		$criteria->compare('emp_id',$this->emp_id);
		$criteria->compare('empno',$this->empno,true);
		$criteria->compare('attendance_no',$this->attendance_no,true);
		$criteria->compare('epf_no',$this->epf_no,true);
		$criteria->compare('emp_title',$this->emp_title,true);
		$criteria->compare('emp_display_name',$this->emp_display_name,true);
		$criteria->compare('emp_full_name',$this->emp_full_name,true);
		$criteria->compare('emp_name_with_initials',$this->emp_name_with_initials,true);
		$criteria->compare('emp_gender',$this->emp_gender,true);
		$criteria->compare('emp_civil_status',$this->emp_civil_status,true);
		$criteria->compare('emp_dob',$this->emp_dob,true);
		$criteria->compare('ref_race',$this->ref_race,true);
		$criteria->compare('emp_nic',$this->emp_nic,true);
		$criteria->compare('ref_religion',$this->ref_religion);
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
	 * @return EmpBasic the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
