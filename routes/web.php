<?php

/********************************************* GROUP 2 ***********************************************/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CreatePart4Controller;
use App\Http\Controllers\ManagementController;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\ApproveController;

use App\Http\Controllers\insertController;
use App\Http\Controllers\FileUploadController;

/********************************************* END GROUP 2 ***********************************************/

/********************************************* GROUP 1 ***********************************************/

use App\Http\Controllers\Kr;
use App\Http\Controllers\ObjectGroup1;
use App\Http\Controllers\UserOKR;
use App\Http\Controllers\Showobject;

/********************************************* END GROUP 1 ***********************************************/
/*
/************************************************ GROUP 3**********************************************************/

use App\Http\Controllers\CreatePart2Controller;
use App\Http\Controllers\ContentPart2Controller;
use App\Http\Controllers\ContentPart2YearController;
use App\Http\Controllers\SearchPart2Controller;
use App\Http\Controllers\ConfirmPart2Controller;
use App\Http\Controllers\ConfirmPart2YearController;
use App\Http\Controllers\GraphPart2Controller;
use App\Http\Controllers\GraphPart2YearController;

/************************************************  END GROUP 3**********************************************************/

/************************************************ GROUP 4**********************************************************/

use App\Http\Controllers\Sec3AddInd;
use App\Http\Controllers\Sec3Confirm;
use App\Http\Controllers\Sec3SaveData;
use App\Http\Controllers\Sec3Search;
use App\Http\Controllers\Sec3Dashboard;
use App\Http\Controllers\Sec4AddInd;
use App\Http\Controllers\Sec4Confirm;
use App\Http\Controllers\Sec4SaveData;
use App\Http\Controllers\Sec4Search;
use App\Http\Controllers\Sec4Dashboard;

/************************************************  END GROUP 4**********************************************************/

// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | contains the "web" middleware group. Now create something great!
// |
// */

