<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'manageLeave'));
?>
<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h1>Manage Leave / Short Leave</h1>
            </div>

            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="th-checkbox">

                                        <div class="checkbox mt-0 mb-0">
                                            <input id="id_all" type="checkbox" class="select-All">
                                            <label for="id_all"></label>
                                        </div>
                                    </th>
                                    <th>EPF No</th>
                                    <th>EMP No</th>
                                    <th>Name</th>
                                    <th class="tb-action">Leave</th>
                                    <th class="tb-action">Short Leave</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($employeeData as $employee) {
                                    ?>
                                    <tr class="ch_bx">
                                        <td>
                                            <div class="checkbox mt-0 mb-0">
                                                <input type="checkbox" id="id_<?php echo $employee->emp_id; ?>" class="check_sc"
                                                       name="selectedIds[]" value="<?php echo $employee->emp_id; ?>">

                                                <label for="id_<?php echo $employee->emp_id; ?>"></label>
                                            </div>

                                        </td>
                                        <td><?php echo $employee->epf_no; ?></td>
                                        <td><?php echo $employee->empno; ?></td>
                                        <td><?php echo $employee->emp_name_with_initials; ?></td>
                                        <td class="tb-action text-right">
                                            <button type="button" onclick="applyLeave('<?php echo $employee->emp_id; ?>')" class="btn btn-sm btn-primary">Apply</button>
                                        </td>
                                        <td class="tb-action text-right">
                                            <button type="button" onclick="applyShortLeave('<?php echo $employee->emp_id; ?>')"
                                                    class="btn btn-sm btn-primary">Apply
                                            </button>
                                        </td>
                                        <?php
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <div class="alert "></div>
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
    function save() {
        insert({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Leave/SaveLeaveAllocationData'; ?>",
            data: $('#manageLeave').serialize(),
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    $('.alert').addClass('alert-success').html('Successfully Saved....');
                }
            }
        });
    }

    function applyShortLeave(id) {
        window.location.href = '<?php echo Yii::app()->baseUrl . '/ShortLeave/ViewShortLeaveApplyPanel/id/'; ?>' + id;
    }

    function applyLeave(id) {
        window.location.href = '<?php echo Yii::app()->baseUrl . '/Leave/ViewLeave/id/'; ?>' + id;
    }

</script>