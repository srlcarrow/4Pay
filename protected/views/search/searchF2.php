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
                               onkeyup="searchData(1)">
                    </div>
                    <div class="item width-5">
                        <button type="button" onclick="searchData(1)" class="btn btn-search">Search</button>
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
                                <button type="button" onclick="searchData(1)" class="btn btn-primary">Search
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

        </div>
    </div>
</div>

<input type="hidden" class="checkedInput">

<?php $this->endWidget(); ?>
<div class="col s12 ajaxLoad">

</div>


<script>

    var result = [];

    $(function () {

        $('input[type="checkbox"]').on('change', function () {
            var $this = $(this),
                    name = $this.attr('name');

            if ($this.is(':checked')) {
                result.push(name);
            } else {
                result.splice(result.indexOf(name), 1);
            }

            $('.checkedInput').val(JSON.stringify(result));
        });
    });

    var loaderHtml = "<div align='center' class='absolute' id='loadingmessage'><img src='<?php echo Yii::app()->baseUrl; ?>/images/loader/Radio.gif'/></div>";
    $(document).ready(function (e) {
        searchData(1);
    });


    function searchData(page) {
        $(".ajaxLoad").html(loaderHtml);
        var checkedItemString = $('.checkedInput').val();
//        console.log(checkedItemString);

        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/' . $controller . '/' . $action; ?>",
            data: $('#searchF2').serialize() + "&selected=" + checkedItemString + "&page=" + page,
            success: function (responce) {
                $(".ajaxLoad").html(responce);
            }
        });
    }
</script>