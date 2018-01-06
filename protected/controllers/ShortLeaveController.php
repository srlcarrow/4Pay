<?php

class ShortLeaveController extends Controller {

    public function init() {
        $this->redirectionToLogin();
    }

    public function actionViewShortLeaveApplyPanel() {
        $empId = $_REQUEST['id'];
        $shortLeaveSetting = AdmShortLeaveSettings::model()->find();
        $this->render('/shortLeave/viewShortLeaveApplyPanel', array('empId' => $empId, 'applierType' => 'hr', 'shortLeaveSetting' => $shortLeaveSetting));
    }

    public function actionViewShortLeaveApplyPanelSelf() {
        $empId = Yii::app()->user->getId();
        $shortLeaveSetting = AdmShortLeaveSettings::model()->find();
        $this->render('/shortLeave/viewShortLeaveApplyPanel', array('empId' => $empId, 'applierType' => 'self', 'shortLeaveSetting' => $shortLeaveSetting));
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
        $endDateTime = $_POST['endDateTime'];
        $firstDayLeavemonth = date('Y-m-01', strtotime($shtLvDate));
        $lastDayLeavemonth = date('Y-m-t', strtotime($shtLvDate));
        $firstDayYear = date('Y-01-01', strtotime($shtLvDate));
        $lastDayYear = date('Y-12-t', strtotime($shtLvDate));


        $empBasic = Empbasic::model()->findByPk($empId);
        $userId = Yii::app()->user->getId();

        $shortLeaveSetting = AdmShortLeaveSettings::model()->find();
        $maxLeavesPerDay = $shortLeaveSetting->max_leaves_per_day;
        $maxLvsPerMonth = $shortLeaveSetting->max_leaves_per_month;
        $MaxLeavesPerYear = $shortLeaveSetting->max_leaves_per_year;


        $savedSLeavesRequestedDay = Yii::app()->db->createCommand("SELECT SUM(no_of_short_leaves) as sumSLDay FROM short_leave WHERE ref_emp_id ='" . $empId . "' and final_status !=2 and short_leave_date ='" . $shtLvDate . "'")->queryAll();
        $savedSLeavesRequestedDayTime = Yii::app()->db->createCommand("SELECT * FROM short_leave WHERE ref_emp_id ='" . $empId . "' and final_status !=2 and short_leave_date ='" . $shtLvDate . "' and ((start_time<='" . $startDateTime . "' and start_time>='" . $endDateTime . "') OR (end_time<='" . $endDateTime . "' and end_time>='" . $startDateTime . "') OR (start_time='" . $startDateTime . "' and end_time='" . $endDateTime . "')) ")->queryAll();
        $savedSLeavesMonth = Yii::app()->db->createCommand("SELECT * FROM short_leave WHERE ref_emp_id ='" . $empId . "' and final_status !=2 and short_leave_date between '" . $firstDayLeavemonth . "' and '" . $lastDayLeavemonth . "'")->queryAll();
        $savedSLeavesYear = Yii::app()->db->createCommand("SELECT * FROM short_leave WHERE ref_emp_id ='" . $empId . "' and final_status !=2 and short_leave_date between '" . $firstDayYear . "' and '" . $lastDayYear . "'")->queryAll();

        $savedSLeavesRequestedDayCount = 0;
        if (count($savedSLeavesRequestedDay) > 0) {
            $savedSLeavesRequestedDayCount = $savedSLeavesRequestedDay[0]['sumSLDay'];
        }

        $noOfSavedLeavesMonth = 0;
        foreach ($savedSLeavesMonth as $SvdShrtLvs) {
            $noOfSavedLeavesMonth = $noOfSavedLeavesMonth + $SvdShrtLvs['no_of_short_leaves'];
        }

        $noOfSavedLeavesYear = 0;
        foreach ($savedSLeavesYear as $SvdShrtLvsYR) {
            $noOfSavedLeavesYear = $noOfSavedLeavesYear + $SvdShrtLvsYR['no_of_short_leaves'];
        }

        $errorTag = 0;
        if (count($savedSLeavesRequestedDayTime) > 0) {
            $errorTag = 1;
            $returnMsg = "You have alreday applied a short leave for the same date and time!";
        } elseif (($savedSLeavesRequestedDayCount + $_POST['noOfLeaves']) > $maxLeavesPerDay) {
            $errorTag = 1;
            $returnMsg = "There are no enough short leaves to apply for the selected day!";
        } elseif (($noOfSavedLeavesMonth + $_POST['noOfLeaves']) > $maxLvsPerMonth) {
            $errorTag = 1;
            $returnMsg = "There are no enough short leaves to apply for selected month!";
        } elseif (($noOfSavedLeavesYear + $_POST['noOfLeaves']) > $MaxLeavesPerYear) {
            $errorTag = 1;
            $returnMsg = "Your Short Leave allocation is not enough for the request!";
        }

        if ($errorTag == 0) {
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
        } else {
            $this->msgHandler(400, $returnMsg);
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

    public function actionViewEmpShortLeaveHistory() {
        $empId = $_POST['empId'];
        $shortLeavesHistroy = ShortLeave::model()->findAllByAttributes(array('ref_emp_id' => $empId));
        $this->renderPartial('ajaxLoad/viewEmpShortLeaveHistory', array('shortLeavesHistroy' => $shortLeavesHistroy));
    }

    //Report
    public function actionViewEmployee() {
        $controller = "ShortLeave";
        $action = "ViewShortLeaveReportData";
        $this->render('/search/searchF1', array('controller' => $controller, 'action' => $action));
    }
    
}
