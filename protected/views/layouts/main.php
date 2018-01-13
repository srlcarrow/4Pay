<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
    <head>
        <title>oneHRIS</title>s
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">


        <!--========================================================
            Stylesheet
        =========================================================-->
        <!-- CSS | Fonts Collection -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl . '/css/fonts.css'; ?>">

        <!--CSS | bootstrap-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css">

        <!--CSS | Plugins -->
        <!-- Datepicker -->
        <link rel="stylesheet" type="text/css"
              href="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/airDatepicker/datepicker.min.css">
        <!-- Timepicker -->
        <link rel="stylesheet" type="text/css"
              href="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/timepicker/jquery-clockpicker.min.css">
        <!-- Scrollbar -->
        <link rel="stylesheet" type="text/css"
              href="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/scrollbar/jquery.mCustomScrollbar.min.css">
        <!--CSS | Main-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/sweetalert/sweetalert.css">



        <!--========================================================
            Javascript
        =========================================================-->

        <script>
            var BASE_URL = "<?php echo Yii::app()->baseUrl; ?>";
        </script>

        <script type="text/javascript">
            var http_path = "<?php echo Yii::app()->getBaseUrl(true); ?>/";
        </script>

        <?php
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/lib/jquery-1.11.2.min.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/bootstrap.min.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/airDatepicker/datepicker.min.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/airDatepicker/i18n/datepicker.en.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/timepicker/jquery-clockpicker.min.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/validate/jquery.validate.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/sweetalert/sweetalert.min.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/common/component.js', CClientScript::POS_HEAD);
        ?>

        <title></title>
    </head>

    <body>

        <!-- Header Container -->
        <header>
            <?php $this->beginContent('//layouts/menu'); ?>
            <?php echo $content; ?>
            <?php $this->endContent(); ?>
        </header>

        <!-- Main Container -->
        <div class="container">
            <?php echo $content; ?>
        </div>

        <div class="cm-alert">
            <div class="message">Save Successfuly</div>
        </div>
        <!--##### Scrollbar #####-->
        <script src="<?php echo Yii::app()->baseUrl . '/js/plugins/scrollbar/jquery.mCustomScrollbar.concat.min.js'; ?>"></script>

    </body>


</html>
