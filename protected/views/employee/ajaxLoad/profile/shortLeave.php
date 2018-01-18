<div class="card flat mt-30">


    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'shortLeaveForm')); ?>
    <?php
    $shtlvDuration = $shortLeaveSetting->short_lv_duration;
    $maxLeavsPerDay = $shortLeaveSetting->max_leaves_per_day;
    ?>

    <!--    <div class="card-header">-->
    <!--        <h1>Short Leave Requisition</h1>-->
    <!--    </div>-->

    <div class="card-content">

        <div class="row m-m-30">
            <div class="col-md-12 pl-0 pr-0 bg-primary-dark mb-30">
                <div class="ds-table-block width-100">

                    <div class="cell width-20 pl-30 pr-30 ">
                        <div class="pt-25 pb-25">
                            <div class="f-24 text-nowrap">
                                <span class="text-white f-500">2</span>
                                <span class="text-white">hrs</span>
                            </div>
                            <h6 class="text-uppercase lighten-2 text-white f-14">January</h6>
                        </div>
                    </div>

                    <div class="cell width-80 pl-30 pr-30">
                        <div class="pt-25 pb-25">
                            <div class="ds-table-block width-1">

                                <div class="width-1 text-nowrap cell pr-30 white-border-right w-2 lighten-2">
                                    <div class="f-24  ds-block text-white f-500 line-h-20">
                                        <span class="text-white">1.5</span>
                                        <span class="f-400">hrs</span>
                                    </div>
                                    <span class="f-14 ds-block text-white lighten-2 f-300">Utilize</span>
                                </div>

                                <div class="width-1 text-nowrap cell pl-30">
                                    <div class="f-24 ds-block text-white f-500 line-h-20">
                                        <span class="text-white">30</span>
                                        <span class="f-400">min</span>
                                    </div>
                                    <span class="f-14 ds-block text-white lighten-2 f-300">Balance</span>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="row form-wrapper">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Purpose</label>
                    <input type="text" id="purpose" name="purpose" value="" class="form-control" required>
                </div>
            </div>

            <div class="col-md-4 ">
                <div class="form-group">
                    <label>Short Leave Date</label>
                    <?php $currentDate = Controller::getCountryDate(); ?>
                    <input type="text" name="shtLvDate" value="<?php echo $currentDate; ?>"
                           class="input-datepicker form-control required">
                </div>
            </div>
        </div>

        <div class="row form-wrapper">
            <div class="col-lg-4 input-layout">
                <div class="form-group">
                    <label>Duration</label>
                    <select name="noOfLeaves" id="noOfLeaves" onchange="selectNoLeaves()"
                            class="form-control required" required>
                        <option value="0">Select Duration</option>
                        <?php for ($x = 1; $x <= $maxLeavsPerDay; $x++) { ?>
                            <option value="<?php echo $x; ?>"><?php echo ($x * $shtlvDuration) . ' mins'; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-4 ">
                <div class="form-group">
                    <label>Start Time</label>
                    <input type="text" name="startTime" id="startTime" value=""
                           class="input-timepicker time_picker form-control" required>
                </div>
            </div>

            <div class="col-md-4 ">
                <div class="form-group">
                    <label>End Time</label>
                    <input type="text" name="endTime" id="endTime" value="" class="form-control">
                    <input name="endDateTime" id="endDateTime" type="hidden">
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-primary">Apply</button>
            </div>
        </div>
    </div>

    <?php $this->endWidget(); ?>


</div>

<div id="ajaxLoad-sl" class="ajaxLoad-sl"></div>

<script>
    $(document).ready(function (e) {
        empShortLeaveHistory(<?php echo $empId; ?>);
    });

    $("#shortLeaveForm").validate({
        submitHandler: function () {
            requestShortLeave();
        }
    });

    function selectNoLeaves() {
        getShortLeaveEndTime();
    }

    function getShortLeaveEndTime() {
        var purpose = $('#purpose').val();
        var noOfLeaves = $('#noOfLeaves').val();
        if (noOfLeaves == 0) {
            sweetAlert('Can Not Apply a Short Leave!', 'Please enter the duration of the Short Leave.');
        } else {
            fetch({
                url: '<?php echo $this->createUrl('ShortLeave/GetShortLeaveEndTime'); ?>',
                data: $('#shortLeaveForm').serialize() + "&id=" + <?php echo $empId; ?>,
                type: 'POST',
                dataType: 'json',
                success: function (responce) {
                    $("#endTime").val(responce.shortLvEndTime);
                    $("#endDateTime").val(responce.shortLvEndDateTime);

                }
            });
        }
    }

    function requestShortLeave() {

        Alert().loading();

        insert({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/ShortLeave/RequestShortLeave'; ?>",
            data: $('#shortLeaveForm').serialize() + '&id=<?php echo $empId; ?>',
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {

                    Alert().success(responce.msg);

                    $("#shortLeaveForm")[0].reset();
                    empShortLeaveHistory(<?php echo $empId; ?>);
                } else {
                    Alert().error(responce.msg);
                }
            }
        });
    }

    function empShortLeaveHistory(id) {
        fetch({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/ShortLeave/ViewEmpShortLeaveHistory'; ?>",
            data: {empId: <?php echo $empId; ?>},
            success: function (responce) {
                $("#ajaxLoad-sl").html(responce);
            }
        });
    }

    $('.time_picker').on('change', function () {
        getShortLeaveEndTime();
    });

    function deleteShortLeave(id) {
        swal({
                title: "Are you sure?",
                text: "You will not have this data anymore!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo Yii::app()->createUrl('ShortLeave/deleteShortLeave'); ?>",
                        data: "deleteId=" + id,
                        success: function (res) {
                            if (res) {
                                setTimeout(function () {
                                    empShortLeaveHistory(<?php echo $empId; ?>);
                                }, 500);
                            } else {
                                swal("Cancelled", "You are not allowed to delete today's short leaves.", "error");
                            }
                        }
                    });
                }
            }
        );

    }

    datePicker({
        ele: '.input-datepicker'
    })

</script>
