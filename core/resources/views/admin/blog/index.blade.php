@extends('admin.layout')

@section('content')

<div class="p-0 -mb-5">
    <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
        <div class="sm:w-1/2 pr-4 pl-4">
            <h1 class="flex flex-wrap text-lg capitalize text-bold pt-3 pb-3 py-4 px-4 mb-2 m-0 text-gray-900">{{ __('Blogs') }}</h1>
        </div><!-- /.col -->
        <div class="sm:w-1/2 pr-4 pl-4">
            <ol class="flex flex-wrap list-reset sm:float-right py-4 px-4 mb-2 m-0">
            <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="inline-block px-2 py-2 text-gray-700">{{ __('Blogs') }}</li>
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
                        <h3 class="px-4 mt-1 w-1/2">{{ __('Offer Content') }}</h3>
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
                        <form class="form-horizontal" action="{{ route('admin.blogcontent.update',  $saectiontitle->language_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Blog Title') }}<span class="text-red-600">*</span></label>

                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="blog_title" placeholder="{{ __('Blog Title') }}" value="{{ $saectiontitle->blog_title }}">
                                    @if ($errors->has('blog_title'))
                                        <p class="text-red-600"> {{ $errors->first('blog_title') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label  class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Blog Sub-title') }}<span class="text-red-600">*</span></label>

                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="blog_subtitle" placeholder="{{ __('Blog Sub-Title') }}" value="{{ $saectiontitle->blog_subtitle }}">
                                    @if ($errors->has('blog_subtitle'))
                                        <p class="text-red-600"> {{ $errors->first('blog_subtitle') }} </p>
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
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                    <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    <h3 class="px-4 mt-1 w-1/2">{{ __('Blog List:') }}</h3>
                    <div class="w-1/2 justify-end flex">
                        <div class="inline-block mr-4">
                            <select class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm lang" id="languageSelect" data="{{url()->current() . '?language='}}">
                                @foreach($langs as $lang)
                                    <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}} >{{$lang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('admin.blog.add'). '?language=' . $currentLang->code }}" class="inline-flex justify-center py-2 px-4 mr-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-plus"></i> {{ __('Add') }}
                        </a>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="flex-auto p-6">
                    <table id="idtable" class="w-full max-w-full mb-4 bg-transparent table-bordered table-striped data_table">
                        <thead>
                            <tr>
                                <th class="px-1 py-2">{{ __('#') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Image') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Title') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Category') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Status') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($blogs as $id=>$blog)
                            <tr>
                                <td class="px-1 py-2">{{ ++$id }}</td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                    <img class="w-80" src="{{ asset('assets/front/img/'.$blog->main_image) }}" alt="">
                                </td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                    {{ $blog->title }}
                                </td> 
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                    {{ $blog->bcategory->name }}
                                </td> 
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                        @if($blog->status == 1)
                                            <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">{{ __('Publish') }}</span>
                                        @else
                                            <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-orange-400 text-black hover:bg-orange-500">{{ __('Unpublish') }}</span>
                                        @endif
                                        
                                    </td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                    <a href="{{ route('admin.blog.edit', $blog->id) }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-indigo-600 text-white hover:bg-teal-600 py-1 px-2 leading-tight text-xs "><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>
                                    <form  id="deleteform" class="inline-block" action="{{ route('admin.blog.delete', $blog->id ) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $blog->id }}">
                                        <button type="submit" class="inline-block align-middle text-center select-none px-2 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple" id="delete">
                                        <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
@endsection

