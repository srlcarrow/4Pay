<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <div class="ds-table-block">
                    <h1 class="cell width-100">Employees </h1>
                    <div class="cell width-2 text-right">
                        <button class="btn btn-primary addNewCompany" type="button" onclick="addEmployee()">Add New
                        </button>
                    </div>
                </div>
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
                                <th>Email</th>
                                <th>Phone</th>
                                <th class="tb-action">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            foreach ($employeeData as $employee) {
                                ?>
                                <tr>
                                    <td><?php echo $employee->epf_no; ?></td>
                                    <td><?php echo $employee->empno; ?></td>
                                    <td><?php echo $employee->emp_name_with_initials; ?></td>
                                    <td><?php echo "Email"; ?></td>
                                    <td><?php echo "Contact"; ?></td>
                                    <td class="tb-action">
                                        <button  class="ic ic_20 ic_edit" type="button"
                                                onclick="editEmployee('<?php echo $employee->emp_id; ?>')"></button>
                                        <!--<button type="button" class="btn btn-sm btn-danger">Delete</button>-->
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

    function addEmployee() {
        window.location.href = '<?php echo Yii::app()->baseUrl . '/Employee/AddEmployee'; ?>';
    }

    function editEmployee(id) {
        window.location.href = '<?php echo Yii::app()->baseUrl . '/Employee/AddEmployee/id/'; ?>' + id;
    }

</script>