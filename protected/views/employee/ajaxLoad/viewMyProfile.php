<div class="col-md-12">
    <div class="card flat p-tb-50 p-lr-100 mt-30">
        <div class="card-content">
            <div class="cm-accordion">

                <div class="cm-accordion-row">
                    <div class="cm-accordion-header">
                        <h5>Basic Information</h5>
                    </div>

                    <div class="cm-accordion-content">

                        <div class="row mb-not-last-25">
                            <div class="col-md-3">
                                <h5 class="text-info">Address</h5>
                            </div>
                            <div class="col-md-9">
                                <h5 class="text-info">127 /1, Walukarama Road, Biyanwila, Kadawatha</h5>
                            </div>
                        </div>

                        <div class="row mb-not-last-25">
                            <div class="col-md-3">
                                <h5 class="text-info">Address</h5>
                            </div>
                            <div class="col-md-9">
                                <h5 class="text-info">127 /1, Walukarama Road, Biyanwila, Kadawatha</h5>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="cm-accordion-row">
                    <div class="cm-accordion-header">
                        <h5>Change Password</h5>
                    </div>

                    <div class="cm-accordion-content">
                        <div class="row mb-not-last-25">
                            <div class="col-md-3">
                                <h5 class="text-info mt-10">Old Password</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-not-last-25">
                            <div class="col-md-3">
                                <h5 class="text-info mt-10">New Password</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-not-last-25">
                            <div class="col-md-3">
                                <h5 class="text-info mt-10">Re Password</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-not-last-25">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="button" class="btn btn-primary">Edit</button>
                                <button type="button" class="btn btn-default">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
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
    });
</script>