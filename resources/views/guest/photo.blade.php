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
          margin-bottom: 8px;
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
                                  <h5> <a href="{{ asset('/') }}">หน้าหลัก </a> &raquo;  รูปภาพประกอบของฝาย : {{$weir_id}}</h5>
                                
                                  <?php if($proj==1){?>
                                  <!-- pix Show -->
                                  <div class="card-block p-b-0">
                                      <div class="card-body" >
                                        <!-- image -->
                                        <div class="alert alert-primary" style="margin:0 -20px 0;">รูปภาพแผนที่แสดงขอบเขตพื้นที่รับน้ำ </div>
                                          <div class="row" id="showpixrow">
                                            <div class="column" id="showpix">
                                                <img src="{{asset($expert['map'])}}"  onclick="openModal();currentSlide(1)" style="width:20%" class="hover-shadow cursor">
                                            </div>
                                            
                                          </div>

                                          <div class="alert alert-primary" style="margin:0 -20px 0;">1.ส่วน Protection เหนือน้ำ</div>
                                          <div class="row" id="showpixrow">
                                              <?php for($i=0;$i<$num1;$i++){?>
                                                  <div class="column" id="showpix">
                                                      <img src="{{ asset($photo1[$i]['file']) }} " onclick="openModal();currentSlide({{$i+2}})" style="width:100%" class="hover-shadow cursor">
                                                  </div>
                                              <?php } ?> 
                                          </div>
                                          <div class="alert alert-primary" style="margin:0 -20px 0;">2.ส่วนเหนือน้ำ</div>
                                          <div class="row" id="showpixrow">
                                              <?php for($i=0;$i<$num2;$i++){?>
                                                  <div class="column" id="showpix">
                                                    <img src="{{asset($photo2[$i]['file'])}}" onclick="openModal();currentSlide({{$i+$num1+2}})" style="width:100%" class="hover-shadow cursor">
                                                  </div>
                                              <?php } ?> 
                                          </div>

                                          <div class="alert alert-primary" style="margin:0 -20px 0;">3.ส่วนควบคุม </div>
                                          <div class="row" id="showpixrow">
                                              <?php for($i=0;$i<$num3;$i++){?>
                                                  <div class="column" id="showpix">
                                                  <img src="{{asset($photo3[$i]['file'])}}" onclick="openModal();currentSlide({{$i+$num1+$num2+2}})" style="width:100%" class="hover-shadow cursor">
                                                  </div>
                                              <?php } ?> 
                                          </div>

                                          <div class="alert alert-primary" style="margin:0 -20px 0;">4.ส่วนท้ายน้ำ </div>
                                          <div class="row" id="showpixrow">
                                              <?php for($i=0;$i<$num4;$i++){?>
                                                  <div class="column" id="showpix">
                                                    <img src="{{asset($photo4[$i]['file'])}}" onclick="openModal();currentSlide({{$i+$num1+$num2+$num3+2}})" style="width:100%" class="hover-shadow cursor">
                                                  </div>
                                              <?php } ?> 
                                          </div>
                                          <div class="alert alert-primary" style="margin:0 -20px 0;">5.ส่วน Protection ท้ายน้ำ </div>
                                          <div class="row" id="showpixrow">
                                              <?php for($i=0;$i<$num5;$i++){?>
                                                  <div class="column" id="showpix">
                                                    <img src="{{asset($photo5[$i]['file'])}}" onclick="openModal();currentSlide({{$i+$num1+$num2+$num3+$num4+2}})" style="width:100%" class="hover-shadow cursor">
                                                  </div>
                                              <?php } ?> 
                                          </div>
                                          <div class="alert alert-primary" style="margin:0 -20px 0;">6.ระบบส่งน้ำ </div>
                                          <div class="row" id="showpixrow">
                                              <?php for($i=0;$i<$num6;$i++){?>
                                                  <div class="column" id="showpix">
                                                    <img src="{{asset($photo6[$i]['file'])}}" onclick="openModal();currentSlide({{$i+$num1+$num2+$num3+$num4+$num5+2}})" style="width:100%" class="hover-shadow cursor">
                                                  </div>
                                              <?php } ?> 
                                          </div>

                                          
                                          
                                      </div>

                                      <!-- images -->
                                      <div id="myModal" class="modal">
                                          <span class="closeph cursor" onclick="closeModal()"> &times; </span>
                                          <div class="modal-content" >
                                              <?php   $num =$num1+$num2+$num3+$num4+$num5+$num6+1; ?>
                                              <!-- 1 -->
                                              <!-- map -->
                                              <div class="mySlides" align="center">
                                                <div class="numbertext"> 1 /{{$num}}</div>
                                                  <img src="{{asset($expert['map'])}}" width=60%>
                                              </div>

                                              <?php for($i=0;$i<$num1;$i++){?>
                                                      <div class="mySlides">
                                                          <div class="numbertext">{{$i+2}} / {{$num}}</div>
                                                          <img src="{{asset($photo1[$i]['original'])}}" class="pixpopup">
                                                      </div>
                                              <?php } ?>
                                              <!-- 2 -->
                                              <?php for($i=0;$i<$num2;$i++){?>
                                                      <div class="mySlides">
                                                          <div class="numbertext">{{$i+$num1+2}} / {{$num}}</div>
                                                          <img src="{{asset($photo2[$i]['original'])}} " class="pixpopup" >
                                                      </div>
                                              <?php } ?>
                                              <!-- 3 -->
                                              <?php for($i=0;$i<$num3;$i++){?>
                                                      <div class="mySlides">
                                                          <div class="numbertext">{{$i+$num1+$num2+2}} / {{$num}}</div>
                                                          <img src="{{asset($photo3[$i]['original'])}}" class="pixpopup" >
                                                      </div>
                                              <?php } ?>
                                              <!-- 4 -->
                                              <?php for($i=0;$i<$num4;$i++){?>
                                                      <div class="mySlides">
                                                          <div class="numbertext">{{$i+$num1+$num2+$num3+2}} / {{$num}}</div>
                                                          <img src="{{asset($photo4[$i]['original'])}}"class="pixpopup" >
                                                      </div>
                                              <?php } ?>
                                              <!-- 5 -->
                                              <?php for($i=0;$i<$num5;$i++){?>
                                                      <div class="mySlides">
                                                          <div class="numbertext">{{$i+$num1+$num2+$num3+$num4+2}} / {{$num}}</div>
                                                          <img src="{{asset($photo5[$i]['original'])}}" class="pixpopup">
                                                      </div>
                                              <?php } ?>
                                              <!-- 6 -->
                                              <?php for($i=0;$i<$num6;$i++){?>
                                                      <div class="mySlides">
                                                          <div class="numbertext">{{$i+$num1+$num2+$num3+$num4+$num5+2}} / {{$num}}</div>
                                                          <img  src="{{asset($photo6[$i]['original'])}}"  >
                                                      </div>
                                              <?php } ?>
                                              
                                              
                                                  
                                          
                                              <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                              <a class="nextph" onclick="plusSlides(1)">&#10095;</a>
                                          
                                              <div class="caption-container">
                                              <p id="caption"></p>
                                              </div>
                                              <div class="caption-container" width=100%>
                                                <div class="columnDown">
                                                    <img class="demo cursor" src="{{asset($expert['map'])}}" style="width:50%" onclick="currentSlide(1)" >
                                                </div>
                                                <!-- 1 -->
                                                <?php for($i=0;$i<$num1;$i++){?>
                                                    <div class="columnDown">
                                                        <img class="demo cursor" src="{{asset($photo1[$i]['file'])}}" style="width:100%" onclick="currentSlide({{$i+2}})" >
                                                    </div>
                                                <?php } ?>
                                                <!-- 2 -->
                                                <?php for($i=0;$i<$num2;$i++){?>
                                                    <div class="columnDown">
                                                        <img class="demo cursor" src="{{asset($photo2[$i]['file'])}}" style="width:100%" onclick="currentSlide({{$i+$num1+2}})" >
                                                    </div>
                                                <?php } ?>
                                                <!-- 3 -->
                                                <?php for($i=0;$i<$num3;$i++){?>
                                                    <div class="columnDown">
                                                        <img class="demo cursor" src="{{asset($photo3[$i]['file'])}}" style="width:100%" onclick="currentSlide({{$i+$num1+$num2+2}})" >
                                                    </div>
                                                <?php } ?>
                                                <!-- 4 -->
                                                <?php for($i=0;$i<$num4;$i++){?>
                                                    <div class="columnDown">
                                                        <img class="demo cursor" src="{{asset($photo4[$i]['file'])}}" style="width:100%" onclick="currentSlide({{$i+$num1+$num2+$num3+2}})" >
                                                    </div>
                                                <?php } ?>
                                                <!-- 5 -->
                                                <?php for($i=0;$i<$num5;$i++){?>
                                                    <div class="columnDown">
                                                        <img class="demo cursor" src="{{asset($photo5[$i]['file'])}}" style="width:100%" onclick="currentSlide({{$i+$num1+$num2+$num3+$num4+2}})" >
                                                    </div>
                                                <?php } ?>
                                                <!-- 6 -->
                                                <?php for($i=0;$i<$num6;$i++){?>
                                                    <div class="columnDown">
                                                        <img class="demo cursor" src="{{asset($photo6[$i]['file'])}}" style="width:100%" onclick="currentSlide({{$i+$num1+$num2+$num3+$num4+$num5+2}})" >
                                                    </div>
                                                <?php } ?>

                                                
                                                  
                                              </div>
                                              
                                          </div>
                                      </div> 
                            
                                    
                                  </div>
                                  <!-- End Map show -->
                                  <?php }else{ ?>
                                    <div class="card-block p-b-0">
                                      <div class="card-body" >
                                        <!-- image -->
                                        <div class="alert alert-primary" style="margin:0 -20px 0;">รูปภาพแผนที่แสดงขอบเขตพื้นที่รับน้ำ </div>
                                          <div class="row" id="showpixrow">
                                            <div class="column" id="showpix">
                                                <img src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$expert['map']}}"  onclick="openModal();currentSlide(1)" style="width:20%" class="hover-shadow cursor">
                                            </div>
                                            
                                          </div>

                                          <div class="alert alert-primary" style="margin:0 -20px 0;">1.ส่วน Protection เหนือน้ำ</div>
                                          <div class="row" id="showpixrow">
                                              <?php for($i=0;$i<$num1;$i++){?>
                                                  <div class="column" id="showpix">
                                                      <img src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo1[$i]['file']}} " onclick="openModal();currentSlide({{$i+2}})" style="width:100%" class="hover-shadow cursor">
                                                  </div>
                                              <?php } ?> 
                                          </div>
                                          <div class="alert alert-primary" style="margin:0 -20px 0;">2.ส่วนเหนือน้ำ</div>
                                          <div class="row" id="showpixrow">
                                              <?php for($i=0;$i<$num2;$i++){?>
                                                  <div class="column" id="showpix">
                                                    <img src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo2[$i]['file']}}" onclick="openModal();currentSlide({{$i+$num1+2}})" style="width:100%" class="hover-shadow cursor">
                                                  </div>
                                              <?php } ?> 
                                          </div>

                                          <div class="alert alert-primary" style="margin:0 -20px 0;">3.ส่วนควบคุม </div>
                                          <div class="row" id="showpixrow">
                                              <?php for($i=0;$i<$num3;$i++){?>
                                                  <div class="column" id="showpix">
                                                  <img src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo3[$i]['file']}}" onclick="openModal();currentSlide({{$i+$num1+$num2+2}})" style="width:100%" class="hover-shadow cursor">
                                                  </div>
                                              <?php } ?> 
                                          </div>

                                          <div class="alert alert-primary" style="margin:0 -20px 0;">4.ส่วนท้ายน้ำ </div>
                                          <div class="row" id="showpixrow">
                                              <?php for($i=0;$i<$num4;$i++){?>
                                                  <div class="column" id="showpix">
                                                    <img src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo4[$i]['file']}}" onclick="openModal();currentSlide({{$i+$num1+$num2+$num3+2}})" style="width:100%" class="hover-shadow cursor">
                                                  </div>
                                              <?php } ?> 
                                          </div>
                                          <div class="alert alert-primary" style="margin:0 -20px 0;">5.ส่วน Protection ท้ายน้ำ </div>
                                          <div class="row" id="showpixrow">
                                              <?php for($i=0;$i<$num5;$i++){?>
                                                  <div class="column" id="showpix">
                                                    <img src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo5[$i]['file']}}" onclick="openModal();currentSlide({{$i+$num1+$num2+$num3+$num4+2}})" style="width:100%" class="hover-shadow cursor">
                                                  </div>
                                              <?php } ?> 
                                          </div>
                                          <div class="alert alert-primary" style="margin:0 -20px 0;">6.ระบบส่งน้ำ </div>
                                          <div class="row" id="showpixrow">
                                              <?php for($i=0;$i<$num6;$i++){?>
                                                  <div class="column" id="showpix">
                                                    <img src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo6[$i]['file']}}" onclick="openModal();currentSlide({{$i+$num1+$num2+$num3+$num4+$num5+2}})" style="width:100%" class="hover-shadow cursor">
                                                  </div>
                                              <?php } ?> 
                                          </div>

                                          
                                          
                                      </div>

                                      <!-- images -->
                                      <div id="myModal" class="modal">
                                          <span class="closeph cursor" onclick="closeModal()"> &times; </span>
                                          <div class="modal-content" >
                                              <?php   $num =$num1+$num2+$num3+$num4+$num5+$num6+1; ?>
                                              <!-- 1 -->
                                              <!-- map -->
                                              <div class="mySlides" align="center">
                                                <div class="numbertext"> 1 /{{$num}}</div>
                                                  <img src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$expert['map']}}" width=60%>
                                              </div>

                                              <?php for($i=0;$i<$num1;$i++){?>
                                                      <div class="mySlides">
                                                          <div class="numbertext">{{$i+2}} / {{$num}}</div>
                                                          <img src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo1[$i]['original']}}" class="pixpopup">
                                                      </div>
                                              <?php } ?>
                                              <!-- 2 -->
                                              <?php for($i=0;$i<$num2;$i++){?>
                                                      <div class="mySlides">
                                                          <div class="numbertext">{{$i+$num1+2}} / {{$num}}</div>
                                                          <img src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo2[$i]['original']}} " class="pixpopup" >
                                                      </div>
                                              <?php } ?>
                                              <!-- 3 -->
                                              <?php for($i=0;$i<$num3;$i++){?>
                                                      <div class="mySlides">
                                                          <div class="numbertext">{{$i+$num1+$num2+2}} / {{$num}}</div>
                                                          <img src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo3[$i]['original']}}" class="pixpopup" >
                                                      </div>
                                              <?php } ?>
                                              <!-- 4 -->
                                              <?php for($i=0;$i<$num4;$i++){?>
                                                      <div class="mySlides">
                                                          <div class="numbertext">{{$i+$num1+$num2+$num3+2}} / {{$num}}</div>
                                                          <img src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo4[$i]['original']}}"class="pixpopup" >
                                                      </div>
                                              <?php } ?>
                                              <!-- 5 -->
                                              <?php for($i=0;$i<$num5;$i++){?>
                                                      <div class="mySlides">
                                                          <div class="numbertext">{{$i+$num1+$num2+$num3+$num4+2}} / {{$num}}</div>
                                                          <img src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo5[$i]['original']}}" class="pixpopup">
                                                      </div>
                                              <?php } ?>
                                              <!-- 6 -->
                                              <?php for($i=0;$i<$num6;$i++){?>
                                                      <div class="mySlides">
                                                          <div class="numbertext">{{$i+$num1+$num2+$num3+$num4+$num5+2}} / {{$num}}</div>
                                                          <img  src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo6[$i]['original']}}"  >
                                                      </div>
                                              <?php } ?>
                                              
                                              
                                                  
                                          
                                              <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                              <a class="nextph" onclick="plusSlides(1)">&#10095;</a>
                                          
                                              <div class="caption-container">
                                              <p id="caption"></p>
                                              </div>
                                              <div class="caption-container" width=100%>
                                                <div class="columnDown">
                                                    <img class="demo cursor" src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$expert['map']}}" style="width:50%" onclick="currentSlide(1)" >
                                                </div>
                                                <!-- 1 -->
                                                <?php for($i=0;$i<$num1;$i++){?>
                                                    <div class="columnDown">
                                                        <img class="demo cursor" src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo1[$i]['file']}}" style="width:100%" onclick="currentSlide({{$i+2}})" >
                                                    </div>
                                                <?php } ?>
                                                <!-- 2 -->
                                                <?php for($i=0;$i<$num2;$i++){?>
                                                    <div class="columnDown">
                                                        <img class="demo cursor" src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo2[$i]['file']}}" style="width:100%" onclick="currentSlide({{$i+$num1+2}})" >
                                                    </div>
                                                <?php } ?>
                                                <!-- 3 -->
                                                <?php for($i=0;$i<$num3;$i++){?>
                                                    <div class="columnDown">
                                                        <img class="demo cursor" src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo3[$i]['file']}}" style="width:100%" onclick="currentSlide({{$i+$num1+$num2+2}})" >
                                                    </div>
                                                <?php } ?>
                                                <!-- 4 -->
                                                <?php for($i=0;$i<$num4;$i++){?>
                                                    <div class="columnDown">
                                                        <img class="demo cursor" src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo4[$i]['file']}}" style="width:100%" onclick="currentSlide({{$i+$num1+$num2+$num3+2}})" >
                                                    </div>
                                                <?php } ?>
                                                <!-- 5 -->
                                                <?php for($i=0;$i<$num5;$i++){?>
                                                    <div class="columnDown">
                                                        <img class="demo cursor" src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo5[$i]['file']}}" style="width:100%" onclick="currentSlide({{$i+$num1+$num2+$num3+$num4+2}})" >
                                                    </div>
                                                <?php } ?>
                                                <!-- 6 -->
                                                <?php for($i=0;$i<$num6;$i++){?>
                                                    <div class="columnDown">
                                                        <img class="demo cursor" src="http://watercenter.scmc.cmu.ac.th/weir/jang_basin/{{$photo6[$i]['file']}}" style="width:100%" onclick="currentSlide({{$i+$num1+$num2+$num3+$num4+$num5+2}})" >
                                                    </div>
                                                <?php } ?>

                                                
                                                  
                                              </div>
                                              
                                          </div>
                                      </div> 
                            
                                    
                                  </div>
                                  <!-- End Map show -->
                                  <?php } ?>                     
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
    <script src="{{ asset('js/form/jquery-i18next.min.js')}}" ></script>
    <script src="{{ asset('js/form/pcoded.min.js')}}" ></script>
    <script src="{{ asset('js/form/menu-hori-fixed.js')}}" ></script>
    <script src="{{ asset('js/form/jquery.mcustomscrollbar.concat.min.js')}}" ></script>
    <script src="{{ asset('js/form/script.js')}}"></script>
    <script async  src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    
    <script src="{{ asset('js/form/rocket-loader.min.js')}}"></script>

    <!-- photo -->
    <script>
        function openModal() {
          document.getElementById("myModal").style.display = "block";
        }
        
        function closeModal() {
          document.getElementById("myModal").style.display = "none";
        }
        
        var slideIndex = 1;
        showSlides(slideIndex);
        
        function plusSlides(n) {
          showSlides(slideIndex += n);
        }
        
        function currentSlide(n) {
          showSlides(slideIndex = n);
        }
        
        function showSlides(n) {
          var i;
          var slides = document.getElementsByClassName("mySlides");
          var dots = document.getElementsByClassName("demo");
          var captionText = document.getElementById("caption");
          if (n > slides.length) {slideIndex = 1}
          if (n < 1) {slideIndex = slides.length}
          for (i = 0; i < slides.length; i++) {
              slides[i].style.display = "none";
          }
          for (i = 0; i < dots.length; i++) {
              dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";
          dots[slideIndex-1].className += " active";
          captionText.innerHTML = dots[slideIndex-1].alt;
        }
    </script>

    
  </body>

</html>
