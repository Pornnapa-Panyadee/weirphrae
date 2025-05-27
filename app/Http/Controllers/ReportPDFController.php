<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http; // Import the Http facade

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PDF;
use DB;
use Auth;
use AuthenticatesUsers;
use App\Models\Location;
use App\Models\AdditinalSuggestion;
use App\Models\DownconcreteInv;
use App\Models\DownprotectionInv;
use App\Models\WeirSurvey;
use App\Models\ControlInv;
use App\Models\ImprovementPlan;
use App\Models\Maintenance;
use App\Models\Photo;
use App\Models\River;
use App\Models\UpconcreteInv;
use App\Models\UpprotectionInv;
use App\Models\User;
use App\Models\WaterdeliveryInv;
use App\Models\WeirLocation;
use App\Models\WeirSpaceification;
use App\Models\WeirExpert;
use App\Models\Impovement;
use App\Models\WeirCatchment;


class ReportPDFController extends Controller
{
    public function pdf_index($weir_id=0) {
        // dd(Auth::user()->name);
        // $user = Auth::user()->name;
        ini_set('max_execution_time', 300);
        $weir = WeirSurvey::select('*')->where('weir_code',$weir_id)->get();
        if(!empty($weir[0]['weir_id'])){
            $location = WeirLocation::select('*')->where('weir_location_id',$weir[0]->weir_location_id)->get();
            $river = River::select('*')->where('river_id',$weir[0]->river_id)->get();
            $districtData['data'] = Location::getDistrictCR();
            $space = WeirSpaceification::select('*')->where('weir_spec_id',$weir[0]->weir_spec_id)->get();
            $upprotection = UpprotectionInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $upconcrete = UpconcreteInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $control = ControlInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $downconcrete = DownconcreteInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $downprotection = DownprotectionInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $waterdelivery = WaterdeliveryInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $plan = ImprovementPlan::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $maintain1 = Maintenance::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $sug = AdditinalSuggestion::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $photo = Photo::select('*')->where('weir_id',$weir[0]->weir_id)->get();     
            $model=json_decode($weir[0]->weir_model);
            $locationUTM=json_decode($location[0]->utm);
            $locationLat=json_decode($location[0]->latlong);
            $space[0]->ridge_type=json_decode($space[0]->ridge_type);
            $space[0]->gate_dimension=json_decode($space[0]->gate_dimension);
            $space[0]->control_building_type=json_decode($space[0]->control_building_type);
            $space[0]->control_building_gate_dimension=json_decode($space[0]->control_building_gate_dimension);
            $space[0]->conttrol_building_loc=json_decode($space[0]->conttrol_building_loc);
            $space[0]->canel_dimension=json_decode($space[0]->canel_dimension);
            $upprotection[0]->floor_remake=json_decode($upprotection[0]->floor_remake);
            $upprotection[0]->side_remake=json_decode($upprotection[0]->side_remake);
            $upconcrete[0]->floor_remake=json_decode($upconcrete[0]->floor_remake);
            $upconcrete[0]->side_remake=json_decode($upconcrete[0]->side_remake);
            $control[0]->waterctrl_remake=json_decode($control[0]->waterctrl_remake);
            $control[0]->sidewall_remake=json_decode($control[0]->sidewall_remake);
            $control[0]->dgfloor_remake=json_decode($control[0]->dgfloor_remake);
            $control[0]->dgwall_remake=json_decode($control[0]->dgwall_remake);
            $control[0]->dggate_remake=json_decode($control[0]->dggate_remake);
            $control[0]->dgmachanic_remake=json_decode($control[0]->dgmachanic_remake);
            $control[0]->dgblock_remake=json_decode($control[0]->dgblock_remake);
            $control[0]->waterbreak_remake=json_decode($control[0]->waterbreak_remake);
            $control[0]->bridge_remake=json_decode($control[0]->bridge_remake);

            $downconcrete[0]->floor_remake=json_decode($downconcrete[0]->floor_remake);
            $downconcrete[0]->side_remake=json_decode($downconcrete[0]->side_remake);
            $downconcrete[0]->flrblock_remake=json_decode($downconcrete[0]->flrblock_remake);
            $downconcrete[0]->endsill_remake=json_decode($downconcrete[0]->endsill_remake);

            $downprotection[0]->floor_remake=json_decode($downprotection[0]->floor_remake);
            $downprotection[0]->side_remake=json_decode($downprotection[0]->side_remake);

            $waterdelivery[0]->floor_remake=json_decode($waterdelivery[0]->floor_remake);
            $waterdelivery[0]->side_remake=json_decode($waterdelivery[0]->side_remake);
            $waterdelivery[0]->gate_remake=json_decode($waterdelivery[0]->gate_remake);
            // dd($sug[0]->suggestion);
            $photo1[]=["name"=>NULL,"file"=>NULL];
            $photo2[]=["name"=>NULL,"file"=>NULL];
            $photo3[]=["name"=>NULL,"file"=>NULL];
            $photo4[]=["name"=>NULL,"file"=>NULL];
            $photo5[]=["name"=>NULL,"file"=>NULL];
            $photo6[]=["name"=>NULL,"file"=>NULL];
            $a=0;$b=0;$c=0;$d=0;$e=0;$f=0;
            for($i=0;$i<count($photo);$i++){
                if($photo[$i]->photo_type=="ส่วน Protection เหนือน้ำ"){
                    $photo1[$a]=[
                        "name"=>$photo[$i]->photo_id,
                        "file"=>$photo[$i]->thumbnall_filename,
                    ];
                    $a=$a+1;
                }else if($photo[$i]->photo_type=="ส่วนเหนือน้ำ"){
                    
                    $photo2[$b]=[
                        "name"=>$photo[$i]->photo_id,
                        "file"=>$photo[$i]->thumbnall_filename,
                    ];
                    $b=$b+1;
                }else if($photo[$i]->photo_type=="ส่วนควบคุม"){
                    $photo3[$c]=[
                        "name"=>$photo[$i]->photo_id,
                        "file"=>$photo[$i]->thumbnall_filename,
                    ];
                    $c=$c+1;
                }else if($photo[$i]->photo_type=="ส่วนท้ายน้ำ"){
                    $photo4[$d]=[
                        "name"=>$photo[$i]->photo_id,
                        "file"=>$photo[$i]->thumbnall_filename,
                    ];
                    $d=$d+1;
                }else if($photo[$i]->photo_type=="ส่วน Protection ท้ายน้ำ "){
                    $photo5[$e]=[
                        "name"=>$photo[$i]->photo_id,
                        "file"=>$photo[$i]->thumbnall_filename,
                    ];
                    $e=$e+1;
                }else if($photo[$i]->photo_type=="ระบบส่งน้ำ"){
                    $photo6[$f]=[
                        "name"=>$photo[$i]->photo_id,
                        "file"=>$photo[$i]->thumbnall_filename,
                    ];
                    $f=$f+1;
                }
            }
            $mt=1;
            for($i=0;$i<5;$i++){
                if(!empty($maintain1[$i]->maintain_date)){
                        $maintain[$i]=[
                            'maintain_id'=>$maintain1[$i]->maintain_id,
                            'maintain_date'=>$maintain1[$i]->maintain_date,
                            'maintain_detail'=>$maintain1[$i]->maintain_detail,
                            'maintain_resp'=>$maintain1[$i]->maintain_resp,
                            'maintain_remark'=>$maintain1[$i]->maintain_remark
                        ];
                        $mt=$mt+1;
                }else{
                        $maintain[$i]=[
                            'maintain_id'=>NULL,
                            'maintain_date'=>NULL,
                            'maintain_detail'=>NULL,
                            'maintain_resp'=>NULL,
                            'maintain_remark'=>NULL
                        ];
                }
            }
            $pdf = PDF::loadView('form.report_form',compact('mt','weir','location','districtData','river','model','locationUTM','locationLat','space','upprotection','upconcrete','control','downconcrete','downprotection','waterdelivery','plan','maintain','sug','photo1','photo2','photo3','photo4','photo5','photo6'));
            return $pdf->stream('survey.pdf');

        }else{
            $apiUrl = 'https://watercenter.scmc.cmu.ac.th/weir/jang_basin/api/pdf/'.$weir_id;
            $response = Http::get($apiUrl);
            $data = $response->json();
            $mt = $data[0]['mt'];
            $weir=  $data[0]['weir'];
            $location=  $data[0]['location'];
            $districtData=  $data[0]['districtData'];
            $river=  $data[0]['river'];
            $model=  $data[0]['model'];
            $locationUTM=  $data[0]['locationUTM'];
            $locationLat=  $data[0]['locationLat'];
            $space=  $data[0]['space'];
            $upprotection=  $data[0]['upprotection'];
            $upconcrete=  $data[0]['upconcrete'];
            $control=  $data[0]['control'];
            $downconcrete=  $data[0]['downconcrete'];
            $downprotection=  $data[0]['downprotection'];
            $waterdelivery=  $data[0]['waterdelivery'];
            $plan=  $data[0]['plan'];
            $maintain=  $data[0]['maintain'];
            $sug=  $data[0]['sug'];
            $photo1=  $data[0]['photo1'];
            $photo2=  $data[0]['photo2'];
            $photo3=  $data[0]['photo3'];
            $photo4=  $data[0]['photo4'];
            $photo5=  $data[0]['photo5'];
            $photo6=  $data[0]['photo6'];

            // dd($waterdelivery);
            $pdf = PDF::loadView('test_pdf03',compact('mt','weir','location','districtData','river','model','locationUTM','locationLat','space','upprotection','upconcrete','control','downconcrete','downprotection','waterdelivery','plan','maintain','sug','photo1','photo2','photo3','photo4','photo5','photo6'));
            return $pdf->stream('survey.pdf');


        }
    }

