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
			<div class="lg:w-3/4 pr-4 pl-4">
                <div class="flex flex-wrap ">
                    <div class="md:w-full pr-4 pl-4">
                      <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                        <h5 class="flex py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">{{ __('Change Password') }}</h5>
                        <div class="flex-auto p-6">
                          <form action="{{ route('user.update_password', Auth::user()->id) }}" method="POST" >
                            @csrf
                            <div class="flex flex-wrap ">
                              <div class="lg:w-full pr-4 pl-4">
                                <div class="mb-4">
                                  <label for="">{{ __('Old Password') }}</label>
                                  <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"  name="old_password" value="">
                                  @if($errors->has('old_password'))
                                  <p  class="m-1 text-red-600">{{ $errors->first('old_password') }}</p>
                                  @endif
                                </div>
                              </div>
                              <div class="lg:w-full pr-4 pl-4">
                                <div class="mb-4">
                                  <label for="">{{ __('New Password') }}</label>
                                  <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"  name="password" value="">
                                  @if($errors->has('password'))
                                  <p  class="m-1 text-red-600">{{ $errors->first('password') }}</p>
                                  @endif
                                </div>
                              </div>
                              <div class="lg:w-full pr-4 pl-4">
                                <div class="mb-4">
                                  <label for="">{{ __('Confirm Password') }}</label>
                                  <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"  name="password_confirmation" value="">
                                </div>
                              </div>
                              <div class="lg:w-full pr-4 pl-4">
                                <button type="submit" class="mybtn1">{{ __('Submit') }} <i class="far fa-paper-plane"></i></button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
			</div>
		  </div>
		</div>
	
	  </section>
    <!-- User Dashboard End -->

@endsection
