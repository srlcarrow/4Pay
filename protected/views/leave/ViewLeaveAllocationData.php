<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'leaveAllocation'));

$leaveTypes = AdmLeavetypes::model()->findAll();
?>
<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h1>Leave Allocation</h1>
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
                                    <!--<th>EPF</th>-->
                                    <th>EMP</th>
                                    <th>Name</th>
                                    <?php
                                    foreach ($leaveTypes as $leaveType) {
                                        ?>
                                        <th><?php echo $leaveType->lt_name; ?></th>
                                        <th>Y/N</th>
                                        <?php
                                    }
                                    ?>

                                    <th>1<sup>st</sup>&nbsp;Superior</th>
                                    <th>2<sup>nd</sup>&nbsp;Superior</th>
                                    <th>1<sup>st</sup>&nbsp;Approver</th>
                                    <th>2<sup>nd</sup>&nbsp;Approver</th>
                                    <th>Cover&nbsp;up</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($employeeData as $employee) {
                                    ?>
                                    <tr class="ch_bx">
                                        <td>
                                            <div class="checkbox mt-0 mb-0">
                                                <input id="id_<?php echo $employee->emp_id; ?>" type="checkbox" class="check_sc" name="selectedIds[]"
                                                       value="<?php echo $employee->emp_id; ?>">
                                                <label for="id_<?php echo $employee->emp_id; ?>"></label>
                                            </div>
                                        </td>
                                        <!--<td><?php //echo $employee->epf_no; ?></td>-->
                                        <td><?php echo $employee->empno; ?></td>
                                        <td><?php echo $employee->emp_name_with_initials; ?></td>
                                        <?php
                                        foreach ($leaveTypes as $leaveType) {
                                            $leaveAllocation = LeaveAllocation::model()->findByAttributes(array('ref_emp_id' => $employee->emp_id, 'ref_lv_type_id' => $leaveType->lt_id));
                                            $firstSup = EmpBasic::model()->findByPk($employee->emp_sup_one);
                                            $secondSup = EmpBasic::model()->findByPk($employee->emp_sup_two);
                                            $empBasicData = EmpBasic::model()->findByPk($employee->emp_id);
                                            ?>
                                            <td>
                                                <input type="text"
                                                       name="leave_<?php echo $leaveType->lt_id . '_' . $employee->emp_id; ?>"
                                                       class="form-control"
                                                       value="<?php echo count($leaveAllocation) > 0 ? $leaveAllocation->la_allocated_amount : ''; ?>"/>
                                            </td>
                                            <td class="td-checkbox"> 
                                                <div class="checkbox mb-0 mt-0">
                                                    <input id="ena_<?php echo $leaveType->lt_id . '_' . $employee->emp_id; ?>" name="ena_<?php echo $leaveType->lt_id . '_' . $employee->emp_id; ?>" type="checkbox" <?php echo count($leaveAllocation) > 0 && $leaveAllocation->is_available_leave_type == 0 ? "" : "checked=checked"; ?> value="1">
                                                    <label for="ena_<?php echo $leaveType->lt_id . '_' . $employee->emp_id; ?>"></label> 
                                                </div>
                                            </td>
                                            <?php
                                        }
                                        ?>
                                        <td><input type="text" name="firstSup_<?php echo $employee->emp_id; ?>"
                                                   class="form-control"
                                                   value="<?php echo count($firstSup) > 0 ? $firstSup->empno : ''; ?>"
                                                   placeholder="EMP No"/></td>
                                        <td><input type="text" name="secSup_<?php echo $employee->emp_id; ?>"
                                                   class="form-control"
                                                   value="<?php echo count($secondSup) > 0 ? $secondSup->empno : ''; ?>"
                                                   placeholder="EMP No"/></td> 
                                        <td class="td-checkbox">
                                            <div class="checkbox mb-0 mt-0">
                                                <input id="id1_<?php echo $employee->emp_id; ?>" name="firstSupNeed_<?php echo $employee->emp_id; ?>" type="checkbox" <?php echo count($empBasicData) > 0 && $empBasicData->is_enable_emp_sup_one == 0 ? "" : "checked=checked"; ?> value="1">
                                                <label for="id1_<?php echo $employee->emp_id; ?>"></label>   
                                            </div>
                                        </td>

                                        <td class="td-checkbox">
                                            <div class="checkbox mb-0 mt-0">
                                                <input id="id2_<?php echo $employee->emp_id; ?>" name="secondSupNeed_<?php echo $employee->emp_id; ?>" type="checkbox" <?php echo count($empBasicData) > 0 && $empBasicData->is_enable_emp_sup_two == 0 ? "" : "checked=checked"; ?> value="1">
                                                <label for="id2_<?php echo $employee->emp_id; ?>"></label>   
                                            </div>
                                        </td>

                                        <td class="td-checkbox">
                                            <div class="checkbox mb-0 mt-0">
                                                <input id="id3_<?php echo $employee->emp_id; ?>" name="coverupNeed_<?php echo $employee->emp_id; ?>" type="checkbox" <?php echo count($empBasicData) > 0 && $empBasicData->is_enable_coverup == 0 ? "" : "checked=checked"; ?> value="1">
                                                <label for="id3_<?php echo $employee->emp_id; ?>"></label>   
                                            </div>
                                        </td>

                                        <?php
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">

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

                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-primary" onclick="save()">Save</button>
                    </div>

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

        Alert().loading();

        insert({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Leave/SaveLeaveAllocationData'; ?>",
            data: $('#leaveAllocation').serialize(),
            dataType: 'json',
            success: function (responce) {

                if (responce.code == 200) {
                    Alert().success('Successfully Saved....');
                }
            },
            error: function (request, status, error) {
                Alert().error(error);
            }
        });
    }
</script>