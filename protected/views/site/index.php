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
                                        <span><?php echo $totEmployees; ?></span>
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
                                <h4 class="text-black"><?php echo $totMale; ?></h4>
                                <h6 class="text-black lighten-3">Male</h6>
                            </div>
                            <div class="col-md-6">
                                <h4 class="text-black"><?php echo $totFemale; ?></h4>
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
                        <h5 class=" mb-15">Leave Amounts</h5>
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

    //var _sliderResigned;
    var pieEmployment = null,
            pieEpfEtp = null;

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
        var restData = [];
        fetch({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Site/GetDashboardAttendanceData'; ?>",
            data: "",
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    restData = responce.data;
                }
            }
        });

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
                colors: ['#0288d1', '#0F9D58'],
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

</script>


<script>
    //Pie Chart for Emp Type
    function pieEmpType() {

        var data = [
            {label: 'Leave 18%', value: 120, color: '#6ecce0'},
            {label: 'Absent 12%', value: 12, color: '#168ca8'},
            {label: "Short Leave 50%", value: 50, color: '#f9d452'}
        ];
        pieEmployment = createPieChartEmp('pieEmployment', data);
    }

    //Pie Chart for EPF
    function pieETF() {

        var data = [
            {label: 'Male 58%', value: 123, color: '#37BBC8'},
            {label: 'Female 42%', value: 102, color: '#F5B1C6'}
        ];
        pieEpfEtp = createPieChartEPFAndETF('pieEPF_ETF', data);
    }

    function OTHours() {
        var data = [
            {
                "label": "Early Leave",
                "value": 50,
                "color": "#ff5b2c"
            },
            {
                "label": "Late Amount",
                "value": 180,
                "color": "#ffc62c"
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

    $(document).ready(function () {
        attendanceChart();
        pieEmpType();
        pieETF();
        OTHours();

    });
</script>
