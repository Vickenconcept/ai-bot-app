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
use App\Http\Controllers\JVZooWebhookController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\WarriorPlusWebhookController;
use App\Livewire\CustomizeView;
use App\Models\Content;
use App\Models\Conversation;
use App\Models\User;
use App\Services\AvatarService;
use App\Services\ChatGptService;
use App\Services\GetResponseService;
use App\Services\MailChimpService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Notifications\UpdateUserPassword;
use App\Notifications\UpdateUserRoleNotification;

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
    // return view('welcome');
    return redirect()->to('login');
});

Route::middleware('guest')->group(function () {
    Route::view('login', 'auth.login')->name('login');
    Route::get('forgot-password', [PasswordResetController::class, 'index'])->name('password.request');
    Route::post('forgot-password', [PasswordResetController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'reset'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'update'])->name('password.update');

    Route::controller(AuthController::class)->group(function () {
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('auth/register', 'register')->name('auth.register');
        Route::post('auth/login', 'login')->name('auth.login');
    });
});

Route::resource('guests', GuestController::class);
Route::get('guest/view/{uuid}', [GuestController::class, 'get_one_guest'])->name('get_one_guest');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::post('/home', [DashboardController::class, 'store'])->name('home.store');
    Route::post('/subscribe', [DashboardController::class, 'subscribe'])->name('home.subscribe');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::resource('messages', MessageController::class);
    Route::post('conversations/update', [ConversationController::class, 'updateConversation'])->name('updateConversation');
    // Route::post('conversations/guest', [ConversationController::class, 'guest'])->name('guest');
    Route::resource('conversations', ConversationController::class);
    Route::post('bots/update', [BotController::class, 'update'])->name('updateBot');
    Route::resource('bots', BotController::class);
    Route::post('contents/update', [ContentController::class, 'updateName'])->name('updateName');
    Route::resource('contents', ContentController::class);
    Route::resource('account', AccountController::class);
    Route::resource('reseller', ResellerController::class);
    Route::post('documents/updateData', [DocumentController::class, 'update'])->name('documents.updateData');
    Route::resource('documents', DocumentController::class);
    Route::get('invite', InviteController::class)->name('invite');
    Route::get("/ask", AskController::class);
    Route::view('support', 'support')->name('support');
    Route::view('profile', 'profile')->name('profile');

    Route::view('affiliate_marketing', 'management.affiliate_marketing')->name('affiliate_marketing');
    Route::view('reseller_license', 'management.reseller_license')->name('reseller_license');
    Route::view('dfy_traffic', 'management.dfy_traffic')->name('dfy_traffic');
    Route::view('dfy_ai', 'management.dfy_ai')->name('dfy_ai');

    Route::post('profile/name', [ProfileController::class, 'changeName'])->name('changeName');
    Route::post('profile/password', [ProfileController::class, 'changePassword'])->name('changePassword');
    Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');


    Route::post('uploadfile', UploadFileController::class)->name('uploadfile');
    Route::post('saveLogo', [CustomizeView::class, 'saveLogo'])->name('save_logo');
});

Route::post('/ipn/warriorplus', [WarriorPlusWebhookController::class, 'WPlus']);
Route::post('/ipn/jvzoo', [JVZooWebhookController::class, 'JVZoo']);


Route::get('test/{id}', function () {
    $contents =  Content::latest()->get();

    $collection = collect($contents);

    $filtered = $collection->except(['price', 'discount']);

    $filtered->all();
});

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return  "all cleared ...";
});


Route::get('try', function (Request $request) {
    // bh9uA)v4RB@mO@a9GMq(!BO2D9LO$44

    $user = Auth::user();


    if ($user->hasRole('Bundle')) {
        echo "User is an admin.";
        dd($user->getAllPermissions());
    }
})->withoutMiddleware(['auth'])->name('test');



// Route::get('/reset-users-password', function () {
//     $date = '2024-12-17'; // Specify the date
//     $newPassword = '?X33YY212h!z'; 

//     $users = User::whereDate('created_at', $date)->get();

//     if ($users->isEmpty()) {
//         return response()->json(['message' => 'No users found for the specified date.']);
//     }

//     // Reset password for each user
//     foreach ($users as $user) {
//         $user->password = \Illuminate\Support\Facades\Hash::make($newPassword); // Hash the password
//         $user->save();

//         $userInfo = [
//             'username' => $user->name,
//             'product' => 'AvaterCrew',
//             'password' => $newPassword,
//         ];

//         $user->notify(new UpdateUserPassword($userInfo));
//         $user->notify(new UpdateUserRoleNotification($userInfo));
//     }

//     return response()->json([
//         'message' => 'Passwords reset successfully.',
//         'user_count' => $users->count(),
//     ]);
// });



Route::get('users', function () {
    return User::all();
});
Route::get('update/users', function () {

    $user = User::where('email', 'vicken408@gmail.com')->first();
    if ($user) {
        # code...
        $password = 'pass1234';
        $user->password = bcrypt($password);
        $user->update();
        // $userInfo = [
        //     'username' => $user->name,
        //     'password' => $password
        // ];
        $userInfo = [
            'username' => $user->name,
            'product' => 'hello',
            'password' => 'pass1234',
        ];

        // $user->notify(new UpdateUserPassword($userInfo));
        $user->notify(new UpdateUserRoleNotification($userInfo));
    }
});

Route::get('/create-bot', function () {
    $date = '2024-12-16'; // Specify the date

    $users = User::whereDate('created_at', $date)->get();

    if ($users->isEmpty()) {
        return response()->json(['message' => 'No users found for the specified date.']);
    }

    foreach ($users as $user) {
        // Create a bot for the user
        $user->bots()->create([
            'name' => 'bot',
            'personality' => '',
            'description' => 'an intelligent bot, for all times',
            'knowledge' => '',
            'model' => 'gpt-4',
        ]);
    }

    return response()->json([
        'message' => 'Bots created successfully.',
        'user_count' => $users->count(),
    ]);
});


Route::get('/updat_plan', function () {
    $user = User::whereEmail('shon@shonjimenez.com')->get();

    $productID = '414107';
    $role = \App\Models\Product::where('product_id', $productID)->first();

    if (!$role) {
        return response()->json(['message' => 'Product not found!']);
    }

    if ($user) {
        $user->syncRoles([$role->funnel]);
    }

    $userInfo = [
        'username' => $user->name,
        'product' => $role->funnel,
        'password' => ''
    ];

    $user->notify(new UpdateUserRoleNotification($userInfo));

    return response()->json(['message' => 'User role updated successfully!']);
});
