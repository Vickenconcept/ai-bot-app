<?php

use App\Http\Controllers\AskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\MessageController;
use App\Models\Content;
use App\Models\Conversation;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::view('login', 'auth.login')->name('login');
    Route::view('register', 'auth.register')->name('register');
    // Route::view('register/success', 'auth.success')->name('register.success');

    Route::controller(AuthController::class)->prefix('auth')->name('auth.')->group(function () {
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::resource('messages', MessageController::class);
    Route::post('conversations/update', [ConversationController::class, 'updateConversation'])->name('updateConversation');
    Route::resource('conversations', ConversationController::class);
    Route::resource('bots', BotController::class);
    Route::post('contents/update', [ContentController::class, 'updateName'])->name('updateName');
    Route::resource('contents', ContentController::class);
    // Route::delete('documents/delete', [DocumentController::class, ]);
    Route::resource('documents', DocumentController::class);
    Route::get("/ask", AskController::class);

    Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
});


Route::get('test/{id}', function(){
    $contents =  Content::latest()->get();

    $collection = collect($contents);

    $filtered = $collection->except(['price', 'discount']);

    $filtered->all();
});

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return  "all cleared ...";

});



