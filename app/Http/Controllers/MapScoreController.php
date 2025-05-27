<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

class MapScoreController extends Controller
{
    public function compositionWeir($amp = 0)
    {
        // $amp=$request->amp;
        // $amp="เวียงเชียงรุ้ง";
        function level1($t)
        {
            $l = [0, 4, 3, 2, 1];
            if ($t == NULL) {
                return 0;
            } else {
                return $l[$t];
            }
        }
        function level2($t)
        {
            $l = [0, 4, 1, 2, 3];
            if ($t == NULL) {
                return 0;
            } else {
                return $l[$t];
            }
        }
        function cal_level($t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9)
        {
            $w = [0, 0.2, 0.15, 0.15, 0.005, 0.15, 0.15, 0.15, 0.005, 0.04];
            $cal[0] = 0.00000001;
            $cal[1] = $w[1] * level1($t1) + $w[2] * level1($t2) + $w[3] * level1($t3) + $w[4] * level1($t4) + $w[5] * level1($t5) + $w[6] * level1($t6) + $w[7] * level1($t7) + $w[8] * level2($t8) + $w[9] * level1($t9);
            if ($cal[1] != 0) {
                $cal[0] = 1;
            }
            return ($cal);
        }
        function score($s)
        {
            if ($s < 0.1) {
                $c = 0;
            } elseif ($s < 1.99) {
                $c = 1;
            } elseif ($s < 2.99) {
                $c = 2;
            } elseif ($s < 3.49) {
                $c = 3;
            } else {
                $c = 4;
            }
            return $c;
        }

        function calSumScore($s)
        {
            if ($s != NULL) {
                return 1;
            } else {
                return 0;
            }
        }
        function zeroCheck($t)
        {
            if ($t != NULL) {
                return $t;
            } else {
                return 0;
            }
        }

        function classSum($s)
        {
            if ($s < 0.1) {
                $c = "สภาพปานกลาง";
            } elseif ($s < 1.99) {
                $c = "สภาพทรุดโทรม";
            } elseif ($s < 2.99) {
                $c = "สภาพปานกลาง";
            } elseif ($s < 3.49) {
                $c = "สภาพค่อนข้างดี";
            } else {
                $c = "สภาพดี";
            }
            return $c;
        }

        $location = WeirLocation::select('*')->where('weir_district', $amp)->get();
        // dd(count($location));
        // for ($i=0;$i<count($location);$i++){ 
        for ($i = 0; $i < count($location); $i++) {
            $weir = WeirSurvey::select('*')->where('weir_location_id', $location[$i]->weir_location_id)->get();
            $river = River::select('river_name')->where('river_id', $weir[0]->river_id)->get();
            $latlong = json_decode($location[$i]->latlong);
            $vill = explode(" ", $location[$i]['weir_village']);
            $upprotection = UpprotectionInv::select('*')->where('weir_id', $weir[0]->weir_id)->get();
            $upconcrete = UpconcreteInv::select('*')->where('weir_id', $weir[0]->weir_id)->get();
            $control = ControlInv::select('*')->where('weir_id', $weir[0]->weir_id)->get();
            $downconcrete = DownconcreteInv::select('*')->where('weir_id', $weir[0]->weir_id)->get();
            $downprotection = DownprotectionInv::select('*')->where('weir_id', $weir[0]->weir_id)->get();
            $waterdelivery = WaterdeliveryInv::select('*')->where('weir_id', $weir[0]->weir_id)->get();
            //  Calculator about Weight score componant of weir ----------------------------
            $check_3 = 0;
            // 1.1
            $level_upprotection_1 = cal_level($upprotection[0]->floor_erosion, $upprotection[0]->floor_subsidence, $upprotection[0]->floor_cracking, $upprotection[0]->floor_obstruction, $upprotection[0]->floor_hole, $upprotection[0]->floor_leak, $upprotection[0]->floor_movement, $upprotection[0]->floor_drainage, $upprotection[0]->floor_weed);
            // 1.2
            $level_upprotection_2 = cal_level($upprotection[0]->side_erosion, $upprotection[0]->side_subsidence, $upprotection[0]->side_cracking, $upprotection[0]->side_obstruction, $upprotection[0]->side_hole, $upprotection[0]->side_leak, $upprotection[0]->side_movement, $upprotection[0]->side_drainage, $upprotection[0]->side_weed);
            // --- Avg 1 
            $damage[0] = score(($level_upprotection_1[1] + $level_upprotection_2[1]) / ($level_upprotection_1[0] + $level_upprotection_2[0]));
            $damage_score[0] = ($level_upprotection_1[1] + $level_upprotection_2[1]) / ($level_upprotection_1[0] + $level_upprotection_2[0]);

            // 2.1
            $level_upconcrete_1 = cal_level($upconcrete[0]->floor_erosion, $upconcrete[0]->floor_subsidence, $upconcrete[0]->floor_cracking, $upconcrete[0]->floor_obstruction, $upconcrete[0]->floor_hole, $upconcrete[0]->floor_leak, $upconcrete[0]->floor_movement, $upconcrete[0]->floor_drainage, $upconcrete[0]->floor_weed);
            // 2.2
            $level_upconcrete_2 = cal_level($upconcrete[0]->side_erosion, $upconcrete[0]->side_subsidence, $upconcrete[0]->side_cracking, $upconcrete[0]->side_obstruction, $upconcrete[0]->side_hole, $upconcrete[0]->side_leak, $upconcrete[0]->side_movement, $upconcrete[0]->side_drainage, $upconcrete[0]->side_weed);
            // --- Avg 2
            $damage[1] = score(($level_upconcrete_1[1] + $level_upconcrete_2[1]) / ($level_upconcrete_1[0] + $level_upconcrete_2[0]));
            $damage_score[1] = ($level_upconcrete_1[1] + $level_upconcrete_2[1]) / ($level_upconcrete_1[0] + $level_upconcrete_2[0]);
            //----- control 
            $damage[2] = 0;
            $damage_score[2] = 0;
            if (strpos($control[0]->dggate_damage, "ชำรุด") !== false || strpos($control[0]->dgmachanic_damage, "ชำรุด") !== false) {
                $damage[3] = 1;
                $damage_score[3] = 1;
                $check_3 = 1;
            } else {
                // 3.1 control
                $level_control_1 = cal_level($control[0]->waterctrl_erosion, $control[0]->waterctrl_subsidence, $control[0]->waterctrl_cracking, $control[0]->waterctrl_obstruction, $control[0]->waterctrl_hole, $control[0]->waterctrl_leak, $control[0]->waterctrl_movement, $control[0]->waterctrl_drainage, $control[0]->waterctrl_weed);
                // 3.2
                $level_control_2 = cal_level($control[0]->sidewall_erosion, $control[0]->sidewall_subsidence, $control[0]->sidewall_cracking, $control[0]->sidewall_obstruction, $control[0]->sidewall_hole, $control[0]->sidewall_leak, $control[0]->sidewall_movement, $control[0]->sidewall_drainage, $control[0]->sidewall_weed);
                // --- Avg 3

                // 3.3.1
                $level_control_3_1 = cal_level($control[0]->dgfloor_erosion, $control[0]->dgfloor_subsidence, $control[0]->dgfloor_cracking, $control[0]->dgfloor_obstruction, $control[0]->dgfloor_hole, $control[0]->dgfloor_leak, $control[0]->dgfloor_movement, $control[0]->dgfloor_drainage, $control[0]->dgfloor_weed);
                // 3.3.2
                $level_control_3_2 = cal_level($control[0]->dgwall_erosion, $control[0]->dgwall_subsidence, $control[0]->dgwall_cracking, $control[0]->dgwall_obstruction, $control[0]->dgwall_hole, $control[0]->dgwall_leak, $control[0]->dgwall_movement, $control[0]->dgwall_drainage, $control[0]->dgwall_weed);
                // 3.3.3
                $level_control_3_3 = cal_level($control[0]->dggate_erosion, $control[0]->dggate_subsidence, $control[0]->dggate_cracking, $control[0]->dggate_obstruction, $control[0]->dggate_hole, $control[0]->dggate_leak, $control[0]->dggate_movement, $control[0]->dggate_drainage, $control[0]->dggate_weed);
                // 3.3.4
                $level_control_3_4 = cal_level($control[0]->dgmachanic_erosion, $control[0]->dgmachanic_subsidence, $control[0]->dgmachanic_cracking, $control[0]->dgmachanic_obstruction, $control[0]->dgmachanic_hole, $control[0]->dgmachanic_leak, $control[0]->dgmachanic_movement, $control[0]->dgmachanic_drainage, $control[0]->dgmachanic_weed);
                // 3.4
                $level_control_4 = cal_level($control[0]->dgblock_erosion, $control[0]->dgblock_subsidence, $control[0]->dgblock_cracking, $control[0]->dgblock_obstruction, $control[0]->dgblock_hole, $control[0]->dgblock_leak, $control[0]->dgblock_movement, $control[0]->dgblock_drainage, $control[0]->dgblock_weed);
                // 3.5
                $level_control_5 = cal_level($control[0]->waterbreak_erosion, $control[0]->waterbreak_subsidence, $control[0]->waterbreak_cracking, $control[0]->waterbreak_obstruction, $control[0]->waterbreak_hole, $control[0]->waterbreak_leak, $control[0]->waterbreak_movement, $control[0]->waterbreak_drainage, $control[0]->waterbreak_weed);
                // 3.6
                $level_control_6 = cal_level($control[0]->bridge_erosion, $control[0]->bridge_subsidence, $control[0]->bridge_cracking, $control[0]->bridge_obstruction, $control[0]->bridge_hole, $control[0]->bridge_leak, $control[0]->bridge_movement, $control[0]->bridge_drainage, $control[0]->bridge_weed);
                // --- Avg 3
                $damage[3] = score(($level_control_1[1] + $level_control_2[1] + $level_control_3_1[1] + $level_control_3_2[1] + $level_control_3_3[1] + $level_control_3_4[1] + $level_control_4[1] + $level_control_5[1] + $level_control_6[1]) / ($level_control_1[0] + $level_control_2[0] + $level_control_3_1[0] + $level_control_3_2[0] + $level_control_3_3[0] + $level_control_3_4[0] + $level_control_4[0] + $level_control_5[0] + $level_control_6[0]));
                $damage_score[3] = ($level_control_1[1] + $level_control_2[1] + $level_control_3_1[1] + $level_control_3_2[1] + $level_control_3_3[1] + $level_control_3_4[1] + $level_control_4[1] + $level_control_5[1] + $level_control_6[1]) / ($level_control_1[0] + $level_control_2[0] + $level_control_3_1[0] + $level_control_3_2[0] + $level_control_3_3[0] + $level_control_3_4[0] + $level_control_4[0] + $level_control_5[0] + $level_control_6[0]);
            }


            // 4.1 downconcrete
            $level_downconcrete_1 = cal_level($downconcrete[0]->floor_erosion, $downconcrete[0]->floor_subsidence, $downconcrete[0]->floor_cracking, $downconcrete[0]->floor_obstruction, $downconcrete[0]->floor_hole, $downconcrete[0]->floor_leak, $downconcrete[0]->floor_movement, $downconcrete[0]->floor_drainage, $downconcrete[0]->floor_weed);
            // 4.2
            $level_downconcrete_2 = cal_level($downconcrete[0]->side_erosion, $downconcrete[0]->side_subsidence, $downconcrete[0]->side_cracking, $downconcrete[0]->side_obstruction, $downconcrete[0]->side_hole, $downconcrete[0]->side_leak, $downconcrete[0]->side_movement, $downconcrete[0]->side_drainage, $downconcrete[0]->side_weed);
            // 4.3
            $level_downconcrete_3 = cal_level($downconcrete[0]->flrblock_erosion, $downconcrete[0]->flrblock_subsidence, $downconcrete[0]->flrblock_cracking, $downconcrete[0]->flrblock_obstruction, $downconcrete[0]->flrblock_hole, $downconcrete[0]->flrblock_leak, $downconcrete[0]->flrblock_movement, $downconcrete[0]->flrblock_drainage, $downconcrete[0]->flrblock_weed);
            // 4.4
            $level_downconcrete_4 = cal_level($downconcrete[0]->endsill_erosion, $downconcrete[0]->endsill_subsidence, $downconcrete[0]->endsill_cracking, $downconcrete[0]->endsill_obstruction, $downconcrete[0]->endsill_hole, $downconcrete[0]->endsill_leak, $downconcrete[0]->endsill_movement, $downconcrete[0]->endsill_drainage, $downconcrete[0]->endsill_weed);
            // --- Avg 4
            $damage[4] = score(($level_downconcrete_1[1] + $level_downconcrete_2[1] +  $level_downconcrete_3[1] + $level_downconcrete_4[1]) / ($level_downconcrete_1[0] + $level_downconcrete_2[0] +  $level_downconcrete_3[0] + $level_downconcrete_4[0]));
            $damage_score[4] = ($level_downconcrete_1[1] + $level_downconcrete_2[1] +  $level_downconcrete_3[1] + $level_downconcrete_4[1]) / ($level_downconcrete_1[0] + $level_downconcrete_2[0] +  $level_downconcrete_3[0] + $level_downconcrete_4[0]);

            // 5.1 downprotection
            $level_downprotection_1 = cal_level($downprotection[0]->floor_erosion, $downprotection[0]->floor_subsidence, $downprotection[0]->floor_cracking, $downprotection[0]->floor_obstruction, $downprotection[0]->floor_hole, $downprotection[0]->floor_leak, $downprotection[0]->floor_movement, $downprotection[0]->floor_drainage, $downprotection[0]->floor_weed);
            // 5.2
            $level_downprotection_2 = cal_level($downprotection[0]->side_erosion, $downprotection[0]->side_subsidence, $downprotection[0]->side_cracking, $downprotection[0]->side_obstruction, $downprotection[0]->side_hole, $downprotection[0]->side_leak, $downprotection[0]->side_movement, $downprotection[0]->side_drainage, $downprotection[0]->side_weed);
            // --- Avg 5
            $damage[5] = score(($level_downprotection_1[1] + $level_downprotection_2[1]) / ($level_downprotection_1[0] + $level_downprotection_2[0]));
            $damage_score[5] = ($level_downprotection_1[1] + $level_downprotection_2[1]) / ($level_downprotection_1[0] + $level_downprotection_2[0]);

            // 6.1 waterdelivery
            $level_waterdelivery_1 = cal_level($waterdelivery[0]->floor_erosion, $waterdelivery[0]->floor_subsidence, $waterdelivery[0]->floor_cracking, $waterdelivery[0]->floor_obstruction, $waterdelivery[0]->floor_hole, $waterdelivery[0]->floor_leak, $waterdelivery[0]->floor_movement, $waterdelivery[0]->floor_drainage, $waterdelivery[0]->floor_weed);
            // 6.2
            $level_waterdelivery_2 = cal_level($waterdelivery[0]->side_erosion, $waterdelivery[0]->side_subsidence, $waterdelivery[0]->side_cracking, $waterdelivery[0]->side_obstruction, $waterdelivery[0]->side_hole, $waterdelivery[0]->side_leak, $waterdelivery[0]->side_movement, $waterdelivery[0]->side_drainage, $waterdelivery[0]->side_weed);
            // 6.3
            $level_waterdelivery_3 = cal_level($waterdelivery[0]->gate_erosion, $waterdelivery[0]->gate_subsidence, $waterdelivery[0]->gate_cracking, $waterdelivery[0]->gate_obstruction, $waterdelivery[0]->gate_hole, $waterdelivery[0]->gate_leak, $waterdelivery[0]->gate_movement, $waterdelivery[0]->gate_drainage, $waterdelivery[0]->gate_weed);
            // --- Avg 6
            $damage[6] = score(($level_waterdelivery_1[1] + $level_waterdelivery_2[1] + $level_waterdelivery_3[1]) / ($level_waterdelivery_1[0] + $level_waterdelivery_2[0] + $level_waterdelivery_3[0]));
            $damage_score[6] = ($level_waterdelivery_1[1] + $level_waterdelivery_2[1] + $level_waterdelivery_3[1]) / ($level_waterdelivery_1[0] + $level_waterdelivery_2[0] + $level_waterdelivery_3[0]);
            // ------------

            $sumScore = calSumScore($damage_score[0]) . calSumScore($damage_score[1]) . calSumScore($damage_score[3]) . calSumScore($damage_score[4]) . calSumScore($damage_score[5]) . calSumScore($damage_score[6]);
            // if ($sumScore == "111011") {
            //     $sumScore = "111111";
            // }
            // เพิ่ม คะแนนตะกอน 1 และ 2
            $devide = calSumScore($upprotection[0]->floor_erosion) + calSumScore($upconcrete[0]->floor_erosion);
            if ($devide == 0) {
                $devide = 1;
            }
            $newpoint = level1($upprotection[0]->floor_erosion) + level1($upconcrete[0]->floor_erosion) / $devide;
            if ($newpoint < 1) {
                $c = 0.50;
            } elseif ($newpoint < 2) {
                $c = 0.25;
            } elseif ($newpoint < 3.25) {
                $c = 0.15;
            } else {
                $c = 0;
            }

            // dd($sumScore);
            // dd($sumScore);
            if ($check_3 == 1) {
                $sumScoreAll = 1.9;
                $new_sumScoreAll = 1.9;
            } else {
                $weight = DB::table('score_weights')->select('*')->where('point', $sumScore)->get();
                // dd($weight);
                $sumScoreAll = $weight[0]->part1 * zeroCheck($damage_score[0]) + $weight[0]->part2 * zeroCheck($damage_score[1]) + $weight[0]->part3 * zeroCheck($damage_score[3]) + $weight[0]->part4 * zeroCheck($damage_score[4]) + $weight[0]->part5 * zeroCheck($damage_score[5]) + $weight[0]->part6 * zeroCheck($damage_score[6]);
                $new_sumScoreAll = $sumScoreAll - $c;
            }
            $classSum = classSum($sumScoreAll);
            $new_classSum = classSum($new_sumScoreAll);


            $result[] = [
                'sumScore' => $sumScore,
                'weir_id' => $weir[0]->weir_id,
                'weir_code' => $weir[0]->weir_code,
                'weir_name' => $weir[0]->weir_name,
                'sumScoreAll' => number_format($sumScoreAll, 2, '.', ''),
                'classSum' => $classSum,
                'new_sumScoreAll' => number_format($new_sumScoreAll, 2, '.', ''),
                'new_classSum' => $new_classSum,
                'damage_1' => $damage[0],
                'damage_2' => $damage[1],
                'damage_3' => $damage[3],
                'damage_4' => $damage[4],
                'damage_5' => $damage[5],
                'damage_6' => $damage[6],
                'damage_score_1' => number_format($damage_score[0], 2, '.', ''),
                'damage_score_2' => number_format($damage_score[1], 2, '.', ''),
                'damage_score_3' => number_format($damage_score[3], 2, '.', ''),
                'damage_score_4' => number_format($damage_score[4], 2, '.', ''),
                'damage_score_5' => number_format($damage_score[5], 2, '.', ''),
                'damage_score_6' => number_format($damage_score[6], 2, '.', ''),

            ];
        }
        $amp = $amp;

        // $result = json_encode($result);

        // dd($result);
        return view('pages.mapscore', compact('result', 'amp'));
    }

