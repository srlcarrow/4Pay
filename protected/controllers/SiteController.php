<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('login'));
        } else {
            $totEmployees = yii::app()->db->createCommand("SELECT COUNT(*) AS totEmp FROM emp_basic eb LEFT JOIN emp_employment ee ON eb.emp_id=ee.ref_emp_id WHERE ee.empl_employment_status='active';")->setFetchMode(PDO::FETCH_OBJ)->queryAll();
            $totMale = yii::app()->db->createCommand("SELECT COUNT(*) AS totMale FROM emp_basic eb LEFT JOIN emp_employment ee ON eb.emp_id=ee.ref_emp_id WHERE eb.emp_gender='Male' AND ee.empl_employment_status='active';")->setFetchMode(PDO::FETCH_OBJ)->queryAll();
            $totFemale = yii::app()->db->createCommand("SELECT COUNT(*) AS totFemale FROM emp_basic eb LEFT JOIN emp_employment ee ON eb.emp_id=ee.ref_emp_id WHERE eb.emp_gender='Female' AND ee.empl_employment_status='active';")->setFetchMode(PDO::FETCH_OBJ)->queryAll();

            $this->render('index', array('totEmployees' => $totEmployees[0]->totEmp, 'totMale' => $totMale[0]->totMale, 'totFemale' => $totFemale[0]->totFemale));
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        if (yii::app()->user->isGuest) {
            $this->layout = 'login_layout';
            $model = new User();

//            if (isset($_REQUEST['controllerAction'])) {
//                if (!empty($_REQUEST['request_arr'])) {
//                    $url_param = '';
//                    foreach ($_REQUEST['request_arr'] as $key => $val) {
//                        $url_param .= "$key/$val/";
//                    }
//                    $url = $_REQUEST['controllerAction'] . "/" . $url_param;
//                } else {
//                    $url = $_REQUEST['controllerAction'];
//                }
//            }


            $this->render('login');
        } else {
            $this->render('index');
        }
    }

    public function actionSignIn() {
        $model = new LoginForm('login');

        $model->username = $_POST['username'];
        $model->password = $_POST['password'];


        if ($model->login()) {
            if (isset($url)) {
                $this->redirect(array($url));
            }
            $this->msgHandler(200, "Login Successfull...");
        } else {
            $this->msgHandler(400, "Error In Login Details...");
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionGetDashboardAttendanceData() {
        $array = array();
        $branches = AdmBranch::model()->findAll();

        foreach ($branches as $branch) {
            $noOfEmployees = yii::app()->db->createCommand("SELECT COUNT(*) AS empCount  FROM emp_basic eb LEFT JOIN emp_employment ee ON eb.emp_id=ee.ref_emp_id WHERE ee.empl_employment_status='active' AND ee.ref_branch_id=" . $branch->br_id . ";")->setFetchMode(PDO::FETCH_OBJ)->queryAll();
            $noOfAttendance = yii::app()->db->createCommand("SELECT COUNT(*) AS noOfAttendance FROM att_attendance aa LEFT JOIN emp_employment ee ON aa.ref_emp_id=ee.ref_emp_id WHERE ee.ref_branch_id=" . $branch->br_id . "; ")->setFetchMode(PDO::FETCH_OBJ)->queryAll();

            array_push($array, array($branch->br_name, (int) $noOfEmployees[0]->empCount, (int) $noOfAttendance[0]->noOfAttendance));
        }

        $this->msgHandler(200, "Login Successfull...", $array);
    }

}
