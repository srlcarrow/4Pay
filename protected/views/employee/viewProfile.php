<?php
// profile
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/profile/profile.css', 'screen');
?>


<script src="<?php echo Yii::app()->baseUrl ?>/js/plugins/imageCrop/croppie.js"></script>
<script src="<?php echo Yii::app()->baseUrl ?>/js/plugins/rangeSlider/rangeslider.js"></script>

<!--Popup-->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h3 class="modal-title text-center">Profile Image</h3>
            </div>
            <div class="modal-body pt-0 pb-0">

                <div id="image-cropper">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="cropit-preview"></div>
                        </div>

                        <div class="col-md-8 col-md-offset-2 mt-15">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <input min="0" max="1" type="range" value="0" step="0.01"
                                           class="cropit-image-zoom-input rangeSlide" data-rangeslider>
                                </div>
                                <div class="col-md-12 mt-10 text-center">

                                    <div class="file-uploader">
                                        Upload
                                        <input type="file" class="cropit-image-input"/>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="modal-footer pb-30">
                <button type="button" class="btn btn-primary download-btn">Change</button>
            </div>
        </div>
    </div>
</div>

<section class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ds-table-block">
                    <div class="cell width-1 pr-30">
                        <div class="avatar avatar-80">
                            <img src="<?php echo Yii::app()->baseUrl ?>/images/avatar/80/avatar_white.png" alt="">
                            <span class="image-change">change</span>
                        </div>
                    </div>
                    <div class="cell">
                        <h1><?php echo $empBasicData->emp_display_name; ?></h1>
                        <h3><?php echo $empEmploymentData->rel_designation->designation; ?></h3>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="tab-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="cm-tab cm-ajax-tab">
                    <li><a class="is-active" onclick="profile()" href="#profile">Profile</a></li>
                    <li><a href="#Leave" onclick="myAttendance()">My Attendance</a></li>
                    <li><a href="#Leave" onclick="leave()">Leave</a></li>
                    <li><a href="#Leave" onclick="shortLeave()">Short Leave</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="content-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="ajaxLoad"></div>
            </div>
        </div>
    </div>
</section>

<script>
    rangesliderJs.create($('.rangeSlide'), {});
</script>

<script>


    $(document).ready(function (e) {
        profile();

        $('#image-cropper').cropit({
            imageBackground: false,
            onImageLoaded: function () {

            },
            onImageError: function (e) {
                showErrorMessage(e.message, "Proifle");
            },
            width: 160,
            height: 160
        });
    });

    $('.image-change').on('click', function () {
        var $modal = $('#profileModal');
        $modal.modal('show')
    });

    // Exporting cropped image
    $('.download-btn').click(function () {
        var imageData = $('#image-cropper').cropit('export', {
                type: 'image/jpeg',
            }
        );
        alert(imageData)
    });

    function profile() {
        fetch({
            appendTo: '#ajaxLoad',
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/ViewProfileData'; ?>",
            data: "",
            success: function (responce) {
                $("#ajaxLoad").html(responce);
            }
        });
    }

    function myAttendance() {
        fetch({
            appendTo: '#ajaxLoad',
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/ViewMyAttendance'; ?>",
            data: "",
            success: function (responce) {
                $("#ajaxLoad").html(responce);
            }
        });
    }

    function leave() {
        fetch({
            appendTo: '#ajaxLoad',
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/ViewLeave'; ?>",
            data: "",
            success: function (responce) {
                $("#ajaxLoad").html(responce);
            }
        });
    }

    function shortLeave() {
        fetch({
            appendTo: '#ajaxLoad',
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/ViewShortLeave'; ?>",
            data: "",
            success: function (responce) {
                $("#ajaxLoad").html(responce);
            }
        });
    }
</script>