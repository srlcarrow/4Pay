<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h1>Leave History</h1>
            </div>

            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Leave Type</th>
                                    <th>Leave From</th>
                                    <th>Leave To</th>
                                    <th>Leave Count</th>
                                    <th>First Approver</th>
                                    <th>Second Approver</th>
                                    <th class="tb-action">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($leaveData as $leave) {
                                    ?>
                                    <tr>
                                        <td><?php echo $leave->lt_name; ?></td>
                                        <td><?php echo $leave->lv_from; ?></td>
                                        <td><?php echo $leave->lv_to; ?></td>
                                        <td><?php echo $leave->lv_no_of_leaves; ?></td>
                                        <td><?php echo $leave->lv_first_sup_approved == 0 ? "Pending" : "Approved"; ?></td>
                                        <td><?php echo $leave->lv_sec_sup_approved == 0 ? "Pending" : "Approved"; ?></td>
                                        <td class="tb-action text-right">
                                            <button type="button" onclick="deleteShortLeave('<?php echo $leave->lv_id; ?>')"  class="ic ic-20 ic-delete" title="Delete"></button>
                                        </td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


