<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8">
    <meta name="asset-path" content="{{ url('/phrae/') }}">
    <title>Phrae Weir </title>

    <link rel="icon" href="{{ asset('images/icon/favicon1.ico')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/form/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form/waves.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/themify-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/icofont.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/font-awesome.min.css')}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/datatables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/buttons.datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/responsive.bootstrap4.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/jquery.steps.css')}}">
    <link rel="stylesheet" href="{{ asset('css/form/feather.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/pages.css')}}">

    <!-- leaflet -->
    
    <link rel="stylesheet" href="{{ asset('css/form/leaflet.css')}}" crossorigin=""/>
   <script src="{{ asset('js/leaflet-omnivore.min.js')}}"  crossorigin=""></script>
    <script src="{{ asset('js/leaflet-src.js')}}"  crossorigin=""></script>

    <style type="text/css">
      #map{

			  font-family: Mitr, sans-serif;
			  height: 620px;
			  display: block;
        margin: auto;
        text-align: left;
        font-size: 14px;
			}
		  #map.table {
		    font-family: 'Mitr', sans-serif;
		    width: 100%;
		  }#map.tr {
		    padding: 15px;
		    text-align: right;
		  }#map.td {
		    padding: 15px;
		    text-align: right;
        }
        select{
            width: 100%;
            height: 40px;
        }
        button.btn {
            width: 100%;
        }
        @media only screen and (max-width:480px) {
            #map{
                height: 450px;
                font-size: 14px;
            }
            table{
                font-size: 2vw;
            }
            select{
            width: 100%;
            height: 40px;
            }
            button.btn{
            width: 100%;
            }
            .btn-sm{
                font-size: 2vw;
            }
        }
      #fix-header{
        font-size:16px;
      }
      th{
        text-align:center;
      }
      .btn{
        padding:2px 12px;
      }
      @media screen and (max-width: 600px) {
          div.find {
            width: 80%;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
          }
      }
     </style>

    </style>


  </head>

  <body>
    @yield('content')
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded" >
      <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container navbar-wrapper">
        @include('menu.headLogin')

        <div class="pcoded-main-container">
          <div class="pcoded-wrapper">
             @include('menu.menubar')
            <!-- Map -->
            <div class="pcoded-content">
              <div class="pcoded-inner-content">
                <div class="main-body">
                  <div class="page-wrapper">
                    <div class="page-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card table-card">
                            <div class="card-header">
                              <h4>โครงการพัฒนาระบบการสำรวจและฐานข้อมูลเพื่อบริหารจัดการพื้นที่เสี่ยงภัยน้ำท่วมและภัยแล้ง ระดับจังหวัดในพื้นที่ภาคเหนือตอนบน (ระยะที่ 1)</h4>
                              โดย สถาบันสารสนเทศทรัพยากรน้ำ (องค์การมหาชน) ร่วมกับ มหาวิทยาลัยเชียงใหม่                            
                              
                              <!-- Map Show -->
                              <div class="card-block p-b-0">
                                <div id="map"></div>
                              </div>
                               <!-- End Map show --> 
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- table -->
                      <div class="card">
                        <div class="card-block">
                          <div class="row">
                            <div class="col-lg-12 col-xl-12">
                              <div class="sub-title"><h4>ตารางแสดงรายละเอียดการตรวจสอบฝาย</h4> </div>
                              <!-- choose Amp -->
                                <!-- <form id="amp" name="amp" action="/weir/lampang/#tableData" method="get">  -->
                                <form id="amp" name="amp" action="#tableData" method="get"> 
                                  <div class="find">
                                    <div class="row justify-content-center" >
                                      <div class="col-md-8 col-xl-6"></div>
                                      <div class="col-md-8 col-xl-2">

                                        <h5 class="card-title">
                                          <select id="district">
                                            <option value="">-- เลือกอำเภอ --</option>
                                          </select>
                                        </h5>
                                      </div>
                                      <div class="col-md-8 col-xl-2">
                                        <h5 class="card-title">
                                          <select id="subdistrict" name="tumbol" >
                                              <option value=''>-- เลือกตำบล --</option>
                                              </select>
                                        </h5>
                                      </div>
                                      <div class="col-md-8 col-xl-1">
                                        <button type="submit" class="btn btn-outline-dark "  style="float: right; padding:8px;"> ค้นหา </button>
                                      </div>
                                                                    
                                    </div>
                                  </div>
                                </form>
                                <hr>
                              <br>
                                <!-- table -->
                                <div id="tableData">
                                  <div class="dt-responsive table-responsive">
                                    <table id="fix-header" class="table table-striped table-bordered nowrap" width=80% align="center">
                                      <thead>
                                        <tr>
                                          <th width=5%>#</th>
                                          <th width=10%>รหัส</th>
                                          <th width=20%>ชื่อฝาย/ลำน้ำ</th>
                                          <th width=15%>หมู่บ้าน</th>
                                          <th width=15%>ตำบล</th>
                                          <th width=15%>อำเภอ</th>
                                          <th></th>
                                        </tr>
                                      </thead>
                                      <tbody>     
                                      <?php for($i = 0;$i < count($data); $i++){  ?>
                                        <tr>
                                          <td align="center">{{$i+1}} </td>
                                          <td><a href='{{ asset('/report/pdf') }}/{{$data[$i]['weir_code']}}' target="_blank"> {{$data[$i]['weir_code']}} </a></td>
                                          <td>{{$data[$i]['weir_name']}}/{{$data[$i]['river']}} </td>
                                          <td>{{$data[$i]['weir_village']}}</td>
                                          <td>{{$data[$i]['weir_tumbol']}}  </td>
                                          <td>{{$data[$i]['weir_district']}}</td>
                                          <td align="center" > 
                                            <a href='{{ asset('/report/pdf') }}/{{$data[$i]['weir_code']}}' class="btn waves-effect waves-light btn-facebook" target="_blank"><i class="feather icon-sidebar"></i>รายงาน</a>
                                            <a href='{{ asset('/pdf') }}/{{$data[$i]['weir_code']}}' class="btn waves-effect waves-light btn-dropbox" target="_blank"><i class="feather icon-eye"></i>แบบสำรวจ</a>
                                            <a href='{{ asset('/photo') }}/{{$data[$i]['weir_code']}}' class="btn waves-effect waves-light btn-linkedin" target="_blank"><i class="feather icon-image"></i>ภาพประกอบ</a>
                                            <a href='{{ asset('/map') }}/{{$data[$i]['weir_code']}}' class="btn waves-effect waves-light btn-instagram" target="_blank"><i class="feather icon-map-pin"></i>แผนที่</a>
                                          </td>
                                        </tr>
                                      <?php }?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>    
                            </div>
                                                                                    
                          </div>
                        </div>
                      </div>
                      <!-- table end -->
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
    
    <script src="{{ asset('js/form/jquery.min.js')}}"></script>
    <script src="{{ asset('js/form/jquery-ui.min.js')}}"></script>
    <!-- <script src="{{ asset('js/form/popper.min.js')}}"></script> -->
    <script src="{{ asset('js/form/bootstrap.min.js')}}"></script>

    <!-- <script src="{{ asset('js/form/waves.min.js')}}" ></script> -->

    <script src="{{ asset('js/form/jquery.slimscroll.js')}}"></script>

    <!-- <script src="{{ asset('js/form/modernizr.js')}}"></script> -->
    <!-- <script src="{{ asset('js/form/css-scrollbars.js')}}"></script> -->

    <script src="{{ asset('js/form/jquery.datatables.min.js')}}" ></script>
    <!-- <script src="{{ asset('js/form/datatables.buttons.min.js')}}" ></script> -->
    <!-- <script src="{{ asset('js/form/jszip.min.js')}}" ></script> -->
    <!-- <script src="{{ asset('js/form/pdfmake.min.js')}}" ></script> -->
    <!-- <script src="{{ asset('js/form/vfs_fonts.js')}}" ></script> -->
    <!-- <script src="{{ asset('js/form/datatables.fixedheader.min.js')}}"></script> -->

    <!-- <script src="{{ asset('js/form/datatables.colreorder.min.js')}}" ></script>
    <script src="{{ asset('js/form/buttons.print.min.js')}}" ></script> -->
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
    <!-- Map script -->
    <link rel="stylesheet" href="{{ asset('css/L.Control.Layers.Tree.css')}}" crossorigin=""/>
    <script src="{{ asset('/js/L.Control.Layers.Tree.js')}}"></script>
    <script src="{{ asset('/js/map/map_home.js')}}"></script>
    <!-- End Map  -->
  </body>

</html>
