@extends('page.layout')
@section('content')

<div id="body-wrapper">
    <section id="firm" class="firm">
        @include('menu.menu_list')
        <div class="tab-firm">
            <div class="custom-container">
                <nav class="modal-list col-12">
                    <div class="nav nav-tabs justify-content-start animate__fadeIn wow" id="nav-tab" role="tablist">
                        @foreach($categories as $cat)
                        @if($cat->alias_en === 'porfolio')
                            <a class="nav-item nav-link {{ ($cat->slug === $about->slug) ? 'active' : '' }}" href="{{$porfolio->content_vn}}" target="_blank" class="nav-item nav-link" id="nav-urban-tab" role="tab" aria-controls="nav-urban" aria-selected="true">{{$cat->title}}</a>
                        @else
                        <a class="nav-item nav-link {{ ($cat->slug === $about->slug) ? 'active' : '' }}" id="nav-{{ $cat->slug }}-tab" data-toggle="tab" data-href="{{ $cat->slug }}" href="#nav-{{ $cat->slug }}" role="tab" aria-controls="nav-{{ $cat->slug }}" aria-selected="true">{{ $cat->title}}</a>
                        @endif
                        @endforeach
                    </div>
                </nav>
                
                <div class="tab-content px-0 col-12 d-flex justify-content-center" id="nav-tabContent">
                <div class="col-12 tab-pane fade text-center show active" id="nav-@lang('page.id_about')" role="tabpanel" aria-labelledby="nav-@lang('page.id_about')-tab">
                    <div class="container">
                        <div class="row about-text">
                            <div class="col-12 text-left pl-0 pl-xl-3">
                            {!! $about->description !!}
                            </div>
                            
                        </div>
                    </div>
                    </div>
                    
                    <div class="col-12 tab-pane fade text-center" id="nav-@lang('page.id_teams')" role="tabpanel" aria-labelledby="nav-@lang('page.id_teams')-tab">
                        <div class="row about-imagefirm-slider team-slider">
                            @foreach($data['hoidong'] as $team)
                            <div class="col-2-5 mb-4 firm-slider-item">
                                <div class="team-image">
                                    <img class="firm-slider-item__image img-fluid cover" src="{{$team->image}}">
                                </div>
                                <div class="row team-text">
                                    <div class="col-12 team-text-name">
                                        <p>{{$team->title}}</p>
                                    </div>
                                    <div class="col-12 team-text-position">
                                        <p>{!!$team->excerpt!!}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="col-12 tab-pane fade text-center" id="nav-@lang('page.id_awards')" role="tabpanel" aria-labelledby="nav-@lang('page.id_awards')-tab">
                        <div class="row reward-slider">
                            @foreach($award['giaithuong'] as $awards)
                            <div class="col-12 col-sm-6 col-lg-3 mb-4 firm-slider-item">
                            <a class="" href="{{ action('SiteController@firm') }}/{{ $awards->id }}">
                                <div class="reward-image">
                                    <img class="firm-slider-item__image img-fluid cover" src="{{$awards->image}}">
                                </div>
                                <div class="row reward-text">
                                    <div class="col-12 reward-text-name">
                                    <p>{{$awards->title}}</p>
                                    </div>
                                </div>
                            </a>
                            </div>
                            @endforeach
                        </div>
                       
                    </div>
                    <div class="col-12 tab-pane fade text-center" id="nav-@lang('page.id_blogs')" role="tabpanel" aria-labelledby="nav-@lang('page.id_blogs')-tab">
                        <div class="row reward-slider">
                            @foreach($blog['tintuc'] as $tintuc)
                            <div class="col-12 col-sm-6 col-lg-3 mb-4 firm-slider-item">
                                <a class="" href="{{ action('SiteController@firm') }}/{{ $tintuc->id }}">
                                <div class="reward-image">
                                    <img class="firm-slider-item__image img-fluid cover" src="{{$tintuc->image}}">
                                </div>
                                <div class="row reward-text">
                                    <div class="col-12 reward-text-name">
                                        <p>{{$tintuc->title}}</p>
                                    </div>
                                </div>
                            </a>
                            </div>
                            @endforeach
                        </div>
                       
                    </div>
                    {{-- <div class="col-12 tab-pane fade text-center" id="nav-@lang('page.id_blogs')" role="tabpanel" aria-labelledby="nav-@lang('page.id_blogs')-tab">
                        <div class="row firm-slider reward-slider">
                        @foreach($blog['tintuc'] as $tintuc)
                            <div class="col-12 col-sm-4 col-lg-3 mb-4 firm-slider-item">
                                <a class="" href="{{ action('SiteController@firm') }}/{{ $tintuc->id }}">
                                    <div class="team-image">
                                        <img class="firm-slider-item__image img-fluid cover" src="{{$tintuc->image}}">
                                    </div>
                                    <div class="row team-text">
                                        <div class="col-12 team-text-name text-center">
                                        <p>{{$tintuc->title}}</p>
                                        </div>
                                        
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div> --}}
                    <div class="col-12 col-xl-11 tab-pane fade text-center" id="nav-@lang('page.id_contact')" role="tabpanel" aria-labelledby="nav-@lang('page.id_contact')-tab">
                        <div class="row mx-0">
                            <div class="col-12 col-sm-6 text-justify pr-4 pr-sm-5">
                                <div class="row mb-5 mb-sm-0">
                                    <div class="col-12 mb-4 mb-sm-5" id="mapHCM"></div>
                                    <div class="contact-text col-12">
                                        <p class="contact-text-address">{{$diachi_hcm->title}}</p>
                                        <p>{{$diachi_hcm->description}}<br/>
                                        {{$diachi_hcm->excerpt}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 text-justify pr-4 pr-sm-5">
                                <div class="row mb-5 mb-sm-0">
                                    <div class="col-12 mb-4 mb-sm-5" id="mapHN"></div>
                                    <div class="contact-text col-12">
                                        <p class="contact-text-address">{{$diachi_hn->title}}</p>
                                        <p>{{$diachi_hn->description}}<br/>
                                        {{$diachi_hn->excerpt}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-justify py-3">
                                <div class="row">
                                    <div class="col-12 contact-mail">
                                    @foreach($email as $emails)
                                        <p class="contact-mail-address">{{$emails->title}}</p>
                                        <p>{{$emails->description}}</p>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-justify border-top pt-0 pt-lg-5 my-3 my-lg-5">
                                <div class="row">
                                    <div class="col-12 offset-sm-1 offset-md-2 col-sm-10 col-md-8 text-center contact-form">
                                        <form id="contact_form" method="POST" action="{!! action('SiteController@postcontact') !!}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="row">
                                                <div class="col-12 mt-5 mb-4 mb-lg-5">
                                                    <p class="contact-form-address">@lang('page.contact_us')</p>
                                                </div>
                                                <div class="col-6 mb-3 pr-2 pr-lg-3">
                                                    <input name = "name" type="text" class="form-control" placeholder="@lang('page.name')">
                                                </div>
                                                <div class="col-6 mb-3 pl-2 pl-lg-3">
                                                    <input name = "phone" type="text" class="form-control" placeholder="@lang('page.phone')">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <input name = "title" type="text" class="form-control" placeholder="@lang('page.title')">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <textarea name="message" class="form-control" rows="4" style="width: 100%" placeholder="@lang('page.message')"></textarea>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <button type="submit" class="submit-form">@lang('page.send') <i class="fas fa-chevron-circle-right"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
                    document.documentElement.style.setProperty('--scrollbar-width', (window.innerWidth - document.documentElement.clientWidth) + "px");

                    wow = new WOW({
                        
                    });
                    <?php if(isset($slug) && $slug) {?>
                        $('#nav-<?=$slug?>-tab').tab('show');
                    <?php }?>



                    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                        var href = '{{ action('SiteController@firm') }}/' + $(this).attr("data-href");
                        history.replaceState(null, null, href);
                    });
                });
                var mapStyle = [
                    {
                        "featureType": "administrative",
                        "elementType": "all",
                        "stylers": [
                            {
                                "saturation": "-100"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.province",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "all",
                        "stylers": [
                            {
                                "saturation": -100
                            },
                            {
                                "lightness": 65
                            },
                            {
                                "visibility": "on"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [
                            {
                                "saturation": -100
                            },
                            {
                                "lightness": "50"
                            },
                            {
                                "visibility": "simplified"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [
                            {
                                "saturation": "-100"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "all",
                        "stylers": [
                            {
                                "lightness": "30"
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "all",
                        "stylers": [
                            {
                                "lightness": "40"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [
                            {
                                "saturation": -100
                            },
                            {
                                "visibility": "simplified"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "hue": "#ffff00"
                            },
                            {
                                "lightness": -25
                            },
                            {
                                "saturation": -97
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "lightness": -25
                            },
                            {
                                "saturation": -100
                            }
                        ]
                    }
                ]
                
                // Initialize and add the map
                function initMap() {
                    var lathcm = {{$diachi_hcm->lat ? $diachi_hcm->lat : "null"}};
                    var lnghcm = {{$diachi_hcm->lng ? $diachi_hcm->lng : "null"}};
                    var lathn = {{$diachi_hn->lat ? $diachi_hn->lat : "null"}};
                    var lnghn = {{$diachi_hn->lng ? $diachi_hn->lng : "null"}};
                    // The location of Uluru
                    
                    // The location of Uluru
                    if(lathcm && lnghcm) {
                        var hcm = {lat: lathcm, lng: lnghcm };
                        var mapHCM = new google.maps.Map(
                        document.getElementById('mapHCM'), {zoom: 18, center: hcm, styles: mapStyle});
                        var markerHCM = new google.maps.Marker({position: hcm, map: mapHCM});
                    }
                    if(lathn && lnghn)
                    {
                        var hn = {lat: lathn, lng: lnghn };
                        var mapHN = new google.maps.Map(
                        document.getElementById('mapHN'), {zoom: 18, center: hn, styles: mapStyle});
                        var markerHN = new google.maps.Marker({position: hn, map: mapHN});
                    }
                }
            </script>
            <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCU9MydA5JKjAcUxeK94X3uTFjM-xOVK1w&callback=initMap">
            </script>
            
	
@endpush