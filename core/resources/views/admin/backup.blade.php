@extends('admin.layout')

@section('content')
    <div class="p-0 -mb-5">
        <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
            <div class="flex flex-wrap ">
                <div class="sm:w-1/2 pr-4 pl-4">
                    <div class="flex flex-wrap text-lg capitalize text-bold pt-3 pb-3 py-4 px-4 mb-2 m-0 text-gray-900"><h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">{{ __('Backup') }}</h1></div>
                </div><!-- /.col -->
                <div class="sm:w-1/2 pr-4 pl-4">
                    <ol class="flex flex-wrap list-reset sm:float-right py-4 px-4 mb-2 m-0">
                        <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="inline-block px-2 py-2 text-gray-700">{{ __('Backup') }}</li>
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
                        <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                            <h3 class="px-4 mt-1 w-1/2">{{ __('Backup Lists') }}</h3>
                            <div class="card-tools flex">
                                <form  action="{{route('admin.backup.store')}}" method="post">
                                    @csrf
                                    <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-blue-600 text-white hover:bg-blue-600 py-1 px-2 leading-tight text-xs "><i class="fas fa-plus"></i> Create Backup</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="flex-auto p-6">
                            @if (count($backups) == 0)
                                <h3 class="text-center">{{ __('NO BACKUP FOUND') }}</h3>
                            @else
                            <table  class="w-full max-w-full mb-4 bg-transparent table-striped table-bordered data_table">
                                <thead>
                                <tr>
                                    <th class="px-1 py-2">{{ __('#') }}</th>
                                    <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Data & Time') }}</th>
                                    <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($backups as $key => $backup)
                                    <tr>
                                        <td class="px-1 py-2 border-b border-gray-200 text-sm">{{$backup->created_at}}</td>
                                        <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                            <form class="inline-block" action="{{route('admin.backup.download', $backup->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="filename" value="{{$backup->filename}}">
                                                <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-gray-600 text-white hover:bg-gray-700 py-1 px-2 leading-tight text-xs ">
                                <span class="btn-label">
                                  <i class="fas fa-arrow-alt-circle-down"></i>
                                </span>
                                                    Download
                                                </button>
                                            </form>
                                            <form class="deleteform inline-block" action="{{route('admin.backup.delete', $backup->id)}}" method="post">
                                                @csrf
                                                <button type="submit" class="inline-block align-middle text-center select-none px-2 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple deletebtn">
                                                  <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                             @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection
