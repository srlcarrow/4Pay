<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'searchF1'));
?>
<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                
                <div class="search-box">
                    <div class="item width-90">
                        <input type="text" name="searchEmployeeText" class="form-control" placeholder="Search" onkeyup="viewEmployeeData(1)">
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
                                        <label>Name</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="button" class="btn btn-default btn-close">Close</button>
                                    <button type="button" class="btn btn-primary">Search</button>
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
        viewEmployeeData(1);
    });

    function viewEmployeeData(page) {
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