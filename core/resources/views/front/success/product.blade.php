@extends('front.layout')

@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")
@section('content')

	<!--Main Breadcrumb Area Start -->
	<div class="main-breadcrumb-area" style="background-image: url('{{ asset('assets/front/img/'.$setting->breadcrumb_image) }}')">
        <div class="overlay"></div>
		<div class="container mx-auto sm:px-4">
			<div class="flex flex-wrap ">
				<div class="lg:w-full pr-4 pl-4">
					<h1 class="pagetitle">
						{{ __('Success') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Success') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

	<!-- Success Area Start -->
	<section class="success-section">
        <div class="container mx-auto sm:px-4">
            <div class="flex flex-wrap  justify-center">
                <div class="lg:w-2/5 pr-4 pl-4 md:w-1/2 pr-4 pl-4">
                    <div class="success-box">
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
						</div>
						<h4>{{ __('Thank you !') }}</h4>
						<p>
							{{ __('Your order has been placed successfully!. We have sent you a mail with an invoice.') }}
						</p>
						<a href="{{ route('front.index') }}" class="mybtn1"><i class="fas fa-angle-double-left"></i> {{ __('Back to Home') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Success Area End -->
  
@endsection
