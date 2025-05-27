<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

use File;
use Image;
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
use App\Models\EditLog;
use App\Models\WeirCatchment;
use App\Models\WeirExpert;
use App\Models\Impovement;
use Grimzy\LaravelMysqlSpatial\Types\Point;

// use SpatialTrait;

// use File;
// use Image;


class FormsController extends Controller
{
    public function __construct()
    {
      
          $this->middleware('auth');
    }

    public function location(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');
        $districtData['data'] = Location::getDistrict();
        // dd($districtData);
        return view('form/form', compact('districtData'));
    }

    public function getDistrict($vill_provinceid=0){
        header('Access-Control-Allow-Origin: *');
        $userData['data'] = Location::getprovinceDistrict($vill_provinceid);   
        // dd($userData);     
        echo json_encode($userData);
        exit;
    }

    // Fetch tumbol
    public function getTumbol($vill_districtid=0){
      header('Access-Control-Allow-Origin: *');
      // Fetch Employees by Departmentid
      $userData['data'] = Location::getdistrictTumbol($vill_districtid);      
      // dd($userData);  
      echo json_encode($userData);
      exit;
    }

    public function getVillage($vill_districtid=0,$vill_tumbolid=0){
      header('Access-Control-Allow-Origin: *');
      // Fetch Employees by Departmentid
      $userVill['data'] = Location::gettumbolVillage($vill_districtid,$vill_tumbolid); 

      echo json_encode($userVill);
      exit;
    }


