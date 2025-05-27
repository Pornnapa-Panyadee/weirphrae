<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8">
    <title>Phrae Weir </title>

    <link rel="icon" href="{{ asset('images/icon/favicon1.ico')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('fonts/feather/feather.css')}}"> -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/form/themify-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/icofont.css')}}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/datatables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/buttons.datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/responsive.bootstrap4.min.css')}}">

    <link rel="stylesheet" href="{{ asset('css/form/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form/waves.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/jquery.steps.css')}}">
    <link rel="stylesheet" href="{{ asset('css/form/feather.css')}}">
    <link rel="stylesheet" href="{{ asset('css/form/style1.css')}}">

    <!-- leaflet -->
    
    <link rel="stylesheet" href="{{ asset('css/form/leaflet.css')}}" crossorigin=""/>
    <script src='https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.2.0/leaflet-omnivore.min.js'></script>
    <script src="{{ asset('js/leaflet-src.js')}}"  crossorigin=""></script>

    <style>
        
        * {
          box-sizing: border-box;
        }
        
        .row > .column {
          padding: 0 8px;
        }
        
        .row:after {
          margin:5px 0px 5px 0px;
          content: "";
          display: table;
          clear: both;
        }
        
        .column {
          float: left;
          margin-top: 10px;
        }
       

        .columnmap {
          float: left;
          width: 20%;
          margin-top: 10px;
        }

        .columnDown {
          float: left;
          width: 10%;
        }
        
        /* The Modal (background) */
        .modal {
          display: none;
          position: fixed;
          z-index: 1;
          padding-top: 200px;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          overflow: auto;
          background-color: rgba(0, 0, 0, 0.95);
        }
        
        /* Modal Content */
        .modal-content {
          position: relative;
          background-color: #fefefe;
          margin: auto;
          padding: 0;
          width: 90%;
          max-width: 1200px;
        }
        
        /* The Close Button */
        .closeph {
          color:#f2f2f2;
          position: absolute;
          top: 120px;
          right: 150px;
          font-size: 3.35rem;
          
        }
        
        .closeph:hover,
        .closeph:focus {
          color:#f2f2f2;
          text-decoration: none;
          cursor: pointer;
        }
        
        .mySlides {
          display: none;
        }
        
        .cursor {
          cursor: pointer;
        }
        
        /* Next & previous buttons */
        .prev,
        .nextph {
          background-color:#000;
          cursor: pointer;
          position: absolute;
          top: 50%;
          width: auto;
          padding: 16px;
          margin-top: -80px;
          color: white;
          font-weight: bold;
          font-size: 30px;
          transition: 0.6s ease;
          border-radius: 0 3px 3px 0;
          user-select: none;
          -webkit-user-select: none;
        }
        
        /* Position the "next button" to the right */
        .nextph {
          right: 0;
          border-radius: 3px 0 0 3px;
        }
        
        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .nextph:hover {
          background-color: rgba(0, 0, 0, 0.8);
        }
        
        /* Number text (1/3 etc) */
        .numbertext {
          color: #f2f2f2;
          font-size: 12px;
          padding: 8px 12px;
          position: absolute;
          top: 0;
        }
        
        img {
          margin-bottom: -4px;
        }
        
        .caption-container {
          text-align: center;
          background-color: black;
          padding: 2px 16px;
          color: white;
        }
        
        .demo {
          opacity: 0.6;
        }
        
        .active,
        .demo:hover {
          opacity: 1;
        }
        
        img.hover-shadow {
          transition: 0.3s;
        }
        
        .hover-shadow:hover {
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .pixpopup{
          text-align: center;
          display: block;
          margin-left: auto;
          margin-right: auto;
          width: 100%;
        }
        @media only screen and (max-width: 600px) {
          .column {
              float: left;
              width: 50%;
              margin-top: 10px;
            }
          .columnmap {
              float: left;
              width: 50%;
              margin-top: 10px;
            }
          .columnDown {
            float: left;
            width: 20%;
            } 
        }
    </style>

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
                        <div class="page-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="card table-card">
                                <div class="card-header">
                                  
                                    
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><div class="card-body" style="overflow-x:auto;">
                                        <table class="table_bg" width="100%" >
                                            <thead>
                                                <tr>
                                                    <th scope="col" >#</th>
                                                    <th scope="col" >รหัส</th>
                                                    <th scope="col" >ชื่อฝาย</th>
                                                    <th scope="col" >ลำน้ำ</th>
                                                    <th scope="col" >หมู่บ้าน</th>
                                                    <th scope="col" >ตำบล</th>
                                                    <th scope="col" >อำเภอ</th>
                                                    <th scope="col" >จังหวัด</th>
                                                    <th scope="col" >UMT X </th>
                                                    <th scope="col" >UMT Y</th>
                                                    <th scope="col" >Latitude</th>
                                                    <th scope="col" >Longitude</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for($i = 0;$i < count($data);$i++){ ?>
                                                    <tr >
                                                        <th scope="row" data-label="ลำดับ">{{$i+1}}</th>
                                                        <td data-label="รหัส">{{$data[$i]['weir_code']}}</td>
                                                        <td data-label="ลำน้ำ">{{$data[$i]['weir_name']}} </td>
                                                        <td data-label="ลำน้ำ"> {{$data[$i]['river']}} </td>
                                                        <td data-label="ที่ตั้ง">{{$data[$i]['weir_village']}} </td>
                                                        <td>{{$data[$i]['weir_tumbol']}} </td>
                                                        <td>{{$data[$i]['weir_district']}}</td>
                                                        <td>ลำปาง</td>
                                                        <td>{{ $data[$i]['UTM_x']}}</td>
                                                        <td>{{ $data[$i]['UTM_y']}}</td>

                                                        <td>{{ $data[$i]['lat']}}</td>
                                                        <td>{{ $data[$i]['long']}}</td>
                                                                                    
                                                    </tr>
                                                <?php }?>
                                                
                                              
                                            </tbody>
                                        </table>
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
    <script src="{{ asset('js/form/jquery-i18next.min.js')}}" ></script>
    <script src="{{ asset('js/form/pcoded.min.js')}}" ></script>
    <script src="{{ asset('js/form/menu-hori-fixed.js')}}" ></script>
    <script src="{{ asset('js/form/jquery.mcustomscrollbar.concat.min.js')}}" ></script>
    <script src="{{ asset('js/form/script.js')}}"></script>
    <script async  src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    
    <script src="{{ asset('js/form/rocket-loader.min.js')}}"></script>

  </body>

</html>
