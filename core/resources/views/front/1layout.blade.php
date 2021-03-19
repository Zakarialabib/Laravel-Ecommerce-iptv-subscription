<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="@yield('meta-description')">
	<meta name="keywords" content="@yield('meta-keywords')">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
    <title>{{ $setting->website_title }}</title>

    <!-- favicon -->
	<link rel="shortcut icon" href="{{ asset('assets/front/img/' . $commonsetting->fav_icon) }}" type="image/x-icon">
	<!-- Google Front -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,800&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <!-- Plugin css -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/plugin.css') }}">
    <!-- Sweetalert2 css -->
	<link rel="stylesheet" href="{{ asset('assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

	@yield('style')
    <!-- stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/responsive.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/admin/css/tailwind.css') }}">
	<!-- dynamic Style change -->
	<link rel="stylesheet" href="{{ asset('assets/front/css/dynamic-css.css') }}">
	<link href="{{ url('/') }}/assets/front/css/dynamic-style.php?color={{ $commonsetting->base_color }}" rel="stylesheet">
	@if($currentLang->direction == 'rtl')
	<!-- RTL css -->
	<link rel="stylesheet" href="{{ asset('assets/front/css/rtl.css') }}">
	@endif
	
</head>

<body {{ Session::has('notification') ? 'data-notification' : '' }} @if(Session::has('notification')) data-notification-message='{{ json_encode(Session::get('notification')) }} @endif' >

    <!-- preloader area start -->
    <div class="preloader" id="preloader">
        <div class="loader loader-1">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>
        </div>
    </div>
    <!-- preloader area end -->

	<!--Main-Menu Area Start-->
	<div class="mainmenu-area">
		<!-- Top Menu -->
		<div class="top-header">
			<div class="container mx-auto sm:px-4">
				<div class="flex flex-wrap ">
					<div class="md:w-1/2 pr-4 pl-4 self-center hidden lg:block">
						<div class="left-content">
							<ul>
								<li>
									<a href="#">
										<i class="fas fa-phone"></i>
										@php
										$number = explode( ',', $commonsetting->number );
										@endphp
										{{ $number[0] }}
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-envelope"></i>
										@php
										$number = explode( ',', $commonsetting->email );
										@endphp
										{{ $number[0] }}
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="lg:w-1/2 pr-4 pl-4 self-center">
						<div class="right-content">
							<ul>
								@if (count($langs) > 0)
								<li class="language-change">
									<p class="name"><i class="fas fa-globe"></i>{{ $currentLang->name }}</p>
									<div class="language-menu">
										@foreach ($langs as $lang)
										<a href="{{ route('changeLanguage', $lang->code) }}" class="{{ $lang->name == $currentLang->name ? 'active' : '' }}">{{ $lang->name }}</a>
										@endforeach
									</div>
								</li>
								@endif
								<li>
									@if(Auth::user())
									<a href="{{ route('front.billpay') }}" class="mybtn1">{{ __('Pay Bill') }}</a>
									@else
									<a href="{{ route('user.login') }}" class="mybtn1">{{ __('Pay Bill') }}</a>
									@endif
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container mx-auto sm:px-4">
			<div class="flex flex-wrap ">
				<div class="lg:w-full pr-4 pl-4">
					<nav class="relative flex flex-wrap items-center content-between py-3 px-4  text-black">
						<a class="inline-block pt-1 pb-1 mr-4 text-lg whitespace-no-wrap" href="{{ route('front.index') }}">
							<img src="{{ asset('assets/front/img/'.$commonsetting->header_logo) }}" alt="">
						</a>
						<button class="py-1 px-2 text-md leading-normal bg-transparent border border-transparent rounded" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="main_menu"
							aria-expanded="false" aria-label="Toggle navigation">
							<span class="px-5 py-1 border border-gray-600 rounded"></span>
						</button>
						<div class="hidden flex-grow items-center fixed-height" id="main_menu">
							<ul class="flex flex-wrap list-reset pl-0 mb-0 ml-auto">
								<li class="">
									<a class="inline-block py-2 px-4 no-underline @if(request()->path() == '/') active  @endif" href="{{ route('front.index') }}">{{ __('Home') }}</a>
								</li>
								@if($commonsetting->is_about_page)
								<li class="">
									<a class="inline-block py-2 px-4 no-underline @if(request()->path() == 'about') active  @endif" href="{{ route('front.about') }}">{{ __('About') }}</a>
								</li>
								@endif
								<li class="">
									<a class="nav-link 
									@if(request()->path() == 'service') active  
									@elseif(request()->is('service/*')) active
									@endif" href="{{ route('front.service') }}">{{ __('Service') }}</a>
								</li>
								@if($commonsetting->is_shop_page)
								<li class="">
									<a class="inline-block py-2 px-4 no-underline @if(request()->path() == 'shop') active  @endif" href="{{ route('front.products') }}">{{ __('All Product') }}</a>										
								</li>
								@endif
								@if($commonsetting->is_blog_page)
								<li class="">
									<a class="inline-block py-2 px-4 no-underline @if(request()->path() == 'blog') active  @endif" href="{{ route('front.blogs') }}">{{ __('Blog') }}</a>										
								</li>
								@endif
								@if($commonsetting->is_contact_page)
								<li class="">
									<a class="inline-block py-2 px-4 no-underline @if(request()->path() == 'contact') active  @endif" href="{{ route('front.contact') }}">{{ __('Contact') }}</a>
								</li>
								@endif

								@if(auth()->check())
								<li class="">
									<a class="inline-block py-2 px-4 no-underline @if(request()->path() == 'tickets') active  @endif" href="{{ route('user.tickets.index') }}">{{ __('Tickets') }}</a>
								</li>
							
								<li class="">
									<a class="inline-block py-2 px-4 no-underline" href="{{ route('user.dashboard') }}"><i class="fas fa-user"></i> {{ Auth::user()->name }}</a>
								</li>
						    	@else
								<li class=" relative">
									<a class="inline-block py-2 px-4 no-underline  inline-block w-0 h-0 ml-1 align border-b-0 border-t-1 border-r-1 border-l-1">
										{{ __('Account') }}
									</a>
									<div class=" absolute left-0 z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-gray-300 rounded">
										<a class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0" href="{{ route('user.login') }}">{{ __('Login') }}</a>
										<a class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0" href="{{ route('user.register') }}">{{ __('Register') }}</a>
									</div>
								</li>
								@endif
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!--Main-Menu Area Start-->


	@yield('content')

	<!-- Footer Area Start -->
	<footer class="footer" id="footer">
		<div class="container mx-auto sm:px-4">
			<div class="flex flex-wrap ">
				<div class="md:w-1/2 pr-4 pl-4 lg:w-1/3 pr-4 pl-4">
					<div class="footer-widget about-widget">
						<div class="footer-logo">
							<a href="#">
								<img src="{{ asset('assets/front/img/'.$commonsetting->header_logo) }}" alt="">
							</a>
						</div>
						<div class="text">
							<p>
								{{ $setting->footer_text }}
							</p>
						</div>

					</div>
				</div>
				<div class="md:w-1/2 pr-4 pl-4 lg:w-1/3 pr-4 pl-4">
					<div class="footer-widget address-widget">
						<h4 class="title">
							{{  __('Address') }}
						</h4>
						<ul class="about-info">
							<li>
								<p>
										<i class="fas fa-globe"></i>
									{{ $setting->address }}
								</p>
							</li>
							<li>
								<p>
										<i class="fas fa-phone"></i>
										@php
										$number = explode( ',', $commonsetting->number );
										for ($i=0; $i < count($number); $i++) {
											echo $number[$i].', ';
										}
										@endphp
								</p>
							</li>
							<li>
								<p>
										<i class="far fa-envelope"></i>
										@php
										$email = explode( ',', $commonsetting->email );
										for ($i=0; $i < count($email); $i++) {
											echo $email[$i].', ';
										}
										@endphp
								</p>
							</li>
						</ul>
					</div>
				</div>
				<div class="md:w-1/2 pr-4 pl-4 lg:w-1/3 pr-4 pl-4">
						<div class="footer-widget  footer-newsletter-widget">
							<h4 class="title">
								{{ __('Newsletter') }}
							</h4>
							<div class="newsletter-form-area">
								<form action="{{ route('front.newsletter') }}" method="POST">
									@csrf
									<input type="email" name="email" placeholder="{{  __('Email Address') }}">
									<button type="submit">
										<i class="far fa-paper-plane"></i>
									</button>
								</form>
							</div>
							<div class="social-links">
								<h4 class="title">
									{{ __('Connect with us on social media :') }}
								</h4>
								<div class="fotter-social-links">
									<ul>
										@foreach($socials as $key => $social)
										<li>
											<a href="{{ $social->url }}">
												<i class="{{ $social->icon }}"></i>
											</a>
										</li>
										@endforeach
									</ul>
								</div>
							</div>

						</div>
				</div>
			</div>
		</div>
		<div class="copy-bg">
			<div class="container mx-auto sm:px-4">
				<div class="flex flex-wrap ">
					<div class="lg:w-full pr-4 pl-4">
							<div class="content">
								<div class="content">
									{!! $setting->copyright_text !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer Area End -->

 <!-- Back to Top Start -->
 <div class="bottomtotop">
  <i class="fas fa-chevron-right"></i>
 </div>
 <!-- Back to Top End -->

	{{-- Cookie alert dialog start --}}
	@if ($setting->is_cooki_alert == 1)
		@include('cookieConsent::index')
	@endif
	{{-- Cookie alert dialog end --}}

 
<input type="hidden" id="main_url" value="{{ route('front.index') }}">

<!-- jquery -->
<script src="{{ asset('assets/front/js/jquery.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
<!-- popper -->
<script src="{{ asset('assets/front/js/popper.min.js') }}"></script>
<!-- plugin js-->
<script src="{{ asset('assets/front/js/plugin.js') }}"></script>
<!-- Sweetalert2 js -->
<script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

@yield('script')
<!-- main -->
<script src="{{ asset('assets/front/js/main.js') }}"></script>


 @if($commonsetting->is_tawk_to	== 1)
	{!!  $commonsetting->tawk_to !!}
@endif


</body>

</html>
