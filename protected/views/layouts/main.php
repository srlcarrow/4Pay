<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


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
    <script>
        var BASE_URL = "<?php echo Yii::app()->baseUrl; ?>";
    </script>

    <script type="text/javascript">
        var http_path = "<?php echo Yii::app()->getBaseUrl(true); ?>/";
    </script>

    <!--JS | Jquery Lib-->
    <script src="<?php echo Yii::app()->baseUrl . '/js/lib/jquery-3.2.1.min.js'; ?>"></script>
    <!--JS | Bootstrap -->
    <script src="<?php echo Yii::app()->baseUrl . '/js/bootstrap.min.js'; ?>"></script>


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
</body>
</html>