try {

    Route::post('/index', function () {
        return view('index');
    })->name('/');

    Route::get('/', function () {
        if (session()->has('user')) {
            return view("index");
        } else {
            return view('login');
        }
    });
    Route::get('/logout', function () {
        session()->forget('user');
        return redirect('/');
    });
    Route::post('/Valid', [LoginController::class, 'index'], function ($argv) {
    })->name('test');


    /********************************************* GROUP 2 ***********************************************/
    /********************************************* GROUP 2 ***********************************************/
    /********************************************* GROUP 2 ***********************************************/
    Route::get('/insertDB', [CreatePart4Controller::class, 'index'], function () {
    })->middleware('AuthLogin');

    Route::resource('submit', insertController::class)->middleware('AuthLogin');
    Route::post('/updateCount', [insertController::class, 'edit'])->middleware('AuthLogin');
    Route::post('/submit', [insertController::class, 'index'])->middleware('AuthLogin');
    Route::resource('report', ReportController::class)->middleware('AuthLogin');
    Route::post('/sea', [ReportController::class, 'sea'])->middleware('AuthLogin');
    Route::resource('createpart4', CreatePart4Controller::class)->middleware('AuthLogin');
    Route::post('/createpart4/store', [CreatePart4Controller::class, 'store'])->middleware('AuthLogin');
    Route::post('/createpart4/delete', [CreatePart4Controller::class, 'delete_row'])->middleware('AuthLogin');
    Route::get('/graph', [GraphController::class, 'index'])->middleware('AuthLogin');

    Route::resource('/approve', ApproveController::class)->middleware('AuthLogin');
    Route::post('/approvePost', [ApproveController::class, 'sea'])->middleware('AuthLogin');
    Route::post('/confirm', [ApproveController::class, 'confirm'])->middleware('AuthLogin');
    Route::get('/get_graph', [GraphController::class, 'test'])->middleware('AuthLogin');

    Route::get('/index', function () {
        return view('index');
    });

    // Route::get('file-upload', [FileUploadController::class, 'index']);
    // Route::post('store', [FileUploadController::class, 'store']);
    Route::get('file-upload', [FileUploadController::class, 'index'])->name('file.upload')->middleware('AuthLogin');
    Route::post('file-upload', [FileUploadController::class, 'store'])->name('file.upload.post')->middleware('AuthLogin');
    Route::get('file/download', [FileUploadController::class, 'getfile'])->middleware('AuthLogin');
    Route::get('file-upload', [FileUploadController::class, 'store'])->name('file.upload.get')->middleware('AuthLogin');

    Route::resource('/management', ManagementController::class)->middleware('AuthLogin');
    Route::post('/manageted', [ManagementController::class, 'manageted'])->middleware('AuthLogin');
    Route::post('/manageted/delete', [ManagementController::class, 'delete_row'])->middleware('AuthLogin');

    /********************************************* END GROUP 2 ***********************************************/
    /********************************************* END GROUP 2 ***********************************************/
    /********************************************* END GROUP 2 ***********************************************/


    /********************************************* GROUP 3 ***********************************************/
    /********************************************* GROUP 3 ***********************************************/
    /********************************************* GROUP 3 ***********************************************/


    Route::get('/createPart2', [CreatePart2Controller::class, 'index']);
    Route::post('/createPart2/update', [CreatePart2Controller::class, 'updateCreate',])->name('updateCreate');


    Route::get('/searchPart2', [SearchPart2Controller::class, 'index']);
    Route::post('/searchPart2', [SearchPart2Controller::class, 'search',])->name('search');
    //join table indicator
    Route::get('/contentPart2', [ContentPart2Controller::class, 'index']);
    //update
    Route::post('/contentPart2/update', [ContentPart2Controller::class, 'update',])->name('updatemonth');
    Route::post('/contentPart2', [ContentPart2Controller::class, 'search_month',])->name('search_month');

    //join table indicator
    Route::get('/contentPart2Year', [ContentPart2YearController::class, 'index']);
    //update
    Route::post('/contentPart2Year/update', [ContentPart2YearController::class, 'update',])->name('updateyear');
    Route::post('/contentPart2Year', [ContentPart2YearController::class, 'search_year',])->name('search_year');

    Route::get('/confirmPart2', [ConfirmPart2Controller::class, 'index']);
    Route::post('/confirmPart2', [ConfirmPart2Controller::class, 'confirm_month'])->name('confirm_month');
    Route::post('/logconfirmPart2', [ConfirmPart2Controller::class, 'logPart2'])->name('logPart2');
    Route::post('/unlogconfirmPart2', [ConfirmPart2Controller::class, 'unlogPart2'])->name('unlogPart2');

    Route::get('/confirmPart2Year', [ConfirmPart2YearController::class, 'index']);
    Route::post('/confirmPart2Year', [ConfirmPart2YearController::class, 'confirm_year'])->name('confirm_year');
    Route::post('/logconfirmPart2Year', [ConfirmPart2YearController::class, 'logPart2Year'])->name('logPart2Year');
    Route::post('/unlogconfirmPart2Year', [ConfirmPart2YearController::class, 'unlogPart2Year'])->name('unlogPart2Year');

    Route::post('/createPart2/insert_indicator', [CreatePart2Controller::class, 'insert_indicator'])->name('insert_indicator');

    Route::get('/graphPart2Year', [GraphPart2YearController::class, 'index']);
    Route::get('/graphPart2', [GraphPart2Controller::class, 'index']);

    /********************************************* END GROUP 3 ***********************************************/
    /********************************************* END GROUP 3 ***********************************************/
    /********************************************* END GROUP 3 ***********************************************/


    /********************************************* GROUP 1 ***********************************************/
    /********************************************* GROUP 1 ***********************************************/
    /********************************************* GROUP 1 ***********************************************/
    Route::get('/section_one', [ObjectGroup1::class, 'index']);
    Route::get('/section_one/{year}', [ObjectGroup1::class, 'year']);
    Route::get('/section_one/{year}/{id}', [Kr::class, 'index']);
    Route::get('/section_five', [Showobject::class, 'show']);
    Route::post('/section_one/addKR', [Kr::class, 'addKR'])->name('addKR');
    Route::post('/section_one/add', [ObjectGroup1::class, 'addObject'])->name('addobject');
    Route::post('/section_one/updateKR', [Kr::class, 'updateKR'])->name('updateKR');
    Route::post('/section_one/delete', [ObjectGroup1::class, 'deleteObject'])->name('deleteobject');
    Route::post('/section_one/edit', [ObjectGroup1::class, 'editObject'])->name('editobject');
    // ยกเลิกสิทธิ
    Route::get('/cancelautrority/{id}/{employee}', [Kr::class, 'cancelautrority']);
    // กำหนดสิทธิ
    Route::get('/giveautrority/{id}/{employee}', [Kr::class, 'giveautrority']);
    Route::post('/section_one/deletekr', [Kr::class, 'deletekr'])->name('deletekr');
    Route::get('/userObject/{id}', [UserOKR::class, 'index']);
    Route::get('/userKr/{id}/{mount}', [UserOKR::class, 'userKR']);
    Route::post('/userKr/updateKr', [UserOKR::class, 'updateKRdetail'])->name('updateKRdetail');
    Route::post('/userKrdetail', [UserOKR::class, 'userKRdetail'])->name('userKRdetail');
    Route::get('/userKrdetail',  [UserOKR::class, 'usermount']);
    Route::get('douwloadgone', [UserOKR::class, 'downloadGroubOne']);

    Route::get('/search',  [UserOKR::class, 'search']);
    Route::post('/searchYear',  [UserOKR::class, 'searchyear']);
    Route::get('/searchKR/{id}',  [UserOKR::class, 'searchKR']);
    Route::post('/searchKrdetail', [UserOKR::class, 'searchKrdetail'])->name('searchKRdetail');
    Route::get('/{id}',  [UserOKR::class, 'dashbord']);
    Route::post('/showlog', [Showobject::class, 'showlog']);
    Route::post('/logKR', [Kr::class, 'logKRdetail']);
    Route::post('/UNlogKR', [Kr::class, 'UNlogKRdetail']);
    /********************************************* END GROUP 1 ********************************/
    /********************************************* END GROUP 1 ********************************/
    /********************************************* END GROUP 1 ********************************/


    /********************************************* GROUP 4 ***********************************************/
    /********************************************* GROUP 4 ***********************************************/
    /********************************************* GROUP 4 ***********************************************/
    Route::get('/sec3savedata', [Sec3SaveData::class, 'index'])->name('sec3savedata');
    Route::get('/sec3addind', [Sec3AddInd::class, 'index'])->name('sec3addind');;
    Route::get('/sec3search', [Sec3Search::class, 'index']);
    Route::get('/sec3confirm', [Sec3Confirm::class, 'index'])->name('sec3confirm');

    Route::get('/sec4savedata', [Sec4SaveData::class, 'index'])->name('sec4savedata');
    Route::get('/sec4addind', [Sec4AddInd::class, 'index'])->name('sec4addind');;
    Route::get('/sec4search', [Sec4Search::class, 'index']);
    Route::get('/sec4confirm', [Sec4Confirm::class, 'index'])->name('sec4confirm');;

    Route::get('/sec3dashboard', [Sec3Dashboard::class, 'index']);

    Route::get('/sec4dashboard', [Sec4Dashboard::class, 'index']);

    Route::post('/sec3/add', [Sec3AddInd::class, 'addInd'])->name('sec3addInd');
    Route::post('/sec4/add', [Sec4AddInd::class, 'addInd'])->name('sec4addInd');

    Route::post('/sec3/update', [Sec3AddInd::class, 'updateInd'])->name('sec3updateInd');
    Route::post('/sec4/update', [Sec4AddInd::class, 'updateInd'])->name('sec4updateInd');

    Route::post('/sec3/delete', [Sec3AddInd::class, 'deleteInd'])->name('sec3deleteInd');
    Route::post('/sec4/delete', [Sec4AddInd::class, 'deleteInd'])->name('sec4deleteInd');

    Route::post('/sec3/updatedata', [Sec3SaveData::class, 'updateData'])->name('updateDataSec3');
    Route::post('/sec4/updatedata', [Sec4SaveData::class, 'updateData'])->name('updateDataSec4');

    Route::post('/searchresultmountsec3', [Sec3Search::class, 'resultShowMount'])->name('resultsearchmountsec3');
    Route::post('/searchresultmountsec4', [Sec4Search::class, 'resultShowMount'])->name('resultsearchmountsec4');

    Route::post('/showresultmountsec3', [Sec3SaveData::class, 'resultShowMount'])->name('resultshowmountsec3');
    Route::post('/showresultmountsec4', [Sec4SaveData::class, 'resultShowMount'])->name('resultshowmountsec4');

    Route::post('/sec3confirm/sec3confirmindicator', [Sec3Confirm::class, 'lockIndicator'])->name('sec3confirmindicator');
    Route::post('/sec4confirm/sec4confirmindicator', [Sec4Confirm::class, 'lockIndicator'])->name('sec4confirmindicator');

    Route::post('/sec3confirm/sec3unconfirmindicator', [Sec3Confirm::class, 'unlockIndicator'])->name('sec3unconfirmindicator');
    Route::post('/sec3confirm/sec4unconfirmindicator', [Sec4Confirm::class, 'unlockIndicator'])->name('sec4unconfirmindicator');

    Route::post('/confirmresultmountsec3', [Sec3Confirm::class, 'resultShowMount'])->name('confirmresultmountsec3');
    Route::post('/confirmresultmountsec4', [Sec4Confirm::class, 'resultShowMount'])->name('confirmresultmountsec4');

    Route::post('/downloadsec3', [Sec3Search::class, 'download'])->name('downloadsec3');
    Route::post('/downloadsec4', [Sec4Search::class, 'download'])->name('downloadsec4');

    /********************************************* END GROUP 4 ********************************/
    /********************************************* END GROUP 4 ********************************/
    /********************************************* END GROUP 4 ********************************/
}
//catch exception
catch (Exception $e) {
    return redirect('/');
}
