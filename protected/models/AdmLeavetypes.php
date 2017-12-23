<?php

/**
 * This is the model class for table "adm_leavetypes".
 *
 * The followings are the available columns in table 'adm_leavetypes':
 * @property integer $lt_id
 * @property string $lt_name
 * @property string $lt_max
 * @property integer $is_available_sup_one
 * @property integer $is_available_sup_two
 * @property integer $is_available_coverup
 * @property integer $is_available_attachments
 */
class AdmLeavetypes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'adm_leavetypes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lt_name, lt_max', 'required'),
			array('is_available_sup_one, is_available_sup_two, is_available_coverup, is_available_attachments', 'numerical', 'integerOnly'=>true),
			array('lt_name', 'length', 'max'=>255),
			array('lt_max', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('lt_id, lt_name, lt_max, is_available_sup_one, is_available_sup_two, is_available_coverup, is_available_attachments', 'safe', 'on'=>'search'),
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
			'lt_id' => 'Lt',
			'lt_name' => 'Lt Name',
			'lt_max' => 'Lt Max',
			'is_available_sup_one' => 'Is Available Sup One',
			'is_available_sup_two' => 'Is Available Sup Two',
			'is_available_coverup' => 'Is Available Coverup',
			'is_available_attachments' => 'Is Available Attachments',
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

		$criteria->compare('lt_id',$this->lt_id);
		$criteria->compare('lt_name',$this->lt_name,true);
		$criteria->compare('lt_max',$this->lt_max,true);
		$criteria->compare('is_available_sup_one',$this->is_available_sup_one);
		$criteria->compare('is_available_sup_two',$this->is_available_sup_two);
		$criteria->compare('is_available_coverup',$this->is_available_coverup);
		$criteria->compare('is_available_attachments',$this->is_available_attachments);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdmLeavetypes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
