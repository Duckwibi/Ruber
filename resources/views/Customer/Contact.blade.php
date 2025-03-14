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

@endsection

@section("Content")
<div id="site-main" class="site-main">
    <div id="main-content" class="main-content">
        <div id="primary" class="content-area">
            <div id="title" class="page-title">
                <div class="section-container">
                    <div class="content-title-heading">
                        <h1 class="text-title-heading">Contact</h1>
                    </div>
                    <div class="breadcrumbs">
                        <a href="/Customer/Home/IndexPage">Home</a><span class="delimiter"></span>Contact
                    </div>
                </div>
            </div>

            <div id="content" class="site-content" role="main">
                <div class="page-contact">
                    <section class="section section-padding">
                        <div class="section-container small">
                            <!-- Block Contact Map -->
                            <div class="block block-contact-map">
                                <div class="block-widget-wrap">
                                    <iframe src="https://maps.google.com/maps?q=London%20Eye%2C%20London%2C%20United%20Kingdom&amp;t=m&amp;z=10&amp;output=embed&amp;iwloc=near"
                                        aria-label="London Eye, London, United Kingdom"></iframe>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section section-padding m-b-70">
                        <div class="section-container">
                            <!-- Block Contact Info -->
                            <div class="block block-contact-info">
                                <div class="block-widget-wrap">
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" class="svg-icon2 plant" x="0"
                                            y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
                                            xml:space="preserve">
                                            <g>
                                                <path xmlns="http://www.w3.org/2000/svg"
                                                    d="m320.174 28.058a8.291 8.291 0 0 0 -7.563-4.906h-113.222a8.293 8.293 0 0 0 -7.564 4.907l-66.425 148.875a8.283 8.283 0 0 0 7.564 11.655h77.336v67.765a20.094 20.094 0 1 0 12 0v-67.765h27.7v288.259h-48.441a6 6 0 0 0 0 12h108.882a6 6 0 0 0 0-12h-48.441v-288.259h117.04a8.284 8.284 0 0 0 7.564-11.657zm-103.874 255.567a8.094 8.094 0 1 1 8.094-8.093 8.1 8.1 0 0 1 -8.094 8.093zm-77.61-107.036 63.11-141.437h108.4l63.11 141.437z"
                                                    fill="" data-original="" style=""></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="info-title">
                                        <h2>Need Help?</h2>
                                    </div>
                                    <div class="info-items">
                                        <div class="row">
                                            <div class="col-md-4 sm-m-b-30">
                                                <div class="info-item">
                                                    <div class="item-tilte">
                                                        <h2>Phone</h2>
                                                    </div>
                                                    <div class="item-content">0397.941.915</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 sm-m-b-30">
                                                <div class="info-item">
                                                    <div class="item-tilte">
                                                        <h2>Customer Service</h2>
                                                    </div>
                                                    <div class="item-content">
                                                        <p>Monday to Friday</p>
                                                        <p>8:00am – 4:00pm Vinh, Vietnam</p>
                                                        <p>Saturday and Sunday closed</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="info-item">
                                                    <div class="item-tilte">
                                                        <h2>Returns</h2>
                                                    </div>
                                                    <div class="item-content small-width">
                                                        For information on Returns and Refunds, please click <a href="#">here.</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section section-padding contact-background m-b-0">
                        <div class="section-container small">
                            <!-- Block Contact Form -->
                            <div class="block block-contact-form">
                                <div class="block-widget-wrap">
                                    <div class="block-title">
                                        <h2>Send Us Your Questions!</h2>
                                        <div class="sub-title">We’ll get back to you within two days.</div>
                                    </div>
                                    <div class="block-content">
                                        <form action="#" method="post" class="contact-form" novalidate="novalidate" onsubmit="return false;">
                                            <div class="contact-us-form">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <label class="required">Name</label><br>
                                                        <span class="form-control-wrap">
                                                            <input type="text" name="name" value="" size="40"
                                                                class="form-control contactName" aria-required="true">
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <label class="required">Email</label><br>
                                                        <span class="form-control-wrap">
                                                            <input type="email" name="email" value="" size="40"
                                                                class="form-control contactEmail" aria-required="true">
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label class="required">Message</label><br>
                                                        <span class="form-control-wrap">
                                                            <textarea name="message" cols="40" rows="10"
                                                                class="form-control contactMessage" aria-required="true"></textarea>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div id="recaptchaRender"></div>
                                                <div class="form-button">
                                                    <input type="submit" value="Submit" class="button contactSubmit"></span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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
        document.querySelector(".contactSubmit").addEventListener("click", () => {
            $.ajax({
                url: "/Customer/Contact/SendContact",
                type: "post",
                data: {
                    name: document.querySelector(".contactName").value,
                    email: document.querySelector(".contactEmail").value,
                    message: document.querySelector(".contactMessage").value,
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