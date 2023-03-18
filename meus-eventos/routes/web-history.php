<?php

use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\helloWorldController;

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
        Route::get('/confirm', [EnrollmentController::class, 'confirm'])->name('confirm')->middleware('auth');
        Route::get('/proccess', [EnrollmentController::class, 'proccess'])->name('proccess')->middleware('auth');
    }
);

Route::get(
    'queries/{event?}',
    function ($event = null) {
        // $events = \App\Models\Event::all();
        // $events = \App\Models\Event::all(['title', 'description']);
        // $event = \App\Models\Event::where('id', 1)->first();
        // $event = \App\Models\Event::find($event);

        /*$event = new \App\Models\Event();
        $event->title = 'Evento via Eloquent e AR';
        $event->description = 'Descricao do Evento';
        $event->body = 'Coteudo do evento....';
        $event->start_event = date('Y-m-d H:i:s');
        $event->slug = \Illuminate\Support\Str::slug($event->title);
        return $event->save();*/

        /*$event = \App\Models\Event::find(31);
        $event->title = 'Evento Atualizado...';
        $event->slug = \Illuminate\Support\Str::slug($event->title);
        return $event->save();*/

        /*$event = [
            'title' => 'Evento Atribuição em Massa',
            'description' => 'Descrição...',
            'body' => 'Conteudo do Evento',
            'slug' => 'evento-atribuição-em-massa',
            'start_event' => date('Y-m-d H:i:s'),
        ];
        return \App\Models\Event::create($event);*/

        /*$eventData = [
            'title' => 'Evento Atribuição em Massa Atualizado',
            'description' => 'Descrição... Atualizado',
            'body' => 'Conteudo do Evento Atualizado',
            'slug' => 'evento-atribuição-em-massa Atualizado',
            'start_event' => date('Y-m-d H:i:s'),
        ];
        $event = \App\Models\Event::find(30);
        return $event->update($eventData);*/

        /*$event = \App\Models\Event::findOrFail(33);
        return $event->delete();*/

//    return \App\Models\Event::destroy([30, 31, 32]);
        return Event::orderBy('id', 'DESC')->limit(3)->get();

        return $event;
    }
);

Route::get('/hello-world', [helloWorldController::class, 'helloworld']);
Route::get('/hello/{name?}', [helloWorldController::class, 'hello']);

// ROTAS CRUD base da base para eventos...
Route::middleware('auth')->prefix('/admin')->name('admin.')->group(
    callback: function () {
    /*Route::prefix('/events')->name('events.')->group(
        function () {
            Route::get('/', [App\Http\Controllers\Admin\EventController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\EventController::class, 'create'])->name('create');
            Route::post('/store', [App\Http\Controllers\Admin\EventController::class, 'store'])->name('store');
            Route::get('/{event}/edit', [App\Http\Controllers\Admin\EventController::class, 'edit'])->name('edit');
            Route::post('/update/{event}', [App\Http\Controllers\Admin\EventController::class, 'update'])->name(
                'update'
            );
            Route::get('/destroy/{event}', [App\Http\Controllers\Admin\EventController::class, 'destroy'])->name(
                'destroy'
            );
        }
    );*/

    Route::resource('events', App\Http\Controllers\Admin\EventController::class);
    Route::resource('events.photos', App\Http\Controllers\Admin\EventPhotoController::class)->only(
        'index',
        'store',
        'destroy'
    );
    /*Route::resources(
        [
            'events', App\Http\Controllers\Admin\EventController::class,
            'events.photos', App\Http\Controllers\Admin\EventPhotoController::class
        ],
        [
           'except' => ['destroy']
        ]
    );*/
}
);


Auth::routes();
