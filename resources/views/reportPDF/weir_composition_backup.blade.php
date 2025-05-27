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
            margin: 5px;
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
		.title {
			font-size:15px;
		}
		.m-b-md {
			/* margin-bottom: 2px; */
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
        .rotatehead {
            transform: rotate(-90deg);
            /* padding-left: -20px; */
        }
        .rotate {
            font-size: 9px;
            transform: rotate(-90deg);
            /* padding-left: -20px; */
        }
        .text_rote{
            width: 20px;
            height: 40px;
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

        h3 {

        font-family: 'Source Sans Pro', sans-serif;
                    text-transform:uppercase;
                    font-weight : 300;
                    font-size : 14px;
                    color : #000;

        }

        .copyright {
            float: left;
        }

        .social {
            float: right;
        }
        .customers {
            border-collapse: collapse;
            border: 4px solid #fff;
            border-color: #fff;
        }
    </style>
 </head>
    <body>
        <div class="row" align="center" style="page-break-after:always; margin-top:40px;"> 
            <table align="center" class="customers" width="80%">
                <tr >
                    <td width="10%" class="customers">
                        <img src="{{ asset('images/footer/lampang.png') }}" width="100%">
                    </td>
                    <td width="20%" align="left">
                        <img src="{{ asset('images/footer/egat.jpg') }}" width="100%">
                    </td>
                    <td width="30%" class="customers"><font style="font-size:70px;"><b>รายงานสรุป</b></font></td>
                    <td width="30%" class="customers" align="right"><img src="{{ asset('images/footer/cmu.png') }}" width="90px;"></td>
                </tr>

                <tr>
                    <td colspan="4" height=100px; class="customers"> <font style="font-size:42px;"><b>ผลการตรวจประเมินสภาพฝายแต่ละองค์ประกอบ</b></td>
                </tr>
                <tr>
                    <td colspan="4" height=200px; class="customers"> <font style="font-size:50px;"><b>{{$text_amp}}  จังหวัดเชียงใหม่</b></td>
                </tr>
                <tr>
                    <td colspan="4" class="customers"> <font style="font-size:32px;"><b>โครงการพัฒนาระบบสารสนเทศการตรวจประเมินสภาพฝายและวางแผนปรับปรุงเพิ่มประสิทธิภาพฝาย<b></td>
                </tr>
                <tr>
                    <td colspan="4" class="customers"> <font style="font-size:32px;"><b>ในพื้นที่ลุ่มน้ำแม่จาง จังหวัดเชียงใหม่<b></td>
                </tr>
                <tr>
                    <td colspan="4" height=100px;> <font style="font-size:26px;"><b>โดยการไฟฟ้าฝ่ายผลิตแห่งประเทศไทย (กฟผ) แม่เมาะ ร่วมกับมหาวิทยาลัยเชียงใหม่<b></td>
                </tr>
            </table>
            <!-- <img src="{{ asset('images/header_pages/'.$amp.'.jpg') }}" width="105%">  -->

        </div>
        <footer>
            <div class="copyright">*** <b>สภาพดี :</b> สภาพปกติ , <b>สภาพค่อนข้างดี :</b> ซ่อมแซมเล็กน้อย , <b>สภาพปานกลาง :</b> ควรซ่อมแซม , <b>สภาพทรุดโทรม :</b> ซ่อมแซมทันที/สร้างใหม่</div>
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
            function changeText($t){
                if($t==1){
                    return "ใช้งานได้";
                }else if($t==2){
                    return "ควรปรับปรุง";
                }else if($t==3){
                    return "ควรลื้อถอน";
                }else{
                    return "-";
                }
            }
        ?>
        
        <div class="text1">
            <table class="table table-bordered">
                <thead align="center" >
                    <tr style="background-color:#C0C0C0">
                        <td rowspan="3" class="text-center">#</td>
                        <td rowspan="3" class="text-center">รหัส</td>
                        <td rowspan="3"> ชื่อฝาย <br> (ชื่อลำน้ำ) </td>
                        <td rowspan="3"> หมู่บ้าน <br> ตำบล</td>
                        <td colspan="2"> พิกัด</td>
                        <td colspan="18">สภาพของฝายแต่ละองค์ประกอบ</td>
                        <td rowspan="3"> <div class='rotatehead'> สภาพฝาย </div></td>
                        <td rowspan="3">หน่วยงาน<br>รับผิดชอบ</td>
                        <td rowspan="3">รับโอน<br>ถ่ายจาก</td>
                    </tr>
                    <tr>
                        <td rowspan="2"><div class='rotatehead'> ละติจูด </div></td>      
                        <td rowspan="2"><div class='rotatehead'> ลองจิจูด </div></td>     
                        <td colspan="3">ส่วน Protection เหนือน้ำ</td>
                        <td colspan="3">ส่วนเหนือน้ำ</td>
                        <td colspan="3">ส่วนควบคุมน้ำ</td>
                        <td colspan="3">ส่วนท้ายน้ำ</td>
                        <td colspan="3">ส่วน Protection ท้ายน้ำ</td>
                        <td colspan="3">ระบบส่งน้ำ</td>
                    </tr>
                    <tr>
                        <td class="text_rote"> <div class='rotate'> ใช้งานได้ </div></td>
                        <td class="text_rote"><div class='rotate'> ควรปรับปรุง </div></td>
                        <td class="text_rote"><div class='rotate'>ควรรื้อถอน </div> </td>
                        <td class="text_rote"> <div class='rotate'> ใช้งานได้ </div></td>
                        <td class="text_rote"><div class='rotate'> ควรปรับปรุง </div></td>
                        <td class="text_rote"><div class='rotate'>ควรรื้อถอน </div> </td>
                        <td class="text_rote"> <div class='rotate'> ใช้งานได้ </div></td>
                        <td class="text_rote"><div class='rotate'> ควรปรับปรุง </div></td>
                        <td class="text_rote"><div class='rotate'>ควรรื้อถอน </div> </td>
                        <td class="text_rote"> <div class='rotate'> ใช้งานได้ </div></td>
                        <td class="text_rote"><div class='rotate'> ควรปรับปรุง </div></td>
                        <td class="text_rote"><div class='rotate'>ควรรื้อถอน </div> </td>
                        <td class="text_rote"> <div class='rotate'> ใช้งานได้ </div></td>
                        <td class="text_rote"><div class='rotate'> ควรปรับปรุง </div></td>
                        <td class="text_rote"><div class='rotate'>ควรรื้อถอน </div> </td>
                        <td class="text_rote"> <div class='rotate'> ใช้งานได้ </div></td>
                        <td class="text_rote"><div class='rotate'> ควรปรับปรุง </div></td>
                        <td class="text_rote"><div class='rotate'>ควรรื้อถอน </div> </td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if($dataNo==1){ ?>
                        <tr>
                            <td colspan="34">------- ไม่มีข้อมูล -------</td>
                        </tr> 
                    <?php }
                    else{
                        $num =count($result);
                        for($i=0;$i<$num;$i++){?>
                        <tr>
                            <td >{{$i+1}}</td>
                            <td>{{$result[$i]['weir_code']}}</td>
                            <!-- <td>{{wordwrap($result[$i]['weir_name'],15,"\n")}}</td>  -->
                            <td>{{$result[$i]['weir_name']}} <br> ({{$result[$i]['river']}}) </td>
                            <td>{{$result[$i]['weir_village']}} <br> {{$result[$i]['weir_tumbol']}}</td>
                            <!-- <td>{{$result[$i]['weir_district']}}</td> -->
                            <td>{{$result[$i]['lat']}}</td>
                            <td>{{$result[$i]['long']}}</td>
                            <td>{{score($result[$i]['damage_1'],1) }}</td>
                            <td>{{score($result[$i]['damage_1'],2)}}</td>
                            <td>{{score($result[$i]['damage_1'],3)}}</td>

                            <td>{{score($result[$i]['damage_2'],1)}}</td>
                            <td>{{score($result[$i]['damage_2'],2)}}</td>
                            <td>{{score($result[$i]['damage_2'],3)}}</td>

                            <td>{{score($result[$i]['damage_3'],1)}}</td>
                            <td>{{score($result[$i]['damage_3'],2)}}</td>
                            <td>{{score($result[$i]['damage_3'],3)}}</td>

                            <td>{{score($result[$i]['damage_4'],1)}}</td>
                            <td>{{score($result[$i]['damage_4'],2)}}</td>
                            <td>{{score($result[$i]['damage_4'],3)}}</td>

                            <td>{{score($result[$i]['damage_5'],1)}}</td>
                            <td>{{score($result[$i]['damage_5'],2)}}</td>
                            <td>{{score($result[$i]['damage_5'],3)}}</td>

                            <td>{{score($result[$i]['damage_6'],1)}}</td>
                            <td>{{score($result[$i]['damage_6'],2)}}</td>
                            <td>{{score($result[$i]['damage_6'],3)}}</td>

                            <td>{{ changeText($result[$i]['classSum'])}}</td>
                            <td>{{ wordwrap($result[$i]['resp_name'],5, "<br/>\n")}}</td> 
                            <td>{{ wordwrap($result[$i]['transfer'],5, "\n")}}</td> 
                        </tr>

                        <?php }
                    } ?>

                </tbody>
            </table>
        </div>
    </body>
</html>
