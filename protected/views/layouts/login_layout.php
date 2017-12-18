<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8"/>
        <title>TEST</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>

        <!--========================================================
        Stylesheet
         =========================================================-->
        <!--CSS | bootstrap-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css">
        <!--CSS | Main-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">


        <!--========================================================
            Javascript
        =========================================================-->
        <!--JS | Jquery Lib-->
        <script src="<?php echo Yii::app()->baseUrl . '/js/lib/jquery-3.2.1.min.js'; ?>"></script>
        <!--JS | Bootstrap -->
        <script src="<?php echo Yii::app()->baseUrl . '/js/bootstrap.min.js'; ?>"></script>
        
        <script type="text/javascript" >
            var http_path = "<?php echo Yii::app()->getBaseUrl(true); ?>/";
        </script>

    </head>
    <body class="login">
        <!--Login form-->
        <div class="content">

            <?php echo $content; ?>

            <div class="row">
                <div class="col s4 offset-s4">
                    <!--Message area-->
                    <div class="card-panel adm-alert" role="alert"></div>
                </div>
            </div>
        </div>
    </body>

</html>

