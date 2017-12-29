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
                        <input type="text" name="purpose" value="" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Max. Per Day</label>
                        <input type="text" name="purpose" value="" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Max. Per Month</label>
                        <input type="text" name="purpose" value="" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row form-wrapper">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Max. Per Year</label>
                        <input type="text" name="purpose" value="" class="form-control" required>
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

</script>