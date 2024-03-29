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
						{{ __('User Dashboard') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('User Dashboard') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

    <!-- User Dashboard Start -->
	<section class="user-dashboard-area">
		<div class="container mx-auto sm:px-4">
		  <div class="flex flex-wrap ">
			<div class="lg:w-1/4 pr-4 pl-4">
				@includeif('user.dashboard-sidenav')
			</div>
			<div class="lg:w-3/4 pr-4 pl-4 ">
			  <div class="dashboard-inner pricingPlan-section  packag-page p-0">
				<div class="flex flex-wrap ">
					@if($packagedetail)
					<div class="lg:w-2/5 pr-4 pl-4 md:w-3/4">
						<h4 class="mb-4"><strong>{{ __('Active Package :') }}</strong></h4>
						<div class="single-price">
							<h4 class="name">
								{{ $packagedetail->name }}
							</h4>
							<div class="mbps">
								{{ $packagedetail->speed }} <span>{{ __('Mbps') }}</span>
							</div>


							<div class="list">
								@php
									$feature = explode( ',', $packagedetail->feature );
									for ($i=0; $i < count($feature); $i++) { 
										echo '<li><p href="mailto:'.$feature[$i].'">'.$feature[$i].'</p></li>';
									}
								@endphp
							</div>
							<div class="bottom-area">
								<div class="price-area">
									<div class="price-top-area">
										@if($packagedetail->discount_price == null)
											<p class="price showprice">{{ $packagedetail->price }}{{ Helper::showCurrency() }}</p>
										@else
											<p class="discount_price showprice">{{ $packagedetail->discount_price }}{{ Helper::showCurrency() }}</p>
											<p class="price discounted"><del>{{ $packagedetail->price }}{{ Helper::showCurrency() }}</del></p>
										@endif
									</div>
									<p class="time">
										{{ $packagedetail->time }}
									</p>
								</div>
							</div>
						</div>
					</div>
					@else
						<div class="lg:w-full pr-4 pl-4">
							<h4 class="mb-4"><strong>{{ __('Welcome') }}, {{ Auth::user()->name }}</strong></h4>
							<h6>{{ __("You don't purchase any package!!") }}</h6>
						</div>
					@endif
				</div>
			  </div>
			</div>
		  </div>
		</div>
	
	  </section>
    <!-- User Dashboard End -->

@endsection


