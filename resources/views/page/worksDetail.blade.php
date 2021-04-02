@extends('page.layout')
@section('content')

<div id="body-wrapper">
    <section id="work-detail" class="work-detail">
        
        <div class="menu-{{ ($form !== '') ? $form : 'null' }} custom-container">
            <nav class="navbar navbar-expand-lg justify-content-end align-items-end" id="nav">
                <a class="navbar-brand" href="@lang('page.url')">
                    <img class="img-fluid" src="assets/images/alinco/main/logo-dark.png" alt="logo-alinco" />
                </a>
                <button id="hamburger-menu-modal" class="hamburger hamburger-dark hamburger--slider d-block d-lg-none" data-toggle="collapse" data-target="#navbarSupportedContent">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
                <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                    @foreach($menu as $title)
                        <li class="nav-item {{ ($title->id == 1) ? 'active' : '' }}">
                            @if($title->id == 3)
                                <a class="nav-link" href="{{ $title->canonical }}" target="_blank">{{$title->title}}</a>
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
        <div class="work-detail-content custom-container">
            <nav class="modal-list col-12">
                <div class="nav nav-tabs justify-content-start animate__fadeIn wow" id="nav-tab" role="tablist">
                @foreach($categories as $cat)
                        <a class="nav-item nav-link {{ ($cat->id === $cat_id->id) ? 'active' : '' }}" href="{{ action('SiteController@work') }}/{{ $cat->slug }}" class="nav-item nav-link" id="nav-urban-tab" role="tab" aria-controls="nav-urban" aria-selected="true">{{$cat->title}}</a>
                @endforeach
                </div>
            </nav>
            <div class="row px-0 mx-0">
                <div class="work-detail-content-text col-12 col-sm-4 work-text order-2 order-sm-1">
                    <div class="text__name">
                        <p>{{ $projects->title }}</p>
                    </div>
                    <div class="text__description">
                        <p>{!! $projects->overview !!}</p>
                    </div>
                    {{-- <div class="text__time">
                        <p>{{ $projects->excerpt}}</p>
                    </div> --}}
                </div>
                <div class="work-detail-content-image col-12 col-sm-8 col-lg-7 offset-lg-1  order-1 order-sm-2">
                    <div class="col-12 project-slider p-0">
                        @foreach($gallery as $gallery_img)
                        <img class="img-fluid" src="{{URL::to('/')}}/uploads/thumbnail/page/{{ $gallery_img->name }}" alt="" />
                        @endforeach
                    </div>
                </div>
                <div class="work-detail-content-related col-12 order-3">
                    <div class="col-12 related-title">
                        <p>@lang('page.related')</p>
                    </div>
                    <div class="col-12 related-slider">
                        @foreach( $data_img['related'] as $related)
                                <a class="related-slider-item related-{{$related->id}}" href="{{ action('SiteController@work') }}/{{$cat_id->slug}}/{{ $related->id }}">
                                <img class="related-slider-item__image img-fluid cover" src="{{$related->image}}">
                            </a>
                       
                        @endforeach
                        
                    </div>
                    @foreach( $data_img['related'] as $related)
                        <style>
                            .related-{{$related->id}}::after{
                                content: "{{$related->title}}" !important;
                            }
                        </style>
                        @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
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
       
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            
            var href = '{{ action('SiteController@work') }}/' + $(this).attr("{{ $projects->title }}");
            console.log(href);
            history.replaceState(null, null, href);
        });
    });
</script>
	
@endpush