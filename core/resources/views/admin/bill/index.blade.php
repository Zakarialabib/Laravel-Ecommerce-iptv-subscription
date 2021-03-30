@extends('admin.layout')

@section('content')

<div class="p-0 -mb-5">
    <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
        <div class="sm:w-1/2 pr-4 pl-4">
            <h1 class="flex flex-wrap text-lg capitalize text-bold pt-3 pb-3 py-4 px-4 mb-2 m-0 text-gray-900">{{ __('Bill pay') }} </h1>
        </div><!-- /.col -->
        <div class="sm:w-1/2 pr-4 pl-4">
            <ol class="flex flex-wrap list-reset sm:float-right py-4 px-4 mb-2 m-0">
            <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="inline-block px-2 py-2 text-gray-700">{{ __('Bill pay') }}</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                    <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        <h3 class="px-4 mt-1 w-1/2">{{ __('Bill pay List') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="flex-auto p-6">
                    <table class="table-auto mb-4 bg-transparent table-striped table-bordered data_table">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Package Name') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('User Name') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Price') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Payment Method') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Package Duration') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Bill Paid') }}</th>
                                <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($bills as $id=>$bill)
                            <tr>
                                <td>
                                    {{ $id }}
                                </td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                    {{ $bill->package->name }}
                                </td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                    {{ $bill->user->username }}
                                </td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                    {{ $bill->currency_sign }}{{ $bill->package_cost }}
                                </td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                    {{ $bill->method }}
                                </td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                    {{ $bill->package->time }}
                                </td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                    {{ $bill->fulldate }}
                                </td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                    <form  id="deleteform" class="inline-block" action="{{ route('admin.billpay_delete', $bill->id ) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $bill->id }}">
                                        <button type="submit" class="inline-block align-middle text-center select-none px-2 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple" id="delete">
                                        <i class="fas fa-trash"></i>
                                        </button>
                                    </form> @if($bill->invoice_number)
                                    <a class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap bg-yellow-500 no-underline bg-orange-400 text-black hover:bg-yellow-600 py-1 px-2 leading-tight text-xs  " href="{{asset('assets/front/invoices/bill/'.$bill->invoice_number)}}" target="_blank">{{ __('Invoice') }}</a>
                                    @endif
                                    <a href="#" data-id="{{ $bill->id }}" class="inline-flex justify-center px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple billpay_view" data-toggle="modal" data-target="#billpay_view"><i class="fas fa-eye mr-0"></i></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- Billpay view modal -->
<div class="modal" id="billpay_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLaravel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Bill Quick View') }}</h5>
          <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="flex flex-wrap ">
                <div class="lg:w-1/2 pr-4 pl-4">
                    <h6 class="mb-3"><strong>{{ __('Customer Info :') }}</strong></h6>
                    <table class="table-auto mb-4 bg-transparent border table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">{{ __('Full Name') }}</th>
                                <td id="name"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Username') }}</th>
                                <td id="username"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Email') }}</th>
                                <td id="email"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Phone') }}</th>
                                <td id="phone"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Address') }}</th>
                                <td id="address"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Country') }}</th>
                                <td id="country"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('City') }}</th>
                                <td id="city"></td>
                            </tr>
                       
                        </tbody>
                    </table>
                </div>
                <div class="lg:w-1/2 pr-4 pl-4">
                    <h6 class="mb-3"><strong>{{ __('Billpay Info :') }}</strong></h6>
                    <table class="table-auto mb-4 bg-transparent border table-striped">
                        <tbody>
                            
                            <tr>
                                <th scope="row">{{ __('Billpay Date') }}</th>
                                <td id="paydate"></td>
                            </tr>
                            
                            <tr>
                                <th scope="row">{{ __('Payment Method') }}</th>
                                <td id="method"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Package Name') }}</th>
                                <td id="packname"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Speed Limit') }}</th>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm"><span id="packspeed"></span> <span>{{ __('Mbps') }}</span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Package Price') }}</th>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm"><span id="currency_sign"></span> <span id="packprice"></span> / <span id="packtime"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Attendance Id') }}</th>
                                <td id="attendance_id"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Txn Id') }}</th>
                                <td id="txn_id"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
      </div>
    </div>
</div>
@endsection
