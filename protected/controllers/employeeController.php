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

    public function actionAddEmployee() {

        if (isset($_REQUEST['id']) && $_REQUEST['id'] != "") {
            $empId = $_REQUEST['id'];
            $model = EmpBasic::model()->findByPk($empId);
            $contact = EmpContacts::model()->findByAttributes(array('ref_emp_id' => $empId));
            if (count($contact) == 0) {
                $contact = new EmpContacts();
            }
            $employment = Employment::model()->findByAttributes(array('ref_emp_id' => $empId));
            if (count($employment) == 0) {
                $employment = new Employment();
            }
        } else {
            $empId = '';
            $model = new EmpBasic();
            $contact = new EmpContacts();
            $employment = new Employment();
        }

        $this->render('ajaxLoad/addEmployee', array('empId' => $empId, 'model' => $model, 'contact' => $contact, 'employment' => $employment));
    }

    public function actionGetSectionsByDepartmentID() {
        $sections = AdmSection::model()->findAllByAttributes(array('ref_dept_id' => $_POST['id']), array('order' => 'section_name'));
        $sectionData = array();
        foreach ($sections as $section) {
            $sectionDat["section_id"] = $section->section_id;
            $sectionDat["section_name"] = $section->section_name;
            array_push($sectionData, $sectionDat);
        }
        $this->msgHandler(200, "Data Transfer", array('sectionData' => $sectionData));
    }

    public function actionSaveEmployee() {
        $empId = $_POST['empId'];
        if ($empId == "") {
            $model = new EmpBasic();
        } else {
            $model = EmpBasic::model()->findByPk($_POST['empId']);
        }
        $model->empno = $_POST['empno'];
        $model->epf_no = $_POST['epf_no'];
        $model->attendance_no = $_POST['attendance_no'];
        $model->emp_title = Yii::app()->request->getPost('EmpBasic')['emp_title'];
        $model->emp_gender = Yii::app()->request->getPost('EmpBasic')['emp_gender'];
        $model->emp_civil_status = Yii::app()->request->getPost('EmpBasic')['emp_civil_status'];
        $model->emp_full_name = $_POST['emp_full_name'];
        $model->emp_name_with_initials = $_POST['emp_name_with_initials'];
        $model->emp_display_name = $_POST['emp_display_name'];
        $model->emp_dob = $_POST['emp_dob'];
        $model->ref_race = Yii::app()->request->getPost('EmpBasic')['ref_race'];
        $model->emp_nic = $_POST['emp_nic'];
        $model->ref_religion = Yii::app()->request->getPost('EmpBasic')['ref_religion'];
        $model->created_date = date('Y-m-d H:i:s');

        if ($model->save(false)) {
            if ($empId == "") {
                $empContacts = new EmpContacts();
                $employment = new Employment();
            } else {
                $empContacts = EmpContacts::model()->findByAttributes(array('ref_emp_id' => $empId));
                if (count($empContacts) == 0) {
                    $empContacts = new EmpContacts();
                }
                $employment = Employment::model()->findByAttributes(array('ref_emp_id' => $empId));
                if (count($employment) == 0) {
                    $employment = new Employment();
                }
            }

            $empContacts->ref_emp_id = $model->getPrimaryKey();
            $empContacts->con_permenant_add = $_POST['con_permenant_add'];
            $empContacts->con_temp_add = $_POST['con_temp_add'];
            $empContacts->con_office_email = $_POST['con_office_email'];
            $empContacts->con_personal_email = $_POST['con_personal_email'];
            $empContacts->con_mobile1 = $_POST['con_mobile1'];
            $empContacts->con_mobile2 = $_POST['con_mobile2'];
            $empContacts->con_home_tel = $_POST['con_home_tel'];
            $empContacts->updated_date = date('Y-m-d H:i:s');
            $empContacts->save(false);

            $employment->ref_emp_id = $model->getPrimaryKey();
            $employment->empl_joined_date = $_POST['empl_joined_date'];
            $employment->ref_designation = Yii::app()->request->getPost('Employment')['ref_designation'];
            $employment->ref_employment_type = Yii::app()->request->getPost('Employment')['ref_employment_type'];
            $employment->ref_branch_id = Yii::app()->request->getPost('Employment')['ref_branch_id'];
            $employment->ref_department_id = Yii::app()->request->getPost('Employment')['ref_department_id'];
            $employment->ref_section_id = $_POST['section'];
            $employment->ref_employment_category = Yii::app()->request->getPost('Employment')['ref_employment_category'];
            $employment->empl_employment_status = Yii::app()->request->getPost('Employment')['empl_employment_status'];
            $employment->is_generalshift_emp = Yii::app()->request->getPost('Employment')['is_generalshift_emp'];
            $employment->save(false);

            $this->msgHandler(200, "Successfully Saved...");
        }
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
            $thu->ref_shift_id = $_POST['thu_' . $empId];
            $thu->save(false);

//          Friday
            $fri = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $empId, 'day' => 'Friday'));
            if (count($fri) == 0) {
                $fri = new ShiftsForGeneralShiftEmployees();
            }

            $fri->ref_emp_id = $empId;
            $fri->day = "Friday";
            $fri->ref_shift_id = $_POST['fri_' . $empId];
            $fri->save(false);

