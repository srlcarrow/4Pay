<?php

class LeaveController extends Controller {

    public function init() {
        $this->redirectionToLogin();
    }

    public function actionViewLeaveAllocation() {
        $controller = "Leave";
        $action = "ViewLeaveAllocationData";
        $this->render('/search/searchF1', array('controller' => $controller, 'action' => $action));
    }

    public function actionViewLeaveAllocationData() {
        $sql = Yii::app()->db->createCommand()
                ->select('*')
                ->from('emp_basic emp')
                ->getText();

        $limit = $_REQUEST['noOfData'];
        $data = Controller::createSearchForEmployee($sql, 'emp.emp_id', Yii::app()->request->getPost('page'), $limit, 'emp.epf_no ASC');

        $employeeData = $data['result'];
        $pageCount = $data['count'];
        $currentPage = Yii::app()->request->getPost('page');

        $this->renderPartial('ViewLeaveAllocationData', array('employeeData' => $employeeData, 'pageSize' => $limit, 'page' => $currentPage, 'count' => $pageCount));
    }

    public function actionSaveLeaveAllocationData() {
        $selectedEmployees = $_POST['selectedIds'];
        $userId = Yii::app()->user->getId();
        $leaveTypes = AdmLeavetypes::model()->findAll();

        foreach ($selectedEmployees as $empId) {
            foreach ($leaveTypes as $leaveType) {
                $leaveAllocation = LeaveAllocation::model()->findByAttributes(array('ref_emp_id' => $empId, 'ref_lv_type_id' => $leaveType->lt_id));
                if (count($leaveAllocation) == 0) {
                    $leaveAllocation = new LeaveAllocation();
                }

                $leaveAllocation->ref_emp_id = $empId;
                $leaveAllocation->ref_lv_type_id = $leaveType->lt_id;
                $leaveAllocation->la_allocated_amount = $_POST['leave_' . $leaveType->lt_id . '_' . $empId] == "" ? 0 : $_POST['leave_' . $leaveType->lt_id . '_' . $empId];
                $leaveAllocation->la_available_amount = count($leaveAllocation) > 0 ? $leaveAllocation->la_available_amount : ($_POST['leave_' . $leaveType->lt_id . '_' . $empId] == "" ? 0 : $_POST['leave_' . $leaveType->lt_id . '_' . $empId]);
                $leaveAllocation->save(false);
            }

            $empData = EmpBasic::model()->findByPk($empId);
            $firstSup = EmpBasic::model()->findByAttributes(array('empno' => $_POST['firstSup_' . $empId]));
            $secondSup = EmpBasic::model()->findByAttributes(array('empno' => $_POST['secSup_' . $empId]));
            $coverup = EmpBasic::model()->findByAttributes(array('empno' => $_POST['coverup_' . $empId]));

            $empData->emp_sup_one = count($firstSup) > 0 ? $firstSup->emp_id : 0;
            $empData->emp_sup_two = count($secondSup) > 0 ? $secondSup->emp_id : 0;
            $empData->emp_coverup = count($coverup) > 0 ? $coverup->emp_id : 0;
            $empData->save(false);
        }

        $this->msgHandler(200, "Save Successfull...");
    }

    public function actionViewManageLeave() {
        $controller = "Leave";
        $action = "ViewManageLeaveData";
        $this->render('/search/searchF1', array('controller' => $controller, 'action' => $action));
    }

    public function actionViewManageLeaveData() {
        $sql = Yii::app()->db->createCommand()
                ->select('*')
                ->from('emp_basic emp')
                ->getText();

        $limit = $_REQUEST['noOfData'];
        $data = Controller::createSearchForEmployee($sql, 'emp.emp_id', Yii::app()->request->getPost('page'), $limit, 'emp.epf_no ASC');

        $employeeData = $data['result'];
        $pageCount = $data['count'];
        $currentPage = Yii::app()->request->getPost('page');

        $this->renderPartial('viewManageLeaveData', array('employeeData' => $employeeData, 'pageSize' => $limit, 'page' => $currentPage, 'count' => $pageCount));
    }

    public function actionSaveLeave() {
        $leaveApplyDates = json_decode(stripslashes($_POST["leaveDates"]));
        $status = Leave::validateLeave($_POST['empId'], $_POST["leaveTypeId"], $_POST["startDate"], $_POST["endDate"], $leaveApplyDates);

        if ($status['status'] == 1) {
            $leaveApply = new LeaveApply();
            $leaveApply->lv_apply_date = date('Y-m-d');
            $leaveApply->ref_emp_id = $_POST['empId'];
            $leaveApply->ref_lv_type_id = $_POST["leaveTypeId"];
            $leaveApply->lv_from = $_POST["startDate"];
            $leaveApply->lv_to = $_POST["endDate"];

            $leaveApply->lv_no_of_leaves = 0;

            $leaveApply->lv_coverup_id = $_POST["coverupId"];
            $leaveApply->lv_first_sup_id = 0;
            $leaveApply->lv_sec_sup_id = 0;

            $leaveApply->lv_coverup_approved = 0;
            $leaveApply->lv_first_sup_approved = 0;
            $leaveApply->lv_sec_sup_approved = 0;
            $leaveApply->lv_approved_final_status = 0;

            $leaveApply->lv_coverup_approved_date = "0000-00-00";
            $leaveApply->lv_first_sup_approved_date = "0000-00-00";
            $leaveApply->lv_sec_sup_approved_date = "0000-00-00";

            $leaveApply->lv_created_date = date('Y-m-d H:i:s');
            $leaveApply->lv_created_by = Yii::app()->user->getId();
            if ($leaveApply->save(false)) {
                $leaveApplyId = $leaveApply->getPrimaryKey();

                foreach ($leaveApplyDates as $leave) {
                    $leaveApplyData = new LeaveApplyData();
                    $leaveApplyData->ref_lv_id = $leaveApplyId;
                    $leaveApplyData->lvd_day = $leave[0];
                    $leaveApplyData->lvd_is_halfday = $leave[1] == 0 ? 0 : 1;
                    $leaveApplyData->lvd_halfday_half = $leave[1];
                    $leaveApplyData->lvd_count = $leave[1] == 0 ? 1 : 0.5;
                    $leaveApplyData->save(false);
                }
            }

            $this->msgHandler(200, "Applied Successfully...");
        } else {
            $this->msgHandler(400, $status['msg']);
        }
    }

//*********************************************  LEAVE HR   ********************************************************
    public function actionViewLeave() {
        $empId = $_REQUEST['id'];
        $leaveAllocation = LeaveAllocation::model()->findAllByAttributes(array('ref_emp_id' => $empId, 'is_available_leave_type' => 1));

        $this->render('hr/viewLeave', array('leaveAllocation' => $leaveAllocation, 'empId' => $empId));
    }

