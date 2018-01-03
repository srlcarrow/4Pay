<?php

class SettingController extends Controller {
    public function actionShortLeaveSettings() {
        $shortLeaveSetting = AdmShortLeaveSettings::model()->find();
        $this->render('/setting/viewShortLeaveSetting', array('shortLeaveSetting' => $shortLeaveSetting));
    }
    
    public function actionUpdateShortLeaveSetting() {  
        $shortLeaveSettings = AdmShortLeaveSettings::model()->find();
        $shortLeaveSettings->short_lv_duration = $_POST['short_lv_duration'];  
        $shortLeaveSettings->max_leaves_per_day =$_POST['max_leaves_per_day'];  
        $shortLeaveSettings->max_leaves_per_month = $_POST['max_leaves_per_month'];
        $shortLeaveSettings->max_leaves_per_year = $_POST['max_leaves_per_year'];
        if ($shortLeaveSettings->save(false)) {
            $this->msgHandler(200, "Successfully Saved...");
        }
    }
}
