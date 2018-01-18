<div class="card flat mt-30">
    <div class="card-content">

        <div class="row m-m-30">
            <div class="col-md-12 pl-0 pr-0 bg-primary-dark mb-30">
                <div class="ds-table-block width-1">

                    <div class="cell width-1 pl-30 pr-30 white-border-right">
                        <div class="pt-25 pb-25">
                            <div class="text-uppercase text-nowrap mb-28">
                                <span class="f-16 text-white lighten-1">Annual</span>
                                <span class="f-16 text-white lighten-1 ml-10 mr-10">=</span>
                                <span class="f-24 text-white f-500">14</span>
                            </div>

                            <div class="ds-table-block width-1">

                                <div class="width-1 cell pr-15 white-border-right w-2 lighten-2">
                                    <span class="f-24 ds-block text-white f-500 line-h-20">7</span>
                                    <span class="f-14 ds-block text-white lighten-2 f-300">Utilize</span>
                                </div>

                                <div class="width-1 cell pl-15">
                                    <span class="f-24 ds-block text-white f-500 line-h-20">7</span>
                                    <span class="f-14 ds-block text-white lighten-2 f-300">Balance</span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="cell width-1 pl-30 pr-30 white-border-right">
                        <div class="pt-25 pb-25">
                            <div class="text-uppercase text-nowrap mb-28">
                                <span class="f-16 text-white lighten-1">Annual</span>
                                <span class="f-16 text-white lighten-1 ml-10 mr-10">=</span>
                                <span class="f-24 text-white f-500">14</span>
                            </div>

                            <div class="ds-table-block width-1">

                                <div class="width-1 cell pr-15 white-border-right w-2 lighten-2">
                                    <span class="f-24 ds-block text-white f-500 line-h-20">7</span>
                                    <span class="f-14 ds-block text-white lighten-2 f-300">Utilize</span>
                                </div>

                                <div class="width-1 cell pl-15">
                                    <span class="f-24 ds-block text-white f-500 line-h-20">7</span>
                                    <span class="f-14 ds-block text-white lighten-2 f-300">Balance</span>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="row form-wrapper">
            <div class="col-md-4">
                <div class="row form-wrapper">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Leave Type</label>
                            <select id="type" class="form-control" onchange="loadLeaveData()">
                                <?php
                                if (count($leaveAllocation) > 0) {
                                    foreach ($leaveAllocation as $leaveType) {
                                        ?>
                                        <option value="<?php echo $leaveType->rel_leavetype->lt_id; ?>"><?php echo $leaveType->rel_leavetype->lt_name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="ajaxLoadData"></div>
    </div>
</div>

<div id="ajaxLoadLeaveHistory"></div>

<script>
    $(document).ready(function (e) {
        loadLeaveData();
        loadLeaveHistory();
    });

    function loadLeaveData() {
        var selectedLvType = $("#type option:selected").val();

        fetch({
            appendTo: '#ajaxLoadData',
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/ViewLeaveData'; ?>",
            data: {selectedLvType: selectedLvType},
            success: function (responce) {
                $("#ajaxLoadData").html(responce);
            }
        });
    }

    function loadLeaveHistory() {
        fetch({
            appendTo: '#ajaxLoadLeaveHistory',
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employee/ViewSelfLeaveHistory'; ?>",
            data: "",
            success: function (responce) {
                $("#ajaxLoadLeaveHistory").html(responce);
            }
        });
    }
</script>

