<?php
$mainLinks = AdmLinks::model()->findAllByAttributes(array('lnk_parent_id' => 0, 'lnk_is_module' => 0), array('order' => 'lnk_order ASC'));
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo Yii::app()->baseUrl; ?>">
                <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/company/logo/logo.png" alt="Logo">
            </a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <?php
            foreach ($mainLinks as $mainLink) {
                $subLinks = AdmLinks::model()->findAllByAttributes(array('lnk_parent_id' => $mainLink->lnk_id), array('order' => 'lnk_order ASC'));
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><?php echo strtoupper($mainLink->lnk_name); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        foreach ($subLinks as $subLink) {
                            $subUrl = Yii::app()->request->baseUrl . '/' . $subLink->lnk_controller . '/' . $subLink->lnk_action;
                            ?>
                            <li><a href="<?php echo $subUrl ?>"><?php echo $subLink->lnk_name; ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
                <?php
            }
            ?>
            <li class="dropdown notification">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">
                    <i class="bell"></i>
                    <span class="n-count">12</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Leave</a></li>
                    <li><a href="#">Lorem ipsum.</a></li>
                </ul>
            </li>

            <li class="dropdown user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">
                    <i></i>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo Yii::app()->request->baseUrl . '/Site/Logout' ?>">Logout</a></li>
                </ul>
            </li>


        </ul>

    </div><!-- /.container-fluid -->
</nav>