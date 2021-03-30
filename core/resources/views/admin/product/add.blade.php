@extends('admin.layout')

@section('content')



<div class="p-0 -mb-5">
    <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
        <div class="sm:w-1/2 pr-4 pl-4">
            <h1 class="flex flex-wrap text-lg capitalize text-bold pt-3 pb-3 py-4 px-4 mb-2 m-0 text-gray-900">{{ __('Product') }}</h1>
        </div><!-- /.col -->
        <div class="sm:w-1/2 pr-4 pl-4">
            <ol class="flex flex-wrap list-reset sm:float-right py-4 px-4 mb-2 m-0">
            <li class="inline-block px-2 py-2 text-gray-700"><a href="#"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="inline-block px-2 py-2 text-gray-700">{{ __('Product') }}</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
            <div class="lg:w-full pr-4 pl-4">
                    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                            <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                                <h3 class="px-4 mt-1 w-1/2">{{ __('Add Product') }}</h3>
                                <div class="flex w-1/2 justify-end">
                                    <a href="{{ route('admin.product'). '?language=' . $currentLang->code }}" class="inline-block align-middle select-none border whitespace-no-wrap py-1 px-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">
                                        <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                    </a>
                                </div>
                            </div>

                            <div class="flex-auto p-6">
                                <form class="form-horizontal" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-4 flex flex-wrap ">
                                        <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Language') }}<span class="text-red-600">*</span></label>
        
                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <select class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm lang" name="language_id">
                                                @foreach($langs as $lang)
                                                    <option value="{{$lang->id}}" {{ $lang->is_default == '1' ? 'selected' : '' }} >{{$lang->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('language_id'))
                                                <p class="text-red-600"> {{ $errors->first('language_id') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-4 flex flex-wrap ">
                                        <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Image') }}<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <img class="mw-400 mb-3 show-img img-demo" src="{{ asset('assets/admin/img/img-demo.jpg') }}" alt="">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="image">{{ __('Choose Image') }}</label>
                                                <input type="file" class="custom-file-input up-img" name="image" id="image">
                                            </div>
                                            @if ($errors->has('image'))
                                                <p class="text-red-600"> {{ $errors->first('image') }} </p>
                                            @endif
                                            <p class="help-block text-teal-500">{{ __('Upload 730X455 (Pixel) Size image for best quality.
                                                Only jpg, jpeg, png image is allowed.') }}
                                            </p>
                                        </div>
                                    </div>



                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="title" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Title') }}<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="title" placeholder="{{ __('Title') }}" value="{{ old('title') }}">
                                            @if ($errors->has('title'))
                                                <p class="text-red-600"> {{ $errors->first('title') }} </p>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="current_price" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Current Price') }} ({{Helper::showCurrency()}})<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="current_price" placeholder="{{ __('Current Price') }}" value="{{ old('current_price') }}">
                                            @if ($errors->has('current_price'))
                                                <p class="text-red-600"> {{ $errors->first('current_price') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="previous_price" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Previous Price') }} ({{Helper::showCurrency()}})<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="previous_price" placeholder="{{ __('Previous Price') }}" value="{{ old('previous_price') }}">
                                            @if ($errors->has('previous_price'))
                                                <p class="text-red-600"> {{ $errors->first('previous_price') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="stock" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Product Stock Quantity') }}<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text"  class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="stock" placeholder="{{ __('Product Stock Quantity') }}" value="{{ old('stock') }}">
                                            @if ($errors->has('stock'))
                                                <p class="text-red-600"> {{ $errors->first('stock') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="description" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Short Description') }}</label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                                <textarea name="short_description" rows="4" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded summernote" id="ck" placeholder="{{ __('Short Description') }}">{{ old('short_description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <p class="text-red-600"> {{ $errors->first('short_description') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="description" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Description') }}</label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                                <textarea name="description" rows="4" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded summernote" id="ck" placeholder="{{ __('Description') }}">{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <p class="text-red-600"> {{ $errors->first('description') }} </p>
                                            @endif
                                        </div>
                                    </div>

    
                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="meta_tags" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Meta Tags') }}</label>
                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-role="tagsinput" name="meta_tags" placeholder="{{ __('Meta Tags') }}" value="{{ old('meta_tags') }}">
                                            @if ($errors->has('meta_tags'))
                                                <p class="text-red-600"> {{ $errors->first('meta_tags') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="meta_description" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Meta Description') }}</label>
                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <textarea class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="meta_description" placeholder="{{ __('Meta Description') }}"  rows="4">{{ old('meta_description') }}</textarea>
                                            @if ($errors->has('meta_description'))
                                                <p class="text-red-600"> {{ $errors->first('meta_description') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="status" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Status') }}<span class="text-red-600">*</span></label>
        
                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <select class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" name="status">
                                               <option value="0">{{ __('Unpublish') }}</option>
                                               <option value="1">{{ __('Publish') }}</option>
                                              </select>
                                            @if ($errors->has('status'))
                                                <p class="text-red-600"> {{ $errors->first('status') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-4 flex flex-wrap ">
                                        <div class="sm:mx-1/5 sm:w-4/5 pr-4 pl-4">
                                            <button type="submit" class="inline-block align-middle select-none border whitespace-no-wrap py-2 px-4 bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">{{ __('Save') }}</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>


@endsection
