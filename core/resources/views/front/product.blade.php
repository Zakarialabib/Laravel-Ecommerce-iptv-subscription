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
						{{ __('Shop') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Shop') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

 	<!-- Shop Area Start -->
     <section class="shop-section">
		<div class="container mx-auto sm:px-4">
			<div class="flex flex-wrap ">
				<div class="lg:w-full pr-4 pl-4">
					<div class="product-filter ">
						<div class="left">
							<p>{{ __('Total Available Products :') }} {{ $count_product }}</p>
						</div>
						<div class="right">
							<form action="{{ route('front.products') }}" method="GET" class="product-search-form">
									<input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="search" placeholder="{{ __('Search') }}" value="{{ request()->input('search')}}">
									<button type="submit"><i class="fas fa-search"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="flex flex-wrap  ">
				@foreach ($products as $product)
				<div class="lg:w-1/4 pr-4 pl-4 md:w-1/2 pr-4 pl-4">
					<div class="single-product">
						<div class="img">
							<a href="{{ route('front.product.details', $product->slug) }}">
						    	<img src="{{ asset('assets/front/img/'. $product->image) }}" alt="{{ $product->title }}">
						    </a>
						</div>
						<div class="content">
							<h4 class="name">
								<a href="{{ route('front.product.details', $product->slug) }}">{{ $product->title }}</a>
							</h4>
							<div class="price">
								{{ Helper::showCurrency() }}{{ $product->current_price }} <del>{{ Helper::showCurrency() }}{{ $product->current_price }}</del>
							</div>
							@if(Auth::user())
								<a data-href="{{route('add.cart',$product->id)}}" href="#" class="mybtn1 add-cart-btn first cart-link"> {{__('Add
								to Cart')}} <i class="fas fa-shopping-cart"></i></a>
							@else
								<a href="{{ route('user.login') }}" class="mybtn1">{{ __('Add to Cart') }}</a>
							@endif
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<div class="flex flex-wrap ">
				<div class="inline-block mx-auto">
				  {{$products->links()}}
				</div>
			  </div>
		</div>
	</section>
	<!-- Shop Area End -->

@endsection
