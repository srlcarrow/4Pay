<?php
//==============================================================================
//      Plugins CSS
//==============================================================================
// mScroll Bar
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/plugins/mScrollbar/jquery.mCustomScrollbar.min.css', 'screen');
// Time picker
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/plugins/clockpicker/bootstrap-clockpicker.css', 'screen');


//==============================================================================
//      CSS
//==============================================================================
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/custom/form.css', 'screen');
//popup
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/custom/popup.css', 'screen');
// Recruitment Common
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/calendar/calendar.css', 'screen');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/calendar/holiday-cnd.css', 'screen');


//==============================================================================
//      JS
//==============================================================================
// form
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/custom/form.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/validate/jquery.validate.js', CClientScript::POS_HEAD);

//==============================================================================
//      Plugins JS
//==============================================================================
// mScroll Bar
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/mScrollbar/jquery.mCustomScrollbar.concat.min.js', CClientScript::POS_HEAD);
// Time picker
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/clockpicker/bootstrap-clockpicker.min.js', CClientScript::POS_HEAD);
?>


<!--Breadcrumb-->
<div class="bread-crumb-wrp">
    <a href="#">Payroll</a>
    <a>Holiday Calender</a>
</div>

<div class="contert-wrapper mb-30 pb-30">

    <div class="col-md-12 header-with-mn">
        <h1 class="title">
            Holiday Calender
        </h1>
    </div>
    <div></div>

    <div class="modal fade ajaxAddCalender" id="addNewModal" tabindex="-1" role="dialog">


    </div>
    <div class="col-md-12">

        <div class="col-md-12">

            <div class="row">
                <?php $form = $this->beginWidget('CActiveForm', array('id' => 'search-form')); ?>
                <div class="col-md-12 mb-30">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">                                
                                <div class="col-md-4">
                                    <select class="big-select" name="year" id="" onchange="loadCalenderData()">
                                        <?php
                                        $years = $this->viewYearArry();
                                        foreach ($years as $year) {
                                            $selected = ($year == date('Y') ? 'selected' : '');
                                            ?>
                                            <option value="<?php echo $year; ?>" <?php echo $selected; ?> ><?php echo $year; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <select class="big-select" name="month" id="" onchange="loadCalenderData()">
                                        <?php
                                        $months = $this->getMonthList();
                                        foreach ($months as $key => $month) {
                                            $selected = ($key == date('m') ? 'selected' : '');
                                            ?>
                                            <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $month; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div> 

                        <div class="col-md-4">
                            <button class="but new m-0 addNewPopup" type="button" ><span></span>Add New</button>
                        </div>

                    </div>

                </div>
                <?php $this->endWidget(); ?>
                <div id="ajaxLoad">

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    $(function () {
        $('.main-wrapper').removeClass('container').addClass('container-fluid')
    });
</script>

<script>
    $('.addNewPopup').on('click', function () {
        ajaxAddCalenderShow();
        $addNewModal = $('#addNewModal');
        $addNewModal.modal('show');
    });
</script>
<!-- ===========================================================================
        Backend Script
============================================================================ -->
<script>
    $(document).ready(function (e) {
        loadCalenderData();
    });

    function loadCalenderData() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Attendance/HolidayCalendarData'; ?>",
            data: "",
            success: function (responce) {
                $("#ajaxLoad").html(responce);
            }
        });
    }
    function my() {
        document.getElementById("DisplayData").innerHTML = ajaxAddCalenderShow();
    }

    function editCalendar(id) {
        var id = id.split("_");
        document.getElementById("calType").value = document.getElementById('editText_' + id[1]).value;
        document.getElementById("id").value = id[1];
        form.reset();
    }

    function deleteCalendar(id) {
        showInfoMessage();
        var extraData = "&id=" + id;
        sendData('addCalendar', extraData, 'attendance/DeleteCalendar', function (res) {
            var obj = jQuery.parseJSON(res);
            if (obj.code == 200) {
                showSuccessMessage(obj.msg.msg);
                setInterval(function () {
                    my();
                });

            } else {
                showErrorMessage(obj.msg.msg);
            }
        });
    }

    function cancelEdit() {
        document.getElementById("id").value = "0";
        document.getElementById("calType").value = "";
    }
</script> 

<script>

    function ajaxAddCalenderShow() {
        displayLoader(".ajaxAddCalender");
        var extraData = "";
        sendData('', extraData, 'Attendance/CalenderPopupView', function (res) {
            $('.ajaxAddCalender').html(res);
        });
    }


    function refeshData() {
        location.reload();
    }
</script>