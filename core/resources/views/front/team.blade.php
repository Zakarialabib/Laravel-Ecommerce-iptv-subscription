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
						{{ __('Team') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Team') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
    <!--Main Breadcrumb Area End -->
    
	<!-- Team Area Start -->
	<section class="team team-page">
		<div class="container mx-auto sm:px-4">
			<div class="flex flex-wrap ">
				@foreach($teams as $key => $team)
				<div class="lg:w-1/3 pr-4 pl-4 md:w-1/2 pr-4 pl-4">
					<div class="team-member">
						<div class="member-pic">
						<img src="{{ asset('assets/front/img/'.$team->image) }}" alt="">
						</div>

						<div class="social">
							<ul>
								@if($team->url1 && $team->icon1)
								<li>
									<a href="{{ $team->url1 }}">
										<i class="{{ $team->icon1 }}"></i>
									</a>
								</li>
								@endif
								@if($team->url2 && $team->icon2)
								<li>
									<a href="{{ $team->url2 }}">
										<i class="{{ $team->icon2 }}"></i>
									</a>
								</li>
								@endif
								@if($team->url3 && $team->icon3)
								<li>
									<a href="{{ $team->url3 }}">
										<i class="{{ $team->icon3 }}"></i>
									</a>
								</li>
								@endif
							</ul>
						</div>

						<div class="member-data">
						<div class="name">
							<h4 class="title">{{ $team->name }}</h4>
							<p class="position">{{ $team->dagenation }}</p>
						</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<div class="flex flex-wrap ">
				<div class="lg:w-full pr-4 pl-4 text-center">
					<div class="inline-block">
						{{ $teams->links() }}
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Team Area End -->

@endsection
