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
    })




})();