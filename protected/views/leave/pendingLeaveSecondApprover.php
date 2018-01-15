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
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Reject Reason</th>
                                    <th class="tb-action">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($pendingLeaves as $pendLeaves) {
                                    $empBasic = EmpBasic::model()->findByPk($pendLeaves->ref_emp_id);
                                    ?>
                                    <tr>
                                        <td><?php echo $empBasic->empno; ?></td>
                                        <td><?php echo $empBasic->emp_name_with_initials; ?></td>
                                        <td><?php echo $pendLeaves->lv_from; ?></td>
                                        <td><?php echo $pendLeaves->lv_to; ?></td>
                                        <td><input type="text" name="rejectReason_<?php echo $pendLeaves->lv_id; ?>" id="rejectReason_<?php echo $pendLeaves->lv_id; ?>" class="form-control" value="" placeholder="Reject Reason" /></td>
                                        <td class="tb-action text-right">
                                            <button type="button" onclick="approveShortLeaveSecondApprover('<?php echo $pendLeaves->lv_id; ?>')" class="btn btn-sm btn-warning">App</button> 
                                            <button type="button" onclick="rejectShortLeaveSecondApprover('<?php echo $pendLeaves->lv_id; ?>')"  class="btn btn-sm btn-danger">Reject</button>
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

    function approveShortLeaveSecondApprover(id) {
        swal({
            title: "Are you sure?",
            text: "You want to approve this Leave?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Approve it!",
            cancelButtonText: "No, Cancel it!",
            closeOnConfirm: true,
            closeOnCancel: true
        },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'POST',
                            url: "<?php echo Yii::app()->baseUrl . '/Leave/ApproveLeaveSecondApprover'; ?>",
                            data: {leaveId: id},
                            success: function (res) {
                                if (res) {
                                    setTimeout(function () {
                                        location.reload();
                                    }, 500);
                                } else {
                                    swal("Cancelled", "You are not allowed to delete today's leaves.", "error");
                                }
                            }
                        });
                    }
                }
        );
    }

    function rejectShortLeaveSecondApprover(id) {
        var reason = document.getElementById("rejectReason_" + id).value;
        if (reason == '') {
            $("#rejectReason_" + id).focus();
        } else {
            swal({
                title: "Are you sure?",
                text: "You want to reject this Leave?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Reject it!",
                cancelButtonText: "No, Cancel it!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type: 'POST',
                                url: "<?php echo Yii::app()->baseUrl . '/Leave/RejectLeaveSecondApprover'; ?>",
                                data: {leaveId: id, reason: reason},
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