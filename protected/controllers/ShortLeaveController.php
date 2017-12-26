<?php

class ShortLeaveController extends Controller {

    public function actionViewShortLeaveApplyPanel() {
        $empId = $_REQUEST['id'];
        $shortLeaveSetting = AdmShortLeaveSettings::model()->find();
        $this->render('/shortLeave/viewShortLeaveApplyPanel', array('empId' => $empId, 'shortLeaveSetting' => $shortLeaveSetting));
    }

    public function actionGetShortLeaveEndTime() {
        $shortLeaveSetting = AdmShortLeaveSettings::model()->find();
        $shtLvDate = $_POST['shtLvDate'];
        $startTime = $_POST['startTime'];
        $noOfLeaves = $_POST['noOfLeaves'];
        $shtlvDuration = $shortLeaveSetting->short_lv_duration;
        $shtlvDuration = $noOfLeaves * $shtlvDuration;

        $shortLvStartDateTime = date('Y-m-d H:i:s', strtotime("$shtLvDate $startTime"));
        $shortLvStartTime = date("H:i", strtotime($shortLvStartDateTime));

        $shortLvEndDateTime = date('Y-m-d H:i', strtotime('+' . $shtlvDuration . ' minutes', strtotime($shortLvStartDateTime)));
        $shortLvEndTime = date("H:i", strtotime($shortLvEndDateTime));
        $return_values = array();
        $return_values["shortLvStartTime"] = $shortLvStartTime;
        $return_values['shortLvStartDateTime'] = $shortLvStartDateTime;
        $return_values["shortLvEndTime"] = $shortLvEndTime;
        $return_values["shortLvEndDateTime"] = $shortLvEndDateTime;

        echo json_encode($return_values);
    }

    public function actionRequestShortLeave() {
        $shtLvDate = $_POST['shtLvDate'];
        $startTime = $_POST['startTime'];
        $empId = $_POST['id'];
        $startDateTime = date('Y-m-d H:i:s', strtotime("$shtLvDate $startTime"));
        $empBasic = Empbasic::model()->findByPk($empId);
        $userId = Yii::app()->user->getId();

        $shortLeaves = new ShortLeave();
        $shortLeaves->ref_emp_id = $empId;
        $shortLeaves->short_leave_date = $_POST['shtLvDate'];
        $shortLeaves->purpose = $_POST['purpose'];
        $shortLeaves->apply_date = Controller::getCountryDate();
        $shortLeaves->start_time = $startDateTime;
        $shortLeaves->end_time = $_POST['endDateTime'];
        $shortLeaves->no_of_short_leaves = $_POST['noOfLeaves'];
        $shortLeaves->approver_id = $empBasic->emp_sup_one;
        $shortLeaves->second_approver_id = $empBasic->emp_sup_two;
        $shortLeaves->requested_by = $userId;
        $shortLeaves->approver_status = 0;
        $shortLeaves->second_approver_status = 0;
        $shortLeaves->final_status = 0;
        //$shortLeaves->stleave_apply_section = $applySection;
        if ($shortLeaves->save(false)) {
            $this->msgHandler(200, "Short Leave has been successfully requested!");
        }
    }

    public function actionViewPendingShortLeave() {
        $userId = Yii::app()->user->getId();
        $criteria = new CDbCriteria();
        $criteria->compare('approver_id', $userId);
        $criteria->compare('approver_status', '0');
        $criteria->order = 'short_leave_date DESC';
        $pendingShortLeaves = ShortLeave::model()->findAll($criteria);
        $this->render('/shortLeave/pendingShortLeave', array('pendingShortLeaves' => $pendingShortLeaves));
    }

    public function actionApproveShortLeave() {
        $shortLeaveId = $_POST['shortLeaveId'];
        $shortLeaveSetting = AdmShortLeaveSettings::model()->find();
        $shortLeave = ShortLeave::model()->findByPk($shortLeaveId);
        $shortLeave->approver_status = 1;
        if ($shortLeaveSetting->is_dual_approvers == 0) {
            $shortLeave->final_status = 1;
        }

        if ($shortLeave->save(false)) {
            $this->msgHandler(200, "Successfully Saved...");
        }
    }

    public function actionRejectShortLeave() {
        $shortLeaveId = $_POST['shortLeaveId'];
        $shortLeave = ShortLeave::model()->findByPk($shortLeaveId);
        $shortLeave->reject_reason = $_POST['reason'];
        $shortLeave->approver_status = 2;
        $shortLeave->final_status = 2;
        if ($shortLeave->save(false)) {
            $this->msgHandler(200, "Successfully Saved...");
        }
    }

    public function actionViewPendingShortLeaveSecondApprover() {
        $userId = Yii::app()->user->getId();
        $pendingShortLeaves = ShortLeave::model()->findAllByAttributes(array('second_approver_id' => $userId, 'second_approver_status' => 0, 'final_status' => 0));
        $this->render('/shortLeave/pendingShortLeaveSecondApprover', array('pendingShortLeaves' => $pendingShortLeaves));
    }

    public function actionApproveShortLeaveSecondApprover() {
        $shortLeaveId = $_POST['shortLeaveId'];
        $shortLeaveSetting = AdmShortLeaveSettings::model()->find();
        $shortLeave = ShortLeave::model()->findByPk($shortLeaveId);
        $shortLeave->second_approver_status = 1;
        $shortLeave->final_status = 1;

        if ($shortLeave->save(false)) {
            $this->msgHandler(200, "Successfully Saved...");
        }
    }

    public function actionRejectShortLeaveSecondApprover() { 
        $shortLeaveId = $_POST['shortLeaveId'];
        $shortLeave = ShortLeave::model()->findByPk($shortLeaveId);
        $shortLeave->second_approver_reject_reason = $_POST['reason'];
        $shortLeave->second_approver_status = 2;
        $shortLeave->final_status = 2;
        if ($shortLeave->save(false)) {
            $this->msgHandler(200, "Successfully Saved...");
        }
    }

}
