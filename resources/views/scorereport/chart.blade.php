<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8">
<title>Phrae Weir </title>

<link rel="icon" href="{{ asset('images/icon/favicon1.ico')}}" type="image/x-icon">
<link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{ asset('css/form/feather.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/form/themify-icons.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/form/icofont.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/form/font-awesome.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/form/datatables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/form/buttons.datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/form/responsive.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{ asset('css/form/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/form/waves.min.css')}}" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="{{ asset('css/form/jquery.steps.css')}}">
<link rel="stylesheet" href="{{ asset('css/form/feather.css')}}">
<link rel="stylesheet" href="{{ asset('css/form/style1.css')}}">


<style type="text/css">
    select {
        width: 100%;
        height: 40px;
    }

    button.btn {
        width: 100%;
    }

    @media only screen and (max-width:480px) {
        #map {
            height: 450px;
            font-size: 14px;
        }

        table {
            font-size: 2vw;
        }

        select {
            width: 100%;
            height: 40px;
        }

        button.btn {
            width: 100%;
        }

        .btn-sm {
            font-size: 2vw;
        }
    }

    #fix-header {
        font-size: 16px;
    }

    th {
        text-align: center;
    }

    .btn {
        padding: 2px 12px;
    }
</style>
<!-- Styles -->
<style>
    html,
    body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Mitr', sans-serif;

    }

    .position-ref {
        position: relative;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .content {
        text-align: left;

    }

    .title {
        font-size: 16px;
    }

    .links>a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>

<style type="text/css">
    .box {
        color: #fff;
        padding: 20px;
        display: none;
        margin-top: 20px;
        width: 100%;
    }

    .river {
        background: #fff;
    }

    .land {
        background: #fff;
        color: #fff;
    }

    .bld {}

    .sketch {}
</style>


</head>

<body class="horizontal-icon-fixed">
    <script type="text/javascript">
        function test(this) {
            this.selected = selected;
        }
    </script>
    @yield('content')
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>

        <div class="pcoded-container navbar-wrapper">
            @include('menu.header')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    @include('menu.slidebar')
                    <!-- Map -->
                    <div class="pcoded-content">
                        <div class="card">
                            <h3></h3>
                        </div>
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card table-card">
                                                <div class="card-header">
                                                    <h3>กราฟแสดงสัดส่วนของฝายจำแนกตามสภาพฝาย</h3>
                                                    <hr>
                                                </div>
                                                <div class="card-header">
                                                    <div class="content">
                                                        <div class="row justify-content-end">
                                                            <div class="col-lg-4 col-md-12">
                                                                <div class="card text-white card-inverse">
                                                                    <form id="amp" name="amp" action="" method="get">
                                                                        <table class="table-name" width=80% align=center style="margin-bottom:20px;margin-top:20px;">
                                                                            <tr>
                                                                                <td align="right">อำเภอ :</td>
                                                                                <td>
                                                                                    <select name="amp" class="selectpicker " id="district" onchange="this.form.submit();">
                                                                                        <option value="">-- เลือกอำเภอ --</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <!-- sale revenue card start -->
                                                            <div class="col-md-12 col-xl-8">
                                                                <div class="card sale-card">
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-12 text-center">
                                                                            <h2> กราฟแสดงสัดส่วนของสภาพฝาย </h2>
                                                                            <h2> {{$amp_name}} </h2><br><br>
                                                                            <div id="container" width=100%></div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="row justify-content-center" style="background-color:#fff; ">
                                                                        <div class="col-md-12 text-center" style="background-color:#fff; margin-bottom:130px;margin-top:50px;">
                                                                            <h2> องค์ประกอบของฝายจำแนกตามสภาพฝาย </h2>
                                                                            <h2> {{$amp_name}} </h2><br><br>
                                                                            <div id="conBar"></div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-xl-4">
                                                                <div class="card comp-card">
                                                                    <div class="card-body">
                                                                        <div class="dt-responsive table-responsive">
                                                                            <h6> ข้อมูลจำนวนฝายจำแนกตามสภาพ </h6>
                                                                            <hr>
                                                                            <table class="table table-striped table-bordered first" width=80%>
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th colspan="4">สภาพฝาย ( จำนวนทั้งหมด {{$result[0]['score_N']+$result[0]['score_O']+$result[0]['score_R']}} ฝาย )</th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>ใช้งานได้ดี</th>
                                                                                        <th>ปานกลาง </th>
                                                                                        <th>ทรุดโทรม </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" width=20%>{{$result[0]['score_N']}} <br> ( {{$result[0]['scoreper_N']}} %)</td>
                                                                                        <td align="center" width=20%>{{$result[0]['score_O']}} <br> ( {{$result[0]['scoreper_O']}} %)</td>
                                                                                        <td align="center" width=20%>{{$result[0]['score_R']}} <br> ( {{$result[0]['scoreper_R']}} %)</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>

                                                                            <table class="table table-striped table-bordered first" width=80%>
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th rowspan="2">องค์ประกอบของฝาย</th>
                                                                                        <th colspan="4">สภาพฝาย </th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>ใช้งานได้ดี</th>
                                                                                        <th>ปานกลาง </th>
                                                                                        <th>ทรุดโทรม </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php for ($i = 1; $i < 7; $i++) { ?>
                                                                                        <tr>
                                                                                            <td>{{$head[$i]}}</td>
                                                                                            <td align="center" width=20%>{{$e[0][$i]}}</td>
                                                                                            <td align="center" width=20%>{{$e[1][$i]}}</td>
                                                                                            <td align="center" width=20%>{{$e[2][$i]}}</td>
                                                                                        </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>

                                                                        </div>
                                                                        <div class="card comp-card">
                                                                            <div class="card-body">
                                                                                <div class="row align-items-center">
                                                                                    <div class="col">
                                                                                        <b> สภาพฝายแบ่งออกเป็น 3 ระดับ </b> <br>
                                                                                        - ใช้งานได้ดี <br>
                                                                                        - ปานกลาง ควรซ่อมแซมปรับปรุง <br>
                                                                                        - ทรุดโทรม ควรรื้อถอน/ก่อสร้างใหม่ <br>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('menu.foot')
                </div>

            </div>

        </div>
    </div>


    <script src="{{ asset('js/form/jquery.min.js')}}"></script>
    <script src="{{ asset('js/form/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('js/form/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/form/jquery-i18next.min.js')}}"></script>
    <script src="{{ asset('js/form/pcoded.min.js')}}"></script>
    <script src="{{ asset('js/form/menu-hori-fixed.js')}}"></script>
    <script src="{{ asset('js/form/jquery.mcustomscrollbar.concat.min.js')}}"></script>
    <script src="{{ asset('js/form/script.js')}}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>

    <script src="{{ asset('js/location_home.js') }}"></script>
    <script src="{{ asset('js/form/rocket-loader.min.js')}}"></script>

    <script src="{{ asset('js/form/jquery.datatables.min.js')}}"></script>
    <script src="{{ asset('js/form/datatables.buttons.min.js')}}"></script>

    <script src="{{ asset('js/form/datatables.fixedheader.min.js')}}"></script>

    <script src="{{ asset('js/form/datatables.colreorder.min.js')}}"></script>
    <script src="{{ asset('js/form/buttons.print.min.js')}}"></script>
    <script src="{{ asset('js/form/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('js/form/datatables.responsive.min.js')}}"></script>
    <script src="{{ asset('js/form/responsive.bootstrap4.min.js')}}"></script>

    <script src="{{ asset('js/form/fixed-header-custom.js') }}"></script>

    <script src="{{ asset('js/form/pcoded.min.js') }}"></script>
    <script src="{{ asset('js/form/jquery.mcustomscrollbar.concat.min.js') }}"></script>

    <script src="{{ asset('js/form/script.js') }}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>

    <script src="{{ asset('js/form/rocket-loader.min.js')}}" data-cf-settings="ce2668daaac54a74e9f6cdff-|49" defer=""></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script type="text/javascript">
        // var pieColors = (function() {
        //     var colors = [],
        //         base = Highcharts.getOptions().colors[0],
        //         i;

        //     for (i = 0; i < 10; i += 1) {
        //         colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
        //     }
        //     return colors;
        // }());

        var users = <?php echo (json_encode($countNum)) ?>;
        // alert (users);
        Highcharts.chart('container', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0
                },
                style: {
                        fontFamily: 'Mitr|Prompt'
                }
            },
            title: {
                text: ''
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {

                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    // colors: pieColors,
                    colorByPoint: true,
                    depth: 45,
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b><br>{point.percentage:.1f} %',

                    }
                }

            },
            credits: {
                enabled: false
            },
            colors: [
                '#0aa34f',
                '#f4891e',
                '#7e0123'
            ],
            series: [{
                type: 'pie',
                name: '',
                data: users
            }]

        });

        // bar 
        var users = <?php echo json_encode($countBar) ?>;
        // alert (users);
        Highcharts.chart('conBar', {
            chart: {
                type: 'column',
                style: {
                    fontFamily: 'Mitr|Prompt'
                },
                options3d: {
                    enabled: true,
                    alpha: 10,
                    beta: 0,
                    depth: 100,
                    viewDistance: 25
                }
            },
            title: {
                text: ''
            },

            xAxis: {
                categories: <?php echo json_encode($head1) ?>,
                style: {
                    fontSize: '16px',
                    fontFamily: 'Mitr|Prompt'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'จำนวนฝาย'
                }
            },

            credits: {
                enabled: false
            },
            colors: [
                '#0aa34f',
                '#f5ee41',
                '#f4891e',
                '#7e0123'
            ],
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontSize: '16px',
                            fontFamily: 'Mitr|Prompt'
                        }
                    },
                    enableMouseTracking: false
                }
            },
            series: users,
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    </script>

</body>

</html>