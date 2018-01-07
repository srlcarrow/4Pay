<div class="card flat mt-30">
    <div class="card-content">
        <div class="cm-accordion">

            <div class="cm-accordion-row">
                <div class="cm-accordion-header">
                    <h5>Basic Information</h5>
                </div>

                <div class="cm-accordion-content">

                    <div class="row mb-not-last-25">
                        <div class="col-md-3">
                            <h5 class="text-info">Full Name</h5>
                        </div>
                        <div class="col-md-9">
                            <h5 class="text-info"><?php echo $empBasicData->emp_full_name; ?></h5>
                        </div>
                    </div>
                    <div class="row mb-not-last-25">
                        <div class="col-md-3">
                            <h5 class="text-info">Name With Initials</h5>
                        </div>
                        <div class="col-md-9">
                            <h5 class="text-info"><?php echo $empBasicData->emp_name_with_initials; ?></h5>
                        </div>
                    </div>
                    <div class="row mb-not-last-25">
                        <div class="col-md-3">
                            <h5 class="text-info">Date Of Birth</h5>
                        </div>
                        <div class="col-md-9">
                            <h5 class="text-info"><?php echo $empBasicData->emp_dob; ?></h5>
                        </div>
                    </div>
                    <div class="row mb-not-last-25">
                        <div class="col-md-3">
                            <h5 class="text-info">Civil Status</h5>
                        </div>
                        <div class="col-md-9">
                            <h5 class="text-info"><?php echo $empBasicData->emp_civil_status; ?></h5>
                        </div>
                    </div>


                </div>
            </div>

            <!--Contact Infomation-->
            <div class="cm-accordion-row">
                <div class="cm-accordion-header">
                    <h5>Contact Information</h5>
                </div>

                <div class="cm-accordion-content">

                    <div class="row mb-not-last-25">
                        <div class="col-md-3">
                            <h5 class="text-info">Permanent Address</h5>
                        </div>
                        <div class="col-md-9">
                            <h5 class="text-info"><?php echo $empContactsData->con_permenant_add == "" ? '-' : $empContactsData->con_permenant_add; ?></h5>
                        </div>
                    </div>
                    <div class="row mb-not-last-25">
                        <div class="col-md-3">
                            <h5 class="text-info">Temporary Address</h5>
                        </div>
                        <div class="col-md-9">
                            <h5 class="text-info"><?php echo $empContactsData->con_temp_add == "" ? '-' : $empContactsData->con_temp_add; ?></h5>
                        </div>
                    </div>
                    <div class="row mb-not-last-25">
                        <div class="col-md-3">
                            <h5 class="text-info">Office Email</h5>
                        </div>
                        <div class="col-md-9">
                            <h5 class="text-info"><?php echo $empContactsData->con_office_email == "" ? '-' : $empContactsData->con_office_email; ?></h5>
                        </div>
                    </div>
                    <div class="row mb-not-last-25">
                        <div class="col-md-3">
                            <h5 class="text-info">Personal Email</h5>
                        </div>
                        <div class="col-md-9">
                            <h5 class="text-info"><?php echo $empContactsData->con_personal_email == "" ? '-' : $empContactsData->con_personal_email; ?></h5>
                        </div>
                    </div>
                    <div class="row mb-not-last-25">
                        <div class="col-md-3">
                            <h5 class="text-info">Home Tel</h5>
                        </div>
                        <div class="col-md-9">
                            <h5 class="text-info"><?php echo $empContactsData->con_home_tel == "" ? '-' : $empContactsData->con_home_tel; ?></h5>
                        </div>
                    </div>
                    <div class="row mb-not-last-25">
                        <div class="col-md-3">
                            <h5 class="text-info">Mobile One</h5>
                        </div>
                        <div class="col-md-9">
                            <h5 class="text-info"><?php echo $empContactsData->con_mobile1 == "" ? '-' : $empContactsData->con_mobile1; ?></h5>
                        </div>
                    </div>
                    <div class="row mb-not-last-25">
                        <div class="col-md-3">
                            <h5 class="text-info">Mobile Two</h5>
                        </div>
                        <div class="col-md-9">
                            <h5 class="text-info"><?php echo $empContactsData->con_mobile2 == "" ? '-' : $empContactsData->con_mobile2; ?></h5>
                        </div>
                    </div>

                </div>
            </div>

            <div class="cm-accordion-row">
                <div class="cm-accordion-header">
                    <h5>Change Password</h5>
                </div>

                <div class="cm-accordion-content">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array('id' => 'passReset'));
                    ?>
                    <div class="row mb-not-last-25">
                        <div class="col-md-3">
                            <h5 class="text-info mt-10">Old Password</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="oldPw" type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-not-last-25">
                        <div class="col-md-3">
                            <h5 class="text-info mt-10">New Password</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="pw" type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-not-last-25">
                        <div class="col-md-3">
                            <h5 class="text-info mt-10">Re Password</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="rePw" type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="alert "></div>
                    </div>
                    <div class="row mb-not-last-25">
                        <div class="col-md-9 col-md-offset-3">
                            <button type="button" class="btn btn-primary" onclick="save()">Edit</button>
                            <button type="button" class="btn btn-default">Close</button>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
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

    function save() {

        Alert().loading();

        insert({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/ResetPassword'; ?>",
            data: $('#passReset').serialize(),
            dataType: 'json',
            success: function (responce) {

                if (responce.code == 200) {
                    Alert().success(responce.msg);
                } else {
                    Alert().error(responce.msg);
                }
            },
            error: function (request, status, error) {
                Alert().error(error);
            }
        });
    }
</script>