    // API MAP Score
    public function score($amp = 0, $class = 0)
    {
        $location = WeirLocation::select('*')->where('weir_district', $amp)->get();
            // dd(count($location));
            // dd($location[25]);
            for ($i = 0; $i < count($location); $i++) {
                $weir = WeirSurvey::select('*')->where('weir_location_id', $location[$i]->weir_location_id)->get();
                $river = River::select('river_name')->where('river_id', $weir[0]->river_id)->get();
                $score = Impovement::select('*')->where('weir_id', $weir[0]->weir_id)->get()->last();
                $latlong = json_decode($location[$i]->latlong);
                
                // dd($score[0]->improve_type);

                if ($score->improve_type == $class) {

                    $result[] = [
                        'weir_id' => $weir[0]->weir_id,
                        'weir_code' => $weir[0]->weir_code,
                        'weir_name' => $weir[0]->weir_name,
                        'lat' => $latlong->x,
                        'long' => $latlong->y,
                        'weir_village' => $location[$i]->weir_village,
                        'weir_tumbol' => $location[$i]->weir_tumbol,
                        'weir_district' => $location[$i]->weir_district,
                        'river' => $river[0]->river_name,
                        'score' => $score->improve_type,
                    ];
                }
            }
       
        $result = json_encode($result);
        echo $result;
    }

