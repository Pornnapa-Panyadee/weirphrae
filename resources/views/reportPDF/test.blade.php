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
        font-size: 16px;
        }
        @page {
            size: A4;
            padding: 4px;
            }
        @media print {
            html, body {
                width: 210mm;
                height: 300mm;
                /*font-size : 16px;*/
            }
        }
        
        div.text {
                padding-top: -10px;
                line-height: 1;
        }
        .text1{
            font-size: 24px;
            text-align: center;
            font-weight: bold;
            line-height: 1;
        }
        .text2{
            font-size: 18px;
            text-align: center;
            font-weight: bold;
            margin-top: 5px;
            line-height:70%;
            
        }
        .text3{
            font-size: 18px;
            font-weight: bold;
            line-height:1;
        }
        .text4{
            line-height: 1;
            margin-left:30px;
        }
        .box{
            border: 1px solid #83748d;
            box-sizing: border-box;
            padding: 3px ;
            line-height: 1;            
        }
        p.text {
            font-weight: bold;
            padding-top: -15px;
            padding-bottom: -15px;
        }
        #textsurvey{
            padding-left: 12px;
            vertical-align: top;
        }
        table { 
            width:100%;
            background-color:transparent;
            border-collapse: collapse;
        }tr,td { 
            padding-top:-10px;
        }.line {
            border-bottom:1px #000 dotted;
            background: transparent;
            
        }.outline {
            border-bottom:5px #ffffff solid;
            background: transparent;            
            margin-left:-5px;
        }.table1{
            text-align: center;
        }.table2{
            width:100%;
            /* margin-bottom:1rem; */
            background-color:transparent;
            border-collapse: collapse;
            border: 1px solid #dddddd;
            font-size:14px;
            text-align: center;
            line-height:1;
        }.table2 tr{
            /* height:35px; */
            line-height:0.95;
            border-bottom: 2px solid #ddd;
        }.table3{
            margin-left:5px;
            font-size:14px;
            font-weight: bold;
            text-align: left;
            vertical-align: top;
        }#box {
            box-sizing: border-box;
            width: 2%;
            border: 1px solid #000;
            padding: 1px;  
            text-align:center;
            margin-left:5px;
            height:50px;
            width: 20px;
        }div.rowcode {
            width: 100%;
        }.textcode{
            font-size:16px;
            margin-top:-10px;
        }.page-break {
            page-break-after: always;
        }
    </style>
 </head>
    <body>
        <div class="pcoded-content">
            <table>
                <tr>
                    <td width="15%">
                        <img src="{{ url('/images/icon/egat.jpg') }}" width="37%">
                    </td>
                    <td width="70%">
                        <div class="text1"> แบบฟอร์มการตรวจสภาพฝาย</div>
                        <div class="text2">โครงการพัฒนาระบบการสำรวจและฐานข้อมูลเพื่อบริหารจัดการพื้นที่เสี่ยงภัยน้ำท่วมและภัยแล้ง 
                            <br>ระดับจังหวัดในพื้นที่ภาคเหนือตอนบน (ระยะที่ 1)
                            <br>โดย สถาบันสารสนเทศทรัพยากรน้ำ (องค์การมหาชน)  ร่วมกับ มหาวิทยาลัยเชียงใหม่</div>
                    </td>
                    <td width="15%"><img src="{{ asset('/images/icon/cmu.png') }}" width="60%" > </td>
                </tr>
                <tr>
                    <td colspan="3" class="text2">**************************************************************************************************************</td>
                </tr>
            </table>
        </div>
        <?php 
            $code=str_split($weir[0]->weir_code );
            echo $weir[0]->weir_code;
            echo $code[5];
        ?>
        <div class="text4" >
            <table>
              <tr>
                <td> รหัสหมู่บ้าน 
                    <font class="box" >0</font>
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">{{ $code[7]; }} </font>
                    <font class="box">{{ $code[8]; }}</font>
                    <font class="box">{{ $code[9];  }}</font>
                </td>
                <td> รหัสตำบล 
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box"><?php echo $code[5]  ?></font>
                    <font class="box"><?php echo $code[6]  ?></font>
                </td>
                <td> รหัสอำเภอ 
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box"><?php echo $code[3]  ?></font>
                    <font class="box"><?php {{$code[4];}} ?></font>
                </td>
                <td> รหัสจังหวัด 
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">5</font> 
                    <font class="box">7</font>
                </td>
              </tr>
            </table>
        </div>
        
    </body>
</html>