    public function reportpdf_index($weir_id=0) {
        function checkCuase($text) {
            if($text!=NULL){return $text;	}else{return "-";	}
        }
        function checksediment($text) {
            if($text=="1"){
                $check1="ไม่มีตะกอน ";
            }else if($text=="2"){
                $check1="ตะกอนมีน้อย";
            }else if($text=="3"){
                $check1="ตะกอนมีปานกลาง";
            }else if($text=="4"){
                $check1="ตะกอนมีมาก";
            }else{
                $check1="";
            }
            return $check1;
        }
        function DateTimeThai($strDate)
        {
            $strYear = (date("Y",strtotime($strDate))+543)-2500;
            $strMonth= date("n",strtotime($strDate));
            $strDay= date("j",strtotime($strDate));
            $strMonthCut =  Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
            $strMonthThai=$strMonthCut[$strMonth];
            return "$strDay $strMonthThai $strYear ";
        }
        
        $weir = WeirSurvey::select('*')->where('weir_code',$weir_id)->get();
        
            $location = WeirLocation::select('*')->where('weir_location_id',$weir[0]->weir_location_id)->get();
            $river = River::select('*')->where('river_id',$weir[0]->river_id)->get();
            $districtData['data'] = Location::getDistrictCR();
            $space = WeirSpaceification::select('*')->where('weir_spec_id',$weir[0]->weir_spec_id)->get();
            $upprotection = UpprotectionInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $upconcrete = UpconcreteInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $control = ControlInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $downconcrete = DownconcreteInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $downprotection = DownprotectionInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $waterdelivery = WaterdeliveryInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $plan = ImprovementPlan::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $maintain1 = Maintenance::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $sug = AdditinalSuggestion::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $photo = Photo::select('*')->where('weir_id',$weir[0]->weir_id)->get();
            $expert = WeirExpert::select('*')->where('weir_id',$weir[0]->weir_id)->get()->last();
            $area = WeirCatchment::select('*')->where('weir_id', $weir[0]->weir_id)->get()->last();

            // dd($expert);
            // crete json_decode
                $model=json_decode($weir[0]->weir_model);
                $locationUTM=json_decode($location[0]->utm);
                $locationLat=json_decode($location[0]->latlong);
                $space[0]->ridge_type=json_decode($space[0]->ridge_type);
                $space[0]->gate_dimension=json_decode($space[0]->gate_dimension);
                $space[0]->control_building_type=json_decode($space[0]->control_building_type);
                $space[0]->control_building_gate_dimension=json_decode($space[0]->control_building_gate_dimension);
                $space[0]->conttrol_building_loc=json_decode($space[0]->conttrol_building_loc);
                $space[0]->canel_dimension=json_decode($space[0]->canel_dimension);
                $upprotection[0]->floor_remake=json_decode($upprotection[0]->floor_remake);
                $upprotection[0]->side_remake=json_decode($upprotection[0]->side_remake);
                $upconcrete[0]->floor_remake=json_decode($upconcrete[0]->floor_remake);
                $upconcrete[0]->side_remake=json_decode($upconcrete[0]->side_remake);
                $control[0]->waterctrl_remake=json_decode($control[0]->waterctrl_remake);
                $control[0]->sidewall_remake=json_decode($control[0]->sidewall_remake);
                $control[0]->dgfloor_remake=json_decode($control[0]->dgfloor_remake);
                $control[0]->dgwall_remake=json_decode($control[0]->dgwall_remake);
                $control[0]->dggate_remake=json_decode($control[0]->dggate_remake);
                $control[0]->dgmachanic_remake=json_decode($control[0]->dgmachanic_remake);
                $control[0]->dgblock_remake=json_decode($control[0]->dgblock_remake);
                $control[0]->waterbreak_remake=json_decode($control[0]->waterbreak_remake);
                $control[0]->bridge_remake=json_decode($control[0]->bridge_remake);

                $downconcrete[0]->floor_remake=json_decode($downconcrete[0]->floor_remake);
                $downconcrete[0]->side_remake=json_decode($downconcrete[0]->side_remake);
                $downconcrete[0]->flrblock_remake=json_decode($downconcrete[0]->flrblock_remake);
                $downconcrete[0]->endsill_remake=json_decode($downconcrete[0]->endsill_remake);

                $downprotection[0]->floor_remake=json_decode($downprotection[0]->floor_remake);
                $downprotection[0]->side_remake=json_decode($downprotection[0]->side_remake);

                $waterdelivery[0]->floor_remake=json_decode($waterdelivery[0]->floor_remake);
                $waterdelivery[0]->side_remake=json_decode($waterdelivery[0]->side_remake);
                $waterdelivery[0]->gate_remake=json_decode($waterdelivery[0]->gate_remake);
                // dd($sug[0]->suggestion);
                $photo1[]=["name"=>NULL,"file"=>NULL];
                $photo2[]=["name"=>NULL,"file"=>NULL];
                $photo3[]=["name"=>NULL,"file"=>NULL];
                $photo4[]=["name"=>NULL,"file"=>NULL];
                $photo5[]=["name"=>NULL,"file"=>NULL];
                $photo6[]=["name"=>NULL,"file"=>NULL];
            // photo 
                $a=0;$b=0;$c=0;$d=0;$e=0;$f=0;
                for($i=0;$i<count($photo);$i++){
                    if($photo[$i]->photo_type=="ส่วน Protection เหนือน้ำ"){
                        $photo1[$a]=[
                            "name"=>$photo[$i]->photo_id,
                            "file"=>$photo[$i]->thumbnall_filename,
                        ];
                        $a=$a+1;
                    }else if($photo[$i]->photo_type=="ส่วนเหนือน้ำ"){
                        
                        $photo2[$b]=[
                            "name"=>$photo[$i]->photo_id,
                            "file"=>$photo[$i]->thumbnall_filename,
                        ];
                        $b=$b+1;
                    }else if($photo[$i]->photo_type=="ส่วนควบคุม"){
                        $photo3[$c]=[
                            "name"=>$photo[$i]->photo_id,
                            "file"=>$photo[$i]->thumbnall_filename,
                        ];
                        $c=$c+1;
                    }else if($photo[$i]->photo_type=="ส่วนท้ายน้ำ"){
                        $photo4[$d]=[
                            "name"=>$photo[$i]->photo_id,
                            "file"=>$photo[$i]->thumbnall_filename,
                        ];
                        $d=$d+1;
                    }else if($photo[$i]->photo_type=="ส่วน Protection ท้ายน้ำ "){
                        $photo5[$e]=[
                            "name"=>$photo[$i]->photo_id,
                            "file"=>$photo[$i]->thumbnall_filename,
                        ];
                        $e=$e+1;
                    }else if($photo[$i]->photo_type=="ระบบส่งน้ำ"){
                        $photo6[$f]=[
                            "name"=>$photo[$i]->photo_id,
                            "file"=>$photo[$i]->thumbnall_filename,
                        ];
                        $f=$f+1;
                    }
                }
            // maintain
                $mt=1;
                for($i=0;$i<5;$i++){
                if(!empty($maintain1[$i]->maintain_date)){
                    $maintain[$i]=[
                            'maintain_id'=>$maintain1[$i]->maintain_id,
                            'maintain_date'=>$maintain1[$i]->maintain_date,
                            'maintain_detail'=>$maintain1[$i]->maintain_detail,
                            'maintain_resp'=>$maintain1[$i]->maintain_resp,
                            'maintain_remark'=>$maintain1[$i]->maintain_remark
                    ];
                    $mt=$mt+1;
                }else{
                        $maintain[$i]=[
                            'maintain_id'=>NULL,
                            'maintain_date'=>NULL,
                            'maintain_detail'=>NULL,
                            'maintain_resp'=>NULL,
                            'maintain_remark'=>NULL
                        ];
                }
            }
            // weir build  form  
                if($model->self->villager==1){
                    $model_text1="ก่อสร้างเองโดยใช้แรงงานชาวบ้าน ใช้งบของ : ".$model->self->villager_detial ;
                }else{$model_text1=NULL;}
                if($model->self->weir_std==1){ 
                    $model_text2="ใช้แบบมาตราฐาน : ".$model->self->std_detial;
                }else{$model_text2=NULL;}
                if($model->self->weir_self){
                    $model_text3="ออกแบบเอง";
                }else{$model_text3=NULL;}
                $model_text=[
                    'text1'=>$model_text1,
                    'text2'=>$model_text2,
                    'text3'=>$model_text3
                ];

            // อาคารบังคับน้ำ สลับปิดและเปิด
                if($space[0]->control_building_type->open->type!=NULL){
                    if($space[0]->control_building_type->open->left==1){
                        $building_text="แบบปิด : ฝั่งซ้าย ";
                    }else if($space[0]->control_building_type->open->right==1){
                        $building_text="แบบปิด : ฝั่งขวา ";
                    }else{
                        $building_text="แบบปิด : -  ";
                    }
                    $building=[
                        'key'=>"c",
                        'side'=>$building_text,
                        'text1'=>"ขนาดฝาท่อปิด : ".checkCuase($space[0]->conttrol_building_loc->size)." เมตร ",
                        'text2'=>"ความยาวท่อ :".checkCuase($space[0]->conttrol_building_loc->long)." เมตร ",
                        'text3'=>"ระดับธรณีประตู : ".checkCuase($space[0]->conttrol_building_loc->base)
                    ];

                }else if ($space[0]->control_building_type->close->type!=NULL){
                    if($space[0]->control_building_type->close->left==1){
                        $building_text="แบบเปิด : ฝั่งซ้าย ";
                    }else if($space[0]->control_building_type->close->left==1){
                        $building_text="แบบเปิด : ฝั่งขวา ";
                    }else{
                        $building_text="แบบเปิด : -  ";
                    }
                    $building=[
                        'key'=>"o",
                        'side'=>$building_text,
                        'text1'=>"ชนิดบานประตู : ".checkCuase($space[0]->control_building_gate_type),
                        'text2'=>"ชนิดเครื่องยกบาน :".checkCuase($space[0]->control_building_machanic_type),
                        'text3'=>""
                    ];

                }else {
                    $building=[
                        'key'=>"x",
                        'side'=>" ",
                        'text1'=>" ",
                        'text2'=>" ",
                        'text3'=>""
                    ];
                }

            

            $d=explode(" ",$weir[0]->survey_date);
            $date=DateTimeThai($d[0]);
        
            $sediment=[
                'check1'=>checksediment($upprotection[0]->check_floor),
                'check2'=>checksediment($upconcrete[0]->check_floor),
                'check4'=>checksediment($downconcrete[0]->check_floor),
                'check5'=>checksediment($downprotection[0]->check_floor),
                'check6'=>checksediment($waterdelivery[0]->check_floor),
            ];

            $damage =[
                $upprotection[0]->section_status,
                $upconcrete[0]->section_status,
                $control[0]->section_status,
                $downconcrete[0]->section_status,
                $downprotection[0]->section_status,
                $waterdelivery[0]->section_status,
            ];
            
            $name="weir_".$weir[0]->weir_code.".pdf";
            $pdf = PDF::loadView('reportPDF.report_id',compact('mt','area','expert','sediment','date','building','model_text','weir','location','districtData','river','model','locationUTM','locationLat','space','upprotection','upconcrete','control','downconcrete','downprotection','waterdelivery','plan','maintain','sug','photo1','photo2','photo3','photo4','photo5','photo6','damage'));
            return $pdf->stream($name);

        
    }

