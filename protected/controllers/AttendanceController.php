<?php

class AttendanceController extends Controller {

    public function init() {
        $this->redirectionToLogin();
    }

    public function actionGenerate() {
        set_time_limit(30000);
        $dateFrom = "2018-01-10";
        $dateTo = "2018-01-12";

        $data = Yii::app()->db->createCommand('SELECT * FROM att_allattendance ha WHERE ha.checktime BETWEEN "' . $dateFrom . '" AND "' . $dateTo . '"')->queryAll();

        foreach ($data as $value) {
            Attendance::dailyAttendance($value['emp_no'], $value["checktime"], $value["Branch"], 1);
        }

        exit;
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
        $reqEmploymentFields = $this->empEmploymentFields();
        $reqAttendanceFields = $this->attendanceFields();
        $defaultChecked = array('emp.empno' => 'EMP No', 'emp.epf_no' => 'EPF No', 'emp.emp_name_with_initials' => 'Name With Initials', 'aa.day' => 'Day', 'aa.date_in' => 'Date In', 'aa.punch_in' => 'Punch In', 'aa.date_out' => 'Date Out', 'aa.punch_out' => 'Punch Out');
        $this->render('/search/searchF2', array('controller' => $controller, 'action' => $action, 'reqBasicFields' => $reqBasicFields, 'reqAttendanceFields' => $reqAttendanceFields, 'reqEmploymentFields' => $reqEmploymentFields, 'defaultChecked' => $defaultChecked));
    }

    public function actionViewAttendanceDataReport() {
        $selectedItems = implode(',', json_decode($_POST["selected"], true));
        $selectedLabels = implode(',', json_decode($_POST["selectedLabels"], true));

        $sql = Yii::app()->db->createCommand()
                ->select($selectedItems)
                ->from('att_attendance aa')
                ->getText();


        $limit = $_POST['noOfData'];
        $data = Controller::createSearchForEmployee($sql, 'aa.ref_emp_id', Yii::app()->request->getPost('page'), $limit, 'CAST(emp.epf_no AS DECIMAL),aa.day ASC', 'empbasic');

        $attendanceData = $data['result'];
        $pageCount = $data['count'];
        $currentPage = Yii::app()->request->getPost('page');

        $headers = explode(',', $selectedItems);
        $headersLabels = explode(',', $selectedLabels);
        $this->renderPartial('/reports/attendance/ajaxLoad/viewAttendanceReportData', array('attendanceData' => $attendanceData, 'headers' => $headers, 'headersLabels' => $headersLabels, 'pageSize' => $limit, 'page' => $currentPage, 'count' => $pageCount));
    }

    public function actionViewHolidayCalendar() {
        $holidayTypes = AdmConfigHolidayType::model()->findAll();
        $this->render('viewHoliday', array('holidayTypes' => $holidayTypes));
    }

    public function actionHolidayCalendarData() {
        if (!isset($_POST['year']) || !isset($_POST['year'])) {
            $reqYear = date('Y');
            $reqMonth = date('m');
        } else {
            $reqYear = $_POST['year'];
            $reqMonth = $_POST['month'];
        }

        $days = Controller::getDatesForCalendar($reqYear, $reqMonth);

        $this->renderPartial('ajaxLoad/ViewHolidayData', array('days' => $days, 'reqYear' => $reqYear, 'reqMonth' => $reqMonth));
    }

    public function actionSaveHolidayTypes() {
        $holiType = new AdmConfigHolidayType();
        $holiType->holiday_type_name = $_POST['holidayType'];
        if ($holiType->save(false)) {
            $this->msgHandler(200, "Save Successfull...");
        }
    }

    public function actionDeleteHolidayTypes() {
        AdmConfigHolidayType::model()->deleteByPk($_POST['id']);
        if ($holiType->save(false)) {
            $this->msgHandler(200, "Delete Successfull...");
        }
    }

}
