<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Route::get('/reclamations', 'ReclamationController@create')->name('rec');
Route::get('/', function () {
    $route = Gate::denies('dashboard_access') ? 'admin.home' : 'admin.home';
    if (session('status')) {
        return redirect()->route($route)->with('status', session('status'));
    }

    return redirect()->route($route);
});

Auth::routes(['/register' => false]);

 Route::post('reclamations/media', 'ReclamationController@storeMedia')->name('reclamations.storeMedia');
 Route::post('reclamations/comment/{reclamation}', 'ReclamationController@storeComment')->name('reclamations.storeComment');
 Route::resource('reclamations', 'ReclamationController')->only(['show', 'create', 'store']);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Articles
    Route::delete('articles/destroy', 'ArticlesController@massDestroy')->name('articles.massDestroy');
    Route::resource('articles', 'ArticlesController');

    // Statuses
    Route::delete('statuses/destroy', 'StatusesController@massDestroy')->name('statuses.massDestroy');
    Route::resource('statuses', 'StatusesController');

    // Priorities
    Route::delete('priorities/destroy', 'PrioritiesController@massDestroy')->name('priorities.massDestroy');
    Route::resource('priorities', 'PrioritiesController');

    // Categories
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');

    // Tickets
    Route::delete('reclamations/destroy', 'ReclamationsController@massDestroy')->name('reclamations.massDestroy');
    Route::post('reclamations/media', 'ReclamationsController@storeMedia')->name('reclamations.storeMedia');
    Route::post('reclamations/comment/{reclamtion}', 'ReclamationsController@storeComment')->name('reclamations.storeComment');
    Route::resource('reclamations', 'ReclamationsController');

    // Comments
    Route::delete('comments/destroy', 'CommentsController@massDestroy')->name('comments.massDestroy');
    Route::resource('comments', 'CommentsController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
});