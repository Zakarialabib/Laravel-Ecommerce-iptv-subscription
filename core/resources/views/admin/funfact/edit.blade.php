@extends('admin.layout')

@section('content')

<section class="content-header">
    <h1>
       {{ __('About') }}
    </h1>
</section>
<section class="content">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="lg:w-full pr-4 pl-4">
                    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                            <div class="flex py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900  with-border">
                                <h3 class="mt-1 w-1/2">{{ __('Edit Fact') }}</h3>
                                <div class="flex w-1/2 justify-end">
                                <a href="{{ route('admin.funfact'). '?language=' . $currentLang->code }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="flex-auto p-6">
                                    <form class="form-horizontal" action="{{ route('admin.funfact.update', $funfact->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Language') }}<span class="text-red-600">*</span></label>
            
                                            <div class="sm:w-4/5 pr-4 pl-4">
                                                <select class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm lang" name="language_id">
                                                    @foreach($langs as $lang)
                                                        <option value="{{$lang->id}}" {{ $funfact->language_id == $lang->id ? 'selected' : '' }} >{{$lang->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('language_id'))
                                                    <p class="text-red-600"> {{ $errors->first('language_id') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Icon') }}<span class="text-red-600">*</span></label>
            
                                            <div class="sm:w-4/5 pr-4 pl-4">
                                                <img class="mw-400 mb-3 show-img img-demo" src="{{ asset('assets/front/img/'.$funfact->icon) }}" alt="">
                                                <div class="custom-file">
                                                    <label class="custom-file-label" for="icon">{{ __('Choose Image') }}</label>
                                                    <input type="file" class="custom-file-input up-img" name="icon" id="main_image">
                                                </div>
                                                @if ($errors->has('icon'))
                                                    <p class="text-red-600"> {{ $errors->first('icon') }} </p>
                                                @endif
                                                <p class="help-block text-teal-500">{{ __('Upload 65X65 (Pixel) Size image for best quality.
                                                    Only jpg, jpeg, png image is allowed.') }}
                                                </p>
                                            </div>
                                        </div>
                                            <div class="mb-4 flex flex-wrap ">
                                                <label for="name" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Name') }}<span class="text-red-600">*</span></label>
                
                                                <div class="sm:w-4/5 pr-4 pl-4">
                                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="name" placeholder="{{ __('Enter Fact Name') }}" value="{{ $funfact->name }}">
                                                </div>
                                            </div>
                
                                            <div class="mb-4 flex flex-wrap ">
                                                <label for="value" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Value') }}<span class="text-red-600">*</span></label>
                
                                                <div class="sm:w-4/5 pr-4 pl-4">
                                                    <input type="number" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="value" placeholder="{{ __('Enter Fact Value') }}" value="{{ $funfact->value }}">
                                                </div>
                                            </div>
                                            <div class="mb-4 flex flex-wrap ">
                                                <div class="sm:mx-1/5 sm:w-4/5 pr-4 pl-4">
                                                    <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ __('Update') }}</button>
                                                </div>
                                            </div>
                
                                        </form>
                                
                            </div>
                            <!-- /.card-body -->
                        </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
@endsection
