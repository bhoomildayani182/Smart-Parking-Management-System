<?php

use App\Http\Controllers\DriverAndCleanerController;
use App\Http\Controllers\ParkingSpace\SlotPricingController;
use App\Http\Controllers\ParkingSpace\CityController;
use App\Http\Controllers\ParkingSpace\CountryController;
use App\Http\Controllers\ParkingSpace\NumberPlateController;
use App\Http\Controllers\ParkingSpace\SlotController;
use App\Http\Controllers\ParkingSpace\StateController;
use App\Http\Controllers\ParkingSpace\ParkingController;
use App\Http\Controllers\ParkingSpace\ParkingSlotDetailsController;
use App\Http\Controllers\ParkingSpace\ParkingSlotsController;
use App\Http\Controllers\ParkingSpace\UserController;
use App\Http\Controllers\ParkingSpace\VehicleModelController;
use App\Http\Controllers\ParkingSpace\EntryBookingController;
use App\Http\Controllers\ParkingSpace\ExitBookingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth'])->group(function () {

    Route::group(['prefix' => 'country'], function(){

        Route::get('/', [CountryController::class, 'index'])->name('country.list');

        Route::get('/{country}', [CountryController::class, 'show'])->whereNumber('country');

        Route::get('/create', [CountryController::class, 'create'])->name('country.create');

        Route::post('/store', [CountryController::class, 'store'])->name('country.store');

        Route::get('/edit/{country}', [CountryController::class, 'edit'])->name('country.update')->whereNumber('country');

        Route::put('/edit/{country}', [CountryController::class, 'update'])->name('country.edit');

        Route::get('/delete/{country}', [CountryController::class, 'destroy'])->name('country.delete')->whereNumber('country');
    });

    Route::group(['prefix' => 'state'], function(){

        Route::get('/', [StateController::class, 'index'])->name('state.list');

        Route::get('/{state}', [StateController::class, 'show'])->whereNumber('state');

        Route::get('/create', [StateController::class, 'create'])->name('state.create');

        Route::post('/store', [StateController::class, 'store'])->name('stateStore');


        Route::get('/edit/{state}', [StateController::class, 'edit'])->name('state.update')->whereNumber('state');

        Route::put('/edit/{state}', [StateController::class, 'update'])->name('state.edit');

        Route::get('/delete/{state}', [StateController::class, 'destroy'])->name('state.delete')->whereNumber('state');
    });

    Route::group(['prefix' => 'city'], function(){

        Route::get('/', [CityController::class, 'index'])->name('city.list');

        Route::get('/{city}', [CityController::class, 'show'])->whereNumber('city');

        Route::get('/create', [CityController::class, 'create'])->name('city.create');

        Route::post('/store', [CityController::class, 'store'])->name('city.store');

        Route::get('/edit/{city}', [CityController::class, 'edit'])->name('city.update')->whereNumber('city');

        Route::put('/edit/{city}', [CityController::class, 'update'])->name('city.edit');

        Route::get('/delete/{city}', [CityController::class, 'destroy'])->name('city.delete')->whereNumber('city');
    });

    Route::group(['prefix' => 'parking'], function(){

        Route::get('/', [ParkingController::class, 'index'])->name('parking.list');

        Route::get('/{parking}', [ParkingController::class, 'show'])->whereNumber('parking');

        Route::get('/create', [ParkingController::class, 'create'])->name('parking.create');

        Route::post('/store', [ParkingController::class, 'store'])->name('parking.store');

        Route::get('/edit/{parking}', [ParkingController::class, 'edit'])->name('parking.update')->whereNumber('parking');

        Route::put('/edit/{parking}', [ParkingController::class, 'update'])->name('parking.edit');

        Route::get('/delete/{parking}', [ParkingController::class, 'destroy'])->name('parking.delete')->whereNumber('parking');
    });

    Route::group(['prefix' => 'parking-slots'], function(){

        Route::get('/', [ParkingSlotsController::class, 'index'])->name('parking_slots.list');

        Route::get('/{parkingslot}', [ParkingSlotsController::class, 'show'])->whereNumber('parkingslot');

        Route::get('/create', [ParkingSlotsController::class, 'create'])->name('parking_slots.create');

        Route::post('/store', [ParkingSlotsController::class, 'store'])->name('parking_slots.store');

        Route::get('/edit/{parkingslot}', [ParkingSlotsController::class, 'edit'])->name('parking_slots.edit')->whereNumber('parkingslot');

        Route::put('/edit/{parkingslot}', [ParkingSlotsController::class, 'update'])->name('parking_slots.update');

        Route::get('/delete/{parkingslot}', [ParkingSlotsController::class, 'destroy'])->name('parking_slots.delete')->whereNumber('parkingslot');
    });

    Route::get('/parking-slot-details/{parkingslot}', [ParkingSlotsController::class, 'getParkingSlotDetails'])->name('parking-slot-details.index');

    Route::resource('number-plate',NumberPlateController::class);

    Route::resource('vehicle-models',VehicleModelController::class);
    Route::resource('slot',SlotController::class);

    Route::resource('user',UserController::class);

    Route::resource('entry-booking', EntryBookingController::class);
    Route::get('/slot-pricing/get-price/{vehicle}/{slot}', [EntryBookingController::class, 'get_price']);
    Route::resource('driver-and-cleaner', DriverAndCleanerController::class);

    Route::resource('exit-booking', ExitBookingController::class);
    Route::get('/get-booking/{vehicle_number}', [ExitBookingController::class, 'get_booking']);
    Route::get('/get-number-plates/{vehicle_number}', [ExitBookingController::class, 'get_number_plates']);
    Route::get('/get-vehicle/{vehicle_number}', [VehicleController::class, 'get_vehicle']);


});



Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

// Route::get('/roles', [PermissionController::class,'Permission']);

Route::get('/user-role',[UserRoleController::class,'index'])->name('userRole.index');;
Route::get('/user-role/create',[UserRoleController::class,'create'])->name('userRole.create');
Route::post('/user-role/store',[UserRoleController::class,'store'])->name('userRole.store');

Route::get('/items/filter', [UserRoleController::class,'index'])->name('items.filter');

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');




Route::group(['prefix' => 'city'], function(){

    // Route::get('/', [B2CPricingController::class, 'index'])->name('B2CPricing')->withoutMiddleware(['permissions.check']);

    // Route::get('/{b2cPricingId}', [B2CPricingController::class, 'show'])->name('B2CPricingDetail');

    // Route::post('/', [B2CPricingController::class, 'store'])->name('CreateB2CPricing')->middleware('duplicate.check');

    // Route::post('/bulk', [B2CPricingController::class, 'bulkUpdate'])->name('BulkUpdateB2CPricing');

    // Route::put('/{b2cPricingId}', [B2CPricingController::class, 'update'])->name('UpdateB2CPricing');

    // Route::delete('/{b2cPricingId}', [B2CPricingController::class, 'destroy'])->name('DeleteB2CPricing');

});

Route::resource('slots-pricing',SlotPricingController::class);
