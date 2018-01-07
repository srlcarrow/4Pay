<?php

class Leave {

    public static function getLeaveBalance($empId, $leaveType) {
        return 7;
    }

    public static function validateLeave($empId, $leaveTypeId, $startDate, $endDate) {
        $status = 1;
        $leaveBalance = Leave::getLeaveBalance($empId, $leaveTypeId);
        $leaveTypeData = AdmLeavetypes::model()->findByPk($leaveTypeId);
        
//        var_dump($leaveTypeData);exit;
    }

}

?>
