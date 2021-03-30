@extends('admin.layout')

@section('content')

<div class="p-0 -mb-5">
    <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
            <div class="sm:w-1/2 pr-4 pl-4">
                <h1 class="flex flex-wrap text-lg capitalize text-bold pt-3 pb-3 py-4 px-4 mb-2 m-0 text-gray-900">{{ __('Admin Profile') }}</h1>
            </div><!-- /.col -->
            <div class="sm:w-1/2 pr-4 pl-4">
                <ol class="flex flex-wrap list-reset sm:float-right py-4 px-4 mb-2 m-0">
                    <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                    <li class="inline-block px-2 py-2 text-gray-700">{{ __('Admin Profile') }}</li>
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
                        <h3 class="px-4 mt-1 w-1/2">{{ __('Update Admin Profile') }} </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="flex-auto p-6">
                        <form class="form-horizontal" action="{{ route('admin.updateProfile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Image') }} <span class="text-red-600">*</span></label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <img class="mb-3 img-demo show-img" src="{{ asset('assets/front/img/'.$adminprofile->image) }}" alt="">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="image">{{ __('Choose New Image') }}</label>
                                        <input type="file" class="custom-file-input  up-img" name="image" id="image">
                                    </div>
                                    <p class="help-block text-teal-500">{{ __('Upload 70X70 (Pixel) Size image for best quality. 
                                        Only jpg, jpeg, png image is allowed.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Full Name') }} <span
                                    class="text-red-600">*</span>
                                </label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="name" value="{{ $adminprofile->name }}" placeholder="{{ __('Full Name') }}">
                                    @if ($errors->has('name'))
                                    <p class="text-red-600"> {{ $errors->first('name') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label for="username" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Username') }}<span
                                    class="text-red-600">*</span>
                                </label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="username" value="{{ $adminprofile->username }}" placeholder="{{ __('Username') }}">
                                    @if ($errors->has('username'))
                                    <p class="text-red-600"> {{ $errors->first('username') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label for="email" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Email') }}<span
                                    class="text-red-600">*</span>
                                </label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="email" value="{{ $adminprofile->email }}" placeholder="{{ __('Email') }}">
                                    @if ($errors->has('email'))
                                    <p class="text-red-600"> {{ $errors->first('email') }} </p>
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
            <!-- /.col -->
        </div>
    </div>


</section>

@endsection