    public function compositionWeir(Request $request) {
        // dd($request);
        $N=0;
        $O=0;
        $D=0;

        $amp=$request->amp;
        $tumbol="sum";
        if(!empty($request->tumbol)){$tumbol=$request->tumbol;}
        if(!empty($request->weir_N)){$N=$request->weir_N;}
        if(!empty($request->weir_O)){$O=$request->weir_O;}
        if(!empty($request->weir_D)){$D=$request->weir_D;}
        $date=[];
        // dd($amp);
        
            if($tumbol=="sum"){$tumbol=NULL;}
            // chose Location amp & tambol
            if($amp=="sum"){$location = WeirLocation::select('*')->get();} 
            else if ($tumbol!=NULL){ $location = WeirLocation::select('*')->where('weir_district',$amp)->where('weir_tumbol',$tumbol)->get();}
            else {$location = WeirLocation::select('*')->where('weir_district',$amp)->get();}
            $warning=0;
            function DateTimeThai($strDate)
            {
                    $strYear = (date("Y",strtotime($strDate))+543)-2500;
                    $strMonth= date("n",strtotime($strDate));
                    $strDay= date("j",strtotime($strDate));
                    $strMonthCut =  Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
                    $strMonthThai=$strMonthCut[$strMonth];
                    return "$strDay $strMonthThai $strYear ";
            }
            // dd(count($location));
            for ($i=0;$i<count($location);$i++){ 
                $weir = WeirSurvey::select('*')->where('weir_location_id',$location[$i]->weir_location_id)->get();
                $score =Impovement::select('*')->where('weir_id', $weir[0]->weir_id)->get();
                // 
                // dd($weir[0]->survey_date);
                
                if($weir[0]->survey_date!=null){
                    $date[$i]=DateTimeThai($weir[0]->survey_date);
                    // dd($date);
                }else{
                    $date[$i]="-";
                }
                
                // dd($score);
                if(!empty($score[0]->improve_type)){
                    $warning=1;
                    if ($score[0]->improve_type==$N  || $score[0]->improve_type==$O || $score[0]->improve_type==$D ){
                        $river = River::select('river_name')->where('river_id',$weir[0]->river_id)->get();
                        $latlong=json_decode($location[$i]->latlong);
                        $vill=explode(" ",$location[$i]['weir_village']);
                        $upprotection = UpprotectionInv::select('section_status')->where('weir_id', $weir[0]->weir_id)->get();
                        $upconcrete = UpconcreteInv::select('section_status')->where('weir_id', $weir[0]->weir_id)->get();
                        $control = ControlInv::select('section_status')->where('weir_id', $weir[0]->weir_id)->get();
                        $downconcrete = DownconcreteInv::select('section_status')->where('weir_id', $weir[0]->weir_id)->get();
                        $downprotection = DownprotectionInv::select('section_status')->where('weir_id', $weir[0]->weir_id)->get();
                        $waterdelivery = WaterdeliveryInv::select('section_status')->where('weir_id', $weir[0]->weir_id)->get();
                        
                        // เปลี่ยนคำ
                            if(strpos($weir[0]->resp_name, "เทศบาลตำบล")== 0){$weir[0]->resp_name = str_replace("เทศบาลตำบล","ทต.",$weir[0]->resp_name);}
                            // if(strpos($weir[0]->resp_name, "ที่ว่าการอำเภอ")== 0){ $weir[0]->resp_name = str_replace("ที่ว่าการอำเภอ","อ.",$weir[0]->resp_name);}
                            if(strpos($weir[0]->resp_name, "ที่ว่าการอำเภอ")== 0){ 
                                $weir[0]->resp_name = str_replace("ที่ว่าการอำเภอ","อ.",$weir[0]->resp_name); 
                                    if($weir[0]->resp_name =="อ."){
                                        $weir[0]->resp_name=="อ.".$amp;
                                    }
                            }
                            if(strpos($weir[0]->resp_name, "กรมชลประทาน")== 0){ $weir[0]->resp_name = str_replace("กรมชลประทาน","ชป.",$weir[0]->resp_name);}
                            if(strpos($weir[0]->resp_name, "ไม่ทราบ")== 0){$weir[0]->resp_name = str_replace("ไม่ทราบ","-",$weir[0]->resp_name);}
                            if(strpos($weir[0]->resp_name, "กรมทรัพยากรน้ำ")== 0){ $weir[0]->resp_name = str_replace("กรมทรัพยากรน้ำ","ทน.",$weir[0]->resp_name); }
                            if(strpos($weir[0]->resp_name, "กรมพัฒนาพลังงานทดแทนและอนุรักษ์พลังงาน")== 0){ $weir[0]->resp_name = str_replace("กรมพัฒนาพลังงานทดแทนและอนุรักษ์พลังงาน","พพ.",$weir[0]->resp_name); } 
                            if(strpos($weir[0]->resp_name, "สำนักงานเร่งรัดพัฒนาชนบท")== 0){ $weir[0]->resp_name = str_replace("สำนักงานเร่งรัดพัฒนาชนบท","รพช.",$weir[0]->resp_name); }
                            if(strpos($weir[0]->resp_name, "กรมพัฒนาที่ดิน")== 0){ $weir[0]->resp_name = str_replace("กรมพัฒนาที่ดิน","พด.",$weir[0]->resp_name); }
                            if(strpos($weir[0]->resp_name, "สำนักงานการปฏิรูปที่ดินเพื่อเกษตรกรรม")== 0){ $weir[0]->resp_name = str_replace("สำนักงานการปฏิรูปที่ดินเพื่อเกษตรกรรม","ส.ป.ก.",$weir[0]->resp_name); }
                            if(strpos($weir[0]->resp_name, "เทศบาลนครเชียงราย")== 0){ $weir[0]->resp_name = str_replace("เทศบาลนครเชียงราย","ทน.เชียงราย",$weir[0]->resp_name); }
                            if(strpos($weir[0]->resp_name, "กรมโยธาธิการและผังเมือง")== 0){ $weir[0]->resp_name = str_replace("กรมโยธาธิการและผังเมือง","ยผ.",$weir[0]->resp_name); }
                            if(strpos($weir[0]->resp_name, "องค์การบริหารส่วนจังหวัดเชียงราย")== 0){ $weir[0]->resp_name = str_replace("องค์การบริหารส่วนจังหวัดเชียงราย","อบจ.เชียงราย",$weir[0]->resp_name); }
                            if(strpos($weir[0]->resp_name, "การไฟฟ้าฝ่ายผลิตแห่งประเทศไทย")== 0){ $weir[0]->resp_name = str_replace("การไฟฟ้าฝ่ายผลิตแห่งประเทศไทย","กฟผ.",$weir[0]->resp_name); }
                        // ---------------
                            
                
                            $result[] = [
                                    'weir_id'=> $weir[0]->weir_id,
                                    'weir_code'=> $weir[0]->weir_code,
                                    'weir_name'=> $weir[0]->weir_name,
                                    'lat'=>number_format($latlong->x, 3, '.', ''), 
                                    'long'=>number_format($latlong->y, 3, '.', ''), 
                                    'weir_village'=> $vill[2],
                                    'weir_tumbol'=> $location[$i]->weir_tumbol,
                                    'weir_district'=> $location[$i]->weir_district,
                                    'river' => $river[0]->river_name,
                                    'resp_name'=> $weir[0]->resp_name,
                                    'transfer'=>$weir[0]->transfer,
                                    'damage_1'=> $upprotection[0]->section_status,
                                    'damage_2'=> $upconcrete[0]->section_status,
                                    'damage_3'=> $control[0]->section_status,
                                    'damage_4'=> $downconcrete[0]->section_status,
                                    'damage_5'=> $downprotection[0]->section_status,
                                    'damage_6'=> $waterdelivery[0]->section_status,
                                    'classSum'=>$score[0]->improve_type
                            ];
            
                    }
                }
            
            }            
            // dd($result);
            if(isset($result)==NULL){$dataNo=1;}
            else{$dataNo=0;}
            $amp=$amp;
            if($tumbol!=NULL){ $text_amp="ตำบล".$tumbol."  อำเภอ".$amp; }
            else if($amp=="sum"){$text_amp="";}
            else{ $text_amp="อำเภอ".$amp; }
        
            if($warning==1){
                // dd($date);
                $name="weir_report.pdf";
                $pdf = PDF::loadView('reportPDF.weir_scoreComposition',compact('date','result','amp','dataNo','tumbol','text_amp'))->setPaper('Letter', 'landscape');;
                return $pdf->stream($name);
            }else{
                return view('guest.warning'); 
            }
        

    }