    public function formSubmit(Request $request, User $user){
        // dd($request->check_floor_4);
        // dd($request);
        $name=Auth::user()->name ;
        // Function model
          function addNULL($text) {
            if($text==true){
              return 1;
            }else{
              return NULL;
            }
          }
          function addNULL1($text,$t) {
            if($text==true){
              return $t;
            }else{
              return NULL;
            }
          }
          function addNULL2($t1,$t2) {
            if($t1==true||$t2==true){
              return 1;
            }else{
              return 0;
            }
          }
          // set Json form
            $model =[
              'self'=>[
                'weir_self'=>addNULL(!empty($request->weir_model['self']['weir_self'])),
                'weir_std'=>addNULL(!empty($request->weir_model['self']['weir_std'])),
                'std_detial'=>addNULL1(!empty($request->weir_model['self']['std_detial']),$request->weir_model['self']['std_detial']),
                'villager'=>addNULL(!empty($request->weir_model['self']['villager'])),
                'villager_detial'=>addNULL1(!empty($request->weir_model['self']['villager_detial']),$request->weir_model['self']['villager_detial'])
              ]
            ];
        
            $control_building_type=[
              'open'=>[
                'type'=>addNULL2(!empty($request->control_building_type['open']['left']),!empty($request->control_building_type['open']['left'])),
                'left'=>addNULL(!empty($request->control_building_type['open']['left'])),
                'right'=>addNULL(!empty($request->control_building_type['open']['right']))
              ],
              'close'=>[
                'type'=>addNULL(!empty($request->control_building_type['close']['left']),!empty($request->control_building_type['close']['right'])),
                'left'=>addNULL(!empty($request->control_building_type['close']['left'])),
                'right'=>addNULL(!empty($request->control_building_type['close']['right']))
              ]
            ];

            $building_loc=[
              'size'=>addNULL1(!empty($request->conttrol_building_loc['size']),$request->conttrol_building_loc['size']),
              'long'=>addNULL1(!empty($request->conttrol_building_loc['long']),$request->conttrol_building_loc['long']),
              'base'=>addNULL1(!empty($request->conttrol_building_loc['base']),$request->conttrol_building_loc['base']),
            ];
          
            $floor_1_remake=[
              'no'=>addNULL(!empty($request->floor_1_remake['no'])),
              'nosee'=>addNULL(!empty($request->floor_1_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->floor_1_remake['detail']),$request->floor_1_remake['detail']),
            ];
            $side_1_remake=[
              'no'=>addNULL(!empty($request->side_1_remake['no'])),
              'nosee'=>addNULL(!empty($request->side_1_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->side_1_remake['detail']),$request->side_1_remake['detail']),
            ];
            $floor_2_remake=[
              'no'=>addNULL(!empty($request->floor_2_remake['no'])),
              'nosee'=>addNULL(!empty($request->floor_2_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->floor_2_remake['detail']),$request->floor_2_remake['detail']),
            ];
            // dd(!empty($request->$side_2_remake['no']));
            $side_2_remake=[
              'no'=>addNULL(!empty($request->side_2_remake['no'])),
              'nosee'=>addNULL(!empty($request->side_2_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->side_2_remake['detail']),$request->side_2_remake['detail']),
            ];
            
            $waterctrl_3_remake=[
              'no'=>addNULL(!empty($request->waterctrl_3_remake['no'])),
              'nosee'=>addNULL(!empty($request->waterctrl_3_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->waterctrl_3_remake['detail']),$request->waterctrl_3_remake['detail']),
            ];

            $sidewall_3_remake=[
              'no'=>addNULL(!empty($request->sidewall_3_remake['no'])),
              'nosee'=>addNULL(!empty($request->sidewall_3_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->sidewall_3_remake['detail']),$request->sidewall_3_remake['detail']),
            ];
          

            $dgfloor_3_remake=[
              'no'=>addNULL(!empty($request->dgfloor_3_remake['no'])),
              'nosee'=>addNULL(!empty($request->dgfloor_3_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->dgfloor_3_remake['detail']),$request->dgfloor_3_remake['detail']),
            ];
            $dgwall_3_remake=[
              'no'=>addNULL(!empty($request->dgwall_3_remake['no'])),
              'nosee'=>addNULL(!empty($request->dgwall_3_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->dgwall_3_remake['detail']),$request->dgwall_3_remake['detail']),
            ];
            $dggate_3_remake=[
              'no'=>addNULL(!empty($request->dggate_3_remake['no'])),
              'nosee'=>addNULL(!empty($request->dggate_3_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->dggate_3_remake['detail']),$request->dggate_3_remake['detail']),
            ];
            $dgmachanic_3_remake=[
              'no'=>addNULL(!empty($request->dgmachanic_3_remake['no'])),
              'nosee'=>addNULL(!empty($request->dgmachanic_3_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->dgmachanic_3_remake['detail']),$request->dgmachanic_3_remake['detail']),
            ];
            $dgblock_3_remake=[
              'no'=>addNULL(!empty($request->dgblock_3_remake['no'])),
              'nosee'=>addNULL(!empty($request->dgblock_3_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->dgblock_3_remake['detail']),$request->dgblock_3_remake['detail']),
            ];
            $waterbreak_3_remake=[
              'no'=>addNULL(!empty($request->waterbreak_3_remake['no'])),
              'nosee'=>addNULL(!empty($request->waterbreak_3_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->waterbreak_3_remake['detail']),$request->waterbreak_3_remake['detail']),
            ];
            $bridge_3_remake=[
              'no'=>addNULL(!empty($request->bridge_3_remake['no'])),
              'nosee'=>addNULL(!empty($request->bridge_3_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->bridge_3_remake['detail']),$request->bridge_3_remake['detail']),
            ];
            $floor_4_remake=[
              'no'=>addNULL(!empty($request->floor_4_remake['no'])),
              'nosee'=>addNULL(!empty($request->floor_4_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->floor_4_remake['detail']),$request->floor_4_remake['detail']),
            ];

            $side_4_remake=[
              'no'=>addNULL(!empty($request->side_4_remake['no'])),
              'nosee'=>addNULL(!empty($request->side_4_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->side_4_remake['detail']),$request->side_4_remake['detail']),
            ];
            $flrblock_4_remake=[
              'no'=>addNULL(!empty($request->flrblock_4_remake['no'])),
              'nosee'=>addNULL(!empty($request->flrblock_4_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->flrblock_4_remake['detail']),$request->flrblock_4_remake['detail']),
            ];
            $endsill_4_remake=[
              'no'=>addNULL(!empty($request->endsill_4_remake['no'])),
              'nosee'=>addNULL(!empty($request->endsill_4_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->endsill_4_remake['detail']),$request->endsill_4_remake['detail']),
            ];
            $floor_5_remake=[
              'no'=>addNULL(!empty($request->floor_5_remake['no'])),
              'nosee'=>addNULL(!empty($request->floor_5_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->floor_5_remake['detail']),$request->floor_5_remake['detail']),
            ];
            $side_5_remake=[
              'no'=>addNULL(!empty($request->side_5_remake['no'])),
              'nosee'=>addNULL(!empty($request->side_5_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->side_5_remake['detail']),$request->side_5_remake['detail']),
            ];
            $floor_6_remake=[
              'no'=>addNULL(!empty($request->floor_6_remake['no'])),
              'nosee'=>addNULL(!empty($request->floor_6_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->floor_6_remake['detail']),$request->floor_6_remake['detail']),
            ];
            $side_6_remake=[
              'no'=>addNULL(!empty($request->side_6_remake['no'])),
              'nosee'=>addNULL(!empty($request->side_6_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->side_6_remake['detail']),$request->side_6_remake['detail']),
            ];
            $gate_6_remake=[
              'no'=>addNULL(!empty($request->gate_6_remake['no'])),
              'nosee'=>addNULL(!empty($request->gate_6_remake['nosee'])),
              'detail'=>addNULL1(!empty($request->gate_6_remake['detail']),$request->side_6_remake['detail']),
            ];
          // dd($floor_1_remake);

          function calCode($users,$text) {
            if($users== NULL){
              return ("00001");
            }else{
              $names = str_split($users->$text);
              if($text=="prob_id" ||$text=="proj_id" ){
              $code =$names[3].$names[4].$names[5].$names[6];
              }else{
              $code =$names[2].$names[3].$names[4].$names[5];
              }
              $num=$code+1;
              if($num<10){
                return ("0000".$num);
              }else if ($num<100){
                return ("000".$num);
              }else if ($num<1000){
                return ("00".$num);
              }else {
                return ("0".$num);
              }
            }
              
          }

          function calCodePH($users,$text) {
        
            if($users== NULL){
                return ("01");
            }else{
              //  dd($users);
                // $num=count($users);
                // $names = str_split($users->$text);
                // $code =$names[11].$names[12];
                $num=$users+1;
                // dd($code);
                if($num<10){
                  return ("0".$num);
                }else{
                  return ($num);
                }
            }
          }

          function calCodeW($text) {
            if($text== NULL){
              return ("01");
            }else{
                $num=$text+1;
                if($num<10){
                  return ("0".$num);
                }else{
                  return ($num);
                }
            }
          }
        // Connenct Data base
          // $weir_id_last = DB::table('weir_surveys')->select('weir_id')->orderBy('created_at', 'asc')->get()->last();
          // $river_id_last= DB::table('rivers')->select('river_id')->orderBy('created_at', 'asc')->get()->last();
          // $weir_spec_id_last= DB::table('weir_spaceifications')->select('weir_spec_id')->orderBy('created_at', 'asc')->get()->last();
          // $weir_location_id_last= DB::table('weir_locations')->select('weir_location_id')->orderBy('created_at', 'asc')->get()->last();
          // $maintain_id_last= DB::table('maintenances')->select('maintain_id')->orderBy('created_at', 'asc')->get()->last();
          // $plan_id_last= DB::table('improvement_plans')->select('plan_id')->orderBy('created_at', 'asc')->get()->last();
          // $suggest_id_last= DB::table('additinal_suggestions')->select('suggest_id')->orderBy('created_at', 'asc')->get()->last();

          $weir_id_last = DB::table('weir_surveys')->select('weir_id')->get()->last();
          $river_id_last= DB::table('rivers')->select('river_id')->get()->last();
          $weir_spec_id_last= DB::table('weir_spaceifications')->select('weir_spec_id')->get()->last();
          $weir_location_id_last= DB::table('weir_locations')->select('weir_location_id')->get()->last();
          $maintain_id_last= DB::table('maintenances')->select('maintain_id')->get()->last();
          $plan_id_last= DB::table('improvement_plans')->select('plan_id')->get()->last();
          $suggest_id_last= DB::table('additinal_suggestions')->select('suggest_id')->get()->last();


          $weir_id="W".calCode($weir_id_last,"weir_id");
          $river_id="R".calCode($river_id_last,"river_id");
          $weir_spec_id="S".calCode($weir_spec_id_last,"weir_spec_id");
          $weir_location_id="L".calCode($weir_location_id_last,"weir_location_id");
          $maintain_id="M".calCode($maintain_id_last,"maintain_id");
          $plan_id="P".calCode($plan_id_last,"plan_id");
          $suggest_id="S".calCode($suggest_id_last,"suggest_id");
          //dd($river_id_last);
          $vill=explode(" ",$request->weir_village);
          //dd($request->weir_village);
          $code =DB::table('locations')->select('vill_code')->where('vill_name',$vill[2] )->where('vill_moo',$vill[1])->get();
          
          $codeweir="W".$code[0]->vill_code.'%';       
          $weircode = DB::table('weir_surveys')->select('weir_code')->where('weir_code','like',$codeweir)->get();
          $wcode = DB::table('weir_surveys')->select('weir_code')->where('weir_code','like',$codeweir)->get()->last();
          if($wcode == NULL){
            $num=calCodeW(count($weircode));
            $codeweir="W".$code[0]->vill_code.$num;
          }else{
            $c = str_split($wcode->weir_code,1);
            if((int)$c[9]>0){
              $n = $c[9].$c[10];
              $num=calCodeW((int)$n);
              $codeweir="W".$code[0]->vill_code.$num;
            }else{
              $num=calCodeW((int)$c[10]);
              $codeweir="W".$code[0]->vill_code.$num;

            }
          }
          
          // $n = $c[9].$c[10];

          // dd($n);
          // $num=calCodeW(count($weircode));
          // $codeweir="W".$code[0]->vill_code.$num;
        //dd($river_id);

        // Insert Data
        /////--------weir_surveys-------------/////////
          $river=new River(
            [
              'river_id'=>$river_id,
              'river_name'=>$request->river_name,
              'river_branch'=>$request->river_branch,
              'river_type'=>$request->river_type
            ]
          );
          $river->save();
        // dd($request->weir_UTM ,json_encode($request->weir_UTM) );
        /////--------weir_Location-------------/////////
          $location=new WeirLocation(
            [
              'weir_location_id'=>$weir_location_id,
              'utm'=> json_encode($request->weir_UTM),
              'latlong'=>json_encode($request->weir_latlog),
              'weir_village'=>$request->weir_village,
              'weir_tumbol'=>$request->weir_tumbol,
              'weir_district'=>$request->weir_district,
              'weir_province'=>"ลำปาง", 
            ]
          );
          $location->save();
        
        /////--------weir_spaceifications-------------/////////
          $space_weir=new WeirSpaceification(
            [
              'weir_spec_id'=>$weir_spec_id,
              'ridge_type'=>json_encode($request->ridge_type, JSON_UNESCAPED_UNICODE),
              'ridge_height'=>$request->ridge_height,
              'ridge_width'=>$request->ridge_width,
              'gate_has'=>$request->gate_has,
              'gate_type'=>$request->gate_type,
              'gate_dimension'=>json_encode($request->gate_dimension, JSON_UNESCAPED_UNICODE),
              'gate_machanic_has'=>$request->gate_machanic_has,
              'gate_machanic_type'=>$request->gate_machanic_type,
              'control_building_has'=>$request->control_building_has,
              'control_building_type'=>json_encode($control_building_type, JSON_UNESCAPED_UNICODE),
              'conttrol_building_loc'=>json_encode($building_loc, JSON_UNESCAPED_UNICODE), 
              'control_building_gate_has'=>$request->control_building_gate_has,
              'control_building_gate_type'=>$request->control_building_gate_type,
              'control_building_gate_dimension'=>json_encode($request->control_building_gate_dimension, JSON_UNESCAPED_UNICODE),
              'control_building_machanic_type'=>$request->control_building_machanic_type,
              'canal_has'=>$request->canal_has,
              'canal_type'=>$request->canal_type,
              'canel_dimension'=>json_encode($request->canel_dimension, JSON_UNESCAPED_UNICODE),
              'benefit_area'=>$request->benefit_area,
              'comsumption'=>$request->comsumption,
              'agriculture'=>$request->agriculture,
            ]
          );
          $space_weir->save();

        // dd($space_weir);
        ///////--------MaintenanceLog------------********Must be loop***************-/////////
          $num=calCode($request->maintain_id_last,"maintain_id");
          for($m=1;$m<6;$m++){
            $date="maintain_date_r".$m;
            $detail="maintain_detail_r".$m;
            $resp="maintain_resp_r".$m;
            $remake="maintain_remark_r".$m;

            if($request->$date!=NULL){
              $maintence=new Maintenance(
                [
                  'maintain_id'=>$maintain_id,
                  'weir_id'=>$weir_id ,
                  'maintain_date'=>$request->$date,
                  'maintain_detail'=>$request->$detail,
                  'maintain_resp'=>$request->$resp,
                  'maintain_remark'=>$request->$remake,
                ]
              );
              $maintence->save();
            }
            $maintain_id_last= DB::table('maintenances')->select('maintain_id')->orderBy('created_at', 'asc')->get()->last();
            $maintain_id="M".calCode($maintain_id_last,"maintain_id");
          }

        // /////--------weir_surveys-------------/////////
          if($request->resp_name1!=NULL||$request->resp_name2!=NULL||$request->resp_name2!=NULL){
            if($request->resp_name1!=NULL){
              $resp_name = $request->resp_name1;
            }else if($request->resp_name2!=NULL){
              $resp_name = $request->resp_name2;
            }else{
              $resp_name = $request->resp_name3;
            }
          }else{
            $resp_name =NULL;
          }

          // dd($resp_name);
          $weir= new WeirSurvey(
            [
              'weir_id'=>$weir_id,
              'weir_code'=>$codeweir,
              'weir_name'=>$request->weir_name,
              'river_id'=>$river_id,
              'weir_spec_id'=>$weir_spec_id,
              'weir_location_id'=>$weir_location_id,
              'weir_build'=>$request->weir_year,
              'weir_age'=>$request->weir_age,
              'weir_model'=>json_encode($model, JSON_UNESCAPED_UNICODE),
              'Resp_type'=>$request->resp_type,
              'resp_name'=>$resp_name,
              'transfer'=>$request->transfer,
              'user'=>$name,
              'survey_name'=>$request->survey_name,
              'survey_date'=>$request->survey_date,
              'survey_position'=>$request->survey_position,
              'survey_unit'=>$request->survey_unit,
            ]
          );
          $weir->save();

        ///////----1----upprotection_invs-------------/////////
          $upprotection=new UpprotectionInv(
            [
              'weir_id'=>$weir_id,          
              'floor_erosion'=>$request->floor_1_erosion,
              'floor_subsidence'=>$request->floor_1_subsidence,
              'floor_cracking'=>$request->floor_1_cracking,
              'floor_obstruction'=>$request->floor_1_obstruction,
              'floor_hole'=>$request->floor_1_hole,
              'floor_leak'=>$request->floor_1_leak,
              'floor_movement'=>$request->floor_1_movement,
              'floor_drainage'=>$request->floor_1_drainage,
              'floor_weed'=>$request->floor_1_weed,
              'floor_damage'=>$request->floor_1_damage,
              'floor_remake'=>json_encode($floor_1_remake, JSON_UNESCAPED_UNICODE),
              'check_floor'=>$request->check_floor_1,
              'side_erosion'=>$request->side_1_erosion,
              'side_subsidence'=>$request->side_1_subsidence,
              'side_cracking'=>$request->side_1_cracking,
              'side_obstruction'=>$request->side_1_obstruction,
              'side_hole'=>$request->side_1_hole,
              'side_leak'=>$request->side_1_leak,
              'side_movement'=>$request->side_1_movement,
              'side_drainage'=>$request->side_1_drainage,
              'side_weed'=>$request->side_1_weed,
              'side_damage'=>$request->side_1_damage,
              'side_remake'=>json_encode($side_1_remake, JSON_UNESCAPED_UNICODE),
              'section_status'=>$request->Upstream,
            ]
          );
          $upprotection->save();

        ///////----2----upconcrete_invs-------------/////////
            $upconcrete=new UpconcreteInv(
              [
                'weir_id'=>$weir_id,  
                'floor_erosion'=>$request->floor_2_erosion,
                'floor_subsidence'=>$request->floor_2_subsidence,
                'floor_cracking'=>$request->floor_2_cracking,
                'floor_obstruction'=>$request->floor_2_obstruction,
                'floor_hole'=>$request->floor_2_hole,
                'floor_leak'=>$request->floor_2_leak,
                'floor_movement'=>$request->floor_2_movement,
                'floor_drainage'=>$request->floor_2_damage,
                'floor_weed'=>$request->floor_2_weed,
                'floor_damage'=>$request->floor_2_damage,
                'floor_remake'=>json_encode($floor_2_remake, JSON_UNESCAPED_UNICODE),
                'check_floor'=>$request->check_floor_2,
                'side_erosion'=>$request->side_2_erosion,
                'side_subsidence'=>$request->side_2_subsidence,
                'side_cracking'=>$request->side_2_cracking,
                'side_obstruction'=>$request->side_2_obstruction,
                'side_hole'=>$request->side_2_hole,
                'side_leak'=>$request->side_2_leak,
                'side_movement'=>$request->side_2_movement,
                'side_drainage'=>$request->side_2_drainage,
                'side_weed'=>$request->side_2_weed,
                'side_damage'=>$request->side_2_damage,
                'side_remake'=>json_encode($side_2_remake, JSON_UNESCAPED_UNICODE),
                'section_status'=>$request->Upstream_Concrete,
              ]
            );
            $upconcrete->save();

        ///////----3----control_invs-------------/////////
          $control=new ControlInv(
            [
              'weir_id'=>$weir_id,
              'waterctrl_erosion'=>$request->waterctrl_3_erosion,
              'waterctrl_subsidence'=>$request->waterctrl_3_subsidence,
              'waterctrl_cracking'=>$request->waterctrl_3_cracking,
              'waterctrl_obstruction'=>$request->waterctrl_3_obstruction,
              'waterctrl_hole'=>$request->waterctrl_3_hole,
              'waterctrl_leak'=>$request->waterctrl_3_leak,
              'waterctrl_movement'=>$request->waterctrl_3_movement,
              'waterctrl_drainage'=>$request->waterctrl_3_drainage,
              'waterctrl_weed'=>$request->waterctrl_3_weed,
              'waterctrl_damage'=>$request->waterctrl_3_damage,
              'waterctrl_remake'=>json_encode($waterctrl_3_remake, JSON_UNESCAPED_UNICODE),

              'sidewall_erosion'=>$request->sidewall_3_erosion,
              'sidewall_subsidence'=>$request->sidewall_3_subsidence,
              'sidewall_cracking'=>$request->sidewall_3_cracking,
              'sidewall_obstruction'=>$request->sidewall_3_obstruction,
              'sidewall_hole'=>$request->sidewall_3_hole,
              'sidewall_leak'=>$request->sidewall_3_leak,
              'sidewall_movement'=>$request->sidewall_3_movement,
              'sidewall_drainage'=>$request->sidewall_3_drainage,
              'sidewall_weed'=>$request->sidewall_3_weed,
              'sidewall_damage'=>$request->sidewall_3_damage,
              'sidewall_remake'=>json_encode($sidewall_3_remake, JSON_UNESCAPED_UNICODE),

              'dgfloor_erosion'=>$request->dgfloor_3_erosion,
              'dgfloor_subsidence'=>$request->dgfloor_3_subsidence,
              'dgfloor_cracking'=>$request->dgfloor_3_cracking,
              'dgfloor_obstruction'=>$request->dgfloor_3_obstruction,
              'dgfloor_hole'=>$request->dgfloor_3_hole,
              'dgfloor_leak'=>$request->dgfloor_3_leak,
              'dgfloor_movement'=>$request->dgfloor_3_movement,
              'dgfloor_drainage'=>$request->dgfloor_3_drainage,
              'dgfloor_weed'=>$request->dgfloor_3_weed,
              'dgfloor_damage'=>$request->dgfloor_3_damage,
              'dgfloor_remake'=>json_encode($dgfloor_3_remake, JSON_UNESCAPED_UNICODE),

              'dgwall_erosion'=>$request->dgwall_3_erosion,
              'dgwall_subsidence'=>$request->dgwall_3_subsidence,
              'dgwall_cracking'=>$request->dgwall_3_cracking,
              'dgwall_obstruction'=>$request->dgwall_3_obstruction,
              'dgwall_hole'=>$request->dgwall_3_hole,
              'dgwall_leak'=>$request->dgwall_3_leak,
              'dgwall_movement'=>$request->dgwall_3_movement,
              'dgwall_drainage'=>$request->dgwall_3_drainage,
              'dgwall_weed'=>$request->dgwall_3_weed,
              'dgwall_damage'=>$request->dgwall_3_damage,
              'dgwall_remake'=>json_encode($dgwall_3_remake, JSON_UNESCAPED_UNICODE),

              'dggate_erosion'=>$request->dggate_3_erosion,
              'dggate_subsidence'=>$request->dggate_3_subsidence,
              'dggate_cracking'=>$request->dggate_3_cracking,
              'dggate_obstruction'=>$request->dggate_3_obstruction,
              'dggate_hole'=>$request->dggate_3_hole,
              'dggate_leak'=>$request->dggate_3_leak,
              'dggate_movement'=>$request->dggate_3_movement,
              'dggate_drainage'=>$request->dggate_3_drainage,
              'dggate_weed'=>$request->dggate_3_weed,
              'dggate_damage'=>$request->dggate_3_damage,
              'dggate_remake'=>json_encode($dggate_3_remake, JSON_UNESCAPED_UNICODE),

              'dgmachanic_erosion'=>$request->dgmachanic_3_erosion,
              'dgmachanic_subsidence'=>$request->dgmachanic_3_subsidence,
              'dgmachanic_cracking'=>$request->dgmachanic_3_cracking,
              'dgmachanic_obstruction'=>$request->dgmachanic_3_obstruction,
              'dgmachanic_hole'=>$request->dgmachanic_3_hole,
              'dgmachanic_leak'=>$request->dgmachanic_3_leak,
              'dgmachanic_movement'=>$request->dgmachanic_3_movement,
              'dgmachanic_drainage'=>$request->dgmachanic_3_drainage,
              'dgmachanic_weed'=>$request->dgmachanic_3_weed,
              'dgmachanic_damage'=>$request->dgmachanic_3_damage,
              'dgmachanic_remake'=>json_encode($dgmachanic_3_remake, JSON_UNESCAPED_UNICODE),

              'dgblock_erosion'=>$request->dgblock_3_erosion,
              'dgblock_subsidence'=>$request->dgblock_3_subsidence,
              'dgblock_cracking'=>$request->dgblock_3_cracking,
              'dgblock_obstruction'=>$request->dgblock_3_obstruction,
              'dgblock_hole'=>$request->dgblock_3_hole,
              'dgblock_leak'=>$request->dgblock_3_leak,
              'dgblock_movement'=>$request->dgblock_3_movement,
              'dgblock_drainage'=>$request->dgblock_3_drainage,
              'dgblock_weed'=>$request->dgblock_3_weed,
              'dgblock_damage'=>$request->dgblock_3_damage,
              'dgblock_remake'=>json_encode($dgblock_3_remake, JSON_UNESCAPED_UNICODE),

              'waterbreak_erosion'=>$request->waterbreak_3_erosion,
              'waterbreak_subsidence'=>$request->waterbreak_3_subsidence,
              'waterbreak_cracking'=>$request->waterbreak_3_cracking,
              'waterbreak_obstruction'=>$request->waterbreak_3_obstruction,
              'waterbreak_hole'=>$request->waterbreak_3_hole,
              'waterbreak_leak'=>$request->waterbreak_3_leak,
              'waterbreak_movement'=>$request->waterbreak_3_movement,
              'waterbreak_drainage'=>$request->waterbreak_3_drainage,
              'waterbreak_weed'=>$request->waterbreak_3_weed,
              'waterbreak_damage'=>$request->waterbreak_3_damage,
              'waterbreak_remake'=>json_encode($waterbreak_3_remake, JSON_UNESCAPED_UNICODE),

              'bridge_erosion'=>$request->bridge_3_erosion,
              'bridge_subsidence'=>$request->bridge_3_subsidence,
              'bridge_cracking'=>$request->bridge_3_cracking,
              'bridge_obstruction'=>$request->bridge_3_obstruction,
              'bridge_hole'=>$request->bridge_3_hole,
              'bridge_leak'=>$request->bridge_3_leak,
              'bridge_movement'=>$request->bridge_3_movement,
              'bridge_drainage'=>$request->bridge_3_drainage,
              'bridge_weed'=>$request->bridge_3_weed,
              'bridge_damage'=>$request->bridge_3_damage,
              'bridge_remake'=>json_encode($bridge_3_remake, JSON_UNESCAPED_UNICODE),

              'section_status'=>$request->Control,
              'check_floor'=>$request->check_floor_3,
            ]
          );
          $control->save();

        ///////---4-----downconcrete_invs-------------/////////
          $downconcrete=new DownconcreteInv(
            [
              'weir_id'=>$weir_id,

              'floor_erosion'=>$request->floor_4_erosion,
              'floor_subsidence'=>$request->floor_4_subsidence,
              'floor_cracking'=>$request->floor_4_cracking,
              'floor_obstruction'=>$request->floor_4_obstruction,
              'floor_hole'=>$request->floor_4_hole,
              'floor_leak'=>$request->floor_4_leak,
              'floor_movement'=>$request->floor_4_movement,
              'floor_drainage'=>$request->floor_4_drainage,
              'floor_weed'=>$request->floor_4_weed,
              'floor_damage'=>$request->floor_4_damage,
              'floor_remake'=>json_encode($floor_4_remake, JSON_UNESCAPED_UNICODE),
              'check_floor'=>$request->check_floor_4,

              'side_erosion'=>$request->side_4_erosion,
              'side_subsidence'=>$request->side_4_subsidence,
              'side_cracking'=>$request->side_4_cracking,
              'side_obstruction'=>$request->side_4_obstruction,
              'side_hole'=>$request->side_4_hole,
              'side_leak'=>$request->side_4_leak,
              'side_movement'=>$request->side_4_movement,
              'side_drainage'=>$request->side_4_drainage,
              'side_weed'=>$request->side_4_weed,
              'side_damage'=>$request->side_4_damage,
              'side_remake'=>json_encode($side_4_remake, JSON_UNESCAPED_UNICODE),

              'flrblock_erosion'=>$request->flrblock_4_erosion,
              'flrblock_subsidence'=>$request->flrblock_4_subsidence,
              'flrblock_cracking'=>$request->flrblock_4_cracking,
              'flrblock_obstruction'=>$request->flrblock_4_obstruction,
              'flrblock_hole'=>$request->flrblock_4_hole,
              'flrblock_leak'=>$request->flrblock_4_leak,
              'flrblock_movement'=>$request->flrblock_4_movement,
              'flrblock_drainage'=>$request->flrblock_4_drainage,
              'flrblock_weed'=>$request->flrblock_4_weed,
              'flrblock_damage'=>$request->flrblock_4_damage,
              'flrblock_remake'=>json_encode($flrblock_4_remake, JSON_UNESCAPED_UNICODE),

              'endsill_erosion'=>$request->endsill_4_erosion,
              'endsill_subsidence'=>$request->endsill_4_subsidence,
              'endsill_cracking'=>$request->endsill_4_cracking,
              'endsill_obstruction'=>$request->endsill_4_obstruction,
              'endsill_hole'=>$request->endsill_4_hole,
              'endsill_leak'=>$request->endsill_4_leak,
              'endsill_movement'=>$request->endsill_4_movement,
              'endsill_drainage'=>$request->endsill_4_drainage,
              'endsill_weed'=>$request->endsill_4_weed,
              'endsill_damage'=>$request->endsill_4_damage,
              'endsill_remake'=>json_encode($endsill_4_remake, JSON_UNESCAPED_UNICODE),

              'section_status'=>$request->Downstream_Concrete,
            ]
          );
          $downconcrete->save();

        ///////----5----downprotection_invs-------------/////////
          $downprotection=new DownprotectionInv(
            [
              'weir_id'=>$weir_id,

              'floor_erosion'=>$request->floor_5_erosion,
              'floor_subsidence'=>$request->floor_5_subsidence,
              'floor_cracking'=>$request->floor_5_cracking,
              'floor_obstruction'=>$request->floor_5_obstruction,
              'floor_hole'=>$request->floor_5_hole,
              'floor_leak'=>$request->floor_5_leak,
              'floor_movement'=>$request->floor_5_movement,
              'floor_drainage'=>$request->floor_5_drainage,
              'floor_weed'=>$request->floor_5_weed,
              'floor_damage'=>$request->floor_5_damage,
              'floor_remake'=>json_encode($floor_5_remake, JSON_UNESCAPED_UNICODE),
              'check_floor'=>$request->check_floor_5,

              'side_erosion'=>$request->side_5_erosion,
              'side_subsidence'=>$request->side_5_subsidence,
              'side_cracking'=>$request->side_5_cracking,
              'side_obstruction'=>$request->side_5_obstruction,
              'side_hole'=>$request->side_5_hole,
              'side_leak'=>$request->side_5_leak,
              'side_movement'=>$request->side_5_movement,
              'side_drainage'=>$request->side_5_drainage,
              'side_weed'=>$request->side_5_weed,
              'side_damage'=>$request->side_5_damage,
              'side_remake'=>json_encode($side_5_remake, JSON_UNESCAPED_UNICODE),

              'section_status'=>$request->Downstream_Protection,
              
            ]
          );
          $downprotection->save();

        ///////----6----waterdelivery_invs-------------/////////
          $water=new WaterdeliveryInv(
            [
              'weir_id'=>$weir_id,

              'floor_erosion'=>$request->floor_6_erosion,
              'floor_subsidence'=>$request->floor_6_subsidence,
              'floor_cracking'=>$request->floor_6_cracking,
              'floor_obstruction'=>$request->floor_6_obstruction,
              'floor_hole'=>$request->floor_6_hole,
              'floor_leak'=>$request->floor_6_leak,
              'floor_movement'=>$request->floor_6_movement,
              'floor_drainage'=>$request->floor_6_drainage,
              'floor_weed'=>$request->floor_6_weed,
              'floor_damage'=>$request->floor_6_damage,
              'floor_remake'=>json_encode($floor_6_remake, JSON_UNESCAPED_UNICODE),
              'check_floor'=>$request->check_floor_6,

              'side_erosion'=>$request->side_6_erosion,
              'side_subsidence'=>$request->side_6_subsidence,
              'side_cracking'=>$request->side_6_cracking,
              'side_obstruction'=>$request->side_6_obstruction,
              'side_hole'=>$request->side_6_hole,
              'side_leak'=>$request->side_6_leak,
              'side_movement'=>$request->side_6_movement,
              'side_drainage'=>$request->side_6_drainage,
              'side_weed'=>$request->side_6_weed,
              'side_damage'=>$request->side_6_damage,
              'side_remake'=>json_encode($side_6_remake, JSON_UNESCAPED_UNICODE),

              'gate_erosion'=>$request->gate_6_erosion,
              'gate_subsidence'=>$request->gate_6_subsidence,
              'gate_cracking'=>$request->gate_6_cracking,
              'gate_obstruction'=>$request->gate_6_obstruction,
              'gate_hole'=>$request->gate_6_hole,
              'gate_leak'=>$request->gate_6_leak,
              'gate_movement'=>$request->gate_6_movement,
              'gate_drainage'=>$request->gate_6_drainage,
              'gate_weed'=>$request->gate_6_weed,
              'gate_damage'=>$request->gate_6_damage,
              'gate_remake'=>json_encode($gate_6_remake, JSON_UNESCAPED_UNICODE),

              'section_status'=>$request->Water_system,
              
            ]
          );
          $water->save();

        // /////--------improvement_plans-------------/////////
          $plan= new ImprovementPlan(
            [
              'plan_id'=>$plan_id,
              'weir_id'=>$weir_id,
              'plan_year_check'=>$request->plan_year_check,
              'plan_year'=>$request->plan_year,
              'plan_type'=>$request->plan_type,
              'plan_budget'=>$request->plan_budget,
              'proj_budget_check'=>$request->proj_budget_check,
              'proj_budget'=>$request->proj_budget_check,
              'proj_type'=>$request->proj_type,
              'plan_improve'=>$request->plan_improve,
              'plan_no'=>$request->plan_no,
            ]
          );
          $plan->save();

        // /////--------additinal_suggestions-------------/////////
          $plan= new AdditinalSuggestion(
            [
              'suggest_id'=>$suggest_id,
              'weir_id'=>$weir_id,
              'suggestion'=>$request->suggustion
            ]
          );
          $plan->save();
       
        // dd();
        //////------ Upload photo  -----------------------//////
            //1 **************** check if image photo_type_bld **********************//
              if ($request->hasFile('upstream_protection')) {
                $images = $request->file('upstream_protection');
                
                $org_img = $thm_img = true;
                
                if( ! File::exists('images/originals/')) { $org_img = File::makeDirectory('images/originals/', 0777, true);}
                if ( ! File::exists('images/thumbnails/')) { $thm_img = File::makeDirectory('images/thumbnails', 0777, true);}
                // loop through each image to save and upload

                foreach($images as $key => $image) {
                    // $photo= DB::table('photos')->select('photo_id')->orderBy('created_at', 'asc')->get()->last();
                    $photo= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->count();;
                    $photo_id=$codeweir."-".calCodePH($photo,"photo_id");

                    // dd($photo_id); 
                    $filename = $photo_id.'.'.$image->getClientOriginalExtension();
                    //path of image for upload
                    $org_path = 'images/originals/' . $filename;
                    $thm_path = 'images/thumbnails/' . $filename;

                    // upload image to server
                    if (($org_img && $thm_img) == true) {
                        Image::make($image)->fit(700, 300, function ($constraint) {
                                $constraint->upsize();
                            })->save($org_path);
                        Image::make($image)->fit(220, 110, function ($constraint) {
                            $constraint->upsize();
                        })->save($thm_path);
                    }
                    
                    $loc1 = new Photo(
                        [
                            'photo_id'=> $photo_id,
                            'weir_id'=>$weir_id,
                            'photo_type'=>'ส่วน Protection เหนือน้ำ',
                            'photo_filename'=>$org_path,
                            'thumbnall_filename'=>$thm_path
                            
                        ]
                    );
                    $loc1->save();
                }
              }

            //2 **************** check if image upstream_concrete **********************//
              if ($request->hasFile('upstream_concrete')) {
                $images = $request->file('upstream_concrete');
                $org_img = $thm_img = true;
                if( ! File::exists('images/originals/')) { $org_img = File::makeDirectory('images/originals/', 0777, true);}
                if ( ! File::exists('images/thumbnails/')) { $thm_img = File::makeDirectory('images/thumbnails', 0777, true);}
                // loop through each image to save and upload
                foreach($images as $key => $image) {
                    $photo= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->count();;
                    $photo_id=$codeweir."-".calCodePH($photo,"photo_id");

                    $filename = $photo_id.'.'.$image->getClientOriginalExtension();
                    //path of image for upload
                    $org_path = 'images/originals/' . $filename;
                    $thm_path = 'images/thumbnails/' . $filename;

                    // upload image to server
                    if (($org_img && $thm_img) == true) {
                        Image::make($image)->fit(700, 300, function ($constraint) {
                                $constraint->upsize();
                            })->save($org_path);
                        Image::make($image)->fit(220, 110, function ($constraint) {
                            $constraint->upsize();
                        })->save($thm_path);
                    }
                    
                    $loc2 = new Photo(
                        [
                            'photo_id'=> $photo_id,
                            'weir_id'=>$weir_id,
                            'photo_type'=>'ส่วนเหนือน้ำ',
                            'photo_filename'=>$org_path,
                            'thumbnall_filename'=>$thm_path
                            
                        ]
                    );
                    $loc2->save();
                }
              }
            //3 **************** check if image Control **********************//
              if ($request->hasFile('control')) {
                $images = $request->file('control');
                $org_img = $thm_img = true;
                if( ! File::exists('images/originals/')) { $org_img = File::makeDirectory('images/originals/', 0777, true);}
                if ( ! File::exists('images/thumbnails/')) { $thm_img = File::makeDirectory('images/thumbnails', 0777, true);}
                // loop through each image to save and upload
                foreach($images as $key => $image) {
                    $photo= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->count();;
                    $photo_id=$codeweir."-".calCodePH($photo,"photo_id");

                    $filename = $photo_id.'.'.$image->getClientOriginalExtension();
                    //path of image for upload
                    $org_path = 'images/originals/' . $filename;
                    $thm_path = 'images/thumbnails/' . $filename;

                    // upload image to server
                    if (($org_img && $thm_img) == true) {
                        Image::make($image)->fit(700, 300, function ($constraint) {
                                $constraint->upsize();
                            })->save($org_path);
                        Image::make($image)->fit(220, 110, function ($constraint) {
                            $constraint->upsize();
                        })->save($thm_path);
                    }
                    
                    $loc3 = new Photo(
                        [
                            'photo_id'=> $photo_id,
                            'weir_id'=>$weir_id,
                            'photo_type'=>'ส่วนควบคุม',
                            'photo_filename'=>$org_path,
                            'thumbnall_filename'=>$thm_path
                            
                        ]
                    );
                    $loc3->save();
                }
              }
            //4 **************** check if image Downstream Concrete **********************//
              if ($request->hasFile('downstream_concrete')) {
                $images = $request->file('downstream_concrete');
                $org_img = $thm_img = true;
                if( ! File::exists('images/originals/')) { $org_img = File::makeDirectory('images/originals/', 0777, true);}
                if ( ! File::exists('images/thumbnails/')) { $thm_img = File::makeDirectory('images/thumbnails', 0777, true);}
                // loop through each image to save and upload
                foreach($images as $key => $image) {
                    $photo= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->count();;
                    $photo_id=$codeweir."-".calCodePH($photo,"photo_id");

                    $filename = $photo_id.'.'.$image->getClientOriginalExtension();
                    //path of image for upload
                    $org_path = 'images/originals/' . $filename;
                    $thm_path = 'images/thumbnails/' . $filename;

                    // upload image to server
                    if (($org_img && $thm_img) == true) {
                        Image::make($image)->fit(700, 300, function ($constraint) {
                                $constraint->upsize();
                            })->save($org_path);
                        Image::make($image)->fit(220, 110, function ($constraint) {
                            $constraint->upsize();
                        })->save($thm_path);
                    }
                    
                    $loc4 = new Photo(
                        [
                            'photo_id'=> $photo_id,
                            'weir_id'=>$weir_id,
                            'photo_type'=>'ส่วนท้ายน้ำ',
                            'photo_filename'=>$org_path,
                            'thumbnall_filename'=>$thm_path
                            
                        ]
                    );
                    $loc4->save();
                }
              }
            //5 **************** check if image Downstream Protection **********************//
              if ($request->hasFile('downstream_protection')) {
                $images = $request->file('downstream_protection');
                $org_img = $thm_img = true;
                if( ! File::exists('images/originals/')) { $org_img = File::makeDirectory('images/originals/', 0777, true);}
                if ( ! File::exists('images/thumbnails/')) { $thm_img = File::makeDirectory('images/thumbnails', 0777, true);}
                // loop through each image to save and upload
                foreach($images as $key => $image) {
                    $photo= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->count();;
                    $photo_id=$codeweir."-".calCodePH($photo,"photo_id");

                    $filename = $photo_id.'.'.$image->getClientOriginalExtension();
                    //path of image for upload
                    $org_path = 'images/originals/' . $filename;
                    $thm_path = 'images/thumbnails/' . $filename;

                    // upload image to server
                    if (($org_img && $thm_img) == true) {
                        Image::make($image)->fit(700, 300, function ($constraint) {
                                $constraint->upsize();
                            })->save($org_path);
                        Image::make($image)->fit(220, 110, function ($constraint) {
                            $constraint->upsize();
                        })->save($thm_path);
                    }
                    
                    $loc5 = new Photo(
                        [
                            'photo_id'=> $photo_id,
                            'weir_id'=>$weir_id,
                            'photo_type'=>'ส่วน Protection ท้ายน้ำ ',
                            'photo_filename'=>$org_path,
                            'thumbnall_filename'=>$thm_path
                            
                        ]
                    );
                    $loc5->save();
                }
              }

            //6 **************** check if image Downstream Protection **********************//
              if ($request->hasFile('water_system')) {
                $images = $request->file('water_system');
                $org_img = $thm_img = true;
                if( ! File::exists('images/originals/')) { $org_img = File::makeDirectory('images/originals/', 0777, true);}
                if ( ! File::exists('images/thumbnails/')) { $thm_img = File::makeDirectory('images/thumbnails', 0777, true);}
                // loop through each image to save and upload
                foreach($images as $key => $image) {
                    $photo= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->count();;
                    $photo_id=$codeweir."-".calCodePH($photo,"photo_id");

                    $filename = $photo_id.'.'.$image->getClientOriginalExtension();
                    //path of image for upload
                    $org_path = 'images/originals/' . $filename;
                    $thm_path = 'images/thumbnails/' . $filename;

                    // upload image to server
                    if (($org_img && $thm_img) == true) {
                        Image::make($image)->fit(700, 300, function ($constraint) {
                                $constraint->upsize();
                            })->save($org_path);
                        Image::make($image)->fit(220, 110, function ($constraint) {
                            $constraint->upsize();
                        })->save($thm_path);
                    }
                    
                    $loc6 = new Photo(
                        [
                            'photo_id'=> $photo_id,
                            'weir_id'=>$weir_id,
                            'photo_type'=>'ระบบส่งน้ำ',
                            'photo_filename'=>$org_path,
                            'thumbnall_filename'=>$thm_path
                            
                        ]
                    );
                    $loc6->save();
                }
              }

           

              $user=$name;
              $location = WeirLocation::select('*')->get();
              for ($i=0;$i<count($location);$i++){ 
                $weir = WeirSurvey::select('weir_id','weir_code','weir_name','river_id','user','created_at')->where('weir_location_id',$location[$i]->weir_location_id)->get();
                $river = River::select('river_name')->where('river_id',$weir[0]->river_id)->get();
                $latlong=json_decode($location[$i]->latlong);
                if($weir[0]->user==$user){
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
                                'date'=>$weir[0]->created_at
                              ];
                  }
             }
              
        
        // dd($dataUser);
        // //// -------- Weir Expert ------------------/////
        $expert= new WeirExpert(
            [
              'weir_id'=>$weir_id,            
              'weir_code'=>$codeweir,
              'weir_problem'=>NULL,
              'weir_solution'=>NULL,
            ]
          );
        $expert->save();
        // //// -------- Weir Catchment ------------------/////
        $catchmant= new WeirCatchment(
            [
              'weir_id'=>$weir_id,
              'weir_code'=>$codeweir,
              'area'=>NULL, 
              'L'=>NULL, 
              'LC'=>NULL,
              'H'=>NULL, 
              'S'=>NULL, 
              'c'=>NULL, 
              'I'=>NULL, 
              'Return_period'=>NULL, 
              'flow'=>NULL,
            ]
          );
        $catchmant->save();
        