    // Page Map Score for table
    public function scoretable()
    {
        $amp = ["เมืองแพร่", "ร้องกวาง", "ลอง", "สูงเม่น", "เด่นชัย", "สอง", "วังชิ้น", "หนองม่วงไข่"];
        

        for ($i = 0; $i < count($amp); $i++) {
            $score_N = Impovement::select('improve_type')->where('weir_amp', $amp[$i])->where('improve_type', 1)->get();
            $score_O = Impovement::select('improve_type')->where('weir_amp', $amp[$i])->where('improve_type', 2)->get();
            $score_R = Impovement::select('improve_type')->where('weir_amp', $amp[$i])->where('improve_type', 3)->get();
           $result[] = [
                'amp' => $amp[$i],
                'score_N' => $score_N->count(),
                'score_O' => $score_O->count(),
                'score_R' => $score_R->count(),
            ];
        }
        // dd($result);
        return view('scorereport.mapscore', compact('result'));
    }


    // API MAP Score
    public function sedimentscoreOnMap($amp = 0, $class = 0)
    {
        $location = WeirLocation::select('*')->where('weir_district', $amp)->get();
        for ($i = 0; $i < count($location); $i++) {
            $score = 0;
            $weir = WeirSurvey::select('*')->where('weir_location_id', $location[$i]->weir_location_id)->get();
            $river = River::select('river_name')->where('river_id', $weir[0]->river_id)->get();
            $score = DB::table('upconcrete_invs')->select('*')->where('weir_id', $weir[0]->weir_id)->get();

            $latlong = json_decode($location[$i]->latlong);
            // dd($class);
            if ($score[0]->check_floor == $class) {
                $result[] = [
                    'weir_id' => $weir[0]->weir_id,
                    'weir_code' => $weir[0]->weir_code,
                    'weir_name' => $weir[0]->weir_name,
                    'lat' => $latlong->x,
                    'long' => $latlong->y,
                    'weir_village' => $location[$i]->weir_village,
                    'weir_tumbol' => $location[$i]->weir_tumbol,
                    'weir_district' => $location[$i]->weir_district,
                    'river' => $river[0]->river_name,
                    'score' => $score[0]->check_floor
                ];
            }
        }
        // dd($result);
        
        $result = json_encode($result);
        echo $result;
    }

