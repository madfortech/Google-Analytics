<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

Route::get('/auth/redirect', function () {
    return Socialite::driver('google')
    ->redirect();    
});

 

Route::get('auth/callback', function () {
    
    $user = Socialite::driver('google')->stateless()->user();

    $existingUser = User::firstOrNew(['email' => $user->getEmail()]);

    $existingUser->name = $user->getName();
    $existingUser->email_verified_at = now();
    $existingUser->password = Hash::make(Str::random(16));

    $existingUser->save();

    Auth::login($existingUser);
 
    return redirect('/home');
});

// require __DIR__.'/social.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/page-views', [App\Http\Controllers\AnalyticsController::class, 'activeUsers']);
