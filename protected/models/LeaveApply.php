<?php

/**
 * This is the model class for table "leave_apply".
 *
 * The followings are the available columns in table 'leave_apply':
 * @property integer $lv_id
 * @property string $lv_apply_date
 * @property integer $ref_emp_id
 * @property integer $ref_lv_type_id
 * @property string $lv_from
 * @property string $lv_to
 * @property integer $lv_coverup_id
 * @property integer $lv_first_sup_id
 * @property integer $lv_sec_sup_id
 * @property integer $lv_coverup_approved
 * @property integer $lv_first_sup_approved
 * @property integer $lv_sec_sup_approved
 * @property string $lv_coverup_approved_date
 * @property string $lv_first_sup_approved_date
 * @property string $lv_sec_sup_approved_date
 * @property string $lv_created_date
 * @property integer $lv_created_by
 */
class LeaveApply extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'leave_apply';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lv_apply_date, ref_emp_id, ref_lv_type_id, lv_from, lv_to, lv_coverup_id, lv_first_sup_id, lv_sec_sup_id, lv_created_date, lv_created_by', 'required'),
			array('ref_emp_id, ref_lv_type_id, lv_coverup_id, lv_first_sup_id, lv_sec_sup_id, lv_coverup_approved, lv_first_sup_approved, lv_sec_sup_approved, lv_created_by', 'numerical', 'integerOnly'=>true),
			array('lv_coverup_approved_date, lv_first_sup_approved_date, lv_sec_sup_approved_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('lv_id, lv_apply_date, ref_emp_id, ref_lv_type_id, lv_from, lv_to, lv_coverup_id, lv_first_sup_id, lv_sec_sup_id, lv_coverup_approved, lv_first_sup_approved, lv_sec_sup_approved, lv_coverup_approved_date, lv_first_sup_approved_date, lv_sec_sup_approved_date, lv_created_date, lv_created_by', 'safe', 'on'=>'search'),
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
			'lv_id' => 'Lv',
			'lv_apply_date' => 'Lv Apply Date',
			'ref_emp_id' => 'Ref Emp',
			'ref_lv_type_id' => 'Ref Lv Type',
			'lv_from' => 'Lv From',
			'lv_to' => 'Lv To',
			'lv_coverup_id' => 'Lv Coverup',
			'lv_first_sup_id' => 'Lv First Sup',
			'lv_sec_sup_id' => 'Lv Sec Sup',
			'lv_coverup_approved' => 'Lv Coverup Approved',
			'lv_first_sup_approved' => 'Lv First Sup Approved',
			'lv_sec_sup_approved' => 'Lv Sec Sup Approved',
			'lv_coverup_approved_date' => 'Lv Coverup Approved Date',
			'lv_first_sup_approved_date' => 'Lv First Sup Approved Date',
			'lv_sec_sup_approved_date' => 'Lv Sec Sup Approved Date',
			'lv_created_date' => 'Lv Created Date',
			'lv_created_by' => 'Lv Created By',
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

		$criteria->compare('lv_id',$this->lv_id);
		$criteria->compare('lv_apply_date',$this->lv_apply_date,true);
		$criteria->compare('ref_emp_id',$this->ref_emp_id);
		$criteria->compare('ref_lv_type_id',$this->ref_lv_type_id);
		$criteria->compare('lv_from',$this->lv_from,true);
		$criteria->compare('lv_to',$this->lv_to,true);
		$criteria->compare('lv_coverup_id',$this->lv_coverup_id);
		$criteria->compare('lv_first_sup_id',$this->lv_first_sup_id);
		$criteria->compare('lv_sec_sup_id',$this->lv_sec_sup_id);
		$criteria->compare('lv_coverup_approved',$this->lv_coverup_approved);
		$criteria->compare('lv_first_sup_approved',$this->lv_first_sup_approved);
		$criteria->compare('lv_sec_sup_approved',$this->lv_sec_sup_approved);
		$criteria->compare('lv_coverup_approved_date',$this->lv_coverup_approved_date,true);
		$criteria->compare('lv_first_sup_approved_date',$this->lv_first_sup_approved_date,true);
		$criteria->compare('lv_sec_sup_approved_date',$this->lv_sec_sup_approved_date,true);
		$criteria->compare('lv_created_date',$this->lv_created_date,true);
		$criteria->compare('lv_created_by',$this->lv_created_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LeaveApply the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
