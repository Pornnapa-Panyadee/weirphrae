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
    <link rel="stylesheet" href="{{ asset('css/form/pages.css')}}">
    <link rel="stylesheet" href="{{ asset('css/form/style1.css')}}">
    
  </head>

  <body class="horizontal-icon-fixed" >
    @yield('content')
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded" >
      <div class="pcoded-overlay-box"></div>
      
      <div class="pcoded-container navbar-wrapper">
        @include('menu.header')

        <div class="pcoded-main-container">
          <div class="pcoded-wrapper">
             @include('menu.slidebar')
            <!-- Map -->
            <div class="pcoded-content">
              <div class="card"><h3></h3></div>
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <div class="row justify-content-md-center">
                                <div class="col-md-12">
                                    <div class="card table-card">
                                        <div class="card-header">
                                        <h2>โครงการปรับปรุงฝายในพื้นที่นำร่อง</h2>     
                                        <hr> 
                                        <div class="page-header-breadcrumb">
                                          <ul class="breadcrumb">
                                              <li class="breadcrumb-item"> <a href="/"><i class="icofont icofont-home"></i> </a> </li>
                                              <li class="breadcrumb-item"><a href="/project">โครงการนำร่อง</a> </li>
                                              <li class="breadcrumb-item"><a href="#!">โครงการที่ {{$id}}</a></li>
                                          </ul>
                                        </div>                        
                                        </div>
                                        <div class="row justify-content-center">
                                          <div class="col-sm-11">
                                            <div class="card">
                                              <div class="card-block">
                                                  <div class="row" id="draggablePanelList">
                                                      <div class="col-lg-12 col-xl-9">
                                                        <div class="card-sub">
                                                           <img class="card-img-top img-fluid" src="{{ asset($cover) }}">
                                                        </div>
                                                      </div>
                                                      <div class="col-lg-12 col-xl-3">
                                                        <!-- <div class="row" >
                                                          <div class="col-lg-11 col-xl-12">
                                                            <div class="card-sub">
                                                              <img class="card-img-top img-fluid" src="{{ asset($survey) }}">
                                                              <div class="card-block">
                                                                <a href="{{ asset($survey_link)}}" target="_blank"> <h4 class="card-title">เอกสารแบบสำรวจรางวัด</h4></a>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div> -->
                                                        <br>
                                                        <div class="row" >
                                                          <div class="col-lg-11 col-xl-12">
                                                            <div class="card-sub">
                                                              <img class="card-img-top img-fluid" src="{{ asset($plan) }}">
                                                              <div class="card-block text-center">
                                                                <a href="{{ asset($plan_link)}}" target="_blank"> <h4 class="card-title">เอกสารแบบก่อสร้าง</h4> </a>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <br>
                                                        <div class="row" >
                                                          <div class="col-lg-11 col-xl-12">
                                                            <div class="card-sub">
                                                              <div class="card-block text-center">
                                                                <a href="{{ asset($BOQ_link)}}" target="_blank"> <h4 class="card-title">รายการปริมาณงานและวัสดุก่อสร้าง (Bill of Quantities : BOQ)</h4> </a>
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
          </div>
            @include('menu.foot')
          </div>
          
        </div>

      </div>
    </div>
    
    
    <script src="{{ asset('js/form/jquery.min.js')}}"></script>
    <script src="{{ asset('js/form/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('js/form/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/form/jquery-i18next.min.js')}}" ></script>
    <script src="{{ asset('js/form/pcoded.min.js')}}" ></script>
    <script src="{{ asset('js/form/menu-hori-fixed.js')}}" ></script>
    <script src="{{ asset('js/form/jquery.mcustomscrollbar.concat.min.js')}}" ></script>
    <script src="{{ asset('js/form/script.js')}}"></script>
   
  
    <script src="{{ asset('js/form/jquery.datatables.min.js')}}" ></script>
    <script src="{{ asset('js/form/datatables.buttons.min.js')}}" ></script>

    <script src="{{ asset('js/form/datatables.fixedheader.min.js')}}"></script>

    <script src="{{ asset('js/form/datatables.colreorder.min.js')}}" ></script>
    <script src="{{ asset('js/form/buttons.print.min.js')}}" ></script>
    <script src="{{ asset('js/form/datatables.bootstrap4.min.js')}}" ></script>
    <script src="{{ asset('js/form/datatables.responsive.min.js')}}" ></script>
    <script src="{{ asset('js/form/responsive.bootstrap4.min.js')}}"></script>

    <script src= "{{ asset('js/form/fixed-header-custom.js') }}"></script>

    <script src= "{{ asset('js/form/pcoded.min.js') }}"></script>
    <script src= "{{ asset('js/form/jquery.mcustomscrollbar.concat.min.js') }}"></script>

  
    <script src="{{ asset('js/form/rocket-loader.min.js')}}" data-cf-settings="ce2668daaac54a74e9f6cdff-|49" defer=""></script>

  
  </body>

</html>
