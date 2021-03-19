
@extends('admin.layout')

@section('content')

    <div class="content-header">
        <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
            <div class="flex flex-wrap ">
            <div class="sm:w-1/2 pr-4 pl-4">
                <h1 class="flex flex-wrap pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 m-0 text-gray-900">{{ __('Languages') }}</h1>
            </div><!-- /.col -->
            <div class="sm:w-1/2 pr-4 pl-4">
                <ol class="flex flex-wrap list-reset pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 rounded sm:float-right">
                <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                <li class="inline-block px-2 py-2 text-gray-700">{{ __('Languages') }}</li>
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
                        <div class="flex py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
                            <h3 class="mt-1 w-1/2">{{ __('Edit Language') }}</h3>
                            <div class="flex w-1/2 justify-end">
                                <a href="{{ route('admin.language.index') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="flex-auto p-6 block w-full overflow-auto scrolling-touch">
                            <form  action="{{route('admin.language.update', $language->id)}}" method="POST">
                                @csrf

                                <div class="mb-4 flex flex-wrap ">
                                    <label for="title" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Name') }}<span class="text-red-600">*</span></label>
                                    <div class="sm:w-4/5 pr-4 pl-4">
                                        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="name" placeholder="{{ __('Enter Name') }}" value="{{  $language->name }}">
                                        @if ($errors->has('name'))
                                            <p class="text-red-600"> {{ $errors->first('name') }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-4 flex flex-wrap ">
                                    <label for="title" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Code') }}<span class="text-red-600">*</span></label>
                                    <div class="sm:w-4/5 pr-4 pl-4">
                                        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="code" placeholder="{{ __('Enter code') }}" value="{{  $language->code }}">
                                        @if ($errors->has('code'))
                                            <p class="text-red-600"> {{ $errors->first('code') }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-4 flex flex-wrap ">
                                    <label for="bcategory_id" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Direction') }}<span class="text-red-600">*</span></label>
    
                                    <div class="sm:w-4/5 pr-4 pl-4">
                                        <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="direction">
                                            <option value="ltr" {{ $language->direction == 'ltr' ? 'selected' : '' }}>LTR</option>
                                            <option value="rtl" {{ $language->direction == 'rtl' ? 'selected' : '' }}>RTL</option>
                                        </select>
                                        @if ($errors->has('direction'))
                                            <p class="text-red-600"> {{ $errors->first('direction') }} </p>
                                        @endif
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
