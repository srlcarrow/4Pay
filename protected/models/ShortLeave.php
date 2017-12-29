<?php

/**
 * This is the model class for table "short_leave".
 *
 * The followings are the available columns in table 'short_leave':
 * @property integer $id
 * @property integer $ref_emp_id
 * @property integer $direct_approve
 * @property string $apply_date
 * @property string $approved_date
 * @property string $short_leave_date
 * @property string $purpose
 * @property string $start_time
 * @property string $end_time
 * @property integer $requested_by
 * @property string $status
 * @property integer $approver_id
 * @property integer $no_of_short_leaves
 * @property string $reject_reason
 */
class ShortLeave extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'short_leave';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ref_emp_id, direct_approve, apply_date, approved_date, short_leave_date, purpose, start_time, end_time, requested_by', 'required'),
			array('ref_emp_id, direct_approve, requested_by, approver_id, no_of_short_leaves', 'numerical', 'integerOnly'=>true),
			array('purpose, reject_reason', 'length', 'max'=>255),
			array('status', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ref_emp_id, direct_approve, apply_date, approved_date, short_leave_date, purpose, start_time, end_time, requested_by, status, approver_id, no_of_short_leaves, reject_reason', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'ref_emp_id' => 'Ref Emp',
			'direct_approve' => 'Direct Approve',
			'apply_date' => 'Apply Date',
			'approved_date' => 'Approved Date',
			'short_leave_date' => 'Short Leave Date',
			'purpose' => 'Purpose',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'requested_by' => 'Requested By',
			'status' => 'Status',
			'approver_id' => 'Approver',
			'no_of_short_leaves' => 'No Of Short Leaves',
			'reject_reason' => 'Reject Reason',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('ref_emp_id',$this->ref_emp_id);
		$criteria->compare('direct_approve',$this->direct_approve);
		$criteria->compare('apply_date',$this->apply_date,true);
		$criteria->compare('approved_date',$this->approved_date,true);
		$criteria->compare('short_leave_date',$this->short_leave_date,true);
		$criteria->compare('purpose',$this->purpose,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('requested_by',$this->requested_by);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('approver_id',$this->approver_id);
		$criteria->compare('no_of_short_leaves',$this->no_of_short_leaves);
		$criteria->compare('reject_reason',$this->reject_reason,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ShortLeave the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
