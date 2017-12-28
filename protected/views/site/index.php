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

    <div class="col-md-12 mb-30">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class=" mb-15">Attendance</h5>
                    </div>
                    <div class="col-md-12">
                        <div id="attendance"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-30">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class=" mb-15">Leave</h5>
                    </div>
                    <div class="col-md-12">
                        <div id="pieEmployment"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="text-black">123</h4>
                                <h6 class="text-black lighten-3">Leave</h6>
                            </div>
                            <div class="col-md-4">
                                <h4 class="text-black">12</h4>
                                <h6 class="text-black lighten-3">Absent</h6>
                            </div>
                            <div class="col-md-4">
                                <h4 class="text-black">50</h4>
                                <h6 class="text-black lighten-3">Short Leave</h6>
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
                    <div class="col-md-12">
                        <h5 class=" mb-15">Employee</h5>
                    </div>
                    <div class="col-md-12">
                        <div class="pieChartWrp">

                            <div class="innerCircle">
                                <div class="text-wrapper">
                                    <h3>
                                        <span>225</span>
                                    </h3>
                                    <h6 class="total">Total</h6>
                                </div>
                            </div>

                            <div id="pieEPF_ETF"></div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-10">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-black">123</h4>
                                <h6 class="text-black lighten-3">Male</h6>
                            </div>
                            <div class="col-md-6">
                                <h4 class="text-black">102</h4>
                                <h6 class="text-black lighten-3">Female</h6>
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
                    <div class="col-md-12">
                        <h5 class=" mb-15">Lorem ipsum</h5>
                    </div>
                    <div class="col-md-12 text-center">
                        <div id="ot-hours"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-black">180</h4>
                                <h6 class="text-black lighten-3">Late Amount</h6>
                            </div>
                            <div class="col-md-6">
                                <h4 class="text-black">50</h4>
                                <h6 class="text-black lighten-3">Early Leave</h6>
                            </div>
                        </div>
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
                "canvasHeight": 220,
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
                width: '100%',
                height: 350,
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
            {label: 'Leave 18%', value: 120, color: '#6ecce0'},
            {label: 'Absent 12%', value: 12, color: '#168ca8'},
            {label: "Short Leave 50%", value: 50, color: '#f9d452'}
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
    function pieETF() {

        var data = [
            {label: 'Male 58%', value: 123, color: '#4fdb9b'},
            {label: 'Female 42%', value: 102, color: '#49b3cc'}
        ];
        pieEpfEtp = createPieChartEPFAndETF('pieEPF_ETF', data);
    }

    function OTHours() {
        var data = [
            {
                "label": "Early Leave",
                "value": 50,
                "color": "#168ca8"
            },
            {
                "label": "Late Amount",
                "value": 180,
                "color": "#4fdb9b"
            }
        ];

        new d3pie('ot-hours', {
            "size": {
                "canvasHeight": 230,
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
