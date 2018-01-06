<?php
foreach ($leaveDays as $leaveDay) {
//    $isHoliday=
    
    ?>
    <div class="leave-block " data-date="2017-1-3">
        <div class="leave-month-day">
            <h5 class=""><?php echo date('M d',strtotime($leaveDay)) ?></h5>
        </div>
        <div class="leave-date-block">
            <div data-value="0" class="lv-type">Full Day</div>
            <div data-value="1" class="lv-type">Morning</div>
            <div data-value="2" class="lv-type is-leaved">Evening</div>
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

            fullDay.addClass('is-selected');
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