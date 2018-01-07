<?php
$notificationCount = 0;
$userId = Yii::app()->user->getId();
$userTypeId = User::model()->findByPk($userId)->ref_user_type_id;
$empId = Controller::getEmpIdOfLoggedUser();
$mainLinks = AdmLinks::model()->findAllByAttributes(array('lnk_parent_id' => 0, 'lnk_is_module' => 0), array('order' => 'lnk_order ASC'));
$pendingSLeavesFirstApprover = ShortLeave::model()->findAllByAttributes(array('approver_id' => $empId, 'approver_status' => 0, 'final_status' => 0));
$pendingSLeavesSecondApprover = ShortLeave::model()->findAllByAttributes(array('second_approver_id' => $empId, 'approver_status' => 1, 'second_approver_status' => 0, 'final_status' => 0));
$notificationCount = count($pendingSLeavesFirstApprover) + count($pendingSLeavesSecondApprover);
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
                $permissionMain = UserPermission::model()->findAllByAttributes(array('ref_ut_id' => $userTypeId, 'ref_link_id' => $mainLink->lnk_id, 'is_view' => 1));
                $subLinks = AdmLinks::model()->findAllByAttributes(array('lnk_parent_id' => $mainLink->lnk_id), array('order' => 'lnk_order ASC'));
                ?>
                <?php if (count($permissionMain) > 0) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false"><?php echo strtoupper($mainLink->lnk_name); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            foreach ($subLinks as $subLink) {
                                $permissionSub = UserPermission::model()->findAllByAttributes(array('ref_ut_id' => $userTypeId, 'ref_link_id' => $subLink->lnk_id, 'is_view' => 1));
                                $subUrl = Yii::app()->request->baseUrl . '/' . $subLink->lnk_controller . '/' . $subLink->lnk_action;
                                if (count($permissionSub) > 0) {
                                    ?>
                                    <li><a href="<?php echo $subUrl ?>"><?php echo $subLink->lnk_name; ?></a></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                }
            }
            ?>
            <li class="dropdown notification">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">
                    <i class="bell"></i>
                    <span class="n-count"><?php echo $notificationCount; ?></span>
                </a>
                <ul class="dropdown-menu">
                    <?php if (count($pendingSLeavesFirstApprover) > 0) { ?>
                        <li><a href="<?php echo Yii::app()->baseUrl; ?>/ShortLeave/ViewPendingShortLeave">Approve Short Leave(<?php echo count($pendingSLeavesFirstApprover) ?>)</a></li>
                    <?php } ?>
                    <?php if (count($pendingSLeavesSecondApprover) > 0) { ?>
                        <li><a href="<?php echo Yii::app()->baseUrl; ?>/ShortLeave/ViewPendingShortLeaveSecondApprover">Approve Short Leave - Second Approver(<?php echo count($pendingSLeavesSecondApprover) ?>)</a></li>
                    <?php } ?>    
                </ul>
            </li>

            <li class="dropdown user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">

                    <div class="avatar ">
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/avatar/30/avatar.png" alt="">
                    </div>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo Yii::app()->request->baseUrl . '/Site/Logout' ?>">Logout</a></li>
                </ul>
            </li>


        </ul>

    </div><!-- /.container-fluid -->
</nav>