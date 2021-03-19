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
                        <h5 class="flex py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">{{ __('Edit Profile') }}</h5>
                        <div class="flex-auto p-6">
                          <form action="{{ route('user.updateprofile', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-wrap  justify-center">
                                <div class="md:w-1/2 pr-4 pl-4">
                                    <div class="mb-4 mb-4 text-center">
                                        <div class="upload-img inline">
                                          <div class="img">
                                              <img class="mb-3 show-img img-demo" src="
                                              @if(Auth::user()->photo)
                                              {{ asset('assets/front/img/'.Auth::user()->photo) }}
                                              @else
                                              {{ asset('assets/admin/img/img-demo.jpg') }}
                                              @endif"
                                              " alt="">
                                          </div>
                                          <div class="file-upload-area">
                                            <div class="upload-file">
                                              <input type="file" name="photo" class="upload image block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                            </div>
                                            @if($errors->has('photo'))
                                <p  class="m-1 text-red-600">{{ $errors->first('photo') }}</p>
                                @endif
                                          </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap ">
                              <div class="lg:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                  <label for="">{{ __('First Name') }}</label>
                                  <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"  name="name" value="{{ Auth::user()->name }}">
                                  @if($errors->has('name'))
                                <p  class="m-1 text-red-600">{{ $errors->first('name') }}</p>
                                @endif
                                </div>
                              </div>
                              <div class="lg:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                  <label for="">{{ __('Email') }}</label>
                                  <input type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"  name="email" 
                                    value="{{ Auth::user()->email }}">
                                    @if($errors->has('email'))
                                <p  class="m-1 text-red-600">{{ $errors->first('email') }}</p>
                                @endif
                                </div>
                              </div>
        
                              <div class="lg:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                  <label for="">{{ __('Phone') }}</label>
                                  <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="phone" value="{{ Auth::user()->phone }}">
                                  @if($errors->has('phone'))
                                <p  class="m-1 text-red-600">{{ $errors->first('phone') }}</p>
                                @endif
                                </div>
                              </div>
                              <div class="lg:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                  <label for="">{{ __('Address') }}</label>
                                  <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"  name="address" value="{{ Auth::user()->address }}">
                                  @if($errors->has('address'))
                                <p  class="m-1 text-red-600">{{ $errors->first('address') }}</p>
                                @endif
                                </div>
                              </div>
                              <div class="lg:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                  <label for="">{{ __('Country') }}</label>
                                  <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="country" value="{{ Auth::user()->country }}">
                                  @if($errors->has('country'))
                                <p  class="m-1 text-red-600">{{ $errors->first('country') }}</p>
                                @endif
                                </div>
                              </div>
                              <div class="lg:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                  <label for="">{{ __('City') }}</label>
                                  <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"  name="city" value="{{ Auth::user()->city }}">
                                  @if($errors->has('city'))
                                <p  class="m-1 text-red-600">{{ $errors->first('city') }}</p>
                                @endif
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
