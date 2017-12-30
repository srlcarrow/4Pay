<!--Pop up modal-->
<div class="modal fade" id="cln_modal" tabindex="-1" role="dialog">

</div>

<div class="col-md-12">
    <div class="calender-container">
        <input type="hidden" id="calId" name="calId" value="<?php // echo $calendarId; ?>">

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
            <!--            --><?php
            //            foreach ($days as $key => $day) {
            //                ?>

            <!--
            classes :-
                is-holiday
                is-morning-holiday
                is-evening-holiday
            -->

            <!--                <div class="date --><?php //// echo $class;  ?><!--">-->
            <!--                    <input type="hidden" id="day" name="day" value="--><?php //echo $day; ?><!--">-->
            <!--                    <div class="header ">-->
            <!--                        <span class="num">--><?php //echo date('d', strtotime($day)); ?><!--</span>-->
            <!--                    </div>-->
            <!---->
            <!--                    <div class="content ">-->
            <!--                        <h6 class="holiday-text">-->
            <?php //// echo $holidaySummary->holiday_name;  ?><!--</h6>-->
            <!--                    </div>-->
            <!---->
            <!--                </div>-->
            <!--                --><?php
            //            }
            //            ?>


            <div class="date is-disabled">
                <div class="header ">
                    <span class="num">26</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date is-disabled">
                <div class="header ">
                    <span class="num">27</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date is-disabled">
                <div class="header ">
                    <span class="num">28</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date is-disabled">
                <div class="header ">
                    <span class="num">29</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date is-disabled">
                <div class="header ">
                    <span class="num">30</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">1</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">2</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date is-holiday">
                <div class="header ">
                    <span class="num">3</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text">Poya Day</h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">4</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">5</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">6</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">7</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">8</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">9</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">10</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">11</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date is-morning-holiday">
                <div class="header ">
                    <span class="num">12</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">13</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date is-evening-holiday">
                <div class="header ">
                    <span class="num">14</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">15</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">16</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">17</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">18</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">19</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">20</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">21</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">22</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">23</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">24</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">25</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">26</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">27</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">28</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">29</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">30</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date ">
                <div class="header ">
                    <span class="num">31</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date is-disabled">
                <div class="header ">
                    <span class="num">1</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date is-disabled">
                <div class="header ">
                    <span class="num">2</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date is-disabled">
                <div class="header ">
                    <span class="num">3</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date is-disabled">
                <div class="header ">
                    <span class="num">4</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date is-disabled">
                <div class="header ">
                    <span class="num">5</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
            <div class="date is-disabled">
                <div class="header ">
                    <span class="num">6</span>
                </div>
                <div class="content">
                    <h6 class="holiday-text"></h6>
                </div>
            </div>
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