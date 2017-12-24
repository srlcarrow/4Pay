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
                                    <div class="dropdown_list">

                                        <div class="search-area">
                                            <input type="text" class="drop-input-search form-control">
                                        </div>

                                        <ul class="drop-result">
                                            <li data-id="42">
                                                <h5>Saman Kumara</h5>
                                                <h6>UI Design</h6>
                                            </li>
                                            <li data-id="45">
                                                <h5>Kasun Bandara</h5>
                                                <h6>UI Design</h6>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12 mb-10 text-right">
                                <button type="button" class="btn btn-default">Next</button>
                                <button type="button" class="btn btn-default">Prev</button>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="calender-wrapper" data-calender="1-2017">
                                    <div class="cln-per-header">
                                        <h4>Jan 2017</h4>
                                    </div>

                                    <div class="cln-header">
                                        <div class="day">Mo</div>
                                        <div class="day">Tu</div>
                                        <div class="day">We</div>
                                        <div class="day">Th</div>
                                        <div class="day">Fr</div>
                                        <div class="day">Sa</div>
                                        <div class="day">Su</div>
                                    </div>
                                    <div class="cln-date-container">
                                        <div class="date"><span>28</span></div>
                                        <div class="date"><span>29</span></div>
                                        <div class="date"><span>30</span></div>
                                        <div class="date"><span>31</span></div>
                                        <div class="date is-leave"><span>1</span></div>
                                        <div class="date is-leave"><span>2</span></div>
                                        <div class="date "><span>3</span></div>
                                        <div class="date"><span>4</span></div>
                                        <div class="date"><span>5</span></div>
                                        <div class="date"><span>6</span></div>
                                        <div class="date"><span>7</span></div>
                                        <div class="date"><span>8</span></div>
                                        <div class="date"><span>9</span></div>
                                        <div class="date"><span>10</span></div>
                                        <div class="date is-holiday"><span>11</span></div>
                                        <div class="date"><span>12</span></div>
                                        <div class="date"><span>13</span></div>
                                        <div class="date"><span>14</span></div>
                                        <div class="date"><span>15</span></div>
                                        <div class="date"><span>16</span></div>
                                        <div class="date"><span>17</span></div>
                                        <div class="date"><span>18</span></div>
                                        <div class="date"><span>19</span></div>
                                        <div class="date"><span>20</span></div>
                                        <div class="date"><span>21</span></div>
                                        <div class="date"><span>22</span></div>
                                        <div class="date"><span>23</span></div>
                                        <div class="date"><span>24</span></div>
                                        <div class="date"><span>25</span></div>
                                        <div class="date"><span>26</span></div>
                                        <div class="date"><span>27</span></div>
                                        <div class="date"><span>28</span></div>
                                        <div class="date"><span>29</span></div>
                                        <div class="date"><span>30</span></div>
                                        <div class="date"><span>31</span></div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="calender-wrapper" data-calender="2-2017">
                                    <div class="cln-per-header">
                                        <h4>Feb 2017</h4>
                                    </div>

                                    <div class="cln-header">
                                        <div class="day">Mo</div>
                                        <div class="day">Tu</div>
                                        <div class="day">We</div>
                                        <div class="day">Th</div>
                                        <div class="day">Fr</div>
                                        <div class="day">Sa</div>
                                        <div class="day">Su</div>
                                    </div>
                                    <div class="cln-date-container">
                                        <div class="date"><span>28</span></div>
                                        <div class="date"><span>29</span></div>
                                        <div class="date"><span>30</span></div>
                                        <div class="date"><span>31</span></div>
                                        <div class="date"><span>1</span></div>
                                        <div class="date"><span>2</span></div>
                                        <div class="date"><span>3</span></div>
                                        <div class="date"><span>4</span></div>
                                        <div class="date"><span>5</span></div>
                                        <div class="date"><span>6</span></div>
                                        <div class="date"><span>7</span></div>
                                        <div class="date"><span>8</span></div>
                                        <div class="date"><span>9</span></div>
                                        <div class="date"><span>10</span></div>
                                        <div class="date"><span>11</span></div>
                                        <div class="date"><span>12</span></div>
                                        <div class="date"><span>13</span></div>
                                        <div class="date"><span>14</span></div>
                                        <div class="date"><span>15</span></div>
                                        <div class="date"><span>16</span></div>
                                        <div class="date"><span>17</span></div>
                                        <div class="date"><span>18</span></div>
                                        <div class="date"><span>19</span></div>
                                        <div class="date"><span>20</span></div>
                                        <div class="date"><span>21</span></div>
                                        <div class="date"><span>22</span></div>
                                        <div class="date"><span>23</span></div>
                                        <div class="date"><span>24</span></div>
                                        <div class="date"><span>25</span></div>
                                        <div class="date"><span>26</span></div>
                                        <div class="date"><span>27</span></div>
                                        <div class="date"><span>28</span></div>
                                        <div class="date"><span>29</span></div>
                                        <div class="date"><span>30</span></div>
                                        <div class="date"><span>31</span></div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mt-30">
                            <div class="col-md-12">
                                <div class="row form-wrapper">
                                   <div class="col-md-4">
                                       <h5>Jan 3</h5>
                                   </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select id="" class="form-control">
                                                <option>Full Day</option>
                                                <option>Half Day</option>
                                                <option>Option 3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-wrapper">
                                    <div class="col-md-4">
                                        <h5>Jan 3</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select id="" class="form-control">
                                                <option>Full Day</option>
                                                <option>Half Day</option>
                                                <option>Option 3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                        <button type="button" class="btn btn-primary apply">Apply</button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script src="<?php echo Yii::app()->baseUrl ?>/js/plugins/selectable/selectable.js"></script>

<script>

    $('.cln-date-container').Selectable();

    function getCalenderSelectDate() {
        var result = [];
        $('.calender-wrapper').each(function () {
            var $this = $(this);
            var calender = $this.data('calender');
            var dates = [];

            $this.find('.date.is-selected:not(.is-leave,.is-holiday)').each(function () {
                var $date = $(this);
                var dateVal = $date.find('span').text();
                dates.push(dateVal);
            });

            result.push({
                calender: calender,
                date: dates
            });
        });

        return result;
    }

    $('.apply').on('click', function () {

        var selectedDate = getCalenderSelectDate();
        console.log(selectedDate);
        console.log(JSON.stringify(selectedDate));
    });

    //Fire On Cover up selected
    $(document).on('onDropItemClick', function (e, selectId, selectElemen) {
        console.log(selectId, selectElemen)
    })

</script>