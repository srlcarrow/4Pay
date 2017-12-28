<?php
//==============================================================================
//      Plugins CSS
//==============================================================================
// mScroll Bar
//Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '', 'screen');
// Owl
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/js/plugins/owl_carousel/owl.carousel.css', 'screen');


//==============================================================================
//      CSS
//==============================================================================
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/dashboard/dashboard.css', 'screen');


//==============================================================================
//      JS
//==============================================================================
//==============================================================================
//      Plugins JS
//==============================================================================
// Jquery
//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery-3.2.0.min.js', CClientScript::POS_HEAD);
//Loadash
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/lib/lodash.js', CClientScript::POS_HEAD);
// Owl
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/owl_carousel/owl.carousel.min.js', CClientScript::POS_HEAD);
//d3
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/d3/d3.min.js', CClientScript::POS_HEAD);
//d3pie lib
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/d3/d3pie.min.js', CClientScript::POS_HEAD);
//google chart
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/googleChart/google.chart.js', CClientScript::POS_HEAD);
//Chart js
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/chart/ChartJs.js', CClientScript::POS_HEAD);
//Pie Chart.js
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/pieChart/pie-chart.js', CClientScript::POS_HEAD);

?>


<div class="row mt-30">

    <div class="col-md-4">
        <div class="card">
            <div class="card-content">
                <h5 class="details mb-15">Leave</h5>
                <div class="leave-slider">
                    <div class="levs-wrp">
                        <div>
                            <div class="lev-cal">
                                <span>18</span>
                                <span>-</span>
                                <span>10</span>
                                <span>=</span>
                            </div>
                            <h6 class="title">Annual Leave</h6>
                        </div>
                        <div class="pl-15">
                            <span class="lev-bal">8</span>
                        </div>

                    </div>
                </div>
                <div class="slide-action"></div>

                <button class="but new btn-add-new" type="button"><span></span></button>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-content">
                <h5 class="details mb-15">Male / Female Ratio</h5>

                <div class="ds-table-block icon-wrap">
                    <div class="cell">
                        <span class="ic-25 ic-male"></span>
                        <span class="val">60%</span>
                    </div>
                    <div class="cell text-right">
                        <span class="ic-25 ic-female"></span>
                        <span class="val">40%</span>
                    </div>
                </div>

                <div class="ds-table-block">
                    <div class="cm-progress-wrap">
                        <div class="cm-progress-bar">
                            <span class="blue" style="width: 60%"></span>
                        </div>
                    </div>
                </div>

                <div class="ds-table-block mt-5">
                    <div class="cell cell-50">
                        <h5 class="f-16 f-medium txt-dark-light">129</h5>
                    </div>
                    <div class="cell cell-50 text-right">
                        <h5 class="f-16 f-medium txt-dark-light">89</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-content">
                <h5 class="details mb-15">Attendance Count</h5>

                <div class="ds-table-block">
                    <div class="cm-pr-values">
                        <span class="total-emp">50000</span>
                        <span class="leave-absence text-right">(50&nbsp;+&nbsp;21)</span>
                    </div>
                    <div class="cm-progress-wrap mt-5">
                        <div class="cm-progress-bar blue">
                            <span class="red" style="width: 40%"></span>
                        </div>
                    </div>
                </div>
                <div class="ds-table-block mt-5">
                    <div class="cell cell-50">
                        <h6 class="title">No of Employees</h6>
                    </div>
                    <div class="cell cell-50 text-right">
                        <h6 class="title">( Leave 5% + Absence 1% )</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="details mb-15">Attendance</h5>
                    </div>
                    <div class="col-md-12">
                        <div id="attendance"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-content">
                <div class="col-md-12 line_tab_wrp dashboard-tab singleTab">
                    <ul class="line_tab half tab-capitalize">
                        <li class="active"><a class="f-14" href="#employment" data-callback-fn="pieEmpType">Employment
                                Type</a></li>
                        <li><a class="f-14" href="#employment" data-callback-fn="pieEmpCategory">Employment
                                Category</a></li>
                    </ul>
                    <div class="line_tab_content pt-20">
                        <div class="tab-items active" id="employment">
                            <div id="pieEmployment"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col-md-12 line_tab_wrp dashboard-tab singleTab">
                        <ul class="line_tab half tab-capitalize">
                            <li class="active"><a class="f-14" href="#epf_etf" data-callback-fn="pieETF">ETF
                                    Contribution</a></li>
                            <li><a class="f-14" href="#epf_etf" data-callback-fn="pieEPF">EPF Contribution</a></li>
                        </ul>
                        <div class="line_tab_content pt-20">
                            <div class="tab-items active" id="epf_etf">
                                <div class="pieChartWrp">

                                    <div class="innerCircle">
                                        <div class="text-wrapper">
                                            <h3>
                                                <span class="currency">Rs.</span>
                                                <span>1.3 M</span>
                                            </h3>
                                            <h6 class="total">Total</h6>
                                        </div>
                                    </div>

                                    <div id="pieEPF_ETF"></div>

                                    <div class="summery">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="text-blue f-18 f-medium">Rs. 1,560,000</h4>
                                                <h6 class="title mt-2">Employer 12%</h6>
                                            </div>
                                            <div class="col-md-6 pl-30">
                                                <h4 class="text-green pl-20 f-18 f-medium">Rs. 56,000</h4>
                                                <h6 class="title pl-20 mt-2">Employee 8%</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="col-md-4">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="details mb-15">Payroll</h5>
                    </div>
                    <div class="col-md-4 col-md-offset-2">
                        <select name="" id="" class="sm-select">
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-20">
                    <div class="col-md-12 mb-10">
                        <div class="table-block rounded-50 bg-blue cell-width-100">
                            <div class="cell zero-width space-7">
                                <span class="user-icon"></span>
                            </div>
                            <div class="cell pl-10">
                                <h4 class="f-20 f-white mb-5">1684</h4>
                                <h6 class="f-12 f-white-56">No of persons</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-30 mb-30">
                        <h4 class="f-24 txt-dark up ">
                            <span>Rs.&nbsp;</span>
                            <span>1,560,000</span>
                            <span class="up-down"><i></i>20%</span>
                        </h4>
                        <h6 class="title mt-2">Net payroll value</h6>
                    </div>

                    <div class="col-md-12">
                        <h4 class="f-24 txt-dark down">
                            <span>Rs.&nbsp;</span>
                            <span>156,000</span>
                            <span class="up-down"><i></i>20%</span>
                        </h4>
                        <h6 class="title mt-2">Total OT pay</h6>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


