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
                        <h1 class="text-title-heading">Account Detail</h1>
                    </div>
                    <div class="breadcrumbs">
                        <a href="/Customer/Home/IndexPage">Home</a><span class="delimiter"></span>Account Detail
                    </div>
                </div>
            </div>

            <div id="content" class="site-content" role="main">
                <div class="section-padding">
                    <div class="section-container p-l-r">
                        <div class="page-my-account">
                            <div class="my-account-wrap clearfix">
                                
                                @include("Customer.Include.ProfileSidebar")

                                <div class="my-account-content tab-content">
                                    <div class="tab-pane fade show active" id="account-details" role="tabpanel">
                                        <div class="my-account-account-details">
                                            <form class="edit-account" action="#" method="post" onsubmit="return false;">
                                                <p class="form-row">
                                                    <label>First name <span class="required">*</span></label>
                                                    <input type="text" class="input-text updateAccountDetailFirstName" 
                                                        name="account_first_name" value="{{ $customer->firstName }}">
                                                </p>
                                                <p class="form-row">
                                                    <label>Last name <span class="required">*</span></label>
                                                    <input type="text" class="input-text updateAccountDetailLastName" 
                                                        name="account_last_name" value="{{ $customer->lastName }}">
                                                </p>
                                                <div class="clear"></div>
                                                <p class="form-row">
                                                    <label>Account name <span class="required">*</span></label>
                                                    <input type="text" class="input-text updateAccountDetailName" 
                                                        name="account_display_name" value="{{ $customer->name }}">
                                                    <span>
                                                        <em>
                                                            This will be how your name will be displayed in the
                                                            account section and in reviews
                                                        </em>
                                                    </span>
                                                </p>
                                                <p class="form-row">
                                                    <button type="submit" class="button updateAccountDetailSubmit"
                                                        name="save_account_details" value="Save changes">
                                                        Save changes
                                                    </button>
                                                </p>
                                            </form>
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
        document.querySelector(".updateAccountDetailSubmit").addEventListener("click", () => {
            $.ajax({
                url: "/Customer/Profile/UpdateAccountDetail",
                type: "post",
                data: {
                    firstName: document.querySelector(".updateAccountDetailFirstName").value,
                    lastName: document.querySelector(".updateAccountDetailLastName").value,
                    name: document.querySelector(".updateAccountDetailName").value,
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
@endsection