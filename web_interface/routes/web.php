<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\InterestRateController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
// routes/web.php
Route::post('/search',  [SearchController::class, 'search'])->name('search');

Route::patch('/profile/update-picture', [ProfileController::class,'updateProfilePicture'])->name('profile.update.picture');



Route::post('/update-interest-rate', [InterestRateController::class, 'update'])->name('updateInterestRate');
Route::post('/send-emails-with-attachment',[ ReportController ::class, 'sendEmailsWithAttachment'])->name('sendEmailsWithAttachment');


Route::get('/fetch-chart-data', [ChartController::class, 'fetchChartData'])->name('fetchChartData');
Route::post('/approve-loan/{applicationNumber}', [LoanController::class, 'approveLoan'])->name('approveLoan');
Route::get('/table', [ReferenceController::class, 'displayData'])->name('page.index');
Route::post('/save-response', [ResponseController::class, 'saveResponse'])->name('save-response');






Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/admin', 'App\Http\Controllers\HomeController@index')->name('dashboard');

Route::get('/deposits', [App\Http\Controllers\DepositsController::class, 'index'])->name('deposits');
Route::get('/deposits', 'App\Http\Controllers\DepositsController@index')->name('deposits');
Route::get('/admin/members', 'App\Http\Controllers\MembersController@index')->name('members');

use App\Http\Controllers\DepositsController;
Route::get('/upload', 'App\Http\Controllers\AvailableDepositsImportController@show');
Route::post('/upload', 'App\Http\Controllers\AvailableDepositsImportController@upload')->name('upload');

Route::get('/admin/addmembers', 'App\Http\Controllers\MembersController@add_members')->name('add_members');
Route::post('/admin/addmembers', 'App\Http\Controllers\MembersController@store_members');





Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::patch('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::patch('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});