    public function actionViewLeaveData() {
        $empId = $_POST['empId'];
        $leaveTypeData = AdmLeavetypes::model()->findByPk($_POST["selectedLvType"]);

        $minDate = "2018-01-06";
        $maxDate = "2018-12-31";
        $dayCount = 21;
        $leaveTypeData = LeaveAllocation::model()->findByAttributes(array('ref_emp_id' => $empId, 'ref_lv_type_id' => $_POST["selectedLvType"], 'is_available_leave_type' => 1));

        $this->renderPartial('hr/viewLeaveData', array('leaveTypeData' => $leaveTypeData, 'minDate' => $minDate, 'maxDate' => $maxDate, 'dayCount' => $dayCount, 'leaveTypeId' => $_POST["selectedLvType"], 'empId' => $empId));
    }

    public function actionViewLeaveDates() {
        $empId = Controller::getEmpIdOfLoggedUser();
//        $leaveBalance = Leave::validateLeave($empId, $_POST["selectedLvType"], $_POST["startDate"], $_POST["endDate"]);

        $leaveDays = Controller::returnDates($_POST["startDate"], $_POST["endDate"]);
        $this->renderPartial('hr/leaveDate', array('leaveDays' => $leaveDays, 'empId' => $empId, 'leaveTypeId' => $_POST["selectedLvType"]));
    }

    public function actionViewLeaveHistory() {
        $empId = Controller::getEmpIdOfLoggedUser();
        $leaveData = yii::app()->db->createCommand("SELECT la.lv_id,al.lt_name, la.lv_from, la.lv_to,lv_no_of_leaves,la.lv_first_sup_approved, la.lv_sec_sup_approved FROM leave_apply la "
                        . "LEFT JOIN leave_apply_data lad ON la.lv_id=lad.ref_lv_id "
                        . "LEFT JOIN adm_leavetypes al ON al.lt_id=la.ref_lv_type_id "
                        . "WHERE la.ref_emp_id=" . $empId . " ORDER BY la.lv_approved_final_status,la.lv_from")->setFetchMode(PDO::FETCH_OBJ)->queryAll();

        $this->renderPartial('hr/viewLeaveHistory', array('empId' => $empId, 'leaveData' => $leaveData));
    }

    public function actionSaveLeaveHR() {
        $leaveApplyDates = json_decode(stripslashes($_POST["leaveDates"]));
        $status = Leave::validateLeaveHR($_POST['empId'], $_POST["leaveTypeId"], $_POST["startDate"], $_POST["endDate"], $leaveApplyDates);

        if ($status['status'] == 1) {
            $leaveApply = new LeaveApply();
            $leaveApply->lv_apply_date = date('Y-m-d');
            $leaveApply->ref_emp_id = $_POST['empId'];
            $leaveApply->ref_lv_type_id = $_POST["leaveTypeId"];
            $leaveApply->lv_from = $_POST["startDate"];
            $leaveApply->lv_to = $_POST["endDate"];

            $leaveApply->lv_no_of_leaves = 0;

            $leaveApply->lv_coverup_id = $_POST["coverupId"];
            $leaveApply->lv_first_sup_id = 0;
            $leaveApply->lv_sec_sup_id = 0;

            $leaveApply->lv_coverup_approved = 0;
            $leaveApply->lv_first_sup_approved = 0;
            $leaveApply->lv_sec_sup_approved = 0;
            $leaveApply->lv_approved_final_status = 0;

            $leaveApply->lv_coverup_approved_date = "0000-00-00";
            $leaveApply->lv_first_sup_approved_date = "0000-00-00";
            $leaveApply->lv_sec_sup_approved_date = "0000-00-00";

            $leaveApply->lv_created_date = date('Y-m-d H:i:s');
            $leaveApply->lv_created_by = Yii::app()->user->getId();
            if ($leaveApply->save(false)) {
                $leaveApplyId = $leaveApply->getPrimaryKey();

                foreach ($leaveApplyDates as $leave) {
                    $leaveApplyData = new LeaveApplyData();
                    $leaveApplyData->ref_lv_id = $leaveApplyId;
                    $leaveApplyData->lvd_day = $leave[0];
                    $leaveApplyData->lvd_is_halfday = $leave[1] == 0 ? 0 : 1;
                    $leaveApplyData->lvd_halfday_half = $leave[1];
                    $leaveApplyData->lvd_count = $leave[1] == 0 ? 1 : 0.5;
                    $leaveApplyData->save(false);
                }
            }

            $this->msgHandler(200, "Applied Successfully...");
        } else {
            $this->msgHandler(400, $status['msg']);
        }
    }

}
