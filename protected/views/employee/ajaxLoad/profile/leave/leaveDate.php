<div class="ds-table-block width-100 mb-8">
    <div class="cell width-25"></div>
    <div class="cell width-75">
        <div class="ds-table-block width-100 mb-15">
            <div class="cell">
                <h6 class="text-black lighten-1 ds-inline-block mr-20">
                    <span class="status holiday"></span>
                    Holiday
                </h6>
                <h6 class="text-black lighten-1 ds-inline-block mr-20">
                    <span class="status leave"></span>
                    Leaved
                </h6>
                <h6 class="text-black lighten-1 ds-inline-block mr-20">
                    <span class="status disable"></span>
                    Disabled
                </h6>
            </div>
        </div>

        <div class="ds-table-block width-100">
            <div class="cell width-34">
                <h6 class="text-black lighten-2">Full Day</h6>
            </div>
            <div class="cell width-66">
                <h6 class="text-black lighten-2">Half Day</h6>
            </div>
        </div>

    </div>
</div>
<?php
foreach ($leaveDays as $leaveDay) {
    $fullDayClass = "";
    $halfMorClass = "";
    $halfEveClass = "";
    $isHoliday = AdmConfigHolidays::model()->findByAttributes(array('holiday_date' => $leaveDay));

    $leaveTypeData = AdmLeavetypes::model()->findByPk($leaveTypeId);
    $isShiftAvailable = DailyAttendance::model()->getEmpWorkshift($empId, $leaveDay);
    $leaveData = yii::app()->db->createCommand("SELECT * FROM leave_apply la LEFT JOIN leave_apply_data lad ON la.lv_id=lad.ref_lv_id WHERE la.ref_emp_id=" . $empId . " AND lad.lvd_day='" . $leaveDay . "' ")->setFetchMode(PDO::FETCH_OBJ)->queryAll();

    if (count($leaveData) > 0) {
        if ($leaveData[0]->lvd_is_halfday == 0) {
            $fullDayClass = "is-leaved";
            $halfMorClass = "is-disabled";
            $halfEveClass = "is-disabled";
        } else {
            $fullDayClass = "is-disabled";
            $halfMorClass = $leaveData[0]->lvd_halfday_half == 1 ? "is-leaved" : ($leaveTypeData->lt_can_apply_halfday_leaves == 1 ? $halfEveClass = "" : "is-disabled");
            $halfEveClass = $leaveData[0]->lvd_halfday_half == 2 ? "is-leaved" : ($leaveTypeData->lt_can_apply_halfday_leaves == 1 ? $halfEveClass = "" : "is-disabled");
        }
    } elseif (count($isHoliday) > 0 || $isShiftAvailable[8] == 0) {
        $fullDayClass = "is-disabled";
        $halfMorClass = "is-disabled";
        $halfEveClass = "is-disabled";
    } elseif (count($leaveData) == 0) {
        $fullDayClass = "";
        $halfMorClass = $leaveTypeData->lt_can_apply_halfday_leaves == 1 ? "" : "is-disabled";
        $halfEveClass = $leaveTypeData->lt_can_apply_halfday_leaves == 1 ? "" : "is-disabled";
    }
    ?>
    <div class="leave-block " data-date="<?php echo $leaveDay; ?>">
        <div class="leave-month-day">
            <h5 class="">
                <span><?php echo date('M d', strtotime($leaveDay)) ?></span>
                <span class="ml-10 text-black lighten-2">Mo</span>
            </h5>
        </div>
        <div class="leave-date-block">
            <div data-value="0" class="lv-type <?php echo $fullDayClass; ?>">Full Day</div>
            <div data-value="1" class="lv-type <?php echo $halfMorClass; ?>">Morning</div>
            <div data-value="2" class="lv-type <?php echo $halfEveClass; ?>">Evening</div>
        </div>
    </div>
    <?php
}
?>

<!--<div class="leave-block" data-date="2017-1-4">
    <div class="leave-month-day">
        <h5 class="">Jan 04</h5>
    </div>
    <div class="leave-date-block">
        <div data-value="0" class="lv-type is-disabled">Full Day</div>
        <div data-value="1" class="lv-type is-disabled">Morning</div>
        <div data-value="2" class="lv-type is-disabled">Evening</div>
    </div>
</div>

<div class="leave-block" data-date="2017-1-5">
    <div class="leave-month-day">
        <h5 class="">Jan 05</h5>
    </div>
    <div class="leave-date-block">
        <div data-value="0" class="lv-type">Full Day</div>
        <div data-value="1" class="lv-type">Morning</div>
        <div data-value="2" class="lv-type">Evening</div>
    </div>
</div>-->


<script>
    $(function () {

        $(document).off('click.leave-block');

        $('.leave-block').each(function () {
            var $this = $(this);
            var fullDay = $this.find('.leave-date-block .lv-type:first');

            if (fullDay.hasClass('is-leaved') || fullDay.hasClass('is-disabled'))
                return;

            //fullDay.addClass('is-selected');
        });

        $(document).on('click.leave-block', '.leave-block .lv-type', function () {
            var $this = $(this),
                $parent = $this.parents('.leave-block');

            if ($this.hasClass('is-leaved') || $this.hasClass('is-disabled'))
                return;

            if ($this.hasClass('is-selected')) {
                $this.toggleClass('is-selected');
            } else {
                $this.parent().find('.lv-type').removeClass('is-selected')
                $this.addClass('is-selected');
            }


        });
    });
</script>