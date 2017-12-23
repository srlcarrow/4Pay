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

}
