@extends('page.layout')


@section('content')
<div id="body-wrapper">
    <section id="main" class="main">
         @include('menu.menu')
        <div class="main__wrapper {{ $showWelcome ? 'show-filter' : 'hide-filter' }}">
            <div class="main__slider d-none d-lg-block">
              @foreach($data_pc['slide_pc'] as $slides)
                <a href="{{ action('SiteController@work') }}/{{ $slides->id }}" class="slides_{{ $slides->id }}" style="background: url(/uploads/thumbnail/omember/{{$slides->image_pc}}) no-repeat; background-size: cover;" ></a>
            @endforeach

            </div>
            <div class="main__slider_mobile d-block d-lg-none">
                @foreach($data_mobile['slide_mobile'] as $slides)
                  <a href="{{ action('SiteController@work') }}/{{ $slides->id }}" class="slides_{{ $slides->id }}" style="background: url(/uploads/thumbnail/omember/{{$slides->image_mobile}}) no-repeat; background-size: cover;" ></a>
              @endforeach
  
              </div>
        </div>
       
        @if($showWelcome)

        <div class="main__content" >
            <img class="content__logo img-fluid animate__fadeInDownBig wow" src="assets/images/alinco/main/logo.png" alt="logo-alinco"  data-wow-duration="2s"/>
            <div class="content__discover animate__fadeInDownBig wow" data-wow-duration="2s">
                <div class="content__discover__text">@lang('page.alinco_cap')</div>
            </div>
        </div>
        @endif
    </section>
    {{-- <style>
        @media screen and (max-width: 991px) {
        @foreach($data_mobile['slide_mobile'] as $slides)
            .slides_{{ $slides->id }} {
                background: url(/uploads/thumbnail/omember/{{$slides->image_mobile}}) no-repeat !important;
            }
        
        @endforeach
        }
    </style> --}}
    <!-- MODAL -->

    <div class="modal fade modal-menu modal-fullscreen" id="modalWorkList" tabindex="-1" role="dialog" aria-labelledby="modalWorkListLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body custom-container">
                    <div class="menu-alinco-modal">
                        <nav class="navbar navbar-expand-lg justify-content-end align-items-end">
                            <a class="navbar-brand" href="@lang('page.url')">
                                <img class="img-fluid" src="assets/images/alinco/main/logo-dark.png" alt="logo-alinco" />
                            </a>
                            <button id="hamburger-menu-modal" class="hamburger hamburger-dark hamburger--slider d-block d-lg-none" data-toggle="collapse" data-target="#navbarSupportedContent">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                            <div class="collapse navbar-collapse navbar-collapse-modal flex-grow-0" id="navbarSupportedContent">
                                <ul class="nav navbar-nav" id="nav-tab" role="tablist">
                                @foreach($menu as $title)
                                    <li class="nav-item ">
                                        @if($title->id == 3)
                                            <a class="nav-link " href="{{ $title->canonical }}" target="_blank">{{$title->title}}</a>
                                        @else
                                            <a class="nav-link {{ ($title->id == 1) ? 'active' : '' }}" id="nav-{{$title->id}}-tab" data-toggle="tab" href="#nav-{{$title->id}}" role="tab" aria-controls="nav-{{$title->id}}" aria-selected="true">{{$title->title}}</a>
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
                    <div class="tab-content col-12 px-0" id="nav-tabContent">
                        @foreach($menu as $menu_list)
                            <div class="col-12 tab-pane fade text-center px-0{{ ($menu_list->id == 1) ? ' active show' : '' }}" id="nav-{{$menu_list->id}}" role="tabpanel" aria-labelledby="nav-{{$menu_list->id}}-tab">
                                <nav class="modal-list col-12 tab-contents">
                                    <div class="nav nav-tabs justify-content-center" style="text-align: center;" id="nav-tab" role="tablist">
                                        @if($menu_list->id == 1)
                                            @foreach($category as $cat)
                                            @if($menu_list->id == $cat->cid)
                                            <a href="{{ action('SiteController@work') }}/{{ $cat->slug }}" class="nav-item nav-link" id="nav-urban-tab" role="tab" aria-controls="nav-urban" aria-selected="true">{{$cat->title}}</a>
                                            @endif
                                            @endforeach
                                        @elseif($menu_list->id == 2)
                                            @foreach($category as $cat)
                                            @if($menu_list->id == $cat->cid)
                                            @if($cat->alias_en === 'porfolio')
                                            <a class="nav-item nav-link" href="{{$porfolio->content_vn}}" target="_blank" class="nav-item nav-link" id="nav-urban-tab" role="tab" aria-controls="nav-urban" aria-selected="true">{{$cat->title}}</a>
                                            @else
                                            <a class="nav-item nav-link" id="nav-{{$cat->slug}}-tab"  href="{{ action('SiteController@firm') }}/{{ $cat->slug }}" role="tab" aria-controls="{{ $cat->slug }}" aria-selected="true">{{ $cat->title }}</a>
                                            @endif
                                            @endif
                                            @endforeach 
                                        @endif

                                        
                                    
                                    </div>
                                </nav>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            document.documentElement.style.setProperty('--scrollbar-width', (window.innerWidth - document.documentElement.clientWidth) + "px")

            wow = new WOW({
                
            });
            wow.init();

            <?php if($showWelcome) { ?>
                $(".menu").hide();
                $(".main__slider .slick-dots")
                    .addClass("animate__fadeInRight wow")
                    .attr("data-wow-duration", "2s")
                    .hide();
                $(".content__discover").click(function () {
                    $(".main__content").hide("slow");
                    setTimeout(() => {
                    $(".main__wrapper").removeClass("show-filter").addClass("hide-filter");
                    $(".menu").show("slow");
                    $(".main__slider .slick-dots").show("slow");
                    }, 1000);
                });
                $(".content__logo").click(function () {
                    $(".main__content").hide("slow");
                    setTimeout(() => {
                    $(".main__wrapper").removeClass("show-filter").addClass("hide-filter");
                    $(".menu").show("slow");
                    $(".main__slider .slick-dots").show("slow");
                    }, 1000);
                });
            <?php } else { ?>
                $(".main__slider .slick-dots")
                .addClass("animate__fadeInRight wow")
                .attr("data-wow-duration", "2s");
            <?php } ?>

            $('#modalWorkList').on('show.bs.modal', function (e) {
                $(".menu").hide("slow");
                $(".main__slider .slick-dots").hide("slow");
            })

            $("#main-menu-1").click( function() {
                $('#nav-1-tab').tab('show');
            })

            $("#main-menu-2").click( function() {
                $('#nav-2-tab').tab('show');
            }) 
        });
    
    </script>
	
@endpush


