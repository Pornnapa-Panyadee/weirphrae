<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http; // Import the Http facade
use Illuminate\Http\Request;
use DB;

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

class ChartReportController extends Controller
{
    //
    // Page Map Score for table
    public function score(Request $request)
    {
        $amp = $request->amp;
          
        // count Score สภาพฝาย 
        if ($amp == "sum") {
            $score_N = Impovement::select('*')->where('improve_type', '1')->get();
            $score_O = Impovement::select('*')->where('improve_type', '2')->get();
            $score_R = Impovement::select('*')->where('improve_type', '3')->get();
        } else {
            $score_N = Impovement::select('*')->where('improve_type', '1')->where('weir_amp', $amp)->get();
            $score_O = Impovement::select('*')->where('improve_type', '2')->where('weir_amp', $amp)->get();
            $score_R = Impovement::select('*')->where('improve_type', '3')->where('weir_amp', $amp)->get();
        }

        $sum = $score_N->count() + $score_O->count() + $score_R->count();
        if ($sum == 0) {
            $sum = 1; // To avoid division by zero
        }

        $result[] = [
            'amp' => $amp,
            'score_N' => $score_N->count(),
            'score_O' => $score_O->count(),
            'score_R' => $score_R->count(),
            'scoreper_N' => number_format($score_N->count() / $sum * 100, 1, '.', ''),
            'scoreper_O' => number_format($score_O->count() / $sum * 100, 1, '.', ''),
            'scoreper_R' => number_format($score_R->count() / $sum * 100, 1, '.', ''),
        ];
        $countNum = [["ใช้งานได้ดี", $score_N->count()], ["ปานกลาง ควรซ่อมแซมปรับปรุง", $score_O->count()], ["ทรุดโทรม ควรรื้อถอน/ก่อสร้างใหม่", $score_R->count()]];
        
        $e = [[0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0]];
        if ($amp == "sum") {
            for ($i = 0; $i < 3; $i++) {
                $e[$i][1] = UpprotectionInv::select('*')->where('section_status',$i+1)->get()->count();
                $e[$i][2] = UpconcreteInv::select('*')->where('section_status',$i+1)->get()->count();
                $e[$i][3] = ControlInv::select('*')->where('section_status',$i+1)->get()->count();
                $e[$i][4] = DownconcreteInv::select('*')->where('section_status',$i+1)->get()->count();
                $e[$i][5] = DownprotectionInv::select('*')->where('section_status',$i+1)->get()->count();
                $e[$i][6] = WaterdeliveryInv::select('*')->where('section_status',$i+1)->get()->count();
            }
        }else {
            for ($i = 1; $i < 6; $i++) {
                $e[$i][1] = DB::table('upprotection_invs')
                            ->join('weir_surveys', 'upprotection_invs.weir_id', '=', 'weir_surveys.weir_id')
                            ->join('weir_locations', 'weir_surveys.weir_location_id', '=', 'weir_locations.weir_location_id')
                            ->select('weir_surveys.weir_id')->where('weir_locations.weir_district',$amp)->where('upprotection_invs.section_status',$i)->get()->count();
                $e[$i][2] = DB::table('upconcrete_invs')
                            ->join('weir_surveys', 'upconcrete_invs.weir_id', '=', 'weir_surveys.weir_id')
                            ->join('weir_locations', 'weir_surveys.weir_location_id', '=', 'weir_locations.weir_location_id')
                            ->select('weir_surveys.weir_id')->where('weir_locations.weir_district',$amp)->where('upconcrete_invs.section_status',$i)->get()->count();


                $e[$i][3] = DB::table('control_invs')
                            ->join('weir_surveys', 'control_invs.weir_id', '=', 'weir_surveys.weir_id')
                            ->join('weir_locations', 'weir_surveys.weir_location_id', '=', 'weir_locations.weir_location_id')
                            ->select('weir_surveys.weir_id')->where('weir_locations.weir_district',$amp)->where('control_invs.section_status',$i)->get()->count();

                $e[$i][4] = DB::table('downconcrete_invs')
                            ->join('weir_surveys', 'downconcrete_invs.weir_id', '=', 'weir_surveys.weir_id')
                            ->join('weir_locations', 'weir_surveys.weir_location_id', '=', 'weir_locations.weir_location_id')
                            ->select('weir_surveys.weir_id')->where('weir_locations.weir_district',$amp)->where('downconcrete_invs.section_status',$i)->get()->count();

                $e[$i][5] = DB::table('downprotection_invs')
                            ->join('weir_surveys', 'downprotection_invs.weir_id', '=', 'weir_surveys.weir_id')
                            ->join('weir_locations', 'weir_surveys.weir_location_id', '=', 'weir_locations.weir_location_id')
                            ->select('weir_surveys.weir_id')->where('weir_locations.weir_district',$amp)->where('downprotection_invs.section_status',$i)->get()->count();

                            
                $e[$i][6] = DB::table('waterdelivery_invs')
                            ->join('weir_surveys', 'waterdelivery_invs.weir_id', '=', 'weir_surveys.weir_id')
                            ->join('weir_locations', 'weir_surveys.weir_location_id', '=', 'weir_locations.weir_location_id')
                            ->select('weir_surveys.weir_id')->where('weir_locations.weir_district',$amp)->where('waterdelivery_invs.section_status',$i)->get()->count();

            }
        }


        $head = [
            "-", "1. ส่วน Protection เหนือน้ำ",
            "2. ส่วนเหนือน้ำ", "3. ส่วนควบคุมน้ำ",
            "4. ส่วนท้ายน้ำ", "5. ส่วน Protection ท้ายน้ำ",
            "6. ระบบส่งน้ำ"
        ];
        $head1 = [
            "1. ส่วน Protection เหนือน้ำ", "2. ส่วนเหนือน้ำ", "3. ส่วนควบคุมน้ำ",
            "4. ส่วนท้ายน้ำ", "5. ส่วน Protection ท้ายน้ำ", "6. ระบบส่งน้ำ"
        ];


        $countBar = [
            ["name" => "ใช้งานได้ดี", "data" => [$e[0][1], $e[0][2], $e[0][3], $e[0][4], $e[0][5], $e[0][6]] ],
            ["name" => "ปานกลาง ควรซ่อมแซมปรับปรุง", "data" => [$e[1][1], $e[1][2], $e[1][3], $e[1][4], $e[1][5], $e[1][6]]],
            ["name" => "ทรุดโทรม ควรรื้อถอน/ก่อสร้างใหม่", "data" => [$e[2][1], $e[2][2], $e[2][3], $e[2][4], $e[2][5], $e[2][6]]]
        ];         

        if ($amp == "sum") {
            $amp_name = "จังหวัดแพร่";
        } else {
            $amp_name = "อำเภอ" . $amp . " จังหวัดแพร่";
        }

        return view('scorereport.chart', compact('result', 'e', 'head', 'countNum', 'countBar', 'head1', 'amp_name'));
    }

