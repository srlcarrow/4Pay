<?php

class Leave {

    public static function getLeaveBalance($empId, $leaveTypeId, $leaveApplyDates) {
        $leaveTypeData = AdmLeavetypes::model()->findByPk($leaveTypeId);
        $company = AdmCompany::model()->find();

        $allocatedLeaveAmount = yii::app()->db->createCommand("SELECT la.la_allocated_amount FROM leave_allocation la WHERE la.ref_emp_id=" . $empId . " AND la.ref_lv_type_id=" . $leaveTypeId . ";")->setFetchMode(PDO::FETCH_OBJ)->queryAll();

        $leaveCount = yii::app()->db->createCommand("SELECT SUM(lad.lvd_count) AS leaveCount FROM leave_apply la LEFT JOIN leave_apply_data lad ON la.lv_id=lad.ref_lv_id "
                        . "WHERE la.ref_emp_id=" . $empId . " AND la.ref_lv_type_id=" . $leaveTypeId . " AND YEAR(lad.lvd_day)=" . $company->com_leave_proc_year . ";")->setFetchMode(PDO::FETCH_OBJ)->queryAll();

        $leaveBalance = $allocatedLeaveAmount[0]->la_allocated_amount - $leaveCount[0]->leaveCount;
        $leaveBalance = $leaveBalance < 0 ? 0 : $leaveBalance;

        return $leaveBalance;
    }

