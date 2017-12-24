<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'searchF1'));
?>
<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="search-box">
                    <div class="item width-80">
                        <input type="text" name="searchEmployeeText" class="form-control" placeholder="Search" onkeyup="searchData(1)">
                    </div>
                    <div class="item width-5">
                        <button type="button" onclick="searchData(1)" class="btn btn-search">Search</button>
                    </div>
                    <div class="item width-10">
                        <button type="button" class="btn btn-advance">Advance</button>
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
                                <button type="button" class="btn btn-primary" onclick="searchData(1)">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
<div class="col s12 ajaxLoad">

</div>


<script>
    var loaderHtml = "<div align='center' class='absolute' id='loadingmessage'><img src='<?php echo Yii::app()->baseUrl; ?>/images/loader/Radio.gif'/></div>";

    $(document).ready(function (e) {
        searchData(1);
    });

    function searchData(page) {
        $(".ajaxLoad").html(loaderHtml);
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/' . $controller . '/' . $action; ?>",
            data: $('#searchF1').serialize() + "&page=" + page,
            success: function (responce) {
                $(".ajaxLoad").html(responce);
            }
        });
    }
</script>