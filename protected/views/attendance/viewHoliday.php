<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/calender/holiday.css', 'screen');

?>

<div class="modal fade ajaxAddCalender" id="addNewModal" tabindex="-1" role="dialog"></div>

<div class="row mb-30">

    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h1>Holiday Calender</h1>
            </div>

            <div class="card-content">
                <div class="row">

                    <div class="col-md-3">

                        <div class="row">
                            <div class="col-md-12">
                                <?php $form = $this->beginWidget('CActiveForm', array('id' => 'search-form')); ?>

                                <div class="row form-wrapper">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Year</label>

                                            <select class="form-control" name="year" id=""
                                                    onchange="loadCalenderData()">
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

                                    </div>
                                </div>

                                <div class="row form-wrapper">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Month</label>

                                            <select class="form-control" name="month" id=""
                                                    onchange="loadCalenderData()">
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

                                <div class="row form-wrapper">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Holiday Type</label>
                                            <input type="text" class="form-control">
                                        </div>

                                    </div>
                                </div>

                                <div class="row form-wrapper">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary addNewPopup" type="button">Add New</button>
                                    </div>
                                </div>

                                <?php $this->endWidget(); ?>
                            </div>

                            <div class="col-md-12 mt-30">
                                <ul class="scroll">
                                    <li>
                                        <div class="ds-table-block mb-15">
                                            <div class="cell">
                                                <h5>Sunday</h5>
                                            </div>
                                            <div class="cell width-1 no-wrap">
                                                <button type="button" class="ic ic_20 ic_edit"></button>
                                                <button type="button" class="ic ic_20 ic_delete"></button>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ds-table-block mb-15">
                                            <div class="cell">
                                                <h5>Poya Day</h5>
                                            </div>
                                            <div class="cell width-1 no-wrap">
                                                <button type="button" class="ic ic_20 ic_edit"></button>
                                                <button type="button" class="ic ic_20 ic_delete"></button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-9">
                        <div class="row" id="ajaxLoad">

                        </div>
                    </div>

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