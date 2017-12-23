<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h1>Attendance </h1>
            </div>

            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>EPF No</th>
                                    <th>EMP No</th>
                                    <th>Name</th>
                                    <th>Day</th>
                                    <th>Date In</th>
                                    <th>Punch In</th>
                                    <th>Date Out</th>
                                    <th>Punch Out</th>
                                    <th>In OT</th>
                                    <th>Late</th>
                                    <th>Early Leave</th>
                                    <th>Over Time</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($employeeData as $employee) {
                                    ?>
                                    <tr>
                                        <td><?php echo $employee->epf_no;  ?></td>
                                        <td><?php echo $employee->empno;  ?></td>
                                        <td><?php echo $employee->emp_name_with_initials;  ?></td>
                                        <td><?php echo "Email";  ?></td>
                                        <td><?php echo "Contact";  ?></td>
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