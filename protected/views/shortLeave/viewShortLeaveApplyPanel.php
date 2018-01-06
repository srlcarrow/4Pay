<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">
            <?php $form = $this->beginWidget('CActiveForm', array('id' => 'shortLeaveForm')); ?>
            <?php
            $shtlvDuration = $shortLeaveSetting->short_lv_duration;
            $maxLeavsPerDay = $shortLeaveSetting->max_leaves_per_day;
            ?> 
            <div class="card-header">
                <h1>Request Short Leave</h1>
            </div>
            <div class="row form-wrapper">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Purpose</label>
                        <input type="text" name="purpose" value="" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-4 ">
                    <div class="form-group">
                        <label>Short Leave Date</label>
                        <?php $currentDate = Controller::getCountryDate(); ?>
                        <input type="text" name="shtLvDate" value="<?php echo $currentDate; ?>" class="input-datepicker form-control required">
                    </div>
                </div>
            </div>

            <div class="row form-wrapper"> 
                <div class="col-lg-4 input-layout">
                    <div class="form-group">
                        <label>Duration</label>                               
                        <select name="noOfLeaves" id="noOfLeaves" onchange="selectNoLeaves()" class="form-control required" required>
                            <option value="">Select Duration</option>
                            <?php for ($x = 1; $x <= $maxLeavsPerDay; $x++) { ?>
                                <option value="<?php echo $x; ?>"><?php echo ($x * $shtlvDuration) . ' mins'; ?></option>
                            <?php } ?>    
                        </select>
                    </div>                  
                </div>

                <div class="col-md-4 ">
                    <div class="form-group">
                        <label>Start Time</label>
                        <input type="text" name="startTime" id="startTime" value="" class="input-timepicker time_picker form-control" required>                            
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
            <div class="footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert "></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="button" onclick="colseShortLeave()" class="btn btn-default btn-close">Close</button>
                        <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<div id="ajaxLoad" class="col s12 ajaxLoad"></div>


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
        var noOfLeaves = $('#noOfLeaves').val();
        if (noOfLeaves == 0) {
            //alert('tete'); 
            sweetAlert('Can Not Apply a Short Leave!', 'Please enter the purpose of the leave.');
        } else {
            $.ajax({
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
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/ShortLeave/RequestShortLeave'; ?>",
            data: $('#shortLeaveForm').serialize() + '&id=<?php echo $empId; ?>',
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    $('.alert').addClass('alert-success').html(responce.msg);
                    $("#shortLeaveForm")[0].reset();
                    empShortLeaveHistory(<?php echo $empId; ?>);
                } else {
                    $('.alert').addClass('alert-danger').html(responce.msg);
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
                $("#ajaxLoad").html(responce);
            }
        });
    }

    function colseShortLeave() {
        window.location.href = '<?php echo Yii::app()->baseUrl . '/Leave/viewManageLeave'; ?>';
    }

    $('.time_picker').on('change', function () {
        getShortLeaveEndTime();
    });

</script>