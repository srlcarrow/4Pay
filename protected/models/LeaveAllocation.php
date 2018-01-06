<?php

/**
 * This is the model class for table "leave_allocation".
 *
 * The followings are the available columns in table 'leave_allocation':
 * @property integer $la_id
 * @property integer $ref_emp_id
 * @property integer $ref_lv_type_id
 * @property string $la_allocated_amount
 * @property string $la_available_amount
 * @property integer $created_by
 * @property string $created_date
 * @property integer $updated_by
 * @property string $updated_date
 */
class LeaveAllocation extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'leave_allocation';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('la_id, created_date, updated_date', 'required'),
            array('la_id, ref_emp_id, ref_lv_type_id, created_by, updated_by', 'numerical', 'integerOnly' => true),
            array('la_allocated_amount', 'length', 'max' => 18),
            array('la_available_amount', 'length', 'max' => 8),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('la_id, ref_emp_id, ref_lv_type_id, la_allocated_amount, la_available_amount, created_by, created_date, updated_by, updated_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
             'rel_leavetype' => array(self::BELONGS_TO, 'AdmLeavetypes', 'ref_lv_type_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'la_id' => 'La',
            'ref_emp_id' => 'Ref Emp',
            'ref_lv_type_id' => 'Ref Lv Type',
            'la_allocated_amount' => 'La Allocated Amount',
            'la_available_amount' => 'La Available Amount',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('la_id', $this->la_id);
        $criteria->compare('ref_emp_id', $this->ref_emp_id);
        $criteria->compare('ref_lv_type_id', $this->ref_lv_type_id);
        $criteria->compare('la_allocated_amount', $this->la_allocated_amount, true);
        $criteria->compare('la_available_amount', $this->la_available_amount, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('updated_by', $this->updated_by);
        $criteria->compare('updated_date', $this->updated_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return LeaveAllocation the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
