@extends('page.layout')

@section('content')
<div id="body-wrapper">
    <section id="blog-detail" class="blog-detail">
            <div class="menu-blogs custom-container">
                <nav class="navbar navbar-expand-lg justify-content-end align-items-end" id="nav">
                    <a class="navbar-brand" href="@lang('page.url')">
                        <img class="img-fluid" src="assets/images/alinco/main/logo-dark.png" alt="logo-alinco" />
                    </a>
                    <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button> -->

                    <button id="hamburger-menu-modal" class="hamburger hamburger-dark hamburger--slider d-block d-lg-none" data-toggle="collapse" data-target="#navbarSupportedContent">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>

                    <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            @foreach($menu as $title)
                            <li class="nav-item {{ ($title->id == 2) ? 'active' : '' }}">
                                @if($title->id == 3)
                                    <a class="nav-link" href="{{ $title->alias_en }}" target="_blank">{{$title->title}}</a>
                                @else
                                    <a class="nav-link" href="{{ action('SiteController@' . $title->alias_en  ) }}">{{$title->title}}</a>
                                @endif
                            </li>
                             @endforeach
                             <li class="nav-item dropdown">
                                @if($current_locale == 'vi')
                                <a class="nav-link nav-link-en" href="/en">EN</a> 
                                @else
                                <a class="nav-link nav-link-vi" href="/vi">VN</a> 
                                @endif               
                             </li>
                        </ul>
                    </div>
                </nav>
                <div class="col-12 social z-index-1 text-right justify-content-end pt-2">
                    <ul class="social__menu">
                    @foreach($icon as $icons)
                        <li class="social__menu__item">
                            <a class="" href="{{$icons->excerpt}}" target="_blank"><i class="{{$icons->description}}"></i></a>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
            <div class="blog-detail-content custom-container">
                <nav class="modal-list col-12">
                    <div class="nav nav-tabs justify-content-start animate__fadeIn wow" id="nav-tab" role="tablist">
                        @foreach($categories as $cat)
                            @if($cat->alias_en === 'porfolio')
                                <a class="nav-item nav-link {{ ($cat->id === $blog->cat_id) ? 'active' : '' }}" target="_blank" href="{{$porfolio->content_vn}}" class="nav-item nav-link" id="nav-urban-tab" role="tab" aria-controls="nav-urban" aria-selected="true">{{$cat->title}}</a>
                            @else
                            <a class="nav-item nav-link {{ ($cat->id === $blog->cat_id) ? 'active' : '' }}" href="{{ action('SiteController@firm') }}/{{ $cat->slug }}" class="nav-item nav-link" id="nav-urban-tab" role="tab" aria-controls="nav-urban" aria-selected="true">{{$cat->title}}</a>
                            @endif
                        @endforeach
                    </div>
                </nav>
                <div class="row px-0 mx-0">
                    <div class="blog-detail-content-text col-12">
                        <div class="text__img text-center">
                            <img class="img-fluid" src="{{URL::to('/')}}/uploads/thumbnail/post/{{ $gallery->name }}" alt="logo-alinco" />
                        </div>
                        <div class="text__name text-center">
                            <p>{{$blog->title}}</p>
                        </div>
                    
                        <div class="container">
                            <div class="row about-text">
                            <div class="col-12 text__description">
                            {!!$blog->description!!}
                            </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
                /*BEGIN: DEBUG*/
    function pr(message) {
        if (console && console.log) {
            console.log(message);
        }
    }
    /*END: DEBUG*/
    function ajax_count_view() {
        $.post('home/countview', {}, function(data) {
            $('#count_view').html("Lượt view : " + data);
        });
    }
    jQuery(document).ready(function($) {
        ajax_count_view();
        Scrollbar.initAll();
        wow = new WOW({
            
        });
        wow.init();
    });
</script>
	
@endpush