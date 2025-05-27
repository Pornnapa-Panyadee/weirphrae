<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8">
    <title>Mae Jang Basin</title>

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

    <style type="text/css">
      #map{

			  font-family: Mitr, sans-serif;
			  height: 760px;
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
                              <h5>โครงการพัฒนาระบบการสำรวจและฐานข้อมูลเพื่อบริหารจัดการพื้นที่เสี่ยงภัยน้ำท่วมและภัยแล้ง ระดับจังหวัดในพื้นที่ภาคเหนือตอนบน (ระยะที่ 1) </h5>
                              <br>โดย สถาบันสารสนเทศทรัพยากรน้ำ (องค์การมหาชน)  ร่วมกับ มหาวิทยาลัยเชียงใหม่
                              <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                  <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                  <li><i class="feather icon-maximize full-card" title="ขยายแผนที่"></i></li>
                                  <li><i class="feather icon-refresh-cw reload-card" title="Reload แผนที่"></i></li>
                                  <li><i class="feather icon-chevron-left open-card-option"></i> </li>
                                </ul>
                              </div>
                              <!-- Map Show -->
                              <div class="card-block p-b-0">
                                <div id="map"></div>
                                <br>
                                <center><img  src="{{ asset('images/icon/refmap.png') }}" width=95%></center>
                              </div>

                              <!-- End Map show -->
                                                          
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
    <script async  src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    
    <script src="{{ asset('js/chooselocationHome.js')}}"></script>
    <script src="{{ asset('js/form/rocket-loader.min.js')}}"></script>
  
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

    <script src= "{{ asset('js/form/script.js') }}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" ></script>
  
    <script src="{{ asset('js/form/rocket-loader.min.js')}}" data-cf-settings="ce2668daaac54a74e9f6cdff-|49" defer=""></script>

    
    <!-- Map script -->
    <link rel="stylesheet" href="{{ asset('css/L.Control.Layers.Tree.css')}}" crossorigin=""/>
    <script src="{{ asset('/js/L.Control.Layers.Tree.js')}}"></script>

    <script type="text/javascript">
      var station1 = new L.LayerGroup();
      var x = {{$latlong->x}} ;
      var y = {{$latlong->y}};
      var mbAttr = 'CRFlood ',
          mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoidmFucGFueWEiLCJhIjoiY2loZWl5ZnJ4MGxnNHRwbHp5bmY4ZnNxOCJ9.IooQB0jYS_4QZvIq7gkjeQ';
          osm = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
              maxZoom: 20,subdomains:['mt0','mt1','mt2','mt3'], attribution: mbAttr });
          osmBw = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
                maxZoom: 20,subdomains:['mt0','mt1','mt2','mt3'], attribution: mbAttr });
      var map = L.map('map', {
          layers: [osm,station1],
          center: [x,y],
          zoom: 14,
        });
      
        var pin = L.icon({
          iconUrl: '{{ asset('images/icon/pin13.png') }}',
          iconRetinaUrl:'{{ asset('images/icon/pin13.png') }}',
          iconSize: [40, 40],
          iconAnchor: [20, 10],
          popupAnchor: [0, 0]
        });

      var pinMO = L.icon({
          iconUrl: '{{ asset('images/icon/pin13.png') }}',
          iconRetinaUrl:'{{ asset('images/icon/pin13.png') }}',
          iconSize: [30, 30],
          iconAnchor: [5, 30],
          popupAnchor: [0, 0]
        });
      var pinMOR = L.icon({
          iconUrl: '{{ asset('images/icon/pinr2.png') }}',
          iconRetinaUrl:'{{ asset('images/icon/pinr2.png') }}',
          iconSize: [70, 70],
          iconAnchor: [0, 30],
          popupAnchor: [35, -20]
        });
     
     var amp="{{$location[0]['weir_district']}}";
    //  alert (amp);
      
      function addPin(ampName,i,mo){
        
        $.getJSON("{{ asset('form/getDataSurvey')}}/"+amp, 
          function (data){
            // alert (data[0].lat);
            for (i=0;i<data.length;i++){
              // var lo =data[i].geometry.coordinates+ '';;
              var x=data[i].lat;
              var y=data[i].long;
              // alert (x);
              var text ="<font style=\"font-family: 'Mitr';\" size=\"3\"COLOR=#1AA90A > รหัส :" + data[i].weir_code + "</font><br>";
                  text1 ="<font style=\"font-family: 'Mitr';\" size=\"2\"COLOR=#466DF3 > ฝาย : "+ data[i].weir_name+ " (ลำน้ำ : "+ data[i].river+")</font><br>";
                  text2 ="<font style=\"font-family: 'Mitr';\" size=\"2\"COLOR=#466DF3 >ที่ตั้ง : "+ data[i].weir_village +" ต."+ data[i].weir_tumbol +" อ."+ data[i].weir_district +"</font><br>";
                  text3 ="<br><table align=\"center\"><tr>" +
                          "<td><a href='{{ asset('report/pdf') }}/" + data[i].weir_code + "' target=\"_blank\">" +
                          "<button class=\"btn btn-primary btn-sm waves-effect waves-light\">" +
                          "<i class=\"feather icon-sidebar\"></i> รายงาน</button></a></td>" +

                          "<td><a href='{{ asset('/pdf') }}/" + data[i].weir_code + "' target=\"_blank\">" +
                          "<button class=\"btn btn-primary btn-sm waves-effect waves-light\">" +
                          "<i class=\"feather icon-eye\"></i> แบบสำรวจ</button></a></td> </tr>" +

                          "<tr><td><a href='{{ asset('/photo') }}/" + data[i].weir_code + "' target=\"_blank\">" +
                          "<button class=\"btn btn-primary btn-sm waves-effect waves-light\">" +
                          "<i class=\"feather icon-image\"></i> ภาพประกอบ</button></a></td>" +

                          "<td><a href='https://maps.google.com/?q=" + data[i].lat + "," + data[i].long + "' target=\"_blank\">" +
                          "<button class=\"btn btn-primary btn-sm waves-effect waves-light\">" +
                          "<i class=\"feather icon-map-pin\"></i> นำทาง</button></a></td>" +

                          "</tr></table>";


            if(data[i].weir_code=='{{$weir[0]['weir_code']}}'){
              if(mo==0){
                L.marker([x,y],{icon: pinMOR}).addTo(ampName).bindPopup(text+text1+text2+text3);  
              }else{
                L.marker([x,y],{icon: pinMOR}).addTo(ampName).bindPopup(text+text1+text2+text3);  
              }
            }else{
                if(mo==0){
                L.marker([x,y],{icon: pinMO}).addTo(ampName).bindPopup(text+text1+text2+text3);  
              }else{
                L.marker([x,y],{icon: pin}).addTo(ampName).bindPopup(text+text1+text2+text3);  
              }
            }
            }//end for
          });
        
        
        
      }

      
      var mx = window.matchMedia("(max-width: 700px)");
      if(mx.matches){
        mo=0;
        // alert(x.matches);
      }else{
        mo=1;
      }
           
      addPin(station1,0,mo);


      var baseTree = {
          label: 'BaseLayers',
          noShow: true,
          children: [  {label: ' แผนที่ภูมิประเทศ (Streets)', layer: osm},
                       {label: ' แผนที่ภาพถ่ายผ่านดาวเทียม (Satellite)', layer: osmBw},
          ]
        };


        var ctl = L.control.layers.tree(baseTree, null);
        ctl.addTo(map).collapseTree().expandSelected();

    
      var overlays = [{
          label: ' อำเภอ',
          selectAllCheckbox: true,
          children: [
                { label:" "+amp,layer: station1}
          ]
        }];
        
        ctl.setOverlayTree(overlays).collapseTree(true).expandSelected(true);
    </script>

  
    <!-- End Map  -->
  </body>

</html>
