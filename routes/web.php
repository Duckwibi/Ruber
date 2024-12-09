<?php

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

Route::prefix("/Customer")->group(function(): void{
    Route::prefix("/Authenticate")->group(function(): void{
        Route::get("/RegisterPage", [App\Http\Controllers\Customer\Authenticate::class, "registerPage"]);
        Route::post("/Register", [App\Http\Controllers\Customer\Authenticate::class, "register"])
        ->middleware([
            App\Http\Middleware\Customer\RecaptchaVerify::class
        ]);
        
        Route::get("/VerifyEmailPage", [App\Http\Controllers\Customer\Authenticate::class, "verifyEmailPage"]);
        Route::post("/VerifyEmail", [App\Http\Controllers\Customer\Authenticate::class, "verifyEmail"]);

        Route::get("/LoginPage", [App\Http\Controllers\Customer\Authenticate::class, "loginPage"]);
        Route::post("/Login", [App\Http\Controllers\Customer\Authenticate::class, "login"])
        ->middleware([
            App\Http\Middleware\Customer\RecaptchaVerify::class
        ]);
    });   
    
    Route::prefix("/Blog")->group(function(): void{

        Route::get("/BlogCategoryPage", [App\Http\Controllers\Customer\Blog::class, "blogCategoryPage"]);
    });
});