<script>

    var _sliderResigned;
    var pieEmployment = null,
        pieEpfEtp = null;
    var grid = null;

    $(function () {

        //loadScrollForTurnover();
        //Tab
        //loadLineTab();
        //loadOnLineTab();
        // Sliders
        loadLeaveSlider();
        //loadRecruitSlider();
        //loadNewsSlider();
        //loadResignedSlider();
        //cmProgressBar();
    });

    function cmProgressBar() {
        $('.cm-progress-bar').each(function () {
            var val = /\d+/.exec($(this).find('span').attr('style'))[0];
            $(this).find('span').attr('style', '');
            $(this).find('span').animate({'width': val + '%'}, 200);
        })
    }


    function loadLeaveSlider() {
//        var owl = $('.leave-slider').owlCarousel({
//            stagePadding: 50,
//            margin: 5,
//            loop: true,
//            mouseDrag: false,
//            responsive: {
//                0: {
//                    items: 1
//                }
//            }
//        });
//        //Slide next
//        $('.slide-action').click(function () {
//            owl.trigger('next.owl.carousel');
//        })
    }



    function loadScrollForTurnover() {
        $(".scroll-turnover").mCustomScrollbar({
            theme: "dark-3",
            scrollbarPosition: "outside"
        });
    }

    //Employment Pie chart create
    function createPieChartEmp(ele, data) {
        $('#' + ele).html('');

        if (pieEmployment != null) {
            pieEmployment.destroy();
        }

        return new d3pie(ele, {
            "size": {
                "canvasHeight": 230,
                "canvasWidth": 300,
                "pieInnerRadius": "52%",
                "pieOuterRadius": "80%"
            },
            "data": {
                "sortOrder": "value-asc",
                "content": data
            },
            "labels": {
                "outer": {
                    "pieDistance": 10
                },
                "inner": {
                    "format": "none"
                },
                "mainLabel": {
                    "color": "#434749",
                    "font": "open sans"
                },
                "percentage": {
                    "color": "#ffffff",
                    "decimalPlaces": 0
                },
                "value": {
                    "color": "#adadad"
                },
                "lines": {
                    "enabled": true,
                    "style": "straight",
                    "color": "#dbdbdb"
                },
                "truncation": {
                    "enabled": true,
                    "truncateLength": 15
                }
            },
            "tooltips": {
                "enabled": true,
                "type": "placeholder",
                "string": "{label}: {value}, {percentage}%",
                "styles": {
                    "fadeInSpeed": 72,
                    "backgroundOpacity": 0.61
                }
            },
            "effects": {
                "pullOutSegmentOnClick": {
                    "speed": 400,
                    "size": 1
                },
                "highlightSegmentOnMouseover": false,
                "highlightLuminosity": 0.95
            }
        });
    }

    //EPF and ETP Pie chart create
    function createPieChartEPFAndETF(ele, data) {
        $('#' + ele).html('');

        if (pieEpfEtp != null) {
            pieEpfEtp.destroy();
        }

        return new d3pie(ele, {
            "size": {
                "canvasHeight": 190,
                "canvasWidth": 300,
                "pieInnerRadius": "75%",
                "pieOuterRadius": "100%"
            },
            "data": {
                "sortOrder": "value-asc",
                "content": data
            },
            "labels": {
                "outer": {
                    "format": "none",
                },
                "inner": {
                    "format": "none"
                },
                "lines": {
                    "enabled": false,
                    "style": "straight",
                    "color": "#dbdbdb"
                }
            },
            "tooltips": {
                "enabled": true,
                "type": "placeholder",
                "string": "{percentage}%",
                "styles": {
                    "fadeInSpeed": 72,
                    "backgroundOpacity": 0.61
                }
            },
            "effects": {
                "pullOutSegmentOnClick": {
                    "speed": 400,
                    "size": 8
                },
                "highlightSegmentOnMouseover": false,
                "highlightLuminosity": 0.95
            }
        });
    }


    //Attendance Chart
    function attendanceChart() {
        alert('as')
        var restData = [
            ['Borella', 100, 67],
            ['Colombo', 100, 30],
            ['Gampaha', 100, 50],
            ['Jaffna', 80, 70],
            ['Kurunegala', 90, 70],
            ['Nawala', 50, 30],
            ['Rathnapura', 80, 75],
            ['Rathnapura', 80, 75],
            ['Rathnapura', 80, 75]
        ];

        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(function () {
            var data = new google.visualization.DataTable();

            data.addColumn('string', 'Branch');
            data.addColumn('number', 'Employees');
            data.addColumn('number', 'Attendance');

            data.addRows(restData);

            var options = {
                animation: {
                    duration: 1000,
                    easing: 'out',
                    startup: true
                },
                width: 700,
                height: 250,
                colors: ['#168ca8', '#4fdb9b'],
                chartArea: {width: '90%', height: '84%'},
                theme: 'material',
                legend: {
                    position: 'top',
                    alignment: 'end'
                },
                textStyle: {color: 'rgba(67, 72, 73, 0.56)', fontSize: 12}
            };
            var table = new google.visualization.ColumnChart(document.getElementById('attendance'));

            table.draw(data, options);
        });


    }

    //Age Analysis


    function ageAnalysis2() {
        var data = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    data: [58, 59, 60, 62, 56, 55, 10],
                    label: "",
                    fill: true,
                    lineTension: 0.4,
                    backgroundColor: "rgba(73, 179, 204, 0.30)",
                    borderWidth: 2,
                    borderColor: "#49b3cc",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#fff",
                    pointBackgroundColor: "#49b3cc",
                    pointBorderWidth: 2,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#168ca8",
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    pointHitRadius: 5,
                    spanGaps: true,
                }
            ]
        };

        var ctx = $("#ageAnalysis");
        new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                legend: {display: false},
                scales: {
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false

                        },
                        scaleLabel: {
                            display: false
                        },
                        ticks: {
                            fontSize: 12,
                            fontColor: '#434849',
                            fontStyle: "normal",
                        }
                    }],
                    yAxes: [{
                        display: true,

                        gridLines: {
                            display: true,
                            drawBorder: false,
                            tickMarkLength: 0,
                            color: 'rgba(67, 72, 73, 0.10)',
                        },
                        scaleLabel: {
                            display: false
                        },
                        ticks: {
                            fontSize: 12,
                            fontColor: 'rgba(67, 72, 73, 0.56)',
                            fontStyle: "normal",
                            padding: 8
                        }
                    }]

                }

            }
        });
    }


