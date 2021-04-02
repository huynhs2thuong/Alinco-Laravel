@extends('page.layout')
@section('content')
<div id="body-wrapper">
    <section id="works" class="works">
        @include('menu.menu_work')
        <div class="tab-works">
            <div class="custom-container">
                <nav class="modal-list col-12">
                    <div class="nav nav-tabs justify-content-start animate__fadeIn wow" id="nav-tab" role="tablist">
                    @foreach($category as $cat)
                    <a class="nav-item nav-link {{ ($cat->slug === $all->slug) ? 'active show' : '' }}" id="nav-{{ $cat->slug }}-tab" data-toggle="tab" data-href="{{ $cat->slug }}" href="#nav-{{ $cat->slug }}" role="tab" aria-controls="nav-{{ $cat->slug }}" aria-selected="true">{{ $cat->title}}</a> 
                    @endforeach
                    </div>
                </nav>
                <div class="tab-content px-0 col-12" id="nav-tabContent">
                @foreach($category as $cat)
                    <div class="col-12 tab-pane fade text-center {{ ($cat->slug === $all->slug) ? 'show active' : '' }} " id="nav-{{ $cat->slug }}" role="tabpanel" aria-labelledby="nav-{{ $cat->slug }}-tab">
                        <div class="row works-slider urban-slider">
                            @if($cat->id == $all->id)
                                @foreach( $data_img['projects'] as $project)
                                <div class="col-12 col-sm-4 col-lg-3 pb-5">
                                    <a href="{{ action('SiteController@work') }}/{{$cat->slug}}/{{ $project->id }}">
                                        <div class="works-slider-item item-{{ $project->id }}">
                                            <img class="works-slider-item__image img-fluid cover" src="{{$project->image}}">
                                        </div>
                                        <div class="row team-text">
                                            <div class="col-12 team-text-name text-center">
                                            <p>{{$project->title}}</p>
                                            </div>
                                        </div> 
                                    </a>
                                </div>
                                @endforeach
                            @else             
                                @foreach( $data_img['projects'] as $project)
                                    @if(in_array($cat->id,$project->cat_id))
                                        <div class="col-12 col-sm-4 col-lg-3 pb-5">
                                            <a href="{{ action('SiteController@work') }}/{{$cat->slug}}/{{ $project->id }}">
                                                <div class="works-slider-item item-{{ $project->id }}">
                                                    <img class="works-slider-item__image img-fluid cover" src="{{$project->image}}">
                                                </div> 
                                                <div class="row team-text">
                                                    <div class="col-12 team-text-name text-center">
                                                    <p>{{$project->title}}</p>
                                                    </div>
                                                </div>   
                                            </a>
                                        </div>
                                        <style>
                                            .item-{{$project->id}}::after{
                                                content: "{{$project->title}}" !important;
                                            }
                                        </style>
                                    @endif
                                @endforeach
                                
                            @endif
                        </div>
                    </div>
                @endforeach
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
                        var href = '{{ action('SiteController@work') }}/' + $(this).attr("data-href");
                        history.replaceState(null, null, href);
                    });
                });
    </script>
	
@endpush
