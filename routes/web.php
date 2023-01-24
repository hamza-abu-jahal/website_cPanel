<?php

use App\Http\Controllers\Dashboard\AboutUsController;
use App\Http\Controllers\Dashboard\BlogsController;
use App\Http\Controllers\Dashboard\MainSectionController;
use App\Http\Controllers\Dashboard\ServicesController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return view('home');
});


Route::get('/', function () {
    return view('dashboard.index');
})->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Start Dashboard Routes
Route::prefix('/admin')
    ->middleware('auth')
    ->group(function() {

        // Start Main Section Routes
        Route::controller(MainSectionController::class)
            ->prefix('main_section')
            ->as('main_section.')
            ->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{id}/edit', 'edit')->name('edit');
                Route::put('/{id}', 'update')->name('update');
                Route::delete('/{id}', 'destroy')->name('delete');
            });
        // End Main Section Routes

        // Start About Us Routes
        Route::controller(AboutUsController::class)
            ->prefix('about_us')
            ->as('about_us.')
            ->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{id}/edit', 'edit')->name('edit');
                Route::put('/{id}', 'update')->name('update');
                Route::delete('/{id}', 'destroy')->name('delete');
            });
        // End About Us Routes

        // Start Services Routes
        Route::controller(ServicesController::class)
            ->prefix('services')
            ->as('service.')
            ->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{id}/edit', 'edit')->name('edit');
                Route::put('/{id}', 'update')->name('update');
                Route::get('/delete', 'destroy')->name('delete');

                /**
                 * ? This Function To Update status
                 */
                Route::get('/change-status', 'changeStatus')->name('changeStatus');

            });
        // End Services Routes

        // Start Blogs Routes
        Route::controller(BlogsController::class)
            ->prefix('blogs')
            ->as('blog.')
            ->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{id}/edit', 'edit')->name('edit');
                Route::put('/{id}', 'update')->name('update');
                Route::get('/delete', 'destroy')->name('delete');

                /**
                 * ? This Function To Update status
                 */
                Route::get('/change-status', 'changeStatus')->name('changeStatus');

            });
        // End Blogs Routes


    });
// End Dashboard Routes
