<?php $form = $this->beginWidget('CActiveForm', array('id' => 'shiftAllocate')); ?>
<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h1>Shift Allocation</h1>
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
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                    <th>Thursday</th>
                                    <th>Friday</th>
                                    <th>Saturday</th>
                                    <th>Sunday</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($employeeData as $employee) {
                                    $userData = User::model()->findByAttributes(array('ref_emp_id' => $employee->emp_id));
                                    ?>
                                    <tr class="ch_bx">
                                        <td><input type="checkbox"  class="check_sc" name="selectedIds[]" value="<?php echo $employee->emp_id; ?>"></td>
                                        <td><?php echo $employee->epf_no; ?></td>
                                        <td><?php echo $employee->empno; ?></td>
                                        <td><?php echo $employee->emp_name_with_initials; ?></td>
                                        <td>
                                            <?php
                                            $mon = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $employee->emp_id, 'day' => 'Monday'));
                                            $id = count($mon) > 0 ? $mon->ref_shift_id : 0;
                                            echo Chtml::dropDownList('mon_' . $employee->emp_id, "", CHtml::listData(Rostershift::model()->findAll(), 'shift_id', 'shift_title'), array('empty' => '-', 'class' => 'form-control', 'options' => array($id => array('selected' => true))));
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $tue = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $employee->emp_id, 'day' => 'Tuesday'));
                                            $id = count($tue) > 0 ? $tue->ref_shift_id : 0;
                                            echo Chtml::dropDownList('tue_' . $employee->emp_id, "", CHtml::listData(Rostershift::model()->findAll(), 'shift_id', 'shift_title'), array('empty' => '-', 'class' => 'form-control', 'options' => array($id => array('selected' => true))));
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $wed = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $employee->emp_id, 'day' => 'Wednesday'));
                                            $id = count($wed) > 0 ? $wed->ref_shift_id : 0;
                                            echo Chtml::dropDownList('wed_' . $employee->emp_id, "", CHtml::listData(Rostershift::model()->findAll(), 'shift_id', 'shift_title'), array('empty' => '-', 'class' => 'form-control', 'options' => array($id => array('selected' => true))));
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $thu = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $employee->emp_id, 'day' => 'Thursday'));
                                            $id = count($thu) > 0 ? $thu->ref_shift_id : 0;
                                            echo Chtml::dropDownList('thu_' . $employee->emp_id, "", CHtml::listData(Rostershift::model()->findAll(), 'shift_id', 'shift_title'), array('empty' => '-', 'class' => 'form-control', 'options' => array($id => array('selected' => true))));
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $fri = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $employee->emp_id, 'day' => 'Friday'));
                                            $id = count($fri) > 0 ? $fri->ref_shift_id : 0;
                                            echo Chtml::dropDownList('fri_' . $employee->emp_id, "", CHtml::listData(Rostershift::model()->findAll(), 'shift_id', 'shift_title'), array('empty' => '-', 'class' => 'form-control', 'options' => array($id => array('selected' => true))));
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $sat = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $employee->emp_id, 'day' => 'Saturday'));
                                            $id = count($sat) > 0 ? $sat->ref_shift_id : 0;
                                            echo Chtml::dropDownList('sat_' . $employee->emp_id, "", CHtml::listData(Rostershift::model()->findAll(), 'shift_id', 'shift_title'), array('empty' => '-', 'class' => 'form-control', 'options' => array($id => array('selected' => true))));
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $sun = ShiftsForGeneralShiftEmployees::model()->findByAttributes(array('ref_emp_id' => $employee->emp_id, 'day' => 'Sunday'));
                                            $id = count($sun) > 0 ? $sun->ref_shift_id : 0;
                                            echo Chtml::dropDownList('sun_' . $employee->emp_id, "", CHtml::listData(Rostershift::model()->findAll(), 'shift_id', 'shift_title'), array('empty' => '-', 'class' => 'form-control', 'options' => array($id => array('selected' => true))));
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-warning" onclick="saveEmpShifts()">Save Employee Shifts</button>

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
    function saveEmpShifts() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/employee/SaveShiftsOfGSEmployees'; ?>",
            data: $('#shiftAllocate').serialize(),
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {

                }
            }
        });
    }
</script>