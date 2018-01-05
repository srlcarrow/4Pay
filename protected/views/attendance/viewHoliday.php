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
                                            <input type="hidden" id="holidayTypeHiddenId" name="holidayTypeHidden" value="0">
                                            <input type="text" id="holidayTypeId" name="holidayType" class="form-control">

                                        </div>

                                    </div>
                                </div>

                                <div class="row form-wrapper">
                                    <div class="col-md-12 text-right">
                                        <button id="btnSaveHoliType" class="btn btn-primary addNewPopup"  onclick="saveHolidayType()" type="button">Add New</button>
                                        <button class="btn btn-primary addNewPopup"  onclick="resetHolidayType()" type="button">Reset</button>
                                    </div>
                                </div>

                                <?php $this->endWidget(); ?>
                            </div>

                            <div class="col-md-12 mt-30">
                                <ul class="scroll">
                                    <?php
                                    foreach ($holidayTypes as $type) {
                                        ?>
                                        <li>
                                            <div class="ds-table-block mb-15">
                                                <div class="cell">
                                                    <h5><?php echo $type->holiday_type_name; ?></h5>
                                                </div>
                                                <div class="cell width-1 no-wrap">
                                                    <button id="<?php echo $type->holiday_type_id; ?>" name="<?php echo $type->holiday_type_name; ?>" onclick="edit(this.id, this.name)" type="button" class="ic ic_20 ic_edit"></button>
                                                    <button id="<?php echo $type->holiday_type_id; ?>" onclick="deleteHolidayType(this.id)" type="button" class="ic ic_20 ic_delete"></button>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>
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
            data: $('#search-form').serialize(),
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

    function saveHolidayType() {
        insert({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Attendance/SaveHolidayTypes'; ?>",
            data: $('#search-form').serialize(),
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {

                }
            }
        });
    }

    function edit(id, name) {
        document.getElementById("holidayTypeHiddenId").value = id;
        document.getElementById("holidayTypeId").value = name;
    }

    function resetHolidayType() {
        document.getElementById("holidayTypeHiddenId").value = 0;
        document.getElementById("holidayTypeId").value = "";
    }

    function deleteHolidayType(id) {
        insert({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Attendance/DeleteHolidayTypes'; ?>",
            data: {id: id},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {

                }
            }
        });
    }
</script>
