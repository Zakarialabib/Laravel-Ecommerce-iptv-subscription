@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
        <div class="sm:w-1/2 pr-4 pl-4">
            <h1 class="flex flex-wrap pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 m-0 text-gray-900">{{ __('Dynamic Page') }} </h1>
        </div><!-- /.col -->
        <div class="sm:w-1/2 pr-4 pl-4">
            <ol class="flex flex-wrap list-reset pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 rounded sm:float-right">
                <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                <li class="inline-block px-2 py-2 text-gray-700">{{ __('Dynamic Page') }}</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="lg:w-full pr-4 pl-4">
                    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                            <div class="flex py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
                                <h3 class="mt-1 w-1/2">{{ __('Dynamic Page') }}</h3>
                                <div class="flex w-1/2 justify-end">
                                    <a href="{{ route('admin.dynamic_page'). '?language=' . $currentLang->code }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="flex-auto p-6">
                                <form class="form-horizontal" action="{{ route('admin.dynamic_page.store') }}" method="POST">
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
                                        <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Title') }}<span class="text-red-600">*</span></label>
        
                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="title" placeholder="{{ __('Title') }}" value="{{ old('title') }}">
                                            @if ($errors->has('title'))
                                                <p class="text-red-600"> {{ $errors->first('title') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-4 flex flex-wrap ">
                                        <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Content') }}<span class="text-red-600">*</span></label>
        
                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <textarea name="content" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded summernote"  rows="3" placeholder="{{ __('Content') }}">{{ old('content') }}</textarea>
                                            @if ($errors->has('content'))
                                                <p class="text-red-600"> {{ $errors->first('content') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="status" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Status') }}<span class="text-red-600">*</span></label>
        
                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="status">
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
                                            <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ __('Save') }}</button>
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
