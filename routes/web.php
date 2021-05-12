<?php

/********************************************* GROUP 1 ***********************************************/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CreatePart4Controller;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\ApproveController;

use App\Http\Controllers\insertController;
use App\Http\Controllers\FileUploadController;

/********************************************* END GROUP 1 ***********************************************/

/********************************************* GROUP 2 ***********************************************/

use App\Http\Controllers\Kr;
use App\Http\Controllers\ObjectGroup1;
use App\Http\Controllers\UserOKR;
use App\Http\Controllers\Showobject;

/********************************************* END GROUP 2 ***********************************************/
/*
/************************************************ GROUP 3**********************************************************/

use App\Http\Controllers\Controller;
use App\Http\Controllers\CreatePart2Controller;
use App\Http\Controllers\ContentPart2Controller;
use App\Http\Controllers\ContentPart2YearController;
use App\Http\Controllers\SearchPart2Controller;
use App\Http\Controllers\ConfirmPart2Controller;
use App\Http\Controllers\ConfirmPart2YearController;
use App\Http\Controllers\GraphPart2Controller;
/************************************************  END GROUP 3**********************************************************/


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
        return view('login');
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

    

}
//catch exception
catch (Exception $e) {
    return redirect('/');
}
