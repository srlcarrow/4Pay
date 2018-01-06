<?php $form = $this->beginWidget('CActiveForm', array('id' => 'leave')); ?>
<div class="card flat mt-30">
    <div class="card-content">
        <div class="row form-wrapper">
            <div class="col-md-4">
                <div class="row form-wrapper">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Leave Type</label>
                            <select id="type" class="form-control" onchange="loadLeaveData()">
                                <?php
                                if (count($leaveAllocation) > 0) {
                                    foreach ($leaveAllocation as $leaveType) {
                                        ?>
                                        <option value="<?php echo $leaveType->rel_leavetype->lt_id; ?>"><?php echo $leaveType->rel_leavetype->lt_name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div id="ajaxLoadData"></div>
    </div>
</div>
<?php $this->endWidget(); ?>
<script>
    $(document).ready(function (e) {
        loadLeaveData();
    });

    function loadLeaveData() {
        var selectedLvType = $("#type option:selected").val();

        fetch({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/ViewLeaveData'; ?>",
            data: {selectedLvType: selectedLvType},
            success: function (responce) {
                $("#ajaxLoadData").html(responce);
            }
        });
    }
   
</script>

