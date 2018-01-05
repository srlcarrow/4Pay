<?php

class LoginController extends Controller {

    public function init() {
        $this->redirectionToLogin();
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionTest() {
        $this->render('index');
    }

}
