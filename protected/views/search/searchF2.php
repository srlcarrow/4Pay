<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'searchF2'));
?>
<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="search-box">
                    <div class="item width-20">
                        <input type="text" name="" class="form-control datepicker-2" placeholder="Start Date"
                        >
                    </div>
                    <div class="item width-20">
                        <input type="text" name="" class="form-control datepicker-2" placeholder="End Date">
                    </div>
                    <div class="item width-54">
                        <input type="text" name="searchEmployeeText" class="form-control" placeholder="Search"
                               onkeyup="searchData(1)">
                    </div>
                    <div class="item width-5">
                        <button type="button" onclick="searchData(1)" class="btn btn-search">Search</button>
                    </div>
                    <div class="item width-1">
                        <button type="button" class="btn btn-danger btn-advance">Advanced</button>
                    </div>

                </div>

                <div class="search-advance">
                    <div class="content">
                        <div class="row form-wrapper">
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label>Branch</label>
                                    <?php echo Chtml::dropDownList('ref_branch_id', "", CHtml::listData(AdmBranch::model()->findAll(), 'br_id', 'br_name'), array('empty' => 'Select Branch', 'class' => 'form-control')); ?>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label>Department</label>
                                    <?php echo Chtml::dropDownList('ref_department_id', "", CHtml::listData(AdmDepartment::model()->findAll(), 'dept_id', 'dept_name'), array('empty' => 'Select Department', 'class' => 'form-control')); ?>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <?php echo Chtml::dropDownList('ref_designation', "", CHtml::listData(AdmDesignation::model()->findAll(), 'desig_id', 'designation'), array('empty' => 'Select Designations', 'class' => 'form-control')); ?>
                                </div>
                            </div>

                        </div>
                        <div class="row form-wrapper">
                            <div class="col-md-4 ">
                                <?php
                                $activeStatus = $this->getActiveFilter();
                                echo Chtml::label('Employment Status', "", array('class' => 'control-label'));
                                echo Chtml::dropdownlist('activeStatus', '', $activeStatus, array('class' => 'form-control'));
                                ?>
                                
                            </div>
                            <div class="col-md-4 ">
                                <?php echo Chtml::label('Page Size ', ' ', array('class' => 'control-label')); ?>
                                <?php $dataArray = array('15' => '15', '30' => '30', '50' => '50', '100' => '100', '200' => '200'); ?>
                                <?php echo Chtml::dropdownlist('noOfData', '', $dataArray, array('class' => 'form-control')); ?>
                            </div>
                        </div>
                    </div>

                    <div class="footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-default btn-close">Close</button>
                                <button type="button" class="btn btn-danger" onclick="searchData(1)">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 mb-30">
                            <h5 class="text-primary text-uppercase">Lorem ipsum</h5>
                            <div class="row pt-5">
                                <?php
                                if (count($reqBasicFields) > 0) {
                                    foreach ($reqBasicFields as $key => $reqBasicField) {
                                        $ischecked = "";
                                        if (in_array($reqBasicField, $defaultChecked)) {
                                            $ischecked = "checked = checked";
                                        }
                                        ?>
                                        <div class="col-md-2 ">
                                            <div class="checkbox">
                                                <input data-label="<?php echo $reqBasicField; ?>" <?php echo $ischecked; ?>
                                                       name="<?php echo $key; ?>" value="1"
                                                       id="<?php echo $key; ?>"
                                                       type="checkbox">
                                                <label for="<?php echo $key; ?>"><?php echo $reqBasicField; ?></label>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-md-12 mb-30">
                            <h5 class="text-primary text-uppercase">Lorem ipsum</h5>
                            <div class="row pt-5">
                                <?php
                                if (count($reqAttendanceFields) > 0) {
                                    ?>
                                    <?php
                                    foreach ($reqAttendanceFields as $key => $reqAttendanceField) {
                                        $ischecked = "";
                                        if (in_array($reqAttendanceField, $defaultChecked)) {
                                            $ischecked = "checked = checked";
                                        }
                                        ?>
                                        <div class="col-md-2 ">
                                            <div class="checkbox">

                                                <input data-label="<?php echo $reqAttendanceField; ?>" <?php echo $ischecked; ?>
                                                       name="<?php echo $key; ?>" value="1"
                                                       id="<?php echo $key; ?>"
                                                       type="checkbox">
                                                <label for="<?php echo $key; ?>"><?php echo $reqAttendanceField; ?></label>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <h5 class="text-primary text-uppercase">Lorem ipsum</h5>
                            <div class="row pt-5">
                                <?php
                                if (count($reqEmploymentFields) > 0) {
                                    ?>
                                    <?php
                                    foreach ($reqEmploymentFields as $key => $reqEmploymentField) {
                                        $ischecked = "";
                                        if (in_array($reqEmploymentField, $defaultChecked)) {
                                            $ischecked = "checked = checked";
                                        }
                                        ?>
                                        <div class="col-md-2 ">
                                            <div class="checkbox">

                                                <input data-label="<?php echo $reqEmploymentField; ?>" <?php echo $ischecked; ?>
                                                       name="<?php echo $key; ?>" value="1"
                                                       id="<?php echo $key; ?>"
                                                       type="checkbox">
                                                <label for="<?php echo $key; ?>"><?php echo $reqEmploymentField; ?></label>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>




                    </div>
                </div>

                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-danger" onclick="searchData(1)">Search</button>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" class="checkedInput">
<input type="hidden" class="checkedLabel">

<?php $this->endWidget(); ?>
<div class="col s12 ajaxLoad">

</div>


<script>

    datePicker({ele:'.datepicker-2',position: 'bottom left',})

    var result = [];
    var arrayLabel = [];

    function findCheckedItem(ele) {
        var $this = $(ele),
                name = $this.attr('name'),
                label = $this.data('label');

        if ($this.is(':checked')) {
            result.push(name);
            arrayLabel.push(label);
        } else {
            result.splice(result.indexOf(name), 1);
            arrayLabel.splice(arrayLabel.indexOf(label), 1);
        }

        $('.checkedInput').val(JSON.stringify(result));
        $('.checkedLabel').val(JSON.stringify(arrayLabel));
    }

    $(function () {

        $('input[type="checkbox"]').on('change', function () {
            var $this = $(this);
            findCheckedItem($this);
        });

        $('input[type="checkbox"]:checked').each(function () {
            var $this = $(this);
            findCheckedItem($this);
        });
    });

    $(document).ready(function (e) {
        searchData(1);
    });


    function searchData(page) {

        var checkedItemString = $('.checkedInput').val();
        var checkedLabelString = $('.checkedLabel').val();

        fetch({
            appendTo: '.ajaxLoad',
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/' . $controller . '/' . $action; ?>",
            data: $('#searchF2').serialize() + "&selected=" + checkedItemString + "&selectedLabels=" + checkedLabelString + "&page=" + page,
            success: function (responce) {
                $(".ajaxLoad").html(responce);
            }
        });
    }
</script>