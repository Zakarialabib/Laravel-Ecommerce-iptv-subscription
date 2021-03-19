@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
        <div class="sm:w-1/2 pr-4 pl-4">
            <h1 class="flex flex-wrap pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 m-0 text-gray-900">
                @if (request()->path()=='admin/product/pending/orders')
                {{ __('Pending') }}
              @elseif (request()->path()=='admin/product/all/orders')
                {{ __('All') }}
              @elseif (request()->path()=='admin/product/processing/orders')
                {{ __('Processing') }}
              @elseif (request()->path()=='admin/product/completed/orders')
                {{ __('Completed') }}
              @elseif (request()->path()=='admin/product/rejected/orders')
                {{ __('Rejcted') }}
              @endif
              {{ __('Order') }}
            </h1>
        </div><!-- /.col -->
        <div class="sm:w-1/2 pr-4 pl-4">
            <ol class="flex flex-wrap list-reset pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 rounded sm:float-right">
            <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="inline-block px-2 py-2 text-gray-700">
                @if (request()->path()=='admin/product/pending/orders')
                {{ __('Pending') }}
              @elseif (request()->path()=='admin/product/all/orders')
                {{ __('All') }}
              @elseif (request()->path()=='admin/product/processing/orders')
                {{ __('Processing') }}
              @elseif (request()->path()=='admin/product/completed/orders')
                {{ __('Completed') }}
              @elseif (request()->path()=='admin/product/rejected/orders')
                {{ __('Rejcted') }}
              @endif
              {{ __('Order') }}
            </li>
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
                        <h3 class="mt-1 w-1/2">
                            @if (request()->path()=='admin/product/pending/orders')
                            {{ __('Pending') }}
                          @elseif (request()->path()=='admin/product/all/orders')
                            {{ __('All') }}
                          @elseif (request()->path()=='admin/product/processing/orders')
                            {{ __('Processing') }}
                          @elseif (request()->path()=='admin/product/completed/orders')
                            {{ __('Completed') }}
                          @elseif (request()->path()=='admin/product/rejected/orders')
                            {{ __('Rejcted') }}
                          @endif
                          {{ __('Order List') }}
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="flex-auto p-6">
                    <table class="w-full max-w-full mb-4 bg-transparent table-striped table-bordered data_table">
                        <thead>
                            <tr>
                                <th class="px-1 py-2">{{ __('#') }}</th>
                                <th scope="col">{{ __('Order Number') }}</th>
                                <th scope="col" width="15%">{{ __('Gateway') }}</th>
                                <th scope="col">{{ __('Total') }}</th>
                                <th scope="col">{{ __('Order Status') }}</th>
                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                            <tr>
                                <td class="px-1 py-2">{{ $key }}</td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">#{{$order->order_number}}</td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">{{$order->method}}</td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">{{  Helper::showCurrency() }}{{round($order->total,2)}}</td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                    <form id="statusForm{{$order->id}}" class="inline-block" action="{{route('admin.product.orders.status')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$order->id}}">
                                        <select class="form-control form-control-sm
                                        @if ($order->order_status == 'pending')
                                          bg-warning
                                        @elseif ($order->order_status == 'processing')
                                          bg-primary
                                        @elseif ($order->order_status == 'completed')
                                          bg-success
                                        @elseif ($order->order_status == 'rejected')
                                          bg-danger
                                        @endif
                                        " name="order_status" onchange="document.getElementById('statusForm{{$order->id}}').submit();">
                                          <option value="pending" {{$order->order_status == 'pending' ? 'selected' : ''}}>{{ __('Pending') }}</option>
                                          <option value="processing" {{$order->order_status == 'processing' ? 'selected' : ''}}>{{ __('Processing') }}</option>
                                          <option value="completed" {{$order->order_status == 'completed' ? 'selected' : ''}}>{{ __('Completed') }}</option>
                                          <option value="rejected" {{$order->order_status == 'rejected' ? 'selected' : ''}}>{{ __('Rejected') }}</option>
                                        </select>
                                      </form>
                                </td>
                                <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                    <div class="relative">
                                        <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded no-underline bg-indigo-600 text-white hover:bg-teal-600 py-2 px-4 leading-tight text-xs align border-b-0 border-t-1 border-r-1 border-l-1 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          {{ __('Actions') }}
                                        </button>
                                        <div class=" absolute left-0 z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-gray-300 rounded" aria-labelledby="dropdownMenuButton">
                                          <a class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0" href="{{route('admin.product.details', $order->id)}}" target="_blank">Details</a>
                                          <a class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0" href="{{asset('assets/front/invoices/product/'.$order->invoice_number)}}" target="_blank">Invoice</a>
                                          <form  id="deleteform" class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0" action="{{ route('admin.product.order.delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <button type="submit" id="delete">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                        </div>
                                    </div>
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



@endsection
