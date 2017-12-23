<?php

class employeeController extends Controller {

    public function actionViewEmployee() {
        $controller = "employee";
        $action = "ViewEmployeeData";
        $this->render('/search/searchF1', array('controller' => $controller, 'action' => $action));
    }

    public function actionViewEmployeeData() {
        $sql = Yii::app()->db->createCommand()
                ->select('*')
                ->from('emp_basic emp')
                ->getText();

        $limit = 5;
        $data = Controller::createSearchForEmployee($sql, 'emp.emp_id', Yii::app()->request->getPost('page'), $limit, 'emp.epf_no');

        $employeeData = $data['result'];
        $pageCount = $data['count'];
        $currentPage = Yii::app()->request->getPost('page');

        $this->renderPartial('ajaxLoad/viewEmployeeData', array('employeeData' => $employeeData));
    }

    public function actionViewIssueUserAccounts() {
        $controller = "employee";
        $action = "ViewIssueUserAccountsData";
        $this->render('/search/searchF1', array('controller' => $controller, 'action' => $action));
    }

    public function actionViewIssueUserAccountsData() {
        $sql = Yii::app()->db->createCommand()
                ->select('*')
                ->from('emp_basic emp')
                ->getText();


        $limit = $_REQUEST["noOfData"];
        $data = Controller::createSearchForEmployee($sql, 'emp.emp_id', Yii::app()->request->getPost('page'), $limit, 'emp.epf_no ASC');

        $employeeData = $data['result'];
        $pageCount = $data['count'];
        $currentPage = Yii::app()->request->getPost('page');

        $this->renderPartial('issueUserAccounts', array('employeeData' => $employeeData, 'pageSize' => $limit, 'page' => $currentPage, 'count' => $pageCount));
    }

    public function actionIssueAccounts() {
        $selectedEmployees = $_POST['selectedIds'];
        $userId = Yii::app()->user->getId();

        foreach ($selectedEmployees as $empId) {
            $empBasicData = Empbasic::model()->findByPk($empId);
            $empContactData = EmpContacts::model()->findByAttributes(array('ref_emp_id' => $empId));
            $user = User::model()->findByAttributes(array('ref_emp_id' => $empId));
            $password = Controller::randomPassword();

            if (count($user) > 0) {
                $user->ref_emp_id = $empId;
                $user->user_name = $user->user_name;
                $user->user_password = md5(md5($password . $password));
                $user->ref_user_type_id = $_POST['userType_' . $empId];
                $user->is_acc_issued = 1;
                $user->user_acc_issued_date = $user->user_acc_issued_date;
                $user->created_date = date('Y-m-d H:i:s');
                $user->created_by = $userId;
                $user->updated_date = date('Y-m-d H:i:s');
                $user->updated_by = $userId;
                $user->save(false);
            } else {
                $user = new User();
                $user->ref_emp_id = $empId;
                $user->user_name = $empBasicData->empno;
                $user->user_password = md5(md5($password . $password));
                $user->ref_user_type_id = $_POST['userType_' . $empId];
                $user->is_acc_issued = 1;
                $user->user_acc_issued_date = date('Y-m-d H:i:s');
                $user->created_date = date('Y-m-d H:i:s');
                $user->created_by = $userId;
                $user->updated_date = date('Y-m-d H:i:s');
                $user->updated_by = $userId;
                $user->save(false);
            }

//            $msg = EmailGenerator::setEmailMessageBodyUser('user_created', '2', $jsId, $jsBasicTemp->jsbt_email, $password, false);
//            $subjct = "User Account Details";
//            $to = $_POST['email'];
//            EmailGenerator::SendEmail($msg, $to, $subjct);
        }
    }

