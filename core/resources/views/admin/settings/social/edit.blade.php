@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="sm:w-1/2 pr-4 pl-4">
                <h1 class="flex flex-wrap pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 m-0 text-gray-900">{{ __('Social Links') }}</h1>
            </div><!-- /.col -->
            <div class="sm:w-1/2 pr-4 pl-4">
                <ol class="flex flex-wrap list-reset pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 rounded sm:float-right">
                    <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                    <li class="inline-block px-2 py-2 text-gray-700">{{ __('Social Links') }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                    <div class="flex py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
                        <h3 class="mt-1 w-1/2">{{ __('Update Social Link') }} </h3>
                        <div class="flex w-1/2 justify-end">
                            <a href="{{ route('admin.slinks') }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-green-500 text-white hover:bg-green-600 py-1 px-2 leading-tight text-xs ">
                                <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                            </a>
                          </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="flex-auto p-6">
                        <form id="slink" class="form-horizontal" action="{{ route('admin.updateSlinks', $slink->id) }}" method="POST" onsubmit="store(event)">
                            @csrf
                            
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Social Icon ') }}<span
                                        class="text-red-600">*</span></label>

                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700 biconpicker" data-iconset="fontawesome5" data-icon="{{ $slink->icon }}" role="iconpicker"></button>
                                    <input id="inputIcon" type="hidden" name="icon" value="">
                                    @if ($errors->has('icon'))
                                    <p class="text-red-600"> {{ $errors->first('icon') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label for="website_title" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Social URL') }}<span
                                        class="text-red-600">*</span></label>

                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="url" value="{{ $slink->url }}" placeholder="{{ __('Social URL') }}">
                                    @if ($errors->has('url'))
                                    <p class="text-red-600"> {{ $errors->first('url') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <div class="sm:mx-1/5 sm:w-4/5 pr-4 pl-4">
                                    <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-green-500 text-white hover:bg-green-600">{{ __('Update') }}</button>
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
