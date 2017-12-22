<?php

/**
 * This is the model class for table "user_permission".
 *
 * The followings are the available columns in table 'user_permission':
 * @property integer $up_id
 * @property integer $ref_ut_id
 * @property integer $ref_link_id
 * @property integer $is_view
 */
class UserPermission extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_permission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ref_ut_id, ref_link_id, is_view', 'required'),
			array('ref_ut_id, ref_link_id, is_view', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('up_id, ref_ut_id, ref_link_id, is_view', 'safe', 'on'=>'search'),
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
			'up_id' => 'Up',
			'ref_ut_id' => 'Ref Ut',
			'ref_link_id' => 'Ref Link',
			'is_view' => 'Is View',
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

		$criteria->compare('up_id',$this->up_id);
		$criteria->compare('ref_ut_id',$this->ref_ut_id);
		$criteria->compare('ref_link_id',$this->ref_link_id);
		$criteria->compare('is_view',$this->is_view);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserPermission the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
