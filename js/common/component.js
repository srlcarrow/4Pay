var EVENT = {};
(function () {


    // Advance Search.
    $(document).on('click.btn-advance', '.btn-advance', function (e) {
        var $this = $(this),
            $parentBox = $this.parents('.search-box'),
            $advanceBox = $parentBox.next();

        $advanceBox.slideToggle('fast');
    });

    $(document).on('click.btn-close', '.search-advance .btn-close', function (e) {
        var $this = $(this),
            $parentBox = $this.parents('.search-advance');

        $parentBox.slideUp('fast');
    });

    $(function () {
        //Date Picker
        $(document).find('.input-datepicker').datepicker({
            language: 'en',
            dateFormat: 'yyyy-m-dd',
            autoClose: true,
            onSelect: function (fdate, date) {
                $(document).trigger('onDateSelect', [date, fdate]);
            }
        });

        // Time Picker
        $(document).on('focus.input-timepicker', '.input-timepicker', function () {
            var $this = $(this);
            $($this).clockpicker({
                placement: 'top',
                align: 'left',
                autoclose: true,
                afterDone: function () {
                    $(document).trigger('onTimeSelect', [$this.val(), $this]);
                }
            });
        });

    })

})();