<div class="card flat mt-30">
    <div class="card-content">
        <div class="row">
            <div class="col-md-4">

                <div class="row form-wrapper">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Leave Type</label>
                            <select id="type" class="form-control">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row form-wrapper">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Cover Up</label>
                            <div class="dropdown_list">

                                <div class="search-area">
                                    <input id="coverUp" type="text" class="drop-input-search form-control">
                                </div>

                                <ul class="drop-result">
                                    <li data-id="42">
                                        <h5>Saman Kumara</h5>
                                        <h6>UI Design</h6>
                                    </li>
                                    <li data-id="45">
                                        <h5>Kasun Bandara</h5>
                                        <h6>UI Design</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row form-wrapper">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Attachment</label>
                            <input type="file" id="">
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="row form-wrapper">
                    <div class="col-md-12 form-group">
                        <label for="">Purpose</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="row form-wrapper">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input readonly="readonly" type="text" class="start-date form-control">
                        </div>
                    </div>
                </div>

                <div class="row form-wrapper">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>End Date</label>
                            <input readonly="readonly" type="text" class="end-date form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 no-select loadAjaxDate">

            </div>

            <div class="col-md-12 text-right">
                <button class="btn btn-primary btnSave">Save</button>
            </div>

        </div>
    </div>
</div>


<script>

    datePicker({
        ele: '.start-date',
        minDate: new Date(),

    }, function (fdate, date) {

        var eDate = $('.end-date').val();

        if (eDate.length === 0)
            return;

        var _fDate = new Date(date);
        var _eDate = new Date(eDate);

        if (_fDate.getTime() < _eDate.getTime()) {
            getDatePage(fdate, eDate);
        }

    });

    datePicker({ele: '.end-date'}, function (fdate, date) {
        var sDate = $('.start-date').val();

        if (sDate.length === 0)
            return;

        var _fDate = new Date(sDate);
        var _eDate = new Date(date);

        if (_fDate.getTime() < _eDate.getTime()) {
            getDatePage(sDate, fdate);
        }
    });

    function getDatePage(startDate, endDate) {

        $.ajax({
            type: 'GET',
            url: "<?php echo Yii::app()->baseUrl?>/employee/LeaveDate",
            success: function (res) {
                $('.loadAjaxDate').html(res);
            }
        });
    };

    function getLeaveDate() {

        var result = [];

        $('.lv-type').each(function () {
            var $this = $(this),
                $leaveBlock = $this.parents('.leave-block');

            if ($this.hasClass('is-selected')) {

                result.push(
                    [
                        $leaveBlock.data('date'),
                        $this.data('value')
                    ]
                );
            }

        });

        return JSON.stringify(result);
    }

    $('.btnSave').on('click', function () {

        var leaveDates = getLeaveDate();

        console.log(leaveDates)
    })

</script>