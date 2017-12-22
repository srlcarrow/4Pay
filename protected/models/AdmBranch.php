<?php

/**
 * This is the model class for table "adm_branch".
 *
 * The followings are the available columns in table 'adm_branch':
 * @property integer $br_id
 * @property string $br_name
 * @property string $br_address
 * @property string $br_contact1
 * @property string $br_contact2
 */
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
			array('br_name, br_address, br_contact1, br_contact2', 'required'),
			array('br_name, br_address, br_contact1, br_contact2', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('br_id, br_name, br_address, br_contact1, br_contact2', 'safe', 'on'=>'search'),
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
			'br_contact1' => 'Br Contact1',
			'br_contact2' => 'Br Contact2',
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
		$criteria->compare('br_contact1',$this->br_contact1,true);
		$criteria->compare('br_contact2',$this->br_contact2,true);

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
