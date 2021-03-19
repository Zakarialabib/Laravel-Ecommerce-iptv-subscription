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
						{{ __('Checkout') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Checkout') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->


	<form class="needs-validation" action="javascript:;" id="payment_gateway_check" method="POST">
		@csrf
		<!-- Checkout Area Start -->
		<section class="checkout-area">
		  <div class="container mx-auto sm:px-4">
			<div class="flex flex-wrap ">
			  <div class="md:w-2/5 pr-4 pl-4 md:order-2 mb-4">
				<div class="cart-product">
				  <h4 class="flex justify-between items-center mb-3 g-title">
					<span>{{ __('Your cart') }}</span>
				  @php
					  $countitem = 0;
					  $cartTotal = 0;
					  if($cart){
						  foreach($cart as $p){
							  $cartTotal += (double)$p['price'] * (int)$p['qty'];
							  $countitem += $p['qty'];
						  }
					  }
	  
				  @endphp
					<span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600 rounded-full py-1 px-3 cart-item-view">{{ $countitem }}</span>
				  </h4>
				  <div class="block w-full overflow-auto scrolling-touch">
					<table class="w-full max-w-full mb-4 bg-transparent table-bordered">
					  <thead>
						<tr>
						  <th width="45%">{{ __('Product Name') }}</th>
						  <th width="25%" class="t-total">{{ __('Total') }}</th>
						</tr>
					  </thead>
					  <tbody>
					  @foreach ($cart as $id => $item)
					  <tr>
						<td>
						  @php
							  $product = App\Product::findOrFail($id);
						  @endphp
						  <h4 class="product-title"><a href="{{ route('front.product.details',$product->slug) }}">{{ $item['name'] }}</a></h4>
						</td>
						<td class="price">{{ $item['price'] }} * {{ $item['qty'] }}
						  = {{ Helper::showCurrencyPrice($item['price'] * $item['qty']) }}</td>
					  </tr>
					  @endforeach
					  </tbody>
					</table>
				  </div>
				  @php
					  $shipping_methods = DB::table('shippings')->where('language_id',$currentLang->id)->where('status',1)->get();
				  @endphp
				  @if(count($shipping_methods)>0)
				  <div class="add-shiping-methods">
					<h4 class="g-title">{{ __('Shipping Methods') }}</h4>
					<div class="block w-full overflow-auto scrolling-touch">
					  <table class="w-full max-w-full mb-4 bg-transparent table-bordered">
						<thead class="cart-header">
						  <tr>
							<th class="custom-space">#</th>
							<th>{{ __('Method') }}</th>
						  </tr>
						</thead>
						<tbody>
							@foreach ($shipping_methods as $method)
							<tr>
							  <td>
								<input type="radio" @if($loop->first ) checked="" @endif name="shipping_charge" data="{{ Helper::showPrice($method->cost) }}" class="shipping-charge"
								  value="{{ Helper::showPrice($method->cost) }}">
							  </td>
							  <td>
								<p><strong>{{ $method->title }} (<span>{{ Helper::showCurrencyPrice($method->cost) }}</span>)</strong></p>
								<p><small>{{ $method->subtitle }}</small></p>
							  </td>
							</tr>
							@endforeach
						</tbody>
					  </table>
					</div>
				  </div>
				  @endif
				  <div class="cart-summery">
					<h4 class="title g-title">
					  {{ __('Cart Summery') }} :
					</h4>
					<table class="w-full max-w-full mb-4 bg-transparent table-bordered">
					  <tr>
						<th width="33.3%">{{ __('Subtotal') }}</th>
						<td>{{ Helper::showCurrencyPrice($cartTotal) }} </td>
					  </tr>
					  @if($shipping_methods->count() > 0)
					  @php
						  $shipping_cost = Helper::showPrice(json_decode($shipping_methods,true)[0]['cost']);
					  @endphp
					  <tr>
						  <th width="33.3%">{{ __('Shiping Cost') }}</th>
						  <td>+ <span>{{ Helper::showCurrency() }}</span><span class="shipping_cost">{{ $shipping_cost }}</span> </td>
						</tr>
					  @endif
					  <tr>
						<th width="33.3%">{{ __('Total') }}</th>
						<td><span>{{ Helper::showCurrency() }}</span><span class="grand_total" data="{{ $cartTotal }}" >{{ $cartTotal + $shipping_cost }}</span> </td>
					  </tr>
					</table>
				  </div>
				</div>
	  
	  
			  </div>
			  <div class="md:w-3/5 pr-4 pl-4 md:order-1">
				
				  <div class="billing-area">
					<h4 class="mb-3 g-title">{{ __('Billing Address') }}</h4>
					  @php
						  $user = Auth::user();
					  @endphp
					<div class="mb-3">
					  <label for="name">{{ __('Name') }}</label>
					  <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="name" name="billing_name" value="{{ $user->name }}">
					  @if ($errors->has('billing_name'))
						<p class="text-red-600"> {{ $errors->first('billing_name') }} </p>
					  @endif
					</div>
					<div class="mb-3">
					  <label for="address">{{ __('Address') }}</label>
					  <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="billing_address" value="{{ $user->address }}" id="address">
					  @if ($errors->has('billing_address'))
						<p class="text-red-600"> {{ $errors->first('billing_address') }} </p>
					  @endif
					</div>
	  
					<div class="flex flex-wrap ">
					  <div class="md:w-1/2 pr-4 pl-4 mb-3">
						<label for="email">{{ __('Email') }}</label>
						<input type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="billing_email" value="{{ $user->email }}" id="email" >
						@if ($errors->has('billing_email'))
						<p class="text-red-600"> {{ $errors->first('billing_email') }} </p>
						@endif
					  </div>
					  <div class="md:w-1/2 pr-4 pl-4 mb-3">
						<label for="number">{{ __('Phone Number') }}</label>
						<input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="number" value="{{ $user->phone }}" name="billing_number"  >
						@if ($errors->has('billing_number'))
						<p class="text-red-600"> {{ $errors->first('billing_number') }} </p>
						@endif
					  </div>
					</div>
	  
					<div class="flex flex-wrap ">
					  <div class="md:w-2/5 pr-4 pl-4 mb-3">
						<label for="country">{{ __('Country') }}</label>
						<input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="billing_country" value="{{ $user->country }}" id="country">
						@if ($errors->has('billing_country'))
						<p class="text-red-600"> {{ $errors->first('billing_country') }} </p>
						@endif
					  </div>
					  <div class="md:w-1/3 pr-4 pl-4 mb-3">
						<label for="state">{{ __('City') }}</label>
						<input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="billing_city" value="{{ $user->city }}" id="city" >
						@if ($errors->has('billing_city'))
						<p class="text-red-600"> {{ $errors->first('billing_city') }} </p>
						@endif
					  </div>
					</div>
				  </div>
	  
				  <div class="ship-diff-toogle">
					<div class="custom-control custom-switch">
					  <input type="checkbox" class="custom-control-input" name="is_ship" id="change_address"{{ old('is_ship') == 'on' ? 'checked' : '' }}>
					  <label class="custom-control-label" for="change_address">{{ __('Ship to a different location?') }}</label>
					</div>
				  </div>
	  
				  <div class="shipping-area mb-4 {{ old('is_ship') == 'on' ? '' : 'hidden' }}" id="shipping-area">
					<h4 class="mb-3 g-title">{{ __('shipping Address') }}</h4>
						 <div class="mb-3">
					  <label for="name">{{ __('Name') }}</label>
					  <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="name" name="shipping_name">
					  @if ($errors->has('shipping_name'))
					  <p class="text-red-600"> {{ $errors->first('shipping_name') }} </p>
					  @endif
					</div>
					<div class="mb-3">
					  <label for="address">{{ __('Address') }}</label>
					  <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="shipping_address" id="address" >
					  @if ($errors->has('shipping_address'))
					  <p class="text-red-600"> {{ $errors->first('shipping_address') }} </p>
					  @endif
					</div>
	  
					<div class="flex flex-wrap ">
					  <div class="md:w-1/2 pr-4 pl-4 mb-3">
						<label for="email">{{ __('Email') }}</label>
						<input type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="shipping_email" id="email"  >
						@if ($errors->has('shipping_email'))
						<p class="text-red-600"> {{ $errors->first('shipping_email') }} </p>
						@endif
					  </div>
					  <div class="md:w-1/2 pr-4 pl-4 mb-3">
						<label for="number">{{ __('Phone Number') }}</label>
						<input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="number" name="shipping_number" >
						@if ($errors->has('shipping_number'))
						<p class="text-red-600"> {{ $errors->first('shipping_number') }} </p>
						@endif
					  </div>
					</div>
	  
					<div class="flex flex-wrap ">
					  <div class="md:w-2/5 pr-4 pl-4 mb-3">
						<label for="country">{{ __('Country') }}</label>
						<input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="shipping_country" id="country" >
						@if ($errors->has('shipping_country'))
						<p class="text-red-600"> {{ $errors->first('shipping_country') }} </p>
						@endif
					  </div>
					  <div class="md:w-1/3 pr-4 pl-4 mb-3">
						<label for="state">{{ __('City') }}</label>
						<input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="shipping_city" id="state" placeholder="{{ __('City') }}" >
						@if ($errors->has('shipping_city'))
						<p class="text-red-600"> {{ $errors->first('shipping_city') }} </p> 
						@endif
					  </div>
					  <div class="md:w-1/4 pr-4 pl-4 mb-3">
						<label for="zip-code">{{ __('Zip Code') }}</label>
						<input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="shipping_zip" id="zip-code" >
						@if ($errors->has('shipping_zip'))
						<p class="text-red-600"> {{ $errors->first('shipping_zip') }} </p>
						@endif
					  </div>
					</div>
				  </div>
				  
				  <div class="patment-area">
					<h4 class="mb-3 g-title"> {{ __('Select Payment Gateway') }} </h4>
					<div class="block my-3">
					  <div class="payment-gateway">
						  <ul class="select-payment">
							  @foreach (DB::table('payment_gateweys')->where('status',1)->get() as $gateway)
							  <li class="product_payment_gateway_check" data-href="{{ $gateway->id }}" id="{{ $gateway->type == 'automatic' ? $gateway->name : $gateway->title }}">
								<p class="mybtn2">{{ $gateway->name }}</p>
							  </li>
							  @endforeach
							</ul>
						  @if ($errors->has('gateway'))
							  <p class="text-red-600"> {{ $errors->first('gateway') }} </p>
						  @endif
					  </div>
					</div>
					<input type="hidden" value="" id="payment_gateway" name="payment_gateway" value="payment_gateway">
					<div class="payment_show_check hidden">
						<div class="gd-payment-form-wrapper">
							<div class="payment-form-wrapper-inner">
								<div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 willFlip" id="willFlip">
									<div class="front">
											<div class="flex justify-between">
												<img src="{{ asset('assets/front/img') }}/card/card_bank.png" width="50" style="filter: contrast(0)" height="50" alt="">
												<img src="{{ asset('assets/front/img') }}/card/visa.png" width="50" height="50" alt="">
											</div>
											<div class="mt-1">
												<div class="mb-4">
													<label for="cardNumber"></label>
													<input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded animate__animated animate__bounce animate__duration-2s" disabled readonly id="cardNumber">
												</div>
											</div>
											<div class="front-bottom">
												<div class="card-holder-content">
													<div class="mb-4">
														<label for="cardHolderValue">{{ __('Card Holder') }}</label>
														<input type="text" placeholder="FULL NAME" disabled class="cardHolder block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded animate__animated animate__bounce animate__duration-2s" id="cardHolderValue">
													</div>
												</div>
												<div class="card-expires-content">
													<div class="input-date">
														<label for="expiredMonth" class="text-right block">{{ __('Expires') }}</label>
														<div class="flex flex-wrap  content-date-input justify-end animate__animated animate__duration-2s animate__bounce">
															<input type="text" disabled class="cardHolder w-1/3 block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="expiredMonth">
															<h4 class="mt-1 p-2 slash-text"> / </h4>
															<input type="text" disabled class="cardHolder w-1/3 block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="expiredYear">
														</div>
													</div>
												</div>
											</div>
									</div>
									<div class="back">
										<div class="card-bar"></div>
										<div class="md:w-full pr-4 pl-4  back-middle">
											<div class="mb-4">
												<label for="cardCcv" class="text-right block">{{ __('CVC') }}</label>
												<input type="password" disabled class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="cardCcv">
											</div>
											<img src="{{ asset('assets/front/img') }}/card/visa.png" class="float-right" width="50" height="50" alt="">
										</div>
									</div>
								</div>
								<div class="paymentmainform" id="paymentmainform">
									<div class="mb-4">
										<label for="cardInput">{{ __('Card Number') }}</label>
										<input class="input card-input_field block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="card_number" id="cardInput">
									</div>
									<div class="mb-4">
										<label for="cardHolder">{{ __('Card Holder') }}</label>
										<input class="card-input_field block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="fullname" id="cardHolder">
									</div>
									<div class="flex flex-wrap ">
										<div class="md:w-1/3 pr-4 pl-4">
											<div class="mb-4">
												<label for="monthInput">{{ __('Expiration Date') }}</label>
												<select name="month" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded card-input_field" id="monthInput">
													<option class="opacity-75" readonly>{{ __('Month') }}</option>
												</select>
											</div>
										</div>
										<div class="md:w-1/3 pr-4 pl-4">
											<div class="mb-4">
												<label for="yearInput"></label>
												<select name="year" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded card-input_field mt-2" id="yearInput">
													<option class="opacity-75" readonly>{{ __('Year') }}</option>
												</select>
											</div>
										</div>
										<div class="md:w-1/3 pr-4 pl-4">
											<div class="mb-4">
												<label for="cwInput">{{ __('CVC') }}</label>
												<input type="text" name="cvc" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded card-input_field" id="cwInput">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
				  </div>
	  
					<hr class="mb-4">
					<button class="mybtn1" type="submit">{{ __('Place Order') }}</button>
				  </div>
			   
			  </div>
			</div>
		  </div>
		</section>
	</form>
	<input type="hidden" id="product_paypal" value="{{route('product.paypal.submit')}}">
	<input type="hidden" id="product_stripe" value="{{route('product.stripe.submit')}}">



@endsection
