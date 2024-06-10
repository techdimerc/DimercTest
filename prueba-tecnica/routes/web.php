<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GoogleAuthController;


use App\Http\Controllers\PostController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use Laravel\Socialite\Facades\Socialite;


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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/google-auth/redirect', [GoogleAuthController::class, 'redirectToGoogle'])->name('google-auth.redirect');
Route::get('/google-auth/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('google-auth.callback');

/*Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name("/google-auth/redirect");
 
Route::get('/google-auth/callback', function () {
    $user = Socialite::driver('google')->user();
 
    // $user->token
});
*/

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('dashboard')->middleware('auth')->group(function(){
    Route::get('contacts',[ContactController::class,'index'])->name('contact.index');
    Route::get('contacts/create',[ContactController::class,'create'])->name('contact.create');
    Route::post('contacts',[ContactController::class,'store'])->name('contact.store');
    Route::get('contacts/{contact}/edit',[ContactController::class,'edit'])->name('contact.edit');
    Route::post('contacts/{contact}',[ContactController::class,'update'])->name('contact.update');
    Route::delete('contacts/{contact}',[ContactController::class,'destroy'])->name('contact.destroy');

    Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::get('posts/create',[PostController::class,'create'])->name('post.create');
    Route::post('posts',[PostController::class,'store'])->name('post.store');
    Route::get('posts/{post}/edit',[PostController::class,'edit'])->name('post.edit');
    Route::post('posts/{post}',[PostController::class,'update'])->name('post.update');
    Route::delete('posts/{post}',[PostController::class,'destroy'])->name('post.destroy');

});

 


require __DIR__.'/auth.php';
