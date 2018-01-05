<?php

class SettingController extends Controller {

    public function init() {
        $this->redirectionToLogin();
    }

    public function actionShortLeaveSettings() {
        $this->render('/setting/viewShortLeaveSetting');
    }

}
