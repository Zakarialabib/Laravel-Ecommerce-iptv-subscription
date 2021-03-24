@extends('front.layout')

@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")
@section('content')

<!--Main Breadcrumb Area Start -->
<div class="main-breadcrumb-area"
    style="background-image : url('{{ asset('assets/front/img/' . $commonsetting->breadcrumb_image) }}');">
    <div class="overlay"></div>
    <div class="container mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="lg:w-full pr-4 pl-4">
                <h1 class="pagetitle">
                    {{ __('Login') }}
                </h1>
                <ul class="pages">
                    <li>
                        <a href="{{ route('front.index') }}">
                            {{ __('Home') }}
                        </a>
                    </li>
                    <li class="active">
                        <a href="#">
                            {{ __('Login') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--Main Breadcrumb Area End -->

<!-- Login Area Start -->
<section class="auth">
    <div class="container mx-auto sm:px-4">
        <div class="min-h-52 flex flex-col justify-center">
            <div class="p-15 xs:p-0 mx-auto md:w-full md:max-w-md">
                <h1 class="font-bold text-center text-2xl mb-5">{{ __('Login to your account to continue.') }}</h1>
                <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
                    @if(Session::has('error'))
                    <p class="m-1 text-red-600">{{ Session::get('error') }}</p>
                    @endif
                    @if(Session::has('success'))
                    <p class="m-1 text-green-500">{{ Session::get('success') }}</p>
                    @endif
                    <form class="" action="{{ route('user.login.submit') }}" method="POST">
                        @csrf
                        <div class="px-5 py-7">
                            <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-2 text-sm w-full" type="email"
                                value="{{ old('email') }}" name="email" placeholder="{{ __('Enter Email') }}" />
                            @if($errors->has('email'))
                            <p class="m-1 text-red-600">{{ $errors->first('email') }}</p>
                            @endif
                            <input class="border rounded-lg px-3 py-2 mt-1 mb-2 text-sm w-full"
                                type="password" name="password" placeholder="{{ __('Enter Password') }}" />
                            @if($errors->has('password'))
                            <p class="m-1 text-red-600">{{ $errors->first('password') }}</p>
                            @endif
                           
                            <button
                                class="transition duration-200 bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block"
                                type="submit">
                                <span class="inline-block mr-2">{{ __('Login') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="w-4 h-4 inline-block">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                        </div>
                        <div class="py-2.5">
                                <div class="text-center">
                                        <a href="{{ route('user.register') }}"> <span
                                                class="inline-block ml-1">{{ __("Don't have an account?") }}
                                                {{ __('Register Now') }} </span> </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Login Area End -->

@endsection