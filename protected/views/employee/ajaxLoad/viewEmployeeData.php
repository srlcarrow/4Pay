<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">

            <div class="col s12">
                <button class="cm-btn add right addNewCompany" type="button" onclick="addEmployee()">Add New
                </button>
            </div>

            <div class="card-header">
                <h1>Employees </h1>
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
                                    $empContacts = EmpContacts::model()->findByAttributes(array('ref_emp_id' => $employee->emp_id));
                                    ?>
                                    <tr>
                                        <td><?php echo $employee->epf_no; ?></td>
                                        <td><?php echo $employee->empno; ?></td>
                                        <td><?php echo $employee->emp_name_with_initials; ?></td>
                                        <td><?php
                                            if (count($empContacts) > 0) {
                                                echo $empContacts->con_office_email;
                                            }
                                            ?></td>
                                        <td><?php
                                            if (count($empContacts) > 0) {
                                                echo $empContacts->con_mobile1;
                                            }
                                            ?></td>
                                        <td class="tb-action text-right">
                                            <button type="button" onclick="editEmployee('<?php echo $employee->emp_id; ?>')"  class="btn btn-sm btn-warning">Edit</button>
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