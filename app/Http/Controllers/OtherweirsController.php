<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RidWeir;
use App\Models\DwrWeir;
use App\Models\LoyalWeir;

class OtherweirsController extends Controller
{
    public function getRid(){
        header('Access-Control-Allow-Origin: *');
        $rid_weir = RidWeir::select('*')->get();

        for ($i=0;$i<count($rid_weir);$i++){ 
            if($rid_weir[$i]->weir_tranfer_status==1){
                $result[] = [
                    'weir_name'=> $rid_weir[$i]->weir_name,
                    'lat'=>$rid_weir[$i]->latitude,
                    'long'=>$rid_weir[$i]->longitude,
                    'weir_moo'=>$rid_weir[$i]->moo,
                    'weir_village'=> $rid_weir[$i]->village,
                    'weir_tumbol'=> $rid_weir[$i]->tambol,
                    'weir_district'=> $rid_weir[$i]->district,
                    'budget_from' => $rid_weir[$i]->budget_from,
                    'weir_build_year'=> $rid_weir[$i]->weir_build_year,
                    'weir_tranfer_year'=> $rid_weir[$i]->weir_tranfer_year,
                    'weir_tranfer_unit'=> $rid_weir[$i]->weir_tranfer_unit,
                    'weir_tranfer_status'=> $rid_weir[$i]->weir_tranfer_status,
                ];
            }
            
        }
        $result = json_encode($result);
        echo $result;
    }

    public function getRidNo(){
        header('Access-Control-Allow-Origin: *');
        $rid_weir = RidWeir::select('*')->get();

        for ($i=0;$i<count($rid_weir);$i++){ 
            if($rid_weir[$i]->weir_tranfer_status==0){
                $result[] = [
                    'weir_name'=> $rid_weir[$i]->weir_name,
                    'lat'=>$rid_weir[$i]->latitude,
                    'long'=>$rid_weir[$i]->longitude,
                    'weir_moo'=>$rid_weir[$i]->moo,
                    'weir_village'=> $rid_weir[$i]->village,
                    'weir_tumbol'=> $rid_weir[$i]->tambol,
                    'weir_district'=> $rid_weir[$i]->district,
                    'budget_from' => $rid_weir[$i]->budget_from,
                    'weir_build_year'=> $rid_weir[$i]->weir_build_year,
                    'weir_tranfer_year'=> $rid_weir[$i]->weir_tranfer_year,
                    'weir_tranfer_unit'=> $rid_weir[$i]->weir_tranfer_unit,
                    'weir_tranfer_status'=> $rid_weir[$i]->weir_tranfer_status,
                ];
            }
            
        }
        $result = json_encode($result);
        echo $result;
    }

    public function getDwr(){
        header('Access-Control-Allow-Origin: *');
        $rid_weir = DwrWeir::select('*')->get();

        for ($i=0;$i<count($rid_weir);$i++){ 
            if($rid_weir[$i]->weir_use==1){
                $weir_use="ใช้งานได้";
            }else{
                $weir_use="ไม่สามารถใช้งาน";
            }
           $result[] = [
                    'weir_name'=> $rid_weir[$i]->weir_name,
                    'lat'=>$rid_weir[$i]->latitude,
                    'long'=>$rid_weir[$i]->longitude,
                    'weir_moo'=>$rid_weir[$i]->moo,
                    'weir_village'=> $rid_weir[$i]->village,
                    'weir_tumbol'=> $rid_weir[$i]->tambol,
                    'weir_district'=> $rid_weir[$i]->district,
                    'river' => $rid_weir[$i]->river,
                    'weir_build_year'=> $rid_weir[$i]->weir_build_year,
                    'weir_use'=> $weir_use,
                ];            
        }
        $result = json_encode($result);
        echo $result;
    }

    public function getloyal(){
        header('Access-Control-Allow-Origin: *');
        $rid_weir = LoyalWeir::select('*')->get();

        for ($i=0;$i<count($rid_weir);$i++){ 
            if($rid_weir[$i]->weir_system==1){
                $weir_system="มี";
            }else{
                $weir_system="ไม่มี";
            }
           $result[] = [
                    'weir_name'=> $rid_weir[$i]->weir_name,
                    'lat'=>$rid_weir[$i]->latitude,
                    'long'=>$rid_weir[$i]->longitude,
                    'weir_tumbol'=> $rid_weir[$i]->tambol,
                    'weir_district'=> $rid_weir[$i]->district,
                    'weir_type'=>$rid_weir[$i]->weir_type,
                    'weir_size'=>$rid_weir[$i]->weir_size,
                    'weir_storage'=>$rid_weir[$i]->weir_storage,
                    'weir_area'=>$rid_weir[$i]->weir_area,
                    'weir_start_year'=>$rid_weir[$i]->weir_start_year, 
                    'weir_system'=>$weir_system
                ];            
        }
        $result = json_encode($result);
        echo $result;
    }
}
