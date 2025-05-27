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
        src: url("{{ asset('fonts/THSarabunNew.ttf')}}") format('truetype');
        }

        body{
        font-family: "THSarabunNew";
        font-size: 14px;
        line-height:1;
        }
        @page {
            size: A4;
            padding: 10px;
            }
        @media print {
            html, body {
                width: 210mm;
                height: 300mm;
                font-size : 14px;
            }
        }
        html { margin-bottom: 0px}
        div.text06 {
            text-align:left;
            padding-top: -10px;
            line-height: 1;
        
        }div.text {
                padding-top: -10px;
                line-height: 1;
                font-size: 14px;
        }
        div.text01 {
            text-align:left;
            padding-top: -10px;
            line-height: 1;
        }.texthead{
            font-size: 16px;
            text-align: center;
            font-weight: bold;
            margin-top: 5px;
            line-height:90%;
        }.text2{
            font-size: 14px;
            text-align: center;
            font-weight: bold;
            margin-top: 5px;
            line-height:70%;
            
        }.text3{
            font-size: 16px;
            font-weight: bold;
            line-height:1;
            margin-top:-5px;
        }.text4{
            font-size: 14px;
            line-height:1;
            margin-left: 5px;
            padding-left: 5px;
            position:absolute;
        }table { 
            width:100%;
            background-color:transparent;
            border-collapse: collapse;
            text-align: center;
            -fs-table-paginate: paginate;
        }tr,td { 
            padding-top:-10px;
        }#customers {
            border: 1px solid #6d6d6d;
            border-collapse: collapse;
            width: 100%;
            text-align:left;
        }
        #customers td {
            padding-left: 4px;
        }#customers th {
            border: 1px solid #6d6d6d;
        }.number_format{
            margin-top:-40px;
        }.table1{
            text-align: left;
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #6d6d6d;
        }.table3{
            font-size:14px;
            text-align: left;
        }.table5{
            font-size:14px;
            text-align: left;
            width: 100%;
        }
        .table4{
            font-size:14px;
            text-align: left;
            border-collapse: collapse;
            border: 1px solid black;
        }       
        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 2cm;
            color:#000;
            text-align: right;
            line-height: 1.5cm;
            content: counter(page);
        }
        
        
    </style>
    <style>
       .ck{
            margin: 2px 3px 0 2px;
        }.text_table{
            margin-left: 5px;
            padding-left: 5px;
            position:absolute;
        }
        .detail_img{
            width: 80%;
            margin: 2px 0 0 12px;
            text-align: center;
            position:absolute;
        }
        .page-break {
            page-break-after: always;
        }
        
    </style>
 </head>
    <body>
        <div class="row" align="center" style="page-break-after:always; margin-top:60px;"> 
            <table align="center" class="customers" width="80%">
                <tr >
                    <td width="30%" class="customers"><img src="images/footer/hii.png" width="100px"></td>
                    <td  class="customers"><font style="font-size:70px;"><b>รายงานสรุป</b></font></td>
                    <td width="30%" class="customers"><img src="images/footer/cmu.png" width="100px"></td>
                </tr>
                <tr>
                    <td colspan="3" height=200px; class="customers"> <font style="font-size:40px;"><b>ข้อมูลสภาพปัญหาและแนวทางแก้ไขปัญหาเบื้องต้นของฝาย</b></td>
                </tr>
                <tr>
                    <td colspan="3" height=200px; class="customers"> <font style="font-size:60px;"><b><?php echo $text_tm ?> <br> <?php echo $text_amp ?> จังหวัดแพร่</b></td>
                </tr>
                <tr>
                    <td colspan="3" height=200px; class="customers"> <font style="font-size:28px;"><b>โครงการพัฒนาระบบการสำรวจและฐานข้อมูลเพื่อบริหารจัดการพื้นที่เสี่ยงภัยน้ำท่วมและภัยแล้ง <br>ระดับจังหวัดในพื้นที่ภาคเหนือตอนบน (ระยะที่ 1)<b></td>
                </tr>
                <tr>
                    <td colspan="3" > <font style="font-size:22px;"><b>สถาบันสารสนเทศทรัพยากรน้ำ (องค์การมหาชน) มหาวิทยาลัยเชียงใหม่ <b></td>
                </tr>
            </table>

        </div>
        <!-- <footer>
            <div class="social"><u>หมายเหตุ</u> ข้อมูลใช้เพื่อการศึกษาวางแผน ไม่สามารถใช้อ้างอิงทางกฎหมายและคดีความ </div>
            <div style="clear: both"></div>
        </footer> -->
        <?php 
            function checkphoto($text){
                if($text!=NULL){
                    $img=$text;
                    echo "<img src='{$img}'  width=140px; style='margin:8px 0 -10px 20px;'>";
                }else{ echo "";}	
            }
            function checkphoto1($text){
                if($text!=NULL){
                    $img=$text;
                    echo "<img src='{$img}'  width=140px; style='margin:-14px 0 0px 20px;'>";
                }else{ echo "";}	
            }
            function checkCuase($text) {
                if($text!=NULL){
                    echo $text;	
                }else{
                    echo "-";	
                }
            }
            function checkhas($text) {
                if($text==1){
                echo "มี";	
            }else{
                    echo "ไม่มี";	
            } 
            }
            function checkpair($text,$i) {
                if($i==$text){echo "<img src='images/logo/check.png'  width=12px;>";	
                }else{ echo "<img src='images/logo/square.png'  width=12px;>";} 
            }
        ?>
        <?php if($num==0){ ?> 
            <div class="page-break"></div>
            <center><h2> - - - - - ไม่มีข้อมูล - - - - -  </h2></center>
        <?php }

            for($i=0;$i<$num;$i++){ ?>
               
                <div class="headname">
                    <table align="center">
                        <td width="15%" align="right" >
                            <img src='images/footer/hii.png' width="40px">
                        
                        </td>
                        <td width="70%">
                            <div class="texthead"> <b>การตรวจสภาพฝายและแนวทางแก้ไขปรับปรุงเพื่อเพิ่มประสิทธิภาพฝาย </b></div>
                        </td>
                        <td width="15%" align="left">
                            <img src='images/footer/cmu.png' width="30px"></td>
                        </td>    
                    </table>          
                </div>
                <div class="row justify-content-end" align="right" style="margin-top:-5px;">
                    <div class="col-2"><b>รหัสฝายที่ :</b> <?php echo$result[$i]['weir'][0]['weir_code'] ?> </div> 
                </div>
                <?php 
                    $level=["น้อย","ปานกลาง","มาก"];
                    $code=str_split($result[$i]['weir'][0]->weir_code );
                    $text= explode(" ",$result[$i]['location'][0]->weir_village);
                    $moo = $text[1];
                    $tambol=$text[2];
                    $s_lat=str_split($result[$i]['locationUTM']->x);
                    $s_lng=str_split($result[$i]['locationUTM']->y);

                ?>
                <div class="text06">
                    <table style="text-align:left;">
                        <tr>
                            <td width="20%"><b>ชื่อฝาย </b> <?php  echo($result[$i]['weir'][0]->weir_name) ; ?> </td>
                            <td width="15%"><b>ชื่อลำน้ำ</b> &nbsp;&nbsp; <?php echo $result[$i]['river'][0]->river_name ?> </td>
                        <td width="20%"><b>ลำน้ำสาขาของ </b> &nbsp;&nbsp; <?php echo $result[$i]['river'][0]->river_branch	 ?> </td>
                        <td width="15%"><b>ประเภทลำน้ำ </b>  &nbsp;&nbsp; <?php echo $result[$i]['river'][0]->river_type ?> </td> 
                        <td width="20%"> <b>วันที่สำรวจ </b>  &nbsp;&nbsp; <?php echo $result[$i]['date'] ?></td>
                        </tr>
                    </table>
                    <table style="text-align:left;">
                        <tr>
                            <td width="30%"><b>หมู่บ้าน </b> หมู่ที่ &nbsp;<?php echo$moo ?>&nbsp;<?php echo$tambol ?></td>
                            <td width="15%"><b>ตำบล </b> &nbsp;<?php echo$result[$i]['location'][0]->weir_tumbol ?></td>
                            <td width="15%"><b>อำเภอ </b> &nbsp;<?php echo$result[$i]['location'][0]->weir_district ?></td>
                            <td width="15%"><b>จังหวัด </b> &nbsp;ลำปาง</td>
                            <td  >&nbsp;</td>
                        </tr>
                    </table>
                    <table style="text-align:left;">
                        <tr>
                            <td width="18%"><b>ก่อสร้าง เมื่อปี พ.ศ.</b> &nbsp;<?php echo $result[$i]['weir'][0]->weir_build ?></td>
                            <td width="20%"><b>อายุฝาย </b> &nbsp;<?php echo $result[$i]['weir'][0]->weir_age ?></td>
                            <td width="30%"> <b>หน่วยงานรับผิดชอบ </b> &nbsp;<?php checkCuase($result[$i]['weir'][0]->resp_name) ?> </td>
                            <td> <?php echo$result[$i]['model_text']['text3']."  ".$result[$i]['model_text']['text1']." ".$result[$i]['model_text']['text2'] ?></td>
                        </tr>
                    </table>
                </div>
                <div class="text">
                    <table border=1 >
                        <thead>
                            <tr>
                            <th colspan="4" class="text-center" style="background-color:#C0C0C0">พิกัดฝาย</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="line-height: 12px; ">
                                <td width="15%">X(UTM)</td>
                                <td width="35%"><?php echo$result[$i]['locationUTM']->x ?></td>
                                <td width="15%">Y(UTM)</td>
                                <td width="35%"><?php echo$result[$i]['locationUTM']->y ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text" style="margin-top:3px;">
                    <table id="customers" >
                        <tr align="center"><th colspan="5" class="text-center" style="background-color:#C0C0C0">ลักษณะทั่วไป</th></tr>
                        <tr>
                            <td colspan="2">ประเภทของสันฝาย :   &nbsp;<?php echo$result[$i]['space'][0]->ridge_type->type ?> </td>
                            <td >ความสูงสันฝาย :  &nbsp;<?php echo$result[$i]['space'][0]->ridge_height ?>  &nbsp;เมตร</td>
                            <td colspan="2">ความยาวสันฝาย :  &nbsp;<?php echo$result[$i]['space'][0]->ridge_width ?>  &nbsp;เมตร</td>
                        </tr>
                        <tr>
                            <td  > ประตูระบายน้ำ :   &nbsp;<?php checkhas($result[$i]['space'][0]->gate_has) ?> </td>
                            <?php if($result[$i]['space'][0]->gate_machanic_type!=NULL){ ?> 
                                <td >ชนิดบานประตู :  &nbsp;<?php checkCuase($result[$i]['space'][0]->gate_type) ?> </td>
                                <td >ขนาด (กว้าง*สูง) : &nbsp; <?php checkCuase($result[$i]['space'][0]->gate_dimension->size) ?></td>
                                <td >จำนวน : &nbsp; <?php checkCuase($result[$i]['space'][0]->gate_dimension->num) ?>&nbsp;ชุด</td>
                                <td>ชนิดเครื่องยกบาน : &nbsp; <?php checkCuase($result[$i]['space'][0]->gate_machanic_type) ?></td>
                            <?php } else{?>
                                <td colspan="4">ชนิดบานประตู :  &nbsp;<?php checkCuase($result[$i]['space'][0]->gate_type) ?>  &nbsp; &nbsp; &nbsp;
                                ขนาด (กว้าง*สูง) : &nbsp; <?php checkCuase($result[$i]['space'][0]->gate_dimension->size) ?> &nbsp; &nbsp; &nbsp;
                                จำนวน : &nbsp; <?php checkCuase($result[$i]['space'][0]->gate_dimension->num) ?>&nbsp;ชุด &nbsp; &nbsp; &nbsp;
                                ชนิดเครื่องยกบาน : &nbsp; <?php checkCuase($result[$i]['space'][0]->gate_machanic_type) ?></td>
                            <?php }?>
                            
                            
                        </tr>
                        <tr>
                            <td > อาคารบังคับน้ำ :   &nbsp;<?php checkhas($result[$i]['space'][0]->control_building_has) ?> </td>
                            <td ><?php echo$result[$i]['building']['side'] ?> </td>
                            <td ><?php echo$result[$i]['building']['text1'] ?> </td>
                            <?php if($result[$i]['building']['text3']!=NULL){?> 
                                <td><?php echo$result[$i]['building']['text2'] ?> </td>
                                <td ><?php echo$result[$i]['building']['text3'] ?> </td>
                            <?php }else{ ?>
                                <td colspan="2"><?php echo$result[$i]['building']['text2'] ?> </td>
                            <?php } ?>

                        </tr>
                        <tr>
                            <td > ระบบส่งน้ำ :  <?php checkhas($result[$i]['space'][0]->canal_has) ?> </td>
                            <td >ลักษณะคลอง :<?php checkCuase($result[$i]['space'][0]->canal_type) ?> </td>
                            <td >ขนาดกันคลองกว้าง : <?php checkCuase($result[$i]['space'][0]->canel_dimension->width) ?>&nbsp;เมตร</td>
                            <td colspan="2">ความยาวประมาณ : <?php checkCuase($result[$i]['space'][0]->canel_dimension->lenght) ?>&nbsp;กิโลเมตรเมตร</td>
                        </tr>
                        <tr>
                            <td colspan="5"> <b>ข้อมูลประวัติการซ่อม : </b>  &nbsp;</td>
                        </tr>
                        <tr align="center" style="background-color:#C0C0C0">
                            <th>ปี พ.ศ.</th>
                            <th colspan="2">รายการซ่อม</th>
                            <th>หน่วยงาน</th>
                            <th >หมายเหตุ</th>
                        </tr>
                        <?php 
                            if($result[$i]['mt']==1){$c=1;}
                            else{$c=$result[$i]['mt']-1;}
                            for($y=0;$y<$c;$y++){ ?>
                            <tr style="line-height: 12px; text-align:center;">
                                <td style="border: 1px #6d6d6d;"><?php echo$result[$i]['maintain'][$y]['maintain_date'] ?>&nbsp;</td>
                                <td colspan="2" style="border: 1px #6d6d6d;"><?php echo$result[$i]['maintain'][$y]['maintain_detail'] ?>&nbsp;</td>
                                <td style="border: 1px #6d6d6d;"><?php echo$result[$i]['maintain'][$y]['maintain_resp'] ?>&nbsp;</td>
                                <td  style="border: 1px #6d6d6d;"><?php echo$result[$i]['maintain'][$y]['maintain_remark'] ?>&nbsp;</td>
                            </tr>  
                        <?php } ?>
                    </table>
                </div>

                <div class="text">
                    <div class="text3">ผลการตรวจสอบสภาพฝาย </div>
                    <table class="table3" border=1>
                        <tr align="center"><th colspan="4" class="text-center" style="background-color:#C0C0C0">สภาพฝายของแต่ละองค์ประกอบ (Element)</th></tr>
                        <tr style="background-color:#DFDFDF">
                            <td width="40%"><b>1. ส่วนป้องกันเหนือน้ำ : </b>
                                <span><?php checkpair(1,$damage[$i][0])?> ใช้งานได้ดี  </span>
                                <span><?php checkpair(2,$damage[$i][0])?> ปานกลาง  </span>
                                <span><?php checkpair(3,$damage[$i][0])?> ทรุดโทรม </span>
                            </td>
                            <td style="text-align:center;" width="10%"><?php echo $sediment[$i]['check1']; ?></td>
                            <td width="40%"><b>2. ส่วนเหนือน้ำ   : </b>
                                <span><?php checkpair(1,$damage[$i][1])?> ใช้งานได้ดี  </span>
                                <span><?php checkpair(2,$damage[$i][1])?> ปานกลาง  </span>
                                <span><?php checkpair(3,$damage[$i][1])?> ทรุดโทรม </span>
                            </td>
                            <td style="text-align:center;" width="10%"><?php echo $sediment[$i]['check2']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="height:72px;" ><br>
                                <?php 
                                    for($j=0;$j<2;$j++){?>
                                    <?php checkphoto($result[$i]['photo1'][$j]["file"]) ?>
                                <?php } ?>
                            </td>
                            <td colspan="2" style="height:72px;"><br>
                                <?php 
                                    for($j=0;$j<2;$j++){?>
                                    <?php checkphoto($result[$i]['photo2'][$j]["file"]) ?>
                                <?php } ?>
                            </td>
                        </tr>
                        <!--  -->
                        <tr  style="background-color:#DFDFDF" >
                            <td colspan="2"><b>3. ส่วนควบคุมน้ำ :</b>
                                <span><?php checkpair(1,$damage[$i][2])?> ใช้งานได้ดี  </span>
                                <span><?php checkpair(2,$damage[$i][2])?> ปานกลาง  </span>
                                <span><?php checkpair(3,$damage[$i][2])?> ทรุดโทรม </span>
                            </td>
                            <td><b>4. ส่วนท้ายน้ำ : </b>
                                <span><?php checkpair(1,$damage[$i][3])?> ใช้งานได้ดี  </span>
                                <span><?php checkpair(2,$damage[$i][3])?> ปานกลาง  </span>
                                <span><?php checkpair(3,$damage[$i][3])?> ทรุดโทรม </span>
                            </td>
                            <td style="text-align:center;" width="10%"><?php echo $sediment[$i]['check4']; ?></td>
                        </tr>
                        <tr>
                            <td style="height:72px;" colspan="2"> <br>
                                
                                <?php 
                                    for($j=0;$j<2;$j++){?>
                                    <?php checkphoto($result[$i]['photo3'][$j]["file"]) ?>
                                <?php } ?>
                            </td>

                            <td style="height:72px;" colspan="2"><br>
                                <?php  
                                    for($j=0;$j<2;$j++){?>
                                    <?php checkphoto($result[$i]['photo4'][$j]["file"]) ?>
                                <?php } ?>
                            </td>
                        </tr>
                        <!--  -->
                         <tr style="background-color:#DFDFDF">
                            <td ><b>5. ส่วนป้องกันท้ายน้ำ : </b>
                                <span><?php checkpair(1,$damage[$i][4])?> ใช้งานได้ดีดี  </span>
                                <span><?php checkpair(2,$damage[$i][4])?> ปานกลาง  </span>
                                <span><?php checkpair(3,$damage[$i][4])?> ทรุดโทรม </span>
                            </td>
                            <td style="text-align:center;" width="10%"><?php echo $sediment[$i]['check5']; ?></td>
                            <td ><b>6. ระบบส่งน้ำ : </b>
                                <span><?php checkpair(1,$damage[$i][5])?> ใช้งานได้ดีดี  </span>
                                <span><?php checkpair(2,$damage[$i][5])?> ปานกลาง  </span>
                                <span><?php checkpair(3,$damage[$i][5])?> ทรุดโทรม </span>
                            </td>
                            <td style="text-align:center;" width="10%"><?php echo $sediment[$i]['check6']; ?></td>
                        </tr>
                        <tr>
                            <td style="height:72px;" colspan="2"><br>
                                <?php 
                                    for($j=0;$j<2;$j++){?>
                                    <?php checkphoto($result[$i]['photo5'][$j]["file"]) ?>
                                <?php } ?>
                            </td>
                            <td style="height:72px;" colspan="2"><br>
                                <?php  
                                    for($j=0;$j<2;$j++){?>
                                    <?php checkphoto($result[$i]['photo6'][$j]["file"]) ?>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="text">
                    <table class="table5" border=1 style="margin-top:3px;">                   
                        <tr>
                            <th style="background-color:#C0C0C0; text-align:center" width="50%" colspan="2">พื้นที่รับน้ำของฝายและข้อมูลประกอบ </th>
                            <th style="background-color:#C0C0C0; text-align:center" width="50%">สภาพโดยรวมของฝายและแนวทางแก้ไขปรับปรุงเบื้องต้น </th>
                        </tr>
                        <tr>
                            <td  width="25%"> <center><img src="<?php echo($result[$i]['expert'][0]->map); ?>"  width="90%" ></center>  </td>
                            <td  width="25%" valign="top" class="text_table"> 
                                <u>ข้อมูลพื้นที่รับน้ำของฝาย</u><br>
                                A = <?php echo $result[$i]['area']->area  ?>  ตารางกิโลเมตร <BR>
                                L = <?php echo $result[$i]['area']->L ?>  กิโลเมตร <BR>
                                LC = <?php echo $result[$i]['area']->LC ?> กิโลเมตร <BR>
                                H = <?php echo $result[$i]['area']->H ?> เมตร <BR>
                                s = <?php echo $result[$i]['area']->S ?>  <BR>
                                <?php if($result[$i]['area']->area<25){?>
                                    c = <?php echo $result[$i]['area']->c; ?> <BR>
                                    I = <?php echo $result[$i]['area']->I ; ?> มิลลิเมตร/ชั่วโมง <BR>
                                    Return period = <?php echo $result[$i]['area']->Return_period ?> ปี <BR>
                                    อัตราการไหลสูงสุด  = <?php echo $result[$i]['area']->flow  ?> ลบ.ม./วินาที
                                <?php } else{ ?> 
                                    Return period = <?php echo $result[$i]['area']->Return_period ?> ปี <BR>
                                    อัตราการไหลสูงสุด  = <?php echo $result[$i]['area']->flow  ?> ลบ.ม./วินาที
                                   
                                <?php } ?>  
                            </td>
                            <td valign="top" class="text4">
                                <b>สภาพโดยรวมของฝาย  </b> <br> 
                                <?php echo $result[$i]['expert'][0]->weir_problem ?> <br>
                                <b>แนวทางแก้ไขปรับปรุงเบื้องต้น  </b> <br> 
                                <?php echo $result[$i]['expert'][0]->weir_solution ?>
                            </td>
                        </tr>
                    </table>
                </div>


                <div class="page-break"></div>
            <?php } ?> <!-- end for  -->
            
       
      
    </body>
</html>