    public function score_test(Request $request)
    {
        $amp = $request->amp;

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
                $c = 2;
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
        // count Score สภาพฝาย 
        if ($amp == "sum") {
            $score_N = DB::table('score_sums')->select('*')->where('class', 'สภาพดี')->get();
            $score_Y = DB::table('score_sums')->select('*')->where('class', 'สภาพค่อนข้างดี')->get();
            $score_O = DB::table('score_sums')->select('*')->where('class', 'สภาพปานกลาง')->get();
            $score_R = DB::table('score_sums')->select('*')->where('class', 'สภาพทรุดโทรม')->get();
        } else {
            $score_N = DB::table('score_sums')->select('*')->where('amp', $amp)->where('class', 'สภาพดี')->get();
            $score_Y = DB::table('score_sums')->select('*')->where('amp', $amp)->where('class', 'สภาพค่อนข้างดี')->get();
            $score_O = DB::table('score_sums')->select('*')->where('amp', $amp)->where('class', 'สภาพปานกลาง')->get();
            $score_R = DB::table('score_sums')->select('*')->where('amp', $amp)->where('class', 'สภาพทรุดโทรม')->get();
        }
        $sum = $score_N->count() + $score_Y->count() + $score_R->count();

        $result[] = [
            'amp' => $amp,
            'score_N' => $score_N->count(),
            'score_Y' => $score_Y->count(),
            'score_O' => $score_O->count(),
            'score_R' => $score_R->count(),
            'scoreper_N' => number_format($score_N->count() / $sum * 100, 1, '.', ''),
            'scoreper_Y' => number_format($score_Y->count() / $sum * 100, 1, '.', ''),
            'scoreper_O' => number_format($score_O->count() / $sum * 100, 1, '.', ''),
            'scoreper_R' => number_format($score_R->count() / $sum * 100, 1, '.', ''),
        ];
        $countNum = [["สภาพดี", $score_N->count()], ["สภาพค่อนข้างดี", $score_Y->count()], ["สภาพปานกลาง", $score_O->count()], ["สภาพทรุดโทรม", $score_R->count()]];


        // count องค์ประกอบของฝาย 6 ส่วน

        $e = [[0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0]];
        if ($amp == "sum") {
            for ($i = 1; $i < 6; $i++) {
                $damage = "damage_" . $i;
                $e[0][$i] = DB::table('score_sums')->select('*')->where($damage, '1')->get()->count();
                $e[1][$i] = DB::table('score_sums')->select('*')->where($damage, '2')->get()->count();
                $e[2][$i] = DB::table('score_sums')->select('*')->where($damage, '3')->get()->count();
                $e[3][$i] = DB::table('score_sums')->select('*')->where($damage, '4')->get()->count();
            }
        } else {
            for ($i = 1; $i < 6; $i++) {
                $damage = "damage_" . $i;
                $e[0][$i] = DB::table('score_sums')->select('*')->where($damage, '1')->where('amp', $amp)->get()->count();
                $e[1][$i] = DB::table('score_sums')->select('*')->where($damage, '2')->where('amp', $amp)->get()->count();
                $e[2][$i] = DB::table('score_sums')->select('*')->where($damage, '3')->where('amp', $amp)->get()->count();
                $e[3][$i] = DB::table('score_sums')->select('*')->where($damage, '4')->where('amp', $amp)->get()->count();
            }
        }
        // dd($e);
        $head = [
            "-", "1. ส่วน Protection เหนือน้ำ",
            "2. ส่วนเหนือน้ำ", "3. ส่วนควบคุมน้ำ",
            "4. ส่วนท้ายน้ำ", "5. ส่วน Protection ท้ายน้ำ",
            "6. ระบบส่งน้ำ"
        ];
        $head1 = [
            "1. ส่วน Protection เหนือน้ำ", "2. ส่วนเหนือน้ำ", "3. ส่วนควบคุมน้ำ",
            "4. ส่วนท้ายน้ำ", "5. ส่วน Protection ท้ายน้ำ", "6. ระบบส่งน้ำ"
        ];


        $countBar = [
            ["name" => "สภาพดี", "data" => [$e[3][1], $e[3][2], $e[3][3], $e[3][4], $e[3][5], $e[3][6]]],
            ["name" => "สภาพค่อนข้างดี", "data" => [$e[2][1], $e[2][2], $e[2][3], $e[2][4], $e[2][5], $e[2][6]]],
            ["name" => "สภาพปานกลาง", "data" => [$e[1][1], $e[1][2], $e[1][3], $e[1][4], $e[1][5], $e[1][6]]],
            ["name" => "สภาพทรุดโทรม", "data" => [$e[0][1], $e[0][2], $e[0][3], $e[0][4], $e[0][5], $e[0][6]]]
        ];
        // $countBar=[ [$e[2][1],$e[1][1],$e[0][1]],
        //             [$e[2][2],$e[1][2],$e[0][2]], 
        //             [$e[2][3],$e[1][3],$e[0][3]],
        //             [$e[2][4],$e[1][4],$e[0][4]],
        //             [$e[2][5],$e[1][5],$e[0][5]],
        //             [$e[2][6],$e[1][6],$e[0][6]]];

        if ($amp == "sum") {
            $amp_name = "4 อำเภอ จังหวัดแพร่";
        } else {
            $amp_name = "อำเภอ" . $amp . " จังหวัดแพร่";
        }

        return view('scorereport.charttest', compact('result', 'e', 'head', 'countNum', 'countBar', 'head1', 'amp_name'));
    }
}
