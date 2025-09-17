<?php
Route::middleware(['auth'])->group(function() {

    Route::middleware(["admin_user"])->group(function() {
        Route::get('reports/tma_report', 'AdminReportController@tmaPropertyReport');
        Route::get('print_tma_report', 'AdminReportController@printTmaPropertyReport');
        Route::get('print_tma_rentOut_report', 'AdminReportController@printTmaRentOutPropertyReport');
        Route::get('print-case/{id?}', 'AdminReportController@printCase');
    });
    Route::middleware(["customer"])->group(function() {
         Route::get('reports/customer_report', 'CustomerReportController@customerPropertyReport');
         Route::get('print_customer_report', 'CustomerReportController@printCustomerPropertyReport');
    });
});