    public function problemWeir($amp=0)
    {
        $location = WeirLocation::select('*')->where('weir_district',$amp)->get();
        for ($i=0;$i<count($location);$i++){ 
            $weir = WeirSurvey::select('*')->where('weir_location_id',$location[$i]->weir_location_id)->get();
            $river = River::select('river_name')->where('river_id',$weir[0]->river_id)->get();
            $latlong=json_decode($location[$i]->latlong);
            $vill=explode(" ",$location[$i]['weir_village']);
            $expert = WeirExpert::select('*')->where('weir_id',$weir[0]->weir_id)->get();

            $result[] = [
                'weir_id'=> $weir[0]->weir_id,
                'weir_code'=> $weir[0]->weir_code,
                'weir_name'=> $weir[0]->weir_name,
                'lat'=>number_format($latlong->x, 3, '.', ''), 
                'long'=>number_format($latlong->y, 3, '.', ''), 
                'weir_village'=> $vill[2],
                'weir_tumbol'=> $location[$i]->weir_tumbol,
                'weir_district'=> $location[$i]->weir_district,
                'river' => $river[0]->river_name,
                'resp_name'=> $weir[0]->resp_name,
                'transfer'=>$weir[0]->transfer,
                'problem'=>$expert[0]->weir_problem,
                'solution'=>$expert[0]->weir_solution
                

            ];
            
        }

        // dd($result);
        $name=$amp.".pdf";
        $pdf = PDF::loadView('reportPDF.reportProblem',compact('result','amp'));
        return $pdf->stream($name); 
    }

