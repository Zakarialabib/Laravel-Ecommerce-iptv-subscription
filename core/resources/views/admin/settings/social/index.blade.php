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
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                    <div class="flex py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
                        <h3 class="w-1/2">{{ __('Add Social Links') }} </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="flex-auto p-6">
                        <form id="slink" class="form-horizontal" action="{{ route('admin.storeSlinks') }}" method="POST" onsubmit="store(event)">
                            @csrf
                            
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Social Icon') }} <span
                                        class="text-red-600">*</span></label>

                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700 biconpicker" data-iconset="fontawesome5" data-icon="fab fa-facebook-f" role="iconpicker"></button>
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
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="url" value="" placeholder="{{ __('Social URL') }}">
                                    @if ($errors->has('url'))
                                    <p class="text-red-600"> {{ $errors->first('url') }} </p>
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
                    <!-- /.box-body -->
                </div>

            </div>
            <!-- /.col -->
        </div>
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-info card-outline">
                    <div class="flex py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
                        <h3 class="w-1/2">{{ __('Social Links List') }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="flex-auto p-6">
                        <table class="w-full max-w-full mb-4 bg-transparent table-striped table-bordered data_table">
                            <thead>
                            <tr>
                                <th class="px-1 py-2">{{ __('#') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">Icon</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">URL</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($slinks as $id=>$slink)
                            <tr>
                                <td class="px-1 py-2">{{ ++$id }}</td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">{{ $slink->icon }}</td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">{{ $slink->url}}</td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                    <a href="{{ route('admin.editSlinks', $slink->id) }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-indigo-600 text-white hover:bg-teal-600 py-1 px-2 leading-tight text-xs "><i class="fas fa-pencil-alt"></i>Edit</a>
                                    <form  id="deleteform" class="inline-block" action="{{ route('admin.deleteSlinks', $slink->id ) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $slink->id }}">
                                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-red-600 text-white hover:bg-red-700 py-1 px-2 leading-tight text-xs " id="delete">
                                        <i class="fas fa-trash"></i>{{ __('Delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>

                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
            <!-- /.col -->
        </div>
    </div>


</section>

@endsection

