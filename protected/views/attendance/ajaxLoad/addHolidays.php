<div class="modal-dialog">
    <div class="modal-content popup">
        <div class="modal-header">
            <button type="button" class="p-close" data-dismiss="modal" aria-label="Close" >
                <span>
                    <svg version="1.1" id="Layer_1" x="0px" y="0px" width="15px" height="15px"
                         viewBox="2.5 2.5 15 15">
                    <g>
                    <g>
                    <path d="M17.373,3.471l-0.845-0.842L10,9.159l-6.529-6.53L2.628,3.471l6.529,6.53l-6.529,6.528l0.842,0.842
                          L10,10.844l6.529,6.527l0.844-0.84l-6.53-6.53L17.373,3.471z"/>
                    </g>
                    </g>
                    </svg>
                </span>
            </button>
            <h4 class="modal-title">Add New Holiday</h4>
        </div>
        <?php
        $form = $this->beginWidget('CActiveForm', array('id' => 'addHoliday-form'));
        ?>
        <div class="modal-body pb-0">
            <div class="row mt-50">
                <div class="col-md-12">
                    <div class="col-md-6 input-layout">
                        <?php
                        echo CHtml::activedropdownlist($model, 'ref_holiday_type_id', CHtml::listData(ConfigHolidayType::model()->findAll(), 'holiday_type_id', 'holiday_type_name'), array('empty' => '', 'class' => 'select required'));
                        ?>
                        <label for="">Holiday Type</label>
                    </div>
                    <div class="col-md-6 input-layout">
                        <input type="text" id="name" name="name" value="<?php echo $model->holiday_name; ?>" required>
                        <label for="">Title</label>
                    </div>
                </div>

                <div class="col-md-12 mt-20">
                    <div class="col-md-6">
                        <h5 class="details f-16">
                            <input type="hidden" id="reqDate" name="reqDate" value="<?php echo $reqDate; ?>">
                            <input type="hidden" id="calId" name="calId" value="<?php echo $calId; ?>">
                            <span class="selectedDay"><?php echo date('l', strtotime($reqDate)); ?></span> 
                            <span class="date"><?php echo date('d F Y', strtotime($reqDate)); ?></span>                                                          
                        </h5>

                    </div>
                    <div class="col-md-6">
                        <div class="but-gruop-wrp mb-0">
                            <label>
                                <input class="" type="checkbox" name="isApplyForAll">
                                <span class="check-box"></span>
                                <span>Apply for all <span class="selectedDay"><?php echo date('l', strtotime($reqDate)) . 's'; ?></span> </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer pb-15">
            <div class="col-md-12">
                <div class="col-md-12">
                    <button type="submit" class="bx-but bx-save" >Save</button>
                    <button type="button" class="bx-but bx-delete" onclick="Delete()">Delete</button>
                </div>
                <div class="col-lg-12">
                    <!--Massage show here-->
                    <div class="message logoUp"></div>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>


<script>

    var $modal = $('#cln_modal');
    $modal.modal({
        backdrop: 'static',
        keyboard: false
    });

    $("#addHoliday-form").validate({
        submitHandler: function () {
            Save();
        }
    });

    function Save() {
        showInfoMessage();
        sendData('addHoliday-form', '', 'attendance/saveHolidays', function (res) {
            var obj = jQuery.parseJSON(res);
            if (obj.code == 200) {
                showSuccessMessage(obj.msg.msg);
            } else {
                showErrorMessage(obj.msg.msg);
            }
            $modal.modal('hide');
            reloadCalendar();
        });
    }

    function Delete() {
        showInfoMessage();

        sendData('addHoliday-form', '', 'attendance/DeleteHolidays', function (res) {
            var obj = jQuery.parseJSON(res);
            if (obj.code == 200) {
                showSuccessMessage(obj.msg.msg);
            } else {
                showErrorMessage(obj.msg.msg);
            }
            $modal.modal('hide');
            reloadCalendar();
        });
    }

    function reloadCalendar() {
        var extraData = "";
        sendData('search-form', extraData, 'attendance/HolidayCalendarData', function (res) {
            $("#ajax_load_here").html(res);
        });
    }


</script>