    public function reportOne_amp(Request $request) {
        // dd($request);
        // function
            function DateTimeThai($strDate){
                $strYear = (date("Y",strtotime($strDate))+543)-2500;
                $strMonth= date("n",strtotime($strDate));
                $strDay= date("j",strtotime($strDate));
                $strMonthCut =  Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
                $strMonthThai=$strMonthCut[$strMonth];
                return "$strDay $strMonthThai $strYear ";
            }
            function checkCuase($text) {
                if($text!=NULL){return $text;	}else{return "-";	}
            }
            function checksediment($text) {
                if($text=="1"){
                    $check1="ไม่มีตะกอน ";
                }else if($text=="2"){
                    $check1="ตะกอนมีน้อย";
                }else if($text=="3"){
                    $check1="ตะกอนมีปานกลาง";
                }else if($text=="4"){
                    $check1="ตะกอนมีมาก";
                }else{
                    $check1="";
                }
                return $check1;
            }
        $N=0;
        $O=0;
        $D=0;

        $amp=$request->amp;
        $tumbol="sum";
        if(!empty($request->tumbol)){$tumbol=$request->tumbol;}
        if(!empty($request->weir_N)){$N=$request->weir_N;}
        if(!empty($request->weir_O)){$O=$request->weir_O;}
        if(!empty($request->weir_D)){$D=$request->weir_D;}

        
            if($tumbol=="sum"){$tumbol=NULL;}
            // dd($weir_N);
            if($amp=="sum"){$locations = WeirLocation::select('*')->get();} 
            else if ($tumbol!=NULL){ $locations = WeirLocation::select('*')->where('weir_district',$amp)->where('weir_tumbol',$tumbol)->get();}
            else {$locations = WeirLocation::select('*')->where('weir_district',$amp)->get();}
            
            $warning=0;
            $c_line=0;

            for ($z=0;$z<count($locations) ;$z++){ 
                    
                $weir = WeirSurvey::select('*')->where('weir_location_id',$locations[$z]->weir_location_id)->get();
                $location = WeirLocation::select('*')->where('weir_location_id',$weir[0]->weir_location_id)->get();
                $river = River::select('*')->where('river_id',$weir[0]->river_id)->get();
                $districtData['data'] = Location::getDistrictCR();
                $space = WeirSpaceification::select('*')->where('weir_spec_id',$weir[0]->weir_spec_id)->get();
                $upprotection = UpprotectionInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
                $upconcrete = UpconcreteInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
                $control = ControlInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
                $downconcrete = DownconcreteInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
                $downprotection = DownprotectionInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
                $waterdelivery = WaterdeliveryInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
                $plan = ImprovementPlan::select('*')->where('weir_id',$weir[0]->weir_id)->get();
                $maintain1 = Maintenance::select('*')->where('weir_id',$weir[0]->weir_id)->get();
                $sug = AdditinalSuggestion::select('*')->where('weir_id',$weir[0]->weir_id)->get();
                $photo = Photo::select('*')->where('weir_id',$weir[0]->weir_id)->get();
                $expert = WeirExpert::select('*')->where('weir_id',$weir[0]->weir_id)->get();
                $area = WeirCatchment::select('*')->where('weir_id', $weir[0]->weir_id)->get()->last();
                $score =Impovement::select('*')->where('weir_id', $weir[0]->weir_id)->get();
                    // dd($score);
                    
                    if(!empty($score[0]->improve_type)){
                        $warning=1;
                        if ($score[0]->improve_type==$N || $score[0]->improve_type==$O || $score[0]->improve_type==$D ){
                            // dd($expert);
                            // crete json_decode
                                $model=json_decode($weir[0]->weir_model);
                                $locationUTM=json_decode($location[0]->utm);
                                $locationLat=json_decode($location[0]->latlong);
                                $space[0]->ridge_type=json_decode($space[0]->ridge_type);
                                $space[0]->gate_dimension=json_decode($space[0]->gate_dimension);
                                $space[0]->control_building_type=json_decode($space[0]->control_building_type);
                                $space[0]->control_building_gate_dimension=json_decode($space[0]->control_building_gate_dimension);
                                $space[0]->conttrol_building_loc=json_decode($space[0]->conttrol_building_loc);
                                $space[0]->canel_dimension=json_decode($space[0]->canel_dimension);
                                $upprotection[0]->floor_remake=json_decode($upprotection[0]->floor_remake);
                                $upprotection[0]->side_remake=json_decode($upprotection[0]->side_remake);
                                $upconcrete[0]->floor_remake=json_decode($upconcrete[0]->floor_remake);
                                $upconcrete[0]->side_remake=json_decode($upconcrete[0]->side_remake);
                                $control[0]->waterctrl_remake=json_decode($control[0]->waterctrl_remake);
                                $control[0]->sidewall_remake=json_decode($control[0]->sidewall_remake);
                                $control[0]->dgfloor_remake=json_decode($control[0]->dgfloor_remake);
                                $control[0]->dgwall_remake=json_decode($control[0]->dgwall_remake);
                                $control[0]->dggate_remake=json_decode($control[0]->dggate_remake);
                                $control[0]->dgmachanic_remake=json_decode($control[0]->dgmachanic_remake);
                                $control[0]->dgblock_remake=json_decode($control[0]->dgblock_remake);
                                $control[0]->waterbreak_remake=json_decode($control[0]->waterbreak_remake);
                                $control[0]->bridge_remake=json_decode($control[0]->bridge_remake);
        
                                $downconcrete[0]->floor_remake=json_decode($downconcrete[0]->floor_remake);
                                $downconcrete[0]->side_remake=json_decode($downconcrete[0]->side_remake);
                                $downconcrete[0]->flrblock_remake=json_decode($downconcrete[0]->flrblock_remake);
                                $downconcrete[0]->endsill_remake=json_decode($downconcrete[0]->endsill_remake);
        
                                $downprotection[0]->floor_remake=json_decode($downprotection[0]->floor_remake);
                                $downprotection[0]->side_remake=json_decode($downprotection[0]->side_remake);
        
                                $waterdelivery[0]->floor_remake=json_decode($waterdelivery[0]->floor_remake);
                                $waterdelivery[0]->side_remake=json_decode($waterdelivery[0]->side_remake);
                                $waterdelivery[0]->gate_remake=json_decode($waterdelivery[0]->gate_remake);
                            // dd($sug[0]->suggestion);
                            
                            // photo 
                                $a=0;$b=0;$c=0;$d=0;$e=0;$f=0;
                                $photo1[0]=["name"=>NULL,"file"=>NULL];
                                $photo2[0]=["name"=>NULL,"file"=>NULL];
                                $photo3[0]=["name"=>NULL,"file"=>NULL];
                                $photo4[0]=["name"=>NULL,"file"=>NULL];
                                $photo5[0]=["name"=>NULL,"file"=>NULL];
                                $photo6[0]=["name"=>NULL,"file"=>NULL];
                                $photo1[1]=["name"=>NULL,"file"=>NULL];
                                $photo2[1]=["name"=>NULL,"file"=>NULL];
                                $photo3[1]=["name"=>NULL,"file"=>NULL];
                                $photo4[1]=["name"=>NULL,"file"=>NULL];
                                $photo5[1]=["name"=>NULL,"file"=>NULL];
                                $photo6[1]=["name"=>NULL,"file"=>NULL];
                                for($i=0;$i<count($photo);$i++){
                                    if($photo[$i]->photo_type=="ส่วน Protection เหนือน้ำ"){
                                        $photo1[$a]=[
                                            "name"=>$photo[$i]->photo_id,
                                            "file"=>$photo[$i]->thumbnall_filename,
                                        ];
                                        $a=$a+1;
                                    }else if($photo[$i]->photo_type=="ส่วนเหนือน้ำ"){
                                        
                                        $photo2[$b]=[
                                            "name"=>$photo[$i]->photo_id,
                                            "file"=>$photo[$i]->thumbnall_filename,
                                        ];
                                        $b=$b+1;
                                    }else if($photo[$i]->photo_type=="ส่วนควบคุม"){
                                        $photo3[$c]=[
                                            "name"=>$photo[$i]->photo_id,
                                            "file"=>$photo[$i]->thumbnall_filename,
                                        ];
                                        $c=$c+1;
                                    }else if($photo[$i]->photo_type=="ส่วนท้ายน้ำ"){
                                        $photo4[$d]=[
                                            "name"=>$photo[$i]->photo_id,
                                            "file"=>$photo[$i]->thumbnall_filename,
                                        ];
                                        $d=$d+1;
                                    }else if($photo[$i]->photo_type=="ส่วน Protection ท้ายน้ำ "){
                                        $photo5[$e]=[
                                            "name"=>$photo[$i]->photo_id,
                                            "file"=>$photo[$i]->thumbnall_filename,
                                        ];
                                        $e=$e+1;
                                    }else if($photo[$i]->photo_type=="ระบบส่งน้ำ"){
                                        $photo6[$f]=[
                                            "name"=>$photo[$i]->photo_id,
                                            "file"=>$photo[$i]->thumbnall_filename,
                                        ];
                                        $f=$f+1;
                                    }
                                }
                            // maintain
                                $mt=1;
                                for($j=0;$j<5;$j++){
                                    if(!empty($maintain1[$j]->maintain_date)){
                                        $maintain[$j]=[
                                                'maintain_id'=>$maintain1[$j]->maintain_id,
                                                'maintain_date'=>$maintain1[$j]->maintain_date,
                                                'maintain_detail'=>$maintain1[$j]->maintain_detail,
                                                'maintain_resp'=>$maintain1[$j]->maintain_resp,
                                                'maintain_remark'=>$maintain1[$j]->maintain_remark
                                        ];
                                        $mt=$mt+1;
                                    }else{
                                            $maintain[$j]=[
                                                'maintain_id'=>NULL,
                                                'maintain_date'=>NULL,
                                                'maintain_detail'=>NULL,
                                                'maintain_resp'=>NULL,
                                                'maintain_remark'=>NULL
                                            ];
                                    }
                                }
                            // weir build  form  
                                if($model->self->villager==1){
                                    $model_text1="ก่อสร้างเองโดยใช้แรงงานชาวบ้าน ใช้งบของ : ".$model->self->villager_detial ;
                                }else{$model_text1=NULL;}
                                if($model->self->weir_std==1){ 
                                    $model_text2="ใช้แบบมาตราฐาน : ".$model->self->std_detial;
                                }else{$model_text2=NULL;}
                                if($model->self->weir_self){
                                    $model_text3="ออกแบบเอง";
                                }else{$model_text3=NULL;}
                                $model_text=[
                                    'text1'=>$model_text1,
                                    'text2'=>$model_text2,
                                    'text3'=>$model_text3
                                ];
        
                            // อาคารบังคับน้ำ สลับปิดและเปิด
                                if($space[0]->control_building_type->open->type!=NULL){
                                    if($space[0]->control_building_type->open->left==1){
                                        $building_text="แบบปิด : ฝั่งซ้าย ";
                                    }else if($space[0]->control_building_type->open->right==1){
                                        $building_text="แบบปิด : ฝั่งขวา ";
                                    }else{
                                        $building_text="แบบปิด : -  ";
                                    }
                                    $building=[
                                        'key'=>"c",
                                        'side'=>$building_text,
                                        'text1'=>"ขนาดฝาท่อปิด : ".checkCuase($space[0]->conttrol_building_loc->size)." เมตร ",
                                        'text2'=>"ความยาวท่อ :".checkCuase($space[0]->conttrol_building_loc->long)." เมตร ",
                                        'text3'=>"ระดับธรณีประตู : ".checkCuase($space[0]->conttrol_building_loc->base)
                                    ];
        
                                }else if ($space[0]->control_building_type->close->type!=NULL){
                                    if($space[0]->control_building_type->close->left==1){
                                        $building_text="แบบเปิด : ฝั่งซ้าย ";
                                    }else if($space[0]->control_building_type->close->left==1){
                                        $building_text="แบบเปิด : ฝั่งขวา ";
                                    }else{
                                        $building_text="แบบเปิด : -  ";
                                    }
                                    $building=[
                                        'key'=>"o",
                                        'side'=>$building_text,
                                        'text1'=>"ชนิดบานประตู : ".checkCuase($space[0]->control_building_gate_type),
                                        'text2'=>"ชนิดเครื่องยกบาน :".checkCuase($space[0]->control_building_machanic_type),
                                        'text3'=>""
                                    ];
        
                                }else {
                                    $building=[
                                        'key'=>"x",
                                        'side'=>" ",
                                        'text1'=>" ",
                                        'text2'=>" ",
                                        'text3'=>""
                                    ];
                                }
        
        
                                $d=explode(" ",$weir[0]->created_at);
                                $date=DateTimeThai($d[0]);
                            
                                $sediment[]=[
                                    'check1'=>checksediment($upprotection[0]->check_floor),
                                    'check2'=>checksediment($upconcrete[0]->check_floor),
                                    'check4'=>checksediment($downconcrete[0]->check_floor),
                                    'check5'=>checksediment($downprotection[0]->check_floor),
                                    'check6'=>checksediment($waterdelivery[0]->check_floor),
                                ];
                                $damage[]=[$upprotection[0]->section_status,
                                        $upconcrete[0]->section_status,
                                        $control[0]->section_status,
                                        $downconcrete[0]->section_status,
                                        $downprotection[0]->section_status,
                                        $waterdelivery[0]->section_status
                                        ];
                                // dd($damage);
                            $result[] = [
                                'i'=>$z,
                                'area'=> $area,
                                'expert'=>$expert,
                                'sediment'=>$sediment,
                                'date'=>$date,
                                'building'=>$building,
                                'model_text'=>$model_text,
                                'weir'=>$weir,
                                'location'=>$location,
                                'districtData'=>$districtData,
                                'river'=>$river,
                                'model'=>$model,
                                'locationUTM'=>$locationUTM,
                                'locationLat'=>$locationLat,
                                'space'=>$space,
                                'upprotection'=>$upprotection,
                                'upconcrete'=>$upconcrete,
                                'control'=>$control,
                                'downconcrete'=>$downconcrete,
                                'downprotection'=>$downprotection,
                                'waterdelivery'=>$waterdelivery,
                                'plan'=>$plan,
                                'maintain'=>$maintain,
                                'sug'=>$sug,
                                'photo1'=>$photo1,
                                'photo2'=>$photo2,
                                'photo3'=>$photo3,
                                'photo4'=>$photo4,
                                'photo5'=>$photo5,
                                'photo6'=>$photo6,
                                'damage'=>$damage,
                                'mt'=>$mt                            
                            ];
                            $c_line=$c_line+1;                    
                        }
                    }else{break;}
                    
                }
            
                // dd($result[4]);
            
            if(isset($result)==NULL){$num = 0;}
            else{ $num = count($result); }

            if($tumbol!=NULL){$text_tm = "ตำบล".$tumbol; }
            else{$text_tm = "" ;}
        
            $text_amp = "อำเภอ".$amp;

            $name="อำเภอ".$amp.".pdf";
            
            if($warning==0){
                return view('guest.warning');  
            }else{
                // dd($result[0]['expert'][0]['map']);
                $pdf = PDF::loadView('reportPDF.reportProblem_amp',compact('result','num','text_tm','text_amp','damage','sediment'));
                return $pdf->stream($name); 
            }
        
        
    }

