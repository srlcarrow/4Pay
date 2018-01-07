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

}
