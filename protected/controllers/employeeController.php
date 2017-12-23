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

        $this->renderPartial('issueUserAccounts', array('employeeData' => $employeeData, 'pageSize' => $limit, 'page' => 1, 'count' => $pageCount));
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

}
