<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8">
    <title>Weir | List Survey</title>

    <link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/form/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form/waves.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/feather.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/themify-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/icofont.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/font-awesome.min.css')}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/datatables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/buttons.datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/responsive.bootstrap4.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/jquery.steps.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/pages.css')}}">

    <style>
      #fix-header{
        font-size:13px;
      }
    </style>
  

</head>

<body >
    
    @yield('content')
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
     <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
          <!-- nav -->
            @include('menu.headLogin')
          <!-- nav -->
            <div class="pcoded-main-container">
              <div class="pcoded-wrapper">
                <!-- menubar -->
                  @include('menu.menubar')
                <!--menubar  -->
                  <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                      <div class="main-body">
                        <div class="page-wrapper">
                          <div class="page-body">
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="card">
                                  <!-- header -->
                                    <div class="card-header">
                                      <h5>ข้อมูลสภาพฝายที่ได้รับการตรวจสอบ</h5>
                                    </div>
                                    <!-- form -->
                                    <div class="card-block">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div id="wizarda">
                                            <section>
                                              <div class="card">
                                                <div class="card-block">
                                                  <div class="row">
                                                    <div class="col-lg-12 col-xl-12">
                                                        <div class="tab-content tabs card-block">
                                                          <div class="tab-pane active" id="home1" role="tabpanel">
                                                            <div class="pcoded-inner-content">
                                                               <div class="main-body">
                                                                <div class="page-wrapper">
                                                                  <div class="page-body">
                                                                    <div class="dt-responsive table-responsive">
                                                                      <table id="fix-header" class="table table-striped table-bordered nowrap">
                                                                        <thead>
                                                                          <tr>
                                                                            <th>#</th>
                                                                            <th>รหัส</th>
                                                                            <th>ชื่อฝาย/ลำน้ำ</th>
                                                                            <th>หมู่บ้าน</th>
                                                                            <th>ตำบล</th>
                                                                            <th>อำเภอ</th>
                                                                            <th></th>
                                                                          </tr>
                                                                         </thead>
                                                                        <tbody>
                                                                          <?php for($i = 0;$i < count($dataUser);$i++){  ?>
                                                                            <tr>
                                                                              <td align="center">{{$i+1}} </td>
                                                                              <td>{{$dataUser[$i]['weir_code']}}</td>
                                                                              <td>{{$dataUser[$i]['weir_name']}}/{{$dataUser[$i]['river']}} </td>
                                                                              <td>{{$dataUser[$i]['weir_village']}}  </td>
                                                                              <td>{{$dataUser[$i]['weir_tumbol']}}  </td>
                                                                              <td>{{$dataUser[$i]['weir_district']}}  </td>
                                                                              
                                                                              <td align="center"> 
                                                                              <a href='{{ asset('/pdf') }}/{{$dataUser[$i]['weir_code']}}' target=_blank ><button class="btn waves-effect waves-dark btn-mini btn-info btn-outline-info" title="รายงานการตรวจสอบสภาพฝาย"><i class="icofont icofont-eye-alt"></i></button></a>
                                                                                <a href='' target=_blank ><button class="btn waves-effect waves-dark btn-mini btn-info btn-outline-info" title="รายงานสภาพฝาย"><i class="fa fa-sticky-note-o"></i></button></a>
                                                                                <a href='' target=_blank><button class="btn waves-effect waves-dark btn-mini btn-info btn-outline-info" title="แนวทางการแก้ไขปัญหา"><i class="fa fa-pencil"></i></button> </a>
                                                                                <a href='' target=_blank><button class="btn waves-effect waves-dark btn-mini btn-info btn-outline-info" title="โหลดรูปแผนที่"><i class="fa fa-image"></i></button> </a>
                                                                                <a href='' target=_blank><button class="btn waves-effect waves-dark btn-mini btn-info btn-outline-info" title="เลือกรูปภาพ"><i class="fa fa-file-image-o"></i></button></a>
                                                                              </td>
                                                                            </tr>
                                                                          <?php } ?>                                              
                                                                                                                                        
                                                                        </tbody>
                                                                      </table>
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
                                            </section>
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


    <script>
      function myFunction() {
        confirm("คุณต้องการลบข้อมูลฝายใช่ไหม?");
      }
    </script>

    <script src="{{ asset('js/form/jquery.min.js')}}"></script>
    <script src="{{ asset('js/form/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('js/form/popper.min.js')}}"></script>
    <script src="{{ asset('js/form/bootstrap.min.js')}}"></script>

    <script src="{{ asset('js/form/waves.min.js')}}" ></script>

    <script src="{{ asset('js/form/jquery.slimscroll.js')}}"></script>

    <script src="{{ asset('js/form/modernizr.js')}}"></script>
    <script src="{{ asset('js/form/css-scrollbars.js')}}"></script>

    <script src="{{ asset('js/form/jquery.datatables2.min.js')}}" ></script>
    <script src="{{ asset('js/form/datatables.buttons.min.js')}}" ></script>
    <script src="{{ asset('js/form/jszip.min.js')}}" ></script>
    <script src="{{ asset('js/form/pdfmake.min.js')}}" ></script>
    <script src="{{ asset('js/form/vfs_fonts.js')}}" ></script>
    <script src="{{ asset('js/form/datatables.fixedheader.min.js')}}"></script>

    <script src="{{ asset('js/form/datatables.colreorder.min.js')}}" ></script>
    <script src="{{ asset('js/form/buttons.print.min.js')}}" ></script>
    <script src="{{ asset('js/form/datatables.bootstrap4.min.js')}}" ></script>
    <script src="{{ asset('js/form/datatables.responsive.min.js')}}" ></script>
    <script src="{{ asset('js/form/responsive.bootstrap4.min.js')}}"></script>

    <script src= "{{ asset('js/form/fixed-header-custom.js') }}"></script>

    <script src= "{{ asset('js/form/pcoded.min.js') }}"></script>
    <script src= "{{ asset('js/form/vertical-layout.min.js') }}"></script>
    <script src= "{{ asset('js/form/jquery.mcustomscrollbar.concat.min.js') }}"></script>

    <script src= "{{ asset('js/form/script.js') }}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" ></script>
  
    <script src="{{ asset('js/form/rocket-loader.min.js')}}" data-cf-settings="ce2668daaac54a74e9f6cdff-|49" defer=""></script>



    

</body>

</html>
