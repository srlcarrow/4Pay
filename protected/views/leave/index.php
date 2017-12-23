<?php
// Calender
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/calender/calender.css', 'screen');
?>

<div class="row mb-30">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <h1>Leave</h1>
            </div>

            <div class="card-content">
                <div class="row">
                    <div class="col-md-4">

                        <div class="row form-wrapper">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Leave Type</label>
                                    <select id="" class="form-control">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row form-wrapper">
                            <div class="col-md-12 form-group">
                                <label for="">Purpose</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row form-wrapper">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Attachment</label>
                                    <input type="file" id="">
                                </div>
                            </div>
                        </div>

                        <div class="row form-wrapper">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Cover Up</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12 mt-20 text-right">
                                <button type="button" class="btn btn-default">Next</button>
                                <button type="button" class="btn btn-default">Prev</button>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="calender-wrapper">

                                </div>
                            </div>

                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">

                    <div class="col-md-12">
                        <div class="alert alert-success">Save Success</div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-default">Clear</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>