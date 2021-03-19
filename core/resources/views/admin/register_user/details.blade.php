@extends('admin.layout')

@section('content')

    <div class="content-header">
        <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
            <div class="flex flex-wrap ">
                <div class="sm:w-1/2 pr-4 pl-4">
                    <h1 class="flex flex-wrap pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 m-0 text-gray-900">
                        {{ __('Customer Details') }}
                    </h1>
                </div><!-- /.col -->
                <div class="sm:w-1/2 pr-4 pl-4">
                    <ol class="flex flex-wrap list-reset pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 rounded sm:float-right">
                        <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="inline-block px-2 py-2 text-gray-700">
                            {{ __('Customer Details') }}
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
            <div class="flex flex-wrap ">
                <div class="md:w-1/3 pr-4 pl-4">
                    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                        <div class="flex py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
                            <h3 class="mt-1 w-1/2">{{ __('Customer Details') }}</h3>
                        </div>

                        <div class="flex-auto p-6">
                            <table class="w-full max-w-full mb-4 bg-transparent  table-bordered">
                                <tr>
                                    <th>{{ __('Name') }} </th>
                                    <td> {{$user->name}}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Username') }} </th>
                                    <td> {{$user->username}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Email:')}} </th>
                                    <td> {{$user->email}} </td>
                                </tr>
                                <tr>
                                    <th>{{__('Number:')}} </th>
                                    <td>  {{$user->phone}}</td>
                                </tr>
                                <tr>
                                    <th> {{__('Country:')}}</th>
                                    <td>  {{$user->country}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('City:')}}</th>
                                    <td>  {{$user->city}}</td>
                                </tr>
                                <tr>
                                    <th> {{__('Address:')}}</th>
                                    <td> {{$user->address}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                @if($package)
                <div class="md:w-2/3 pr-4 pl-4">
                    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                        <div class="flex py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
                            <h3 class="mt-1 w-1/2">{{ __('Active Package') }}</h3>
                        </div>

                        <div class="flex-auto p-6">
                            <table class="w-full max-w-full mb-4 bg-transparent  table-bordered">
                                <tr>
                                    <th>{{ __('Package Name') }} </th>
                                    <td> {{ $package->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Speed Limit')}}</th>
                                    <td>{{ $package->speed }}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Package Price')}}</th>
                                    <td>{{ Helper::showCurrency() }}{{ $package->price }} / {{ $package->time }}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Package Feature')}}</th>
                                    <td>{{ $package->feature }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @if($bills->count() > 0)
            <div class="flex flex-wrap ">
                <div class="lg:w-full pr-4 pl-4">
                    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300  card-primary card-outline">
                        <div class="flex py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
                            <h3 class="mt-1 w-1/2">{{ __('Bill Pay') }}</h3>
                        </div>
                        <div class="flex-auto p-6">
                            <table  class="w-full max-w-full mb-4 bg-transparent table-bordered table-striped data_table">
                                <thead>
                                <tr>
                                    <th class="px-1 py-2">{{ __('#') }}</th>
                                    <th>{{ __('Package Name') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Method') }}</th>
                                    <th>{{ __('Bill Paid') }}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($bills as $id=>$bill)
                                    <tr>
                                        <td>{{ $id }}</td>
                                        <td>
                                            {{ $bill->package->name }}
                                        </td>
                                        <td>
                                            <strong>{{ $bill->currency_sign }}{{ $bill->package_cost }}</strong> / {{ $bill->package->time }}
                                        </td>
                                        <td>
                                            {{ $bill->method }}
                                        </td>
                                        <td>
                                            {{ $bill->fulldate }}
                                        </td>
                                  
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!-- /.row -->
    </section>



@endsection
