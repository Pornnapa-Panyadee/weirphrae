<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Import the Http facade
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

class DataSurveyController extends Controller
{
    public function getDataSurvey($amp=0) {
        header('Access-Control-Allow-Origin: *');
        $location = WeirLocation::select('*')->where('weir_district',$amp)->get();

        for ($i=0;$i<count($location);$i++){ 
            $weir = WeirSurvey::select('weir_id','weir_code','weir_name','river_id')->where('weir_location_id',$location[$i]->weir_location_id)->get();
            $river = River::select('river_name')->where('river_id',$weir[0]->river_id)->get();
            $latlong=json_decode($location[$i]->latlong);
            $result[] = [
                'weir_id'=> $weir[0]->weir_id,
                'weir_code'=> $weir[0]->weir_code,
                'weir_name'=> $weir[0]->weir_name,
                'lat'=>$latlong->x,
                'long'=>$latlong->y,
                'weir_village'=> $location[$i]->weir_village,
                'weir_tumbol'=> $location[$i]->weir_tumbol,
                'weir_district'=> $location[$i]->weir_district,
                'river' => $river[0]->river_name
            ];
        }
        $result = json_encode($result);

        echo $result;
    }

    public function getDatatoTable(User $user) {
        // dd(Auth::user());
        if(!empty(Auth::user())){
          $user=Auth::user()->name ;
          $status=Auth::user()->status ;
        //   dd($status);
          $data=[];
          $dataUser=[];
          $location = WeirLocation::select('*')->get();
          for ($i=0;$i<count($location);$i++){ 
            
                $weir = WeirSurvey::select('weir_id','weir_code','weir_name','river_id','user','created_at')->where('weir_location_id',$location[$i]->weir_location_id)->get();
                $river = River::select('river_name')->where('river_id',$weir[0]->river_id)->get();
                $latlong=json_decode($location[$i]->latlong);
                $data[] = [
                    'weir_id'=> $weir[0]->weir_id,
                    'weir_code'=> $weir[0]->weir_code,
                    'weir_name'=> $weir[0]->weir_name,
                    'lat'=>$latlong->x,
                    'long'=>$latlong->y,
                    'weir_village'=> $location[$i]->weir_village,
                    'weir_tumbol'=> $location[$i]->weir_tumbol,
                    'weir_district'=> $location[$i]->weir_district,
                    'river' => $river[0]->river_name,
                    'user' => $weir[0]->user,
                    'date'=>$weir[0]->created_at
                ];
            
            
            if($weir[0]->user==$user || $status=="admin" || $user=="Raveewach Jatiket"|| $user=="natthaphon nuttara" || $user=="admin"|| $user=="Admin"){
                $dataUser[] = [
                    'weir_id'=> $weir[0]->weir_id,
                    'weir_code'=> $weir[0]->weir_code,
                    'weir_name'=> $weir[0]->weir_name,
                    'lat'=>$latlong->x,
                    'long'=>$latlong->y,
                    'weir_village'=> $location[$i]->weir_village,
                    'weir_tumbol'=> $location[$i]->weir_tumbol,
                    'weir_district'=> $location[$i]->weir_district,
                    'river' => $river[0]->river_name,
                    'user' => $weir[0]->user,
                    'date'=>$weir[0]->created_at
                ];
            }
        
          }
            return view('form.list',compact('data','dataUser','user'));
        }else{
            return view('auth.login');
        }
        
        
    }

