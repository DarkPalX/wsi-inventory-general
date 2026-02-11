<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\{DashboardController, FrontController};
use App\Http\Controllers\Settings\{UserController, RoleController, AccessController, PermissionController};
use App\Http\Controllers\Custom\{ItemController, ItemCategoryController, ItemTypeController, ItemUnitController, SupplierController, PurchaseOrderController, ReceivingController, ReceiverController, VehicleController, EmployeeController, RequisitionController, IssuanceController, ParController, ReportsController, FsiReportsController, DivisionController, SectionController};

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



Auth::routes();


Route::get('/signup', [FrontController::class, 'signup'])->name('signup');
Route::post('/submit_registration', [FrontController::class, 'submit_registration'])->name('submit-registration');

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    return "All caches cleared!";
});

Route::group(['middleware' => 'admin'], function (){

    Route::get('/reset-db', function () {
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
    
        return 'Database reset and seeded successfully.';
    });

    Route::get('/', [FrontController::class, 'home'])->name('home');
    Route::get('/home', [FrontController::class, 'home'])->name('home');
    Route::get('/privacy-policy/', [FrontController::class, 'privacy_policy'])->name('privacy-policy');
    Route::post('/contact-us', [FrontController::class, 'contact_us'])->name('contact-us');
    Route::get('/search', [FrontController::class, 'search'])->name('search');

    Route::get('/search-result',[FrontController::class, 'search_result'])->name('search.result');



    // ITEM MANAGENMENT

    Route::group(['prefix' => 'items', 'as' => 'items.'], function () {
        // ITEMS
        Route::resource('/', ItemController::class)->parameters(['' => 'item'])->except(['show']);
        Route::post('/single-delete', [ItemController::class, 'single_delete'])->name('single-delete');
        Route::post('/multiple-delete', [ItemController::class, 'multiple_delete'])->name('multiple-delete');
        Route::post('/single-restore', [ItemController::class, 'single_restore'])->name('single-restore');
        Route::post('/multiple-restore', [ItemController::class, 'multiple_restore'])->name('multiple-restore');
        Route::get('info/{info}', [ItemController::class, 'show'])->name('show');
        Route::get('stock-card/{id}', [ItemController::class, 'stock_card'])->name('stock-card');

        // CATEGORIES
        Route::group(['middleware' => function ($request, $next) {
            return RolePermission::has_permission(5,auth()->user()->role_id,6) == 1 || auth()->user()->role_id == 1 ? $next($request) : abort(403);
            // return auth()->user()->role_id == 1 ? $next($request) : abort(403);
        }], function () {
            Route::resource('categories', ItemCategoryController::class);
        });
        Route::post('categories/single-delete', [ItemCategoryController::class, 'single_delete'])->name('categories.single-delete');
        Route::post('categories/multiple-delete', [ItemCategoryController::class, 'multiple_delete'])->name('categories.multiple-delete');
        Route::post('categories/single-restore', [ItemCategoryController::class, 'single_restore'])->name('categories.single-restore');
        Route::post('categories/multiple-restore', [ItemCategoryController::class, 'multiple_restore'])->name('categories.multiple-restore');

        // TYPES
        Route::group(['middleware' => function ($request, $next) {
            return RolePermission::has_permission(5,auth()->user()->role_id,6) == 1 || auth()->user()->role_id == 1 ? $next($request) : abort(403);
        }], function () {
            Route::resource('types', ItemTypeController::class);
        });
        Route::post('types/single-delete', [ItemTypeController::class, 'single_delete'])->name('types.single-delete');
        Route::post('types/multiple-delete', [ItemTypeController::class, 'multiple_delete'])->name('types.multiple-delete');
        Route::post('types/single-restore', [ItemTypeController::class, 'single_restore'])->name('types.single-restore');
        Route::post('types/multiple-restore', [ItemTypeController::class, 'multiple_restore'])->name('types.multiple-restore');

        // UNITS
        Route::group(['middleware' => function ($request, $next) {
            return RolePermission::has_permission(5,auth()->user()->role_id,6) == 1 || auth()->user()->role_id == 1 ? $next($request) : abort(403);
        }], function () {
            Route::resource('units', ItemUnitController::class);
        });
        Route::post('units/single-delete', [ItemUnitController::class, 'single_delete'])->name('units.single-delete');
        Route::post('units/multiple-delete', [ItemUnitController::class, 'multiple_delete'])->name('units.multiple-delete');
        Route::post('units/single-restore', [ItemUnitController::class, 'single_restore'])->name('units.single-restore');
        Route::post('units/multiple-restore', [ItemUnitController::class, 'multiple_restore'])->name('units.multiple-restore');
        
    });
    
    

    // RECEIVING

    Route::group(['prefix' => 'receiving', 'as' => 'receiving.'], function () {
        // PURCHASE ORDER
        Route::resource('purchase-orders', PurchaseOrderController::class)->except('show');
        Route::post('purchase-orders/single-delete', [PurchaseOrderController::class, 'single_delete'])->name('purchase-orders.single-delete');
        Route::post('purchase-orders/multiple-delete', [PurchaseOrderController::class, 'multiple_delete'])->name('purchase-orders.multiple-delete');
        Route::post('purchase-orders/single-restore', [PurchaseOrderController::class, 'single_restore'])->name('purchase-orders.single-restore');
        Route::post('purchase-orders/multiple-restore', [PurchaseOrderController::class, 'multiple_restore'])->name('purchase-orders.multiple-restore');
        Route::post('purchase-orders/single-post', [PurchaseOrderController::class, 'single_post'])->name('purchase-orders.single-post');
        Route::get('purchase-orders/search-item', [PurchaseOrderController::class, 'search_item'])->name('purchase-orders.search-item');
        Route::get('purchase-orders/show', [PurchaseOrderController::class, 'show'])->name('purchase-orders.show');
        
        // TRANSACTIONS
        Route::resource('transactions', ReceivingController::class)->except('show');
        Route::post('transactions/single-delete', [ReceivingController::class, 'single_delete'])->name('transactions.single-delete');
        Route::post('transactions/multiple-delete', [ReceivingController::class, 'multiple_delete'])->name('transactions.multiple-delete');
        Route::post('transactions/single-restore', [ReceivingController::class, 'single_restore'])->name('transactions.single-restore');
        Route::post('transactions/multiple-restore', [ReceivingController::class, 'multiple_restore'])->name('transactions.multiple-restore');
        Route::post('transactions/single-post', [ReceivingController::class, 'single_post'])->name('transactions.single-post');
        Route::get('transactions/search-item', [ReceivingController::class, 'search_item'])->name('transactions.search-item');
        Route::get('transactions/search-po-number', [ReceivingController::class, 'search_po_number'])->name('transactions.search-po-number');
        Route::get('transactions/search-purchased-item', [ReceivingController::class, 'search_purchased_item'])->name('transactions.search-purchased-item');
        Route::get('transactions/show', [ReceivingController::class, 'show'])->name('transactions.show');
        // Route::get('transactions/{transaction}', [ReceivingController::class, 'show'])->name('transactions.show');
        
        // SUPPLIERS
        Route::group(['middleware' => function ($request, $next) {
            return RolePermission::has_permission(5,auth()->user()->role_id,6) == 1 || auth()->user()->role_id == 1 ? $next($request) : abort(403);
        }], function () {
            Route::resource('suppliers', SupplierController::class);
        });
        Route::post('suppliers/single-delete', [SupplierController::class, 'single_delete'])->name('suppliers.single-delete');
        Route::post('suppliers/multiple-delete', [SupplierController::class, 'multiple_delete'])->name('suppliers.multiple-delete');
        Route::post('suppliers/single-restore', [SupplierController::class, 'single_restore'])->name('suppliers.single-restore');
        Route::post('suppliers/multiple-restore', [SupplierController::class, 'multiple_restore'])->name('suppliers.multiple-restore');
    });
    


    // ISSUANCE

    Route::group(['prefix' => 'issuance', 'as' => 'issuance.'], function () {
        // REQUISITION
        Route::resource('requisitions', RequisitionController::class)->except('show');
        Route::post('requisitions/single-delete', [RequisitionController::class, 'single_delete'])->name('requisitions.single-delete');
        Route::post('requisitions/multiple-delete', [RequisitionController::class, 'multiple_delete'])->name('requisitions.multiple-delete');
        Route::post('requisitions/single-restore', [RequisitionController::class, 'single_restore'])->name('requisitions.single-restore');
        Route::post('requisitions/multiple-restore', [RequisitionController::class, 'multiple_restore'])->name('requisitions.multiple-restore');
        Route::post('requisitions/single-post', [RequisitionController::class, 'single_post'])->name('requisitions.single-post');
        Route::get('requisitions/search-item', [RequisitionController::class, 'search_item'])->name('requisitions.search-item');
        Route::get('requisitions/show', [RequisitionController::class, 'show'])->name('requisitions.show');
        Route::post('requisitions/create-issuance', [RequisitionController::class, 'create_issuance'])->name('requisitions.create-issuance');
        Route::post('requisitions/edit-issuance', [RequisitionController::class, 'edit_issuance'])->name('requisitions.edit-issuance');
        Route::get('requisitions/show-issuance/{id}', [RequisitionController::class, 'show_issuance'])->name('requisitions.show-issuance');

        // TRANSACTIONS
        Route::resource('transactions', IssuanceController::class)->except('show');
        Route::post('transactions/single-delete', [IssuanceController::class, 'single_delete'])->name('transactions.single-delete');
        Route::post('transactions/multiple-delete', [IssuanceController::class, 'multiple_delete'])->name('transactions.multiple-delete');
        Route::post('transactions/single-restore', [IssuanceController::class, 'single_restore'])->name('transactions.single-restore');
        Route::post('transactions/multiple-restore', [IssuanceController::class, 'multiple_restore'])->name('transactions.multiple-restore');
        Route::post('transactions/single-post', [IssuanceController::class, 'single_post'])->name('transactions.single-post');
        Route::get('transactions/search-item', [IssuanceController::class, 'search_item'])->name('transactions.search-item');
        Route::get('transactions/search-receiver', [IssuanceController::class, 'search_receiver'])->name('transactions.search-receiver');
        Route::get('transactions/search-existing-barcode', [IssuanceController::class, 'search_existing_barcode'])->name('transactions.search-existing-barcode');

        Route::get('transactions/show', [IssuanceController::class, 'show'])->name('transactions.show');
        Route::get('transactions/print-barcode', [IssuanceController::class, 'print_barcode'])->name('transactions.print-barcode');
        // Route::get('transactions/{transaction}', [IssuanceController::class, 'show'])->name('transactions.show');
        
        // RECEIVERS
        Route::group(['middleware' => function ($request, $next) {
            return RolePermission::has_permission(5,auth()->user()->role_id,6) == 1 || auth()->user()->role_id == 1 ? $next($request) : abort(403);
        }], function () {
            Route::resource('receivers', ReceiverController::class);
        });

        Route::post('receivers/single-delete', [ReceiverController::class, 'single_delete'])->name('receivers.single-delete');
        Route::post('receivers/multiple-delete', [ReceiverController::class, 'multiple_delete'])->name('receivers.multiple-delete');
        Route::post('receivers/single-restore', [ReceiverController::class, 'single_restore'])->name('receivers.single-restore');
        Route::post('receivers/multiple-restore', [ReceiverController::class, 'multiple_restore'])->name('receivers.multiple-restore');
        
        // VEHICLES
        Route::group(['middleware' => function ($request, $next) {
            return RolePermission::has_permission(5,auth()->user()->role_id,6) == 1 || auth()->user()->role_id == 1 ? $next($request) : abort(403);
        }], function () {
            Route::resource('vehicles', VehicleController::class);
        });

        Route::post('vehicles/single-delete', [VehicleController::class, 'single_delete'])->name('vehicles.single-delete');
        Route::post('vehicles/multiple-delete', [VehicleController::class, 'multiple_delete'])->name('vehicles.multiple-delete');
        Route::post('vehicles/single-restore', [VehicleController::class, 'single_restore'])->name('vehicles.single-restore');
        Route::post('vehicles/multiple-restore', [VehicleController::class, 'multiple_restore'])->name('vehicles.multiple-restore');

        // EMPLOYEES
        Route::group(['middleware' => function ($request, $next) {
            return RolePermission::has_permission(5,auth()->user()->role_id,6) == 1 || auth()->user()->role_id == 1 ? $next($request) : abort(403);
        }], function () {
            Route::resource('employees', EmployeeController::class);
        });
        Route::post('employees/single-delete', [EmployeeController::class, 'single_delete'])->name('employees.single-delete');
        Route::post('employees/multiple-delete', [EmployeeController::class, 'multiple_delete'])->name('employees.multiple-delete');
        Route::post('employees/single-restore', [EmployeeController::class, 'single_restore'])->name('employees.single-restore');
        Route::post('employees/multiple-restore', [EmployeeController::class, 'multiple_restore'])->name('employees.multiple-restore');
        Route::get('employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    });


    // PAR
    Route::group(['prefix' => 'par', 'as' => 'par.'], function () {
        // TRANSACTIONS
        Route::resource('transactions', ParController::class);
        Route::post('items/single-close', [ParController::class, 'single_close'])->name('items.single-close');
        Route::post('items/single-transfer', [ParController::class, 'single_transfer'])->name('items.single-transfer');
        Route::post('items/single-borrow', [ParController::class, 'single_borrow'])->name('items.single-borrow');
        Route::post('items/single-return', [ParController::class, 'single_return'])->name('items.single-return');
        Route::get('info/{id}', [ParController::class, 'show'])->name('show');
        Route::get('attachments/{id}', [ParController::class, 'attachments'])->name('transactions.attachments');
        Route::post('attachments/upload', [ParController::class, 'upload'])->name('transactions.attachments.upload');
        Route::get('/user/transactions', [ParController::class, 'user_transactions'])->name('transactions.user');
    });
    

    // ACCOUNTS MANAGENMENT
    Route::group(['prefix' => 'accounts', 'as' => 'accounts.'], function () {
        // USERS
        Route::group(['middleware' => function ($request, $next) {
            return RolePermission::has_permission(5,auth()->user()->role_id,6) == 1 || auth()->user()->role_id == 1 ? $next($request) : abort(403);
        }], function () {
            Route::resource('users', UserController::class);
        });
        Route::post('users/single-delete', [UserController::class, 'single_delete'])->name('users.single-delete');
        Route::post('users/multiple-delete', [UserController::class, 'multiple_delete'])->name('users.multiple-delete');
        Route::post('users/single-restore', [UserController::class, 'single_restore'])->name('users.single-restore');
        Route::post('users/multiple-restore', [UserController::class, 'multiple_restore'])->name('users.multiple-restore');

        Route::get('user/edit-profile', [UserController::class, 'edit_profile'])->name('users.edit-profile');
        Route::post('user/update-profile', [UserController::class, 'update_profile'])->name('users.update-profile');
        Route::post('user/update-email', [UserController::class, 'update_email'])->name('users.update-email');
        Route::post('user/update-password', [UserController::class, 'update_password'])->name('users.update-password');
        Route::post('user/user-update-password', [UserController::class, 'user_update_password'])->name('users.user-update-password');
        Route::post('user/update-avatar', [UserController::class, 'update_avatar'])->name('users.update-avatar');
        
        // ROLES
        Route::group(['middleware' => function ($request, $next) {
            return RolePermission::has_permission(5,auth()->user()->role_id,6) == 1 || auth()->user()->role_id == 1 ? $next($request) : abort(403);
        }], function () {
            Route::resource('roles', RoleController::class);
        });
        Route::post('roles/single-delete', [RoleController::class, 'single_delete'])->name('roles.single-delete');
        Route::post('roles/multiple-delete', [RoleController::class, 'multiple_delete'])->name('roles.multiple-delete');
        Route::post('roles/single-restore', [RoleController::class, 'single_restore'])->name('roles.single-restore');
        Route::post('roles/multiple-restore', [RoleController::class, 'multiple_restore'])->name('roles.multiple-restore');

        // ACCESS
        Route::resource('/access', AccessController::class);
        Route::post('/roles_and_permissions/update', [AccessController::class, 'update_roles_and_permissions'])->name('role-permission.update');

        // PERMISSION
        Route::group(['middleware' => function ($request, $next) {
            return RolePermission::has_permission(5,auth()->user()->role_id,6) == 1 || auth()->user()->role_id == 1 ? $next($request) : abort(403);
        }], function () {
            Route::resource('/permissions', PermissionController::class)->except(['destroy']);
        });
        Route::post('permission/update-permissions', [PermissionController::class, 'update_permissions'])->name('permissions.update-permissions');
        Route::post('permission/single-delete', [PermissionController::class, 'single_delete'])->name('permissions.single-delete');
        Route::post('permission/multiple-delete', [PermissionController::class, 'multiple_delete'])->name('permissions.multiple-delete');
        Route::post('permission/single-restore', [PermissionController::class, 'single_restore'])->name('permissions.single-restore');
        Route::post('permission/multiple-restore', [PermissionController::class, 'multiple_restore'])->name('permissions.multiple-restore');
        // Route::get('/permission-search/', [PermissionController::class, 'search'])->name('permission.search');
        // Route::post('/permission/destroy', [PermissionController::class, 'destroy'])->name('permission.destroy');
        // Route::get('/permission/restore/{id}', [PermissionController::class, 'restore'])->name('permission.restore');
        // Route::post('permission/delete', [PermissionController::class, 'delete'])->name('permission.delete');

        // DIVISIONS
        Route::group(['middleware' => function ($request, $next) {
            return RolePermission::has_permission(5,auth()->user()->role_id,6) == 1 || auth()->user()->role_id == 1 ? $next($request) : abort(403);
        }], function () {
            Route::resource('divisions', DivisionController::class);
        });
        Route::post('divisions/single-delete', [DivisionController::class, 'single_delete'])->name('divisions.single-delete');
        Route::post('divisions/multiple-delete', [DivisionController::class, 'multiple_delete'])->name('divisions.multiple-delete');
        Route::post('divisions/single-restore', [DivisionController::class, 'single_restore'])->name('divisions.single-restore');
        Route::post('divisions/multiple-restore', [DivisionController::class, 'multiple_restore'])->name('divisions.multiple-restore');

        // SECTIONS
        Route::group(['middleware' => function ($request, $next) {
            return RolePermission::has_permission(5,auth()->user()->role_id,6) == 1 || auth()->user()->role_id == 1 ? $next($request) : abort(403);
        }], function () {
            Route::resource('sections', SectionController::class);
        });
        Route::post('sections/single-delete', [SectionController::class, 'single_delete'])->name('sections.single-delete');
        Route::post('sections/multiple-delete', [SectionController::class, 'multiple_delete'])->name('sections.multiple-delete');
        Route::post('sections/single-restore', [SectionController::class, 'single_restore'])->name('sections.single-restore');
        Route::post('sections/multiple-restore', [SectionController::class, 'multiple_restore'])->name('sections.multiple-restore');
    });

    

    // REPORTS
    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        
        Route::get('issuance', [ReportsController::class, 'issuance'])->name('issuance');
        Route::get('requisitions', [ReportsController::class, 'requisitions'])->name('requisitions');
        Route::get('receiving', [ReportsController::class, 'receiving'])->name('receiving');
        Route::get('receivables', [ReportsController::class, 'receivables'])->name('receivables');
        Route::get('stock-card', [ReportsController::class, 'stock_card'])->name('stock-card');
        // Route::get('stock-card/{id}', [ReportsController::class, 'stock_card'])->name('stock-card');
        Route::get('inventory', [ReportsController::class, 'inventory'])->name('inventory');
        Route::get('users', [ReportsController::class, 'users'])->name('users');
        Route::get('audit-trail', [ReportsController::class, 'audit_trail'])->name('audit-trail');
        Route::get('items', [ReportsController::class, 'items'])->name('items');
        Route::get('deficit-items', [ReportsController::class, 'deficit_items'])->name('deficit-items');
        Route::get('fast-moving-items', [ReportsController::class, 'fast_moving_items'])->name('fast-moving-items');
        Route::post('log-export-activity', [ReportsController::class, 'log_export_activity'])->name('log-export-activity');

    });

    

    // FSI REPORTS
    Route::group(['prefix' => 'reports-fsi', 'as' => 'reports-fsi.'], function () {
        
        Route::get('stock-card', [FsiReportsController::class, 'stock_card'])->name('stock-card');
        Route::get('inventory-custodian', [FsiReportsController::class, 'inventory_custodian'])->name('inventory-custodian');
        Route::get('inventory-physical-count', [FsiReportsController::class, 'inventory_physical_count'])->name('inventory-physical-count');
        Route::get('property-card', [FsiReportsController::class, 'property_card'])->name('property-card');
        Route::get('property-acknowledgement-receipt', [FsiReportsController::class, 'property_acknowledgement_receipt'])->name('property-acknowledgement-receipt');
        Route::get('property-plant-equipment-count', [FsiReportsController::class, 'property_plant_equipment_count'])->name('property-plant-equipment-count');
        Route::get('unserviceable-property-inspection', [FsiReportsController::class, 'unserviceable_property_inspection'])->name('unserviceable-property-inspection');
        Route::get('property-transfer', [FsiReportsController::class, 'property_transfer'])->name('property-transfer');
        Route::post('log-export-activity', [ReportsController::class, 'log_export_activity'])->name('log-export-activity');

    });

});