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

Auth::routes(['register' => false]);

Route::redirect('/', '/login');

Route::get('users/verify/{token}', 'VerificationController@showVerificationPage')->name('users.verification');
Route::post('users/verify/{token}', 'VerificationController@verify')->name('users.verify');

Route::middleware(['auth'])->group(function () {
    /** Prooducts */
    Route::post('products/category', 'ProductController@storeCategory');

    /** Profile */
    Route::get('profile', 'UserController@index')->name('profile.index');
    Route::post('profile/update-info', 'UserController@updateInfo');
    Route::post('profile/update-password', 'UserController@updatePassword');
    Route::post('profile/upload-image', 'UserController@uploadImage');
    Route::delete('profile/delete-image', 'UserController@removeImage');

    /** Quotation (others) */
    Route::post('quotations/upload-image', 'QuotationController@uploadQuotationImage');
    Route::post('quotations/{quotation}/approve', 'QuotationController@approve');
    Route::get('quotations/{quotation}/print', 'QuotationController@print')->name('quotations.print');

    /** Report */
    Route::get('reports', 'ReportController@index')->name('reports.index');

    /** Dashboard - ADMIN */
    Route::prefix('dashboard')->group(function() {
        Route::get('/', 'DashboardController@index')->name('dashboard.index');
        Route::post('summary-users', 'DashboardController@getSummaryUsers');
    });

    /** Accounts - Resend verification link */
    Route::post('accounts/{user}/resend', 'AccountController@resend');

    Route::resources([
        'accounts'      => 'AccountController',
        'products'      => 'ProductController',
        'quotations'    => 'QuotationController',
        'activity-logs' => 'ActivityLogController'
    ]);
});

/** For clearing server-cache */
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
