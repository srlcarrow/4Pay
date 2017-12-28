<?php
// profile
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/profile/profile.css', 'screen');
?>

<section class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Nishadi Fernando</h1>
                <h3>Finance Manager</h3>
            </div>
        </div>
    </div>
</section>

<section class="tab-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="cm-tab cm-ajax-tab">
                    <li><a class="is-active" href="basic">Profile</a></li>
                    <li><a href="leave">Leave</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="content-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card flat mt-30">
                    <div class="card-content loadAjax">

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>

    function getLayout(path, callback) {
        fetch({
            type: 'GET',
            url: "<?php echo Yii::app()->baseUrl?>/" + path,
            success: function (res) {
                callback(res);
            }
        });
    }

    $(function () {
        var ajaxLoad = $('.loadAjax');
        var path = {
            basic: "employee/Basic",
            leave: "employee/Leave"
        };

        //page load
        getLayout(path['basic'], function (html) {
            ajaxLoad.html(html);
        });

        $(document).on('click.cm-ajax-tab', '.cm-ajax-tab li a', function (e) {
            e.preventDefault();

            var $this = $(this),
                href = $this.attr('href');

            getLayout(path[href], function (html) {
                ajaxLoad.html(html);
            });

        });
    });

</script>

