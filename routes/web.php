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

Route::middleware([
    App\Http\Middleware\Customer\DeleteRegisterData::class,
    App\Http\Middleware\Customer\DeleteResetPasswordData::class,
    App\Http\Middleware\Customer\DeleteOtpForResetPasswordData::class,
    App\Http\Middleware\Customer\CheckExistOrder::class
    
])->prefix("/Customer")->group(function(): void{

    Route::prefix("/Authenticate")->group(function(): void{
        
        Route::middleware([
            App\Http\Middleware\Customer\LogoutIfAuthenticated::class
        ])->withoutMiddleware([
            App\Http\Middleware\Customer\CheckExistOrder::class
        ])->group(function(): void{
            Route::get("/RegisterPage", [App\Http\Controllers\Customer\Authenticate::class, "registerPage"]);
            Route::post("/Register", [App\Http\Controllers\Customer\Authenticate::class, "register"])
            ->middleware([
                App\Http\Middleware\Customer\RecaptchaVerify::class
            ]);
        });
        
        Route::middleware([
            App\Http\Middleware\Customer\CheckRegisterData::class
        ])->withoutMiddleware([
            App\Http\Middleware\Customer\DeleteRegisterData::class
        ])->group(function(): void{
            Route::get("/VerifyEmailPage", [App\Http\Controllers\Customer\Authenticate::class, "verifyEmailPage"]);
            Route::post("/VerifyEmail", [App\Http\Controllers\Customer\Authenticate::class, "verifyEmail"]);
        });

        Route::middleware([
            App\Http\Middleware\Customer\LogoutIfAuthenticated::class
        ])->withoutMiddleware([
            App\Http\Middleware\Customer\CheckExistOrder::class
        ])->group(function(): void{
            Route::get("/LoginPage", [App\Http\Controllers\Customer\Authenticate::class, "loginPage"]);
            Route::post("/Login", [App\Http\Controllers\Customer\Authenticate::class, "login"])
            ->middleware([
                App\Http\Middleware\Customer\RecaptchaVerify::class
            ]);
        });
        
        Route::get("/ResetPasswordPage", [App\Http\Controllers\Customer\Authenticate::class, "resetPasswordPage"]);
        Route::post("/ResetPassword", [App\Http\Controllers\Customer\Authenticate::class, "resetPassword"])
        ->middleware([
            App\Http\Middleware\Customer\RecaptchaVerify::class
        ]);

        Route::middleware([
            App\Http\Middleware\Customer\CheckResetPasswordData::class
        ])->withoutMiddleware([
            App\Http\Middleware\Customer\DeleteResetPasswordData::class
        ])->group(function(): void{
            Route::get("/EnterEmailPageForResetPassword", [App\Http\Controllers\Customer\Authenticate::class, "enterEmailPageForResetPassword"]);
            Route::post("/EnterEmailForResetPassword", [App\Http\Controllers\Customer\Authenticate::class, "enterEmailForResetPassword"])
            ->middleware([
                App\Http\Middleware\Customer\RecaptchaVerify::class
            ]);
        });

        Route::middleware([
            App\Http\Middleware\Customer\CheckOtpForResetPasswordData::class
        ])->withoutMiddleware([
            App\Http\Middleware\Customer\DeleteOtpForResetPasswordData::class
        ])->group(function(): void{
            Route::get("/VerifyEmailPageForResetPassword", [App\Http\Controllers\Customer\Authenticate::class, "verifyEmailPageForResetPassword"]);
            Route::post("/VerifyEmailForResetPassword", [App\Http\Controllers\Customer\Authenticate::class, "verifyEmailForResetPassword"]);
        });
    });
    
    Route::prefix("/Blog")->group(function(): void{

        Route::get("/BlogCategoryPage", [App\Http\Controllers\Customer\Blog::class, "blogCategoryPage"]);
        Route::get("/BlogDetailPage", [App\Http\Controllers\Customer\Blog::class, "blogDetailPage"]);
        Route::post("/Comment", [App\Http\Controllers\Customer\Blog::class, "comment"])
        ->middleware([
            App\Http\Middleware\Customer\CheckLogin::class
        ]);
    });

    Route::prefix("/Error")->group(function(): void{
        
        Route::get("/NotFoundPage", [App\Http\Controllers\Customer\Error::class, "notFoundPage"])
        ->withoutMiddleware([
            App\Http\Middleware\Customer\DeleteRegisterData::class,
            App\Http\Middleware\Customer\DeleteResetPasswordData::class,
            App\Http\Middleware\Customer\DeleteOtpForResetPasswordData::class,
            App\Http\Middleware\Customer\CheckExistOrder::class
        ]);
    });

    Route::prefix("/Product")->group(function(): void{
        
        Route::get("/ProductCategoryPage", [App\Http\Controllers\Customer\Product::class, "productCategoryPage"]);
        Route::get("/ProductDetailPage", [App\Http\Controllers\Customer\Product::class, "productDetailPage"]);
        Route::post("/Review", [App\Http\Controllers\Customer\Product::class, "review"])
        ->middleware([
            App\Http\Middleware\Customer\CheckLogin::class
        ]);
    });

    Route::prefix("/Cart")->group(function(): void{

        Route::middleware([
            App\Http\Middleware\Customer\CheckLogin::class
        ])->group(function(): void{

            Route::get("/CartPage", [App\Http\Controllers\Customer\Cart::class, "cartPage"]);
            Route::post("/UpdateCart", [App\Http\Controllers\Customer\Cart::class, "updateCart"]);
            Route::post("/AddProductToCart", [App\Http\Controllers\Customer\Cart::class, "addProductToCart"]);
            Route::post("/DeleteProductFromCart", [App\Http\Controllers\Customer\Cart::class, "deleteProductFromCart"]);
        });
    });

    Route::prefix("/Wishlist")->group(function(): void{

        Route::middleware([
            App\Http\Middleware\Customer\CheckLogin::class
        ])->group(function(): void{

            Route::get("/WishlistPage", [App\Http\Controllers\Customer\Favorite::class, "wishlistPage"]);
            Route::post("/AddProductToWishlist", [App\Http\Controllers\Customer\Favorite::class, "addProductToWishlist"]);
            Route::post("/DeleteProductFromWishlist", [App\Http\Controllers\Customer\Favorite::class, "deleteProductFromWishlist"]);
        });
    });

    Route::prefix("/Checkout")->group(function(): void{

        Route::middleware([
            App\Http\Middleware\Customer\CheckLogin::class
        ])->group(function(): void{

            Route::post("/CreateOrder", [App\Http\Controllers\Customer\Checkout::class, "createOrder"]);
            Route::post("/CreateOrderForOneProduct", [App\Http\Controllers\Customer\Checkout::class, "createOrderForOneProduct"]);

            Route::middleware([
                App\Http\Middleware\Customer\CheckNotExistOrder::class
            ])->withoutMiddleware([
                App\Http\Middleware\Customer\CheckExistOrder::class
            ])->group(function(): void{

                Route::get("/CheckoutPage", [App\Http\Controllers\Customer\Checkout::class, "checkoutPage"]);
                Route::post("/DeleteOrder", [App\Http\Controllers\Customer\Checkout::class, "deleteOrder"]);
                Route::post("/Order", [App\Http\Controllers\Customer\Checkout::class, "order"])
                ->middleware([
                    App\Http\Middleware\Customer\PhoneVerify::class,
                    App\Http\Middleware\Customer\LocationVerify::class
                ]);
            });
        });

        Route::withoutMiddleware([
            App\Http\Middleware\Customer\DeleteRegisterData::class,
            App\Http\Middleware\Customer\DeleteResetPasswordData::class,
            App\Http\Middleware\Customer\DeleteOtpForResetPasswordData::class,
            App\Http\Middleware\Customer\CheckExistOrder::class
        ])->group(function(): void{
            
            Route::get("/VnpReturnUrl", [App\Http\Controllers\Customer\Checkout::class, "vnpReturnUrl"]);
            Route::get("/PaymentSuccessPage", [App\Http\Controllers\Customer\Checkout::class, "paymentSuccessPage"]);
            Route::get("/PaymentErrorPage", [App\Http\Controllers\Customer\Checkout::class, "paymentErrorPage"]);
        });
    });

    Route::prefix("/Contact")->group(function(): void{

        Route::get("/ContactPage", [App\Http\Controllers\Customer\Contact::class, "contactPage"]);
        Route::post("/SendContact", [App\Http\Controllers\Customer\Contact::class, "sendContact"])
        ->middleware([
            "throttle:sendContact",
            App\Http\Middleware\Customer\RecaptchaVerify::class
        ]);
    });

    Route::prefix("/Profile")->group(function(): void{

        Route::middleware([
            App\Http\Middleware\Customer\CheckLogin::class
        ])->group(function(): void{

            Route::get("/DashboardPage", [App\Http\Controllers\Customer\Profile::class, "dashboardPage"]);
            Route::get("/OrderListPage", [App\Http\Controllers\Customer\Profile::class, "orderListPage"]);
            Route::get("/OrderDetailListPage", [App\Http\Controllers\Customer\Profile::class, "orderDetailListPage"]);
            Route::get("/AccountDetailPage", [App\Http\Controllers\Customer\Profile::class, "accountDetailPage"]);
            Route::post("/UpdateAccountDetail", [App\Http\Controllers\Customer\Profile::class, "updateAccountDetail"]);
        });
        
    });

    Route::prefix("/Home")->group(function(): void{

        Route::get("/IndexPage", [App\Http\Controllers\Customer\Home::class, "indexPage"]);
    });
});
