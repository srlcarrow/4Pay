<?php $form = $this->beginWidget('CActiveForm', array('id' => 'accountIssue')); ?>
<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h1>Issue User Accounts</h1>
            </div>

            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="th-checkbox">
                                    <div class="checkbox mt-0 mb-0">
                                        <input type="checkbox" id="id_all" class="select-All">
                                        <label for="id_all"></label>
                                    </div>
                                </th>
                                <th>EPF No</th>
                                <th>EMP No</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Issued Status</th>
                                <th>Issued Date</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            foreach ($employeeData as $employee) {
                                $userData = User::model()->findByAttributes(array('ref_emp_id' => $employee->emp_id));
                                ?>
                                <tr class="ch_bx">
                                    <td>
                                        <div class="checkbox mt-0 mb-0">
                                            <input id="id_<?php echo $employee->emp_id; ?>" type="checkbox" class="check_sc" name="selectedIds[]"
                                                   value="<?php echo $employee->emp_id; ?>">
                                            <label for="id_<?php echo $employee->emp_id; ?>"></label>
                                        </div>
                                    </td>
                                    <td><?php echo $employee->epf_no; ?></td>
                                    <td><?php echo $employee->empno; ?></td>
                                    <td><?php echo $employee->emp_name_with_initials; ?></td>
                                    <td><?php echo $employee->epf_no; ?></td>
                                    <td><?php echo $employee->con_office_email; ?></td>
                                    <td>
                                        <?php
                                        $userTypeId = count($userData) > 0 ? $userData->ref_user_type_id : 1;
                                        echo Chtml::dropDownList('userType_' . $employee->emp_id, "", CHtml::listData(UserType::model()->findAll(), 'ut_id', 'ut_name'), array('class' => 'form-control', 'options' => array($userTypeId => array('selected' => true))));
                                        ?>
                                    </td>
                                    <td><?php echo count($userData) > 0 && $userData->is_acc_issued == 1 ? "Issued" : ""; ?></td>
                                    <td><?php echo count($userData) > 0 && $userData->is_acc_issued == 1 ? date('Y-m-d', strtotime($userData->user_acc_issued_date)) : ""; ?></td>
                                </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-30">
                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-sm btn-default" onclick="issueAccounts()">Issue Accounts</button>
                        <button type="button" class="btn btn-sm btn-primary" onclick="updateAccounts()">Update User Type</button>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
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
<?php $this->endWidget(); ?>

<script>
    $('.select-All').click(function () {
        if ($(this).prop('checked')) {
            $('.ch_bx').find('.check_sc').prop('checked', true);
        } else {
            $('.ch_bx').find('.check_sc').prop('checked', false);
        }
    });
</script>
<script>
    function issueAccounts() {
        insert({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/employee/IssueAccounts'; ?>",
            data: $('#accountIssue').serialize(),
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {

                }
            }
        });
    }

    function updateAccounts() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/employee/UpdateAccounts'; ?>",
            data: $('#accountIssue').serialize(),
            dataType: 'json',
            success: function (responce) {

                if (responce.code == 200) {

                }
            }
        });
    }
</script>