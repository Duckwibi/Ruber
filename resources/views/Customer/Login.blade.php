@extends("Customer.Layout")

@section("TemplateStyle")
<link rel="stylesheet" href="/Customer/libs/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/feather-font/css/iconfont.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/icomoon-font/css/icomoon.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/font-awesome/css/font-awesome.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/wpbingofont/css/wpbingofont.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/elegant-icons/css/elegant.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/slick/css/slick.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/slick/css/slick-theme.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/mmenu/css/mmenu.min.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/slider/css/jslider.css">
@endsection

@section("Style")
<style>
    .loginForm {
        justify-content: center;
        align-items: center;
    }
</style>
@endsection

@section("Content")
<div id="site-main" class="site-main">
    <div id="main-content" class="main-content">
        <div id="primary" class="content-area">
            <div id="title" class="page-title">
                <div class="section-container">
                    <div class="content-title-heading">
                        <h1 class="text-title-heading">
                            Login
                        </h1>
                    </div>
                    <div class="breadcrumbs">
                        <a href="/Customer/Home/IndexPage">Home</a><span class="delimiter"></span>Login
                    </div>
                </div>
            </div>

            <div id="content" class="site-content" role="main">
                <div class="section-padding">
                    <div class="section-container p-l-r">
                        <div class="page-login-register">
                            <div class="row loginForm">
                                <div class="col-lg-6 col-md-6 col-sm-12 sm-m-b-50">
                                    <div class="box-form-login">
                                        <h2>Login</h2>
                                        <div class="box-content">
                                            <div class="form-login">
                                                <form onsubmit="return false;" class="login">
                                                    <div class="username">
                                                        <label>Username or email address <span class="required">*</span></label>
                                                        <input type="text" class="input-text loginNameOrEmail">
                                                    </div>
                                                    <div class="password">
                                                        <label for="password">Password <span class="required">*</span></label>
                                                        <input class="input-text loginPassword" type="password">
                                                    </div>
                                                    <div class="rememberme-lost">
                                                        <div class="remember-me">
                                                            <input name="rememberme" type="checkbox" class="loginRememberMe">
                                                            <label class="inline">Remember me</label>
                                                        </div>
                                                        <div class="lost-password">
                                                            <a href="/Customer/Authenticate/ResetPasswordPage">Lost your password?</a>
                                                        </div>
                                                    </div>
                                                    <div id="recaptchaRender"></div>
                                                    <div class="button-login loginSubmit">
                                                        <input type="submit" class="button" value="Login">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div><!-- #main-content -->
</div>
@endsection

@section("TemplateScript")
<script src="/Customer/libs/popper/js/popper.min.js"></script>
<!-- <script src="/Customer/libs/jquery/js/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="/Customer/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="/Customer/libs/slick/js/slick.min.js"></script>
<script src="/Customer/libs/countdown/js/jquery.countdown.min.js"></script>
<script src="/Customer/libs/mmenu/js/jquery.mmenu.all.min.js"></script>
<script src="/Customer/libs/slider/js/tmpl.js"></script>
<script src="/Customer/libs/slider/js/jquery.dependClass-0.1.js"></script>
<script src="/Customer/libs/slider/js/draggable-0.1.js"></script>
<script src="/Customer/libs/slider/js/jquery.slider.js"></script>
@endsection

@section("Script")
<script>
    window.addEventListener("load", () => {
        document.querySelector(".loginSubmit").addEventListener("click", () => {
            $.ajax({
                url: "/Customer/Authenticate/Login",
                type: "post",
                data: {
                    nameOrEmail: document.querySelector(".loginNameOrEmail").value,
                    password: document.querySelector(".loginPassword").value,
                    rememberMe: document.querySelector(".loginRememberMe").checked ? 1 : 0,
                    g_recaptcha_response: document.querySelector(".g-recaptcha-response").value,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                beforeSend: () => {
                    document.querySelector(".page-preloader").style.display = "flex";
                },
                success: (data) => {
                    if(typeof data.error != "undefined"){
                        window.location.replace(data.error);
                        return;
                    }

                    alert(data.message);

                    if(typeof data.success != "undefined"){
                        window.location.replace(data.success);
                    }  
                },
                complete: () => {
                    document.querySelector(".page-preloader").style.display = "none";
                },
                error: (jqXHR, textStatus, errorThrown) => {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        });
    });
</script>
<script>
    var onloadCallback = () => {
        grecaptcha.render("recaptchaRender", {
            "sitekey" : "{{ env("RECAPTCHA_V2_SITE_KEY") }}",
            "theme" : "dark"
        });
    };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
@endsection