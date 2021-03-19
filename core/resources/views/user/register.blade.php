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
                    <div class="lg:w-2/3 pr-4 pl-4 md:w-4/5 pr-4 pl-4">
                        <div class="sign-form">
                            <div class="heading">
                                <h4 class="title">
                                       {{ __('Register') }}
                                </h4>
                                <p class="subtitle">
                                    {{ __('Register your account to continue.') }}
                                </p>
                            </div>
                            <form class="mb-4 mb-0 flex flex-wrap " action="{{ route('user.register.submit') }}" method="POST">
                                @csrf
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded lg:w-1/2 pr-4 pl-4" type="text" value="{{ old('name') }}" name="name" placeholder="{{ __('Full Name') }}">
                                @if($errors->has('name'))
                                <p  class="m-1 text-red-600">{{ $errors->first('name') }}</p>
                                @endif
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded lg:w-1/2 pr-4 pl-4" type="text" value="{{ old('username') }}" name="username" placeholder="{{ __('Enter Username') }}">
                                @if($errors->has('username'))
                                <p  class="m-1 text-red-600">{{ $errors->first('username') }}</p>
                                @endif
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded lg:w-1/2 pr-4 pl-4" type="number" value="{{ old('phone') }}" name="phone" placeholder="{{ __('Enter Phone Number') }}">
                                @if($errors->has('phone'))
                                <p  class="m-1 text-red-600">{{ $errors->first('phone') }}</p>
                                @endif
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded lg:w-1/2 pr-4 pl-4" type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter Email') }}">
                                @if($errors->has('email'))
                                <p  class="m-1 text-red-600">{{ $errors->first('email') }}</p>
                                @endif
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" type="text" value="{{ old('address') }}" name="address" placeholder="{{ __('Enter Full Address') }}">
                                @if($errors->has('address'))
                                <p  class="m-1 text-red-600">{{ $errors->first('address') }}</p>
                                @endif
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded lg:w-1/2 pr-4 pl-4" type="text" value="{{ old('country') }}" name="country" placeholder="{{ __('Enter Country') }}">
                                @if($errors->has('country'))
                                <p  class="m-1 text-red-600">{{ $errors->first('country') }}</p>
                                @endif
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded lg:w-1/2 pr-4 pl-4" type="text" value="{{ old('city') }}" name="city" placeholder="{{ __('Enter City') }}">
                                @if($errors->has('city'))
                                <p  class="m-1 text-red-600">{{ $errors->first('city') }}</p>
                                @endif
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" type="password" name="password" placeholder="{{ __('Enter Password') }}">
                                @if($errors->has('password'))
                                <p  class="m-1 text-red-600">{{ $errors->first('password') }}</p>
                                @endif
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}">

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
