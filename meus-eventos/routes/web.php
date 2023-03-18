<?php

use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\helloWorldController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

// Rotas par Home Single do site de Eventos
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/evento/{event:slug}', [HomeController::class, 'show'])->name('event.single');

// Enrollment
Route::prefix('/enrollment')->name('enrollment.')->group(
    function () {
        Route::get('/start/{event:slug}', [EnrollmentController::class, 'start'])->name('start');
        Route::get('/confirm', [EnrollmentController::class, 'confirm'])->name('confirm')->middleware(['auth', 'verified']);
        Route::get('/proccess', [EnrollmentController::class, 'proccess'])->name('proccess')->middleware(['auth', 'verified']);
    }
);


Route::get('/hello-world', [helloWorldController::class, 'helloworld']);
Route::get('/hello/{name?}', [helloWorldController::class, 'hello']);


// ROTAS CRUD base da base para eventos...
Route::middleware(['auth', 'verified'])->prefix('/admin')->name('admin.')->group(
    function () {
        Route::resource('events', App\Http\Controllers\Admin\EventController::class);
        Route::resource('events.photos', App\Http\Controllers\Admin\EventPhotoController::class)->only(
            'index',
            'store',
            'destroy'
        );
        Route::get('profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
        Route::Put('profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    }
);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get(
    '/email/verify/{id}/{hash}',
    function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/admin/events');
    }
)->middleware(['auth', 'signed'])->name('verification.verify');

Route::post(
    '/email/verification-notification',
    function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
)->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Auth::routes();