    public static function validateLeave($empId, $leaveTypeId, $startDate, $endDate, $leaveApplyDates) {
        $status = 1;
        $msg = "";
        $statusArray = array();

        $leaveTypeData = AdmLeavetypes::model()->findByPk($leaveTypeId);
        $company = AdmCompany::model()->find();
        $employmentData = Employment::model()->findByAttributes(array('ref_emp_id' => $empId));
        $joinedDate = $employmentData->empl_joined_date;

        if ($leaveTypeData->is_enable_earnleave_for_joined_year == 1 && $company->com_leave_proc_year == date('Y', strtotime($joinedDate))) {
            $leaveCount = yii::app()->db->createCommand("SELECT SUM(lad.lvd_count) AS leaveCount FROM leave_apply la LEFT JOIN leave_apply_data lad ON la.lv_id=lad.ref_lv_id "
                            . "WHERE la.ref_emp_id=" . $empId . " AND la.ref_lv_type_id=" . $leaveTypeId . " AND YEAR(lad.lvd_day)=" . $company->com_leave_proc_year . ";")->setFetchMode(PDO::FETCH_OBJ)->queryAll();

            foreach ($leaveApplyDates as $leave) {
                $lastDayOfJoinedNextMonth = date('Y-m', strtotime(date("Y-m-d", strtotime($joinedDate)) . " +1 month")) . '-' . date('t', strtotime(date("Y-m-d", strtotime($joinedDate)) . " +1 month"));

                if (date('m', strtotime($joinedDate)) == date('m', strtotime($leave[0])) || (date('d', strtotime($joinedDate)) != "01" && strtotime(date("Y-m-d", strtotime($joinedDate)) . " +1 month") <= strtotime($leave[0]) && strtotime($lastDayOfJoinedNextMonth) >= strtotime($leave[0]) )) {
                    $leaveBalance = 0;
                    $statusArray['status'] = 0;
                    $statusArray['msg'] = "Your Leave Balance is not Enough.You have a balance of " . $leaveBalance . ' Day(s).';
                    return $statusArray;
                    exit;
                }
                if (date('Y-m', strtotime($leave[0])) != date('Y-m', strtotime($joinedDate))) {
                    $noOfMonths = date('m', strtotime($leave[0])) - date('m', strtotime($joinedDate));

                    if (date('d', strtotime($joinedDate)) == "01") {
                        $leaveBalance = $noOfMonths * $leaveTypeData->no_of_earn_leave_per_month;
                    } else {
                        $leaveBalance = ($noOfMonths - 1) * $leaveTypeData->no_of_earn_leave_per_month;
                    }

                    $askedLvAmount = $leave[1] == 0 ? 1 : 0.5;
                    if ($leaveBalance < $askedLvAmount) {
                        $statusArray['status'] = 0;
                        $statusArray['msg'] = "Your Leave Balance is not Enough.You have a balance of " . $leaveBalance . ' Day(s).';
                        return $statusArray;
                        exit;
                    } else {
                        $statusArray['status'] = 1;
                        $statusArray['msg'] = "";
                        return $statusArray;
                        exit;
                    }
                }
            }
        } else {
            $leaveBalance = Leave::getLeaveBalance($empId, $leaveTypeId, $leaveApplyDates);
        }

        $askedLeaveAmount = 0;
        foreach ($leaveApplyDates as $leave) {
            $appliedLeave = yii::app()->db->createCommand("SELECT * FROM leave_apply la LEFT JOIN leave_apply_data lad ON la.lv_id=lad.ref_lv_id WHERE la.ref_emp_id=" . $empId . " AND lad.lvd_day='" . $leave[0] . "'")->setFetchMode(PDO::FETCH_OBJ)->queryAll();
            if (count($appliedLeave) > 0) {
                $statusArray['status'] = 0;
                $statusArray['msg'] = "You have already applied a Leave on " . $leave[0] . '...';

                return $statusArray;
                exit;
            }

            $askedLeaveAmount += $leave[1] == 0 ? 1 : 0.5;
        }

        if ($leaveBalance < $askedLeaveAmount) {
            $statusArray['status'] = 0;
            $statusArray['msg'] = "Your Leave Balance is not Enough...";
            return $statusArray;
            exit;
        }

        if ($leaveTypeData->lt_min_no_leaves_at_once > $askedLeaveAmount) {
            $statusArray['status'] = 0;
            $statusArray['msg'] = "Your have to apply minimum of " . $leaveTypeData->lt_min_no_leaves_at_once . " leave(s) at once...";
            return $statusArray;
            exit;
        }

        if ($leaveTypeData->lt_max_no_leaves_at_once < $askedLeaveAmount) {
            $statusArray['status'] = 0;
            $statusArray['msg'] = "Your can apply miximum of " . $leaveTypeData->lt_max_no_leaves_at_once . " leave(s) at once...";
            return $statusArray;
            exit;
        }

        if ($leaveTypeData->lt_min_no_of_concecutive_leaves_at_once > 0 && $leaveBalance > $leaveTypeData->lt_min_no_of_concecutive_leaves_at_once) {           
            $days = Controller::returnDates($askedLeaveDaysArray[0], $askedLeaveDaysArray[count($askedLeaveDaysArray) - 1]);
            $askedLeaveDaysArray = array_column($leaveApplyDates, 0);

            $status = 0;
            $noOfConcecDays = 0;

            foreach ($days as $day) {
                $availableInArray = array_search($day, $askedLeaveDaysArray) === false ? 0 : 1;

                if ($availableInArray == 0) {
                    $isShiftAvailable = DailyAttendance::model()->getEmpWorkshift($empId, $day);
                    $isHoliday = AdmConfigHolidays::model()->findByAttributes(array('holiday_date' => $day));

                    if (count($isHoliday) > 0 || $isShiftAvailable[8] == 0) {
                        
                    } else {
                        $noOfConcecDays = 0;
                    }
                } else {
                    $noOfConcecDays += 1;
                    if ($noOfConcecDays == $leaveTypeData->lt_min_no_of_concecutive_leaves_at_once) {
                        $noOfConcecDays = 0;
                        $statusArray['status'] = 1;
                        $statusArray['msg'] = "";
                        return $statusArray;
                        exit;
                    } else {
                        
                    }
                }
            }

            $statusArray['status'] = 0;
            $statusArray['msg'] = "You have to Apply " . $leaveTypeData->lt_min_no_of_concecutive_leaves_at_once . " concecutive Days.";
            return $statusArray;
            exit;
        }

        $statusArray['status'] = $status;
        $statusArray['msg'] = $msg;
        return $statusArray;
    }

