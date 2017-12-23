<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'searchF1'));
?>
<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="search-box">
                    <div class="item width-90">
                        <input type="text" name="searchEmployeeText" class="form-control" placeholder="Search" onkeyup="viewSearchData(1)">
                    </div>
                    <div class="item width-10">
                        <button type="button" class="btn btn-advance">Advance</button>
                    </div>
                </div>

                <div class="search-advance">
                    <form action="">
                        <div class="content">
                            <div class="row form-wrapper">
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label>Branch</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label>Section</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="row form-wrapper">
                                <div class="col-md-4 ">
                                    <?php echo Chtml::label('Page Size', '', array('class' => 'control-label')); ?>
                                    <?php $dataArray = array('15' => '15', '30' => '30', '50' => '50', '100' => '100', '200' => '200'); ?>
                                    <?php echo Chtml::dropdownlist('noOfData', '', $dataArray, array('class' => 'form-control')); ?>
                                </div>
                            </div>
                        </div>

                        <div class="footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="button" class="btn btn-default btn-close">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="viewSearchData(1)">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
<div class="col s12 ajaxLoad"></div>


<script>
    $(document).ready(function (e) {
        viewSearchData(1);
    });

    function viewSearchData(page) {
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