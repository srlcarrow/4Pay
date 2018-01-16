<?php $form = $this->beginWidget('CActiveForm', array('id' => 'leaveData')); ?>
<div class="row">


    <div class="col-md-4">
        <div class="row form-wrapper">
            <div class="col-md-12 form-group">
                <label for="">Purpose</label>
                <textarea name="lvPurpose" class="form-control" rows="3"></textarea>
            </div>
        </div>

        <div class="row form-wrapper">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Start Date</label>
                    <input id="startDate" name="startDate" readonly="readonly" type="text"
                           class="start-date form-control">
                </div>
            </div>
        </div>

        <div class="row form-wrapper">
            <div class="col-md-12">
                <div class="form-group">
                    <label>End Date</label>
                    <input id="endDate" name="endDate" readonly="readonly" type="text" class="end-date form-control">
                </div>
            </div>
        </div>

        <?php
        if ($leaveTypeData->is_enable_coverup == 1) {
            ?>
            <div class="row form-wrapper">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Cover Up</label>
                        <div class="dropdown_list">

                            <div class="search-area">
                                <input id="coverUp" type="text" value="" name="coverUp" onkeyup="coverUpSearch()"
                                       class="drop-input-search form-control">
                            </div>

                            <ul id="empLoad" class="drop-result">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        if ($leaveTypeData->rel_leavetype->is_available_attachments == 1) {
            ?>
            <div class="row form-wrapper">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Attachment</label>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="file-uploader-wrapper show-file-name">
                                    <div class="file-uploader">
                                        Upload
                                        <input type="file" id="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <div class="col-md-6 col-md-offset-1 no-select loadAjaxDate">

    </div>

    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-primary" onclick="applyLeave()">Save</button>
    </div>

</div>
<?php $this->endWidget(); ?>

<script>

    $('.show-file-name').fileUpload();

    var coverupId = null;

    function loadDates() {
        var startDate = $("#startDate").val();
        var endDate = $("#endDate").val();
        var selectedLvType = $("#type option:selected").val();

        fetch({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/ViewLeaveDates'; ?>",
            data: {startDate: startDate, endDate: endDate, selectedLvType: selectedLvType},
            success: function (responce) {
                $(".loadAjaxDate").html(responce);
            }
        });
    }

    function coverUpSearch() {
        var searchCoverUp = "";
        searchCoverUp = $('#coverUp').val();
        fetch({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/SearchCoverUp'; ?>",
            data: {searchCoverUp: searchCoverUp},
            dataType: 'json',
//            beforeSend: function () {
//                if (currentRequest != null) {
//                    currentRequest.abort();
//                }
//            },
            success: function (responce) {
                if (responce.code == 200) {
                    $('#empLoad').empty();
                    var employees = responce.data.emloyeeData;

                    for (var i = 0, max = employees.length; i < max; i++) {
                        $('#empLoad').append($("<li data-id=" + employees[i]['emp_id'] + "><h5>" + employees[i]['emp_name'] + "</h5><h6>" + employees[i]['designation'] + "</h6></li>"));
                    }

                    setClickEvent();
                }
            }
        });
    }

    function setClickEvent() {
        $('#empLoad li').on('click', function () {
            var $li = $(this);
            var p = $(this).parents('.dropdown_list');
            var id = $li.attr('data-id');

            p.find('.drop-input-search').val($li.text());

            coverupId = id;

            p.removeClass('is-open');
        });
    }

    function applyLeave() {
        Alert().loading();
        var leaveDates = getLeaveDate();
        fetch({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Leave/SaveLeave'; ?>",
            data: $('#leaveData').serialize() + "&empId=" + '<?php echo $empId; ?>' + "&coverupId=" + coverupId + "&leaveDates=" + leaveDates + "&leaveTypeId=" + '<?php echo $leaveTypeId; ?>',
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    loadLeaveData();
                    loadLeaveHistory(); 
                    Alert().success('Successfull Leave Applied...!');
                } else {
                    sweetAlert('Can Not Apply Leave!', responce.msg);
                    Alert().close();
                }
            },
            error: function () {
                Alert().error('Sorry, something was wrong!')
            }

        })

    }
</script>

<script>

    var pDate = '<?php echo $maxDate; ?>';
    var startDate = '',
        minDateStar = new Date('<?php echo $minDate; ?>'),
        maxDateStar = new Date(pDate),
        minDateEnd = null,
        maxDateEnd = null,
        numOfDay = '<?php echo $dayCount; ?>';

    console.log('Date => ', pDate);

    datePicker({
        ele: '.start-date',
        minDate: minDateStar,
        maxDate: maxDateStar
    }, function (fdate, date) {

        endDatePicker();

        if ($('.end-date').val().length < 0) {
            $('.end-date').val(fdate);
        }
        var eDate = $('.end-date').val();

        if (eDate.length === 0) {
            $('.end-date').val(fdate);
        }

        var _fDate = new Date(fdate);
        var _eDate = new Date(eDate);


//        if () {
//            $('.end-date').val(fdate);
//        }

        if (_fDate.getTime() <= _eDate.getTime()) {
            loadDates();
        } else {
            $('.end-date').val(fdate);
            loadDates();
        }

    });

    function endDatePicker() {
        var sDate = $('.start-date').val();

        minDateEnd = new Date(sDate);
        var m = new Date(sDate);
        var calMaxDate = new Date(m.setDate(m.getDate() + (numOfDay - 1)));
        console.log(m, m.getDate())

        datePicker({
            ele: '.end-date',
            minDate: minDateEnd,
            maxDate: calMaxDate
        }, function (fdate, date) {

            if (sDate.length === 0)
                return;

            var _fDate = new Date(sDate);
            var _eDate = new Date(fdate);


            if (_fDate.getTime() <= _eDate.getTime()) {
                loadDates();
            }
        });
    }

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

</script>