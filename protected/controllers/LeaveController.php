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

}
