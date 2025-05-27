<!DOCTYPE html>
<html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Weir | PDF Form </title>
     <link rel="icon" href="images/icon/favicon1.ico" type="image/x-icon">
    <style>
        @font-face{
        font-family:  'THSarabunNew';
        font-style: normal;
        font-weight: normal;
        src: url("fonts/THSarabunNew.ttf") format('truetype');
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
            border: 1px solid #000;
        }.table2{
            width:100%;
            /* margin-bottom:1rem; */
            background-color:transparent;
            border-collapse: collapse;
            border: 1px solid #000;
            font-size:14px;
            text-align: center;
            line-height:1;
        }.table2 tr{
            /* height:35px; */
            line-height:0.95;
            border-bottom: 1px solid #000;
        }tr.noBorder > td, td.noBorder {
            border-style:hidden;
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
                    <img src="images/footer/hii.png" width="80%">
                </td>
                <td width="70%">
                    <div class="text1"> แบบฟอร์มการตรวจประเมินสภาพฝาย</div>
                    <div class="text2">โครงการพัฒนาระบบการสำรวจและฐานข้อมูลเพื่อการบริหารจัดการพื้นที่เสี่ยงภัยน้ำท่วมและภัยแล้ง
                        <br>ระดับจังหวัดในพื้นที่ภาคเหนือตอนบน (ระยะที่ 1)
                         <br>โดย สถาบันสารสนเทศทรัพยากรน้ำ (องค์การมหาชน) ร่วมกับ มหาวิทยาลัยเชียงใหม่ </div>
                </td>
                <td width="15%">
                    <img src="images/icon/cmu.png" width="80%" >
                </td>
            </tr>
            <tr>
                <td colspan="3" class="text2">**************************************************************************************************************</td>
            </tr>
        </table>
        <?php 
            ini_set('max_execution_time', 300);
            $level=["น้อย","ปานกลาง","มาก"];
            $code=str_split($weir[0]->weir_code );
            $text= explode(" ",$location[0]->weir_village);
            $moo = $text[1];
            $tambol=$text[2];
            $s_lat=str_split($locationUTM->x);
            $s_lng=str_split($locationUTM->y);

            function checkphoto($text){
                if($text!=NULL){
                    echo "<img src='{$text}'  width=110px; style='margin:0 0 -10 10px;'>";
                }else{ echo "";}	
            }
            function check4($text,$r) {

                if($text==$r){
                    echo "<img src='images/icon/check1.png'  width=15px;>";		
                }else{
                     echo "";	
                }
            }
            function checkCuase($text) {
                
                if($text!=NULL){ echo "<img src='images/logo/check.png'  width=15px;>";
                }else{echo "<img src='images/logo/square.png'  width=15px;>";}
            }
            function checkHas($text) {
                if($text==1){echo "<img src='images/logo/check.png'  width=15px;>";	
                }else{echo "<img src='images/logo/square.png'  width=15px;>"; }
            }
            function checkZero($t) {                
                if($t==2){echo "<img src='images/logo/check.png'  width=15px;>";	
                }else{echo "<img src='images/logo/square.png'  width=15px;>";}
            } 
            function checkpair($text,$i) {
                if($i==$text){echo "<img src='images/logo/check.png'  width=15px;>";	
               }else{ echo "<img src='images/logo/square.png'  width=15px;>";	
               } 
            }
            function checkresp_type($val,$type,$i) {
                if($i==$type){
                    $text= $val;
                }else{
                    $text='';
                }
                return $text;
            }
            function DateTimeThai($strDate){
                $strYear = (date("Y",strtotime($strDate)))+543;
                $strMonth= date("n",strtotime($strDate));
                $strDay= date("j",strtotime($strDate));
                $strMonthCut =  Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
                $strMonthThai=$strMonthCut[$strMonth];
                return "$strDay $strMonthThai $strYear ";
            }
            
            
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
                    <font class="box"><?php echo $code[7]; ?></font>
                    <font class="box"><?php echo $code[8]; ?></font>
                    <font class="box"><?php echo $code[9]; ?></font>
                </td>
                <td> รหัสตำบล 
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box"><?php echo $code[5]; ?></font>
                    <font class="box"><?php echo $code[6]; ?></font>
                </td>
                <td> รหัสอำเภอ 
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box"><?php echo $code[3]; ?></font>
                    <font class="box"><?php echo $code[4]; ?></font>
                </td>
                <td> รหัสจังหวัด 
                    <font class="box">0</font>
                    <font class="box">0</font>
                    <font class="box">5</font> 
                    <font class="box">2</font>
                </td>
              </tr>
            </table>
        </div>
        <table align="right">
            <tr align="right">
                <td>รหัสฝาย : <?php echo $weir[0]->weir_code ?> &nbsp;  </td>
            </tr>
        </table>
        
        <div class="text" >
            
          <table>
            <tr>
                <td class="line"><font class="outline">ผู้ตรวจสอบ&nbsp;&nbsp;</font>&nbsp;&nbsp;<?php echo $weir[0]->survey_name; ?> &nbsp;</td>
                <td colspan="2" class="line"><font class="outline"> วัน/เดือน/ปี </font> &nbsp;&nbsp;<?php echo DateTimeThai($weir[0]->survey_date); ?> &nbsp;&nbsp; </td>
                <td class="line"><font class="outline">ตำแหน่ง </font> &nbsp;&nbsp; <?php echo $weir[0]->survey_position ?> &nbsp;&nbsp;  </td>
                <td class="line"><font class="outline">หน่วยงาน </font> &nbsp;&nbsp; <?php echo $weir[0]->survey_unit ?>  &nbsp;&nbsp;  </td>
            </tr>
          </table>
          <table>
            <tr>
                <td class="line"><font class="outline">ตำแหน่งที่&nbsp;&nbsp;</font>&nbsp;&nbsp;&nbsp;</td>
                <td colspan="2" class="line"><font class="outline"> ชื่อฝาย </font> &nbsp;&nbsp;<?php echo $weir[0]->weir_name ?>&nbsp;&nbsp; </td>
                <td class="line"><font class="outline">ชื่อลำน้ำ </font> &nbsp;&nbsp;<?php echo $river[0]->river_name ?> &nbsp;&nbsp;  </td>
                <td class="line"><font class="outline">ลำน้ำสาขาของ </font> &nbsp;&nbsp;<?php echo $river[0]->river_branch	?> &nbsp;&nbsp;  </td>
            </tr>
          </table>
          <table>
            <tr>
                <td width="20%" class="line"><font class="outline">ก่อสร้าง เมื่อปี พ.ศ.&nbsp;&nbsp;</font>&nbsp;&nbsp;<?php echo ($weir[0]->weir_build) ?> &nbsp;</td>
                <td width="15%" class="line"><font class="outline"> อายุฝาย </font> &nbsp;&nbsp;<?php echo $weir[0]->weir_age ?> &nbsp;&nbsp; </td>
                <td width="14%" ><?php checkCuase($model->self->weir_self) ?> &nbsp;&nbsp;ออกแบบเอง &nbsp;&nbsp;  </td>
                <td width="15%"> <?php checkCuase($model->self->weir_std) ?> &nbsp;&nbsp;ใช้แบบมาตราฐาน &nbsp;&nbsp;  </td>  
                <td width="15%" class="line">&nbsp;&nbsp; <?php echo $model->self->std_detial ?>&nbsp;&nbsp; &nbsp;.</td>
            </tr>
          </table>
          <table>
            <tr>
                <td width="40%"> &nbsp;</td>
                <td width="30%" class="outline"><?php checkCuase($model->self->villager) ?> &nbsp;&nbsp;ก่อสร้างเองโดยใช้แรงงานชาวบ้าน ใช้งบของ &nbsp;  </td>
                <td width="20%" class="line"> &nbsp;&nbsp;<?php echo $model->self->villager_detial ?> </td>
            </tr>
          </table>

          <table >  
            <tr>
                <td width="20%" ><font class="outline"> หน่วยงานรับผิดชอบ</font></td>
                <td width="20%" ><?php checkpair($weir[0]->Resp_type,1)?> &nbsp;&nbsp;หน่วยงานตามภารกิจ &nbsp;&nbsp;  </td>
                <td width="25%" class="line" colspan=3> <?php echo checkresp_type($weir[0]->resp_name,$weir[0]->Resp_type,1) ?> </td>
                
            </tr>
            <tr>
                <td width="20%" ><font class="outline"> </font></td>
                <td width="20%" ><?php checkpair($weir[0]->Resp_type,2) ?> &nbsp;&nbsp;หน่วยงานท้องถิ่น &nbsp;&nbsp;  </td>
                <td width="25%" class="line"><?php echo checkresp_type($weir[0]->resp_name,$weir[0]->Resp_type,2) ?> </td> -->
                <td width="10%" >&nbsp;รับถ่ายโอนมาจาก </td> 
                <td width="25%" class="line"> <?php echo $weir[0]->transfer  ?> </td>
            </tr>
            <tr>
                <td width="20%" ><font class="outline"> </font></td>
                <td width="20%" ><?php checkpair($weir[0]->Resp_type,3)?> &nbsp;&nbsp;อื่นๆ &nbsp;&nbsp;  </td>
                <td width="25%" class="line" colspan=3><?php echo checkresp_type($weir[0]->resp_name,$weir[0]->Resp_type,3) ?> </td>
                
            </tr>   
          </table>
        </div>
        <div class="text">
            <div class="text3">1. ลักษณะทั่วไป </div>
            <div class="text4">1.1 ประเภทลำน้ำ</div>
                <table style="padding-left:50px;">
                    <tr>
                        <td width=25%><?php checkpair($river[0]->river_type,"แม่น้ำสายหลัก")?>&nbsp;แม่น้ำสายหลัก</td>
                        <td width=25%><?php checkpair($river[0]->river_type,"แม่น้ำสาขา") ?>&nbsp;แม่น้ำสาขา</td>
                        <td width=25%><?php checkpair($river[0]->river_type,"ลำห้วย") ?>&nbsp;ลำห้วย</td>
                        <td width=25%><?php checkpair($river[0]->river_type,"ลำเหมือง") ?>&nbsp;ลำเหมือง</td>
                    </tr>
                </table>
            <div class="text4">1.2 ที่ตั้งพิกัดฝายที่ตรวจสอบ</div>
                <table style="padding-left:50px;">
                    <tr>
                        <td width=15% class="line"><font class="outline">หมู่ที่&nbsp;&nbsp;</font>&nbsp;&nbsp;<?php echo $moo?>&nbsp;</td>
                        <td width=25% class="line"><font class="outline">&nbsp;ชื่อหมู่บ้าน&nbsp;&nbsp;</font>&nbsp;&nbsp;  <?php echo $tambol?>&nbsp;</td>
                        <td width=25% class="line"><font class="outline">&nbsp;ตำบล &nbsp;&nbsp;</font>&nbsp;&nbsp;<?php echo $location[0]->weir_tumbol?>&nbsp;</td>
                        <td width=25% class="line"><font class="outline">&nbsp;จังหวัด&nbsp;&nbsp;</font>&nbsp;&nbsp;ลำปาง</td>
                    </tr>
                </table>
                <div style="padding-left:50px; margin-top:10px;"> พิกัด X (UTM)
                    <span class="box"><?php echo $s_lat[0]?></span> 
                    <font class="box"><?php echo $s_lat[1]?></font>
                    <font class="box"><?php echo $s_lat[2]?></font>
                    <font class="box"><?php echo $s_lat[3]?></font>
                    <font class="box"><?php echo $s_lat[4]?></font>
                    <font class="box"><?php echo $s_lat[5]?></font>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    พิกัด Y (UTM)
                    <span class="box"><?php echo $s_lng[0]?></span> 
                    <font class="box"><?php echo $s_lng[1]?></font>
                    <font class="box"><?php echo $s_lng[2]?></font>
                    <font class="box"><?php echo $s_lng[3]?></font>
                    <font class="box"><?php echo $s_lng[4]?></font>
                    <font class="box"><?php echo $s_lng[5]?></font>
                    <font class="box"><?php echo $s_lng[6]?></font>
                </div> 
            <div class="text4">1.3 ประเภทของสันฝาย</div>
                <table style="padding-left:50px;">
                    <tr>
                        <td width=15%><?php checkpair($space[0]->ridge_type->type,"ฝายสันมน")?>&nbsp;ฝายสันมน</td>
                        <td width=15%><?php checkpair($space[0]->ridge_type->type,"ฝายไหลตกตรง") ?>&nbsp;ฝายไหลตกตรง</td>
                        <td width=15%><?php checkpair($space[0]->ridge_type->type,"ฝายสันกว้าง") ?>&nbsp;ฝายสันกว้าง</td>
                        <td width=15%><?php checkpair($space[0]->ridge_type->type,"ฝายหินทิ้ง") ?>&nbsp;ฝายหินทิ้ง</td>
                        <td width=15%><?php checkpair($space[0]->ridge_type->type,"ฝายประตูระบาย") ?>&nbsp;ฝายประตูระบาย</td>
                        <td width=8%><?php checkpair($space[0]->ridge_type->type,"อื่นๆ") ?>&nbsp;อื่นๆ</td>
                        <td width=20% class="line"><?php echo $space[0]->ridge_type->detail?></td>
                    </tr>
                </table>
                <table style="padding-left:50px;">
                    <tr>
                        <td width=20% class="line"><font class="outline">ความสูงสัน</font> &nbsp;&nbsp;<?php echo $space[0]->ridge_height;?> </td>
                        <td width=10%> เมตร </td>
                        <td width=20% class="line"><font class="outline">ความกว้างสัน</font> &nbsp;&nbsp;<?php echo $space[0]->ridge_width?> </td>
                        <td> เมตร </td>
                       
                    </tr>
                </table>
            <div class="text4">1.4 ประตูระบายน้ำ/ระบายทราย &nbsp;&nbsp;&nbsp;<?php checkHas($space[0]->gate_has)?>&nbsp;มี&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php checkZero($space[0]->gate_has)?> ไม่มี </div>   
                <table style="padding-left:70px;">
                    <tr>
                        <td width=15% >ชนิดบานประตู </td>
                        <td width=15%><?php checkpair($space[0]->gate_type,"บานตรง")?>&nbsp;บานตรง</td>
                        <td width=20%><?php checkpair($space[0]->gate_type,"บานโค้ง") ?>&nbsp;บานโค้ง</td>
                        <td width=25% class="line"><font class="outline">ขนาด (กว้าง x สูง)</font> &nbsp;&nbsp;<?php echo $space[0]->gate_dimension->size?> </td>
                        <td> เมตร </td>
                        <td width=10% class="line" ><font class="outline">จำนวน</font>&nbsp;<?php echo $space[0]->gate_dimension->num?> </td>
                        <td> ชุด </td>
                    </tr>
                </table>
                <table style="padding-left:70px;">
                    <tr>
                        <td width=15% >ชนิดเครื่องยกบาน </td>
                        <td width=15%><?php checkHas($space[0]->gate_machanic_has)?>&nbsp;มี</td>
                        <td width=20%><?php checkZero($space[0]->gate_machanic_has)?>&nbsp;ไม่มี</td>
                        <td width=25%></td>
                        <td ></td>
                        <td width=10%></td>
                        <td ></td>
                    </tr>
                </table>
                <table style="padding-left:70px;">
                    <tr>
                        <td width=15% > </td>
                        <td width=15%><?php checkpair($space[0]->gate_machanic_type,"รอกโซ่")?>&nbsp;รอกโซ่</td>
                        <td width=20%><?php checkpair($space[0]->gate_machanic_type,"เครื่องกว้านคันชัก")?>&nbsp;เครื่องกว้านคันชัก</td>
                        <td width=25%><?php checkpair($space[0]->gate_machanic_type,"เครื่องกว้านม้วนลวด")?>&nbsp;เครื่องกว้านม้วนลวด</td>
                        <td ></td>
                        <td width=10%></td>
                        <td ></td>
                    </tr>
                </table>
            <div class="text4">1.5 อาคารบังคับน้ำ &nbsp;&nbsp;&nbsp;<?php checkHas($space[0]->control_building_has)?>&nbsp;มี&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php checkZero($space[0]->control_building_has)?> ไม่มี</div>  
                <table style="padding-left:70px;">
                    <tr>
                        <td width=15% ><?php checkCuase($space[0]->control_building_type->open->type)?>&nbsp;แบบปิด </td>
                        <td width=15%><?php checkCuase($space[0]->control_building_type->open->left)?>&nbsp;ฝั่งซ้าย</td>
                        <td width=20%><?php checkCuase($space[0]->control_building_type->open->right) ?>&nbsp;ฝั่งขวา</td>
                        <td width=25% ></td>
                        <td></td>
                        <td width=10%  > </td>
                        <td></td>
                    </tr>
                </table>
                <table style="padding-left:70px;">
                    <tr>
                        <td width=15% ></td>
                        <td width=20%  class="line" ><font class="outline">ขนาดฝาท่อปิด </font>&nbsp;&nbsp;<?php echo $space[0]->conttrol_building_loc->size?></td>
                        <td>เมตร</td>
                        <td width=20%  class="line" ><font class="outline">ความยาวท่อ</font>&nbsp;&nbsp;<?php echo $space[0]->conttrol_building_loc->long?> </td>
                        <td>เมตร</td>
                        <td width=20% class="line" ><font class="outline">ระดีบธรณีประตู </font>&nbsp;&nbsp;<?php echo $space[0]->conttrol_building_loc->base?> </td>
                        <td>เมตร</td>
                    
                    </tr>
                </table>
                <table style="padding-left:70px;">
                    <tr>
                        <td width=15% ><?php checkCuase($space[0]->control_building_type->close->type)?>&nbsp;แบบเปิด </td>
                        <td width=15%><?php checkCuase($space[0]->control_building_type->close->left)?>&nbsp;ฝั่งซ้าย</td>
                        <td width=20%><?php checkCuase($space[0]->control_building_type->close->right) ?>&nbsp;ฝั่งขวา</td>
                        <td width=25% ></td>
                        <td></td>
                        <td width=10%  > </td>
                        <td></td>
                    </tr>
                </table>
                <table style="padding-left:70px;">
                    <tr>
                        <td width=15% ></td>
                        <td width=10% >บานประตู</td>
                        <td width=10% ><?php checkHas($space[0]->control_building_gate_has)?>&nbsp;มี</td>
                        <td width=10% ><?php checkZero($space[0]->control_building_gate_has)?> &nbsp;ไม่มี</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width=15% ></td>
                        <td width=10% ></td>
                        <td width=10% ><?php checkpair($space[0]->control_building_gate_type,"บานตรง")?>&nbsp;บานตรง</td>
                        <td width=10% ><?php checkpair($space[0]->control_building_gate_typee,"บานโค้ง")?> &nbsp;บานโค้ง</td>
                        <td width=25% class="line"><font class="outline">ขนาด (กว้าง x สูง)</font> &nbsp;&nbsp;<?php echo $space[0]->control_building_gate_dimension->size?> </td>
                        <td>เมตร</td>
                        <td class="line"><font class="outline"> จำนวน </font> &nbsp;&nbsp;<?php echo $space[0]->control_building_gate_dimension->num?> </td>
                        <td>ชุด</td>
                    </tr>
                </table>
                <table style="padding-left:70px;">
                    <tr>
                        <td width=15% ></td>
                        <td width=15% >ชนิดเครื่องยกบาน</td>
                        <td width=10% ><?php checkHas($space[0]->control_building_machanic_has)?> &nbsp;มี</td>
                        <td width=20% ><?php checkZero($space[0]->control_building_machanic_has)?>&nbsp;ไม่มี</td>
                       
                    </tr>

                    <tr>
                        <td width=15% ></td>
                        <td width=15% ></td>
                        <td width=10% ><?php checkpair($space[0]->control_building_machanic_type,"รอกโซ่")?> &nbsp;รอกโซ่</td>
                        <td width=20% ><?php checkpair($space[0]->control_building_machanic_type,"เครื่องกว้านคันชัก")?> &nbsp;เครื่องกว้านคันชัก</td>
                        <td><?php checkpair($space[0]->control_building_machanic_type,"เครื่องกว้านม้วนลวด")?> &nbsp;เครื่องกว้านม้วนลวด</td>
                        
                    </tr>

                </table>
            
            <div class="text4">1.6 พื้นที่รับประโยชน์ 
                <font style="margin-left:35px;">ด้านการเกษตร&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ประมาณ<span class="line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $space[0]->agriculture?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>ไร่ </font>
                <font style="margin-left:50px;">&nbsp;&nbsp;&nbsp;ด้านอุปโภคบริโภค&nbsp;&nbsp;&nbsp;&nbsp; ประมาณ<span class="line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $space[0]->comsumption?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>ไร่ </font>
            </div>
        </div>
        <div class="text">
            <div class="text3">2. ระบบส่งน้ำ </div>
            <div class="text4"> 
                <table>
                    <tr>
                        <td width=15%>ระบบส่งน้ำ</td>
                        <td width=15%><?php checkHas($space[0]->canal_has)?>&nbsp;มี</td>
                        <td><?php checkZero($space[0]->canal_has)?>&nbsp;ไม่มี</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td width=15%>ลักษณะคลอง</td>
                        <td width=15%><?php checkpair($space[0]->canal_type,"คลองดิน")?>&nbsp;คลองดิน</td>
                        <td><?php checkpair($space[0]->canal_type,"คลองดาดคอนกรีต")?>&nbsp;คลองดาดคอนกรีต</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td width=15% class="line"><font class="outline"> ขนาดกันคลองกว้าง </font>&nbsp;&nbsp;<?php echo $space[0]->canel_dimension->width?> </td>
                        <td width=5%>เมตร</td>
                        <td width=15% class="line"><font class="outline"> ความยาวประมาณ </font>&nbsp;&nbsp; <?php echo $space[0]->canel_dimension->lenght?></td>
                        <td width=5%>กิโลเมตร</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div style="height:40px;"></div>
        <div class="text">
            <div class="text3">3. ข้อมูลประวัติการซ่อม </div>
            <table class="table1" border=1>
                <tr align="center" style="background-color: #ADADAD;">
                    <th>ปี พ.ศ.</th>
                    <th>รายการซ่อม</th>
                    <th>หน่วยงาน</th>
                    <th>หมายเหตุ</th>
                </tr>
                <?php for($i=1;$i<3;$i++){ ?>
                    <tr>
                        <td><?php echo $maintain[$i]['maintain_date']?>&nbsp;</td>
                        <td><?php echo $maintain[$i]['maintain_detail']?>&nbsp;</td>
                        <td><?php echo $maintain[$i]['maintain_resp']?>&nbsp;</td>
                        <td><?php echo $maintain[$i]['maintain_remark']?>&nbsp;</td>
                    </tr>  
                <?php } ?>
            </table>
        </div>

        <div class="text">
            <div class="text3">4. การตรวจสภาพฝาย </div>
            <table class="table2" border=2>  
              <!-- header -->
              <!-- <thead style="display: table-header-group;"> -->
              <thead>
                <tr style="background-color: #ADADAD;">
                    <th rowspan="2" colspan="2" width="20%" >องค์ประกอบ</th>
                    <th colspan="11" >ผลการตรวจสอบสภาพฝายด้วยสายตา</th>
                </tr>
                <tr style="background-color: #ADADAD;">
                    <th width="6%">การกัดเซาะ</th>
                    <th width="6%">การทรุดตัว</th>
                    <th width="6%">การแตกร้าว</th>
                    <th width="6%">สิ่งกีดขวาง</th>
                    <th width="6%">รูโพรง</th>
                    <th width="6%">การรั่ว</th>
                    <th width="6%">การเคลื่อนตัว</th>
                    <th width="6%">การระบายน้ำ</th>
                    <th width="6%">ต้นไม้/วัชพืช</th>
                    <th width="6%">ขนาดความ<br>เสียหาย</th>
                    <th width="6%">หมายเหตุ</th>
                </tr>
              </thead>
              <!-- 1 -->
                <tr align="left" style="background-color: #ADADAD;" > 
                    <th colspan="13" >
                        1. ส่วน Potection เหนือน้ำ (Upstream Protection Section)
                        <span><?php checkpair(1,$upprotection[0]->section_status)?> ใช้งานได้  </span>
                        <span><?php checkpair(2,$upprotection[0]->section_status)?> ควรปรับปรุง  </span>
                        <span><?php checkpair(3,$upprotection[0]->section_status)?> ควรรื้อถอนก่อสร้างใหม่ </span>
                    </th>
                </tr>
               <!-- 1.1 -->
                <tr>
                    <th id="textsurvey" align="left">1.1 พื้น (floor)</th> 
                    <td>ปกติ</td>
                    <td><?php check4($upprotection[0]->floor_erosion,1)?></td>
                    <td><?php check4($upprotection[0]->floor_subsidence,1)?></td>
                    <td><?php check4($upprotection[0]->floor_cracking,1)?></td>
                    <td><?php check4($upprotection[0]->floor_obstruction,1)?></td>
                    <td><?php check4($upprotection[0]->floor_hole,1)?></td>
                    <td><?php check4($upprotection[0]->floor_leak,1)?></td>
                    <td><?php check4($upprotection[0]->floor_movement,1)?></td>
                    <td><?php check4($upprotection[0]->floor_drainage,1)?></td>
                    <td><?php check4($upprotection[0]->floor_weed,1)?></td>
                    <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $upprotection[0]->floor_damage?></td>
                    <td rowspan="4" width="10%">
                        <table style="vertical-align: top; border-style:hidden;" > 
                            <tr class="noBorder">
                                <td><?php checkCuase($upprotection[0]->floor_remake->no)?></td>
                                <td>ไม่มี</td>
                            </tr>
                            <tr class="noBorder">
                                <td><?php checkCuase($upprotection[0]->floor_remake->nosee)?></td>
                                <td>มองไม่เห็น</td>
                            </tr>
                            <tr class="noBorder">
                                <td> อื่นๆ </td>
                                <td class="line"><?php echo $upprotection[0]->floor_remake->detail?></td>
                            </tr>
                            <tr class="noBorder">
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="left">ตะกอน</td> 
                    <td>น้อย</td>
                    <td><?php check4($upprotection[0]->floor_erosion,2)?></td>
                    <td><?php check4($upprotection[0]->floor_subsidence,2)?></td>
                    <td><?php check4($upprotection[0]->floor_cracking,2)?></td>
                    <td><?php check4($upprotection[0]->floor_obstruction,2)?></td>
                    <td><?php check4($upprotection[0]->floor_hole,2)?></td>
                    <td><?php check4($upprotection[0]->floor_leak,2)?></td>
                    <td><?php check4($upprotection[0]->floor_movement,2)?></td>
                    <td><?php check4($upprotection[0]->floor_drainage,2)?></td>
                    <td><?php check4($upprotection[0]->floor_weed,2)?></td>
                </tr>
                <tr>
                    <td>
                        <table > 
                            <tr class="noBorder">
                                <td width="10%"><?php checkpair(1,$upprotection[0]->check_floor)?></td>
                                <td width="40%" >ปกติ</td>
                                <td width="10%"><?php checkpair(2,$upprotection[0]->check_floor)?></td>
                                <td width="40%">น้อย</td>
                            </tr>
                        </table>
                    </td> 
                    <td>ปานกลาง</td>
                    <td><?php check4($upprotection[0]->floor_erosion,3)?></td>
                    <td><?php check4($upprotection[0]->floor_subsidence,3)?></td>
                    <td><?php check4($upprotection[0]->floor_cracking,3)?></td>
                    <td><?php check4($upprotection[0]->floor_obstruction,3)?></td>
                    <td><?php check4($upprotection[0]->floor_hole,3)?></td>
                    <td><?php check4($upprotection[0]->floor_leak,3)?></td>
                    <td><?php check4($upprotection[0]->floor_movement,3)?></td>
                    <td><?php check4($upprotection[0]->floor_drainage,3)?></td>
                    <td><?php check4($upprotection[0]->floor_weed,3)?></td>
                </tr>
                <tr>
                    <td>
                        <table > 
                            <tr class="noBorder">
                                <td width="10%"><?php checkpair($upprotection[0]->check_floor,3)?></td>
                                <td width="40%">ปานกลาง</td>
                                <td width="10%"><?php checkpair($upprotection[0]->check_floor,4)?></td>
                                <td width="40%">มาก</td>
                            </tr>
                        </table>
                    </td> 
                    <td>มาก</td>
                    <td><?php check4($upprotection[0]->floor_erosion,4)?></td>
                    <td><?php check4($upprotection[0]->floor_subsidence,4)?></td>
                    <td><?php check4($upprotection[0]->floor_cracking,4)?></td>
                    <td><?php check4($upprotection[0]->floor_obstruction,4)?></td>
                    <td><?php check4($upprotection[0]->floor_hole,4)?></td>
                    <td><?php check4($upprotection[0]->floor_leak,4)?></td>
                    <td><?php check4($upprotection[0]->floor_movement,4)?></td>
                    <td><?php check4($upprotection[0]->floor_drainage,4)?></td>
                    <td><?php check4($upprotection[0]->floor_weed,4)?></td>
                </tr>
               <!-- 1.2 -->
                <tr>
                    <th id="textsurvey" align="left"  rowspan="4">1.2 ลาดด้านข้าง</th> 
                    <td>ปกติ</td>
                    <td><?php check4($upprotection[0]->side_erosion,1)?></td>
                    <td><?php check4($upprotection[0]->side_subsidence,1)?></td>
                    <td><?php check4($upprotection[0]->side_cracking,1)?></td>
                    <td><?php check4($upprotection[0]->side_obstruction,1)?></td>
                    <td><?php check4($upprotection[0]->side_hole,1)?></td>
                    <td><?php check4($upprotection[0]->side_leak,1)?></td>
                    <td><?php check4($upprotection[0]->side_movement,1)?></td>
                    <td><?php check4($upprotection[0]->side_drainage,1)?></td>
                    <td><?php check4($upprotection[0]->side_weed,1)?></td>
                    <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $upprotection[0]->side_damage?></td>
                    <td rowspan="4" width="10%">
                        <table style="vertical-align: top;"> 
                            <tr class="noBorder">
                                <td ><?php checkCuase($upprotection[0]->side_remake->no)?></td>
                                <td>ไม่มี</td>
                            </tr>
                            <tr class="noBorder">
                                <td><?php checkCuase($upprotection[0]->side_remake->nosee)?></td>
                                <td>มองไม่เห็น</td>
                            </tr>
                            <tr class="noBorder">
                                <td> อื่นๆ </td>
                                <td class="line"><?php echo $upprotection[0]->side_remake->detail?></td>
                            </tr>
                            <tr class="noBorder">
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php for($i=2;$i<5;$i++){ ?>
                  <tr>
                    <td><?php echo $level[$i-2]?></td>
                    <td><?php check4($upprotection[0]->side_erosion,$i)?></td>
                    <td><?php check4($upprotection[0]->side_subsidence,$i)?></td>
                    <td><?php check4($upprotection[0]->side_cracking,$i)?></td>
                    <td><?php check4($upprotection[0]->side_obstruction,$i)?></td>
                    <td><?php check4($upprotection[0]->side_hole,$i)?></td>
                    <td><?php check4($upprotection[0]->side_leak,$i)?></td>
                    <td><?php check4($upprotection[0]->side_movement,$i)?></td>
                    <td><?php check4($upprotection[0]->side_drainage,$i)?></td>
                    <td><?php check4($upprotection[0]->side_weed,$i)?></td>
                  </tr>
                <?php } ?>
              <!-- 2 -->
                <tr align="left" style="background-color: #ADADAD;" > 
                    <th colspan="13" >
                        2. ส่วนเหนือน้ำ (Upstream Concrete Section) 
                        <span><?php checkpair(1,$upconcrete[0]->section_status)?> ใช้งานได้  </span>
                        <span><?php checkpair(2,$upconcrete[0]->section_status)?> ควรปรับปรุง  </span>
                        <span><?php checkpair(3,$upconcrete[0]->section_status)?> ควรรื้อถอนก่อสร้างใหม่ </span>
                    </th>
                </tr>
               <!-- 2.1 -->
                <tr>
                    <th id="textsurvey" align="left">2.1 พื้น (floor)</th> 
                    <td>ปกติ</td>
                    <td><?php check4($upconcrete[0]->floor_erosion,1)?></td>
                    <td><?php check4($upconcrete[0]->floor_subsidence,1)?></td>
                    <td><?php check4($upconcrete[0]->floor_cracking,1)?></td>
                    <td><?php check4($upconcrete[0]->floor_obstruction,1)?></td>
                    <td><?php check4($upconcrete[0]->floor_hole,1)?></td>
                    <td><?php check4($upconcrete[0]->floor_leak,1)?></td>
                    <td><?php check4($upconcrete[0]->floor_movement,1)?></td>
                    <td><?php check4($upconcrete[0]->floor_drainage,1)?></td>
                    <td><?php check4($upconcrete[0]->floor_weed,1)?></td>
                    <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $upconcrete[0]->floor_damage?></td>
                    <td rowspan="4" width="10%">
                        <table style="vertical-align: top;"> 
                            <tr class="noBorder">
                                <td ><?php checkCuase($upconcrete[0]->floor_remake->no)?></td>
                                <td>ไม่มี</td>
                            </tr>
                            <tr class="noBorder">
                                <td><?php checkCuase($upconcrete[0]->floor_remake->nosee)?></td>
                                <td>มองไม่เห็น</td>
                            </tr>
                            <tr class="noBorder">
                                <td> อื่นๆ </td>
                                <td class="line"><?php echo $upconcrete[0]->floor_remake->detail?></td>
                            </tr>
                            <tr class="noBorder">
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="left">ตะกอน</td> 
                    <td>น้อย</td>
                    <td><?php check4($upconcrete[0]->floor_erosion,2)?></td>
                    <td><?php check4($upconcrete[0]->floor_subsidence,2)?></td>
                    <td><?php check4($upconcrete[0]->floor_cracking,2)?></td>
                    <td><?php check4($upconcrete[0]->floor_obstruction,2)?></td>
                    <td><?php check4($upconcrete[0]->floor_hole,2)?></td>
                    <td><?php check4($upconcrete[0]->floor_leak,2)?></td>
                    <td><?php check4($upconcrete[0]->floor_movement,2)?></td>
                    <td><?php check4($upconcrete[0]->floor_drainage,2)?></td>
                    <td><?php check4($upconcrete[0]->floor_weed,2)?></td>
                </tr>
                <tr>
                    <td>
                        <table > 
                            <tr class="noBorder">
                                <td width="10%"><?php checkpair(1,$upconcrete[0]->check_floor)?></td>
                                <td width="40%">ปกติ</td>
                                <td width="10%"><?php checkpair(2,$upconcrete[0]->check_floor)?></td>
                                <td width="40%">น้อย</td>
                            </tr>
                        </table>
                    </td> 
                    <td>ปานกลาง</td>
                    <td><?php check4($upconcrete[0]->floor_erosion,3)?></td>
                    <td><?php check4($upconcrete[0]->floor_subsidence,3)?></td>
                    <td><?php check4($upconcrete[0]->floor_cracking,3)?></td>
                    <td><?php check4($upconcrete[0]->floor_obstruction,3)?></td>
                    <td><?php check4($upconcrete[0]->floor_hole,3)?></td>
                    <td><?php check4($upconcrete[0]->floor_leak,3)?></td>
                    <td><?php check4($upconcrete[0]->floor_movement,3)?></td>
                    <td><?php check4($upconcrete[0]->floor_drainage,3)?></td>
                    <td><?php check4($upconcrete[0]->floor_weed,3)?></td>
                </tr>
                <tr>
                    <td>
                        <table > 
                            <tr class="noBorder">
                                <td width="10%"><?php checkpair($upconcrete[0]->check_floor,3)?></td>
                                <td width="40%">ปานกลาง</td>
                                <td width="10%"><?php checkpair($upconcrete[0]->check_floor,4)?></td>
                                <td width="40%">มาก</td>
                            </tr>
                        </table>
                    </td> 
                    <td>มาก</td>
                    <td><?php check4($upconcrete[0]->floor_erosion,4)?></td>
                    <td><?php check4($upconcrete[0]->floor_subsidence,4)?></td>
                    <td><?php check4($upconcrete[0]->floor_cracking,4)?></td>
                    <td><?php check4($upconcrete[0]->floor_obstruction,4)?></td>
                    <td><?php check4($upconcrete[0]->floor_hole,4)?></td>
                    <td><?php check4($upconcrete[0]->floor_leak,4)?></td>
                    <td><?php check4($upconcrete[0]->floor_movement,4)?></td>
                    <td><?php check4($upconcrete[0]->floor_drainage,4)?></td>
                    <td><?php check4($upconcrete[0]->floor_weed,4)?></td>
                </tr>
               <!-- 2.2 -->
                <tr>
                    <th id="textsurvey" align="left"  rowspan="4">2.2 ลาดด้านข้าง</th> 
                    <td>ปกติ</td>
                    <td><?php check4($upconcrete[0]->side_erosion,1)?></td>
                    <td><?php check4($upconcrete[0]->side_subsidence,1)?></td>
                    <td><?php check4($upconcrete[0]->side_cracking,1)?></td>
                    <td><?php check4($upconcrete[0]->side_obstruction,1)?></td>
                    <td><?php check4($upconcrete[0]->side_hole,1)?></td>
                    <td><?php check4($upconcrete[0]->side_leak,1)?></td>
                    <td><?php check4($upconcrete[0]->side_movement,1)?></td>
                    <td><?php check4($upconcrete[0]->side_drainage,1)?></td>
                    <td><?php check4($upconcrete[0]->side_weed,1)?></td>
                    <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $upconcrete[0]->side_damage?></td>
                    <td rowspan="4" width="10%">
                        <table style="vertical-align: top;"> 
                            <tr class="noBorder">
                                <td ><?php checkCuase($upconcrete[0]->side_remake->no)?></td>
                                <td>ไม่มี</td>
                            </tr>
                            <tr class="noBorder">
                                <td><?php checkCuase($upconcrete[0]->side_remake->nosee)?></td>
                                <td>มองไม่เห็น</td>
                            </tr>
                            <tr class="noBorder">
                                <td> อื่นๆ </td>
                                <td class="line"><?php echo $upconcrete[0]->side_remake->detail?></td>
                            </tr>
                            <tr class="noBorder">
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php for($i=2;$i<5;$i++){ ?>
                  <tr>
                    <td><?php echo $level[$i-2]?></td>
                    <td><?php check4($upconcrete[0]->side_erosion,$i)?></td>
                    <td><?php check4($upconcrete[0]->side_subsidence,$i)?></td>
                    <td><?php check4($upconcrete[0]->side_cracking,$i)?></td>
                    <td><?php check4($upconcrete[0]->side_obstruction,$i)?></td>
                    <td><?php check4($upconcrete[0]->side_hole,$i)?></td>
                    <td><?php check4($upconcrete[0]->side_leak,$i)?></td>
                    <td><?php check4($upconcrete[0]->side_movement,$i)?></td>
                    <td><?php check4($upconcrete[0]->side_drainage,$i)?></td>
                    <td><?php check4($upconcrete[0]->side_weed,$i)?></td>
                  </tr>
                <?php } ?>
              <!-- 3 -->
                <tr align="left" style="background-color: #ADADAD;" > 
                    <th colspan="13" >
                        3. ส่วนควบคุม (Control Sector) 
                        <span><?php checkpair(1,$control[0]->section_status)?> ใช้งานได้  </span>
                        <span><?php checkpair(2,$control[0]->section_status)?> ควรปรับปรุง  </span>
                        <span><?php checkpair(3,$control[0]->section_status)?> ควรรื้อถอนก่อสร้างใหม่ </span>
                    </th>
                </tr>
                <!-- 3.1 -->
                    <tr>
                        <th id="textsurvey" align="left"  rowspan="4">3.1 ฝายควบคุมน้ำ<br>และบันไดปลา</th> 
                        <td>ปกติ</td>
                        <td><?php check4($control[0]->waterctrl_erosion,1)?></td>
                        <td><?php check4($control[0]->waterctrl_subsidence,1)?></td>
                        <td><?php check4($control[0]->waterctrl_cracking,1)?></td>
                        <td><?php check4($control[0]->waterctrl_obstruction,1)?></td>
                        <td><?php check4($control[0]->waterctrl_hole,1)?></td>
                        <td><?php check4($control[0]->waterctrl_leak,1)?></td>
                        <td><?php check4($control[0]->waterctrl_movement,1)?></td>
                        <td><?php check4($control[0]->waterctrl_drainage,1)?></td>
                        <td><?php check4($control[0]->waterctrl_weed,1)?></td>
                        <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $control[0]->waterctrl_damage?></td>
                        <td rowspan="4" width="10%">
                            <table style="vertical-align: top;"> 
                                <tr class="noBorder">
                                    <td ><?php checkCuase($control[0]->waterctrl_remake->no)?></td>
                                    <td>ไม่มี</td>
                                </tr>
                                <tr class="noBorder">
                                    <td><?php checkCuase($control[0]->waterctrl_remake->nosee)?></td>
                                    <td>มองไม่เห็น</td>
                                </tr>
                                <tr class="noBorder">
                                    <td> อื่นๆ </td>
                                    <td class="line"><?php echo $control[0]->waterctrl_remake->detail?></td>
                                </tr>
                                <tr class="noBorder">
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php for($i=2;$i<5;$i++){ ?>
                    <tr>
                        <td><?php echo $level[$i-2]?></td>
                        <td><?php check4($control[0]->waterctrl_erosion,$i)?></td>
                        <td><?php check4($control[0]->waterctrl_subsidence,$i)?></td>
                        <td><?php check4($control[0]->waterctrl_cracking,$i)?></td>
                        <td><?php check4($control[0]->waterctrl_obstruction,$i)?></td>
                        <td><?php check4($control[0]->waterctrl_hole,$i)?></td>
                        <td><?php check4($control[0]->waterctrl_leak,$i)?></td>
                        <td><?php check4($control[0]->waterctrl_movement,$i)?></td>
                        <td><?php check4($control[0]->waterctrl_drainage,$i)?></td>
                        <td><?php check4($control[0]->waterctrl_weed,$i)?></td>
                    </tr>
                    <?php } ?>
                <!-- 3.2 -->
                    <tr>
                        <th id="textsurvey" align="left"  rowspan="4">3.2 กำแพงข้าง</th> 
                        <td>ปกติ</td>
                        <td><?php check4($control[0]->sidewall_erosion,1)?></td>
                        <td><?php check4($control[0]->sidewall_subsidence,1)?></td>
                        <td><?php check4($control[0]->sidewall_cracking,1)?></td>
                        <td><?php check4($control[0]->sidewall_obstruction,1)?></td>
                        <td><?php check4($control[0]->sidewall_hole,1)?></td>
                        <td><?php check4($control[0]->sidewall_leak,1)?></td>
                        <td><?php check4($control[0]->sidewall_movement,1)?></td>
                        <td><?php check4($control[0]->sidewall_drainage,1)?></td>
                        <td><?php check4($control[0]->sidewall_weed,1)?></td>
                        <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $control[0]->sidewall_damage?></td>
                        <td rowspan="4" width="10%">
                            <table style="vertical-align: top;"> 
                                <tr class="noBorder">
                                    <td ><?php checkCuase($control[0]->sidewall_remake->no)?></td>
                                    <td>ไม่มี</td>
                                </tr>
                                <tr class="noBorder">
                                    <td><?php checkCuase($control[0]->sidewall_remake->nosee)?></td>
                                    <td>มองไม่เห็น</td>
                                </tr>
                                <tr class="noBorder">
                                    <td> อื่นๆ </td>
                                    <td class="line"><?php echo $control[0]->sidewall_remake->detail?></td>
                                </tr>
                                <tr class="noBorder">
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php for($i=2;$i<5;$i++){ ?>
                    <tr>
                        <td><?php echo $level[$i-2]?></td>
                        <td><?php check4($control[0]->sidewall_erosion,$i)?></td>
                        <td><?php check4($control[0]->sidewall_subsidence,$i)?></td>
                        <td><?php check4($control[0]->sidewall_cracking,$i)?></td>
                        <td><?php check4($control[0]->sidewall_obstruction,$i)?></td>
                        <td><?php check4($control[0]->sidewall_hole,$i)?></td>
                        <td><?php check4($control[0]->sidewall_leak,$i)?></td>
                        <td><?php check4($control[0]->sidewall_movement,$i)?></td>
                        <td><?php check4($control[0]->sidewall_drainage,$i)?></td>
                        <td><?php check4($control[0]->sidewall_weed,$i)?></td>
                    </tr>
                    <?php } ?>
            
                <!-- 3.3 -->
                    <tr align="left"  > 
                        <th colspan="13" id="textsurvey" >3.3 ประตู/ช่องระบายทราย  </th>
                    </tr>
                    <!-- 3.3.1 -->
                    <tr>
                        <th id="textsurvey" align="left"  >3.3.1 พื้น</th> 
                        <td>ปกติ</td>
                        <td><?php check4($control[0]->dgfloor_erosion,1)?></td>
                        <td><?php check4($control[0]->dgfloor_subsidence,1)?></td>
                        <td><?php check4($control[0]->dgfloor_cracking,1)?></td>
                        <td><?php check4($control[0]->dgfloor_obstruction,1)?></td>
                        <td><?php check4($control[0]->dgfloor_hole,1)?></td>
                        <td><?php check4($control[0]->dgfloor_leak,1)?></td>
                        <td><?php check4($control[0]->dgfloor_movement,1)?></td>
                        <td><?php check4($control[0]->dgfloor_drainage,1)?></td>
                        <td><?php check4($control[0]->dgfloor_weed,1)?></td>
                        <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $control[0]->dgfloor_damage?></td>
                        <td rowspan="4" width="10%">
                            <table style="vertical-align: top;"> 
                                <tr class="noBorder">
                                    <td ><?php checkCuase($control[0]->dgfloor_remake->no)?></td>
                                    <td>ไม่มี</td>
                                </tr>
                                <tr class="noBorder">
                                    <td><?php checkCuase($control[0]->dgfloor_remake->nosee)?></td>
                                    <td>มองไม่เห็น</td>
                                </tr>
                                <tr class="noBorder" >
                                    <td> อื่นๆ </td>
                                    <td class="line"><?php echo $control[0]->dgfloor_remake->detail?></td>
                                </tr>
                                <tr class="noBorder">
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                   
                    <tr>
                        <td align="left">ตะกอน</td> 
                        <td>น้อย</td>
                        <td><?php check4($control[0]->floor_erosion,2)?></td>
                        <td><?php check4($control[0]->floor_subsidence,2)?></td>
                        <td><?php check4($control[0]->floor_cracking,2)?></td>
                        <td><?php check4($control[0]->floor_obstruction,2)?></td>
                        <td><?php check4($control[0]->floor_hole,2)?></td>
                        <td><?php check4($control[0]->floor_leak,2)?></td>
                        <td><?php check4($control[0]->floor_movement,2)?></td>
                        <td><?php check4($control[0]->floor_drainage,2)?></td>
                        <td><?php check4($control[0]->floor_weed,2)?></td>
                    </tr>
                    <tr>
                        <td>
                            <table > 
                                <tr class="noBorder">
                                    <td width="10%"><?php checkpair(1,$control[0]->check_floor)?></td>
                                    <td width="40%">ปกติ</td>
                                    <td width="10%"><?php checkpair(2,$control[0]->check_floor)?></td>
                                    <td width="40%">น้อย</td>
                                </tr>
                            </table>
                        </td> 
                        <td>ปานกลาง</td>
                        <td><?php check4($control[0]->floor_erosion,3)?></td>
                        <td><?php check4($control[0]->floor_subsidence,3)?></td>
                        <td><?php check4($control[0]->floor_cracking,3)?></td>
                        <td><?php check4($control[0]->floor_obstruction,3)?></td>
                        <td><?php check4($control[0]->floor_hole,3)?></td>
                        <td><?php check4($control[0]->floor_leak,3)?></td>
                        <td><?php check4($control[0]->floor_movement,3)?></td>
                        <td><?php check4($control[0]->floor_drainage,3)?></td>
                        <td><?php check4($control[0]->floor_weed,3)?></td>
                    </tr>
                    <tr>
                        <td>
                            <table > 
                                <tr class="noBorder">
                                    <td width="10%"><?php checkpair($control[0]->check_floor,3)?></td>
                                    <td width="40%">ปานกลาง</td>
                                    <td width="10%"><?php checkpair($control[0]->check_floor,4)?></td>
                                    <td width="40%">มาก</td>
                                </tr>
                            </table>
                        </td> 
                        <td>มาก</td>
                        <td><?php check4($control[0]->floor_erosion,4)?></td>
                        <td><?php check4($control[0]->floor_subsidence,4)?></td>
                        <td><?php check4($control[0]->floor_cracking,4)?></td>
                        <td><?php check4($control[0]->floor_obstruction,4)?></td>
                        <td><?php check4($control[0]->floor_hole,4)?></td>
                        <td><?php check4($control[0]->floor_leak,4)?></td>
                        <td><?php check4($control[0]->floor_movement,4)?></td>
                        <td><?php check4($control[0]->floor_drainage,4)?></td>
                        <td><?php check4($control[0]->floor_weed,4)?></td>
                    </tr>
            </table>
            <div style="height:40px;"></div>
            <table class="table2" border=1>
              <thead>
                <tr style="background-color: #ADADAD;">
                    <th rowspan="2" colspan="2" width="20%" >องค์ประกอบ</th>
                    <th colspan="11" width="80%"  >ผลการตรวจสอบสภาพฝายด้วยสายตา</th>
                </tr>
                <tr style="background-color: #ADADAD;">
                    <th width="6%">การกัดเซาะ</th>
                    <th width="6%">การทรุดตัว</th>
                    <th width="6%">การแตกร้าว</th>
                    <th width="6%">สิ่งกีดขวาง</th>
                    <th width="6%">รูโพรง</th>
                    <th width="6%">การรั่ว</th>
                    <th width="6%">การเคลื่อนตัว</th>
                    <th width="6%">การระบายน้ำ</th>
                    <th width="6%">ต้นไม้/วัชพืช</th>
                    <th width="6%">ขนาดความ<br>เสียหาย</th>
                    <th width="6%">หมายเหตุ</th>
                </tr>
              </thead>
                    <!-- 3.3.2 -->
                    <tr>
                        <th id="textsurvey" align="left"  rowspan="4">3.3.2 กำแพงข้าง</th> 
                        <td>ปกติ</td>
                        <td><?php check4($control[0]->dgwall_erosion,1)?></td>
                        <td><?php check4($control[0]->dgwall_subsidence,1)?></td>
                        <td><?php check4($control[0]->dgwall_cracking,1)?></td>
                        <td><?php check4($control[0]->dgwall_obstruction,1)?></td>
                        <td><?php check4($control[0]->dgwall_hole,1)?></td>
                        <td><?php check4($control[0]->dgwall_leak,1)?></td>
                        <td><?php check4($control[0]->dgwall_movement,1)?></td>
                        <td><?php check4($control[0]->dgwall_drainage,1)?></td>
                        <td><?php check4($control[0]->dgwall_weed,1)?></td>
                        <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $control[0]->dgwall_damage?></td>
                        <td rowspan="4" width="10%">
                            <table style="vertical-align: top;"> 
                                <tr class="noBorder">
                                    <td ><?php checkCuase($control[0]->dgwall_remake->no)?></td>
                                    <td>ไม่มี</td>
                                </tr>
                                <tr class="noBorder">
                                    <td><?php checkCuase($control[0]->dgwall_remake->nosee)?></td>
                                    <td>มองไม่เห็น</td>
                                </tr>
                                <tr class="noBorder">
                                    <td> อื่นๆ </td>
                                    <td class="line"><?php echo $control[0]->dgwall_remake->detail?></td>
                                </tr>
                                <tr class="noBorder">
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php for($i=2;$i<5;$i++){ ?>
                    <tr>
                        <td><?php echo $level[$i-2]?></td>
                        <td><?php check4($control[0]->dgwall_erosion,$i)?></td>
                        <td><?php check4($control[0]->dgwall_subsidence,$i)?></td>
                        <td><?php check4($control[0]->dgwall_cracking,$i)?></td>
                        <td><?php check4($control[0]->dgwall_obstruction,$i)?></td>
                        <td><?php check4($control[0]->dgwall_hole,$i)?></td>
                        <td><?php check4($control[0]->dgwall_leak,$i)?></td>
                        <td><?php check4($control[0]->dgwall_movement,$i)?></td>
                        <td><?php check4($control[0]->dgwall_drainage,$i)?></td>
                        <td><?php check4($control[0]->dgwall_weed,$i)?></td>
                    </tr>
                    <?php } ?>
            
                <!-- new -->
                    <!-- 3.3.3 -->
                      
                        <tr>
                            <th id="textsurvey" align="left"  rowspan="4">3.3.3 ประตูระบายน้ำ<br>เฉพาะตัวบาน</th> 
                            <td>ปกติ</td>
                            <td><?php check4($control[0]->dggate_erosion,1)?></td>
                            <td><?php check4($control[0]->dggate_subsidence,1)?></td>
                            <td><?php check4($control[0]->dggate_cracking,1)?></td>
                            <td><?php check4($control[0]->dggate_obstruction,1)?></td>
                            <td><?php check4($control[0]->dggate_hole,1)?></td>
                            <td><?php check4($control[0]->dggate_leak,1)?></td>
                            <td><?php check4($control[0]->dggate_movement,1)?></td>
                            <td><?php check4($control[0]->dggate_drainage,1)?></td>
                            <td><?php check4($control[0]->dggate_weed,1)?></td>
                            <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $control[0]->dggate_damage?></td>
                            <td rowspan="4" width="10%">
                                <table style="vertical-align: top;"> 
                                    <tr class="noBorder">
                                        <td ><?php checkCuase($control[0]->dggate_remake->no)?></td>
                                        <td>ไม่มี</td>
                                    </tr>
                                    <tr class="noBorder">
                                        <td><?php checkCuase($control[0]->dggate_remake->nosee)?></td>
                                        <td>มองไม่เห็น</td>
                                    </tr>
                                    <tr class="noBorder">
                                        <td> อื่นๆ </td>
                                        <td class="line"><?php echo $control[0]->dggate_remake->detail?></td>
                                    </tr>
                                    <tr class="noBorder">
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?php for($i=2;$i<5;$i++){ ?>
                        <tr>
                            <td><?php echo $level[$i-2]?></td>
                            <td><?php check4($control[0]->dggate_erosion,$i)?></td>
                            <td><?php check4($control[0]->dggate_subsidence,$i)?></td>
                            <td><?php check4($control[0]->dggate_cracking,$i)?></td>
                            <td><?php check4($control[0]->dggate_obstruction,$i)?></td>
                            <td><?php check4($control[0]->dggate_hole,$i)?></td>
                            <td><?php check4($control[0]->dggate_leak,$i)?></td>
                            <td><?php check4($control[0]->dggate_movement,$i)?></td>
                            <td><?php check4($control[0]->dggate_drainage,$i)?></td>
                            <td><?php check4($control[0]->dggate_weed,$i)?></td>
                        </tr>
                        <?php } ?>
                    <!-- 3.3.4 -->
                        <tr>
                            <th id="textsurvey" align="left"  rowspan="4">3.3.4 ประตู <br>ระบายน้ำเคลื่อง<br> กล/อุปกรณ์</th> 
                            <td>ปกติ</td>
                            <td><?php check4($control[0]->dgmachanic_erosion,1)?></td>
                            <td><?php check4($control[0]->dgmachanic_subsidence,1)?></td>
                            <td><?php check4($control[0]->dgmachanic_cracking,1)?></td>
                            <td><?php check4($control[0]->dgmachanic_obstruction,1)?></td>
                            <td><?php check4($control[0]->dgmachanic_hole,1)?></td>
                            <td><?php check4($control[0]->dgmachanic_leak,1)?></td>
                            <td><?php check4($control[0]->dgmachanic_movement,1)?></td>
                            <td><?php check4($control[0]->dgmachanic_drainage,1)?></td>
                            <td><?php check4($control[0]->dgmachanic_weed,1)?></td>
                            <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $control[0]->dgmachanic_damage?></td>
                            <td rowspan="4" width="10%">
                                <table style="vertical-align: top;"> 
                                    <tr class="noBorder">
                                        <td ><?php checkCuase($control[0]->dgmachanic_remake->no)?></td>
                                        <td>ไม่มี</td>
                                    </tr>
                                    <tr class="noBorder">
                                        <td><?php checkCuase($control[0]->dgmachanic_remake->nosee)?></td>
                                        <td>มองไม่เห็น</td>
                                    </tr>
                                    <tr class="noBorder">
                                        <td> อื่นๆ </td>
                                        <td class="line"><?php echo $control[0]->dgmachanic_remake->detail?></td>
                                    </tr>
                                    <tr class="noBorder">
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?php for($i=2;$i<5;$i++){ ?>
                        <tr>
                            <td><?php echo $level[$i-2]?></td>
                            <td><?php check4($control[0]->dgmachanic_erosion,$i)?></td>
                            <td><?php check4($control[0]->dgmachanic_subsidence,$i)?></td>
                            <td><?php check4($control[0]->dgmachanic_cracking,$i)?></td>
                            <td><?php check4($control[0]->dgmachanic_obstruction,$i)?></td>
                            <td><?php check4($control[0]->dgmachanic_hole,$i)?></td>
                            <td><?php check4($control[0]->dgmachanic_leak,$i)?></td>
                            <td><?php check4($control[0]->dgmachanic_movement,$i)?></td>
                            <td><?php check4($control[0]->dgmachanic_drainage,$i)?></td>
                            <td><?php check4($control[0]->dgmachanic_weed,$i)?></td>
                        </tr>
                        <?php } ?>
                    <!-- 3.3.5 -->
                        <tr>
                            <th id="textsurvey" align="left"  rowspan="4">3.3.5 ท่อนกันน้ำและ<br>ร่องบาน</th> 
                            <td>ปกติ</td>
                            <td><?php check4($control[0]->dgblock_erosion,1)?></td>
                            <td><?php check4($control[0]->dgblock_subsidence,1)?></td>
                            <td><?php check4($control[0]->dgblock_cracking,1)?></td>
                            <td><?php check4($control[0]->dgblock_obstruction,1)?></td>
                            <td><?php check4($control[0]->dgblock_hole,1)?></td>
                            <td><?php check4($control[0]->dgblock_leak,1)?></td>
                            <td><?php check4($control[0]->dgblock_movement,1)?></td>
                            <td><?php check4($control[0]->dgblock_drainage,1)?></td>
                            <td><?php check4($control[0]->dgblock_weed,1)?></td>
                            <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $control[0]->dgblock_damage?></td>
                            <td rowspan="4" width="10%">
                                <table style="vertical-align: top;"> 
                                    <tr class="noBorder">
                                        <td ><?php checkCuase($control[0]->dgblock_remake->no)?></td>
                                        <td>ไม่มี</td>
                                    </tr>
                                    <tr class="noBorder">
                                        <td><?php checkCuase($control[0]->dgblock_remake->nosee)?></td>
                                        <td>มองไม่เห็น</td>
                                    </tr>
                                    <tr class="noBorder">
                                        <td> อื่นๆ </td>
                                        <td class="line"><?php echo $control[0]->dgblock_remake->detail?></td>
                                    </tr>
                                    <tr class="noBorder">
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?php for($i=2;$i<5;$i++){ ?>
                        <tr>
                            <td><?php echo $level[$i-2]?></td>
                            <td><?php check4($control[0]->dgblock_erosion,$i)?></td>
                            <td><?php check4($control[0]->dgblock_subsidence,$i)?></td>
                            <td><?php check4($control[0]->dgblock_cracking,$i)?></td>
                            <td><?php check4($control[0]->dgblock_obstruction,$i)?></td>
                            <td><?php check4($control[0]->dgblock_hole,$i)?></td>
                            <td><?php check4($control[0]->dgblock_leak,$i)?></td>
                            <td><?php check4($control[0]->dgblock_movement,$i)?></td>
                            <td><?php check4($control[0]->dgblock_drainage,$i)?></td>
                            <td><?php check4($control[0]->dgblock_weed,$i)?></td>
                        </tr>
                        <?php } ?>
                <!-- 3.4 -->
                    <tr>
                        <th id="textsurvey" align="left"  rowspan="4">3.4 แท่งสลายพลัง<br>งานน้ำปลายรางเท</th> 
                        <td>ปกติ</td>
                        <td><?php check4($control[0]->waterbreak_erosion,1)?></td>
                        <td><?php check4($control[0]->waterbreak_subsidence,1)?></td>
                        <td><?php check4($control[0]->waterbreak_cracking,1)?></td>
                        <td><?php check4($control[0]->waterbreak_obstruction,1)?></td>
                        <td><?php check4($control[0]->waterbreak_hole,1)?></td>
                        <td><?php check4($control[0]->waterbreak_leak,1)?></td>
                        <td><?php check4($control[0]->waterbreak_movement,1)?></td>
                        <td><?php check4($control[0]->waterbreak_drainage,1)?></td>
                        <td><?php check4($control[0]->waterbreak_weed,1)?></td>
                        <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $control[0]->waterbreak_damage?></td>
                        <td rowspan="4" width="10%">
                            <table style="vertical-align: top;"> 
                                <tr class="noBorder">
                                    <td ><?php checkCuase($control[0]->waterbreak_remake->no)?></td>
                                    <td>ไม่มี</td>
                                </tr>
                                <tr class="noBorder">
                                    <td><?php checkCuase($control[0]->waterbreak_remake->nosee)?></td>
                                    <td>มองไม่เห็น</td>
                                </tr>
                                <tr class="noBorder">
                                    <td> อื่นๆ </td>
                                    <td class="line"><?php echo $control[0]->waterbreak_remake->detail?></td>
                                </tr>
                                <tr class="noBorder">
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php for($i=2;$i<5;$i++){ ?>
                    <tr>
                        <td><?php echo $level[$i-2]?></td>
                        <td><?php check4($control[0]->waterbreak_erosion,$i)?></td>
                        <td><?php check4($control[0]->waterbreak_subsidence,$i)?></td>
                        <td><?php check4($control[0]->waterbreak_cracking,$i)?></td>
                        <td><?php check4($control[0]->waterbreak_obstruction,$i)?></td>
                        <td><?php check4($control[0]->waterbreak_hole,$i)?></td>
                        <td><?php check4($control[0]->waterbreak_leak,$i)?></td>
                        <td><?php check4($control[0]->waterbreak_movement,$i)?></td>
                        <td><?php check4($control[0]->waterbreak_drainage,$i)?></td>
                        <td><?php check4($control[0]->waterbreak_weed,$i)?></td>
                    </tr>
                    <?php } ?>
                <!-- 3.5 -->
                    <tr>
                        <th id="textsurvey" align="left"  rowspan="4">3.5 สะพาน</th> 
                        <td>ปกติ</td>
                        <td><?php check4($control[0]->bridge_erosion,1)?></td>
                        <td><?php check4($control[0]->bridge_subsidence,1)?></td>
                        <td><?php check4($control[0]->bridge_cracking,1)?></td>
                        <td><?php check4($control[0]->bridge_obstruction,1)?></td>
                        <td><?php check4($control[0]->bridge_hole,1)?></td>
                        <td><?php check4($control[0]->bridge_leak,1)?></td>
                        <td><?php check4($control[0]->bridge_movement,1)?></td>
                        <td><?php check4($control[0]->bridge_drainage,1)?></td>
                        <td><?php check4($control[0]->bridge_weed,1)?></td>
                        <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $control[0]->bridge_damage?></td>
                        <td rowspan="4" width="10%">
                            <table style="vertical-align: top;"> 
                                <tr class="noBorder">
                                    <td ><?php checkCuase($control[0]->bridge_remake->no)?></td>
                                    <td>ไม่มี</td>
                                </tr>
                                <tr class="noBorder">
                                    <td><?php checkCuase($control[0]->bridge_remake->nosee)?></td>
                                    <td>มองไม่เห็น</td>
                                </tr>
                                <tr class="noBorder">
                                    <td> อื่นๆ </td>
                                    <td class="line"><?php echo $control[0]->bridge_remake->detail?></td>
                                </tr>
                                <tr class="noBorder">
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php for($i=2;$i<5;$i++){ ?>
                    <tr>
                        <td><?php echo $level[$i-2]?></td>
                        <td><?php check4($control[0]->bridge_erosion,$i)?></td>
                        <td><?php check4($control[0]->bridge_subsidence,$i)?></td>
                        <td><?php check4($control[0]->bridge_cracking,$i)?></td>
                        <td><?php check4($control[0]->bridge_obstruction,$i)?></td>
                        <td><?php check4($control[0]->bridge_hole,$i)?></td>
                        <td><?php check4($control[0]->bridge_leak,$i)?></td>
                        <td><?php check4($control[0]->bridge_movement,$i)?></td>
                        <td><?php check4($control[0]->bridge_drainage,$i)?></td>
                        <td><?php check4($control[0]->bridge_weed,$i)?></td>
                    </tr>
                    <?php } ?>
              <!-- 4 -->
                <tr align="left" style="background-color: #ADADAD;" > 
                    <th colspan="13" >
                        4. ส่วนท้ายน้ำ (Downstream Concrete Section) 
                        <span><?php checkpair(1,$downconcrete[0]->section_status)?> ใช้งานได้  </span>
                        <span><?php checkpair(2,$downconcrete[0]->section_status)?> ควรปรับปรุง  </span>
                        <span><?php checkpair(3,$downconcrete[0]->section_status)?> ควรรื้อถอนก่อสร้างใหม่ </span>
                    </th>
                </tr>
               <!-- 4.1 -->
                    <tr>
                        <th id="textsurvey" align="left">4.1 พื้น (floor)</th> 
                        <td>ปกติ</td>
                        <td><?php check4($downconcrete[0]->floor_erosion,1)?></td>
                        <td><?php check4($downconcrete[0]->floor_subsidence,1)?></td>
                        <td><?php check4($downconcrete[0]->floor_cracking,1)?></td>
                        <td><?php check4($downconcrete[0]->floor_obstruction,1)?></td>
                        <td><?php check4($downconcrete[0]->floor_hole,1)?></td>
                        <td><?php check4($downconcrete[0]->floor_leak,1)?></td>
                        <td><?php check4($downconcrete[0]->floor_movement,1)?></td>
                        <td><?php check4($downconcrete[0]->floor_drainage,1)?></td>
                        <td><?php check4($downconcrete[0]->floor_weed,1)?></td>
                        <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $downconcrete[0]->floor_damage?></td>
                        <td rowspan="4" width="10%">
                            <table style="vertical-align: top;"> 
                                <tr class="noBorder">
                                    <td ><?php checkCuase($downconcrete[0]->floor_remake->no)?></td>
                                    <td>ไม่มี</td>
                                </tr>
                                <tr class="noBorder">
                                    <td><?php checkCuase($downconcrete[0]->floor_remake->nosee)?></td>
                                    <td>มองไม่เห็น</td>
                                </tr>
                                <tr class="noBorder">
                                    <td> อื่นๆ </td>
                                    <td class="line"><?php echo $downconcrete[0]->floor_remake->detail?></td>
                                </tr>
                                <tr class="noBorder">
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">ตะกอน</td> 
                        <td>น้อย</td>
                        <td><?php check4($downconcrete[0]->floor_erosion,2)?></td>
                        <td><?php check4($downconcrete[0]->floor_subsidence,2)?></td>
                        <td><?php check4($downconcrete[0]->floor_cracking,2)?></td>
                        <td><?php check4($downconcrete[0]->floor_obstruction,2)?></td>
                        <td><?php check4($downconcrete[0]->floor_hole,2)?></td>
                        <td><?php check4($downconcrete[0]->floor_leak,2)?></td>
                        <td><?php check4($downconcrete[0]->floor_movement,2)?></td>
                        <td><?php check4($downconcrete[0]->floor_drainage,2)?></td>
                        <td><?php check4($downconcrete[0]->floor_weed,2)?></td>
                    </tr>
                    <tr>
                        <td>
                            <table > 
                                <tr class="noBorder">
                                    <td width="10%"><?php checkpair(1,$downconcrete[0]->check_floor)?></td>
                                    <td width="40%">ปกติ</td>
                                    <td width="10%"><?php checkpair(2,$downconcrete[0]->check_floor)?></td>
                                    <td width="40%">น้อย</td>
                                </tr>
                            </table>
                        </td> 
                        <td>ปานกลาง</td>
                        <td><?php check4($downconcrete[0]->floor_erosion,3)?></td>
                        <td><?php check4($downconcrete[0]->floor_subsidence,3)?></td>
                        <td><?php check4($downconcrete[0]->floor_cracking,3)?></td>
                        <td><?php check4($downconcrete[0]->floor_obstruction,3)?></td>
                        <td><?php check4($downconcrete[0]->floor_hole,3)?></td>
                        <td><?php check4($downconcrete[0]->floor_leak,3)?></td>
                        <td><?php check4($downconcrete[0]->floor_movement,3)?></td>
                        <td><?php check4($downconcrete[0]->floor_drainage,3)?></td>
                        <td><?php check4($downconcrete[0]->floor_weed,3)?></td>
                    </tr>
                    <tr>
                        <td>
                            <table > 
                                <tr class="noBorder">
                                    <td width="10%"><?php checkpair($downconcrete[0]->check_floor,3)?></td>
                                    <td width="40%">ปานกลาง</td>
                                    <td width="10%"><?php checkpair($downconcrete[0]->check_floor,4)?></td>
                                    <td width="40%">มาก</td>
                                </tr>
                            </table>
                        </td> 
                        <td>มาก</td>
                        <td><?php check4($downconcrete[0]->floor_erosion,4)?></td>
                        <td><?php check4($downconcrete[0]->floor_subsidence,4)?></td>
                        <td><?php check4($downconcrete[0]->floor_cracking,4)?></td>
                        <td><?php check4($downconcrete[0]->floor_obstruction,4)?></td>
                        <td><?php check4($downconcrete[0]->floor_hole,4)?></td>
                        <td><?php check4($downconcrete[0]->floor_leak,4)?></td>
                        <td><?php check4($downconcrete[0]->floor_movement,4)?></td>
                        <td><?php check4($downconcrete[0]->floor_drainage,4)?></td>
                        <td><?php check4($downconcrete[0]->floor_weed,4)?></td>
                    </tr>
               <!-- 4.2 -->
                    <tr>
                        <th id="textsurvey" align="left"  rowspan="4">4.2 ลาดด้านข้าง</th> 
                        <td>ปกติ</td>
                        <td><?php check4($downconcrete[0]->side_erosion,1)?></td>
                        <td><?php check4($downconcrete[0]->side_subsidence,1)?></td>
                        <td><?php check4($downconcrete[0]->side_cracking,1)?></td>
                        <td><?php check4($downconcrete[0]->side_obstruction,1)?></td>
                        <td><?php check4($downconcrete[0]->side_hole,1)?></td>
                        <td><?php check4($downconcrete[0]->side_leak,1)?></td>
                        <td><?php check4($downconcrete[0]->side_movement,1)?></td>
                        <td><?php check4($downconcrete[0]->side_drainage,1)?></td>
                        <td><?php check4($downconcrete[0]->side_weed,1)?></td>
                        <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $downconcrete[0]->side_damage?></td>
                        <td rowspan="4" width="10%">
                            <table style="vertical-align: top;"> 
                                <tr class="noBorder">
                                    <td ><?php checkCuase($downconcrete[0]->side_remake->no)?></td>
                                    <td>ไม่มี</td>
                                </tr>
                                <tr class="noBorder">
                                    <td><?php checkCuase($downconcrete[0]->side_remake->nosee)?></td>
                                    <td>มองไม่เห็น</td>
                                </tr>
                                <tr class="noBorder">
                                    <td> อื่นๆ </td>
                                    <td class="line"><?php echo $downconcrete[0]->side_remake->detail?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php for($i=2;$i<5;$i++){ ?>
                    <tr>
                        <td><?php echo $level[$i-2]?></td>
                        <td><?php check4($downconcrete[0]->side_erosion,$i)?></td>
                        <td><?php check4($downconcrete[0]->side_subsidence,$i)?></td>
                        <td><?php check4($downconcrete[0]->side_cracking,$i)?></td>
                        <td><?php check4($downconcrete[0]->side_obstruction,$i)?></td>
                        <td><?php check4($downconcrete[0]->side_hole,$i)?></td>
                        <td><?php check4($downconcrete[0]->side_leak,$i)?></td>
                        <td><?php check4($downconcrete[0]->side_movement,$i)?></td>
                        <td><?php check4($downconcrete[0]->side_drainage,$i)?></td>
                        <td><?php check4($downconcrete[0]->side_weed,$i)?></td>
                    </tr>
                    <?php } ?>
               <!-- 4.3 -->
                    <tr>
                        <th id="textsurvey" align="left"  rowspan="4">4.3 ฟันตะเข้</th> 
                        <td>ปกติ</td>
                        <td><?php check4($downconcrete[0]->flrblock_erosion,1)?></td>
                        <td><?php check4($downconcrete[0]->flrblock_subsidence,1)?></td>
                        <td><?php check4($downconcrete[0]->flrblock_cracking,1)?></td>
                        <td><?php check4($downconcrete[0]->flrblock_obstruction,1)?></td>
                        <td><?php check4($downconcrete[0]->flrblock_hole,1)?></td>
                        <td><?php check4($downconcrete[0]->flrblock_leak,1)?></td>
                        <td><?php check4($downconcrete[0]->flrblock_movement,1)?></td>
                        <td><?php check4($downconcrete[0]->flrblock_drainage,1)?></td>
                        <td><?php check4($downconcrete[0]->flrblock_weed,1)?></td>
                        <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $downconcrete[0]->flrblock_damage?></td>
                        <td rowspan="4" width="10%">
                            <table style="vertical-align: top;"> 
                                <tr class="noBorder">
                                    <td ><?php checkCuase($downconcrete[0]->flrblock_remake->no)?></td>
                                    <td>ไม่มี</td>
                                </tr>
                                <tr class="noBorder">
                                    <td><?php checkCuase($downconcrete[0]->flrblock_remake->nosee)?></td>
                                    <td>มองไม่เห็น</td>
                                </tr>
                                <tr class="noBorder">
                                    <td> อื่นๆ </td>
                                    <td class="line"><?php echo $downconcrete[0]->flrblock_remake->detail?></td>
                                </tr>
                                <tr class="noBorder">
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php for($i=2;$i<5;$i++){ ?>
                    <tr>
                        <td><?php echo $level[$i-2]?></td>
                        <td><?php check4($downconcrete[0]->flrblock_erosion,$i)?></td>
                        <td><?php check4($downconcrete[0]->flrblock_subsidence,$i)?></td>
                        <td><?php check4($downconcrete[0]->flrblock_cracking,$i)?></td>
                        <td><?php check4($downconcrete[0]->flrblock_obstruction,$i)?></td>
                        <td><?php check4($downconcrete[0]->flrblock_hole,$i)?></td>
                        <td><?php check4($downconcrete[0]->flrblock_leak,$i)?></td>
                        <td><?php check4($downconcrete[0]->flrblock_movement,$i)?></td>
                        <td><?php check4($downconcrete[0]->flrblock_drainage,$i)?></td>
                        <td><?php check4($downconcrete[0]->flrblock_weed,$i)?></td>
                    </tr>
                    <?php } ?>
            </table>  
            <div style="height:40px;"></div>
            <table class="table2" border=1>
              <thead>
                <tr style="background-color: #ADADAD;">
                    <th rowspan="2" colspan="2" width="20%" >องค์ประกอบ</th>
                    <th colspan="11" >ผลการตรวจสอบสภาพฝายด้วยสายตา</th>
                </tr>
                <tr style="background-color: #ADADAD;">
                    <th width="6%">การกัดเซาะ</th>
                    <th width="6%">การทรุดตัว</th>
                    <th width="6%">การแตกร้าว</th>
                    <th width="6%">สิ่งกีดขวาง</th>
                    <th width="6%">รูโพรง</th>
                    <th width="6%">การรั่ว</th>
                    <th width="6%">การเคลื่อนตัว</th>
                    <th width="6%">การระบายน้ำ</th>
                    <th width="6%">ต้นไม้/วัชพืช</th>
                    <th width="6%">ขนาดความ<br>เสียหาย</th>
                    <th width="6%">หมายเหตุ</th>
                </tr>
              </thead>
               <!-- 4.4 -->
                    <tr>
                        <th id="textsurvey" align="left"  rowspan="4">4.4 แผงปะทะด้าน<br>ท้ายน้ำ</th> 
                        <td>ปกติ</td>
                        <td><?php check4($downconcrete[0]->endsill_erosion,1)?></td>
                        <td><?php check4($downconcrete[0]->endsill_subsidence,1)?></td>
                        <td><?php check4($downconcrete[0]->endsill_cracking,1)?></td>
                        <td><?php check4($downconcrete[0]->endsill_obstruction,1)?></td>
                        <td><?php check4($downconcrete[0]->endsill_hole,1)?></td>
                        <td><?php check4($downconcrete[0]->endsill_leak,1)?></td>
                        <td><?php check4($downconcrete[0]->endsill_movement,1)?></td>
                        <td><?php check4($downconcrete[0]->endsill_drainage,1)?></td>
                        <td><?php check4($downconcrete[0]->endsill_weed,1)?></td>
                        <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $downconcrete[0]->endsill_damage?></td>
                        <td rowspan="4" width="10%">
                            <table style="vertical-align: top;"> 
                                <tr class="noBorder">
                                    <td ><?php checkCuase($downconcrete[0]->endsill_remake->no)?></td>
                                    <td>ไม่มี</td>
                                </tr>
                                <tr class="noBorder">
                                    <td><?php checkCuase($downconcrete[0]->endsill_remake->nosee)?></td>
                                    <td>มองไม่เห็น</td>
                                </tr>
                                <tr class="noBorder">
                                    <td> อื่นๆ </td>
                                    <td class="line"><?php echo $downconcrete[0]->endsill_remake->detail?></td>
                                </tr>
                                <tr class="noBorder">
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php for($i=2;$i<5;$i++){ ?>
                    <tr>
                        <td><?php echo $level[$i-2]?></td>
                        <td><?php check4($downconcrete[0]->endsill_erosion,$i)?></td>
                        <td><?php check4($downconcrete[0]->endsill_subsidence,$i)?></td>
                        <td><?php check4($downconcrete[0]->endsill_cracking,$i)?></td>
                        <td><?php check4($downconcrete[0]->endsill_obstruction,$i)?></td>
                        <td><?php check4($downconcrete[0]->endsill_hole,$i)?></td>
                        <td><?php check4($downconcrete[0]->endsill_leak,$i)?></td>
                        <td><?php check4($downconcrete[0]->endsill_movement,$i)?></td>
                        <td><?php check4($downconcrete[0]->endsill_drainage,$i)?></td>
                        <td><?php check4($downconcrete[0]->endsill_weed,$i)?></td>
                    </tr>
                    <?php } ?>
              
            
              <!-- 5 -->
                <tr align="left" style="background-color: #ADADAD;" > 
                    <th colspan="13" >
                        5. ส่วน Protection ท้ายน้ำ (Downstream Protection Section) 
                        <span><?php checkpair(1,$downprotection[0]->section_status)?> ใช้งานได้  </span>
                        <span><?php checkpair(2,$downprotection[0]->section_status)?> ควรปรับปรุง  </span>
                        <span><?php checkpair(3,$downprotection[0]->section_status)?> ควรรื้อถอนก่อสร้างใหม่ </span>
                    </th>
                </tr>
               <!-- 5.1 -->
                <tr>
                    <th id="textsurvey" align="left">5.1 พื้น (floor)</th> 
                    <td>ปกติ</td>
                    <td><?php check4($downprotection[0]->floor_erosion,1)?></td>
                    <td><?php check4($downprotection[0]->floor_subsidence,1)?></td>
                    <td><?php check4($downprotection[0]->floor_cracking,1)?></td>
                    <td><?php check4($downprotection[0]->floor_obstruction,1)?></td>
                    <td><?php check4($downprotection[0]->floor_hole,1)?></td>
                    <td><?php check4($downprotection[0]->floor_leak,1)?></td>
                    <td><?php check4($downprotection[0]->floor_movement,1)?></td>
                    <td><?php check4($downprotection[0]->floor_drainage,1)?></td>
                    <td><?php check4($downprotection[0]->floor_weed,1)?></td>
                    <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $downprotection[0]->floor_damage?></td>
                    <td rowspan="4" width="10%">
                        <table style="vertical-align: top;"> 
                            <tr class="noBorder">
                                <td ><?php checkCuase($downprotection[0]->floor_remake->no)?></td>
                                <td>ไม่มี</td>
                            </tr>
                            <tr class="noBorder">
                                <td><?php checkCuase($downprotection[0]->floor_remake->nosee)?></td>
                                <td>มองไม่เห็น</td>
                            </tr>
                            <tr class="noBorder">
                                <td> อื่นๆ </td>
                                <td class="line"><?php echo $downprotection[0]->floor_remake->detail?></td>
                            </tr>
                            <tr class="noBorder">
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="left">ตะกอน</td> 
                    <td>น้อย</td>
                    <td><?php check4($downprotection[0]->floor_erosion,2)?></td>
                    <td><?php check4($downprotection[0]->floor_subsidence,2)?></td>
                    <td><?php check4($downprotection[0]->floor_cracking,2)?></td>
                    <td><?php check4($downprotection[0]->floor_obstruction,2)?></td>
                    <td><?php check4($downprotection[0]->floor_hole,2)?></td>
                    <td><?php check4($downprotection[0]->floor_leak,2)?></td>
                    <td><?php check4($downprotection[0]->floor_movement,2)?></td>
                    <td><?php check4($downprotection[0]->floor_drainage,2)?></td>
                    <td><?php check4($downprotection[0]->floor_weed,2)?></td>
                </tr>
                <tr>
                    <td>
                        <table > 
                            <tr class="noBorder">
                                <td width="10%"><?php checkpair(1,$downprotection[0]->check_floor)?></td>
                                <td width="40%">ปกติ</td>
                                <td width="10%"><?php checkpair(2,$downprotection[0]->check_floor)?></td>
                                <td width="40%">น้อย</td>
                            </tr>
                        </table>
                    </td> 
                    <td>ปานกลาง</td>
                    <td><?php check4($downprotection[0]->floor_erosion,3)?></td>
                    <td><?php check4($downprotection[0]->floor_subsidence,3)?></td>
                    <td><?php check4($downprotection[0]->floor_cracking,3)?></td>
                    <td><?php check4($downprotection[0]->floor_obstruction,3)?></td>
                    <td><?php check4($downprotection[0]->floor_hole,3)?></td>
                    <td><?php check4($downprotection[0]->floor_leak,3)?></td>
                    <td><?php check4($downprotection[0]->floor_movement,3)?></td>
                    <td><?php check4($downprotection[0]->floor_drainage,3)?></td>
                    <td><?php check4($downprotection[0]->floor_weed,3)?></td>
                </tr>
                <tr>
                    <td>
                        <table > 
                            <tr class="noBorder">
                                <td width="10%"><?php checkpair($downprotection[0]->check_floor,3)?></td>
                                <td width="40%">ปานกลาง</td>
                                <td width="10%"><?php checkpair($downprotection[0]->check_floor,4)?></td>
                                <td width="40%">มาก</td>
                            </tr>
                        </table>
                    </td> 
                    <td>มาก</td>
                    <td><?php check4($downprotection[0]->floor_erosion,4)?></td>
                    <td><?php check4($downprotection[0]->floor_subsidence,4)?></td>
                    <td><?php check4($downprotection[0]->floor_cracking,4)?></td>
                    <td><?php check4($downprotection[0]->floor_obstruction,4)?></td>
                    <td><?php check4($downprotection[0]->floor_hole,4)?></td>
                    <td><?php check4($downprotection[0]->floor_leak,4)?></td>
                    <td><?php check4($downprotection[0]->floor_movement,4)?></td>
                    <td><?php check4($downprotection[0]->floor_drainage,4)?></td>
                    <td><?php check4($downprotection[0]->floor_weed,4)?></td>
                </tr>
               <!-- 5.2 -->
                <tr>
                    <th id="textsurvey" align="left"  rowspan="4">5.2 ลาดด้านข้าง</th> 
                    <td>ปกติ</td>
                    <td><?php check4($downprotection[0]->side_erosion,1)?></td>
                    <td><?php check4($downprotection[0]->side_subsidence,1)?></td>
                    <td><?php check4($downprotection[0]->side_cracking,1)?></td>
                    <td><?php check4($downprotection[0]->side_obstruction,1)?></td>
                    <td><?php check4($downprotection[0]->side_hole,1)?></td>
                    <td><?php check4($downprotection[0]->side_leak,1)?></td>
                    <td><?php check4($downprotection[0]->side_movement,1)?></td>
                    <td><?php check4($downprotection[0]->side_drainage,1)?></td>
                    <td><?php check4($downprotection[0]->side_weed,1)?></td>
                    <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $downprotection[0]->side_damage?></td>
                    <td rowspan="4" width="10%">
                        <table style="vertical-align: top;"> 
                            <tr class="noBorder">
                                <td ><?php checkCuase($downprotection[0]->side_remake->no)?></td>
                                <td>ไม่มี</td>
                            </tr>
                            <tr class="noBorder">
                                <td><?php checkCuase($downprotection[0]->side_remake->nosee)?></td>
                                <td>มองไม่เห็น</td>
                            </tr>
                            <tr class="noBorder">
                                <td> อื่นๆ </td>
                                <td class="line"><?php echo $downprotection[0]->side_remake->detail?></td>
                            </tr>
                            <tr class="noBorder">
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php for($i=2;$i<5;$i++){ ?>
                  <tr>
                    <td><?php echo $level[$i-2]?></td>
                    <td><?php check4($downprotection[0]->side_erosion,$i)?></td>
                    <td><?php check4($downprotection[0]->side_subsidence,$i)?></td>
                    <td><?php check4($downprotection[0]->side_cracking,$i)?></td>
                    <td><?php check4($downprotection[0]->side_obstruction,$i)?></td>
                    <td><?php check4($downprotection[0]->side_hole,$i)?></td>
                    <td><?php check4($downprotection[0]->side_leak,$i)?></td>
                    <td><?php check4($downprotection[0]->side_movement,$i)?></td>
                    <td><?php check4($downprotection[0]->side_drainage,$i)?></td>
                    <td><?php check4($downprotection[0]->side_weed,$i)?></td>
                  </tr>
                <?php } ?>

              <!-- 6 -->
                <tr align="left" style="background-color: #ADADAD;" > 
                    <th colspan="13" >
                        6. ระบบส่งน้ำ 
                        <span><?php checkpair(1,$waterdelivery[0]->section_status)?> ใช้งานได้  </span>
                        <span><?php checkpair(2,$waterdelivery[0]->section_status)?> ควรปรับปรุง  </span>
                        <span><?php checkpair(3,$waterdelivery[0]->section_status)?> ควรรื้อถอนก่อสร้างใหม่ </span>
                    </th>
                </tr>
               <!-- 6.1 -->
                <tr>
                    <th id="textsurvey" align="left">6.1 พื้น (floor)</th> 
                    <td>ปกติ</td>
                    <td><?php check4($waterdelivery[0]->floor_erosion,1)?></td>
                    <td><?php check4($waterdelivery[0]->floor_subsidence,1)?></td>
                    <td><?php check4($waterdelivery[0]->floor_cracking,1)?></td>
                    <td><?php check4($waterdelivery[0]->floor_obstruction,1)?></td>
                    <td><?php check4($waterdelivery[0]->floor_hole,1)?></td>
                    <td><?php check4($waterdelivery[0]->floor_leak,1)?></td>
                    <td><?php check4($waterdelivery[0]->floor_movement,1)?></td>
                    <td><?php check4($waterdelivery[0]->floor_drainage,1)?></td>
                    <td><?php check4($waterdelivery[0]->floor_weed,1)?></td>
                    <td rowspan="4" width="8%" style="vertical-align: top;"> <?php echo $waterdelivery[0]->floor_damage?> </td>
                    <td rowspan="4" width="10%">
                        <table style="vertical-align: top;"> 
                            <tr class="noBorder">
                                <td ><?php checkCuase($waterdelivery[0]->floor_remake->no)?></td>
                                <td>ไม่มี</td>
                            </tr>
                            <tr class="noBorder">
                                <td><?php checkCuase($waterdelivery[0]->floor_remake->nosee)?></td>
                                <td>มองไม่เห็น</td>
                            </tr>
                            <tr class="noBorder">
                                <td> อื่นๆ </td>
                                <td class="line"><?php echo $waterdelivery[0]->floor_remake->detail?></td>
                            </tr>
                            <tr class="noBorder">
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="left">ตะกอน</td> 
                    <td>น้อย</td>
                    <td><?php check4($waterdelivery[0]->floor_erosion,2)?></td>
                    <td><?php check4($waterdelivery[0]->floor_subsidence,2)?></td>
                    <td><?php check4($waterdelivery[0]->floor_cracking,2)?></td>
                    <td><?php check4($waterdelivery[0]->floor_obstruction,2)?></td>
                    <td><?php check4($waterdelivery[0]->floor_hole,2)?></td>
                    <td><?php check4($waterdelivery[0]->floor_leak,2)?></td>
                    <td><?php check4($waterdelivery[0]->floor_movement,2)?></td>
                    <td><?php check4($waterdelivery[0]->floor_drainage,2)?></td>
                    <td><?php check4($waterdelivery[0]->floor_weed,2)?></td>
                </tr>
                <tr>
                    <td>
                        <table > 
                            <tr class="noBorder">
                                <td width="10%"><?php checkpair(1,$waterdelivery[0]->check_floor)?></td>
                                <td width="40%">ปกติ</td>
                                <td width="10%"><?php checkpair(2,$waterdelivery[0]->check_floor)?></td>
                                <td width="40%">น้อย</td>
                            </tr>
                        </table>
                    </td> 
                    <td>ปานกลาง</td>
                    <td><?php check4($waterdelivery[0]->floor_erosion,3)?></td>
                    <td><?php check4($waterdelivery[0]->floor_subsidence,3)?></td>
                    <td><?php check4($waterdelivery[0]->floor_cracking,3)?></td>
                    <td><?php check4($waterdelivery[0]->floor_obstruction,3)?></td>
                    <td><?php check4($waterdelivery[0]->floor_hole,3)?></td>
                    <td><?php check4($waterdelivery[0]->floor_leak,3)?></td>
                    <td><?php check4($waterdelivery[0]->floor_movement,3)?></td>
                    <td><?php check4($waterdelivery[0]->floor_drainage,3)?></td>
                    <td><?php check4($waterdelivery[0]->floor_weed,3)?></td>
                </tr>
                <tr>
                    <td>
                        <table > 
                            <tr class="noBorder">
                                <td width="10%"><?php checkpair($waterdelivery[0]->check_floor,3)?></td>
                                <td width="40%">ปานกลาง</td>
                                <td width="10%"><?php checkpair($waterdelivery[0]->check_floor,4)?></td>
                                <td width="40%">มาก</td>
                            </tr>
                        </table>
                    </td> 
                    <td>มาก</td>
                    <td><?php check4($waterdelivery[0]->floor_erosion,4)?></td>
                    <td><?php check4($waterdelivery[0]->floor_subsidence,4)?></td>
                    <td><?php check4($waterdelivery[0]->floor_cracking,4)?></td>
                    <td><?php check4($waterdelivery[0]->floor_obstruction,4)?></td>
                    <td><?php check4($waterdelivery[0]->floor_hole,4)?></td>
                    <td><?php check4($waterdelivery[0]->floor_leak,4)?></td>
                    <td><?php check4($waterdelivery[0]->floor_movement,4)?></td>
                    <td><?php check4($waterdelivery[0]->floor_drainage,4)?></td>
                    <td><?php check4($waterdelivery[0]->floor_weed,4)?></td>
                </tr>
               <!-- 6.2 -->
                <tr>
                    <th id="textsurvey" align="left"  rowspan="4">6.2 ลาดด้านข้าง</th> 
                    <td>ปกติ</td>
                    <td><?php check4($waterdelivery[0]->side_erosion,1)?></td>
                    <td><?php check4($waterdelivery[0]->side_subsidence,1)?></td>
                    <td><?php check4($waterdelivery[0]->side_cracking,1)?></td>
                    <td><?php check4($waterdelivery[0]->side_obstruction,1)?></td>
                    <td><?php check4($waterdelivery[0]->side_hole,1)?></td>
                    <td><?php check4($waterdelivery[0]->side_leak,1)?></td>
                    <td><?php check4($waterdelivery[0]->side_movement,1)?></td>
                    <td><?php check4($waterdelivery[0]->side_drainage,1)?></td>
                    <td><?php check4($waterdelivery[0]->side_weed,1)?></td>
                    <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $waterdelivery[0]->side_damage?></td>
                    <td rowspan="4" width="10%">
                        <table style="vertical-align: top;"> 
                            <tr class="noBorder">
                                <td ><?php checkCuase($waterdelivery[0]->side_remake->no)?></td>
                                <td>ไม่มี</td>
                            </tr>
                            <tr class="noBorder">
                                <td><?php checkCuase($waterdelivery[0]->side_remake->nosee)?></td>
                                <td>มองไม่เห็น</td>
                            </tr>
                            <tr class="noBorder">
                                <td> อื่นๆ </td>
                                <td class="line"><?php echo $waterdelivery[0]->side_remake->detail?></td>
                            </tr>
                            <tr class="noBorder">
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php for($i=2;$i<5;$i++){ ?>
                  <tr>
                    <td><?php echo $level[$i-2]?></td>
                    <td><?php check4($waterdelivery[0]->side_erosion,$i)?></td>
                    <td><?php check4($waterdelivery[0]->side_subsidence,$i)?></td>
                    <td><?php check4($waterdelivery[0]->side_cracking,$i)?></td>
                    <td><?php check4($waterdelivery[0]->side_obstruction,$i)?></td>
                    <td><?php check4($waterdelivery[0]->side_hole,$i)?></td>
                    <td><?php check4($waterdelivery[0]->side_leak,$i)?></td>
                    <td><?php check4($waterdelivery[0]->side_movement,$i)?></td>
                    <td><?php check4($waterdelivery[0]->side_drainage,$i)?></td>
                    <td><?php check4($waterdelivery[0]->side_weed,$i)?></td>
                  </tr>
                <?php } ?>
               <!-- 6.3 -->
                <tr>
                    <th id="textsurvey" align="left"  rowspan="4">6.3 ประตูน้ำ/ปากคลอง</th> 
                    <td>ปกติ</td>
                    <td><?php check4($waterdelivery[0]->gate_erosion,1)?></td>
                    <td><?php check4($waterdelivery[0]->gate_subgatence,1)?></td>
                    <td><?php check4($waterdelivery[0]->gate_cracking,1)?></td>
                    <td><?php check4($waterdelivery[0]->gate_obstruction,1)?></td>
                    <td><?php check4($waterdelivery[0]->gate_hole,1)?></td>
                    <td><?php check4($waterdelivery[0]->gate_leak,1)?></td>
                    <td><?php check4($waterdelivery[0]->gate_movement,1)?></td>
                    <td><?php check4($waterdelivery[0]->gate_drainage,1)?></td>
                    <td><?php check4($waterdelivery[0]->gate_weed,1)?></td>
                    <td rowspan="4" width="8%" style="vertical-align: top;"><?php echo $waterdelivery[0]->gate_damage?></td>
                    <td rowspan="4" width="10%">
                        <table style="vertical-align: top;"> 
                            <tr class="noBorder">
                                <td ><?php checkCuase($waterdelivery[0]->gate_remake->no)?></td>
                                <td>ไม่มี</td>
                            </tr>
                            <tr class="noBorder">
                                <td><?php checkCuase($waterdelivery[0]->gate_remake->nosee)?></td>
                                <td>มองไม่เห็น</td>
                            </tr>
                            <tr class="noBorder">
                                <td> อื่นๆ </td>
                                <td class="line"><?php echo $waterdelivery[0]->gate_remake->detail?></td>
                            </tr>
                            <tr class="noBorder">
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php for($i=2;$i<5;$i++){ ?>
                  <tr>
                    <td><?php echo $level[$i-2]?></td>
                    <td><?php check4($waterdelivery[0]->gate_erosion,$i)?></td>
                    <td><?php check4($waterdelivery[0]->gate_subsidence,$i)?></td>
                    <td><?php check4($waterdelivery[0]->gate_cracking,$i)?></td>
                    <td><?php check4($waterdelivery[0]->gate_obstruction,$i)?></td>
                    <td><?php check4($waterdelivery[0]->gate_hole,$i)?></td>
                    <td><?php check4($waterdelivery[0]->gate_leak,$i)?></td>
                    <td><?php check4($waterdelivery[0]->gate_movement,$i)?></td>
                    <td><?php check4($waterdelivery[0]->gate_drainage,$i)?></td>
                    <td><?php check4($waterdelivery[0]->gate_weed,$i)?></td>
                  </tr>
                <?php } ?>
            </table>
        </div>
        <div class="text">
            <div class="text3">5. แผนการดำเนินการแก้ไขของหน่วยงาน </div>
            <div class="text4"> 
                <table>
                    <tr>
                        <td width=10%><?php checkCuase($plan[0]->plan_year_check)?>&nbsp;อยู่ในแผน</td>
                        <td class="line" width=10%><?php echo $plan[0]->plan_year?> </td>
                        <td width=15%>ปี  ลักษณะโครงการ</td>
                        <td class="line" width=15%>&nbsp;&nbsp;<?php echo $plan[0]->plan_type?> </td>
                        <td width=10%> งบประมาณ</td>
                        <td class="line" width=10%>&nbsp;&nbsp;<?php echo $plan[0]->plan_budget?> .</td>
                        <td> บาท</td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php checkCuase($plan[0]->proj_budget_check)?>&nbsp;ได้รับงบประมาณแล้ว</td>
                        <td class="line" width=10%><?php echo $plan[0]->proj_budget?> </td>
                        <td>บาท    ลักษณะโครงการ</td>
                        <td colspan="2" class="line" width=10%><?php echo $plan[0]->proj_type?> </td>
                    </tr>
                    <tr>
                        <td colspan="3"><?php checkCuase($plan[0]->plan_improve)?>&nbsp;กำลังปรับปรุงหรือก่อสร้าง</td>
                        <td colspan="3"><?php checkCuase($plan[0]->plan_no)?>&nbsp;ยังไม่มีในแผน</td>
                    </tr>
                </table>
            </div>
        <div class="text3">6. ความเห็นและข้อสังเกตเพิ่มเติม </div>
                <div class="text4" > 
                    <textarea rows="50" cols="200" style="border: none">
                        <font class="line"><?php echo $sug[0]->suggestion?></font>
                    </textarea>
                </div>
        </div>
        <br>
        <div class="page-break"></div>
            <div class="text3" >7. รูปประกอบ </div>
                <div class="text4"> 
                    <table calss="table3" border=1>
                        <tr style="background-color: #ADADAD;">
                            <td id="textsurvey">1.ส่วน Protection เหนือน้ำ </td>
                        </tr>
                        <tr>
                            <td style="height:100px;"> 
                                <?php for($i=0;$i<count($photo1);$i++){ ?>
                                    <?php checkphoto($photo1[$i]["file"])?>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr style="background-color: #ADADAD;">
                            <td id="textsurvey" >2.ส่วนเหนือน้ำ  </td>
                        </tr>
                        <tr>
                            <td style="height:100px;">
                                <?php for($i=0;$i<count($photo2);$i++){ ?>
                                    <?php checkphoto($photo2[$i]["file"])?>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr style="background-color: #ADADAD;">
                            <td id="textsurvey"  >3.ส่วนควบคุม</td>
                        </tr>
                        <tr>
                            <td style="height:100px;">
                                <?php for($i=0;$i<count($photo3);$i++){ ?>
                                    <?php checkphoto($photo3[$i]["file"])?>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr style="background-color: #ADADAD;">
                            <td id="textsurvey" >4.ส่วนท้ายน้ำ </td>
                        </tr>
                        <tr>
                            <td style="height:100px;">
                                <?php for($i=0;$i<count($photo4);$i++){ ?>
                                    <?php checkphoto($photo4[$i]["file"])?>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr style="background-color: #ADADAD;">
                            <td id="textsurvey"  >5.ส่วน Protection ท้ายน้ำ </td>
                        </tr>
                        <tr>
                            <td style="height:100px;">
                                <?php for($i=0;$i<count($photo5);$i++){ ?>
                                    <?php checkphoto($photo5[$i]["file"])?>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr style="background-color: #ADADAD;">
                            <td id="textsurvey" >6.ระบบส่งน้ำ </td>
                        </tr>
                        <tr>
                            <td style="height:100px;">
                                <?php for($i=0;$i<count($photo6);$i++){ ?>
                                    <?php checkphoto($photo6[$i]["file"])?>
                                <?php } ?>
                            </td>
                        </tr>
                    </tablr>
                </div>
            </div>
        </div>
    </body>
</html>
