<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h1>Add Employees </h1>
            </div>

            <div class="card-content">
                <?php $form = $this->beginWidget('CActiveForm', array('id' => 'formEmployee')); ?>
                <div class="content">
                    <div class="row form-wrapper">
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Emp No.</label>
                                <input type="text" name="empno" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>EPF No.</label>
                                <input type="text" name="epf_no" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Attendance No.</label>
                                <input type="text" name="attendance_no" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row form-wrapper">
                        <div class="col-md-4 ">
                            <div class="form-group">
                                    <?php $title = $this->viewTitleArry() ?>
                                    <label>Title</label>
                                    <?php echo $form->dropdownlist($model, 'emp_title', $title, array('class' => 'form-control required')); ?>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="emp_full_name" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Name with Initials</label>
                                <input type="text" name="emp_name_with_initials" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row form-wrapper">
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Display Name</label>
                                <input type="text" name="emp_display_name" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <?php $status = $this->viewStatusArry() ?>               
                                <label>Email</label>
                                <?php echo $form->dropdownlist($model, 'emp_gender', $status, array('empty' => '', 'class' => 'form-control required')); ?>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <?php $civilstatus = $this->viewCivilstatusArry() ?>
                                <label>Civil Status</label>                               
                                <?php echo $form->dropdownlist($model, 'emp_civil_status', $civilstatus, array('empty' => '', 'class' => 'form-control required')); ?>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="footer">
                    <div class="col-md-12">
                        <div class="cm-message message"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="alert "></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="button" onclick="colseEmployee()" class="btn btn-default btn-close">Close</button>
                            <button type="button" onclick="saveEmployee()" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>

        </div>
    </div>
</div>

<script>
    function saveEmployee() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/SaveEmployee'; ?>",
            data: $('#formEmployee').serialize(),
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    //Message.success(responce.msg);
                    $('.alert').addClass('alert-success').html(responce.msg);
                    $("#formEmployee")[0].reset();
                }
            }
        });
    }
</script>