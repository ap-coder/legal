<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Content Categories
    Route::apiResource('content-categories', 'ContentCategoryApiController');

    // Content Tags
    Route::apiResource('content-tags', 'ContentTagApiController');

    // Content Pages
    Route::post('content-pages/media', 'ContentPageApiController@storeMedia')->name('content-pages.storeMedia');
    Route::apiResource('content-pages', 'ContentPageApiController');

    // Crm Statuses
    Route::apiResource('crm-statuses', 'CrmStatusApiController');

    // Crm Customers
    Route::apiResource('crm-customers', 'CrmCustomerApiController');

    // Crm Notes
    Route::apiResource('crm-notes', 'CrmNoteApiController');

    // Crm Documents
    Route::post('crm-documents/media', 'CrmDocumentApiController@storeMedia')->name('crm-documents.storeMedia');
    Route::apiResource('crm-documents', 'CrmDocumentApiController');

    // Court Dates
    Route::post('court-dates/media', 'CourtDateApiController@storeMedia')->name('court-dates.storeMedia');
    Route::apiResource('court-dates', 'CourtDateApiController');

    // Court Cases
    Route::apiResource('court-cases', 'CourtCaseApiController');

    // Courthouses
    Route::apiResource('courthouses', 'CourthouseApiController');

    // Posts
    Route::post('posts/media', 'PostApiController@storeMedia')->name('posts.storeMedia');
    Route::apiResource('posts', 'PostApiController');

    // Attorneys
    Route::post('attorneys/media', 'AttorneyApiController@storeMedia')->name('attorneys.storeMedia');
    Route::apiResource('attorneys', 'AttorneyApiController');

    // Employees
    Route::post('employees/media', 'EmployeeApiController@storeMedia')->name('employees.storeMedia');
    Route::apiResource('employees', 'EmployeeApiController');

    // Faq Categories
    Route::apiResource('faq-categories', 'FaqCategoryApiController');

    // Faq Questions
    Route::apiResource('faq-questions', 'FaqQuestionApiController');

    // Services
    Route::post('services/media', 'ServicesApiController@storeMedia')->name('services.storeMedia');
    Route::apiResource('services', 'ServicesApiController');

    // Accounts
    Route::apiResource('accounts', 'AccountApiController');

});
