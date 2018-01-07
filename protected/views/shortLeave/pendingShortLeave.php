<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h1>Pending Short Leaves for Approval</h1>
            </div>

            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>EMP No</th>
                                    <th>Name</th>
                                    <th>Short Leave Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Reject Reason</th>
                                    <th class="tb-action">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($pendingShortLeaves as $pendingSLeaves) {
                                    $empBasic = Empbasic::model()->findByPk($pendingSLeaves->ref_emp_id);
                                    ?>
                                    <tr>
                                        <td><?php echo $empBasic->empno; ?></td>
                                        <td><?php echo $empBasic->emp_name_with_initials; ?></td>
                                        <td><?php echo $pendingSLeaves->short_leave_date; ?></td>
                                        <td><?php echo date("H:i", strtotime($pendingSLeaves->start_time)); ?></td>
                                        <td><?php echo date("H:i", strtotime($pendingSLeaves->end_time)); ?></td>
                                        <td><input type="text" name="rejectReason_<?php echo $pendingSLeaves->short_lv_id; ?>" id="rejectReason_<?php echo $pendingSLeaves->short_lv_id; ?>" class="form-control" value="" placeholder="Reject Reason" /></td>
                                        <td class="tb-action text-right">
                                            <button type="button" onclick="approveShortLeave('<?php echo $pendingSLeaves->short_lv_id; ?>')" class="btn btn-sm btn-warning">App</button> 
                                            <button type="button" onclick="rejectShortLeave('<?php echo $pendingSLeaves->short_lv_id; ?>')"  class="btn btn-sm btn-danger">Reject</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>

    function approveShortLeave(id) {
        swal({
            title: "Are you sure?",
            text: "You will not have this data anymore!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: true,
            closeOnCancel: true
        },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'POST',
                            url: "<?php echo Yii::app()->baseUrl . '/ShortLeave/ApproveShortLeave'; ?>",
                            data: {shortLeaveId: id},
                            success: function (res) {
                                if (res) {
                                    setTimeout(function () {
                                        location.reload();
                                    }, 500);
                                } else {
                                    swal("Cancelled", "You are not allowed to delete today's short leaves.", "error");
                                }
                            }
                        });
                    }
                }
        );
    }

    function rejectShortLeave(id) {
        var reason = document.getElementById("rejectReason_" + id).value;
        if (reason == '') {
            $("#rejectReason_" + id).focus();
        } else {
            swal({
                title: "Are you sure?",
                text: "You will not have this data anymore!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type: 'POST',
                                url: "<?php echo Yii::app()->baseUrl . '/ShortLeave/RejectShortLeave'; ?>",
                                data: {shortLeaveId: id, reason: reason},
                                success: function (res) {
                                    if (res) {
                                        setTimeout(function () {
                                            location.reload();
                                        }, 500);
                                    } else {
                                        swal("Cancelled", "You are not allowed to delete today's short leaves.", "error");
                                    }
                                }
                            });
                        }
                    }
            );
        }
    }

</script>