<!DOCTYPE html>
<html lang="{{ $current_locale }}">
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no"  />
        <meta name="author" content="">
        
        <!-- facebook meta -->
        <meta property="og:url"                content="" />
        <meta property="og:type"               content="" />
        <meta property="og:title"              content="Alinco - Tư vấn thiết kế" />
        <meta property="og:description"        content="Alinco - Tư vấn thiết kế" />
        <meta property="og:image"              content="assets/images/alinco/alinco.jpg" alt="cover" />
        <!-- end facebook meta -->
        <title>
        Alinco - Tư Vấn Thiết Kế
        </title>
        <meta name="title" content="Alinco - Tư vấn thiết kế">
        <meta name="description" content="Alinco - Tư vấn thiết kế">
    <base href="{{asset('')}}">
    <link rel='icon' href='assets/images/alinco/firm/logo.png' type='image/png'>
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
            <script type="text/javascript" src="assets/js/style.js?r=1"></script>
            <script type="text/javascript">
            <?php
            if(!isset($menu_mapping_json_str)){
                $menu_mapping_json_str = '';
            }
            ?>
            if(typeof(menu_maping_json) != 'undefined'){
                var menu_maping_json_str = '<?php echo $menu_mapping_json_str?>';
                console.log(menu_maping_json_str);
                if(menu_maping_json_str){
                    menu_maping_json = JSON.parse(menu_maping_json_str);
                }
                console.log(menu_maping_json);
            }
            
            </script>
            <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYCPPd_rZPYV7AvmqxR9VMRRCl6kFHCU0&callback=initMap">
            </script>
    @stack('scripts')   
</body>
</html>
