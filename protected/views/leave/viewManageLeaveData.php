<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'manageLeave'));

$leaveTypes = AdmLeavetypes::model()->findAll();
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
                                    <th><input type="checkbox" class="select-All"></th>
                                    <th>EPF No</th>
                                    <th>EMP No</th>
                                    <th>Name</th>
                                    <th class="tb-action">Apply Leave</th>
                                    <th class="tb-action">Apply S-Leave</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($employeeData as $employee) {
                                    ?>
                                    <tr class="ch_bx">
                                        <td><input type="checkbox"  class="check_sc" name="selectedIds[]" value="<?php echo $employee->emp_id; ?>"></td>
                                        <td><?php echo $employee->epf_no; ?></td>
                                        <td><?php echo $employee->empno; ?></td>
                                        <td><?php echo $employee->emp_name_with_initials; ?></td>
                                        <td class="tb-action text-right">
                                            <button type="button" class="btn btn-sm btn-warning">Apply</button>                                           
                                        </td>
                                        <td class="tb-action text-right">
                                            <button type="button" onclick="applyShortLeave('<?php echo $employee->emp_id; ?>')" class="btn btn-sm btn-danger">Apply</button>                                         
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
    
</script>