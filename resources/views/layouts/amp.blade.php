<!DOCTYPE html>
<html lang="{{ $current_locale }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="shortcut icon" href="/images/logo.png" sizes="32x32">
    @stack('og-meta')

    <link rel="stylesheet" type="text/css" href="assets/scss/normalize-6.0.0.css">
        <link rel="stylesheet" type="text/css" href="assets/libs/bootstrap-4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/scss/animate-4.0.0.min.css">
        <link rel="stylesheet" type="text/css" href="assets/scss/animate-custom.css">
        <link rel="stylesheet" type="text/css" href="assets/fonts/fontawesome/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="assets/libs/js_support/slick-1.8.1/slick/slick.css">
        <link rel="stylesheet" type="text/css" href="assets/libs/js_support/slick-1.8.1/slick/slick-theme.css">
        <link rel="stylesheet" type="text/css" href="assets/scss/default.css">
        <link rel="stylesheet" type="text/css" href="assets/css/flipclock.css">
        <link rel="stylesheet" type="text/css" href="assets/scss/style_form.css">


         <link rel="stylesheet" type="text/css" href="assets/scss/styles2.css">
        
        <script type="text/javascript" src="assets/js/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="assets/js/isotope.pkgd.min.js"></script>
        <script type="text/javascript" src="assets/libs/js_support/popper.min.js"></script>
        <script type="text/javascript" src="assets/libs/bootstrap-4.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/libs/js_support/slick-1.8.1/slick/slick.min.js"></script>
   
</head>
<body id="home" class="position-relative" data-spy="scroll" data-target="#collapsibleNavbar" data-offset="120">
    
        
            @yield('content')
	
	@stack('body_end')
    
    <script type="text/javascript" src="assets/js/admin/jquery.form.js?r=1500971487"></script>
            <script type="text/javascript" src="assets/libs/js_support/jquery.validate.js"></script>
            <script type="text/javascript" src="assets/libs/js_support/modernizr-2.6.2.min.js"></script>
            <script type="text/javascript" src="assets/js/wow.min.js"></script>
            <script type="text/javascript" src="assets/js/mousescroll.js"></script>
            <script type="text/javascript" src="assets/js/smooth-scrollbar.js"></script>
            <script type="text/javascript" src="assets/js/flipclock.js"></script>
            <script type="text/javascript" src="assets/js/scripts.js"></script>
            <script type="text/javascript" src="assets/js/hq.js"></script>
            <script type="text/javascript" src="assets/js/jquery.matchHeight-min.js"></script>
            <script type="text/javascript" src="assets/js/style.js"></script>
            <script type="text/javascript">
                /*BEGIN: DEBUG*/
                function pr(message) {
                    if (console && console.log) {
                        console.log(message);
                    }
                }
                /*END: DEBUG*/
            
                jQuery(document).ready(function($) {
                    
                    Scrollbar.initAll();
                    wow = new WOW({
                        
                    });
                    wow.init();
                });
            </script>
    @stack('scripts')   
</body>
</html>
