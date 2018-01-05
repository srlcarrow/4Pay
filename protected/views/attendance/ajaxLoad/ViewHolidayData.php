<!--Pop up modal-->
<div class="modal fade" id="cln_modal" tabindex="-1" role="dialog">

</div>

<div class="col-md-12">
    <div class="calender-container">
        <input type="hidden" id="calId" name="calId" value="<?php // echo $calendarId;            ?>">

        <div class="day-container">
            <div class="day">Sunday</div>
            <div class="day">Monday</div>
            <div class="day">Tuesday</div>
            <div class="day">Wednesday</div>
            <div class="day">Thursday</div>
            <div class="day">Friday</div>
            <div class="day">Saturday</div>
        </div>


        <!--disable-->
        <div class="date-container">
            <?php
            foreach ($days as $key => $day) {
                $class = "";
                $class = date('Y-m', strtotime($day)) != date('Y-m', strtotime($reqYear . '-' . $reqMonth . '-01')) ? "is-disabled" : "";

//                is-holiday
                ?>
                <!--
                classes :-
                    is-holiday
                    is-morning-holiday
                    is-evening-holiday
                -->

                <div class="date <?php echo $class; ?>">
                    <input type="hidden" id="day" name="day" value="<?php echo $day; ?>">
                    <div class="header ">
                        <span class="num"><?php echo date('d',strtotime($day)); ?></span>
                    </div>

                    <div class="content ">
                        <h6 class="holiday-text">
                            <?php // echo $holidaySummary->holiday_name;  ?></h6>
                    </div>

                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>


<script>
    //Holiday scroll bar
    $(".holiday-scroll").mCustomScrollbar({
        theme: 'dark-3',
//        scrollbarPosition: 'outside'
    });</script>

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
                });
        $('#cln_modal').find('#reqDate').text(date);
        $('#reqDate').text(date);
    });
</script>