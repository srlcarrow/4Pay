<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h1>Add Employees </h1>
            </div>

            <div class="card-content">
                <?php $form = $this->beginWidget('CActiveForm', array('id' => 'formEmployee')); ?>
                <div class="content">

                    <div class="card-header">
                        <h4>Basic Details</h4>
                    </div>
                    <div class="row form-wrapper">
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Emp No.</label>
                                <input type="text" name="empno" value="<?php echo $model->empno; ?>" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>EPF No.</label>
                                <input type="text" name="epf_no" value="<?php echo $model->epf_no; ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Attendance No.</label>
                                <input type="text" name="attendance_no" value="<?php echo $model->attendance_no; ?>" class="form-control">
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
                                <input type="text" name="emp_full_name" value="<?php echo $model->emp_full_name; ?>" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Name with Initials</label>
                                <input type="text" name="emp_name_with_initials" value="<?php echo $model->emp_name_with_initials; ?>" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row form-wrapper"> 
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Display Name</label>
                                <input type="text" name="emp_display_name" value="<?php echo $model->emp_display_name; ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <?php $status = $this->viewStatusArry() ?>               
                                <label>Gender</label>
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

                    <div class="row form-wrapper"> 
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="text" name="emp_dob" value="<?php echo $model->emp_dob; ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-4 input-layout">
                            <div class="form-group">
                                <label>Race</label>
                                <?php echo $form->dropdownlist($model, 'ref_race', CHtml::listData(AdmRace::model()->findAll(array('order' => 'race ASC')), 'race_id', 'race'), array('empty' => '', 'class' => 'form-control')); ?>                                
                            </div>                  
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>NIC</label>
                                <input type="text" name="emp_nic" value="<?php echo $model->emp_nic; ?>" class="form-control">                            
                            </div>
                        </div>
                    </div>

                    <div class="row form-wrapper"> 
                        <div class="col-lg-4 input-layout">
                            <div class="form-group">
                                <label>Religion</label>
                                <?php echo $form->dropdownlist($model, 'ref_religion', CHtml::listData(AdmReligion::model()->findAll(array('order' => 'religion ASC')), 'rel_id', 'religion'), array('empty' => '', 'class' => 'form-control')); ?>
                            </div>                  
                        </div>
                    </div>

                    <div class="card-header">
                        <h4>Contact Details</h4>
                    </div>

                    <div class="row form-wrapper">
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label>Permanent Address</label>
                                <input type="text" name="con_permenant_add" value="<?php echo $contact->con_permenant_add; ?>" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label>Temporary Address</label>
                                <input type="text" name="con_temp_add" value="<?php echo $contact->con_temp_add; ?>" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row form-wrapper">
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Office Email</label>
                                <input type="text" name="con_office_email" value="<?php echo $contact->con_office_email; ?>" class="form-control email" required>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Personal Email</label>
                                <input type="text" name="con_personal_email" value="<?php echo $contact->con_personal_email; ?>" class="form-control email">
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Home Contact Number</label>
                                <input type="text" name="con_home_tel" value="<?php echo $contact->con_home_tel; ?>" class="form-control number">
                            </div>
                        </div>                   
                    </div>

                    <div class="row form-wrapper">
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Mobile 1</label>
                                <input type="text" name="con_mobile1" value="<?php echo $contact->con_mobile1; ?>" class="form-control number">
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Mobile 2</label>
                                <input type="text" name="con_mobile2" value="<?php echo $contact->con_mobile2; ?>" class="form-control number">
                            </div>
                        </div>
                    </div>

                    <div class="card-header">
                        <h4>Employment Details</h4>
                    </div>

                    <div class="row form-wrapper">
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Date of Joined</label>
                                <input type="text" name="empl_joined_date" value="<?php echo $employment->empl_joined_date; ?>" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Designation</label>
                                <?php echo $form->dropdownlist($employment, 'ref_designation', CHtml::listData(AdmDesignation::model()->findAll(), 'desig_id', 'designation'), array('empty' => '', 'class' => 'form-control')); ?>
                            </div>                  
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Employment Type</label>
                                <?php echo $form->dropdownlist($employment, 'ref_employment_type', CHtml::listData(AdmEmptype::model()->findAll(), 'etype_id', 'emp_type'), array('empty' => '', 'class' => 'form-control')); ?>
                            </div>                  
                        </div>                       
                    </div>

                    <div class="row form-wrapper">
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Branch</label>
                                <?php echo $form->dropdownlist($employment, 'ref_branch_id', CHtml::listData(AdmBranch::model()->findAll(), 'br_id', 'br_name'), array('empty' => '', 'class' => 'form-control')); ?>
                            </div>                  
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Section</label>
                                <?php echo $form->dropdownlist($employment, 'ref_department_id', CHtml::listData(AdmDepartment::model()->findAll(), 'dept_id', 'dept_name'), array('empty' => '', 'onChange' => 'loadSections()', 'class' => 'form-control')); ?>
                            </div>                  
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                 <label>Department</label>

                                <select id="section" name="section" class="form-control">
                                    <option value="0">Select</option>
                                </select>
                            </div>                  
                        </div>                                              
                    </div>

                    <div class="row form-wrapper">
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label>Employment Category</label>
                                <?php echo $form->dropdownlist($employment, 'ref_employment_category', CHtml::listData(AdmEmpCategory::model()->findAll(), 'empcat_id', 'cat_name'), array('empty' => '', 'class' => 'form-control')); ?>
                            </div>                  
                        </div>                        
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <?php $activeStatus = $this->getActiveFilter(); ?>
                                <label>Employment Status</label>                               
                                <?php echo $form->dropdownlist($employment, 'empl_employment_status', $activeStatus, array('empty' => '', 'class' => 'form-control required')); ?>
                            </div>                
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <?php
                                echo $form->checkBox($employment, 'is_generalshift_emp', array('class' => 'form-control-txtbx'), array('value' => '', 'uncheckValue' => 0));
                                ?>
                                <span class="chkbox-lbl">Is general shift</span>
                            </div>                
                        </div>
                    </div>
                </div>

                <div class="footer">
                    <div class="col-md-12">
                        <div class="cm-message message"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert "></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="button" onclick="colseEmployee()" class="btn btn-default btn-close">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
                <?php $this->endWidget(); ?>   
            </div>

        </div>
    </div>
</div>

<script>

    $("#formEmployee").validate({
        submitHandler: function () {
            saveEmployee();
        }
    });

    function loadSections() {
        $("#section").empty();
        var id = $('#Employment_ref_department_id').val();

        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/GetSectionsByDepartmentID'; ?>",
            data: {id: id},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    var sections = responce.data.sectionData;
                    addEmptyToAjaxDropDowns('section', 'section');
                    for (var i = 0, max = sections.length; i < max; i++) {
                        $('#section').append(
                                $("<option>" + sections[i]['section_name'] + "</option>")
                                .attr("value", sections[i]['section_id'])
                                .text(sections[i]['section_name'])
                                );
                    }
                    setTimeout(function () {
                        Select.init();
                    }, 200)
                }
            }
        });
    }

    function saveEmployee() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/SaveEmployee'; ?>",
            data: $('#formEmployee').serialize() + '&empId=<?php echo $empId; ?>',
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

    function colseEmployee() {
        window.location.href = '<?php echo Yii::app()->baseUrl . '/Employee/ViewEmployee'; ?>';
    }
    
    function addEmptyToAjaxDropDowns(id, defaultText) {
        var text = defaultText != undefined ? defaultText : "Select";
        $('#' + id).append(
                $("<option>Select</option>")
                .attr("value", 0)
                .text("Select")
                );
    }
    
</script>