</script>


<script>


    //Multi type tab load function
    function loadLineTab() {
        $('.line_tab').find('li a').click(function (evt) {

            evt.preventDefault();

            var hrefLink = $(this).attr('href');
            var parentTab = $(this).parents('.line_tab_wrp');

            if (parentTab.hasClass('singleTab'))
                return;

            if (!$(hrefLink).hasClass('active')) {
                parentTab.find('.line_tab li a').parent().removeClass('active');
                $(this).parent().addClass('active');
                var fn = $(this).attr('data-callback-fn');
                if (fn === 'fnEmpType') {
                    fnEmpType();
                } else if (fn === 'fnEmpCategory') {
                    fnEmpCategory();
                }
                parentTab.find('.tab-items').fadeTo('fast', 0, function () {
                    $(hrefLink).fadeTo('fast', 1).show().addClass('active');
                }).hide().removeClass('active');


            }

        });

    }



    //Pie Chart for Emp Type
    function pieEmpType() {

        var data = [
            {label: 'Permenent 18%', value: 50, color: '#6ecce0'},
            {label: 'Casual 12%', value: 120, color: '#168ca8'},
            {label: "Contract six month 50%", value: 60, color: '#f9d452'},
            {label: 'Casual 25%', value: 90, color: '#f26b55'},
            {label: 'Contract 5%', value: 30, color: '#434849'}
        ];
        pieEmployment = createPieChartEmp('pieEmployment', data);
    }

    //Pie Chart for Emp Category
    function pieEmpCategory() {

        var data = [
            {label: 'Permenent 18%', value: 120, color: '#6ecce0'},
            {label: 'Casual 12%', value: 80, color: '#168ca8'},
            {label: 'Contract six month 50%', value: 40, color: '#f9d452'},
            {label: 'Casual 25%', value: 50, color: '#f26b55'},
            {label: 'Contract 5%', value: 70, color: '#434849'}
        ];
        pieEmployment = createPieChartEmp('pieEmployment', data);
    }

    //Pie Chart for EPF
    function pieEPF() {

        var data = [
            {label: 'Permenent 18%', value: 120, color: '#4fdb9b'},
            {label: 'Casual 12%', value: 80, color: '#49b3cc'}
        ];
        pieEpfEtp = createPieChartEPFAndETF('pieEPF_ETF', data);
    }

    function pieETF() {

        var data = [
            {label: 'Permenent 18%', value: 120, color: '#4fdb9b'},
            {label: 'Casual 12%', value: 80, color: '#49b3cc'}
        ];
        pieEpfEtp = createPieChartEPFAndETF('pieEPF_ETF', data);
    }

    function OTHours() {
        var data = [
            {
                "label": "1256 Hrs",
                "value": 100,
                "color": "#168ca8"
            },
            {
                "label": "569 Hrs",
                "value": 80,
                "color": "#4fdb9b"
            },
            {
                "label": "2569 Hrs",
                "value": 120,
                "color": "#49b3cc"
            },
            {
                "label": "869 Hrs",
                "value": 160,
                "color": "#f9d452"
            }
        ];

        new d3pie('ot-hours', {
            "size": {
                "canvasHeight": 250,
                "canvasWidth": 215,
                "pieOuterRadius": "100%"
            },
            "data": {
                "smallSegmentGrouping": {
                    "enabled": true,
                    "value": 0,
                    "label": ""
                },
                "content": data
            },
            "labels": {
                "outer": {
                    "format": "none",
                    "pieDistance": 0
                },
                "inner": {
                    "format": "label",
                    "hideWhenLessThanPercentage": 1
                },
                "mainLabel": {
                    "color": "#ffffff"
                },
                "percentage": {
                    "color": "#ffffff",
                    "decimalPlaces": 20
                },
                "value": {
                    "color": "#ffffff",
                    "fontSize": 0
                }
            },
            "tooltips": {
                "enabled": true,
                "type": "placeholder",
                "string": "{value}",
                "styles": {
                    "fadeInSpeed": 272,
                    "backgroundOpacity": 0.7,
                    "color": "#ffffff"
                }
            },
            "effects": {
                "pullOutSegmentOnClick": {
                    "effect": "linear",
                    "speed": 400,
                    "size": 8
                },
                "highlightSegmentOnMouseover": false,
                "highlightLuminosity": 0.13
            }
        });
    }

    //On load fun
    OTHours();
    pieEmpType();
    pieETF();
    attendanceChart();
    turnoverProgress();
    //    ageAnalysis();
    ageAnalysis2();
</script>
