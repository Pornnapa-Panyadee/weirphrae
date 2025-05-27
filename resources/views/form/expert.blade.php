<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <meta charset="utf-8">
  <title>Weir | Survey Form </title>

  <link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">
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
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="{{ asset('js/proj4js.js') }}"></script>
  <script src="{{ asset('js/EPSG32647.js') }}"></script>

  <script type="text/javascript">
    var projHash = {};
    function initProj4js() {
      var crsSource = document.getElementById('crsSource');
      var crsDest = document.getElementById('crsDest');
      var optIndex = 0;
      for (var def in Proj4js.defs) {
        //def="EPSG:32647";
        projHash[def] = new Proj4js.Proj(def);    //create a Proj for each definition
        var label = def+" - "+ (projHash[def].title ? projHash[def].title : '');
        var opt = new Option(label, def);
        crsSource.options[optIndex]= opt;
        var opt = new Option(label, def);
        crsDest.options[optIndex]= opt;
        ++optIndex;
      }  // for
      updateCrs('Source');
      updateCrs('Dest');
    }
    function updateCrs(id) {
      var crs = document.getElementById('crs'+id);
      if(id=="Source"){
        // crs.value="WGS84";
        crs.value="EPSG:32647";
      }else{
        crs.value="WGS84";
        // crs.value="EPSG:32647";
      }
    } 
    function transform() {
     var crsSource = document.getElementById('crsSource');
     var projSource = null;
     //   console.log(crsSource.value);
            
     if (crsSource.value) {
      projSource = projHash["EPSG:32647"];
     } else {
      alert("Select a source coordinate system");
      return;
     }
            
     var crsDest = document.getElementById('crsDest');
     //   console.log(crsDest.value);
     var projDest = null;
     if (crsDest.value) {
       projDest = projHash["WGS84"];
       // projDest = projHash["EPSG:32647"];
     } else {
      alert("Select a destination coordinate system");
      return;
     }
      
     var pointInputX = document.getElementById('weir_XUTM');
     var pointInputY = document.getElementById('weir_YUTM');
     var pointInput = pointInputX.value+","+pointInputY.value;
               
     if (pointInputX.value) {
      var pointSource = new Proj4js.Point(pointInput);
      var pointDest = Proj4js.transform(projSource, projDest, pointSource);
      // console.log(pointDest.x);
      document.getElementById('weir_Y').value = pointDest.x.toFixed(4);
      document.getElementById('weir_X').value = pointDest.y.toFixed(4);
     } else {
      alert("Enter source coordinates");
      return;
     }
    }
    // ///////////////////////////////////////////////////////////
    function transformutm() {
     var crsSource = document.getElementById('crsSource');
     var projSource = null;
     //   console.log(crsSource.value);
           
     if (crsSource.value) {
      projSource = projHash["WGS84"];
      // projSource = projHash["EPSG:32647"];
     } else {
      alert("Select a source coordinate system");
      return;
     }
            
     var crsDest = document.getElementById('crsDest');
     //   console.log(crsDest.value);
     var projDest = null;
     if (crsDest.value) {
      //projDest = projHash["WGS84"];
      projDest = projHash["EPSG:32647"];
     } else {
      alert("Select a destination coordinate system");
      return;
     }
               
     var pointInputX = document.getElementById('weir_Y');
     var pointInputY = document.getElementById('weir_X');
     var pointInput = pointInputX.value+","+pointInputY.value;
                
     if (pointInputX.value) {
      var pointSource = new Proj4js.Point(pointInput);
      var pointDest = Proj4js.transform(projSource, projDest, pointSource);
      // console.log(pointDest.x);
      document.getElementById('weir_XUTM').value = pointDest.x.toFixed(0);
      document.getElementById('weir_YUTM').value = pointDest.y.toFixed(0);
     } else {
      alert("Enter source coordinates");
      return;
     }
    }
    // ///////////////////////////////////////////////////////////
  </script>
  <script>
      function myFunction() {
        confirm("คุณต้องการลบรูปฝายใช่ไหม?");
      }
  </script>
 </head>
 
 <body onload="initProj4js()">
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
                              <h3>แบบฟอร์มการกรอกข้อมูลพื้นที่รับน้ำ สภาพโดยรวมและแนวทางแก้ไขปรับปรุงเบื้องต้นของฝาย</h3>
                            </div>
                            <!-- form -->
                            <div class="card-block">
                              <div class="row">
                                <div class="col-md-12">
                                  <div id="wizard">
                                    <section>
                                    <form class="wizard-form" id="basic-forms" action="{{route('form.formexpert')}}" enctype="multipart/form-data" method="POST" onsubmit="return confirm('บันทึกข้อมูล เรียบร้อย !!');">
                                    <!-- <form class="wizard-form" id="basic-forms" action="{{route('form.formsubmit')}}" enctype="multipart/form-data" method="POST" onsubmit="return confirm('บันทึกข้อมูล เรียบร้อย !!');"> -->
                                        
                                        @csrf <!-- {{ csrf_field() }} -->   
                                        <?php
                                          function checkdata($val,$t) {
                                                if($val==$t){
                                                  $text='value='.$val.' checked';
                                                }else{
                                                  $text='value='.$val;
                                                }
                                              return $text;
                                          } 
                                        ?>

                                        <!-- -ข้อมูลทั่วไป -->
                                        <h3> ข้อมูลจากผู้เชี่ยวชาญ</h3>
                                        <fieldset>
                                          <div class="form-group row">
                                            <label class="col-sm-1 col-form-label">รหัส</label>
                                            <div class="col-sm-2">
                                              <input id="weir_code" name="weir_code" type="text" class=" form-control" value="{{$weir[0]->weir_code}}">
                                            </div>
                                            <label class="col-sm-1 col-form-label">ชื่อฝาย</label>
                                            <div class="col-sm-2">
                                              <input id="weir_name" name="weir_name" type="text" class=" form-control" value="{{$weir[0]->weir_name}}">
                                            </div>
                                            <label class="col-sm-1 col-form-label">ชื่อลำน้ำ</label>
                                            <div class="col-sm-2">
                                              <input id="river_name" name="river_name" type="text" class=" form-control" value="{{$river[0]->river_name}}">
                                            </div>
                                            <label class="col-sm-1 col-form-label" align="right">ลำน้ำสาขาของ</label>
                                            <div class="col-sm-2">
                                              <input id="river_branch" name="river_branch" type="text" class=" form-control" value="{{$river[0]->river_branch}}">
                                             </div>
                                          </div>
                                          <div class="form-group row">
                                            <label class="col-sm-1 col-form-label">หมู่บ้าน</label>
                                            <div class="col-sm-2">
                                              <input id="weir_village" name="weir_village" type="text" class=" form-control" value="{{$location[0]->weir_village}}">
                                            </div>
                                            <label class="col-sm-1 col-form-label">ตำบล</label>
                                            <div class="col-sm-2">
                                              <input id="weir_tumbol" name="weir_tumbol" type="text" class=" form-control" value="{{$location[0]->weir_tumbol}}">
                                            </div>
                                            <label class="col-sm-1 col-form-label">อำเภอ</label>
                                            <div class="col-sm-2">
                                              <input id="weir_district" name="weir_district" type="text" class=" form-control" value="{{$location[0]->weir_district}}">
                                            </div>
                                            <label class="col-sm-1 col-form-label" align="right">จังหวัด</label>
                                            <div class="col-sm-2">
                                              <input id="weir_province" name="weir_province" type="text" class=" form-control" value="{{$location[0]->weir_province}}">
                                             </div>
                                          </div>
                                          <!-- หน่วยงานรับผิดชอบ -->
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label">หน่วยงานรับผิดชอบ</label>
                                              <div class="col-sm-3">
                                                <input id="resp_name" name="resp_name" type="text" class=" form-control" value="{{$weir[0]->resp_name}}">
                                              </div>
                                              <label class="col-sm-2 col-form-label">รับถ่ายโอนจาก</label>
                                              <div class="col-sm-3">
                                                <input id="transfer" name="transfer" type="text" class=" form-control" value="{{$weir[0]->transfer}}">
                                              </div>
                                                                                    
                                            </div>

                                          <!-- ข้อมูลพื้นที่รับน้ำของฝาย -->
                                            <div class="form-group row">
                                              <div class="card-block button-list" style="margin-left:-40px;">
                                                <button type="button" class="btn btn-out waves-effect waves-light btn-inverse btn-square" > ข้อมูลพื้นที่รับน้ำของฝาย</button>
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label text-right">A : </label>
                                              <div class="col-sm-4">
                                                <input id="expert_A" name="expert_A" type="text" class=" form-control" value="{{$area->area}}"> 
                                              </div>
                                              <label class="col-sm-2 col-form-label">ตารางกิโลเมตร</label>                    
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label text-right">L : </label>
                                              <div class="col-sm-4">
                                                <input id="expert_L" name="expert_L" type="text" class="form-control" value="{{$area->L}}"> 
                                              </div>
                                              <label class="col-sm-2 col-form-label">กิโลเมตร</label>                    
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label text-right">LC : </label>
                                              <div class="col-sm-4">
                                                <input id="expert_LC" name="expert_LC" type="text" class=" form-control" value="{{$area->LC}}"> 
                                              </div>
                                              <label class="col-sm-2 col-form-label">กิโลเมตร</label>                    
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label text-right">H : </label>
                                              <div class="col-sm-4">
                                                <input id="expert_H" name="expert_H" type="text" class=" form-control" value="{{$area->H}}"> 
                                              </div>
                                              <label class="col-sm-2 col-form-label">เมตร</label>                    
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label text-right">S : </label>
                                              <div class="col-sm-4">
                                                <input id="expert_S" name="expert_S" type="text" class=" form-control" value="{{$area->S}}"> 
                                              </div>                  
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label text-right">C : </label>
                                              <div class="col-sm-4">
                                                <input id="expert_C" name="expert_C" type="text" class=" form-control" value="{{$area->c}}"> 
                                              </div>                  
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label text-right">I : </label>
                                              <div class="col-sm-4">
                                                <input id="expert_I" name="expert_I" type="text" class=" form-control" value="{{$area->I}}"> 
                                              </div>
                                              <label class="col-sm-2 col-form-label">มิลลิเมตร/ชั่วโมง</label>                    
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label text-right">Return period : </label>
                                              <div class="col-sm-4">
                                                <input id="expert_Returnperiod" name="expert_Returnperiod" type="text" class=" form-control" value="{{$area->Return_period}}"> 
                                              </div>
                                              <label class="col-sm-2 col-form-label">ปี</label>                    
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label text-right">อัตราการไหลสูงสุด = : </label>
                                              <div class="col-sm-4">
                                                <input id="expert_rate" name="expert_rate" type="text" class=" form-control" value="{{$area->flow}}"> 
                                              </div>
                                              <label class="col-sm-2 col-form-label">ลบ.ม./วินาที</label>                    
                                            </div>
                                         
                                                    
                                          <!-- สภาพโดยรวมของฝาย -->
                                            <div class="form-group row">
                                              <div class="card-block button-list" style="margin-left:-40px;">
                                                <button type="button" class="btn btn-out waves-effect waves-light btn-inverse btn-square" > สภาพโดยรวมของฝาย  </button>
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label text-right">สภาพโดยรวมของฝาย : </label>
                                              <div class="col-sm-8">
                                                <textarea id="expert_problem" name="expert_problem" type="text" class=" form-control" rows="15"> {{$expert->weir_problem}}</textarea>
                                              </div>                
                                            </div>


                                        <!-- แนวทางแก้ไขปรับปรุงเบื้องต้น -->
                                          <div class="form-group row">
                                                <div class="card-block button-list" style="margin-left:-40px;">
                                                  <button type="button" class="btn btn-out waves-effect waves-light btn-inverse btn-square" > แนวทางแก้ไขปรับปรุงเบื้องต้น  </button>
                                                </div>
                                              </div>
                                              <div class="form-group row">
                                                <label class="col-sm-2 col-form-label text-right">แนวทางแก้ไขปรับปรุงเบื้องต้น : </label>
                                                <div class="col-sm-8">
                                                  <textarea id="expert_solution" name="expert_solution" type="text" class=" form-control" rows="15" > {{$expert->weir_solution}}</textarea>
                                                </div>                
                                              </div>
                                        
                                          <br><br><br>
                                        </fieldset>

                                        <h3> ระดับสภาพฝาย </h3>
                                        <input id="improve_type" name="improve_type" type="text" class=" form-control" value="{{$improve_type}}" hidden>
                                        <fieldset>
                                            <div class="form-group row">
                                              <div class="card-block button-list" style="margin-left:-40px;margin-bottom:-30px;">
                                                <button type="button" class="btn btn-out waves-effect waves-light btn-inverse btn-square" > ระดับสภาพฝาย  </button>
                                              </div>
                                            </div>
                                            <div class="border-checkbox-section" >
                                              <div class="form-group row" style="margin-top:-20px;">
                                                <label class="col-sm-2 col-form-label ">ระดับสภาพฝาย  </label>
                                                  <div class="col-sm-2">
                                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                                      <input class="border-checkbox" type="checkbox" id="improve_1" name="improve_type_new" {{checkdata(1,$improve_type)}}>
                                                      <label class="border-checkbox-label" for="improve_1">ใช้งานได้</label>
                                                    </div>
                                                  </div>
                                                  <div class="col-sm-2">
                                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                                      <input class="border-checkbox" type="checkbox" id="improve_2" name="improve_type_new" {{checkdata(2,$improve_type)}}>
                                                      <label class="border-checkbox-label" for="improve_2">ควรปรับปรุง</label>
                                                    </div>
                                                  </div>   
                                                  <div class="col-sm-4">
                                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                                      <input class="border-checkbox" type="checkbox" id="improve_3" name="improve_type_new" {{checkdata(3,$improve_type)}}>
                                                      <label class="border-checkbox-label" for="improve_3">ควรรื้อถอนก่อสร้างใหม่</label>
                                                    </div>
                                                  </div> 
                                                                           
                                              </div>
                                            </div>                                          
                                        </fieldset>

                                        <h3> รูปภาพพื้นที่รับน้ำ </h3>
                                        <fieldset>
                                            <div class="form-group row">
                                              <div class="card-block button-list" style="margin-left:-40px;margin-bottom:-30px;">
                                                <button type="button" class="btn btn-out waves-effect waves-light btn-inverse btn-square" > แผนที่แสดงขอบเขตพื้นที่รับน้ำ  </button>
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <div class="field" align="center">
                                                    <img src='{{asset($expert->map)}}' width="50%"><br><br>
                                                    <div align="center">
                                                      <a href="{{ asset('/photoremovemap')}}/{{$expert->weir_code}}"  > 
                                                      <h3><link class="btn waves-effect waves-dark" onclick="myFunction()" title="delete">
                                                        <i class="icofont icofont-delete-alt"></i>ลบรูปภาพ
                                                      </link></h3>
                                                    </a>
                                                    </div>
                                                    

                                                    <!-- <h3><button class="btn waves-effect waves-dark btn-mini btn-danger btn-outline-danger " onclick="myFunction()" title="delete">
                                                      <i class="icofont icofont-delete-alt"></i> ลบรูปภาพ
                                                    </button></h3> -->
                                                    <br><br>
                                                    <h4>แก้ไข/เพิ่มเติมรูปภาพ</h4>
                                                    <h3><input type="file" id="water_system" name="water_system[]" multiple /> </h3>
                                               </div>
                                            </div>
                                            
                                        </fieldset>

                                        <h3> บันทึกข้อมูล </h3>
                                          <fieldset>
                                            <br>
                                            <div class="page-body">
                                              <div class="row">
                                                <div class="col-3"></div>
                                                <div class="col-6">
                                                  <div class="card o-visible">
                                                      <div class="card-header" align="center"> 
                                                          <h3>กรุณาตรวจสอบข้อมูล <br>ให้เรียบร้อยก่อนการบันทึก </h3>
                                                      </div>
                                                      <div class="card-block" align="center">
                                                        <img src="{{ asset('images/icon/green-check.jpg') }}" width="50%">
                                                        <br>
                                                        <button type="submit" class="btn waves-effect waves-light btn-primary btn-block" >บันทึกข้อมูล</button>
                                                      </div>
                                                  </div>
                                                </div>
                                              </div>

                                            </div>
                                          </fieldset>
                                                                                   
                                      </form>
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

          <div id="styleSelector">
          </div>
        </div>
      </div>
    </div>
  </div>

 <script src="{{ asset('js/form/jquery.min.js')}}"></script>
 <script src="{{ asset('js/form/jquery-ui.min.js')}}"></script>
 <script src="{{ asset('js/form/popper.min.js')}}"></script>
 <script src="{{ asset('js/form/bootstrap.min.js')}}"></script>

 <script src="{{ asset('js/form/waves.min.js')}}" ></script>
 <script src="{{ asset('js/form/jquery.slimscroll.js')}}"></script>

 <script src="{{ asset('js/form/modernizr.js')}}"></script>
 <script src="{{ asset('js/form/css-scrollbars.js')}}"></script>
 <script src="{{ asset('js/form/jquery.cookie.js')}}" ></script>
 <script src="{{ asset('js/form/jquery.steps.js')}}" ></script>
 <script src="{{ asset('js/form/jquery.validate.js')}}" ></script>

 <script src="{{ asset('js/form/underscore-min.js')}}" ></script>
 <script src="{{ asset('js/form/moment.min.js')}}" ></script>
 <script src="{{ asset('js/form/validate.js')}}"></script>

 <script src="{{ asset('js/form/form-wizard.js')}}" ></script>
 <script src="{{ asset('js/form/pcoded.min.js')}}" ></script>
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


</body>

</html>
