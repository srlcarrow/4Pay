<?php

class ComponentsController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionLogin() {
        $model = new SiteLoginForm('login');

        $model->username = $_POST['username'];
        $model->password = $_POST['password'];

        if ($model->login()) {
            $url = '';
            $userId = Yii::app()->user->id;
            $userData = User::model()->findByAttributes(array('user_id' => $userId));

            if ($userData->user_is_verified == 1 && $userData->user_is_finished == 1) {
                if ($userData->user_type == 1) {
                    $url = '';
                } elseif ($userData->user_type == 2) {
                    $url = 'Employer/ProfileDetails';
                }
                $this->msgHandler(200, "Login Successfull!", array('url' => $url));
            } elseif ($userData->user_is_verified == 0 && $userData->user_is_finished == 0) {
                Yii::app()->user->logout();
                $this->msgHandler(400, "Please verify your email first!");
            } elseif ($userData->user_is_verified == 1 && $userData->user_is_finished == 0) {
                if ($userData->user_type == 1) {
                    $jsData = JsBasic::model()->findByPk($userData->ref_emp_or_js_id);
                    $jsTempData = JsBasicTemp::model()->findByPk($jsData->ref_jsbt_id);

                    $url = "JobSeeker/ViewJobSeekerRegistration/id/" . $jsTempData->jsbt_encrypted_id;
                    $this->msgHandler(200, "Login Successfull!", array('url' => $url));
                } elseif ($userData->user_type == 2) {
                    $jsTempData = JsBasicTemp::model()->findByPk($userData->ref_emp_or_js_id);

                    $url = "Employer/ViewEmployerRegistration/id/" . $jsTempData->jsbt_encrypted_id;
                    $this->msgHandler(200, "Login Successfull!", array('url' => $url));
                }
            }
        } else {
            $this->msgHandler(400, "Incorrect Username or Password!");
        }
    }

}
