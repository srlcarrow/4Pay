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


    $(function () {

        $(document).on('click.dropdown_list', '.dropdown_list input[type="text"]', function (e) {
            var $this = $(this);
            var $dropDownList = $this.parents('.dropdown_list');
            var $dropUl = $dropDownList.find('ul');

            $dropDownList.addClass('is-open');
           
//            $dropUl.find('li').on('click', function () {
//                var $li = $(this);
//                $this.val($li.find('h5').text());
//                $this.trigger('onDropItemClick', [$li.attr('data-id'), $li]);
//                $('.dropdown_list').removeClass('is-open');
//            })

        });

        $(document).on('click.dropdown_list', function (e) {
            if ($(e.target).closest('.dropdown_list').length === 0) {
                $('.dropdown_list').removeClass('is-open');
            }
        })

    })

})();


//Date picker
function datePicker(_option, calback) {

    var _defOption = {
        ele: null,
        minDate: null,
        maxDate:null,
        startDate: new Date()
    };

    var option = $.extend(_defOption, _option);

    $(option.ele).datepicker({
        language: 'en',
        minDate: _defOption.minDate,
        maxDate: _defOption.maxDate,
        startDate: _defOption.startDate,
        dateFormat: 'yyyy-m-dd',
        autoClose: true,
        position: 'top left',
        onSelect: function (fdate, date) {
            if (typeof calback === "function") {
                calback(fdate, date)
            }
        }
    });
}

function fetch(_option) {

    function loader() {
        var loaderHtml = "" +
                "<div align='center' class='absolute' id='loadingmessage'>" +
                "<img style='width:90px' src='" + BASE_URL + "/images/loader/Ripple.gif''/>" +
                "</div>";
        return loaderHtml;
    }

    var ele = _option.appendTo !== 'undefined' ? _option.appendTo : '';

    $(ele).html(loader());

    var defOption = {
        type: 'GET',
        url: null,
        dataType: 'html',
        data: null,
        beforeSend: function () {
        },
        success: function () {
        },
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        complete: function () {
        }
    };

    var option = $.extend(defOption, _option);

    return $.ajax({
        type: option.type,
        url: option.url,
        data: option.data,
        dataType: option.dataType,
        beforeSend: option.beforeSend,
        success: option.success,
        error: option.error,
        contentType: option.contentType,
        complete: option.complete
    });
}

function insert(_option) {

    var defOption = {
        appendTo: '',
        type: 'POST',
        url: null,
        dataType: 'html',
        data: null,
        beforeSend: function () {
        },
        success: function () {
        },
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        complete: function () {
        }
    };

    var option = $.extend(defOption, _option);

    return $.ajax({
        type: option.type,
        url: option.url,
        data: option.data,
        dataType: option.dataType,
        beforeSend: option.beforeSend,
        success: option.success,
        error: option.error,
        contentType: option.contentType,
        complete: option.complete
    });
}