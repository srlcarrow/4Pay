<div class="col-md-12">
    <div class="card flat p-tb-50 p-lr-100 mt-30">
        <div class="card-content">
            <?php
            $form = $this->beginWidget('CActiveForm', array('id' => 'attSearch'));
            ?>
            <div class="row form-wrapper">
                <div class="search-box">
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label>From</label>
                            <input type="text" name="dateFrom" value="<?php echo $dateFrom; ?>"
                                   class="input-datepicker2 form-control">
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label>To</label>
                            <input type="text" name="dateTo" value="<?php echo $dateTo; ?>"
                                   class="input-datepicker2 form-control">
                        </div>
                    </div>
                    <div class="item width-5">
                        <button type="button" onclick="searchAttendanceData(1)" class="btn btn-search">Search</button>
                    </div>
                </div>
            </div>
            <?php $this->endWidget(); ?>

            <div class="col-md-12" ajaxAttLoad>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Day</th>
                        <th>Date In</th>
                        <th>Punch In</th>
                        <th>Date Out</th>
                        <th>Punch Out</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    foreach ($attendanceData as $attendance) {
                        ?>
                        <tr>
                            <td><?php echo $attendance['day']; ?></td>
                            <td><?php echo $attendance['date_in']; ?></td>
                            <td><?php echo $attendance['punch_in']; ?></td>
                            <td><?php echo $attendance['date_out']; ?></td>
                            <td><?php echo $attendance['punch_out']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
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
            url: "<?php echo Yii::app()->baseUrl . '/Employee/ViewMyAttendance'; ?>",
            data: $('#attSearch').serialize() + "&page=" + page,
            success: function (responce) {

                $(".ajaxAttLoad")
                    .html('')
                    .html(responce);
            }
        });
    }

    datePicker({ele: '.input-datepicker2'});

</script>