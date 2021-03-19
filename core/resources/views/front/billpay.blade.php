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
						{{ __('Pay Bill') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Pay Bill') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

	<!-- PayBill Area Start -->
	<form class="needs-validation" action="javascript:;" id="payment_gateway_check" method="POST">
		@csrf
	<section class="pricingPlan-section packag-page">
		<div class="container mx-auto sm:px-4">
			<div class="flex flex-wrap ">
				@if(Auth::user()->activepackage !== null)
					@if($billpayed !== null)
						<div class="lg:w-2/3 pr-4 pl-4">
							<h4 class="mb-4"><strong>{{ __('This month bill is paid :') }}</strong></h4>
							<table class="w-full max-w-full mb-4 bg-transparent border table-striped">
								<tbody>
									<tr>
										<th scope="row">{{ __('Username') }}</th>
										<td>{{ Auth::user()->username }}</td>
									</tr>
									<tr>
										<th scope="row">{{ __('Email') }}</th>
										<td>{{ Auth::user()->email }}</td>
									</tr>
									<tr>
										<th scope="row">{{ __('Phone') }}</th>
										<td>{{ Auth::user()->phone }}</td>
									</tr>
									<tr>
										<th scope="row">{{ __('Current Date') }}</th>
										<td>{{ \Carbon\Carbon::now()->format('M d, Y') }}</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="lg:w-1/3 pr-4 pl-4">
							<h4 class="mb-4"><strong>{{ __('Active Package :') }}</strong></h4>
							<div class="single-price">
								<h4 class="name">
									{{ $packagedetails->name }}
								</h4>
								<div class="mbps">
									{{ $packagedetails->speed }} <span>{{ __('Mbps') }}</span>
								</div>


								<div class="list">
									@php
									$feature = explode( ',', $packagedetails->feature );
									for ($i=0; $i < count($feature); $i++) { 
										echo '<li><p href="mailto:'.$feature[$i].'">'.$feature[$i].'</p></li>';
									}
								@endphp
								</div>

								<div class="bottom-area">
									<div class="price-area">
										<div class="price-top-area">
											@if($packagedetails->discount_price == null)
												<p class="price showprice">{{ Helper::showCurrency() }}{{ $packagedetails->price }}</p>
											@else
												<p class="discount_price showprice">{{ Helper::showCurrency() }}{{ $packagedetails->discount_price }}</p>
												<p class="price discounted"><del>{{ Helper::showCurrency() }}{{ $packagedetails->price }}</del></p>
											@endif
										</div>
										<p class="time">
											{{ $packagedetails->time }}
										</p>
									</div>
								</div>
							</div>
						</div>
					@else
						<div class="lg:w-2/3 pr-4 pl-4">
							<h4 class="mb-4"><strong>{{ __('Pay bill for this month :') }}</strong></h4>
							<table class="w-full max-w-full mb-4 bg-transparent border table-striped">
								<tbody>
									<tr>
										<th scope="row">{{ __('Username') }}</th>
										<td>{{ Auth::user()->username }}</td>
									</tr>
									<tr>
										<th scope="row">{{ __('Email') }}</th>
										<td>{{ Auth::user()->email }}</td>
									</tr>
									<tr>
										<th scope="row">{{ __('Phone') }}</th>
										<td>{{ Auth::user()->phone }}</td>
									</tr>
									<tr>
										<th scope="row">{{ __('Current Date') }}</th>
										<td>{{ \Carbon\Carbon::now()->format('M d, Y') }}</td>
									</tr>
								</tbody>
							</table>

							<div class="patment-area">
								<h4 class="mb-3 g-title"> {{ __('Select Payment Gateway :') }} </h4>
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
											<div id="paymentmainform" class="paymentmainform" >
												<input type="hidden" name="gateway" id="payment_id" value="">
												<input type="hidden" name="packageprice"  value="
												@if($packagedetails->discount_price == null)
													{{ $packagedetails->price}}
												@else 
													{{ $packagedetails->discount_price }}
												@endif
												">
												<input type="hidden" name="packagename"  value="{{ $packagedetails->name }}">
												<input type="hidden" name="packageid"  value="{{ $packagedetails->id }}">
												<div class="stripe-inner-form">
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
								</div>
								<hr class="mb-4">
								<button type="submit" class="mybtn1 submitbtn">{{ __('Submit') }}</button>
							</div>
						</div>
						<div class="lg:w-1/3 pr-4 pl-4">
							<h4 class="mb-4"><strong>{{ __('Active Package :') }}</strong></h4>
							<div class="single-price">
								<h4 class="name">
									{{ $packagedetails->name }}
								</h4>
								<div class="mbps">
									{{ $packagedetails->speed }} <span>{{ __('Mbps') }}</span>
								</div>


								<div class="list">
									@php
									$feature = explode( ',', $packagedetails->feature );
									for ($i=0; $i < count($feature); $i++) { 
										echo '<li><p href="mailto:'.$feature[$i].'">'.$feature[$i].'</p></li>';
									}
								@endphp
								</div>
								<div class="bottom-area">
									<div class="price-area">
										<div class="price-top-area">
											@if($packagedetails->discount_price == null)
												<p class="price showprice">{{ Helper::showCurrency() }}{{ $packagedetails->price }}</p>
											@else
												<p class="discount_price showprice">{{ Helper::showCurrency() }}{{ $packagedetails->discount_price }}</p>
												<p class="price discounted"><del>{{ Helper::showCurrency() }}{{ $packagedetails->price }}</del></p>
											@endif
										</div>
										<p class="time">
											{{ $packagedetails->time }}
										</p>
									</div>
								</div>
							</div>
						</div>
					@endif
				@else
					<div class="lg:w-full pr-4 pl-4 text-center">
						<h3>{{ __("You don't purchase any package. First buy a package.") }}</h3>
					</div>
				@endif
			</div>
		</div>
	</section>
</form>
<input type="hidden" id="product_paypal" value="{{route('paybill.paypal.submit')}}">
<input type="hidden" id="product_stripe" value="{{route('paybill.stripe.submit')}}">
	<!-- PayBill Area End -->

@endsection