    public function actionUpdateAccounts() {
        $selectedEmployees = $_POST['selectedIds'];
        $userId = Yii::app()->user->getId();

        foreach ($selectedEmployees as $empId) {
            $empBasicData = Empbasic::model()->findByPk($empId);
            $empContactData = EmpContacts::model()->findByAttributes(array('ref_emp_id' => $empId));
            $user = User::model()->findByAttributes(array('ref_emp_id' => $empId));
            $password = Controller::randomPassword();

            if (count($user) > 0) {
                $user->ref_emp_id = $empId;
                $user->user_name = $user->user_name;
                $user->user_password = md5(md5($password . $password));
                $user->ref_user_type_id = $_POST['userType_' . $empId];
                $user->is_acc_issued = 1;
                $user->user_acc_issued_date = $user->user_acc_issued_date;
                $user->created_date = date('Y-m-d H:i:s');
                $user->created_by = $userId;
                $user->updated_date = date('Y-m-d H:i:s');
                $user->updated_by = $userId;
                $user->save(false);
            } else {
                $user = new User();
                $user->ref_emp_id = $empId;
                $user->user_name = $empBasicData->empno;
                $user->user_password = md5(md5($password . $password));
                $user->ref_user_type_id = $_POST['userType_' . $empId];
                $user->is_acc_issued = 1;
                $user->user_acc_issued_date = date('Y-m-d H:i:s');
                $user->created_date = date('Y-m-d H:i:s');
                $user->created_by = $userId;
                $user->updated_date = date('Y-m-d H:i:s');
                $user->updated_by = $userId;
                $user->save(false);
            }
        }
    }

    public function actionProfile() {
        $this->render('profile');
    }

    public function actionViewShiftAllocator() {
        $controller = "employee";
        $action = "ViewShiftAllocationData";
        $this->render('/search/searchF1', array('controller' => $controller, 'action' => $action));
    }

    public function actionViewShiftAllocationData() {
        $sql = Yii::app()->db->createCommand()
                ->select('*')
                ->from('emp_basic emp')
                ->getText();

        $limit = $_REQUEST["noOfData"];
        $data = Controller::createSearchForEmployee($sql, 'emp.emp_id', Yii::app()->request->getPost('page'), $limit, 'emp.epf_no ASC');

        $employeeData = $data['result'];
        $pageCount = $data['count'];
        $currentPage = Yii::app()->request->getPost('page');

        $this->renderPartial('viewShiftAllocatorData', array('employeeData' => $employeeData, 'pageSize' => $limit, 'page' => $currentPage, 'count' => $pageCount));
    }

    public function actionSaveShiftsOfGSEmployees() {
        $selectedEmployees = $_POST['selectedIds'];

        foreach ($selectedEmployees as $empId) {
//           Monday
            $mon = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $empId, 'day' => 'Monday'));
            if (count($mon) == 0) {
                $mon = new ShiftsForGeneralShiftEmployees();
            }

            $mon->ref_emp_id = $empId;
            $mon->day = "Monday";
            $mon->ref_shift_id = $_POST['mon_' . $empId];
            $mon->save(false);

//            Tuesday
            $tue = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $empId, 'day' => 'Tuesday'));
            if (count($tue) == 0) {
                $tue = new ShiftsForGeneralShiftEmployees();
            }

            $tue->ref_emp_id = $empId;
            $tue->day = "Tuesday";
            $tue->ref_shift_id = $_POST['tue_' . $empId];
            $tue->save(false);

//            Wednesday
            $wed = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $empId, 'day' => 'Wednesday'));
            if (count($wed) == 0) {
                $wed = new ShiftsForGeneralShiftEmployees();
            }

            $wed->ref_emp_id = $empId;
            $wed->day = "Wednesday";
            $wed->ref_shift_id = $_POST['wed_' . $empId];
            $wed->save(false);

//            Thursday
            $thu = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $empId, 'day' => 'Thursday'));
            if (count($thu) == 0) {
                $thu = new ShiftsForGeneralShiftEmployees();
            }

            $thu->ref_emp_id = $empId;
            $thu->day = "Thursday";
            $thu->ref_shift_id = $_POST['wed_' . $empId];
            $thu->save(false);

//          Friday
            $fri = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $empId, 'day' => 'Friday'));
            if (count($fri) == 0) {
                $fri = new ShiftsForGeneralShiftEmployees();
            }

            $fri->ref_emp_id = $empId;
            $fri->day = "Friday";
            $fri->ref_shift_id = $_POST['wed_' . $empId];
            $fri->save(false);

//            Saturday
            $sat = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $empId, 'day' => 'Saturday'));
            if (count($sat) == 0) {
                $sat = new ShiftsForGeneralShiftEmployees();
            }

            $sat->ref_emp_id = $empId;
            $sat->day = "Saturday";
            $sat->ref_shift_id = $_POST['wed_' . $empId];
            $sat->save(false);

            $sun = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $empId, 'day' => 'Sunday'));
            if (count($sun) == 0) {
                $sun = new ShiftsForGeneralShiftEmployees();
            }

            $sun->ref_emp_id = $empId;
            $sun->day = "Sunday";
            $sun->ref_shift_id = $_POST['wed_' . $empId];
            $sun->save(false);
        }
    }

}
