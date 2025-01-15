@php
    $titles = [
        "Not Found Page" => "",
        "Contact Page" => "m-t-0",
        "Index Page" => "m-t-0"
    ];
@endphp

<footer id="site-footer" class="site-footer {{ array_key_exists($title, $titles) ? $titles["$title"] : "background" }}">
    <div class="footer">
        <div class="section-padding">
            <div class="section-container">
                <div class="block-widget-wrap">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="block block-menu m-b-20">
                                <h2 class="block-title">Contact Us</h2>
                                <div class="block-content">
                                    <ul>
                                        <li>
                                            <a href="page-contact.html">0397.941.915</a>
                                        </li>
                                        <li>
                                            <a href="page-contact.html">bluefoxna@gmail.com</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="block block-social">
                                <ul class="social-link">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="block block-menu">
                                <h2 class="block-title">Showroom</h2>
                                <div class="block-content">
                                    <p>15/2H, Nguyen Van Troi street</p>
                                    <p>Ben Thuy, Vinh</p>
                                    <p>Nghe An, Vietnam</p>
                                </div>
                            </div>
                        </div>
                        
                        <x-customer.service-blog></x-customer.service-blog>
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="block block-newsletter">
                                <h2 class="block-title">Newsletter</h2>
                                <div class="block-content">
                                    <div class="newsletter-text">Enter your email below to be the first to know about
                                        new collections and product launches.</div>
                                    <form action="#" method="post" class="newsletter-form">
                                        <input type="email" class="{{ array_key_exists($title, $titles) ? "" : "bg-white" }}" name="your-email" value="" size="40"
                                            placeholder="Email address">
                                        <span class="btn-submit">
                                            <input type="submit" value="Subscribe">
                                        </span>
                                    </form>
                                </div>
                            </div>
                            <div class="block block-image">
                                <img width="309" height="32" src="/Customer/media/payments.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="section-padding">
            <div class="section-container">
                <div class="block-widget-wrap">
                    <p class="copyright text-center">Copyright © 2022. All Right Reserved</p>
                </div>
            </div>
        </div>
    </div>
</footer>