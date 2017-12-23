<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'searchF2'));
?>
<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="search-box">
                    <div class="item width-80">
                        <input type="text" name="searchEmployeeText" class="form-control" placeholder="Search"
                               onkeyup="viewEmployeeData(1)">
                    </div>
                    <div class="item width-5">
                        <button type="button" onclick="viewEmployeeData(1)" class="btn btn-search">Search</button>
                    </div>
                    <div class="item width-10">
                        <button type="button" class="btn btn-advance">Advance</button>
                    </div>

                </div>

                <div class="search-advance">
                    <!--                    <form action="">-->
                    <div class="content">
                        <div class="row form-wrapper">
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" class="form-control">
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
                                <button type="button" onclick="viewEmployeeData(1)" class="btn btn-primary">Search
                                </button>
                            </div>
                        </div>
                    </div>
                    <!--                    </form>-->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">
            <?php
            if (count($reqBasicFields) > 0) {
                foreach ($reqBasicFields as $key => $reqBasicField) {
                    ?>
                    <div class="col-md-2 ">
                        <div class="checkbox">
                            <label>
                                <input name="<?php echo $key; ?>" value="1"
                                       type="checkbox"><?php echo $reqBasicField; ?>
                            </label>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>


        </div>
        <div class="card">
            <?php
            if (count($reqAttendanceFields) > 0) {
                ?>
                <?php
                foreach ($reqAttendanceFields as $key => $reqAttendanceField) {
                    ?>
                    <div class="col-md-2 ">
                        <div class="checkbox">
                            <label>
                                <input name="<?php echo $key; ?>" value="1"
                                       type="checkbox"><?php echo $reqAttendanceField; ?>
                            </label>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

            <input type="hidden" class="checkedInput">

        </div>
    </div>
</div>

<?php $this->endWidget(); ?>
<div class="col s12 ajaxLoad"></div>


<script>

    var getSelectedCheckbox = function () {
        var result = [];
        $('input[type="checkbox"]:checked').each(function () {
            var name = $(this).attr('name');
            result.push({name: name});
        });

        console.log(result);
        console.log(JSON.stringify(result));
        console.log(typeof JSON.stringify(result));
        return result;
    };

    $(document).ready(function (e) {
        viewEmployeeData(1);
    });


    function viewEmployeeData(page) {

        var selectedCheckbox = getSelectedCheckbox();

        var json = JSON.stringify(selectedCheckbox);

        $('.checkedInput').val(json);

        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/' . $controller . '/' . $action; ?>",
            data: $('#searchF2').serialize() + "&page=" + page,
            success: function (responce) {
                $(".ajaxLoad").html(responce);
            }
        });
    }
</script>