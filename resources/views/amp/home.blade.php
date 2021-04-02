@extends('layouts.amp')
@push('styleinline')
.list_item .list_img amp-img img {width:100%;height:auto;object-fit:cover}.list11 .list_img amp-img img {width:100%;height:auto;object-fit:cover}.list11 .list_title{margin:0}.list12 .amp-carousel-slide a amp-img img {width:100%;height:100%;object-fit:cover}.content-events{width:100%}.row-section amp-img img {width:100%;height:100%;object-fit:cover}.block4 amp-img img {object-fit: contain;}.thumbCover_85:before{padding-top:85%}.list12 .amp-carousel-slide a:before{z-index:2}
@endpush
@section('content')

<div id="body-wrapper">
            <section id="main" class="main">
                <div class="menu custom-container">
                    <nav class="navbar navbar-expand-lg justify-content-end align-items-end animate__fadeInDownBig wow" data-wow-duration="2s">
                        <a class="navbar-brand" href="#">
                            <img class="img-fluid" src="assets/images/alinco/main/logo.png" alt="logo-alinco" />
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                            
                            @foreach($menu as $title)

                                <li class="nav-item active">
                                    @if($title->id == 79)
                                        <a class="nav-link" href="{{$title->slug}}" target="_blank">{{$title->title}}</a>
                                    @else
                                        <a class="nav-link" href="#" data-toggle="modal" data-target="#modalWorkList_{{$title->id}}">{{$title->title}}</a>
                                    @endif
                                </li>
                            @endforeach
							<li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="/" <?php if($current_locale == 'vi'):?> class="active" <?php endif;?> id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        EN
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/en" <?php if($current_locale == 'vi'):?> class="active" <?php endif;?>>VI</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="main__wrapper show-filter">
                    <div class="main__slider">
                        <div class="main__slider__1"></div>
                        <div class="main__slider__2"></div>
                        <div class="main__slider__3"></div>
                    </div>
                </div>
                <div class="main__content" >
                    <img class="content__logo img-fluid animate__fadeInDownBig wow" src="assets/images/alinco/main/logo.png" alt="logo-alinco"  data-wow-duration="2s"/>
                    <div class="content__discover animate__fadeInDownBig wow" data-wow-duration="2s">
                        <div class="content__discover__text">DISCOVER NOW</div>
                    </div>
                </div>
            </section>
            <!-- /////////////// -->
            @foreach($menu as $test)
             <div class="modal fade modal-menu modal-fullscreen" id="modalWorkList_{{$test->id}}" tabindex="-1" role="dialog" aria-labelledby="modalWorkListLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body custom-container">
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <nav class="modal-list col-12">
                                <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                                @foreach($category as $cat)
                                    @if($test->id == $cat->cid)
                                        <a class="nav-item nav-link" id="nav-urban-tab" data-toggle="tab" href="#nav-urban" role="tab" aria-controls="nav-urban" aria-selected="true">{{$cat->title}}</a>
                                    @endif
                                 @endforeach 
                                </div>
                            </nav>
                            <div class="tab-content col-12" id="nav-tabContent">
                                <div class="col-12 tab-pane fade text-center" id="nav-urban" role="tabpanel" aria-labelledby="nav-urban-tab">
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
                </div>
            </div>
           
            @endforeach

@endsection
@push('og-meta')
	<link rel="canonical" href="{{URL::to('/')}}">
	<title>@if(isset($page->meta_title) && $page->meta_title != '') {{$page->meta_title}} @else {{$page->title}} @endif</title>
	<meta name="description" content="@if(isset($page->meta_desc) && $page->meta_desc != '') {{$page->meta_desc}} @else {{$page->excerpt}} @endif" />
	<meta name="keywords" content="Tư vấn đầu tư định cư Mỹ, đầu tư Mỹ, chương trình EB-5, thẻ xanh Mỹ"/>   
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<meta property="og:title" content="@if(isset($page->meta_title) && $page->meta_title != '') {{$page->meta_title}} @else {{$page->excerpt}} @endif">
	<meta property="og:description" content="@if(isset($page->meta_desc) && $page->meta_desc != '') {{$page->meta_desc}} @else {{$page->excerpt}} @endif">
	<meta property="og:site_name" content="@if(isset($page->meta_title) && $page->meta_title != '') {{$page->meta_title}} @else {{$page->title}} @endif">
	<meta property="og:type"   content="article" /> 
	<meta property="og:image" content="@if($page->resource_id) {{$page->image}} @else <?php echo URL::to('/').'/images/no-image.jpg';?> @endif"/>
@endpush