    public function formEdit(User $user, $weir_id=0) {
        // dd(Auth::user()->name);
        $user=Auth::user()->name ;
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

        for($i=0;$i<5;$i++){
            if(!empty($maintain1[$i]->maintain_date)){
                    $maintain[$i]=[
                        'maintain_id'=>$maintain1[$i]->maintain_id,
                        'maintain_date'=>$maintain1[$i]->maintain_date,
                        'maintain_detail'=>$maintain1[$i]->maintain_detail,
                        'maintain_resp'=>$maintain1[$i]->maintain_resp,
                        'maintain_remark'=>$maintain1[$i]->maintain_remark
            ];
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

        // dd($space[0]->comsumption);
        return view('form.editform',compact('weir','location','user','districtData','river','model','locationUTM','locationLat','space','upprotection','upconcrete','control','downconcrete','downprotection','waterdelivery','plan','maintain','sug','photo1','photo2','photo3','photo4','photo5','photo6'));

        
    }

    public function getDataHomeTable(Request $request) {
        $data=[];
        $dataUser=[];
        $screenWidth = $this->calculateScreenWidth();
        if($screenWidth<= 768){
            if($request->amp=="ห้างฉัตร" || empty($request->amp)){
                $request->amp="ห้างฉัตร";
            }elseif($request->amp=="sum"){
                $request->amp=empty($request->amp);
            }else{
                $request->amp=$request->amp;
            }
        }else{
            if($request->amp=="sum" || empty($request->amp)){
                $request->amp=NULL;
            }else{
                $request->amp=$request->amp;
            }
        }
        if(!empty($request->amp)){
            if(!empty($request->tumbol)){
                $location = WeirLocation::select('*')->where('weir_district',$request->amp)->where('weir_tumbol',$request->tumbol)->get();
            }else{
                $location = WeirLocation::select('*')->where('weir_district',$request->amp)->get();
            }
        }else{
                $location = WeirLocation::select('*')->get();
        }
        
        if(empty($request->amp)){
            for ($i=0;$i<count($location);$i++){ 
            
                $weir = WeirSurvey::select('weir_id','weir_code','weir_name','river_id','user','created_at')->where('weir_location_id',$location[$i]->weir_location_id)->get();
                $river = River::select('river_name')->where('river_id',$weir[0]->river_id)->get();
                $latlong=json_decode($location[$i]->latlong);
                $data[] = [
                    'weir_id'=> $weir[0]->weir_id,
                    'weir_code'=> $weir[0]->weir_code,
                    'weir_name'=> $weir[0]->weir_name,
                    'lat'=>$latlong->x,
                    'long'=>$latlong->y,
                    'weir_village'=> $location[$i]->weir_village,
                    'weir_tumbol'=> $location[$i]->weir_tumbol,
                    'weir_district'=> $location[$i]->weir_district,
                    'river' => $river[0]->river_name,
                    'date'=>$weir[0]->created_at
                ];     
            }
        }else{
            for ($i=0;$i<count($location);$i++){ 
            
                $weir = WeirSurvey::select('weir_id','weir_code','weir_name','river_id','user','created_at')->where('weir_location_id',$location[$i]->weir_location_id)->get();
                $river = River::select('river_name')->where('river_id',$weir[0]->river_id)->get();
                $latlong=json_decode($location[$i]->latlong);
                $data[] = [
                    'weir_id'=> $weir[0]->weir_id,
                    'weir_code'=> $weir[0]->weir_code,
                    'weir_name'=> $weir[0]->weir_name,
                    'lat'=>$latlong->x,
                    'long'=>$latlong->y,
                    'weir_village'=> $location[$i]->weir_village,
                    'weir_tumbol'=> $location[$i]->weir_tumbol,
                    'weir_district'=> $location[$i]->weir_district,
                    'river' => $river[0]->river_name,
                    'date'=>$weir[0]->created_at
                ];     
            }

        }
        
        // dd($data1[0]['data']);
        
        // dd($data);
        $district['name']=Location::getprovinceDistrict();
        // dd($district);
        return view('guest.index',compact('data','district'));      
        
        
    }

    public function getDataHomeTabletesth(Request $request) {
        $data=[];
        $dataUser=[];
        $screenWidth = $this->calculateScreenWidth();
        if($screenWidth<= 768){
            if($request->amp=="ห้างฉัตร" || empty($request->amp)){
                $request->amp="ห้างฉัตร";
            }elseif($request->amp=="sum"){
                $request->amp=empty($request->amp);
            }else{
                $request->amp=$request->amp;
            }
        }else{
            if($request->amp=="sum" || empty($request->amp)){
                $request->amp=NULL;
            }else{
                $request->amp=$request->amp;
            }
        }
        
        
        if(!empty($request->amp)){
            if(!empty($request->tumbol)){
                $location = WeirLocation::select('*')->where('weir_district',$request->amp)->where('weir_tumbol',$request->tumbol)->get();
            }else{
                $location = WeirLocation::select('*')->where('weir_district',$request->amp)->get();
            }
        }else{
                $location = WeirLocation::select('*')->get();
        }
        
        if(empty($request->amp)){
            for ($i=0;$i<count($location);$i++){ 
            
                $weir = WeirSurvey::select('weir_id','weir_code','weir_name','river_id','user','created_at')->where('weir_location_id',$location[$i]->weir_location_id)->get();
                $river = River::select('river_name')->where('river_id',$weir[0]->river_id)->get();
                $latlong=json_decode($location[$i]->latlong);
                $data[] = [
                    'weir_id'=> $weir[0]->weir_id,
                    'weir_code'=> $weir[0]->weir_code,
                    'weir_name'=> $weir[0]->weir_name,
                    'lat'=>$latlong->x,
                    'long'=>$latlong->y,
                    'weir_village'=> $location[$i]->weir_village,
                    'weir_tumbol'=> $location[$i]->weir_tumbol,
                    'weir_district'=> $location[$i]->weir_district,
                    'river' => $river[0]->river_name,
                    'date'=>$weir[0]->created_at
                ];     
            }
            $apiUrl = 'https://watercenter.scmc.cmu.ac.th/weir/jang_basin/api/getDataHomeTable';
            $response = Http::get($apiUrl);
            $data1 = $response->json();
            for ($i=0;$i<count($data1[0]['data']);$i++){ 
                $data[count($location)+$i] = $data1[0]['data'][$i];
            }

        }elseif($request->amp=="แม่เมาะ" || $request->amp=="แม่ทะ"){
            if(!empty($request->tumbol)){
                $apiUrl = 'https://watercenter.scmc.cmu.ac.th/weir/jang_basin/api/getDataHomeTable/'.$request->amp.'/'.$request->tumbol;
            }else{
                $apiUrl = 'https://watercenter.scmc.cmu.ac.th/weir/jang_basin/api/getDataHomeTable/'.$request->amp.'/0';
            }
            $response = Http::get($apiUrl);
            $data1 = $response->json();
            for ($i=0;$i<count($data1[0]['data']);$i++){ 
                $data[count($location)+$i] = $data1[0]['data'][$i];
            }
        }else{
            for ($i=0;$i<count($location);$i++){ 
            
                $weir = WeirSurvey::select('weir_id','weir_code','weir_name','river_id','user','created_at')->where('weir_location_id',$location[$i]->weir_location_id)->get();
                $river = River::select('river_name')->where('river_id',$weir[0]->river_id)->get();
                $latlong=json_decode($location[$i]->latlong);
                $data[] = [
                    'weir_id'=> $weir[0]->weir_id,
                    'weir_code'=> $weir[0]->weir_code,
                    'weir_name'=> $weir[0]->weir_name,
                    'lat'=>$latlong->x,
                    'long'=>$latlong->y,
                    'weir_village'=> $location[$i]->weir_village,
                    'weir_tumbol'=> $location[$i]->weir_tumbol,
                    'weir_district'=> $location[$i]->weir_district,
                    'river' => $river[0]->river_name,
                    'date'=>$weir[0]->created_at
                ];     
            }

        }
        
        // dd($data1[0]['data']);
        
        // dd($data);
        $district['name']=Location::getprovinceDistrict();
        // dd($district);
        if($request->amp=="sum"){
            $amp="ทั้งหมด";
        }else{$amp=$request->amp;}
        
        return view('guest.indexh',compact('data','district','amp'));      
        
        
    }

    public function getDatabyWeir($id=0) {
        header('Access-Control-Allow-Origin: *');
        $weir = WeirSurvey::select('weir_id','weir_code','weir_name','weir_location_id')->where('weir_code',$id)->get();
       
        $location = WeirLocation::select('*')->where('weir_location_id',$weir[0]->weir_location_id)->get();
        $latlong=json_decode($location[0]->latlong);
       
        // dd($weir);
        
        return view('guest.map',compact('weir','location','latlong')); 
    }

    public function getDatabyExpert($id=0) {
        // dd($id);
        header('Access-Control-Allow-Origin: *');
        $weir = WeirSurvey::select('*')->where('weir_code',$id)->get();
        $river = River::select('*')->where('river_id',$weir[0]->river_id)->get();
        $location = WeirLocation::select('*')->where('weir_location_id',$weir[0]->weir_location_id)->get();
        $expert = WeirExpert::select('*')->where('weir_id',$weir[0]->weir_id)->get()->last();
        $area = DB::table('weir_catchments')->select('*')->where('weir_id', $weir[0]->weir_id)->get()->last();
        // $improve=Impovement::select('*')->where('weir_code',$id)->get();
        if(Impovement::select('*')->where('weir_code',$id)->count() > 0){
            $improve=Impovement::select('*')->where('weir_code',$id)->get()->last();
            $improve_type=$improve->improve_type;
            // dd($improve);
        }else{
            $improve_type=0;
        }
        
        // $improve=Impovement::select('*')->where('weir_code',$id)->get();
        // dd($improve);
        // dd($area);
        return view('form.expert',compact('weir','river','location','expert','area','improve_type')); 
    }
    

    public function getDatatoTableExpert(User $user) {
        // dd(Auth::user());

        if(!empty(Auth::user())){
          $user=Auth::user()->name ;
          $status=Auth::user()->status ;
        //   dd($status);
          $data=[];
          $dataUser=[];
          $location = WeirLocation::select('*')->get();
          for ($i=0;$i<count($location);$i++){ 
            $weir = WeirSurvey::select('weir_id','weir_code','weir_name','river_id','user','created_at')->where('weir_location_id',$location[$i]->weir_location_id)->get();
            $river = River::select('river_name')->where('river_id',$weir[0]->river_id)->get();
            $latlong=json_decode($location[$i]->latlong);
            $data[] = [
                'weir_id'=> $weir[0]->weir_id,
                'weir_code'=> $weir[0]->weir_code,
                'weir_name'=> $weir[0]->weir_name,
                'lat'=>$latlong->x,
                'long'=>$latlong->y,
                'weir_village'=> $location[$i]->weir_village,
                'weir_tumbol'=> $location[$i]->weir_tumbol,
                'weir_district'=> $location[$i]->weir_district,
                'river' => $river[0]->river_name,
                'user' => $weir[0]->user,
                'date'=>$weir[0]->created_at
            ];
            // dd($weir[0]->user);

            if($weir[0]->user==$user || $status=="admin" || $status=="expert" || $weir[0]->user=="reveewach" ){
                $dataUser[] = [
                    'weir_id'=> $weir[0]->weir_id,
                    'weir_code'=> $weir[0]->weir_code,
                    'weir_name'=> $weir[0]->weir_name,
                    'lat'=>$latlong->x,
                    'long'=>$latlong->y,
                    'weir_village'=> $location[$i]->weir_village,
                    'weir_tumbol'=> $location[$i]->weir_tumbol,
                    'weir_district'=> $location[$i]->weir_district,
                    'river' => $river[0]->river_name,
                    'user' => $weir[0]->user,
                    'date'=>$weir[0]->created_at
                ];
            }
          }
            return view('form.expert_list',compact('data','dataUser','user'));
        }else{
            return view('auth.login');
        }
        
        
    }


    public function getDataHomeTabletest(Request $request) {
        // dd($request);
        $data=[];
        $dataUser=[];
        if(!empty($request->amp)){
            if(!empty($request->tumbol)){
                $location = WeirLocation::select('*')->where('weir_district',$request->amp)->where('weir_tumbol',$request->tumbol)->get();
            }else{
                $location = WeirLocation::select('*')->where('weir_district',$request->amp)->get();
            }
        }else{
                $location = WeirLocation::select('*')->get();
        }
        
        for ($i=0;$i<count($location);$i++){ 
            $weir = WeirSurvey::select('weir_id','weir_code','weir_name','river_id','user','created_at')->where('weir_location_id',$location[$i]->weir_location_id)->get();
            $river = River::select('river_name')->where('river_id',$weir[0]->river_id)->get();
            $latlong=json_decode($location[$i]->latlong);
            $data[] = [
                'weir_id'=> $weir[0]->weir_id,
                'weir_code'=> $weir[0]->weir_code,
                'weir_name'=> $weir[0]->weir_name,
                'lat'=>$latlong->x,
                'long'=>$latlong->y,
                'weir_village'=> $location[$i]->weir_village,
                'weir_tumbol'=> $location[$i]->weir_tumbol,
                'weir_district'=> $location[$i]->weir_district,
                'river' => $river[0]->river_name,
                'date'=>$weir[0]->created_at
            ];      
        }
        $district['name']=Location::getprovinceDistrict();
        // dd($district);
        return view('guest.test',compact('data','district'));      
        
        
    }

     public function getData(Request $request) {

        $location = WeirLocation::select('*')->get();
        // dd($location);
        for ($i=0;$i<count($location);$i++){ 
            $weir = WeirSurvey::select('weir_id','weir_code','weir_name','river_id','user','created_at')->where('weir_location_id',$location[$i]->weir_location_id)->get();
            $river = River::select('river_name')->where('river_id',$weir[0]->river_id)->get();
            $utm=json_decode($location[$i]->utm);
            $latlong=json_decode($location[$i]->latlong);
            $data[] = [
                'weir_id'=> $weir[0]->weir_id,
                'weir_code'=> $weir[0]->weir_code,
                'weir_name'=> $weir[0]->weir_name,
                'UTM_x'=>$utm->x,
                'UTM_y'=>$utm->y,
                'lat'=>$latlong->x,
                'long'=>$latlong->y,
                'weir_village'=> $location[$i]->weir_village,
                'weir_tumbol'=> $location[$i]->weir_tumbol,
                'weir_district'=> $location[$i]->weir_district,
                'river' => $river[0]->river_name,
                'date'=>$weir[0]->created_at
            ];      
        }

        // dd($data);
        return view('guest.data',compact('data'));



    }

    // ฟังก์ชันคำนวณ screenWidth
    private function calculateScreenWidth()
    {
        // ตรวจสอบว่าเป็นมือถือหรือไม่
        if ($this->isMobile()) {
            return 480; // กำหนดให้มือถือมี screenWidth = 480px
        } else {
            return 1024; // กำหนดให้โน้ตบุ๊คมี screenWidth = 1024px
        }
    }

    // ฟังก์ชันตรวจสอบว่าเป็นมือถือ
    private function isMobile()
    {
        // ตรวจสอบ User-Agent
        $userAgent = request()->header('User-Agent');

        // ตรวจสอบว่า User-Agent มีคำว่า 'Mobile' หรือไม่
        return preg_match('/Mobile|Android|iPhone|iPad/', $userAgent);
    }
}
