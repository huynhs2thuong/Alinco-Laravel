<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="shortcut icon" href="/images/logo.png" sizes="32x32">
        @stack('og-meta')
    
        <link rel="stylesheet" type="text/css" href="/assets/scss/normalize-6.0.0.css">
            <link rel="stylesheet" type="text/css" href="/assets/libs/bootstrap-4.4.1/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="/assets/scss/animate-4.0.0.min.css">
            <link rel="stylesheet" type="text/css" href="/assets/scss/animate-custom.css">
            <link rel="stylesheet" type="text/css" href="/assets/fonts/fontawesome/css/all.min.css">
            <link rel="stylesheet" type="text/css" href="/assets/libs/js_support/slick-1.8.1/slick/slick.css">
            <link rel="stylesheet" type="text/css" href="/assets/libs/js_support/slick-1.8.1/slick/slick-theme.css">
            <link rel="stylesheet" type="text/css" href="/assets/scss/default.css">
            <link rel="stylesheet" type="text/css" href="/assets/css/flipclock.css">
            <link rel="stylesheet" type="text/css" href="/assets/scss/style_form.css">
            
            <script type="text/javascript" src="/assets/js/jquery-3.2.1.js"></script>
            <script type="text/javascript" src="/assets/js/isotope.pkgd.min.js"></script>
            <script type="text/javascript" src="/assets/libs/js_support/popper.min.js"></script>
            <script type="text/javascript" src="/assets/libs/bootstrap-4.4.1/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="/assets/libs/js_support/slick-1.8.1/slick/slick.min.js"></script>
            <style>
                .thanks-body {
                    height: 100vh; }
                    @media (max-width: 575px) {
                        .thanks-body .title {
                        max-width: 50rem; } }
                    
                    .thanks-body .contact {
                        padding-top: 1rem;
                        text-align: center;
                        padding-top: 2.5rem;
                        font-size: 2.4rem;
                        font-family: "Montserrat-Italic";
                        color: #3a3a3a; }
                    @media (max-width: 767px) {
                        .thanks-body .contact {
                        font-size: 1.5rem;
                         }
                    }
                    .thanks-body .follow {
                        padding-top: 1.5rem;
                        font-size: 2.4rem;
                        font-family: "Montserrat-Regular";
                        color: #3a3a3a; }
                    .thanks-body ul.social li {
                        cursor: pointer;
                        display: inline-block;
                        padding: 1rem; }
                        .thanks-body ul.social li a img {
                        width: 22px;
                        height: 22px; }
                    .thanks-body .return {
                        margin-top: 2.5rem;
                        padding: 0.8rem 2rem;
                        font-size: 2.4rem;
                        font-family: "Montserrat-Regular";
                        color: #3a3a3a;;
                        border: 1px solid #EB1D50;
                        border-radius: 8px; 
                    }
                    @media (max-width: 767px) {
                        .thanks-body .follow {
                        font-size: 1.5rem;
                         }
                         .thanks-body .return {
                        font-size: 1.5rem;
                         }

                    }

            </style>
       
    </head>
    <body id="home" class="position-relative" data-spy="scroll" data-target="#collapsibleNavbar" data-offset="95">
        <div id="body-wrapper">
            <div class="row">
                <div class="col-12 d-flex align-items-center flex-column thanks-body">
                    <img class="img-fluid title"style="margin: 3vh;" src="/assets/images/alinco/modal/bg.png" alt="">
                    @if($current_locale == 'vi')
                    <img class="img-fluid title" src="/assets/images/alinco/modal/camon.png" alt="">
                    @else
                    <img class="img-fluid title" src="/assets/images/alinco/modal/thanks1.png" alt="">
                    @endif
                    
                    <p class="contact text-center">@lang('page.Thank_contact1')<br>@lang('page.Thank_contact2')</p>
                    <p class="follow">@lang('page.Follow')</p>
                    <ul class="social">
                        <li><a href="https://www.facebook.com/alinco.com.vn/" target="_blank"><img class="img-fluid" src="/assets/images/alinco/modal/facebook-red.png" alt=""></a></li>
                        <li><a href="https://www.youtube.com/channel/UCcHxR4_FU5fPE2JIJ2o61rQ" target="_blank"><img class="img-fluid" src="/assets/images/alinco/modal/youtobe-red.jpg" alt=""></a></li>
                        <li><a href="https://www.instagram.com/alinco.ltd/" target="_blank"><img class="img-fluid" src="/assets/images/alinco/modal/instagram-red.png" alt=""></a></li>
                    </ul>
                    <a class="return" href="@lang('page.url')">@lang('page.back')</a>
                    <img width="713" class="img-fluid title" style="margin-top: 3vh;" src="assets/images/hobien/modal/bg.png" alt="">
                </div>
            </div>


            <script type="text/javascript" src="/assets/js/admin/jquery.form.js?r=1500971487"></script>
            <script type="text/javascript" src="/assets/libs/js_support/jquery.validate.js"></script>
            <script type="text/javascript" src="/assets/libs/js_support/modernizr-2.6.2.min.js"></script>
            <script type="text/javascript" src="/assets/js/wow.min.js"></script>
            <script type="text/javascript" src="/assets/js/mousescroll.js"></script>
            <script type="text/javascript" src="/assets/js/smooth-scrollbar.js"></script>
            <script type="text/javascript" src="/assets/js/flipclock.js"></script>
            <script type="text/javascript" src="/assets/js/scripts.js"></script>
            <script type="text/javascript" src="/assets/js/hq.js"></script>
            <script type="text/javascript" src="/assets/js/jquery.matchHeight-min.js"></script>
            <script type="text/javascript" src="/assets/js/style.js"></script>
            <script type="text/javascript">
                /*BEGIN: DEBUG*/
                function pr(message) {
                    if (console && console.log) {
                        console.log(message);
                    }
                }
                /*END: DEBUG*/
            </script>
            <script type="text/javascript">
                function ajax_count_view() {
                    $.post('home/countview', {}, function(data) {
                        $('#count_view').html("Lượt view : " + data);
                    });
                }
                jQuery(document).ready(function($) {
                    ajax_count_view();
                });
                wow = new WOW({
                    
                });
                wow.init();
            </script>
            <script>
                jQuery(document).ready(function(){
                    Scrollbar.initAll();
                    document.documentElement.style.setProperty('--scrollbar-width', (window.innerWidth - document.documentElement.clientWidth) + "px");
                    $(document).click(function (event) {
                        var _opened = $(".navbar-collapse").hasClass("show");   
                        var clickover = $(event.target);
                        if (_opened === true && !clickover.hasClass("navbar-toggler")) {
                            $("#hamburger-menu").click();
                        }
                    });
                    $(".nav-link").click(function(){
                        var _opened = $(".navbar-collapse").hasClass("show");   
                        if (_opened === true) {
                            $("#hamburger-menu").click();
                        }
                    })
                });
            </script>
        <div>
	</body>
</html>