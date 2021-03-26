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
						{{ __('Register') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('About') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

        <!-- Register Area Start -->
        <section class="auth">
            <div class="container mx-auto sm:px-4">
                <div class="flex flex-wrap  justify-center">
                    <div class="lg:w-2/3 pr-4 pl-4 md:w-4/5">
                        <div class="sign-form">
                            <div class="heading">
                                <h4 class="title">
                                       {{ __('Register') }}
                                </h4>
                                <p class="subtitle">
                                    {{ __('Register your account to continue.') }}
                                </p>
                            </div>
                            @if(Session::has('error'))
                            <p class="m-1 text-red-600">{{ Session::get('error') }}</p>
                            @endif
                            @if(Session::has('success'))
                            <p class="m-1 text-green-500">{{ Session::get('success') }}</p>
                            @endif
                            <form class="mb-4 flex flex-wrap " action="{{ route('user.register.submit') }}" method="POST">
                                @csrf
                                <input class="bg-gray-200 focus:outline-none focus:bg-white focus:border-blue-500 border rounded-lg px-3 py-2 mt-1 mb-2 text-sm w-full" type="text" value="{{ old('name') }}" name="name" placeholder="{{ __('Full Name') }}">
                                @if($errors->has('name'))
                                <p  class="m-1 text-red-600">{{ $errors->first('name') }}</p>
                                @endif
                                <input class="bg-gray-200 focus:outline-none focus:bg-white focus:border-blue-500 border rounded-lg px-3 py-2 mt-1 mb-2 text-sm w-full" type="text" value="{{ old('username') }}" name="username" placeholder="{{ __('Enter Username') }}">
                                @if($errors->has('username'))
                                <p  class="m-1 text-red-600">{{ $errors->first('username') }}</p>
                                @endif
                                <input class="bg-gray-200 focus:outline-none focus:bg-white focus:border-blue-500 border rounded-lg px-3 py-2 mt-1 mb-2 text-sm w-full" type="number" value="{{ old('phone') }}" name="phone" placeholder="{{ __('Enter Phone Number') }}">
                                @if($errors->has('phone'))
                                <p  class="m-1 text-red-600">{{ $errors->first('phone') }}</p>
                                @endif
                                <input class="bg-gray-200 focus:outline-none focus:bg-white focus:border-blue-500 border rounded-lg px-3 py-2 mt-1 mb-2 text-sm w-full" type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter Email') }}">
                                @if($errors->has('email'))
                                <p  class="m-1 text-red-600">{{ $errors->first('email') }}</p>
                                @endif
                                <input class="bg-gray-200 focus:outline-none focus:bg-white focus:border-blue-500 border rounded-lg px-3 py-2 mt-1 mb-2 text-sm w-full" type="text" value="{{ old('address') }}" name="address" placeholder="{{ __('Enter Full Address') }}">
                                @if($errors->has('address'))
                                <p  class="m-1 text-red-600">{{ $errors->first('address') }}</p>
                                @endif
                                <input class="bg-gray-200 focus:outline-none focus:bg-white focus:border-blue-500 border rounded-lg px-3 py-2 mt-1 mb-2 text-sm w-full" type="text" value="{{ old('country') }}" name="country" placeholder="{{ __('Enter Country') }}">
                                @if($errors->has('country'))
                                <p  class="m-1 text-red-600">{{ $errors->first('country') }}</p>
                                @endif
                                <input class="bg-gray-200 focus:outline-none focus:bg-white focus:border-blue-500 border rounded-lg px-3 py-2 mt-1 mb-2 text-sm w-full" type="text" value="{{ old('city') }}" name="city" placeholder="{{ __('Enter City') }}">
                                @if($errors->has('city'))
                                <p  class="m-1 text-red-600">{{ $errors->first('city') }}</p>
                                @endif
                                <input class="bg-gray-200 focus:outline-none focus:bg-white focus:border-blue-500 border rounded-lg px-3 py-2 mt-1 mb-2 text-sm w-full" type="password" name="password" placeholder="{{ __('Enter Password') }}">
                                @if($errors->has('password'))
                                <p  class="m-1 text-red-600">{{ $errors->first('password') }}</p>
                                @endif
                                <input class="bg-gray-200 focus:outline-none focus:bg-white focus:border-blue-500 border rounded-lg px-3 py-2 mt-1 mb-2 text-sm w-full" type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}">

                                <button class="mybtn1" type="submit">{{ __('Create Account') }}</button>
                                <p class="reg-text text-center mb-0">{{ __('Already have an acocunt?') }} <a href="{{ route('user.login') }}">{{ __('Login') }}</a></p>
                            </form>
                            </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Register Area End -->

@endsection
