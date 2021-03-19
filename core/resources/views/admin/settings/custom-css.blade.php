@extends('admin.layout')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/codemirror/codemirror.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/codemirror/monokai.css')}}">
@endsection

@section('content')

<div class="content-header">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="sm:w-1/2 pr-4 pl-4">
                <h1 class="flex flex-wrap pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 m-0 text-gray-900">{{ __('Custom CSS') }}</h1>
            </div><!-- /.col -->
            <div class="sm:w-1/2 pr-4 pl-4">
                <ol class="flex flex-wrap list-reset pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 rounded sm:float-right">
                    <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                    <li class="inline-block px-2 py-2 text-gray-700">{{ __('Custom CSS') }}</li>
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
                        <h3 class="w-1/2">{{ __('Write your custom CSS hear.') }} </h3>
                    </div>
                    <div class="flex-auto p-6">
                        <form action="{{route('admin.custom.css.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <textarea name="custom_css_area" id="custom_css_area" cols="30" rows="10">{{$custom_css}}</textarea>
                            </div>
                            <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600 mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
    </div>


</section>

@endsection


@section('script')
    <script src="{{asset('assets/admin/plugins/codemirror/codemirror.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/codemirror/css.js')}}"></script>
    <script>
        (function($) {
            "use strict";
            var editor = CodeMirror.fromTextArea(document.getElementById("custom_css_area"), {
                lineNumbers: true,
                mode: "text/css",
                matchBrackets: true,
                theme: "monokai"
            });
        })(jQuery);
    </script>
@endsection
