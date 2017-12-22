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

    public static function createSearchForEmployee($query, $joinUsing, $page, $limit = NULL, $orderBy = NULL) {
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

        $askedWhere = '';
        if (count($askedQuery) > 1) {
            $askedWhere = $askedQuery[1] == NULL ? '' : ' AND ' . $askedQuery[1];
        }

        $orderBy = $orderBy != NULL ? 'ORDER BY ' . $orderBy . " DESC" : "";
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
                ->getText();

        $joinCriteria = explode("SELECT *", $joinCriteria, 2);
        return $joinCriteria[1];
    }

    public static function searchEmployeeWhereCriterias() {
        $str = "emp.emp_id !=0 ";

        if (!empty($_REQUEST['searchEmployeeText']) && $_REQUEST['searchEmployeeText'] != 'undefined') {
            $str .= " AND  ( emp.emp_full_name Like '%" . $_REQUEST['searchEmployeeText'] . "%' OR emp.emp_name_with_initials Like '%" . $_REQUEST['searchEmployeeText'] . "%' OR emp.emp_display_name Like '%" . $_REQUEST['searchEmployeeText'] . "%' OR emp.epf_no Like '%" . $_REQUEST['searchEmployeeText'] . "%' OR emp.empno Like '%" . $_REQUEST['searchEmployeeText'] . "%' OR emp.emp_nic Like '%" . $_REQUEST['searchEmployeeText'] . "%')";
        }

        return $str;
    }

    public static function getTimeZone() {
        $timezone = 5.5 * 3600;
        return $timezone;
    }

    public static function empBasicFields() {
        $reqBasicFields = array('emp.empno' => 'EMP No', 'emp.epf_no' => 'EPF No', 'emp.attendance_no' => 'Attendance No', 'emp.emp_title' => 'Title', 'emp.emp_display_name' => 'Display Name', 'emp.emp_full_name' => 'Full Name', 'emp.emp_name_with_initials' => 'Name With Initials', 'emp.emp_gender' => 'Gender');
        return $reqBasicFields;
    }

    public static function empEmploymentFields() {
        
    }

    public static function attendanceFields() {
        $reqAttendanceFields = array('aa.day' => 'Day', 'aa.date_in' => 'Date In', 'aa.punch_in' => 'Punch In', 'aa.date_out' => 'Date Out', 'aa.punch_out' => 'Punch Out', 'aa.early_time' => 'Early In', 'aa.late_time' => 'Late', 'aa.early_living' => 'Early Leaving', 'aa.over_time' => 'Over Time', 'aa.punch_in_location' => 'In Location', 'aa.punch_out_location' => 'Out Location');
        return $reqAttendanceFields;
    }

}
