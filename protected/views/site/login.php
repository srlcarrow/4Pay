<?php $form = $this->beginWidget('CActiveForm', array('id' => 'login')); ?>
<div class="row mt-100">
    <div class="col-md-4 col-md-offset-4">

        <div class="card">

            <div class="card-header">
                <h1>Login</h1>
            </div>

            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">

                        <div class="row form-wrapper">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input id="username" type="text" name="username" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row form-wrapper">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input id="password" type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">

                    <div class="col-md-12">
                        <div class="alert "></div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button type="button" onclick="login()" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<?php $this->endWidget(); ?>

<script>
    $(function () {
        $('#password').keypress(function (e) {
            if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                login()
                return false;
            }
        });

        $("#username").keypress(function (e) {
            if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                login()
                return false;
            }
        });
    });

    function login() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Site/SignIn'; ?>",
            data: $('#login').serialize(),
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    $('.alert').addClass('alert-success').html('Successfully Login....');
                    window.location = http_path + "Site/Index";
                } else {
                    $('.alert').addClass('alert-danger').html('Ops!, Something went wrong.');

                }
            }
        });
    }
</script>