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

    });

    // Ajax Tab
    $(document).on('click.cm-ajax-tab', '.cm-ajax-tab li a', function (e) {
        e.preventDefault();

        var $this = $(this);
        $this.parents('.cm-ajax-tab').find('a').removeClass('is-active');
        $this.addClass('is-active');
    });

    // Accordion
    $(function () {
        $(document).find('.cm-accordion').each(function () {
            var $this = $(this);

            $this.find('.cm-accordion-row:first').addClass('is-open');
            $this.find('.cm-accordion-row:first').find('.cm-accordion-content').slideDown('fast');

            $this.find('.cm-accordion-row').on('click.cm-accordion-header', '.cm-accordion-header', function () {
                var _this = $(this),
                    $parent = _this.parent();

                if (!$parent.hasClass('is-open')) {
                    $this.find('.cm-accordion-row').removeClass('is-open');
                    $parent.addClass('is-open');

                    $this.find('.cm-accordion-content').slideUp('fast');
                    $parent.find('.cm-accordion-content').slideDown('fast')
                }
            })
        });
    })

})();