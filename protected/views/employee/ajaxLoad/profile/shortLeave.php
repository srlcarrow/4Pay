<div class="card flat mt-30">
    <div class="card-content">
        <div class="row">


            <div class="row form-wrapper">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Purpose</label>
                        <input type="text" name="purpose" value="" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-4 ">
                    <div class="form-group">
                        <label>Short Leave Date</label>
                        <?php $currentDate = Controller::getCountryDate(); ?>
                        <input type="text" name="shtLvDate" value="<?php echo $currentDate; ?>" class="input-datepicker form-control required">
                    </div>
                </div>
            </div>

            <div class="row form-wrapper"> 
                <div class="col-lg-4 input-layout">
                    <div class="form-group">
                        <label>Duration</label>                               
                        <select name="noOfLeaves" id="noOfLeaves" onchange="selectNoLeaves()" class="form-control required" required>
                            <option value=""></option> 
                            <option value="">30 mins</option> 
                            <option value="">60 mins</option> 
                            <option value="">90 mins</option> 
                            <option value="">120 mins</option> 
                        </select>
                    </div>                  
                </div>

                <div class="col-md-4 ">
                    <div class="form-group">
                        <label>Start Time</label>
                        <input type="text" name="startTime" id="startTime" value="" class="input-timepicker  form-control required">                            
                    </div>
                </div>

                <div class="col-md-4 ">
                    <div class="form-group">
                        <label>End Time</label>
                        <input type="text" name="endTime" id="endTime" value="" class="form-control"> 
                        <input name="endDateTime" id="endDateTime" type="hidden">
                    </div>
                </div>
            </div>
            <div class="col-md-4 no-select loadAjaxDate">

            </div>

            <div class="col-md-12 text-right">
                <button class="btn btn-primary btnSave">Apply</button>
            </div>

        </div>
    </div>
</div>


