<?php

class AttendanceController extends Controller {

    public function init() {
        $this->redirectionToLogin();
    }

    public function actionAttendanceTest() {
        $allAttendance = Allattendance::model()->findAll();
        foreach ($allAttendance as $value) {
            Attendance::dailyAttendance($value->emp_no, $value->checktime, $value->branch_id, $value->punch_by);
        }
    }

    public function actionViewAttendanceReport() {
        $controller = "Attendance";
        $action = "ViewAttendanceDataReport";

        $reqBasicFields = $this->empBasicFields();
        $reqAttendanceFields = $this->attendanceFields();
        $this->render('/search/searchF2', array('controller' => $controller, 'action' => $action, 'reqBasicFields' => $reqBasicFields, 'reqAttendanceFields' => $reqAttendanceFields));
    }

    public function actionViewAttendanceDataReport() {
        $selectedItems = implode(',', json_decode($_POST["selected"], true));
        $sql = Yii::app()->db->createCommand()
                ->select('*')
                ->from('emp_basic emp')
                ->getText();

        $limit = 5;
        $data = Controller::createSearchForEmployee($sql, 'emp.emp_id', Yii::app()->request->getPost('page'), $limit, 'emp.epf_no');

        $employeeData = $data['result'];
        $pageCount = $data['count'];
        $currentPage = Yii::app()->request->getPost('page');


        $this->renderPartial('/reports/attendance/ajaxLoad/viewAttendanceReportData', array('employeeData' => $employeeData));
    }

}
