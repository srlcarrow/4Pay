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
        $model = new EmpBasic();
        $this->renderPartial('ajaxLoad/addEmployee', array('model' => $model));
    }

    public function actionSaveEmployee() {
        $model = new EmpBasic();
        $model->empno = $_POST['empno'];
        $model->epf_no = $_POST['epf_no'];
        $model->attendance_no = $_POST['attendance_no'];
        $model->emp_title = Yii::app()->request->getPost('EmpBasic')['emp_title'];
        $model->emp_gender = Yii::app()->request->getPost('EmpBasic')['emp_gender'];
        $model->emp_civil_status = Yii::app()->request->getPost('EmpBasic')['emp_civil_status'];
        $model->emp_full_name = $_POST['emp_full_name'];
        $model->emp_name_with_initials = $_POST['emp_name_with_initials'];
        $model->emp_display_name = $_POST['emp_display_name'];

        if ($model->save(false)) {
            $empContacts = new EmpContacts();
            $empContacts->ref_emp_id = $model->getPrimaryKey();
            $empContacts->save(false);
            $this->msgHandler(200, "Successfully Saved...");
        }
    }

}
