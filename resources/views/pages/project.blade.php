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

<link rel="stylesheet" href="{{ asset('css/form/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/form/waves.min.css')}}" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="{{ asset('css/form/jquery.steps.css')}}">
<link rel="stylesheet" href="{{ asset('css/form/feather.css')}}">
<link rel="stylesheet" href="{{ asset('css/form/pages.css')}}">
<link rel="stylesheet" href="{{ asset('css/form/style1.css')}}">



</head>

<body class="horizontal-icon-fixed">
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
                                                    <h3>โครงการปรับปรุงฝายในพื้นที่นำร่อง</h3>
                                                    <hr>
                                                </div>
                                                <div class="card-header">
                                                    <div class="row justify-content-center">
                                                        <div class="col-sm-11">
                                                            <!-- Draggable default card start -->
                                                            <div class="card">
                                                                <div class="card-block">
                                                                    <div class="row" id="draggablePanelList">

                                                                        <!-- <div class="col-lg-12 col-xl-3">
                                                                            <div class="card-sub">
                                                                                <img class="card-img-top img-fluid" src="{{ asset('images/project/proj01.png') }}">
                                                                                <div class="card-block">
                                                                                    <a href="{{ asset('/project/1')}}">
                                                                                        <h4 class="card-title">โครงการที่1 ฝายร่องเปา </h4>
                                                                                        <p class="card-text">ตำบลป่าแงะ อำเภอป่าแดด </p>
                                                                                    </a>
                                                                                </div>
                                                                            </div>

                                                                        </div> -->
                                                                        <!--  -->
                                                                        <!-- <div class="col-lg-12 col-xl-3">
                                                                            <div class="card-sub">
                                                                                <img class="card-img-top img-fluid" src="{{ asset('images/project/proj02.png') }}">
                                                                                <div class="card-block">
                                                                                    <a href="{{ asset('/project/2')}}">
                                                                                        <h4 class="card-title">โครงการที่2 ฝายแม่ยาว</h4>
                                                                                        <p class="card-text">ตำบลแม่ยาว อำเภอเมืองเชียงราย </p>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div> -->
                                                                        <!--  -->
                                                                        <!-- <div class="col-lg-12 col-xl-3">
                                                                            <div class="card-sub">
                                                                                <img class="card-img-top img-fluid" src="{{ asset('images/project/proj03.png') }}">
                                                                                <div class="card-block">
                                                                                    <a href="{{ asset('/project/3')}}">
                                                                                        <h4 class="card-title">โครงการที่3 ฝายน้ำงาม </h4>
                                                                                        <p class="card-text"> ตำบลบ้านดู่ อำเภอเมืองเชียงราย </p>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div> -->
                                                                        <!--  -->
                                                                        <!-- <div class="col-lg-12 col-xl-3">
                                                                            <div class="card-sub">
                                                                                <img class="card-img-top img-fluid" src="{{ asset('images/project/proj04.png') }}">
                                                                                <div class="card-block">
                                                                                    <a href="{{ asset('/project/4')}}">
                                                                                        <h4 class="card-title">โครงการที่4 ฝายน้ำต๊าก </h4>
                                                                                        <p class="card-text">ตำบลแม่เปา อำเภอพญาเม็งราย </p>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div> -->
                                                                    </div>
                                                                    <Br>
                                                                    
                                                                </div>
                                                            </div>
                                                            <!-- Draggable default card start -->
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

    <script src="{{ asset('js/chooselocationHome.js')}}"></script>
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


</body>

</html>