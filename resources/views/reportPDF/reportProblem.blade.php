<!DOCTYPE html>
<html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Weir Report</title>
    <style>
        @font-face{
        font-family:  'THSarabunNew';
        font-style: normal;
        font-weight: normal;
        src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        body{
        font-family: "THSarabunNew";
        font-size: 14px;
        line-height:1;
        }
        @page {
            size: A4 landscape;
            margin: 15px;
        }
        @media print {
            html, body {
                width: 210mm;
                height: 300mm;
                /*font-size : 16px;*/
            }
        }html, body {
			background-color: #fff;
			color: #000000;
			font-family: "THSarabunNew";
		}.position-ref {
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
		.table{
            width:100%;
            /* margin-bottom:1rem; */
            background-color:transparent;
            border-collapse: collapse;
        }
        td {
            border: 1px black solid;
            text-align: center;
        }
        .checkmark{
            display:inline-block;
            content: '';
            width: 3px;
            height: 10px;
            border: solid #000;
            border-width: 0 1px 1px 0;
            transform: rotate(40deg);
            margin-left: 10px;
        }
        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 0.4cm;
            color:#000;
            /* text-align: right; */
            /* line-height: 1.5cm; */
            content: counter(page);
        }
        .fleft {
            text-align: left;
        }

        .fright { 
            text-align: right;
        }
        #footer {
            max-width: 980px;
            text-align: center;
            margin: auto;
        }

        .copyright {
            float: left;
        }

        .social {
            float: right;
        }
        .text{
            margin-left: 3px;
            text-align: left;
            vertical-align: top;
        }
    </style>
 </head>
    <body>
        <!-- <div class="row" align="center" style="page-break-after:always;"> 
            <img src="{{ asset('images/header_pages/'.$amp.'.jpg') }}" width="105%"> 
        </div> -->
        <footer>
           
            <div class="social"><u>หมายเหตุ</u> ข้อมูลใช้เพื่อการศึกษาวางแผน ไม่สามารถใช้อ้างอิงทางกฎหมายและคดีความ </div>
            <div style="clear: both"></div>
        </footer>
        <?php 
            // function score($t,$s,$sc){
            //     if ($t == $s){ return $sc; }
            // }
            function score($t, $s){
                if ($t == $s){  echo "<div class=\"checkmark\"></div>";}
            }
            function score_level($t, $s){
                if ($t == $s){
            
                    return "/";
                }
            }
        ?>
        
        <div class="text1">
            <table class="table table-bordered">
                <thead align="center" >
                    <tr style="background-color:#C0C0C0">
                        <td rowspan="2" class="text-center">#</td>
                        <td rowspan="2" class="text-center">รหัส</td>
                        <td rowspan="2"> ชื่อฝาย / (ชื่อลำน้ำ) </td>
                        <td rowspan="2"> หมู่บ้าน / ตำบล</td>
                        <td colspan="2">พิกัด</td>
                        <td rowspan="2">สภาพปัญหา</td>
                        <td rowspan="2">แนวทางการแก้ไขเบื้องต้น</td>
                        <td rowspan="2">หน่วยงาน<br>รับผิดชอบ</td>
                        <td rowspan="2">รับโอน<br>ถ่ายจาก</td>
                    </tr>
                    <tr>
                        <td>ละติจูด</td>
                        <td>ลองจิจูด</td>
                    </tr>
                  
                </thead>
                <tbody>
                    <?php 
                    $num =count($result);
                    for($i=0;$i<$num;$i++){?>
                    <tr>
                        <td >{{$i+1}}</td>
                        <td width="7%">{{$result[$i]['weir_code']}}</td>
                        <td width="8%">{{$result[$i]['weir_name']}} <br> ({{$result[$i]['river']}})</td>
                        <td width="8%">{{$result[$i]['weir_village']}} / {{$result[$i]['weir_tumbol']}}</td>
                        <td width="4%">{{$result[$i]['lat']}}</td>
                        <td width="4%">{{$result[$i]['long']}}</td>
                        <td class="text" width="28%">{{$result[$i]['problem']}}</td>
                        <td class="text">{{$result[$i]['solution']}}</td>
                        <td>{{$result[$i]['resp_name']}}</td>
                        <td>{{$result[$i]['transfer']}}</td>
                    </tr>

                    <?php }?>
                </tbody>
            </table>
        </div>
        
    </body>
</html>
