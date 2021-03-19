@extends('front.layout')

@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")
@section('content')

	<!--Main Breadcrumb Area Start -->
	<div class="main-breadcrumb-area" style="background-image : url('{{ asset('assets/front/img/' . $commonsetting->breadcrumb_image) }}');">
        <div class="overlay"></div>
		<div class="container mx-auto sm:px-4">
			<div class="flex flex-wrap ">
				<div class="lg:w-full pr-4 pl-4">
					<h1 class="pagetitle">
						{{ __('Media') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Media') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

<!-- Media Area Start -->
	<section class="media-page">
		<div class="container mx-auto sm:px-4">
			<div class="flex flex-wrap  justify-center">
				<div class="lg:w-1/2 pr-4 pl-4 md:w-2/3 pr-4 pl-4">
					<div class="section-heading">
						<h2 class="title">
							{{ $sectionInfo->entertainment_title }}
						</h2>
						<p class="text">
							{{ $sectionInfo->entertainment_subtitle }}
						</p>
					</div>
				</div>
			</div>
			<div class="flex flex-wrap ">
                @foreach($entertainments as $key => $entertainment)
				<div class="lg:w-1/4 pr-4 pl-4 md:w-1/2 pr-4 pl-4">
					<div class="single-service entertainment">
						<div class="left-area">
							<img src="{{ asset('assets/front/img/'.$entertainment->icon) }}" alt="">
						</div>
						<div class="right-area">
							<h4 class="title">
								{{ $entertainment->counter }}{{ __('+') }}
							</h4>
							<p class="sub-title">{{ $entertainment->name }}</p>
						</div>
					</div>
                </div>
                @endforeach
			</div>
		</div>
		<div class="container mx-auto sm:px-4 mt-5 pt-3">
			<div class="flex flex-wrap  justify-center">
				<div class="lg:w-1/2 pr-4 pl-4 md:w-2/3 pr-4 pl-4">
					<div class="section-heading">
						<h2 class="title">
						{{ $sectionInfo->media_zone_title }}
						</h2>
						<p class="text">
						{{ $sectionInfo->media_zone_subtitle }}
						</p>
					</div>
				</div>
			</div>
			<div class="flex flex-wrap ">
                @foreach($mediazones as $key => $mediazone)
				<div class="lg:w-1/4 pr-4 pl-4 md:w-1/2 pr-4 pl-4">
					<a href="{{ $mediazone->link }}" class="single-service flex items-start block" target="_blank">
						<div class="left-area">
								<img src="{{ asset('assets/front/img/'.$mediazone->icon) }}" alt="">
						</div>
						<div class="right-area">
							<h4 class="title">
								{{ $mediazone->name }}
							</h4>
						</div>
					</a>
                </div>
                @endforeach
			</div>
		</div>
	</section>
<!-- Media Area End-->

@endsection
