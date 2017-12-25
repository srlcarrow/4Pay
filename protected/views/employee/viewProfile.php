<?php
// profile
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/profile/profile.css', 'screen');
?>

<section class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo $empBasicData->emp_display_name; ?></h1>
                <h3><?php echo $empEmploymentData->rel_designation->designation; ?></h3>
            </div>
        </div>
    </div>
</section>

<section class="tab-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="cm-tab cm-ajax-tab">
                    <li><a class="is-active" onclick="profile()" href="#profile">Profile</a></li>
                    <li><a href="#Leave" onclick="myAttendance()">My Attendance</a></li>
                    <li><a href="#Leave" onclick="leave()">Leave</a></li>
                    <li><a href="#Leave" onclick="shortLeave()">Short Leave</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="content-bar">
    <div class="container">
        <div class="row">
            <div id="ajaxLoad"></div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function (e) {
        profile();
    });

    function profile() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/ViewProfileData'; ?>",
            data: "",
            success: function (responce) {
                $("#ajaxLoad").html(responce);
            }
        });
    }

    function myAttendance() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/ViewMyAttendance'; ?>",
            data: "",
            success: function (responce) {
                $("#ajaxLoad").html(responce);
            }
        });
    }

    function leave() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/ViewLeave'; ?>",
            data: "",
            success: function (responce) {
                $("#ajaxLoad").html(responce);
            }
        });
    }

    function shortLeave() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/ViewProfileData'; ?>",
            data: "",
            success: function (responce) {
                $("#ajaxLoad").html(responce);
            }
        });
    }
</script>