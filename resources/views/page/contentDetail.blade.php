@extends('page.layout')
@section('content')
<div id="body-wrapper">
            <section id="works" class="works">
                <div class="menu-works custom-container">
                    <nav class="navbar navbar-expand-lg justify-content-end align-items-end" id="nav">
                        <a class="navbar-brand" href="@lang('page.url')">
                            <img class="img-fluid" src="assets/images/alinco/main/logo-dark.png" alt="logo-alinco" />
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                
                                @foreach($menu as $title)

                                <li class="nav-item">
                                    @if($title->id == 79)
                                        <a class="nav-link" href="{{$title->slug}}">{{$title->title}}</a>
                                    @else
                                        <a class="nav-link" href="#" data-toggle="modal" data-target="#modalWorkList_{{$title->id}}">{{$title->title}}</a>
                                    @endif
                                </li>
                                @endforeach
                                
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        EN
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#">VI</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="col-12 social z-index-1 text-right justify-content-end pt-5">
                        <ul class="social__menu">
                        @foreach($icon as $icons)
                            <li class="social__menu__item">
                                <a class="" href="{{$icons->excerpt}}" target="_blank"><i class="{{$icons->description}}"></i></a>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="tab-works">
                    <div class="custom-container">
                        <nav class="modal-list col-12">
                            <div class="nav nav-tabs justify-content-start animate__fadeIn wow" id="nav-tab" role="tablist">
                            @foreach($category as $item)
                                <a class="nav-item nav-link active" id="nav-urban-tab" data-toggle="tab" href="#nav-urban" role="tab" aria-controls="nav-urban" aria-selected="true">{{$item->title}}</a>
                                
                            @endforeach
                            </div>
                        </nav>

                        <div class="tab-content col-12" id="nav-tabContent">
                            <div class="col-12 tab-pane fade text-center show active" id="nav-urban" role="tabpanel" aria-labelledby="nav-urban-tab">
                                <div class="works-slider urban-slider">
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-1.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-2.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-3.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-4.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-5.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-1.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-2.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-3.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-4.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-5.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-1.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-2.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-3.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-4.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-5.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-1.jpg">
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 tab-pane fade text-center" id="nav-residential" role="tabpanel" aria-labelledby="nav-residential-tab">
                                <div class="works-slider residential-slider">
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-1.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-2.jpg">
                                    </a>
                                    <a class="works-slider-item" href="works/id">
                                        <img class="works-slider-item__image img-fluid cover" src="assets/images/alinco/works/image-3.jpg">
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 tab-pane fade text-center" id="nav-public" role="tabpanel" aria-labelledby="nav-public-tab">
                                <div class="works-slider public-slider">
                                </div>
                            </div>
                            <div class="col-12 tab-pane fade text-center" id="nav-industrial" role="tabpanel" aria-labelledby="nav-industrial-tab">
                                <div class="works-slider industrial-slider">
                                </div> 
                            </div>
                            <div class="col-12 tab-pane fade text-center" id="nav-local" role="tabpanel" aria-labelledby="nav-local-tab">
                                <div class="works-slider local-slider">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endsection
   