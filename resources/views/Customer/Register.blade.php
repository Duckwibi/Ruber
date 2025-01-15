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
    .registerForm{
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
                            Register
                        </h1>
                    </div>
                    <div class="breadcrumbs">
                        <a href="/Customer/Home/IndexPage">Home</a><span class="delimiter"></span>Register
                    </div>
                </div>
            </div>

            <div id="content" class="site-content" role="main">
                <div class="section-padding">
                    <div class="section-container p-l-r">
                        <div class="page-login-register">
                            <div class="row registerForm">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="box-form-login">
                                        <h2 class="register">Register</h2>
                                        <div class="box-content">
                                            <div class="form-register">
                                                <form onsubmit="return false;" class="register">
                                                    <div class="email">
                                                        <label>User name <span class="required">*</span></label>
                                                        <input type="text" class="input-text registerName">
                                                    </div>
                                                    <div class="email">
                                                        <label>Email address <span class="required">*</span></label>
                                                        <input type="text" class="input-text registerEmail">
                                                    </div>
                                                    <div class="email">
                                                        <label>First name <span class="required">*</span></label>
                                                        <input type="text" class="input-text registerFirstName">
                                                    </div>
                                                    <div class="email">
                                                        <label>Last name <span class="required">*</span></label>
                                                        <input type="text" class="input-text registerLastName">
                                                    </div>
                                                    <div class="password">
                                                        <label>Password <span class="required">*</span></label>
                                                        <input type="password" class="input-text registerPassword">
                                                    </div>
                                                    <div class="password">
                                                        <label>Confirm password <span class="required">*</span></label>
                                                        <input type="password" class="input-text registerPasswordConfirm">
                                                    </div>
                                                    <div id="recaptchaRender"></div>
                                                    <div class="button-register registerSubmit">
                                                        <input type="submit" class="button" name="register" value="Register">
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
        document.querySelector(".registerSubmit").addEventListener("click", () => {
            $.ajax({
                url: "/Customer/Authenticate/Register",
                type: "post",
                data: {
                    name: document.querySelector(".registerName").value,
                    email: document.querySelector(".registerEmail").value,
                    firstName: document.querySelector(".registerFirstName").value,
                    lastName: document.querySelector(".registerLastName").value,
                    password: document.querySelector(".registerPassword").value,
                    passwordConfirm: document.querySelector(".registerPasswordConfirm").value,
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