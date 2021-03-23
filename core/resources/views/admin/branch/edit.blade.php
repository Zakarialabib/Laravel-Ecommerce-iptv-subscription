@extends('admin.layout')

@section('content')

<div class="p-0 -mb-5">
    <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
        <div class="sm:w-1/2 pr-4 pl-4">
            <h1 class="flex flex-wrap text-lg capitalize text-bold pt-3 pb-3 py-4 px-4 mb-2 m-0 text-gray-900">{{ __('Branches') }} </h1>
        </div><!-- /.col -->
        <div class="sm:w-1/2 pr-4 pl-4">
            <ol class="flex flex-wrap list-reset sm:float-right py-4 px-4 mb-2 m-0">
                <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                <li class="inline-block px-2 py-2 text-gray-700">{{ __('Branches') }}</li>
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
                                <h3 class="px-4 mt-1 w-1/2">{{ __('Edit Branch') }}</h3>
                                <div class="flex w-1/2 justify-end">
                                    <a href="{{ route('admin.branch'). '?language=' . $currentLang->code }}" class="inline-flex justify-center py-2 px-4 mr-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="flex-auto p-6">
                                <form class="form-horizontal" action="{{ route('admin.branch.update',  $branch->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-4 flex flex-wrap ">
                                        <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Language') }}<span class="text-red-600">*</span></label>
        
                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <select class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm lang" name="language_id">
                                                @foreach($langs as $lang)
                                                    <option value="{{$lang->id}}" {{ $branch->language_id == $lang->id ? 'selected' : '' }} >{{$lang->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('language_id'))
                                                <p class="text-red-600"> {{ $errors->first('language_id') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                     <div class="mb-4 flex flex-wrap ">
                                        <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Map Embed Code') }}<span class="text-red-600">*</span>
                                        </label>
        
                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <textarea name="iframe" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"  rows="3" placeholder="{{ __('Map Embed Code') }}">{{ $branch->iframe }}</textarea>
                                            @if ($errors->has('iframe'))
                                                <p class="text-red-600"> {{ $errors->first('iframe') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-4 flex flex-wrap ">
                                        <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Branch Name') }}<span class="text-red-600">*</span></label>
                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" name="branch_name" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" placeholder="{{ __('Branch Name') }}" value="{{ $branch->branch_name }}">
                                            @if ($errors->has('branch_name'))
                                                <p class="text-red-600"> {{ $errors->first('branch_name') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-4 flex flex-wrap ">
                                        <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Manager') }}</label>
                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" name="manager" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" placeholder="{{ __('Manager') }}" value="{{ $branch->manager }}">
                                            @if ($errors->has('manager'))
                                                <p class="text-red-600"> {{ $errors->first('manager') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-4 flex flex-wrap ">
                                        <label  class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Phone Number') }}<span
                                                class="text-red-600">*</span></label>
                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-role="tagsinput" name="phone" placeholder="{{ __('Number') }}" value="{{ $branch->phone }}">
                                            @if ($errors->has('phone'))
                                                <p class="text-red-600"> {{ $errors->first('phone') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-4 flex flex-wrap ">
                                        <label  class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Email') }}<span
                                                class="text-red-600">*</span></label>
                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-role="tagsinput" name="email" placeholder="{{ __('Email') }}" value="{{ $branch->email }}">
                                            @if ($errors->has('email'))
                                                <p class="text-red-600"> {{ $errors->first('email') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-4 flex flex-wrap ">
                                        <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Address') }}<span class="text-red-600">*</span></label>
                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" name="address" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" placeholder="{{ __('Address') }}" value="{{ $branch->address }}">
                                            @if ($errors->has('address'))
                                                <p class="text-red-600"> {{ $errors->first('address') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                        
                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="status" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Status') }}<span class="text-red-600">*</span></label>
        
                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <select class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" name="status">
                                               <option value="0" {{ $branch->status == '0' ? 'selected' : '' }}>{{ __('Unpublish') }}</option>
                                               <option value="1" {{ $branch->status == '1' ? 'selected' : '' }}>{{ __('Publish') }}</option>
                                              </select>
                                            @if ($errors->has('status'))
                                                <p class="text-red-600"> {{ $errors->first('status') }} </p>
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
                            <!-- /.card-body -->
                        </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
@endsection
