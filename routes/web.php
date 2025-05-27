<?php

use Illuminate\Support\Facades\Route;

#Admin & Expert $ Engineer


Auth::routes();
#Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// ----- Guest -----
Route::get('/', 'App\Http\Controllers\DataSurveyController@getDataHomeTable');
// ----- Guest -----


// ------Location ------
Route::get('district/{id}', 'App\Http\Controllers\LocationController@getDistricts');
Route::get('subdistrict/{id}', 'App\Http\Controllers\LocationController@getTumbols');
Route::get('getVillages/{amp}/{tambol}', 'App\Http\Controllers\LocationController@getVillages');

Route::get('location/getdistrict/{id}', 'App\Http\Controllers\LocationController@getDistrict');
Route::get('location/getTumbol/{id}', 'App\Http\Controllers\LocationController@getTumbol');
Route::get('location/getVillage/{amp}/{tambol}', 'App\Http\Controllers\LocationController@getVillage');
// ------Location------

// ------Tab 1 Info Weir  ------
Route::get('/report/map', 'App\Http\Controllers\MapScoreController@scoretable');
Route::get('/report/chart', 'App\Http\Controllers\ChartReportController@score');
Route::get('/report/scoreComposition', function () {return view('scorereport.scorelist');});
Route::get('/report/problem', function () {return view('scorereport.problemlist');});

//report รายงานสรุปผลสภาพของฝายแต่ละองค์ประกอบ 
Route::POST('/report/scoreComposition/pdf', 'App\Http\Controllers\ReportPDFController@compositionWeir')->name('report.pdf');
// ข้อมูลสภาพปัญหาและแนวทางแก้ไขปัญหาเบื้องต้นของฝาย
Route::POST('/report/problemAmp/pdf', 'App\Http\Controllers\ReportPDFController@reportOne_amp')->name('reportOne_amp.pdf');

// ------Tab 1 Info Weir  ------

// ------Tab 2 Info sediment  ------
Route::get('/report/sediment', 'App\Http\Controllers\MapScoreController@sedimentscore');
Route::get('/report/sedimentTable', function () {return view('scorereport.sediment_table');});
Route::POST('/report/sediment_upconcrete/pdf', 'App\Http\Controllers\ReportPDFController@sedimentUpconcrete')->name('sediment.pdf');
// Route::get('/report/sedimentTable', 'App\Http\Controllers\ReportPDFController@reportpdf_warning');
// ------Tab 2 Info sediment  ------

// ------ Map data to Display------
Route::get('form/getDataSurvey/{amp}', 'App\Http\Controllers\DataSurveyController@getDataSurvey')->name('form.getDataSurvey');
// ------ Map data to Display------




// ****-------------------------------------------Backend------------------------------------
// ------Forms ------
Route::get('form','App\Http\Controllers\FormsController@location');
Route::POST('form/formsubmit', 'App\Http\Controllers\FormsController@formSubmit')->name('form.formsubmit');
Route::get('/edit/{weir_code}', 'App\Http\Controllers\DataSurveyController@formEdit');
Route::POST('form/formupdate', 'App\Http\Controllers\FormsController@formUpdate')->name('form.formupdata');
Route::POST('form/photosubmit', 'App\Http\Controllers\FormsController@photoSubmit')->name('form.photosubmit');
Route::POST('form/formexpert', 'App\Http\Controllers\FormsController@formexpert')->name('form.formexpert');
// add image
Route::get('addphoto/{id}', 'App\Http\Controllers\PhotoController@photoadd')->name('addphoto');
Route::get('photoremove/{id}', 'App\Http\Controllers\PhotoController@photoremove')->name('photoremove');
Route::get('photoremovemap/{id}', 'App\Http\Controllers\PhotoController@photoremovemap')->name('photoremovemap');

// ------Forms ------

// ------Report ------
// -----Admin & Expert & Engineer -----
Route::get('/pdf/{id}', 'App\Http\Controllers\ReportPDFController@pdf_index');
// -----Admin & Expert & Engineer -----
// -----Guest -----
Route::get('/report/pdf/{id}', 'App\Http\Controllers\ReportPDFController@reportpdf_index');
// Photo in Home page 
Route::get('/photo/{id}', 'App\Http\Controllers\PhotoController@photoHome')->name('photo');
//  Map each Location 
Route::get('map/{id}', 'App\Http\Controllers\DataSurveyController@getDatabyWeir')->name('form.getDatabyWeir');
// -----Guest -----
// ------Report ------
// ****-------------------------------------------Backend------------------------------------



Route::get('/testh', 'App\Http\Controllers\DataSurveyController@getDataHomeTabletesth');



Route::get('/test/{id}', 'App\Http\Controllers\PhotoController@photoHometest')->name('phototest');

// report

Route::get('/report/amp/{amp}', 'App\Http\Controllers\ReportPDFController@reportOne_amp');




// Expert 
// Route::get('/expert/list', 'App\Http\Controllers\ListexpertController@getDatatoTable')->name('list');

// Table
Route::get('/tablescore', 'App\Http\Controllers\MapScoreController@compositionWeir');
Route::get('/score/{amp}/{class}', 'App\Http\Controllers\MapScoreController@score');
Route::get('/sedimentscore/{amp}/{class}', 'App\Http\Controllers\MapScoreController@sedimentscoreOnMap');


// score Map 

// Route::get('/report/map', function () {return view('scorereport.mapscore');});
// Route::get('/report/chart', function () {return view('scorereport.chart');});

Route::get('/report/chart_test', 'App\Http\Controllers\ChartReportController@score_test');


Route::get('/about', function () {return view('pages.about');});
Route::get('/contact', function () {return view('pages.contact');});
Route::get('/manual', function () {return view('pages.manual');});
Route::get('/project', function () {return view('pages.project');});
Route::get('/project/{id} ', 'App\Http\Controllers\ProjectCaseController@case');



///// admin
Route::get('/admin/list', 'App\Http\Controllers\UsersController@getUser')->name('admin.list');
Route::get('/admin/register', function () {return view('admin.register');});
Route::get('/admin/edit/{id}', 'App\Http\Controllers\UsersController@getdetailUser');
Route::get('/admin/delete/{id}', 'App\Http\Controllers\UsersController@deleteUser');
Route::post('/admin/update', 'App\Http\Controllers\UsersController@updateUser')->name('users.updatedata');

Route::get('/list', 'App\Http\Controllers\DataSurveyController@getDatatoTable')->name('list');
Route::get('/list/expert', 'App\Http\Controllers\DataSurveyController@getDatatoTableExpert')->name('expert.list');



Route::get('/getdistrict/{id}', 'App\Http\Controllers\FormsController@getDistrict');
Route::get('/getTumbol/{id}', 'App\Http\Controllers\FormsController@getTumbol');
Route::get('/getVillage/{amp}/{tambol}', 'App\Http\Controllers\FormsController@getVillage');
Route::get('/expert/{weir_code}', 'App\Http\Controllers\DataSurveyController@getDatabyExpert')->name('expert');
Route::get('/remove/{id}', 'App\Http\Controllers\FormsController@formDelete');


// test
Route::get('/testpdf', 'App\Http\Controllers\ReportPDFController@testPDF');
Route::get('/testpdf/{id}', 'App\Http\Controllers\ReportPDFController@testPDF');
Route::get('/data', 'App\Http\Controllers\DataSurveyController@getData');
