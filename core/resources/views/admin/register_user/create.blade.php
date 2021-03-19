@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="sm:w-1/2 pr-4 pl-4">
                <h1 class="m-0 text-gray-900">{{ __('Customer Profile') }}</h1>
            </div><!-- /.col -->
            <div class="sm:w-1/2 pr-4 pl-4">
                <ol class="flex flex-wrap list-reset pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 rounded sm:float-right">
                    <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                    <li class="inline-block px-2 py-2 text-gray-700">{{ __('Customer Profile') }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                    <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
                        <h3 class="mb-3">{{ __('Create Customer Profile') }} </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="flex-auto p-6">
                        <form class="form-horizontal" action="{{ route('register.user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Image') }} <span class="text-red-600">*</span></label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="photo">{{ __('Choose New Image') }}</label>
                                        <input type="file" class="custom-file-input  up-img" name="photo" id="photo">
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
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="name" placeholder="{{ __('Full Name') }}">
                                    @if ($errors->has('name'))
                                    <p class="text-red-600"> {{ $errors->first('name') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label for="phone" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Phone') }}<span
                                    class="text-red-600">*</span>
                                </label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="phone" placeholder="{{ __('Phone') }}">
                                    @if ($errors->has('phone'))
                                    <p class="text-red-600"> {{ $errors->first('phone') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label for="email" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Email') }}<span
                                    class="text-red-600">*</span>
                                </label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="email" placeholder="{{ __('Email') }}">
                                    @if ($errors->has('email'))
                                    <p class="text-red-600"> {{ $errors->first('email') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label for="city" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('City') }}<span
                                    class="text-red-600">*</span>
                                </label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="city" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="city" placeholder="{{ __('City') }}">
                                    @if ($errors->has('city'))
                                    <p class="text-red-600"> {{ $errors->first('city') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label for="country" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Country') }}<span
                                    class="text-red-600">*</span>
                                </label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="country" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="country" placeholder="{{ __('Country') }}">
                                    @if ($errors->has('country'))
                                    <p class="text-red-600"> {{ $errors->first('country') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label for="address" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Address') }}<span
                                    class="text-red-600">*</span>
                                </label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="address" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="address"  placeholder="{{ __('Address') }}">
                                    @if ($errors->has('address'))
                                    <p class="text-red-600"> {{ $errors->first('address') }} </p>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-4 flex flex-wrap ">
                                            <label>{{__('Attach Document')}}</label> <i class="dripicons-question" data-toggle="tooltip" title="Only jpg, jpeg, png, gif, pdf, csv, docx, xlsx and txt file is supported"></i>
                                            <input type="file" name="document[]" multiple class="form-control" >
                                            @if($errors->has('extension'))
                                                <span>
                                                   <strong>{{ $errors->first('extension') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                            <div class="mb-4 flex flex-wrap ">
                                    <div class="sm:mx-1/5 sm:w-4/5 pr-4 pl-4">
                                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ __('Create') }}</button>
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
