<?php

class AttendanceTransferServiceController extends Controller {

    static function getPost() {

        $json = json_decode(file_get_contents('php://input'));
        $postArry = AttendanceTransferServiceController::toArray($json);
        return $postArry;
    }

    static function toArray($obj) {

        if (is_object($obj))
            $obj = (array) $obj;

        if (is_array($obj)) {
            $new = array();
            foreach ($obj as $key => $val) {
                $new[$key] = AttendanceTransferServiceController::toArray($val);
            }
        } else {
            $new = $obj;
        }
        return $new;
    }

    public function actionAttendancePost() {
        $postData = $this->getPost();
        $model = new Allattendance;
        $model->emp_no = $postData['USERID'];
        $model->checktime = $postData['CHECKTIME'];
        $model->machine_serial_no = $postData['sn'];
        $model->Branch = $postData['BRANCH'];
//   
//        $postData['USERID'],$postData['CHECKTIME']
        if ($model->save(false)) {
            Attendance::dailyAttendance($postData['USERID'], $postData['CHECKTIME'],$postData['BRANCH'],1);
            echo json_encode(array("code" => "200"));
        }
    }

    //this is for orient finance hysoon machine
    public function actionAttendanceHysoonPost() {
        $postData = $this->getPost();
        $model = new Allattendance;
        $model->emp_no = $postData['USERID'];
        $model->checktime = $postData['CHECKTIME'];
        $model->machine_serial_no = $postData['sn'];
        $model->Branch = $postData['BRANCH'];

        if ($model->save(false)) {
            Attendance::dailyAttendance($postData['USERID'], $postData['CHECKTIME'],$postData['BRANCH'],1);
            echo json_encode(array("code" => "200"));
        }


//    if($model->save(false)){      
//      if($this->actionAutoMachinDataFeed($postData['USERID'], $postData['CHECKTIME'], $postData['BRANCH'])){
//        echo json_encode(array("code" => "200"));
//      }
//    } 
    }

    //this is for Android Mobile Phon
    public function actionAttendanceAndroid() {

        $postData = $this->getPost();
        $model = new Allattendance;
        $dateTime = $this->getCountryDate();
        $emp_ids = Empbasic::model()->findByPk($postData['USERID']);
        $model->emp_no = $emp_ids->emp_no;
        $model->checktime = $dateTime;
        $model->machine_serial_no = "Android";
        $model->Branch = $postData['AREA'];

        if ($model->save(false)) {
            if ($this->actionAutoMachinDataFeed($emp_ids->emp_no, $dateTime, $postData['AREA'])) {
                echo json_encode(array("code" => "200", "msg" => "ok"));
            }
        } else {
            echo json_encode(array("code" => "400", "msg" => "Error"));
        }
    }

    public function actionTest() {
        $attendance = Allattendance::model()->findAll();
//    $this->actionDailyAttendance(1,"2015-11-6 19:43:26");
        foreach ($attendance as $value) {
            $empno = null;
            $punch = null;
            $empno = $value->emp_no;
            $punch = $value->checktime;
            $this->actionAutoMachinDataFeed($empno, $punch);
        }
    }

    public function actionAutoMachinDataFeed($emp_no, $punch_date_time, $branch) {
        set_time_limit(0);
        $model = new Dailyattendance;

        $punch_in = '';
        $punch_out = '';
        $emp_ids = Empbasic::model()->findAllByAttributes(array('emp_attendance_no' => array($emp_no)));
        $getValue = explode(" ", $punch_date_time);
        $getFirstDate = $getValue[0];
        $getFirstTime = $getValue[1];

        if (count($emp_ids) > 0) {
            $emp_id = $emp_ids[0]->emp_id;
            $atten_date = date('Y-m-d', strtotime($getFirstDate));
            $dailyattandence = Dailyattendance::model()->findAllByAttributes(array('ref_emp_id' => array($emp_id), 'date' => array($atten_date)));

            if (count($dailyattandence) > 0) {
                $model = new Dailyattendance;
                $modelLast = $dailyattandence[0];

                $punch_out_date = date('Y-m-d', strtotime($getFirstDate));
                $model->date_out = $punch_out_date;
                if ($getFirstTime == '') {
                    $punch_out = '00:00:00';
                } else {
                    $punch_out = date('H:i:s', strtotime($getFirstTime));
                }

                $model->punch_out = $punch_out;

                $ref_emp_id = $modelLast->ref_emp_id;
                $punch_in = $modelLast->punch_in;
                $punch_in_date = $modelLast->date;
                $punch_out_date = $modelLast->date;

                $model->over_time = $model->getOverTime($ref_emp_id, $punch_in_date, $punch_in, $punch_out);
                $model->early_living = $model->getEarlyLeave($ref_emp_id, $punch_in_date, $punch_in, $punch_outo);
                $model->late_time = $model->getLateTime($ref_emp_id, $punch_in_date, $punch_in, $punch_out);
                $model->early_time = $model->getEarlyCame($ref_emp_id, $punch_in_date, $punch_in, $punch_out);
                $model->atten_id = $modelLast->atten_id;
                $res = $model->updateAll(array('over_time' => $model->over_time, 'early_living' => $model->early_living, 'late_time' => $model->late_time, 'punch_out' => $model->punch_out, 'date_out' => $punch_out_date, 'punch_out_location' => $branch), 'atten_id = ' . $modelLast->atten_id . '');
                return true;
            } else {
                $model = new Dailyattendance;
                $model->ref_emp_id = $emp_id;
                $punch_in_date = $atten_date;
                $model->day = $punch_in_date;
                $model->date = $punch_in_date;

                if ($getFirstTime == '') {
                    $punch_in = '00:00:00';
                } else {
                    $punch_in = date('H:i:s', strtotime($getFirstTime));
                }
                $model->punch_in = $punch_in;
                $model->punch_in_location = $branch;
                $model->save(false);
                return true;
            }
        }
    }

}