    public static function validateLeaveHR($empId, $leaveTypeId, $startDate, $endDate, $leaveApplyDates) {
        $status = 1;
        $msg = "";
        $statusArray = array();

        $leaveTypeData = AdmLeavetypes::model()->findByPk($leaveTypeId);
        $company = AdmCompany::model()->find();
        $employmentData = Employment::model()->findByAttributes(array('ref_emp_id' => $empId));
        $joinedDate = $employmentData->empl_joined_date;

        if ($leaveTypeData->is_enable_earnleave_for_joined_year == 1 && $company->com_leave_proc_year == date('Y', strtotime($joinedDate))) {
            $leaveCount = yii::app()->db->createCommand("SELECT SUM(lad.lvd_count) AS leaveCount FROM leave_apply la LEFT JOIN leave_apply_data lad ON la.lv_id=lad.ref_lv_id "
                            . "WHERE la.ref_emp_id=" . $empId . " AND la.ref_lv_type_id=" . $leaveTypeId . " AND YEAR(lad.lvd_day)=" . $company->com_leave_proc_year . ";")->setFetchMode(PDO::FETCH_OBJ)->queryAll();

            foreach ($leaveApplyDates as $leave) {
                $lastDayOfJoinedNextMonth = date('Y-m', strtotime(date("Y-m-d", strtotime($joinedDate)) . " +1 month")) . '-' . date('t', strtotime(date("Y-m-d", strtotime($joinedDate)) . " +1 month"));

                if (date('m', strtotime($joinedDate)) == date('m', strtotime($leave[0])) || (date('d', strtotime($joinedDate)) != "01" && strtotime(date("Y-m-d", strtotime($joinedDate)) . " +1 month") <= strtotime($leave[0]) && strtotime($lastDayOfJoinedNextMonth) >= strtotime($leave[0]) )) {
                    $leaveBalance = 0;
                    $statusArray['status'] = 0;
                    $statusArray['msg'] = "Your Leave Balance is not Enough.You have a balance of " . $leaveBalance . ' Day(s).';
                    return $statusArray;
                    exit;
                } elseif (date('Y-m', strtotime($leave[0])) != date('Y-m', strtotime($joinedDate))) {
                    $noOfMonths = date('m', strtotime($leave[0])) - date('m', strtotime($joinedDate));

                    if (date('d', strtotime($joinedDate)) == "01") {
                        $leaveBalance = $noOfMonths * $leaveTypeData->no_of_earn_leave_per_month;
                    } else {
                        $leaveBalance = ($noOfMonths - 1) * $leaveTypeData->no_of_earn_leave_per_month;
                    }

                    $askedLvAmount = $leave[1] == 0 ? 1 : 0.5;
                    if ($leaveBalance < $askedLvAmount) {
                        $statusArray['status'] = 0;
                        $statusArray['msg'] = "Your Leave Balance is not Enough.You have a balance of " . $leaveBalance . ' Day(s).';
                        return $statusArray;
                        exit;
                    } else {
                        $statusArray['status'] = 1;
                        $statusArray['msg'] = "";
                        return $statusArray;
                        exit;
                    }
                }
            }
            return;
        } else {
            $leaveBalance = Leave::getLeaveBalance($empId, $leaveTypeId, $leaveApplyDates);
        }

        $askedLeaveAmount = 0;
        foreach ($leaveApplyDates as $leave) {
            $appliedLeave = yii::app()->db->createCommand("SELECT * FROM leave_apply la LEFT JOIN leave_apply_data lad ON la.lv_id=lad.ref_lv_id WHERE la.ref_emp_id=" . $empId . " AND lad.lvd_day='" . $leave[0] . "'")->setFetchMode(PDO::FETCH_OBJ)->queryAll();
            if (count($appliedLeave) > 0) {
                $statusArray['status'] = 0;
                $statusArray['msg'] = "You have already applied a Leave on " . $leave[0] . '...';

                return $statusArray;
                exit;
            }

            $askedLeaveAmount += $leave[1] == 0 ? 1 : 0.5;
        }

        if ($leaveBalance < $askedLeaveAmount) {
            $statusArray['status'] = 0;
            $statusArray['msg'] = "Your Leave Balance is not Enough...";
            return $statusArray;
            exit;
        }

        $statusArray['status'] = $status;
        $statusArray['msg'] = $msg;
        return $statusArray;
    }

}

?>
