@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
        <div class="sm:w-1/2 pr-4 pl-4">
            <h1 class="flex flex-wrap pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 m-0 text-gray-900">{{ __('Package Orders') }} </h1>
        </div><!-- /.col -->
        <div class="sm:w-1/2 pr-4 pl-4">
            <ol class="flex flex-wrap list-reset pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 rounded sm:float-right">
            <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="inline-block px-2 py-2 text-gray-700">{{ __('Package Orders') }}</li>
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
                        <h3 class="mt-1 w-1/2">{{ __('Completed Order List') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="flex-auto p-6">
                    <table class="w-full max-w-full mb-4 bg-transparent table-striped table-bordered data_table">
                        <thead>
                            <tr>
                                <th class="px-1 py-2">{{ __('#') }}</th>
                                <th>{{ __('Package Name') }}</th>
                                <th>{{ __('User Name') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($package_compleated_orders as $id=>$order)
                            <tr>
                                <td>
                                    {{ $id }}
                                </td>
                                <td>
                                    {{ $order->package->name }}
                                </td>
                                <td>
                                    {{ $order->user->username }}
                                </td>
                                <td>
                                    {{ $order->currency_sign }} {{ $order->package_cost }}
                                </td>
                                <td>
                                    {{ $order->method }}
                                </td>
                                <td>
                                    @if($order->status == 0)
                                        <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-indigo-600 text-white hover:bg-teal-600">{{ __('Pending') }}</span>
                                    @elseif($order->status == 1)
                                        <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-blue-500 text-white hover:bg-blue-600">{{ __('In Progress') }}</span>
                                    @elseif($order->status == 2)
                                        <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">{{ __('Completed') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <form  id="deleteform" class="inline-block" action="{{ route('admin.package.delete_order', $order->id ) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-red-600 text-white hover:bg-red-700 py-1 px-2 leading-tight text-xs " id="delete">
                                        <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="#" data-id="{{ $order->id }}" class="inline-flex justify-center py-1 px-2 border border-transparent shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 package_order_view" data-toggle="modal" data-target="#package_order_view"><i class="fas fa-eye mr-0"></i></a>
                                    @if($order->invoice_number)
                                    <a class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap bg-yellow-500 no-underline bg-orange-400 text-black hover:bg-yellow-600 py-1 px-2 leading-tight text-xs  " href="{{asset('assets/front/invoices/package/'.$order->invoice_number)}}" target="_blank">Invoice</a>
                                    @endif
                                    <a href="#" data-id="{{ $order->id }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-indigo-600 text-white hover:bg-teal-600 py-1 px-2 leading-tight text-xs  package_order_status"  data-toggle="modal" data-target="#package_order_status">{{ __('Update Status') }}</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    </div>
                </div>
                <span class="text-red-600">{{ __('If package orders are deleted then all bill pay information under this package will be deleted !!!') }}</span>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- Package order view modal -->
<div class="modal" id="package_order_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLaravel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Order Quick View') }}</h5>
          <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="flex flex-wrap ">
                <div class="lg:w-1/2 pr-4 pl-4">
                    <h6 class="mb-3"><strong>{{ __('Customar Info :') }}</strong></h6>
                    <table class="w-full max-w-full mb-4 bg-transparent border table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">{{ __('Full Name') }}</th>
                                <td id="fname"></td>
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
                    <h6 class="mb-3"><strong>{{ __('Order Info :') }}</strong></h6>
                    <table class="w-full max-w-full mb-4 bg-transparent border table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">{{ __('Package Name') }}</th>
                                <td id="packname"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Speed Limit') }}</th>
                                <td><span id="packspeed"></span> <span>{{ __('Mbps') }}</span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Package Price') }}</th>
                                <td><span id="currency_sign"></span> <span id="packprice"></span> / <span id="packtime"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Package Feature') }}</th>
                                <td id="packfeature"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Payment Method') }}</th>
                                <td id="method"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Attendance Id') }}</th>
                                <td id="attendance_id"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Txn Id') }}</th>
                                <td id="txn_id"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Status') }}</th>
                                <td id="status"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
      </div>
    </div>
</div>
<!-- package_order_status  modal -->
<div class="modal" id="package_order_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLaravel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Update Order Status') }}</h5>
          <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="{{ route('admin.package.order_update_status') }}" method="POST">
                @csrf
                <input type="hidden" name="status_orderid" id="status_orderid" value="">
                <div class="mb-4">
                    <div id="status-wrape">
                        <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="status">
                        </select>
                    </div>
                    @if ($errors->has('status'))
                        <p class="text-red-600"> {{ $errors->first('status') }} </p>
                    @endif
                </div>
                <div class="mb-4">
                    <div class="">
                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ __('Update') }}</button>
                    </div>
                </div>
            
            </form>
        </div> 
      </div>
    </div>
</div>


@endsection
