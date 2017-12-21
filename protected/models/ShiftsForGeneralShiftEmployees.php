<?php

/**
 * This is the model class for table "adm_generalshifts_for_employees".
 *
 * The followings are the available columns in table 'adm_generalshifts_for_employees':
 * @property integer $id
 * @property integer $ref_emp_id
 * @property string $day
 * @property integer $ref_shift_id
 */
class ShiftsForGeneralShiftEmployees extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'adm_generalshifts_for_employees';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ref_emp_id, day, ref_shift_id', 'required'),
            array('ref_emp_id, ref_shift_id', 'numerical', 'integerOnly' => true),
            array('day', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, ref_emp_id, day, ref_shift_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'rel_generalshift' => array(self::BELONGS_TO, 'Rostershift', 'ref_shift_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'ref_emp_id' => 'Ref Emp',
            'day' => 'Day',
            'ref_shift_id' => 'Ref Shift',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('ref_emp_id', $this->ref_emp_id);
        $criteria->compare('day', $this->day, true);
        $criteria->compare('ref_shift_id', $this->ref_shift_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ShiftsForGeneralShiftEmployees the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
