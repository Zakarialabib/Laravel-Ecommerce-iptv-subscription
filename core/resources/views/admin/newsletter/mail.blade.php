@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
        <div class="sm:w-1/2 pr-4 pl-4">
            <h1 class="flex flex-wrap pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 m-0 text-gray-900">{{ __('Mail Subscribers') }} </h1>
        </div><!-- /.col -->
        <div class="sm:w-1/2 pr-4 pl-4">
            <ol class="flex flex-wrap list-reset pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 rounded sm:float-right">
            <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="inline-block px-2 py-2 text-gray-700">{{ __('Mail Subscribers') }}</li>
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
                        <h3 class="mt-1 w-1/2">{{ __('Send Mail') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="flex-auto p-6">
                            <form class="" action="{{route('admin.subscribers.sendmail')}}" method="post">
                                @csrf
                                <div class="flex flex-wrap  justify-center">
                                    <div class="lg:w-2/3 pr-4 pl-4">
                                        <div class="mb-4">
                                            <label for="">Subject <span class="text-red-600">*</span></label>
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="subject" value="" placeholder="Enter subject of E-mail">
                                            @if ($errors->has('subject'))
                                              <p class="text-red-600 mb-0">{{$errors->first('subject')}}</p>
                                            @endif
                                          </div>
                                          <div class="mb-4">
                                            <label for="">Message <span class="text-red-600">*</span></label>
                                            <textarea name="message" class="summernote" data-height="150"></textarea>
                                            @if ($errors->has('message'))
                                              <p class="text-red-600 mb-0">{{$errors->first('message')}}</p>
                                            @endif
                                          </div>
                                          <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">
                                            Send Mail <i class="far fa-paper-plane"></i>
                                        </button>
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
