@extends('admin.layout')

@section('content')

    <div class="content-header">
        <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
            <div class="flex flex-wrap ">
                <div class="sm:w-1/2 pr-4 pl-4">
                    <h1 class="flex flex-wrap pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 m-0 text-gray-900">{{ __('Customers') }} </h1>
                </div><!-- /.col -->
                <div class="sm:w-1/2 pr-4 pl-4">
                    <ol class="flex flex-wrap list-reset pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 rounded sm:float-right">
                        <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="inline-block px-2 py-2 text-gray-700">{{ __('Customers') }}</li>
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
                            <h3 class="mt-1 w-1/2">{{ __('Customer Who buy package :') }}</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="flex-auto p-6">
                            <table class="w-full max-w-full mb-4 bg-transparent table-striped table-bordered data_table">
                                <thead>
                                    <tr>
                                        <th class="px-1 py-2">{{ __('#') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Username') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Number') }}</th>
                                        <th>{{ __('Address') }}</th>
                                        <th>{{ __('View More') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach ($activeusers as $id=>$user)
                                    <tr>
                                        <td>
                                            {{ $id }}
                                        </td>
                                        <td>
                                            <img src="{{!empty($user->photo) ? asset('assets/front/img/'.$user->photo) : ''}}" alt="" width="60">
                                        </td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>
                                            <a  href="{{route('register.user.view',$user->id)}}" class="inline-flex justify-center py-1 px-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"><i class="fas fa-eye"></i> View</a>
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
