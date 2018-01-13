<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h1>Short Leave History</h1>
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
                                    <th>First Approver</th>
                                    <th>Second Approver</th>
                                    <th class="tb-action">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($shortLeavesHistroy as $shortLeaves) {
                                    $empBasic = EmpBasic::model()->findByPk($shortLeaves->ref_emp_id);
                                    ?>
                                    <tr>
                                        <td><?php echo $empBasic->empno; ?></td>
                                        <td><?php echo $empBasic->emp_name_with_initials; ?></td>
                                        <td><?php echo $shortLeaves->short_leave_date; ?></td>
                                        <td><?php echo date("H:i", strtotime($shortLeaves->start_time)); ?></td>
                                        <td><?php echo date("H:i", strtotime($shortLeaves->end_time)); ?></td>
                                        <td>
                                            <?php
                                            if ($shortLeaves->approver_status == 1) {
                                                echo 'Approved';
                                            } elseif ($shortLeaves->approver_status == 2) {
                                                echo 'Rejected';
                                            } else {
                                                echo 'Pending';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($shortLeaves->second_approver_status == 1) {
                                                echo 'Approved';
                                            } elseif ($shortLeaves->second_approver_status == 2) {
                                                echo 'Rejected';
                                            } else {
                                                echo 'Pending';
                                            }
                                            ?>
                                        </td>
                                        <td class="tb-action text-right">
                                            <button type="button" onclick="deleteShortLeave('<?php echo $shortLeaves->short_lv_id; ?>')"  class="ic ic-20 ic-delete" title="Delete"></button>
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