//            Saturday
            $sat = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $empId, 'day' => 'Saturday'));
            if (count($sat) == 0) {
                $sat = new ShiftsForGeneralShiftEmployees();
            }

            $sat->ref_emp_id = $empId;
            $sat->day = "Saturday";
            $sat->ref_shift_id = $_POST['sat_' . $empId];
            $sat->save(false);

            $sun = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $empId, 'day' => 'Sunday'));
            if (count($sun) == 0) {
                $sun = new ShiftsForGeneralShiftEmployees();
            }

            $sun->ref_emp_id = $empId;
            $sun->day = "Sunday";
            $sun->ref_shift_id = $_POST['sun_' . $empId];
            $sun->save(false);
        }
    }

    public function actionViewProfile() {
        $empId = Controller::getEmpIdOfLoggedUser();
        $empBasicData = Empbasic::model()->findByPk($empId);
        $empContactsData = EmpContacts::model()->findByAttributes(array('ref_emp_id' => $empId));
        $empEmploymentData = Employment::model()->findByAttributes(array('ref_emp_id' => $empId));

        $this->render('viewProfile', array('empId' => $empId, 'empBasicData' => $empBasicData, 'empContactsData' => $empContactsData, 'empEmploymentData' => $empEmploymentData));
    }

    public function actionViewProfileData() {
        $empId = Controller::getEmpIdOfLoggedUser();
        $empBasicData = Empbasic::model()->findByPk($empId);
        $empContactsData = EmpContacts::model()->findByAttributes(array('ref_emp_id' => $empId));
        $empEmploymentData = Employment::model()->findByAttributes(array('ref_emp_id' => $empId));

        $empBasicData = count($empBasicData) == 0 ? new Empbasic() : $empBasicData;
        $empContactsData = count($empContactsData) == 0 ? new EmpContacts() : $empContactsData;
        $empEmploymentData = count($empEmploymentData) == 0 ? new Employment() : $empEmploymentData;
        $this->renderPartial('ajaxLoad/viewMyProfile', array('empId' => $empId, 'empBasicData' => $empBasicData, 'empContactsData' => $empContactsData, 'empEmploymentData' => $empEmploymentData));
    }

    public function actionViewMyAttendance() {
        if (count($_REQUEST) == 0) {
            $dateFrom = date('Y-m-d', strtotime(date('Y-m-d')) - (30 * 24 * 3600));
            $dateTo = date('Y-m-d');
        } else {
            $dateFrom = $_REQUEST["dateFrom"];
            $dateTo = $_REQUEST["dateTo"];
        }

        $empId = Controller::getEmpIdOfLoggedUser();
        $attendanceData = Yii::app()->db->createCommand('SELECT * FROM att_attendance aa WHERE aa.ref_emp_id=' . $empId . ' AND aa.day BETWEEN "' . $dateFrom . '" AND "' . $dateTo . '" ORDER BY aa.day DESC')->queryAll();

        $this->renderPartial('ajaxLoad/viewMyAttendance', array('attendanceData' => $attendanceData, 'dateFrom' => $dateFrom, 'dateTo' => $dateTo));
    }

    public function actionBasic() {
        $this->renderPartial('ajaxLoad/profile/basic');
    }

    public function actionViewLeave() {
        $this->renderPartial('ajaxLoad/profile/leave');
    }

    public function actionLeaveDate() {
        $this->renderPartial('ajaxLoad/profile/leave/leaveDate');
    }

    public function actionResetPassword() {
        $userId = Yii::app()->user->getId();
        $userData = User::model()->findByPk($userId);

        if ($userData->user_password != md5(md5($_POST['oldPw'] . $_POST['oldPw']))) {
            $this->msgHandler(400, "Enter Correct Current Password...");
            exit;
        }

        if ($_POST['pw'] != $_POST['rePw']) {
            $this->msgHandler(400, "Not Maching...");
            exit;
        }

        $userData->user_password = md5(md5($_POST['pw'] . $_POST['pw']));
        $userData->save(false);
        $this->msgHandler(200, "Password Changed...");
    }

}
