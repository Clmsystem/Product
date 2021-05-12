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
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

try {


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
