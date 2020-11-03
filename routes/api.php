<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Clients
    Route::apiResource('clients', 'ClientsApiController');

    // Employees
    Route::apiResource('employees', 'EmployeesApiController');

    // Working Hours
    Route::apiResource('working-hours', 'WorkingHourApiController');

    // Appointments
    Route::apiResource('appointments', 'AppointmentsApiController');

    // Projects
    Route::apiResource('projects', 'ProjectApiController');
});
