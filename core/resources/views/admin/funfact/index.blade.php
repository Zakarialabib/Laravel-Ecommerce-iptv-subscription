@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
        <div class="sm:w-1/2 pr-4 pl-4">
            <h1 class="flex flex-wrap pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 m-0 text-gray-900">{{ __('FunFact') }}</h1>
        </div><!-- /.col -->
        <div class="sm:w-1/2 pr-4 pl-4">
            <ol class="flex flex-wrap list-reset pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 rounded sm:float-right">
            <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="inline-block px-2 py-2 text-gray-700">{{ __('FunFact') }}</li>
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
                        <h3 class="mt-1 w-1/2">{{ __('FunFacts Content') }}</h3>
                        <div class="flex w-1/2 justify-end">
                            <div class="inline-block mr-4">
                        <select class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm lang languageSelect" data="{{url()->current() . '?language='}}">
                            @foreach($langs as $lang)
                                <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}} >{{$lang->name}}</option>
                            @endforeach
                        </select>
                    </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="flex-auto p-6">
                        <form class="form-horizontal" action="{{ route('admin.funfactcontent.update',  $saectiontitle->language_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Funfact BG Image') }} <span class="text-red-600">*</span></label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <img class="mw-400 mb-3 show-img img-demo" src="
                                    @if($saectiontitle->funfact_bg)
                                    {{ asset('assets/front/img/'.$saectiontitle->funfact_bg) }}
                                    @else
                                    {{ asset('assets/admin/img/img-demo.jpg') }}
                                    @endif" alt="">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="offer_image">Choose New Image</label>
                                        <input type="file" class="custom-file-input up-img" name="offer_image" id="offer_image">
                                    </div>
                                    <p class="help-block text-teal-500">{{ __('Upload 1920X500 (Pixel) Size image for best quality.
                                        Only jpg, jpeg, png image is allowed.') }}
                                    </p>
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
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                    <div class="flex py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
                    <h3 class="mt-1 w-1/2">{{ __('FunFacts List') }}</h3>
                    <div class="w-1/2 justify-end flex">
                        <div class="inline-block mr-4">
                            <select class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm lang" id="languageSelect" data="{{url()->current() . '?language='}}">
                                @foreach($langs as $lang)
                                    <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}} >{{$lang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('admin.funfact.add'). '?language=' . $currentLang->code }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-plus"></i> {{ __('Add offer') }}
                        </a>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="flex-auto p-6 block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent table-striped table-bordered data_table">
                        <thead>
                            <tr>
                                <th class="px-1 py-2">{{ __('#') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Icon') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Name') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Value') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Action') }}</th>
                                </tr>
                        </thead>
                        <tbody>
                        
                        @foreach ($funfacts as $id=>$funfact)
                        <tr>
                            <td class="px-1 py-2">{{ ++$id }}</td>
                            <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                <img  class="w-60" src="{{ asset('assets/front/img/'.$funfact->icon) }}" alt="">
                            </td>
                            <td class="px-1 py-2 border-b border-gray-200 text-sm">{{ $funfact->name }}</td>
                            <td class="px-1 py-2 border-b border-gray-200 text-sm">{{ $funfact->value }}</td>
                            <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                <a href="{{ route('admin.funfact.edit', $funfact->id )  }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-indigo-600 text-white hover:bg-teal-600 py-1 px-2 leading-tight text-xs "><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>

                                <form  id="deleteform" class="inline-block" action="{{ route('admin.funfact.delete', $funfact->id ) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $funfact->id }}">
                                    <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-red-600 text-white hover:bg-red-700 py-1 px-2 leading-tight text-xs " id="delete">
                                    <i class="fas fa-trash"></i>{{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
@endsection
