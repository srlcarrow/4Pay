<?php

class AttendanceController extends Controller {

    public function init() {
        $this->redirectionToLogin();
    }

    public function actionAttendanceTest() {
        $allAttendance = Allattendance::model()->findAll();
        foreach ($allAttendance as $value) {
            Attendance::dailyAttendance($value->emp_no,$value->checktime,$value->branch_id,$value->punch_by);
        }
    }

}
