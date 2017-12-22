<?php

/**
 * This is the model class for table "att_attendance".
 *
 * The followings are the available columns in table 'att_attendance':
 * @property string $atten_id
 * @property integer $ref_emp_id
 * @property string $day
 * @property string $date_in
 * @property string $punch_in
 * @property string $date_out
 * @property string $punch_out
 * @property string $early_time
 * @property string $late_time
 * @property string $early_living
 * @property string $over_time
 * @property integer $ref_shift_id
 * @property integer $is_approved_attendance
 * @property string $punch_in_location
 * @property string $punch_out_location
 * @property integer $punch_in_status
 * @property integer $punch_out_status
 */
class DailyAttendance extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'att_attendance';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ref_emp_id, day, punch_in_status, punch_out_status', 'required'),
            array('ref_emp_id, ref_shift_id, is_approved_attendance, punch_in_status, punch_out_status', 'numerical', 'integerOnly' => true),
            array('punch_in_location, punch_out_location', 'length', 'max' => 100),
            array('date_in, punch_in, date_out, punch_out, early_time, late_time, early_living, over_time', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('atten_id, ref_emp_id, day, date_in, punch_in, date_out, punch_out, early_time, late_time, early_living, over_time, ref_shift_id, is_approved_attendance, punch_in_location, punch_out_location, punch_in_status, punch_out_status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'atten_id' => 'Atten',
            'ref_emp_id' => 'Ref Emp',
            'day' => 'Day',
            'date_in' => 'Date In',
            'punch_in' => 'Punch In',
            'date_out' => 'Date Out',
            'punch_out' => 'Punch Out',
            'early_time' => 'Early Time',
            'late_time' => 'Late Time',
            'early_living' => 'Early Living',
            'over_time' => 'Over Time',
            'ref_shift_id' => 'Ref Shift',
            'is_approved_attendance' => 'Is Approved Attendance',
            'punch_in_location' => 'Punch In Location',
            'punch_out_location' => 'Punch Out Location',
            'punch_in_status' => 'Punch In Status',
            'punch_out_status' => 'Punch Out Status',
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

        $criteria->compare('atten_id', $this->atten_id, true);
        $criteria->compare('ref_emp_id', $this->ref_emp_id);
        $criteria->compare('day', $this->day, true);
        $criteria->compare('date_in', $this->date_in, true);
        $criteria->compare('punch_in', $this->punch_in, true);
        $criteria->compare('date_out', $this->date_out, true);
        $criteria->compare('punch_out', $this->punch_out, true);
        $criteria->compare('early_time', $this->early_time, true);
        $criteria->compare('late_time', $this->late_time, true);
        $criteria->compare('early_living', $this->early_living, true);
        $criteria->compare('over_time', $this->over_time, true);
        $criteria->compare('ref_shift_id', $this->ref_shift_id);
        $criteria->compare('is_approved_attendance', $this->is_approved_attendance);
        $criteria->compare('punch_in_location', $this->punch_in_location, true);
        $criteria->compare('punch_out_location', $this->punch_out_location, true);
        $criteria->compare('punch_in_status', $this->punch_in_status);
        $criteria->compare('punch_out_status', $this->punch_out_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Attendance the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getEmpWorkshift($ref_emp_id, $date) {
        $arr = array();
        $isgeneralshift_emp = Employment::model()->findByAttributes(array('ref_emp_id' => $ref_emp_id));

        if ($isgeneralshift_emp->is_generalshift_emp == 1) {
            $shiftData = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $ref_emp_id, 'day' => date('l', strtotime($date))));
            $shiftIdFor = $shiftData->rel_generalshift->shift_id;
        } else {
            $roster_rows = Roster::model()->findByAttributes(array('ref_emp_id' => $ref_emp_id, 'roster_date' => $date));
            $shiftIdFor = $roster_rows->rel_rostershift->shift_id;
        }

        if ($isgeneralshift_emp->is_generalshift_emp == 1) {
            //General Shift Employees
            if (count($isgeneralshift_emp) > 0) {
                $shiftId = $shiftData->rel_generalshift->shift_id;
                $shift_start = $date . " " . $shiftData->rel_generalshift->start_time;
                $shift_end = $date . " " . $shiftData->rel_generalshift->end_time;
                $isnightshift = $shiftData->rel_generalshift->is_night_shift;
                $halfDaySeconds = $shiftData->rel_generalshift->halfday_secs;
                $shiftName = $shiftData->rel_generalshift->shift_title;
                $shift_in_till = $shiftData->rel_generalshift->is_shiftintill_nextday == 1 ? date('Y-m-d H:i:s', strtotime($date . " " . $shiftData->rel_generalshift->shift_in_till . "+1 days")) : $date . " " . $shiftData->rel_generalshift->shift_in_till;
                $shiftInUpto = $date . " " . $shiftData->rel_generalshift->shift_in_upto;
                $shiftOutUpto = $shiftData->rel_generalshift->is_shift_out_upto_nextday == 1 ? date('Y-m-d H:i:s', strtotime($date . " " . $shiftData->rel_generalshift->shft_out_upto . "+1 days")) : $date . " " . $shiftData->rel_generalshift->shft_out_upto;
                $shiftCode = $shiftData->rel_generalshift->shift_code;

                $arr[0] = $shift_start;
                $arr[1] = $shift_end;
                $arr[2] = $isnightshift;
                $arr[7] = $shift_in_till;
                $arr[8] = $shiftId;
                $arr[9] = $shiftCode;
                $arr[13] = $halfDaySeconds;
                $arr[15] = $shiftName;
                $arr[17] = $shiftInUpto;
                $arr[18] = $shiftOutUpto;

                return $arr;
            } else {
                return null;
            }
        } else {
            //Roster Employees
            if (count($roster_rows) > 0) {
                $shiftId = $roster_rows->rel_rostershift->shift_id;
                $shift_start = $date . " " . $roster_rows->rel_rostershift->start_time;
                $shift_end = $date . " " . $roster_rows->rel_rostershift->end_time;
                $isnightshift = $roster_rows->rel_rostershift->is_night_shift;
                $issplitshift = $roster_rows->rel_rostershift->is_split_shift;
                $shift_start_two = $date . " " . $roster_rows->rel_rostershift->start_time_two;
                $shift_end_two = $date . " " . $roster_rows->rel_rostershift->end_time_two;
                $day_split_after = $roster_rows->rel_rostershift->day_split_after;
                $halfDaySeconds = $roster_rows->rel_rostershift->halfday_secs;
                $shortLeaveSeconds = $roster_rows->rel_rostershift->shortleave_secs;
                $shiftName = $roster_rows->rel_rostershift->shift_title;
                $isEnableHalfDayForHoliday = $roster_rows->rel_rostershift->is_enable_holiday_halfdays;
                $shift_in_till = $date . " " . $roster_rows->rel_rostershift->shift_in_till;
                $shiftInUpto = $date . " " . $roster_rows->rel_rostershift->shift_in_upto;
                $shiftOutUpto = $roster_rows->rel_rostershift->is_shift_out_upto_nextday == 1 ? date('Y-m-d H:i:s', strtotime($date . " " . $roster_rows->rel_rostershift->shft_out_upto) + 24 * 3600) : $date . " " . $roster_rows->rel_rostershift->shft_out_upto;
                $otOutFrom = $roster_rows->rel_rostershift->ot_out_from_nextday == 1 ? date('Y-m-d H:i:s', strtotime($date . " " . $roster_rows->rel_rostershift->ot_out_from . "+1 days")) : $date . " " . $roster_rows->rel_rostershift->ot_out_from;
                $otOutUntill = $roster_rows->rel_rostershift->ot_out_untill_nextday == 1 ? date('Y-m-d H:i:s', strtotime($date . " " . $roster_rows->rel_rostershift->ot_out_untill) + 24 * 3600) : $date . " " . $roster_rows->rel_rostershift->ot_out_untill;
                $shiftCode = $roster_rows->rel_rostershift->shift_code;

                if (($holidayData[0]['hchsd_is_half_day'] == 1 && $holidayData[0]['hchsd_halfday_half'] == 1)) {
                    $shift_end = date('Y-m-d H:i:s', strtotime($shift_start) + $halfDaySeconds);
                } elseif (($holidayData[0]['hchsd_is_half_day'] == 1 && $holidayData[0]['hchsd_halfday_half'] == 2)) {
                    $shift_start = date('Y-m-d H:i:s', strtotime($shift_start) + $halfDaySeconds);
                }


                $arr[0] = $shift_start;
                $arr[1] = $shift_end;
                $arr[2] = $isnightshift;
                $arr[3] = $issplitshift;
                $arr[4] = $shift_start_two;
                $arr[5] = $shift_end_two;
                $arr[6] = $day_split_after;
                $arr[7] = $shift_in_till;
                $arr[8] = $shiftId;
                $arr[9] = $shiftCode;
                $arr[13] = $halfDaySeconds;
                $arr[14] = $shortLeaveSeconds;
                $arr[15] = $shiftName;
                $arr[16] = $isEnableHalfDayForHoliday;
                $arr[17] = $shiftInUpto;
                $arr[18] = $shiftOutUpto;
                $arr[19] = $payType;
                $arr[20] = $otOutFrom;
                $arr[21] = $otOutUntill;
                $arr[22] = $holidayData[0]['hchsd_isNopay_liable'] == 1 ? $holidayData[0]['hchsd_nopay_amount'] : 0;
                $arr[23] = $holidayData[0]['hchsd_is_half_day'];

                return $arr;
            } else {
                return null;
            }
        }
        return null;
    }

}
