<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
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
    // Route::view('register', 'auth.register')->name('register');
    // Route::view('register/success', 'auth.success')->name('register.success');
    
    Route::controller(AuthController::class)->group(function () {
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('auth/register', 'register')->name('auth.register');
        Route::post('auth/login', 'login')->name('auth.login');
    });
});
Route::resource('guests', GuestController::class);
// Route::resource('guests', GuestController::class)->middleware('checkRouteStatus:guests.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::resource('messages', MessageController::class);
    Route::post('conversations/update', [ConversationController::class, 'updateConversation'])->name('updateConversation');
    // Route::post('conversations/guest', [ConversationController::class, 'guest'])->name('guest');
    Route::resource('conversations', ConversationController::class);
    Route::resource('bots', BotController::class);
    Route::post('contents/update', [ContentController::class, 'updateName'])->name('updateName');
    Route::resource('contents', ContentController::class);
    Route::resource('account', AccountController::class);
    Route::post('documents/updateData', [DocumentController::class, 'update'])->name('documents.updateData');
    Route::resource('documents', DocumentController::class);
    Route::get('invite', InviteController::class)->name('invite');
    Route::get("/ask", AskController::class);
    Route::view('support', 'support')->name('support');
    Route::view('profile', 'profile')->name('profile');
    Route::post('profile/name', [ProfileController::class, 'changeName'])->name('changeName');
    Route::post('profile/password', [ProfileController::class, 'changePassword'])->name('changePassword');
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
Route::get('test', function(){
  
    $user = auth()->user();
    dd($user->generateReferralLink());
    return Conversation::findOrfail(29);
})->withoutMiddleware(['auth']);;



