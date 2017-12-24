(function () {

    function Selectable(element, option) {
        this.element = element;
        this.option = option;
        this.child = this.element.children();
        this.isMouseDown = false;
        this.selectElement = this.option.selectElement;
        this.init();
    }

    var _proto = Selectable.prototype;

    _proto.init = function () {
        var self = this;

        this.element.addClass('no-select');

        this.child.each(function () {
            $(this).on('mousedown', self.onMouseDown.bind(self));
            $(this).on('mouseover', self.onMouseOver.bind(self));
            $(this).on('mouseup', self.onMouseUp.bind(self));
        });
        $(document).on('mouseup', self.onMouseUp.bind(self));
    };

    _proto.onMouseDown = function (e) {
        e.stopPropagation();

        if ($(e.target).hasClass('is-leave')
            || $(e.target).parent().hasClass('is-leave')
            || $(e.target).hasClass('is-holiday')
            || $(e.target).parent().hasClass('is-holiday')
        )
            return;

        this.isMouseDown = true;

        if (!e.ctrlKey) {
            this.element.find('.date').removeClass('is-focus')
                .removeClass('is-selected');
        }


        if ($(e.target).hasClass('date')) {
            $(e.target).addClass('is-focus');
        } else if ($(e.target).parent().hasClass('date')) {
            $(e.target).parent().addClass('is-focus')
        }


    };

    _proto.onMouseOver = function (e) {
        var self = this;
        e.stopPropagation();

        if ($(e.target).hasClass('is-leave')
            || $(e.target).parent().hasClass('is-leave')
            || $(e.target).hasClass('is-holiday')
            || $(e.target).parent().hasClass('is-holiday')
        )
            return;

        if (self.isMouseDown) {

            if ($(e.target).hasClass('date')) {
                $(e.target).addClass('is-focus');
            } else if ($(e.target).parent().hasClass('date')) {
                $(e.target).parent().addClass('is-focus')
            }

        }
    };

    _proto.onMouseUp = function () {
        var self = this;
        this.isMouseDown = false;
        this.element.find('.date').each(function () {
            if ($(this).hasClass('is-focus')) {
                $(this).removeClass('is-focus').addClass('is-selected');
            }
        })
    };

    $.fn.Selectable = function () {


        return this.each(function (_option) {
            var $this = $(this);

            var defOption = {
                selectElement: null
            };

            var option = $.extend(defOption, _option);

            new Selectable($this, option);
        })
    };


})();