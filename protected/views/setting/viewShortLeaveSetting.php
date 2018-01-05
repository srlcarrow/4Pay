<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">
            <?php $form = $this->beginWidget('CActiveForm', array('id' => 'shortLeaveForm')); ?>

            <div class="card-header">
                <h1>Short Leave Settings</h1>
            </div>
            <div class="row form-wrapper">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Duration (minutes)</label>
                        <input type="text" name="short_lv_duration" value="<?php echo $shortLeaveSetting->short_lv_duration ?>" class="form-control number" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Max. Number of Short Leave Per Day</label>
                        <input type="text" name="max_leaves_per_day" value="<?php echo $shortLeaveSetting->max_leaves_per_day ?>" class="form-control number" required>  
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Max. Number of Short Leave Per Month</label>
                        <input type="text" name="max_leaves_per_month" value="<?php echo $shortLeaveSetting->max_leaves_per_month ?>" class="form-control number" required>
                    </div>
                </div>
            </div>
            <div class="row form-wrapper">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Max. Number of Short Leave Per Year</label>
                        <input type="text" name="max_leaves_per_year" value="<?php echo $shortLeaveSetting->max_leaves_per_year ?>" class="form-control number" required>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="form-group">
                        <?php
                        echo $form->checkBox($shortLeaveSetting, 'is_halfday_on_sameday', array('class' => 'form-control-txtbx'), array('value' => '', 'uncheckValue' => 0));
                        ?>
                        <span class="chkbox-lbl">Can Apply Halfday Leave on same date</span>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="form-group">
                        <?php
                        echo $form->checkBox($shortLeaveSetting, 'is_dual_approvers', array('class' => 'form-control-txtbx'), array('value' => '', 'uncheckValue' => 0));
                        ?>
                        <span class="chkbox-lbl">Dual Approvers</span>
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
                        <button type="button" class="btn btn-default btn-close">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<script>
    $("#shortLeaveForm").validate({
        submitHandler: function () {
            $.ajax({
                type: 'POST',
                url: "<?php echo Yii::app()->baseUrl . '/Setting/UpdateShortLeaveSetting'; ?>",
                data: $('#shortLeaveForm').serialize(),
                dataType: 'json',
                success: function (responce) {
                    if (responce.code == 200) {
                        $('.alert').addClass('alert-success').html(responce.msg);
                    }
                }
            });
        }
    });
</script>