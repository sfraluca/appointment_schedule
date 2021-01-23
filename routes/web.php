<?php

// Route::redirect('/', '/login');
Route::get('/', function () {
    return view('landingpage');
});
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@profile')->name('profile');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Clients
    Route::delete('clients/destroy', 'ClientsController@massDestroy')->name('clients.massDestroy');
    Route::resource('clients', 'ClientsController');

    // Employees
    Route::delete('employees/destroy', 'EmployeesController@massDestroy')->name('employees.massDestroy');
    Route::resource('employees', 'EmployeesController');

    // Working Days
    Route::delete('working_days/destroy', 'WorkingDaysController@massDestroy')->name('working_days.massDestroy');
    Route::resource('working_days', 'WorkingDaysController');

    // Working Hours
    Route::delete('working-hours/destroy', 'WorkingHourController@massDestroy')->name('working-hours.massDestroy');
    Route::resource('working-hours', 'WorkingHourController');
    Route::get('/raport', 'WorkingHourController@raport')->name('raport');

    Route::get('/payment', 'PaymentController@payment')->name('payment');
    Route::get('/stripe_form', 'PaymentController@stripe_form')->name('stripe_form');

    Route::post('/salary_save', 'PaymentController@salary_save');

    Route::post('/payment_post', 'PaymentController@payment_post');
    Route::post('/add_days', 'PaymentController@add_days');
    

    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    Route::resource('appointments', 'AppointmentsController');

     // Employment
     Route::delete('employment/destroy', 'EmploymentsController@massDestroy')->name('employments.massDestroy');
     Route::resource('employments', 'EmploymentsController');

    // Projects
    Route::delete('projects/destroy', 'ProjectController@massDestroy')->name('projects.massDestroy');
    Route::resource('projects', 'ProjectController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
