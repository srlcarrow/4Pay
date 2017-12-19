<?php
$mainLinks = AdmLinks::model()->findAllByAttributes(array('lnk_parent_id' => 0, 'lnk_is_module' => 0), array('order' => 'lnk_order ASC'));
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">

        <ul class="nav navbar-nav navbar-right">
            <?php
            foreach ($mainLinks as $mainLink) {
                $subLinks = AdmLinks::model()->findAllByAttributes(array('lnk_parent_id' => $mainLink->lnk_id), array('order' => 'lnk_order ASC'));
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo strtoupper($mainLink->lnk_name); ?> <span class="caret"></span></a>
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
            <li><a href="<?php echo Yii::app()->request->baseUrl . '/Site/Logout' ?>">Logout</a></li>
        </ul>

    </div><!-- /.container-fluid -->
</nav>