        return redirect()->route("list");
        // return view('form.list',compact('user','dataUser'));
        // dd("ok");
        // return view('form.list');
      


    }

    public function formUpdate(Request $request, User $user){
      // dd($request->comsumption);
      $name=Auth::user()->name ;
      function addNULL($text) {
        if($text==true){return 1;}
        else{return NULL;}
      }
      function addNULL1($text,$t) {
        if($text==true){return $t;}
        else{return NULL;}
      }
      function addNULL2($t1,$t2) {
        if($t1==true||$t2==true){ return 1;}
        else{return 0;}
      }
      // dd($request);
        $model =[
          'self'=>[
            'weir_self'=>addNULL(!empty($request->weir_model['self']['weir_self'])),
            'weir_std'=>addNULL(!empty($request->weir_model['self']['weir_std'])),
            'std_detial'=>addNULL1(!empty($request->weir_model['self']['detial']),$request->weir_model['self']['detial']),
            'villager'=>addNULL(!empty($request->weir_model['self']['villager'])),
            'villager_detial'=>addNULL1(!empty($request->weir_model['self']['villager_detial']),$request->weir_model['self']['villager_detial'])
          ]
        ];
      // dd($model);
        $control_building_type=[
          'open'=>[
            'type'=>addNULL2(!empty($request->control_building_type['open']['left']),!empty($request->control_building_type['open']['left'])),
            'left'=>addNULL(!empty($request->control_building_type['open']['left'])),
            'right'=>addNULL(!empty($request->control_building_type['open']['right']))
          ],
          'close'=>[
            'type'=>addNULL(!empty($request->control_building_type['close']['left']),!empty($request->control_building_type['close']['right'])),
            'left'=>addNULL(!empty($request->control_building_type['close']['left'])),
            'right'=>addNULL(!empty($request->control_building_type['close']['right']))
          ]
        ];

        $building_loc=[
          'size'=>addNULL1(!empty($request->conttrol_building_loc['size']),$request->conttrol_building_loc['size']),
          'long'=>addNULL1(!empty($request->conttrol_building_loc['long']),$request->conttrol_building_loc['long']),
          'base'=>addNULL1(!empty($request->conttrol_building_loc['base']),$request->conttrol_building_loc['base']),
        ];
      
        $floor_1_remake=[
          'no'=>addNULL(!empty($request->floor_1_remake['no'])),
          'nosee'=>addNULL(!empty($request->floor_1_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->floor_1_remake['detail']),$request->floor_1_remake['detail']),
        ];
        $side_1_remake=[
          'no'=>addNULL(!empty($request->side_1_remake['no'])),
          'nosee'=>addNULL(!empty($request->side_1_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->side_1_remake['detail']),$request->side_1_remake['detail']),
        ];
        $floor_2_remake=[
          'no'=>addNULL(!empty($request->floor_2_remake['no'])),
          'nosee'=>addNULL(!empty($request->floor_2_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->floor_2_remake['detail']),$request->floor_2_remake['detail']),
        ];
        // dd(!empty($request->$side_2_remake['no']));
        $side_2_remake=[
          'no'=>addNULL(!empty($request->side_2_remake['no'])),
          'nosee'=>addNULL(!empty($request->side_2_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->side_2_remake['detail']),$request->side_2_remake['detail']),
        ];
        
        $waterctrl_3_remake=[
          'no'=>addNULL(!empty($request->waterctrl_3_remake['no'])),
          'nosee'=>addNULL(!empty($request->waterctrl_3_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->waterctrl_3_remake['detail']),$request->waterctrl_3_remake['detail']),
        ];

        $sidewall_3_remake=[
          'no'=>addNULL(!empty($request->sidewall_3_remake['no'])),
          'nosee'=>addNULL(!empty($request->sidewall_3_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->sidewall_3_remake['detail']),$request->waterctrl_3_remake['detail']),
        ];

        $dgfloor_3_remake=[
          'no'=>addNULL(!empty($request->dgfloor_3_remake['no'])),
          'nosee'=>addNULL(!empty($request->dgfloor_3_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->dgfloor_3_remake['detail']),$request->dgfloor_3_remake['detail']),
        ];
        $dgwall_3_remake=[
          'no'=>addNULL(!empty($request->dgwall_3_remake['no'])),
          'nosee'=>addNULL(!empty($request->dgwall_3_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->dgwall_3_remake['detail']),$request->dgwall_3_remake['detail']),
        ];
        $dggate_3_remake=[
          'no'=>addNULL(!empty($request->dggate_3_remake['no'])),
          'nosee'=>addNULL(!empty($request->dggate_3_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->dggate_3_remake['detail']),$request->dggate_3_remake['detail']),
        ];
        $dgmachanic_3_remake=[
          'no'=>addNULL(!empty($request->dgmachanic_3_remake['no'])),
          'nosee'=>addNULL(!empty($request->dgmachanic_3_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->dgmachanic_3_remake['detail']),$request->dgmachanic_3_remake['detail']),
        ];
        $dgblock_3_remake=[
          'no'=>addNULL(!empty($request->dgblock_3_remake['no'])),
          'nosee'=>addNULL(!empty($request->dgblock_3_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->dgblock_3_remake['detail']),$request->dgblock_3_remake['detail']),
        ];
        $waterbreak_3_remake=[
          'no'=>addNULL(!empty($request->waterbreak_3_remake['no'])),
          'nosee'=>addNULL(!empty($request->waterbreak_3_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->waterbreak_3_remake['detail']),$request->waterbreak_3_remake['detail']),
        ];
        $bridge_3_remake=[
          'no'=>addNULL(!empty($request->bridge_3_remake['no'])),
          'nosee'=>addNULL(!empty($request->bridge_3_remake['nosee'])),
          'detail'=>addNULL(!empty($request->bridge_3_remake['detail']),$request->bridge_3_remake['detail']),
        ];
        $floor_4_remake=[
          'no'=>addNULL(!empty($request->floor_4_remake['no'])),
          'nosee'=>addNULL(!empty($request->floor_4_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->floor_4_remake['detail']),$request->floor_4_remake['detail']),
        ];

        $side_4_remake=[
          'no'=>addNULL(!empty($request->side_4_remake['no'])),
          'nosee'=>addNULL(!empty($request->side_4_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->side_4_remake['detail']),$request->side_4_remake['detail']),
        ];
        $flrblock_4_remake=[
          'no'=>addNULL(!empty($request->flrblock_4_remake['no'])),
          'nosee'=>addNULL(!empty($request->flrblock_4_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->flrblock_4_remake['detail']),$request->flrblock_4_remake['detail']),
        ];
        $endsill_4_remake=[
          'no'=>addNULL(!empty($request->endsill_4_remake['no'])),
          'nosee'=>addNULL(!empty($request->endsill_4_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->endsill_4_remake['detail']),$request->endsill_4_remake['detail']),
        ];
        $floor_5_remake=[
          'no'=>addNULL(!empty($request->floor_5_remake['no'])),
          'nosee'=>addNULL(!empty($request->floor_5_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->floor_5_remake['detail']),$request->floor_5_remake['detail']),
        ];
        $side_5_remake=[
          'no'=>addNULL(!empty($request->side_5_remake['no'])),
          'nosee'=>addNULL(!empty($request->side_5_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->side_5_remake['detail']),$request->side_5_remake['detail']),
        ];
        $floor_6_remake=[
          'no'=>addNULL(!empty($request->floor_6_remake['no'])),
          'nosee'=>addNULL(!empty($request->floor_6_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->floor_6_remake['detail']),$request->floor_6_remake['detail']),
        ];
        $side_6_remake=[
          'no'=>addNULL(!empty($request->side_6_remake['no'])),
          'nosee'=>addNULL(!empty($request->side_6_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->side_6_remake['detail']),$request->side_6_remake['detail']),
        ];
        $gate_6_remake=[
          'no'=>addNULL(!empty($request->gate_6_remake['no'])),
          'nosee'=>addNULL(!empty($request->gate_6_remake['nosee'])),
          'detail'=>addNULL1(!empty($request->gate_6_remake['detail']),$request->gate_6_remake['detail']),
        ];

      /////--------weir_surveys-------------/////////
      $river=River::where('river_id',$request->river_id)->update(
        [
          'river_id'=>$request->river_id,
          'river_name'=>$request->river_name,
          'river_branch'=>$request->river_branch,
          'river_type'=>$request->river_type
        ]
      );

      /////--------weir_Location-------------/////////
      // dd($request->weir_location_id);
      $location= WeirLocation::where('weir_location_id',$request->weir_location_id)->update(
        [
          'weir_location_id'=>$request->weir_location_id,
          'utm'=> json_encode($request->weir_UTM),
          'latlong'=>json_encode($request->weir_latlog),
          'weir_village'=>$request->weir_village,
          'weir_tumbol'=>$request->weir_tumbol,
          'weir_district'=>$request->weir_district,
          'weir_province'=>"ลำปาง", 
        ]
      );
      // dd($request->weir_spec_id);
      /////--------weir_spaceifications-------------/////////
      $space_weir= WeirSpaceification::where('weir_spec_id',$request->weir_spec_id)->update(
        [
          'weir_spec_id'=>$request->weir_spec_id,
          'ridge_type'=>json_encode($request->ridge_type, JSON_UNESCAPED_UNICODE),
          'ridge_height'=>$request->ridge_height,
          'ridge_width'=>$request->ridge_width,
          'gate_has'=>$request->gate_has,
          'gate_type'=>$request->gate_type,
          'gate_dimension'=>json_encode($request->gate_dimension, JSON_UNESCAPED_UNICODE),
          'gate_machanic_has'=>$request->gate_machanic_has,
          'gate_machanic_type'=>$request->gate_machanic_type,
          'control_building_has'=>$request->control_building_has,
          'control_building_type'=>json_encode($control_building_type, JSON_UNESCAPED_UNICODE),
          'conttrol_building_loc'=>json_encode($building_loc, JSON_UNESCAPED_UNICODE), 
          'control_building_gate_has'=>$request->control_building_gate_has,
          'control_building_gate_type'=>$request->control_building_gate_type,
          'control_building_gate_dimension'=>json_encode($request->control_building_gate_dimension, JSON_UNESCAPED_UNICODE),
          'control_building_machanic_type'=>$request->control_building_machanic_type,
          'canal_has'=>$request->canal_has,
          'canal_type'=>$request->canal_type,
          'canel_dimension'=>json_encode($request->canel_dimension, JSON_UNESCAPED_UNICODE),
          'benefit_area'=>$request->benefit_area,
          'comsumption'=>$request->comsumption,
          'agriculture'=>$request->agriculture,
        ]
      );
      // dd($request);
      ///////--------MaintenanceLog------------********Must be loop***************-/////////
      for($m=1;$m<6;$m++){
          $maintain_id="maintain_id_r".$m;
          $date="maintain_date_r".$m;
          $detail="maintain_detail_r".$m;
          $resp="maintain_resp_r".$m;
          $remake="maintain_remark_r".$m;
          if($request->$date!=NULL){
            $maintence=Maintenance::where('maintain_id',$request->maintain_id)->update(
              [
                'maintain_id'=>$request->$maintain_id,
                'weir_id'=>$request->weir_id ,
                'maintain_date'=>$request->$date,
                'maintain_detail'=>$request->$detail,
                'maintain_resp'=>$request->$resp,
                'maintain_remark'=>$request->$remake,
              ]
            );
          }
      }

      // dd($request);
      if($request->resp_name1!=NULL||$request->resp_name2!=NULL||$request->resp_name3!=NULL){
            if($request->resp_name1!=NULL){
              $resp_name = $request->resp_name1;
            }else if($request->resp_name2!=NULL){
              $resp_name = $request->resp_name2;
            }else{
              $resp_name = $request->resp_name3;
            }
      }else{
        $resp_name =NULL;
      }
      // dd($resp_name);
        
      // /////--------weir_surveys-------------/////////
      $weir= WeirSurvey::where('weir_id',$request->weir_id)->update(
        [
          'weir_id'=>$request->weir_id,
          'weir_code'=>$request->weir_code,
          'weir_name'=>$request->weir_name,
          'river_id'=>$request->river_id,
          'weir_spec_id'=>$request->weir_spec_id,
          'weir_location_id'=>$request->weir_location_id,
          'weir_build'=>$request->weir_year,
          'weir_age'=>$request->weir_age,
          'weir_model'=>json_encode($model, JSON_UNESCAPED_UNICODE),
          'Resp_type'=>$request->resp_type,
          'resp_name'=>$resp_name,
          'transfer'=>$request->transfer,
          'user'=>$name,
          'survey_name'=>$request->survey_name,
          'survey_date'=>$request->survey_date,
          'survey_position'=>$request->survey_position,
          'survey_unit'=>$request->survey_unit,
        ]
      );
      ///////----1----upprotection_invs-------------/////////
      $upprotection= UpprotectionInv::where('weir_id',$request->weir_id)->update(
        [
          'weir_id'=>$request->weir_id,          
          'floor_erosion'=>$request->floor_1_erosion,
          'floor_subsidence'=>$request->floor_1_subsidence,
          'floor_cracking'=>$request->floor_1_cracking,
          'floor_obstruction'=>$request->floor_1_obstruction,
          'floor_hole'=>$request->floor_1_hole,
          'floor_leak'=>$request->floor_1_leak,
          'floor_movement'=>$request->floor_1_movement,
          'floor_drainage'=>$request->floor_1_drainage,
          'floor_weed'=>$request->floor_1_weed,
          'floor_damage'=>$request->floor_1_damage,
          'floor_remake'=>json_encode($floor_1_remake, JSON_UNESCAPED_UNICODE),
          'check_floor'=>$request->check_floor_1,
          'side_erosion'=>$request->side_1_erosion,
          'side_subsidence'=>$request->side_1_subsidence,
          'side_cracking'=>$request->side_1_cracking,
          'side_obstruction'=>$request->side_1_obstruction,
          'side_hole'=>$request->side_1_hole,
          'side_leak'=>$request->side_1_leak,
          'side_movement'=>$request->side_1_movement,
          'side_drainage'=>$request->side_1_drainage,
          'side_weed'=>$request->side_1_weed,
          'side_damage'=>$request->side_1_damage,
          'side_remake'=>json_encode($side_1_remake, JSON_UNESCAPED_UNICODE),
          'section_status'=>$request->Upstream,
        ]
      );

      ///////----2----upconcrete_invs-------------/////////
      $upconcrete= UpconcreteInv::where('weir_id',$request->weir_id)->update(
        [
          'weir_id'=>$request->weir_id,  
          'floor_erosion'=>$request->floor_2_erosion,
          'floor_subsidence'=>$request->floor_2_subsidence,
          'floor_cracking'=>$request->floor_2_cracking,
          'floor_obstruction'=>$request->floor_2_obstruction,
          'floor_hole'=>$request->floor_2_hole,
          'floor_leak'=>$request->floor_2_leak,
          'floor_movement'=>$request->floor_2_movement,
          'floor_drainage'=>$request->floor_2_damage,
          'floor_weed'=>$request->floor_2_weed,
          'floor_damage'=>$request->floor_2_damage,
          'floor_remake'=>json_encode($floor_2_remake, JSON_UNESCAPED_UNICODE),
          'check_floor'=>$request->check_floor_2,
          'side_erosion'=>$request->side_2_erosion,
          'side_subsidence'=>$request->side_2_subsidence,
          'side_cracking'=>$request->side_2_cracking,
          'side_obstruction'=>$request->side_2_obstruction,
          'side_hole'=>$request->side_2_hole,
          'side_leak'=>$request->side_2_leak,
          'side_movement'=>$request->side_2_movement,
          'side_drainage'=>$request->side_2_drainage,
          'side_weed'=>$request->side_2_weed,
          'side_damage'=>$request->side_2_damage,
          'side_remake'=>json_encode($side_2_remake, JSON_UNESCAPED_UNICODE),
          'section_status'=>$request->Upstream_Concrete,
        ]
      );
      
      ///////----3----control_invs-------------/////////
      $control=ControlInv::where('weir_id',$request->weir_id)->update(
        [
          'weir_id'=>$request->weir_id,
          'waterctrl_erosion'=>$request->waterctrl_3_erosion,
          'waterctrl_subsidence'=>$request->waterctrl_3_subsidence,
          'waterctrl_cracking'=>$request->waterctrl_3_cracking,
          'waterctrl_obstruction'=>$request->waterctrl_3_obstruction,
          'waterctrl_hole'=>$request->waterctrl_3_hole,
          'waterctrl_leak'=>$request->waterctrl_3_leak,
          'waterctrl_movement'=>$request->waterctrl_3_movement,
          'waterctrl_drainage'=>$request->waterctrl_3_drainage,
          'waterctrl_weed'=>$request->waterctrl_3_weed,
          'waterctrl_damage'=>$request->waterctrl_3_damage,
          'waterctrl_remake'=>json_encode($waterctrl_3_remake, JSON_UNESCAPED_UNICODE),

          'sidewall_erosion'=>$request->sidewall_3_erosion,
          'sidewall_subsidence'=>$request->sidewall_3_subsidence,
          'sidewall_cracking'=>$request->sidewall_3_cracking,
          'sidewall_obstruction'=>$request->sidewall_3_obstruction,
          'sidewall_hole'=>$request->sidewall_3_hole,
          'sidewall_leak'=>$request->sidewall_3_leak,
          'sidewall_movement'=>$request->sidewall_3_movement,
          'sidewall_drainage'=>$request->sidewall_3_drainage,
          'sidewall_weed'=>$request->sidewall_3_weed,
          'sidewall_damage'=>$request->sidewall_3_damage,
          'sidewall_remake'=>json_encode($sidewall_3_remake, JSON_UNESCAPED_UNICODE),

          'dgfloor_erosion'=>$request->dgfloor_3_erosion,
          'dgfloor_subsidence'=>$request->dgfloor_3_subsidence,
          'dgfloor_cracking'=>$request->dgfloor_3_cracking,
          'dgfloor_obstruction'=>$request->dgfloor_3_obstruction,
          'dgfloor_hole'=>$request->dgfloor_3_hole,
          'dgfloor_leak'=>$request->dgfloor_3_leak,
          'dgfloor_movement'=>$request->dgfloor_3_movement,
          'dgfloor_drainage'=>$request->dgfloor_3_drainage,
          'dgfloor_weed'=>$request->dgfloor_3_weed,
          'dgfloor_damage'=>$request->dgfloor_3_damage,
          'dgfloor_remake'=>json_encode($dgfloor_3_remake, JSON_UNESCAPED_UNICODE),

          'dgwall_erosion'=>$request->dgwall_3_erosion,
          'dgwall_subsidence'=>$request->dgwall_3_subsidence,
          'dgwall_cracking'=>$request->dgwall_3_cracking,
          'dgwall_obstruction'=>$request->dgwall_3_obstruction,
          'dgwall_hole'=>$request->dgwall_3_hole,
          'dgwall_leak'=>$request->dgwall_3_leak,
          'dgwall_movement'=>$request->dgwall_3_movement,
          'dgwall_drainage'=>$request->dgwall_3_drainage,
          'dgwall_weed'=>$request->dgwall_3_weed,
          'dgwall_damage'=>$request->dgwall_3_damage,
          'dgwall_remake'=>json_encode($dgwall_3_remake, JSON_UNESCAPED_UNICODE),

          'dggate_erosion'=>$request->dggate_3_erosion,
          'dggate_subsidence'=>$request->dggate_3_subsidence,
          'dggate_cracking'=>$request->dggate_3_cracking,
          'dggate_obstruction'=>$request->dggate_3_obstruction,
          'dggate_hole'=>$request->dggate_3_hole,
          'dggate_leak'=>$request->dggate_3_leak,
          'dggate_movement'=>$request->dggate_3_movement,
          'dggate_drainage'=>$request->dggate_3_drainage,
          'dggate_weed'=>$request->dggate_3_weed,
          'dggate_damage'=>$request->dggate_3_damage,
          'dggate_remake'=>json_encode($dggate_3_remake, JSON_UNESCAPED_UNICODE),

          'dgmachanic_erosion'=>$request->dgmachanic_3_erosion,
          'dgmachanic_subsidence'=>$request->dgmachanic_3_subsidence,
          'dgmachanic_cracking'=>$request->dgmachanic_3_cracking,
          'dgmachanic_obstruction'=>$request->dgmachanic_3_obstruction,
          'dgmachanic_hole'=>$request->dgmachanic_3_hole,
          'dgmachanic_leak'=>$request->dgmachanic_3_leak,
          'dgmachanic_movement'=>$request->dgmachanic_3_movement,
          'dgmachanic_drainage'=>$request->dgmachanic_3_drainage,
          'dgmachanic_weed'=>$request->dgmachanic_3_weed,
          'dgmachanic_damage'=>$request->dgmachanic_3_damage,
          'dgmachanic_remake'=>json_encode($dgmachanic_3_remake, JSON_UNESCAPED_UNICODE),

          'dgblock_erosion'=>$request->dgblock_3_erosion,
          'dgblock_subsidence'=>$request->dgblock_3_subsidence,
          'dgblock_cracking'=>$request->dgblock_3_cracking,
          'dgblock_obstruction'=>$request->dgblock_3_obstruction,
          'dgblock_hole'=>$request->dgblock_3_hole,
          'dgblock_leak'=>$request->dgblock_3_leak,
          'dgblock_movement'=>$request->dgblock_3_movement,
          'dgblock_drainage'=>$request->dgblock_3_drainage,
          'dgblock_weed'=>$request->dgblock_3_weed,
          'dgblock_damage'=>$request->dgblock_3_damage,
          'dgblock_remake'=>json_encode($dgblock_3_remake, JSON_UNESCAPED_UNICODE),

          'waterbreak_erosion'=>$request->waterbreak_3_erosion,
          'waterbreak_subsidence'=>$request->waterbreak_3_subsidence,
          'waterbreak_cracking'=>$request->waterbreak_3_cracking,
          'waterbreak_obstruction'=>$request->waterbreak_3_obstruction,
          'waterbreak_hole'=>$request->waterbreak_3_hole,
          'waterbreak_leak'=>$request->waterbreak_3_leak,
          'waterbreak_movement'=>$request->waterbreak_3_movement,
          'waterbreak_drainage'=>$request->waterbreak_3_drainage,
          'waterbreak_weed'=>$request->waterbreak_3_weed,
          'waterbreak_damage'=>$request->waterbreak_3_damage,
          'waterbreak_remake'=>json_encode($waterbreak_3_remake, JSON_UNESCAPED_UNICODE),

          'bridge_erosion'=>$request->bridge_3_erosion,
          'bridge_subsidence'=>$request->bridge_3_subsidence,
          'bridge_cracking'=>$request->bridge_3_cracking,
          'bridge_obstruction'=>$request->bridge_3_obstruction,
          'bridge_hole'=>$request->bridge_3_hole,
          'bridge_leak'=>$request->bridge_3_leak,
          'bridge_movement'=>$request->bridge_3_movement,
          'bridge_drainage'=>$request->bridge_3_drainage,
          'bridge_weed'=>$request->bridge_3_weed,
          'bridge_damage'=>$request->bridge_3_damage,
          'bridge_remake'=>json_encode($bridge_3_remake, JSON_UNESCAPED_UNICODE),
          
          'section_status'=>$request->Control,
          'check_floor'=>$request->check_floor_3,

        ]
      );

      ///////---4-----downconcrete_invs-------------/////////
      $downconcrete=DownconcreteInv::where('weir_id',$request->weir_id)->update(
        [
          'weir_id'=>$request->weir_id,
          'floor_erosion'=>$request->floor_4_erosion,
          'floor_subsidence'=>$request->floor_4_subsidence,
          'floor_cracking'=>$request->floor_4_cracking,
          'floor_obstruction'=>$request->floor_4_obstruction,
          'floor_hole'=>$request->floor_4_hole,
          'floor_leak'=>$request->floor_4_leak,
          'floor_movement'=>$request->floor_4_movement,
          'floor_drainage'=>$request->floor_4_drainage,
          'floor_weed'=>$request->floor_4_weed,
          'floor_damage'=>$request->floor_4_damage,
          'floor_remake'=>json_encode($floor_4_remake, JSON_UNESCAPED_UNICODE),
          'check_floor'=>$request->check_floor_4,

          'side_erosion'=>$request->side_4_erosion,
          'side_subsidence'=>$request->side_4_subsidence,
          'side_cracking'=>$request->side_4_cracking,
          'side_obstruction'=>$request->side_4_obstruction,
          'side_hole'=>$request->side_4_hole,
          'side_leak'=>$request->side_4_leak,
          'side_movement'=>$request->side_4_movement,
          'side_drainage'=>$request->side_4_drainage,
          'side_weed'=>$request->side_4_weed,
          'side_damage'=>$request->side_4_damage,
          'side_remake'=>json_encode($side_4_remake, JSON_UNESCAPED_UNICODE),

          'flrblock_erosion'=>$request->flrblock_4_erosion,
          'flrblock_subsidence'=>$request->flrblock_4_subsidence,
          'flrblock_cracking'=>$request->flrblock_4_cracking,
          'flrblock_obstruction'=>$request->flrblock_4_obstruction,
          'flrblock_hole'=>$request->flrblock_4_hole,
          'flrblock_leak'=>$request->flrblock_4_leak,
          'flrblock_movement'=>$request->flrblock_4_movement,
          'flrblock_drainage'=>$request->flrblock_4_drainage,
          'flrblock_weed'=>$request->flrblock_4_weed,
          'flrblock_damage'=>$request->flrblock_4_damage,
          'flrblock_remake'=>json_encode($flrblock_4_remake, JSON_UNESCAPED_UNICODE),

          'endsill_erosion'=>$request->endsill_4_erosion,
          'endsill_subsidence'=>$request->endsill_4_subsidence,
          'endsill_cracking'=>$request->endsill_4_cracking,
          'endsill_obstruction'=>$request->endsill_4_obstruction,
          'endsill_hole'=>$request->endsill_4_hole,
          'endsill_leak'=>$request->endsill_4_leak,
          'endsill_movement'=>$request->endsill_4_movement,
          'endsill_drainage'=>$request->endsill_4_drainage,
          'endsill_weed'=>$request->endsill_4_weed,
          'endsill_damage'=>$request->endsill_4_damage,
          'endsill_remake'=>json_encode($endsill_4_remake, JSON_UNESCAPED_UNICODE),
          'section_status'=>$request->Downstream_Concrete,
        ]
      );

      ///////----5----downprotection_invs-------------/////////
      $downprotection=DownprotectionInv::where('weir_id',$request->weir_id)->update(
        [
          'weir_id'=>$request->weir_id,

          'floor_erosion'=>$request->floor_5_erosion,
          'floor_subsidence'=>$request->floor_5_subsidence,
          'floor_cracking'=>$request->floor_5_cracking,
          'floor_obstruction'=>$request->floor_5_obstruction,
          'floor_hole'=>$request->floor_5_hole,
          'floor_leak'=>$request->floor_5_leak,
          'floor_movement'=>$request->floor_5_movement,
          'floor_drainage'=>$request->floor_5_drainage,
          'floor_weed'=>$request->floor_5_weed,
          'floor_damage'=>$request->floor_5_damage,
          'floor_remake'=>json_encode($floor_5_remake, JSON_UNESCAPED_UNICODE),
          'check_floor'=>$request->check_floor_5,

          'side_erosion'=>$request->side_5_erosion,
          'side_subsidence'=>$request->side_5_subsidence,
          'side_cracking'=>$request->side_5_cracking,
          'side_obstruction'=>$request->side_5_obstruction,
          'side_hole'=>$request->side_5_hole,
          'side_leak'=>$request->side_5_leak,
          'side_movement'=>$request->side_5_movement,
          'side_drainage'=>$request->side_5_drainage,
          'side_weed'=>$request->side_5_weed,
          'side_damage'=>$request->side_5_damage,
          'side_remake'=>json_encode($side_5_remake, JSON_UNESCAPED_UNICODE),
          
          'section_status'=>$request->Downstream_Protection,
        ]
      );

      ///////----6----waterdelivery_invs-------------/////////
      $water=WaterdeliveryInv::where('weir_id',$request->weir_id)->update(
        [
          'weir_id'=>$request->weir_id,

          'floor_erosion'=>$request->floor_6_erosion,
          'floor_subsidence'=>$request->floor_6_subsidence,
          'floor_cracking'=>$request->floor_6_cracking,
          'floor_obstruction'=>$request->floor_6_obstruction,
          'floor_hole'=>$request->floor_6_hole,
          'floor_leak'=>$request->floor_6_leak,
          'floor_movement'=>$request->floor_6_movement,
          'floor_drainage'=>$request->floor_6_drainage,
          'floor_weed'=>$request->floor_6_weed,
          'floor_damage'=>$request->floor_6_damage,
          'floor_remake'=>json_encode($floor_6_remake, JSON_UNESCAPED_UNICODE),
          'check_floor'=>$request->check_floor_6,

          'side_erosion'=>$request->side_6_erosion,
          'side_subsidence'=>$request->side_6_subsidence,
          'side_cracking'=>$request->side_6_cracking,
          'side_obstruction'=>$request->side_6_obstruction,
          'side_hole'=>$request->side_6_hole,
          'side_leak'=>$request->side_6_leak,
          'side_movement'=>$request->side_6_movement,
          'side_drainage'=>$request->side_6_drainage,
          'side_weed'=>$request->side_6_weed,
          'side_damage'=>$request->side_6_damage,
          'side_remake'=>json_encode($side_6_remake, JSON_UNESCAPED_UNICODE),

          'gate_erosion'=>$request->gate_6_erosion,
          'gate_subsidence'=>$request->gate_6_subsidence,
          'gate_cracking'=>$request->gate_6_cracking,
          'gate_obstruction'=>$request->gate_6_obstruction,
          'gate_hole'=>$request->gate_6_hole,
          'gate_leak'=>$request->gate_6_leak,
          'gate_movement'=>$request->gate_6_movement,
          'gate_drainage'=>$request->gate_6_drainage,
          'gate_weed'=>$request->gate_6_weed,
          'gate_damage'=>$request->gate_6_damage,
          'gate_remake'=>json_encode($gate_6_remake, JSON_UNESCAPED_UNICODE),
          
          'section_status'=>$request->water_system,
        ]
      );
      // /////--------improvement_plans-------------/////////
      $plan= ImprovementPlan::where('weir_id',$request->weir_id)->update(
        [
          // 'plan_id'=>$request->plan_id,
          'weir_id'=>$request->weir_id,
          'plan_year_check'=>$request->plan_year_check,
          'plan_year'=>$request->plan_year,
          'plan_type'=>$request->plan_type,
          'plan_budget'=>$request->plan_budget,
          'proj_budget_check'=>$request->proj_budget_check,
          'proj_budget'=>$request->proj_budget_check,
          'proj_type'=>$request->proj_type,
          'plan_improve'=>$request->plan_improve,
          'plan_no'=>$request->plan_no,
        ]
      );

      // /////--------additinal_suggestions-------------/////////
      $plan= AdditinalSuggestion::where('weir_id',$request->weir_id)->update(
        [
          // 'suggest_id'=>$suggest_id,
          'weir_id'=>$request->weir_id,
          'suggestion'=>$request->suggustion
        ]
      );
      // dd();
      $log=new EditLog(
        [ 
           'weir_id'=>$request->weir_id,
           'user'=>$name,
           'status'=>"edit"

        ]);
        $log->save();
      return redirect()->route("list");
    


    }


    public function formDelete($id, User $user){
      // dd($id);
      $name=Auth::user()->name ;
      $weir_code=$id;
      $weir = DB::table('weir_surveys')->where('weir_code',$weir_code)->get();
      $weir_id=$weir[0]->weir_id;
      $river_id =$weir[0]->river_id;
      $weir_spec_id = $weir[0]->weir_spec_id;
      $weir_location_id =$weir[0]->weir_location_id; 
      // delete
      DB::table('weir_surveys')->where('weir_id',$weir[0]->weir_id)->delete(); 
      DB::table('rivers')->where('river_id',$river_id)->delete(); 
      DB::table('weir_spaceifications')->where('weir_spec_id',$weir_spec_id)->delete(); 
      DB::table('weir_locations')->where('weir_location_id',$weir_location_id)->delete(); 
      DB::table('maintenances')->where('weir_id',$weir_id)->delete(); 
      DB::table('improvement_plans')->where('weir_id',$weir_id)->delete(); 
      DB::table('additinal_suggestions')->where('weir_id',$weir_id)->delete(); 

      DB::table('upprotection_invs')->where('weir_id',$weir_id)->delete(); 
      DB::table('upconcrete_invs')->where('weir_id',$weir_id)->delete(); 
      DB::table('control_invs')->where('weir_id',$weir_id)->delete(); 
      DB::table('downconcrete_invs')->where('weir_id',$weir_id)->delete(); 
      DB::table('downprotection_invs')->where('weir_id',$weir_id)->delete(); 
      DB::table('waterdelivery_invs')->where('weir_id',$weir_id)->delete(); 

      DB::table('photos')->where('weir_id',$weir_id)->delete(); 
      $log=new EditLog(
        [ 
           'weir_id'=>$weir_id,
           'user'=>$name,
           'status'=>"delete"

        ]);
        $log->save();
      return redirect()->route("list");
    





    }

    public function photoSubmit(Request $request, User $user){
      // dd($request);

      $weir = DB::table('weir_surveys')->where('weir_code',$request->weir_code)->get();
      $weir_id=$weir[0]->weir_id;
      $codeweir = $request->weir_code;

      function calCodePH($users,$text) {
        // dd($users);
        if($users== NULL ||$users==0 ){
            return ("01");
        }else{
          $num=$text+1;
          if($num<10){
            return ("0".$num);
          }else{
            return ($num);
          }
        }
      }
      //////------ Upload photo  -----------------------//////
          //1 **************** check if image photo_type_bld **********************//
            if ($request->hasFile('upstream_protection')) {
              $images = $request->file('upstream_protection');
              $org_img = $thm_img = true;
              
              if( ! File::exists('images/originals/')) { $org_img = File::makeDirectory('images/originals/', 0777, true);}
              if ( ! File::exists('images/thumbnails/')) { $thm_img = File::makeDirectory('images/thumbnails', 0777, true);}
          
              foreach($images as $key => $image) {
                  $photo= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->count();
                  $photo_last= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->get()->last();
                  if($photo_last==NULL){
                    $last=0;
                    $photo_id=$codeweir."-".calCodePH($photo,0);
                  }else{
                    $last=explode("-",$photo_last->photo_id);
                    $photo_id=$codeweir."-".calCodePH($photo,$last[1]);
                  }
                  

                  
                  $filename = $photo_id.'.'.$image->getClientOriginalExtension();
                  //path of image for upload
                  $org_path = 'images/originals/' . $filename;
                  $thm_path = 'images/thumbnails/' . $filename;

                  // upload image to server
                  if (($org_img && $thm_img) == true) {
                      Image::make($image)->fit(900, 500, function ($constraint) {
                              $constraint->upsize();
                          })->save($org_path);
                      Image::make($image)->fit(270, 160, function ($constraint) {
                          $constraint->upsize();
                      })->save($thm_path);
                  }
                  // dd($photo_id);
                  $loc1 = new Photo(
                      [
                          'photo_id'=> $photo_id,
                          'weir_id'=>$weir_id,
                          'photo_type'=>'ส่วน Protection เหนือน้ำ',
                          'photo_filename'=>$org_path,
                          'thumbnall_filename'=>$thm_path
                      ]
                  );
                  $loc1->save();
              }
            }

          //2 **************** check if image upstream_concrete **********************//
            if ($request->hasFile('upstream_concrete')) {
              $images = $request->file('upstream_concrete');
              $org_img = $thm_img = true;
              if( ! File::exists('images/originals/')) { $org_img = File::makeDirectory('images/originals/', 0777, true);}
              if ( ! File::exists('images/thumbnails/')) { $thm_img = File::makeDirectory('images/thumbnails', 0777, true);}
              // loop through each image to save and upload
              foreach($images as $key => $image) {
                  $photo= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->count();
                  $photo_last= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->get()->last();
                  if($photo_last==NULL){
                    $last=0;
                    $photo_id=$codeweir."-".calCodePH($photo,0);
                  }else{
                    $last=explode("-",$photo_last->photo_id);
                    $photo_id=$codeweir."-".calCodePH($photo,(int)$last[1]);
                  }

                  $filename = $photo_id.'.'.$image->getClientOriginalExtension();
                  //path of image for upload
                  $org_path = 'images/originals/' . $filename;
                  $thm_path = 'images/thumbnails/' . $filename;

                  // upload image to server
                  if (($org_img && $thm_img) == true) {
                      Image::make($image)->fit(900, 500, function ($constraint) {
                              $constraint->upsize();
                          })->save($org_path);
                      Image::make($image)->fit(270, 160, function ($constraint) {
                          $constraint->upsize();
                      })->save($thm_path);
                  }
                  // dd($photo_id);
                  $loc2 = new Photo(
                      [
                          'photo_id'=> $photo_id,
                          'weir_id'=>$weir_id,
                          'photo_type'=>'ส่วนเหนือน้ำ',
                          'photo_filename'=>$org_path,
                          'thumbnall_filename'=>$thm_path
                          
                      ]
                  );
                  $loc2->save();
              }
            }
          //3 **************** check if image Control **********************//
            if ($request->hasFile('control')) {
              $images = $request->file('control');
              $org_img = $thm_img = true;
              if( ! File::exists('images/originals/')) { $org_img = File::makeDirectory('images/originals/', 0777, true);}
              if ( ! File::exists('images/thumbnails/')) { $thm_img = File::makeDirectory('images/thumbnails', 0777, true);}
              // loop through each image to save and upload
              foreach($images as $key => $image) {
                  $photo= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->count();
                  $photo_last= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->get()->last();
                  if($photo_last==NULL){
                    $last=0;
                    $photo_id=$codeweir."-".calCodePH($photo,0);
                  }else{
                    $last=explode("-",$photo_last->photo_id);
                    $photo_id=$codeweir."-".calCodePH($photo,(int)$last[1]);
                  }

                  

                  $filename = $photo_id.'.'.$image->getClientOriginalExtension();
                  //path of image for upload
                  $org_path = 'images/originals/' . $filename;
                  $thm_path = 'images/thumbnails/' . $filename;

                  // upload image to server
                  if (($org_img && $thm_img) == true) {
                      Image::make($image)->fit(900, 500, function ($constraint) {
                              $constraint->upsize();
                          })->save($org_path);
                      Image::make($image)->fit(270, 160, function ($constraint) {
                          $constraint->upsize();
                      })->save($thm_path);
                  }
                  
                  $loc3 = new Photo(
                      [
                          'photo_id'=> $photo_id,
                          'weir_id'=>$weir_id,
                          'photo_type'=>'ส่วนควบคุม',
                          'photo_filename'=>$org_path,
                          'thumbnall_filename'=>$thm_path
                          
                      ]
                  );
                  $loc3->save();
              }
            }
          //4 **************** check if image Downstream Concrete **********************//
            if ($request->hasFile('downstream_concrete')) {
              $images = $request->file('downstream_concrete');
              $org_img = $thm_img = true;
              if( ! File::exists('images/originals/')) { $org_img = File::makeDirectory('images/originals/', 0777, true);}
              if ( ! File::exists('images/thumbnails/')) { $thm_img = File::makeDirectory('images/thumbnails', 0777, true);}
              // loop through each image to save and upload
              foreach($images as $key => $image) {
                  $photo= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->count();;
                  $photo_last= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->get()->last();
                  if($photo_last==NULL){
                    $last=0;
                    $photo_id=$codeweir."-".calCodePH($photo,0);
                  }else{
                    $last=explode("-",$photo_last->photo_id);
                    $photo_id=$codeweir."-".calCodePH($photo,(int)$last[1]);
                  }

                  $filename = $photo_id.'.'.$image->getClientOriginalExtension();
                  //path of image for upload
                  $org_path = 'images/originals/' . $filename;
                  $thm_path = 'images/thumbnails/' . $filename;

                  // upload image to server
                  if (($org_img && $thm_img) == true) {
                      Image::make($image)->fit(900, 500, function ($constraint) {
                              $constraint->upsize();
                          })->save($org_path);
                      Image::make($image)->fit(270, 160, function ($constraint) {
                          $constraint->upsize();
                      })->save($thm_path);
                  }
                  
                  $loc4 = new Photo(
                      [
                          'photo_id'=> $photo_id,
                          'weir_id'=>$weir_id,
                          'photo_type'=>'ส่วนท้ายน้ำ',
                          'photo_filename'=>$org_path,
                          'thumbnall_filename'=>$thm_path
                          
                      ]
                  );
                  $loc4->save();
              }
            }
          //5 **************** check if image Downstream Protection **********************//
            if ($request->hasFile('downstream_protection')) {
              $images = $request->file('downstream_protection');
              $org_img = $thm_img = true;
              if( ! File::exists('images/originals/')) { $org_img = File::makeDirectory('images/originals/', 0777, true);}
              if ( ! File::exists('images/thumbnails/')) { $thm_img = File::makeDirectory('images/thumbnails', 0777, true);}
              // loop through each image to save and upload
              foreach($images as $key => $image) {
                  $photo= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->count();
                  $photo_last= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->get()->last();
                  $photo_last= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->get()->last();
                  if($photo_last==NULL){
                    $last=0;
                    $photo_id=$codeweir."-".calCodePH($photo,0);
                  }else{
                    $last=explode("-",$photo_last->photo_id);
                    $photo_id=$codeweir."-".calCodePH($photo,(int)$last[1]);
                  }

                  $filename = $photo_id.'.'.$image->getClientOriginalExtension();
                  //path of image for upload
                  $org_path = 'images/originals/' . $filename;
                  $thm_path = 'images/thumbnails/' . $filename;

                  // upload image to server
                  if (($org_img && $thm_img) == true) {
                      Image::make($image)->fit(900, 500, function ($constraint) {
                              $constraint->upsize();
                          })->save($org_path);
                      Image::make($image)->fit(270, 160, function ($constraint) {
                          $constraint->upsize();
                      })->save($thm_path);
                  }
                  
                  $loc5 = new Photo(
                      [
                          'photo_id'=> $photo_id,
                          'weir_id'=>$weir_id,
                          'photo_type'=>'ส่วน Protection ท้ายน้ำ ',
                          'photo_filename'=>$org_path,
                          'thumbnall_filename'=>$thm_path
                          
                      ]
                  );
                  $loc5->save();
              }
            }
          //6 **************** check if image water System **********************//
            if ($request->hasFile('water_system')) {
              $images = $request->file('water_system');
              $org_img = $thm_img = true;
              if( ! File::exists('images/originals/')) { $org_img = File::makeDirectory('images/originals/', 0777, true);}
              if ( ! File::exists('images/thumbnails/')) { $thm_img = File::makeDirectory('images/thumbnails', 0777, true);}
              // loop through each image to save and upload
              foreach($images as $key => $image) {
                  $photo= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->count();;
                  $photo_last= DB::table('photos')->select('photo_id')->where('weir_id', $weir_id)->orderBy('created_at', 'asc')->get()->last();
                  if($photo_last==NULL){
                    $photo_id=$codeweir."-".calCodePH($photo,0);
                  }else{
                    $last=explode("-",$photo_last->photo_id);
                    $photo_id=$codeweir."-".calCodePH($photo,(int)$last[1]);
                  }
                  $filename = $photo_id.'.'.$image->getClientOriginalExtension();
                  //path of image for upload
                  $org_path = 'images/originals/' . $filename;
                  $thm_path = 'images/thumbnails/' . $filename;

                  // upload image to server
                  if (($org_img && $thm_img) == true) {
                      Image::make($image)->fit(900, 500, function ($constraint) {
                              $constraint->upsize();
                          })->save($org_path);
                      Image::make($image)->fit(270, 160, function ($constraint) {
                          $constraint->upsize();
                      })->save($thm_path);
                  }
                  
                  $loc6 = new Photo(
                      [
                          'photo_id'=> $photo_id,
                          'weir_id'=>$weir_id,
                          'photo_type'=>'ระบบส่งน้ำ',
                          'photo_filename'=>$org_path,
                          'thumbnall_filename'=>$thm_path
                          
                      ]
                  );
                  $loc6->save();
              }
            }
          return redirect()->route('addphoto', ['id' => $codeweir]);

      
      

    }


    public function formexpert(Request $request, User $user){
      // dd($request);
      // $name=Auth::user()->name ;
      $weir = WeirSurvey::select('weir_id')->where('weir_code',$request->weir_code)->get();
      // dd($weir[0]->weir_id);
      $exp = DB::table('weir_experts')->select('*')->where('weir_id', $weir[0]->weir_id)->get()->last();
      // dd($exp->id);
      
      // //// -------- Weir Catchment ------------------/////
      $catch = DB::table('weir_catchments')->select('*')->where('weir_id', $weir[0]->weir_id)->get()->last();
      $catchmant= WeirCatchment::where('id',$catch->id)->update(
        [
          'area'=>$request->expert_A, 
          'L'=>$request->expert_L, 
          'LC'=>$request->expert_LC,
          'H'=>$request->expert_H, 
          'S'=>$request->expert_S, 
          'c'=>$request->expert_C, 
          'I'=>$request->expert_I, 
          'Return_period'=>$request->expert_Returnperiod, 
          'flow'=>$request->expert_rate,
        ]
      );
      // dd($request);
      if($request->improve_type==0){
        $improve=new Impovement(
            [
              'weir_id'=>$weir[0]->weir_id,
              'weir_code'=>$request->weir_code,
              'weir_amp'=>$request->weir_district,
              'improve_type'=>$request->improve_type_new
            ]
          );
        $improve->save();
      }else{
        $improve=Impovement::where('weir_code',$request->weir_code)->update(
            [
              'improve_type'=>$request->improve_type_new
            ]
        );
      }
      $org_path=null;
      if ($request->hasFile('water_system')) {
              $images = $request->file('water_system');
              $org_img = true;
              if( ! File::exists('images/map/')) { $org_img = File::makeDirectory('images/map/', 0777, true);}
              // loop through each image to save and upload
              foreach($images as $key => $image) {
                  $filename = $request->weir_code.'.'.$image->getClientOriginalExtension();
                  //path of image for upload
                  $org_path = 'images/map/'. $filename;
                  Image::make($image)->fit(2000,2826, function ($constraint) {
                              $constraint->upsize();
                  })->save($org_path);
              }
      }
      
      if($exp->map==null && $org_path==null ){ $org_path=null;}
      else if($exp->map!=null && $org_path==null){ $org_path=$exp->map;}
      else{$org_path=$org_path;}
      // dd($org_path);
      $expert= WeirExpert::where('id',$exp->id)->update(
        [
          'weir_problem'=>$request->expert_problem,
          'weir_solution'=>$request->expert_solution,
          'map'=>$org_path
        ]
      );

      

      return redirect()->route("expert.list");   
    }


}
