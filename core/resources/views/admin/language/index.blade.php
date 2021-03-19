
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
                            <h3 class="mt-1 w-1/2">{{ __('Languages List') }}</h3>
                            <div class="flex w-1/2 justify-end">
                                <a href="{{ route('admin.language.add') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <i class="fas fa-plus"></i> {{ __('Add Language') }}
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="flex-auto p-6">
                            @if (count($languages) == 0)
                                <h3 class="text-center">NO LANGUAGE FOUND</h3>
                            @else
                            <table class="w-full max-w-full mb-4 bg-transparent table-striped table-bordered data_table">
                                <thead>
                                    <tr>
                                        <th class="px-1 py-2">{{ __('#') }}</th>
                                        <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Name') }}</th>
                                        <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Code') }}</th>
                                        <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Direction') }}</th>
                                        <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Default') }}</th>
                                        <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($languages as $id=>$language)
                                    <tr>
                                        <td class="px-1 py-2">{{ ++$id }}</td>
                                        <td class="px-1 py-2 border-b border-gray-200 text-sm">{{$language->name}}</td>
                                        <td class="px-1 py-2 border-b border-gray-200 text-sm">{{$language->code}}</td>
                                        <td class="uppercase">{{$language->direction}}</td>
                                        <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                            @if ($language->is_default == 1)
                                            <strong class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-green-500 text-white hover:bg-green-600 btn-xs">Default</strong>
                                            @else
                                            <form class="inline-block" action="{{route('admin.language.default', $language->id)}}" method="post">
                                                @csrf
                                                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600 btn-xs" type="submit" name="button">Make Default</button>
                                            </form>
                                            @endif
                                        </td>
                                        <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                            <a class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-indigo-600 text-white hover:bg-teal-600 py-1 px-2 leading-tight text-xs " href="{{route('admin.language.editKeyword', $language->id)}}">
                                            <i class="fas fa-edit"></i>
                                            {{ __('Edit Keyword') }}
                                            </a>
                                            <a class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline text-white bg-indigo-600 hover:bg-indigo-700 py-1 px-2 hover:bg-indigo-700 px-2 leading-tight text-xs" href="{{route('admin.language.edit', $language->id)}}">
                                                <i class="fas fa-pencil-alt"></i>{{ __('Edit') }}
                                            </a>
                                            <form class="deleteform inline-block" action="{{route('admin.language.delete', $language->id)}}" method="post">
                                            @csrf
                                            <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-red-600 text-white hover:bg-red-700 py-1 px-2 leading-tight text-xs  deletebtn">
                                                <i class="fas fa-trash"></i>{{ __('Delete') }}
                                            </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
@endsection
