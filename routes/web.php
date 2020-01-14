<?php

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
use Vinkla\Hashids\Facades\Hashids;
// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware'	=>	'guest'],function(){
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('/', 'Auth\LoginController@login');
});
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::group(['prefix' => 'sys'], function () {
	Route::group(['middleware' => 'auth:admins'], function () {
		Route::get('/dashboard', 'HomeController@index')->name('dashboard');
		// Route::get('/app_setting', 'HomeController@setting')->name('app.setting');
		// Route::PUT('/appSettingUpdate', 'HomeController@appSettingUpdate')->name('app.setting.update');
		Route::resource('admin_roles','AdminRolesController');
		Route::group(['prefix' => 'admin_roles'], function () {
			Route::get('{id}/manage_roles','AdminRolesController@manage_roles')->name('manage.role');
			Route::put('{id}/manage_roles','AdminRolesController@manage_roles_update')->name('manage.role.update');
		});
		Route::resource('admins_user','AdminsController');
		Route::resource('company','AdminCompanyController');
		Route::group(['prefix' => 'companies'], function () {
			Route::resource('users','AdminCompanyUsersController');
		});
		Route::resource('branch','AdminBranchController');
		Route::group(['prefix' => 'branch'], function () {
			Route::get('{id}/assignedQuestions','AdminBranchController@assignQuestions')->name('branch.assign.index');
			Route::get('{id}/makeassign','AdminBranchController@createAssign')->name('branch.assign.create');
			Route::Post('{id}/makeassign','AdminBranchController@storeAssign')->name('branch.assign.post');
			Route::delete('{branch_id}/deleteAssigned/{question_id}','AdminBranchController@deleteAssign')->name('branch.assign.delete');
		});
		Route::resource('question','AdminQuestionController');
		Route::group(['prefix' => 'question'], function () {
			Route::resource('{question_id}/options','AdminOptionController')->except(['show','delete','create','store']);
		});
		Route::group(['prefix' => 'user'], function () {
			Route::get('settings','UserController@settings')->name('settings');
			Route::put('settings','UserController@updateSettings')->name('settings.update');
		});
		Route::resource('customers','AdminCustomerController');
		Route::group(['prefix' => 'user'], function () {
			Route::get('sendmail/{review_id}','AdminCustomerController@MakeReview')->name('newReview');
		});
		Route::get('type_view','AdminQuestionController@type_view')->name('getView');
	});
});

route::get('review_branch/{id}','GuestController@index')->name('review.guest');
route::Post('review_branch/{id}','GuestController@store')->name('review.guest.store');