    public function sedimentscore()
    {
        $amp = ["เมืองแพร่", "ร้องกวาง", "ลอง", "สูงเม่น", "เด่นชัย", "สอง", "วังชิ้น", "หนองม่วงไข่"];
        

        for ($i = 0; $i < count($amp); $i++) {
            $score_Y = DB::table('upconcrete_invs')
                        ->select('upconcrete_invs.weir_id','upconcrete_invs.check_floor')
                        ->join('weir_surveys','weir_surveys.weir_id','=','upconcrete_invs.weir_id')
                        ->join('weir_locations','weir_locations.weir_location_id','=','weir_surveys.weir_location_id')
                        ->where(['weir_locations.weir_district' =>$amp[$i] , 'upconcrete_invs.check_floor' => '2'])->count();
            $score_O = DB::table('upconcrete_invs')
                        ->select('upconcrete_invs.weir_id','upconcrete_invs.check_floor')
                        ->join('weir_surveys','weir_surveys.weir_id','=','upconcrete_invs.weir_id')
                        ->join('weir_locations','weir_locations.weir_location_id','=','weir_surveys.weir_location_id')
                        ->where(['weir_locations.weir_district' =>$amp[$i] , 'upconcrete_invs.check_floor' => '3'])->count();
            $score_R = DB::table('upconcrete_invs')
                        ->select('upconcrete_invs.weir_id','upconcrete_invs.check_floor')
                        ->join('weir_surveys','weir_surveys.weir_id','=','upconcrete_invs.weir_id')
                        ->join('weir_locations','weir_locations.weir_location_id','=','weir_surveys.weir_location_id')
                        ->where(['weir_locations.weir_district' =>$amp[$i] , 'upconcrete_invs.check_floor' => '4'])->count();
            $result[] = [
                'amp' => $amp[$i],
                'score_Y' => $score_Y,
                'score_O' => $score_O,
                'score_R' => $score_R,
            ];
        }
        // dd($result);
        return view('scorereport.sedimentscore', compact('result'));
    }

}
