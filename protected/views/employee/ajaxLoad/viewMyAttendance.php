
<!--Advance Search-->
<div class="card mt-30">
    <div class="card-content">
        <?php
        $form = $this->beginWidget('CActiveForm', array('id' => 'attSearch'));
        ?>
        <div class="search-box">
            <div class="item width-42">
                <input type="text" name="dateFrom" value="<?php echo $dateFrom; ?>"
                       class="input-datepicker2 form-control">
            </div>
            <div class="item width-42">
                <input type="text" name="dateTo" value="<?php echo $dateTo; ?>"
                       class="input-datepicker2 form-control">
            </div>
            <div class="item width-6">
                <button type="button" class="btn btn-search" onclick="searchAttendanceData(1)">Search</button>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<div class="card flat ">
    <div class="card-content">

        <div class="row">
            <div class="col-md-12" id="ajaxAttLoad">

            </div>
        </div>

    </div>
</div>


<script>

    $(document).ready(function (e) {
        searchAttendanceData(1);
    });

    function searchAttendanceData(page) {

        fetch({
            appendTo: '.ajaxAttLoad',
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/ViewMyAttendanceData'; ?>",
            data: $('#attSearch').serialize() + "&page=" + page,
            success: function (responce) {
                $("#ajaxAttLoad").html(responce);
            }
        });
    }

    datePicker({ele: '.input-datepicker2'});

</script>