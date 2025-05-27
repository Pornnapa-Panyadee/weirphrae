<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <meta charset="utf-8">
  <title>Weir | Add/Delete Images </title>

  <link rel="icon" href="{{ asset('images/icon/favicon1.ico')}}" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/form/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/form/waves.min.css')}}" type="text/css" media="all">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form/feather.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form/themify-icons.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form/icofont.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form/font-awesome.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form/jquery.steps.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form/pages.css')}}">
  
  <style>
    .table2{
      font-size:12px;
      text-align: center;
    }.table2 tr{
      height:35px;
    }#text1{
      text-align: left;
      background-color: #d9d9d9;
    }#text2{
      text-align: left;
      vertical-align: top;
    }#text3{
      text-align: left;
      background-color: #f2f2f2;
    }.checkbox-color{
      margin-top: 10px;
      margin-left: 30px;
    }input[type="file"] {
      display: block;
    }.imageThumb {
      max-height: 100px;
      border: 1px solid;
      padding: 1px;
      cursor: pointer;
    }.pip {
      display: inline-block;
      margin: 10px 10px 0 0;
    }.remove {
      display: block;
      background: #263544;
      border: 1px solid ;
      color: white;
      text-align: center;
      cursor: pointer;
    }.remove:hover {
      background: white;
      color: black;
    }
  </style>
  <style>
   .tab {
      overflow: hidden;
      background-color: #f2f7fb;
    }
    .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 20px;
      transition: 0.3s;
      font-size: 17px;
      width: 20%;
      border-radius: 10px 10px 0px 0px;
      
    }
    .tab button:hover {
      background-color: #4099ff;
    }
    .tab button.active {
      background-color: #4099ff;
    }
    .tabcontent {
      display: none;
      padding: 6px 12px;
      border-top: 5px solid #263544;
    }
  </style>
  
 </head>
 
 <body>
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
                        <h3>รูปภาพประกอบของ : ฝาย{{$weir[0]->weir_name}} รหัส: {{$weir[0]->weir_code}}</h3>  <br>
                        <div class="tab">
                          <button class="tablinks" onclick="openCity(event, 'add')" id="defaultOpen"><i class="fa fa-plus-circle"></i> เพิ่มรูปประกอบ</button>
                          <button class="tablinks" onclick="openCity(event, 'remove')"> <i class="icofont icofont-delete-alt"></i>ลบรูปประกอบ</button>
                        </div>

                        <div id="add" class="tabcontent">
                          <div class="card-block p-b-0">
                              <div class="card-body" >
                                  <div class="row justify-content-center">
                                    <div class="col-md-10">
                                        <section>
                                          <form class="wizard-form" id="basic-forms" action="{{route('form.photosubmit')}}" enctype="multipart/form-data" method="POST" onsubmit="return confirm('บันทึกข้อมูล เรียบร้อย !!');">
                                              @csrf <!-- {{ csrf_field() }} -->   
                                            <fieldset>
                                              <!-- 1 -->
                                                <input type="hidden" name="weir_code" id="weir_code"  value="{{$weir[0]->weir_code}}">
                                                <div class="alert alert-primary" style="margin:0 -10px 10px 0;">1.ส่วน Protection เหนือน้ำ</div>
                                                <h5><input type="file" id="upstream_protection" name="upstream_protection[]" multiple /> </h5>
                                                <hr>
                                              <!-- 2 -->
                                                <div class="alert alert-primary" style="margin:0 -10px 10px 0;">2. ส่วนเหนือน้ำ (Upstream Concrete Section) </div>
                                                <h5><input type="file" id="upstream_concrete" name="upstream_concrete[]" multiple /> </h5>
                                                <hr>

                                              <!-- 3 -->
                                                <div class="alert alert-primary" style="margin:0 -10px 10px 0;">3. ส่วนควบคุม (Control Sector)  </div>
                                                <h5><input type="file" id="control" name="control[]" multiple /> </h5>
                                                <hr>
                                              
                                              <!-- 4 -->
                                                <div class="alert alert-primary" style="margin:0 -10px 10px 0;">4. ส่วนท้ายน้ำ (Downstream Concrete Section) </div>
                                                <h5><input type="file" id="downstream_concrete" name="downstream_concrete[]" multiple /> </h5>
                                                <hr>

                                              <!-- 5 -->
                                                <div class="alert alert-primary" style="margin:0 -10px 10px 0;">5. ส่วน Protection ท้ายน้ำ (Downstream Protection Section)  </div>
                                                <h5><input type="file" id="downstream_protection" name="downstream_protection[]" multiple /> </h5>
                                                <hr>

                                              <!-- 6 -->
                                                <div class="alert alert-primary" style="margin:0 -10px 10px 0;">6. ระบบส่งน้ำ   </div>
                                                <h5><input type="file" id="water_system" name="water_system[]" multiple /> </h5>
                                                <hr>

                                              </fieldset>
                                              <br>
                                              <button type="submit" class="btn waves-effect waves-light btn-primary btn-block" >บันทึกข้อมูล</button>                                 
                                          </form>
                                        </section>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>

                        <div id="remove" class="tabcontent">
                          <div class="card-block p-b-0">
                              <div class="card-body" >
                                  <div class="row justify-content-center">
                                    <div class="col-md-10">
                                        <section>
                                            <fieldset>
                                              <!-- 1 -->
                                                <input type="hidden" name="weir_code" id="weir_code"  value="{{$weir[0]->weir_code}}">
                                                <div class="alert alert-primary" style="margin:0 -10px 10px 0;">1.ส่วน Protection เหนือน้ำ</div>
                                              <div class="row">
                                                  <?php for($i=0;$i<$num1;$i++){?>
                                                      <div style="margin:10px;">
                                                          <img src="{{asset($photo1[$i]['file'])}}" style="width:100%" > 
                                                          {{$photo1[$i]['name'] }}
                                                          <div align="right">
                                                            <a href='{{ asset('/photoremove') }}/{{$photo1[$i]['name']}}'  > 
                                                              <button class="btn waves-effect waves-dark btn-mini btn-danger btn-outline-danger" onclick="myFunction()" title="delete">
                                                                <i class="icofont icofont-delete-alt"></i>
                                                              </button>
                                                            </a>
                                                          </div>
                                                      </div>
                                                  <?php } ?> 
                                                </div>
                                              <!-- 2 -->
                                                <div class="alert alert-primary" style="margin:0 -10px 10px 0;">2. ส่วนเหนือน้ำ (Upstream Concrete Section) </div>
                                              <div class="row">
                                                  <?php for($i=0;$i<$num2;$i++){?>
                                                    <div style="margin:10px;">
                                                      <img src="{{asset($photo2[$i]['file'])}}"  style="width:100%" >
                                                      <div align="right">
                                                      {{$photo2[$i]['name'] }}
                                                        <a href='{{ asset('/photoremove') }}/{{$photo2[$i]['name']}}' >
                                                          <button class="btn waves-effect waves-dark btn-mini btn-danger btn-outline-danger" onclick="myFunction()" title="delete">
                                                            <i class="icofont icofont-delete-alt"></i>
                                                          </button>
                                                        </a>
                                                      </div>
                                                    </div>
                                                  <?php } ?> 
                                                </div>
                                                

                                              <!-- 3 -->
                                                <div class="alert alert-primary" style="margin:0 -10px 10px 0;">3. ส่วนควบคุม (Control Sector)  </div>
                                              <div class="row">
                                                  <?php for($i=0;$i<$num3;$i++){?>
                                                    <div style="margin:10px;">
                                                      <img src="{{asset($photo3[$i]['file'])}}"style="width:100%" >
                                                      <div align="right">
                                                      {{$photo3[$i]['name'] }}
                                                        <a href='{{ asset('/photoremove') }}/{{$photo3[$i]['name']}}'  >
                                                          <button class="btn waves-effect waves-dark btn-mini btn-danger btn-outline-danger" onclick="myFunction()" title="delete">
                                                            <i class="icofont icofont-delete-alt"></i>
                                                          </button>
                                                        </a>
                                                      </div>
                                                    </div>
                                                  <?php } ?>  
                                                </div>
                                                
                                              
                                              <!-- 4 -->
                                                <div class="alert alert-primary" style="margin:0 -10px 10px 0;">4. ส่วนท้ายน้ำ (Downstream Concrete Section) </div>
                                              <div class="row">
                                                  <?php for($i=0;$i<$num4;$i++){?>
                                                    <div style="margin:10px;">
                                                      <img src="{{asset($photo4[$i]['file'])}}"  style="width:100%" >
                                                      <div align="right">
                                                      {{$photo4[$i]['name'] }}
                                                        <a href='{{ asset('/photoremove') }}/{{$photo4[$i]['name']}}'  >
                                                          <button class="btn waves-effect waves-dark btn-mini btn-danger btn-outline-danger" onclick="myFunction()" title="delete">
                                                            <i class="icofont icofont-delete-alt"></i>
                                                          </button>
                                                        </a>
                                                      </div>
                                                    </div>
                                                  <?php } ?> 
                                                </div>
                                               

                                              <!-- 5 -->
                                                <div class="alert alert-primary" style="margin:0 -10px 10px 0;">5. ส่วน Protection ท้ายน้ำ (Downstream Protection Section)  </div>
                                              <div class="row">
                                                  <?php for($i=0;$i<$num5;$i++){?>
                                                    <div style="margin:10px;">
                                                      <img src="{{asset($photo5[$i]['file'])}}" style="width:100%" >
                                                      <div align="right">
                                                        {{$photo5[$i]['name'] }}
                                                        <a href='{{ asset('/photoremove') }}/{{$photo5[$i]['name']}}'  >
                                                          <button class="btn waves-effect waves-dark btn-mini btn-danger btn-outline-danger" onclick="myFunction()" title="delete">
                                                            <i class="icofont icofont-delete-alt"></i>
                                                          </button>
                                                        </a>
                                                      </div>
                                                    </div>
                                                  <?php } ?> 
                                                </div>
                                               

                                              <!-- 6 -->
                                                <div class="alert alert-primary" style="margin:0 -10px 10px 0;">6. ระบบส่งน้ำ   </div>
                                              <div class="row">
                                                  <?php for($i=0;$i<$num6;$i++){?>
                                                    <div style="margin:10px;">
                                                      <img src="{{asset($photo6[$i]['file'])}}" style="width:100%" >
                                                      <div align="right">
                                                        {{$photo6[$i]['name'] }}
                                                        <a href='{{ asset('/photoremove') }}/{{$photo6[$i]['name']}}'  >
                                                          <button class="btn waves-effect waves-dark btn-mini btn-danger btn-outline-danger" onclick="myFunction()" title="delete">
                                                            <i class="icofont icofont-delete-alt"></i>
                                                          </button>
                                                        </a>
                                                      </div>
                                                    </div>
                                                  <?php } ?> 
                                                </div>
                                             
                                              </fieldset>
                                              <br>
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

 <script src="{{ asset('js/form/jquery.min.js')}}"></script>
 <script src="{{ asset('js/form/jquery-ui.min.js')}}"></script>
 <script src="{{ asset('js/form/bootstrap.min.js')}}"></script>
 <script src="{{ asset('js/form/jquery.slimscroll.js')}}"></script>

 <script src="{{ asset('js/form/modernizr.js')}}"></script>
 <script src="{{ asset('js/form/css-scrollbars.js')}}"></script>
 <script src="{{ asset('js/form/jquery.cookie.js')}}" ></script>
 <script src="{{ asset('js/form/jquery.steps.js')}}" ></script>
 <script src="{{ asset('js/form/jquery.validate.js')}}" ></script>
 <script src="{{ asset('js/form/moment.min.js')}}" ></script>
 <script src="{{ asset('js/form/validate.js')}}"></script>
 <script src= "{{ asset('js/form/fixed-header-custom.js') }}"></script>
 <script src= "{{ asset('js/form/pcoded.min.js') }}"></script>
 <script src="{{ asset('js/form/form-wizard.js')}}" ></script>
 <script src="{{ asset('js/form/vertical-layout.min.js')}}" ></script>
 <script src="{{ asset('js/form/jquery.mcustomscrollbar.concat.min.js')}}" ></script>
 <script src="{{ asset('js/form/script.js')}}"></script>
 <script src="{{ asset('js/remove_photo.js')}}"></script>

 <script src= "{{ asset('js/chooselocation.js') }}"></script>
 <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" ></script>
 <script >
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-23581568-13');
 </script>
 <script src="{{ asset('js/form/rocket-loader.min.js')}}" data-cf-settings="ce2668daaac54a74e9f6cdff-|49" defer=""></script>
 <script>
      function myFunction() {
        confirm("คุณต้องการลบรูปฝายใช่ไหม?");
      }
  </script>

  <script>
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
    document.getElementById("defaultOpen").click();
  </script>

</body>

</html>
