<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/admin/login');
    //return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::auth();

    Route::get('/home', ['as' => 'admin.home', 'uses' => 'HomeController@index']);
    Route::resource('admin_user', 'AdminUserController');
    Route::post('admin_user/store', 'AdminUserController@store');
    Route::post('admin_user/destroyall',['as'=>'admin.admin_user.destroy.all','uses'=>'AdminUserController@destroyAll']);
    Route::resource('role', 'RoleController');
    Route::post('role/destroyall',['as'=>'admin.role.destroy.all','uses'=>'RoleController@destroyAll']);
    Route::get('role/{id}/permissions',['as'=>'admin.role.permissions','uses'=>'RoleController@permissions']);
    Route::post('role/{id}/permissions',['as'=>'admin.role.permissions','uses'=>'RoleController@storePermissions']);
    Route::resource('permission', 'PermissionController');
    Route::post('permission/destroyall',['as'=>'admin.permission.destroy.all','uses'=>'PermissionController@destroyAll']);
    Route::resource('blog', 'BlogController');

    /* 用户资金变化 */
    Route::get('user/balanceChange', ['as' => 'admin.user.balanceChange', 'uses' => 'LoanUserController@balanceChange']);
    /* 执行充值扣款 */
    Route::post('doBalanceChange', ['as' => 'admin.user.doBalanceChange', 'uses' => 'LoanUserController@doBalanceChange']);

    //用户列表
    Route::get('user/userList', ['as' => 'admin.user.userList', 'uses' => 'LoanUserController@userList']);
    //资金流水表
    Route::get('user/fundHistory', ['as' => 'admin.user.fundHistory', 'uses' => 'LoanUserController@userFundHistory']);

    //银行卡
    Route::get('user/bankCard', ['as' => 'admin.user.bankCard', 'uses' => 'LoanUserController@bankCard']);

    //修改银行卡
    Route::post('user/updateBankCard', ['as' => 'admin.user.updateBankCard', 'uses' => 'LoanUserController@updateBankCard']);

    //借款人债权列表
    Route::get('credit/list', ['as'  => 'admin.credit.list',  'uses'  => 'LoanUserCreditController@creditList']);
    //借款人债权满标放款的数据导出
    Route::get( 'credit/refunding/export', ['as' =>'admin.credit.refunding.export', 'uses' => 'LoanUserCreditController@doCreditRefundingExport']);
});



Route::group(['middleware' => ['api_auth'], 'namespace' => 'Api', 'prefix' => 'api'], function () {

    //查询用户信息
    Route::post('getUserInfo', 'LoanUserController@getUserInfo');
    //批量添加债权及借款人
    Route::post('batchCreateUserAndCredit', 'LoanUserController@batchCreateUserAndCredit');
    //发布项目债权
    Route::post('doPublishCredit', 'LoanUserController@doPublishCredit');
    //还款通知
    Route::post('doRefundNotice', 'LoanUserController@doRefundNotice');
    //满标放款
    Route::post('makeLoans', 'LoanUserController@makeLoans');



});



