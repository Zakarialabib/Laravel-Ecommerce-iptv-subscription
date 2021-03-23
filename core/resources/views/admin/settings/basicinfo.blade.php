@extends('admin.layout')

@section('content')

<div class="p-0 -mb-5">
    <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
            <div class="sm:w-1/2 pr-4 pl-4">
                <h1 class="flex flex-wrap text-lg capitalize text-bold pt-3 pb-3 py-4 px-4 mb-2 m-0 text-gray-900">{{ __('Basic Information') }}</h1>
            </div><!-- /.col -->
            <div class="sm:w-1/2 pr-4 pl-4">
                <ol class="flex flex-wrap list-reset sm:float-right py-4 px-4 mb-2 m-0">
                    <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                    <li class="inline-block px-2 py-2 text-gray-700">{{ __('Basic Information') }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                    <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        <h3 class="px-4 mt-1 w-1/2">{{ __('Update Basic Information') }} </h3>
                        <div class="w-1/2 justify-end flex">
                            <div class="inline-block mr-4">
                                <select class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm lang languageSelect"  data="{{url()->current() . '?language='}}">
                                    @foreach($langs as $lang)
                                        <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}} >{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="flex-auto p-6">
                        <form class="form-horizontal" action="{{ route('admin.setting.updateBasicinfo', $basicinfo->language_id ) }}" method="POST" >
                            @csrf
                            
                            <div class="mb-4 flex flex-wrap ">
                                <label for="website_title" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Site Title') }} <span
                                        class="text-red-600">*</span></label>

                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="website_title" value="{{ $basicinfo->website_title }}" placeholder="{{ __('Site Title') }}">
                                    @if ($errors->has('website_title'))
                                    <p class="text-red-600"> {{ $errors->first('website_title') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Address') }} <span
                                        class="text-red-600">*</span></label>

                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="address" value="{{ $basicinfo->address }}" placeholder="{{ __('Address') }}">
                                    @if ($errors->has('address'))
                                    <p class="text-red-600"> {{ $errors->first('address') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <div class="sm:mx-1/5 sm:w-4/5 pr-4 pl-4">
                                    <button type="submit" class="inline-block align-middle select-none border whitespace-no-wrap py-2 px-4 bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">{{ __('Update') }}</button>
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
            <div class="md:w-full pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                    <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        <h3 class="px-4 mt-1 w-1/2">{{ __('Update Basic Information') }} </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="flex-auto p-6">
                        <form class="form-horizontal" action="{{ route('admin.setting.commoninfo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4 flex flex-wrap ">
                                <label for="base_color" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Theme Color') }}</label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <div class="relative flex items-stretch w-full my-colorpicker2">
                                        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" value="{{ $commoninfo->base_color }}"  placeholder="#000000" name="base_color">
                                      </div>
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label  class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Phone Number') }}<span
                                        class="text-red-600">*</span></label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-role="tagsinput" name="number" placeholder="{{ __('Number') }}" value="{{ $commoninfo->number }}">
                                    <p class="help-block text-teal-500">{{ __('The first entered number will show in the header top menu') }}
                                    @if ($errors->has('number'))
                                        <p class="text-red-600"> {{ $errors->first('number') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label  class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Email') }}<span
                                        class="text-red-600">*</span></label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-role="tagsinput" name="email" placeholder="{{ __('Email') }}" value="{{ $commoninfo->email }}">
                                    <p class="help-block text-teal-500">{{ __('The first entered email will show in the header top menu') }}
                                    @if ($errors->has('email'))
                                        <p class="text-red-600"> {{ $errors->first('email') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label  class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Contact Form Email') }}<span
                                        class="text-red-600">*</span></label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"  name="contactemail" placeholder="{{ __('Contact Form Email') }}" value="{{ $commoninfo->contactemail }}">
                                    <p class="help-block text-teal-500">{{ __('Contact page form  maill will send this email') }}
                                    @if ($errors->has('contactemail'))
                                        <p class="text-red-600"> {{ $errors->first('contactemail') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Favicon') }} <span class="text-red-600">*</span></label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <img class="mb-3 show-img img-demo" src="
                                    @if($commoninfo->fav_icon)
                                    {{ asset('assets/front/img/'.$commoninfo->fav_icon) }}
                                    @else
                                    {{ asset('assets/admin/img/img-demo.jpg') }}
                                    @endif"
                                    " alt="">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="fav_icon">{{ __('Choose New Image') }}</label>
                                        <input type="file" class="custom-file-input up-img" name="fav_icon" id="fav_icon">
                                    </div>
                                    <p class="help-block text-teal-500">{{ __('Upload 40X40 (Pixel) Size image or Squre size image for best quality. 
                                        Only jpg, jpeg, png image is allowed.') }}
                                    </p>
                                </div>

                            </div>
                            
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Site Header Logo') }} <span class="text-red-600">*</span></label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <img class="mb-3 show-img img-demo" src="
                                    @if($commoninfo->header_logo)
                                    {{ asset('assets/front/img/'.$commoninfo->header_logo) }}
                                    @else
                                    {{ asset('assets/admin/img/img-demo.jpg') }}
                                    @endif" alt="">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="header_logo">Choose New Image</label>
                                        <input type="file" class="custom-file-input up-img" name="header_logo" id="header_logo">
                                    </div>
                                    <p class="help-block text-teal-500">{{ __('Upload 150X40 (Pixel) Size image for best quality.
                                        Only jpg, jpeg, png image is allowed.') }}
                                    </p>
                                </div>

                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Breadcrumb Image') }} <span class="text-red-600">*</span></label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <img class="mw-400 mb-3 show-img img-demo" src="
                                    @if($commoninfo->breadcrumb_image)
                                    {{ asset('assets/front/img/'.$commoninfo->breadcrumb_image)}}
                                    @else
                                    {{ asset('assets/admin/img/img-demo.jpg') }}
                                    @endif"
                                    " alt="">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="breadcrumb_image">{{ __('Choose New Image') }}</label>
                                        <input type="file" class="custom-file-input up-img" name="breadcrumb_image" id="breadcrumb_image">
                                    </div>
                                    <p class="help-block text-teal-500">{{ __('Upload 1920X390 (Pixel) Size image for best quality.
                                        Only jpg, jpeg, png image is allowed.') }}
                                    </p>
                                </div>

                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <div class="sm:mx-1/5 sm:w-4/5 pr-4 pl-4">
                                    <button type="submit" class="inline-block align-middle select-none border whitespace-no-wrap py-2 px-4 bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
            
            <!-- /.col -->
        </div>
    </div>


</section>

@endsection
