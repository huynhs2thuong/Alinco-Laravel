@extends('layouts.amp')
@push('styleinline')
.list2 .col-xs-6{width:50%}.row.list>div:first-child{margin-top:0}h1{margin-bottom:0;padding-bottom:40px}.list2 .col-md-6{width:100%}.list2 .list_desc{text-align:center}.list2 div.col-md-6 h2{text-align:center}
@endpush
<?php 
	if(isset($module)){
		$title = $module->title;
	}elseif(isset($page)){
		$title = $page->title;
	}else{
		$title = 'title';
	}
?>
@section('title', $title )

@section('content')
<section class="top-page bg-white">
	<?php 
		if(isset($module)){
			$title = $module->title;
		}elseif(isset($page)){
			$title = $page->title;
		}else{
			$title = 'title';
		}
	?>
	<div id="breadcrumbs">
		<div class="container">
		<ul class="breadcrumb">
			<li><a href="{{ ($current_locale == 'vi') ? '/amp' : '/en/amp' }}">@lang('menu.page.home') </a></li>
			@if(isset($secPage))
			<li>
				<a href="{{action('AmpController@showPageDichVu',$secPage->slug)}}">{{$secPage->title}}</a>
			</li>
			@endif
			<li>
					{{$title}}
			</li>
		</ul>
	</div>
	</div>
	<div class="container"> 
		<div class="page-title wow">
				<h1 class="title"> <span>{{$title}}</span></h1>
		</div>
	</div>	
</section>
<section class="u003 row-section  bg-white wow"  >
	<div class="container">
		@if(isset($doitacancu))
			@if(count($doitacancu)>0)
			<div class="simple-tab">
			    <div class="list2 list2-2">
			      <div class="row list grid-space-0">
			      	<?php 
			      		if($current_locale == 'en'){
							$slug = 'us-settlement-service';
				            $permalink = 'partners';
			      		}else{
			      			$slug = 'dich-vu-an-cu';
            				$permalink = 'doi-tac-an-cu';
			      		}
			      	?>
					@foreach($doitacancu->chunk(ceil(count($doitacancu) / 2)) as $doitac)
						<div class="col-sm-6 col-md-6 col-xs-6 col-xxs-12">
							 <?php  $i = 1?>
							@foreach($doitac as $item)
								<div class="list_item @if($i == 1) {{ 'ptop0' }} @endif">
								<div class="inner">
					              <a href="{{route('dtAncuChitietamp',['slug'=>$slug,'permalink'=>$permalink,'partners'=>$item->slug])}}" class="list_img">
					              	<amp-img src="{{$item->getImage('thumbnail')}}" width="206" height="184" layout="responsive" alt="" />
					              </a>
					              
					              <div class="list_desc">
					                <h4 class="list_title"><a href="{{route('dtAncuChitietamp',['slug'=>$slug,'permalink'=>$permalink,'partners'=>$item->slug])}}" class="list_img">{{$item->title}}</a></h4>
					                <p>{{$item->excerpt}}</p></div>
					              </div>
					            </div>
							<?php $i++?>
							@endforeach
						</div>
					@endforeach
				</div>
				</div>
			</div>
			@endif
		@else
			@include('partials.amp.partner')
		@endif
	</div>
</section>
@endsection
@if(isset($module))
 <?php $page = $module ?>
@endif
@push('og-meta')
	<?php
		$imagepage = URL::to('/').'/images/no-image.jpg';
		if(isset($page->resource_id)){
			$imagepage = $page->image;
		}else{
			if(isset($categories)){
				if(count($categories)>0){
					$imagepage = $categories[0]->posts[0]->getImage('thumbnail');
				}
			}
			elseif(isset($doitacancu)){
				if(count($doitacancu)>0){
					$imagepage = $doitacancu[0]->getImage('thumbnail');
				}
			}
		}
	?>
	@include('partials.canonical')
	<title>{{ $title }}</title>
	<meta name="title" content="{{$title}}">
	<meta name="description" content="@if(isset($page->meta_desc) && $page->meta_desc != '') {{$page->meta_desc}} @else {{$page->excerpt}} @endif" />
	<meta name="keywords" content="T?? v???n ?????u t?? ?????nh c?? M???, ?????u t?? M???, ch????ng tr??nh EB-5, th??? xanh M???"/>   
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<meta property="og:title" content="{{$title}}">
	<meta property="og:description" content="@if(isset($page->meta_desc) && $page->meta_desc != '') {{$page->meta_desc}} @else {{$page->excerpt}} @endif">
	<meta property="og:site_name" content="@if(isset($page->meta_desc) && $page->meta_title != '') {{$page->meta_desc}} @else {{$page->excerpt}} @endif">
	<meta property="og:type"   content="article" /> 
	<meta property="og:image" content="{{$imagepage}}"/>
	@if(isset($secPage))
	<script type="application/ld+json">
	{
		"@context": "http://schema.org",
		"@type": "BreadcrumbList",
		"itemListElement": [{
			"@type": "ListItem",
			"position": 1,
			"item": {
				"@id": "{{URL::to('/')}}{{ ($current_locale == 'vi') ? '/' : '/en' }}",
				"name": "Home"
			}
		},{
			"@type": "ListItem",
			"position": 2,
			"item": {
				"@id": "{{action('AmpController@showPageDichVu',$secPage->slug)}}",
				"name": "{{ $secPage->title }}"
			}
		},{
			"@type": "ListItem",
			"position": 3,
			"item": {
				"@id": "{{ Request::url() }}",
				"name": "{{ $title }}"
			}
		}
		]
	}
	</script>
	@else
	<script type="application/ld+json">
	{
		"@context": "http://schema.org",
		"@type": "BreadcrumbList",
		"itemListElement": [{
			"@type": "ListItem",
			"position": 1,
			"item": {
				"@id": "{{URL::to('/')}}{{ ($current_locale == 'vi') ? '/' : '/en' }}",
				"name": "Home"
			}
		},{
			"@type": "ListItem",
			"position": 2,
			"item": {
				"@id": "{{ Request::url() }}",
				"name": "{{ $title }}"
			}
		}
		]
	}
	</script>
	@endif
@endpush