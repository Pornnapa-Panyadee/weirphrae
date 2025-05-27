<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectCaseController extends Controller
{
    public function case($id=0){
        // dd($id);
        $cover="images/cover/proj".$id.".jpg";
        $plan="images/plan/plan".$id.".PNG";
        $survey="images/survey/proj".$id.".PNG";
        $plan_link="pdf/plan/proj".$id.".pdf";
        $survey_link="pdf/survey/proj".$id.".pdf";
        $BOQ_link="pdf/BOQ/BOQ".$id.".pdf";
        return view('pages.project_detail',compact('cover','plan','survey','plan_link','survey_link','id','BOQ_link'));

    }
}
