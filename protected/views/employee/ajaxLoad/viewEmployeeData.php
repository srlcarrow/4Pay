<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">
<!-- <<<<<<< ShortLeave

            <div class="col s12">
                <button class="cm-btn add right addNewCompany" type="button" onclick="addEmployee()">Add New
                </button>
            </div>
======= -->


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
                                    <th>EPF</th>
                                    <th>EMP</th>
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
                                            <button  title="Edit" type="button" onclick="editEmployee('<?php echo $employee->emp_id; ?>')"  class="ic ic-20 ic-edit"></button>
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
            <div class="row">
                <div class="col-md-12 mt-15 mb-15" id="pagination">
                    <?php
                    Paginations::setLimit($pageSize);
                    Paginations::setPage($page);
                    Paginations::setJSCallback("searchData");
                    Paginations::setTotalPages($count);
                    Paginations::makePagination();
                    Paginations::drawPagination();
                    ?>
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