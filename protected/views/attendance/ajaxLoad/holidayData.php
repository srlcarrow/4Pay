<!--Pop up modal-->
<div class="modal fade" id="cln_modal" tabindex="-1" role="dialog">

</div>

<div class="col-md-12">
    <div class="calender-container">
        <div class="day-container">
            <div class="day">Sunday</div>
            <div class="day">Monday</div>
            <div class="day">Tuesday</div>
            <div class="day">Wednesday</div>
            <div class="day">Thursday</div>
            <div class="day">Friday</div>
            <div class="day">Saturday</div>
        </div>

        <input type="hidden" id="calId" name="calId" value="<?php echo $calendarId; ?>">

        <!--disable-->
        <div class="date-container">    
            <?php
            $isEnableMultipleCalendars = Payroll::getPayrollSetting('DEMC');
            foreach ($days as $key => $day) {
                if ($isEnableMultipleCalendars == 1) {
                    $holidaySummary = ConfigHolidays::model()->find('holiday_date="' . $day . '" AND ref_cal_id="' . $calendarId . '"');
                } else {
                    $holidaySummary = ConfigHolidays::model()->find('holiday_date="' . $day . '"');
                }

                $holydayTypeData = ConfigHolidayOrShiftData::model()->findByAttributes(array('ref_holiday_type_id' => $holidaySummary->ref_holiday_type_id, 'hchsd_is_general_shift' => 1));
//                $isHalfDayHoliday = $holydayTypeData->hchsd_is_half_day;
//                $half = $holydayTypeData->hchsd_halfday_half;

                if (count($holidaySummary) > 0) {
                    $class = 'holiday';
                } else {
                    $class = '';
                }

                $class = date('m', strtotime($day)) != $reqMonth ? 'disable' : $class;
                ?>

                <div class="date <?php echo $class; ?>"> 
                    <input type="hidden" id="day" name="day" value="<?php echo $day; ?>">
                    <div class="header ">
                        <span class="num"><?php echo date('d', strtotime($day)); ?></span>
                    </div>
                    <?php
                    if (count($holidaySummary) > 0) {
                        ?>
                        <div class="content ">
                            <h6 class="mt-5 lb-holiday-type"><?php echo $holidaySummary->holiday_name; ?></h6>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>   
        </div>
    </div>
</div>

<!-- ===========================================================================
        Plugin Script
============================================================================ -->
<script>
    //Holiday scroll bar
    $(".holiday-scroll").mCustomScrollbar({
        theme: 'dark-3',
//        scrollbarPosition: 'outside'
    });</script>
<!-- ===========================================================================
        Custom Script
============================================================================ -->
<script>

    $('.date-container .date').on('click', function () {

        if ($(this).hasClass('disable')) {
            return;
        }

        var date = $(this).find("input").val();
        var dayArr = ['', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var selectingIndex = $(this).index() + 1;
        var selectDay = 0;
        if (selectingIndex > 7) {
            selectDay = selectingIndex % 7;
            if (selectDay === 0) {
                selectDay = 7;
            }
        } else {
            selectDay = selectingIndex;
        }



        //popup show here       
        $('#cln_modal').find('.selectedDay').html(dayArr[selectDay]).attr('data-week-day', selectDay);
        var calId = $('#calId').val();
        var $modal = $('#cln_modal');
        $modal.load('<?php echo Yii::app()->request->baseUrl; ?>/attendance/addHolidays', {date: date, calId: calId},
                function () {
                    $modal.modal('show');
                    form.reset();
                });
        $('#cln_modal').find('#reqDate').text(date);
        $('#reqDate').text(date);
    });
</script>