    public function testPDF($weir_id=0)
    {
        
        $weir = WeirSurvey::select('*')->where('weir_code',$weir_id)->get();
        // dd($amp);
        $name= "test.pdf";
        $pdf = PDF::loadView('reportPDF.test',compact("weir"));
        return $pdf->stream($name); 
    }

    public function reportpdf_warning($weir_id=0) {
        return view('guest.warning'); 
        
    }

    public function sedimentUpconcrete(Request $request) {
        // dd($request);
        function check_state($s,$t){
                if($s==1 && $t==1){return 1;}
                else if($s==1 && $t==2){return 2;}
                else if($s==1 && $t==3){return 3;}
                else if($s==1 && $t==4){return 4;}
                else{return 0;}
        }
        $N=0;
        $Y=0;
        $O=0;

        $amp=$request->amp;
        $tumbol="sum";
        if(!empty($request->tumbol)){$tumbol=$request->tumbol;}
        if(!empty($request->weir_N)){$N=check_state($request->weir_N,2);}
        if(!empty($request->weir_Y)){$Y=check_state($request->weir_Y,3);}
        if(!empty($request->weir_O)){$O=check_state($request->weir_O,4);}

       
            // dd($Y);
            if($tumbol=="sum"){$tumbol=NULL;}
            if($amp=="sum"){$location = WeirLocation::select('*')->get();} 
            else if ($tumbol!=NULL){ $location = WeirLocation::select('*')->where('weir_district',$amp)->where('weir_tumbol',$tumbol)->get();}
            else {$location = WeirLocation::select('*')->where('weir_district',$amp)->get();}
            
            $result=[];
            // dd($location);
            for ($i=0;$i<count($location);$i++){ 
                $weir = WeirSurvey::select('*')->where('weir_location_id',$location[$i]->weir_location_id)->get();
                $sediment_level= UpconcreteInv::select('check_floor')->where('weir_id', $weir[0]->weir_id)->get();
                // dd($sediment_level[0]->check_floor);
                if ($sediment_level[0]->check_floor==$N || $sediment_level[0]->check_floor==$Y || $sediment_level[0]->check_floor==$O ){
                    $river = River::select('river_name')->where('river_id',$weir[0]->river_id)->get();
                    $latlong=json_decode($location[$i]->latlong);
                    $vill=explode(" ",$location[$i]['weir_village']);                    
                    // เปลี่ยนคำ
                    if(strpos($weir[0]->resp_name, "เทศบาลตำบล")== 0){$weir[0]->resp_name = str_replace("เทศบาลตำบล","ทต.",$weir[0]->resp_name);}
                    // if(strpos($weir[0]->resp_name, "ที่ว่าการอำเภอ")== 0){ $weir[0]->resp_name = str_replace("ที่ว่าการอำเภอ","อ.",$weir[0]->resp_name);}
                    if(strpos($weir[0]->resp_name, "ที่ว่าการอำเภอ")== 0){ 
                        $weir[0]->resp_name = str_replace("ที่ว่าการอำเภอ","อ.",$weir[0]->resp_name); 
                            if($weir[0]->resp_name =="อ."){ $weir[0]->resp_name=="อ.".$amp; }
                            }
                    $result[] = [
                        'weir_id'=> $weir[0]->weir_id,
                        'weir_code'=> $weir[0]->weir_code,
                        'weir_name'=> $weir[0]->weir_name,
                        'lat'=>number_format($latlong->x, 3, '.', ''), 
                        'long'=>number_format($latlong->y, 3, '.', ''), 
                        'weir_village'=> $vill[2],
                        'weir_tumbol'=> $location[$i]->weir_tumbol,
                        'weir_district'=> $location[$i]->weir_district,
                        'river' => $river[0]->river_name,
                        'resp_name'=> $weir[0]->resp_name,
                        'transfer'=>$weir[0]->transfer,
                        'sediment_level'=>$sediment_level[0]->check_floor
                        ];

                }
                
            
            }
            if(count($result)==0){$dataNo=1;}
            else{$dataNo=0;}
            $amp=$amp;
            if($tumbol!=NULL){ $text_amp="ตำบล".$tumbol."  อำเภอ".$amp; }
            else{ $text_amp="อำเภอ".$amp; }
            // dd($dataNo);
            $name="weir_report.pdf";
            $pdf = PDF::loadView('reportPDF.reportSediment_amp',compact('result','amp','dataNo','tumbol','text_amp'))->setPaper('Letter', 'landscape');;
            return $pdf->stream($name);
        
    }
}