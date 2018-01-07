<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function redirectionToLogin() {
        parent::init();
        if (yii::app()->user->isGuest) {
            $this->redirect(array('site/Login', 'controllerAction' => Yii::app()->urlManager->parseUrl(Yii::app()->request), 'request_arr' => $_REQUEST));
        }
    }

    public static function msgHandler($code, $msg, $data = NULL) {
        if ($code == 200) {
            echo json_encode(array("code" => $code, "msg" => $msg, "data" => $data));
        } else {
            echo json_encode(array("code" => $code, "msg" => $msg, "data" => $data));
        }
    }

    public static function createSearchForEmployee($query, $joinUsing, $page, $limit = NULL, $orderBy = NULL, $empbasic = NULL) {
        $sqlLimit = '';
        if ($limit == NULL) {
            $limit = 10;
            $offset = ($page - 1) * $limit;
            $sqlLimit = ' LIMIT ' . $limit . ' OFFSET ' . $offset;
        } elseif ($limit > 0 && $limit != NULL) {
            $limit = $limit;
            $offset = ($page - 1) * $limit;
            $sqlLimit = ' LIMIT ' . $limit . ' OFFSET ' . $offset;
        }

        $askedQuery = explode("WHERE", $query, 2);
        $askedJoin = explode("LEFT JOIN", $query, 2);
        $requestedJoin = '';

        $join = Controller::searchEmployeeJoinCriterias();
        $where = Controller::searchEmployeeWhereCriterias();

        if ($empbasic != NULL) {
            $join = ' JOIN `emp_basic` `emp` ON emp.emp_id=' . $joinUsing . ' ' . $join;
        }

        $askedWhere = '';
        if (count($askedQuery) > 1) {
            $askedWhere = $askedQuery[1] == NULL ? '' : ' AND ' . $askedQuery[1];
        }

        $orderBy = $orderBy != NULL ? 'ORDER BY ' . $orderBy : "";
        $returnQuery = $askedQuery[0] . $join . ' WHERE ' . $where . $askedWhere . ' ' . $orderBy . $sqlLimit;
        $returnQueryCount = $askedQuery[0] . $join . ' WHERE ' . $where . $askedWhere . ' ';


        $result = yii::app()->db->createCommand($returnQuery)->setFetchMode(PDO::FETCH_OBJ)->queryAll();
        $count = count(yii::app()->db->createCommand($returnQueryCount)->setFetchMode(PDO::FETCH_OBJ)->queryAll());

        return array('result' => $result, 'count' => $count);
    }

    public static function searchEmployeeJoinCriterias() {
        $joinCriteria = Yii::app()->db->createCommand()
                ->leftJoin('emp_employment empl', 'emp.emp_id=empl.ref_emp_id')
                ->leftJoin('emp_contacts empcon', 'emp.emp_id=empcon.ref_emp_id')
                ->leftJoin('adm_branch br', 'empl.ref_branch_id=br.br_id')
                ->leftJoin('adm_designation desig', 'empl.ref_designation=desig.desig_id')
                ->leftJoin('adm_department dept', 'empl.ref_department_id=dept.dept_id')
                ->leftJoin('adm_section as1', 'empl.ref_section_id=as1.section_id')
                ->getText();

        $joinCriteria = explode("SELECT *", $joinCriteria, 2);
        return $joinCriteria[1];
    }

    public static function searchEmployeeWhereCriterias() {
        $str = "emp.emp_id !=0 ";

        if (!empty($_REQUEST['searchEmployeeText']) && $_REQUEST['searchEmployeeText'] != 'undefined') {
            $str .= " AND  ( emp.emp_full_name Like '%" . $_REQUEST['searchEmployeeText'] . "%' OR emp.emp_name_with_initials Like '%" . $_REQUEST['searchEmployeeText'] . "%' OR emp.emp_display_name Like '%" . $_REQUEST['searchEmployeeText'] . "%' OR emp.epf_no Like '%" . $_REQUEST['searchEmployeeText'] . "%' OR emp.empno Like '%" . $_REQUEST['searchEmployeeText'] . "%' OR emp.emp_nic Like '%" . $_REQUEST['searchEmployeeText'] . "%')";
        }
        if (!empty($_REQUEST["ref_branch_id"]) && $_REQUEST["ref_branch_id"] != 'undefined' && $_REQUEST["ref_branch_id"] != "") {
            $str .= " AND  empl.ref_branch_id=" . $_REQUEST["ref_branch_id"];
        }
        if (!empty($_REQUEST["ref_department_id"]) && $_REQUEST["ref_department_id"] != 'undefined' && $_REQUEST["ref_department_id"] != "") {
            $str .= " AND  empl.ref_department_id=" . $_REQUEST["ref_department_id"];
        }
        if (!empty($_REQUEST['ref_designation']) && $_REQUEST['ref_designation'] != 'undefined' && $_REQUEST["ref_designation"] != "") {
            $str .= " AND  empl.ref_designation=" . $_REQUEST["ref_designation"];
        }

        return $str;
    }

    public function viewStatusArry() {
        return array('Male' => 'Male', 'Female' => 'Female');
    }

    public function viewTitleArry() {
        return array('Mr.' => 'Mr', 'Mrs.' => 'Mrs', 'Miss.' => 'Miss', 'Ms.' => 'Ms', 'Dr.' => 'Dr');
    }

    public function viewCivilstatusArry() {
        return array('Single' => 'Single', 'Married' => 'Married', 'Divorced' => 'Divorced', 'Widow' => 'Widow');
    }

    public function getActiveFilter() {
        return array('active' => 'Active', 'inactive' => 'Inactive', 'resign' => 'Resigned', 'discontinue' => 'Discontinue', 'vacate' => 'Vacate');
    }

    public static function getTimeZone() {
        $timezone = 5.5 * 3600;
        return $timezone;
    }

    public static function getCountryDate() {
        $zone = 3600 * +5.5;
        $date = gmdate("Y-m-d", time() + $zone);
        return $date;
    }

    public static function empBasicFields() {
        $reqBasicFields = array('emp.empno' => 'EMP No', 'emp.epf_no' => 'EPF No', 'emp.attendance_no' => 'Attendance No', 'emp.emp_title' => 'Title', 'emp.emp_display_name' => 'Display Name', 'emp.emp_full_name' => 'Full Name', 'emp.emp_name_with_initials' => 'Name With Initials', 'emp.emp_gender' => 'Gender');
        return $reqBasicFields;
    }

    public static function empEmploymentFields() {
        $reqEmploymentFields = array('br.br_name' => 'Branch', 'dept.dept_name' => 'Department', 'as1.section_name' => 'Section', 'desig.designation' => 'Designation');
        return $reqEmploymentFields;
    }

    public static function attendanceFields() {
        $reqAttendanceFields = array('aa.day' => 'Day', 'aa.date_in' => 'Date In', 'aa.punch_in' => 'Punch In', 'aa.date_out' => 'Date Out', 'aa.punch_out' => 'Punch Out', 'aa.early_time' => 'Early In', 'aa.late_time' => 'Late', 'aa.early_living' => 'Early Leaving', 'aa.over_time' => 'Over Time', 'aa.punch_in_location' => 'In Location', 'aa.punch_out_location' => 'Out Location');
        return $reqAttendanceFields;
    }

    public static function randomPassword($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyz";
        $chars1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $chars2 = "0123456789";
        $password = substr(str_shuffle($chars), 0, 4);
        $password1 = substr(str_shuffle($chars1), 0, 3);
        $password2 = substr(str_shuffle($chars2), 0, 1);
        $passwordNew = str_shuffle($password . $password1 . $password2);
        return $passwordNew;
    }

    public static function getEmpIdOfLoggedUser() {
        $userId = Yii::app()->user->getId();
        $userData = User::model()->findByPk($userId);
        return $userData->ref_emp_id;
    }

    public static function getDatesForCalendar($year, $month) {
        $numOfDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $startDate = $year . '-' . $month . '-01';
        $endDate = $year . '-' . $month . '-' . $numOfDays;

        $startDayNumberOfWeek = date('w', strtotime($startDate)) + 1;

        $previouseMonth = Date('Y-m-d', strtotime($startDate . " last month"));
        $nextMonth = Date('Y-m-d', strtotime($startDate . " next month"));

        $showDateLastMonth = date('Y-m-d', strtotime('-' . date('w', strtotime($startDate)) . ' days', strtotime($startDate)));
        $showDateNextMonth = date('Y-m-d', strtotime('+' . (6 - date('w', strtotime($endDate))) . ' days', strtotime($endDate)));

        $days = Controller::returnDates($showDateLastMonth, $showDateNextMonth);
        return $days;
    }

    public static function returnDates($startDate, $endDate) {
        $startStamp = strtotime($startDate);
        $endStamp = strtotime($endDate);

        while ($endStamp >= $startStamp) {
            $dateArr[] = date('Y-m-d', $startStamp);
            $startStamp = strtotime(' +1 day ', $startStamp);
        }
        return $dateArr;
    }    

    public function viewYearArry() {
        return array(gmdate('Y', strtotime('-1 year')) => gmdate('Y', strtotime('-1 year')), gmdate('Y') => gmdate('Y'), gmdate('Y', strtotime('+1 year')) => gmdate('Y', strtotime('+1 year')));
    }

    public static function getMonthList() {
        $months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
        return $months;
    }
    
//    public function 

}
