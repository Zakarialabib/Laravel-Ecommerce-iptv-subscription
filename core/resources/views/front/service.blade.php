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
					<h1 class="pagetitle relative">
						{{ __('Service') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Service') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
    <!--Main Breadcrumb Area End -->
    
    <!-- Service Area Start -->
	<section class="service-area service-page">
		<div class="container mx-auto sm:px-4">
			<div class="flex flex-wrap ">
				@foreach($services as $key => $service)
				<div class="lg:w-1/3 pr-4 pl-4 md:w-1/2 pr-4 pl-4">
					<a href="{{ route('front.service.details', $service->slug) }}" class="single-service">
						<div class="left-area">
							<img class="w-80" src="{{ asset('assets/front/img/'.$service->icon) }}" alt="">
						</div>
						<div class="right-area">
							<h4 class="title">
								{{ $service->name }}
							</h4>
							<p class="text">
								{{ (strlen(strip_tags(Helper::convertUtf8($service->content))) > 120) ? substr(strip_tags(Helper::convertUtf8($service->content)), 0, 120) . '...' : strip_tags(Helper::convertUtf8($service->content)) }}
							
							</p>
						</div>
					</a>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- Service Area End -->

@endsection
