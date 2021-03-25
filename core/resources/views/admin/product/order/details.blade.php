@extends('admin.layout')

@section('content')

<div class="p-0 -mb-5">
    <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
        <div class="sm:w-1/2 pr-4 pl-4">
            <h1 class="flex flex-wrap text-lg capitalize text-bold pt-3 pb-3 py-4 px-4 mb-2 m-0 text-gray-900">
              {{ __('Order Details') }}
            </h1>
        </div><!-- /.col -->
        <div class="sm:w-1/2 pr-4 pl-4">
            <ol class="flex flex-wrap list-reset sm:float-right py-4 px-4 mb-2 m-0">
            <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="inline-block px-2 py-2 text-gray-700">
              {{ __('Order Details') }}
            </li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
            <div class="
            @if($order->shipping_name && $order->shipping_email && $order->shipping_number &&  $order->shipping_address)
                col-md-4
                @else
                col-md-6 
            @endif
            ">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                        <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                            <h3 class="px-4 mt-1 w-1/2">{{ __('Order') }}  [ {{ $order->order_number}} ]</h3>
                        </div>

                        <div class="flex-auto p-6">
                            <table class="table-auto mb-4 bg-transparent  table-bordered">
                                <tr>
                                    <th>{{__('Payment Status')}} :</th>
                                    <td>
                                        @if($order->payment_status =='Pending' || $order->payment_status == 'pending')
                                        <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-600 text-white hover:bg-red-700">{{Helper::convertUtf8($order->payment_status)}}  </span>
                                        @else
                                        <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">{{Helper::convertUtf8($order->payment_status)}}  </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{__('Order Status')}} :</th>
                                    <td>
                                        @if ($order->order_status == 'pending')
                                        <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-orange-400 text-black hover:bg-orange-500">{{Helper::convertUtf8($order->order_status)}}  </span>
                                        @elseif ($order->order_status == 'processing')
                                        <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-blue-500 text-white hover:bg-blue-600">{{Helper::convertUtf8($order->order_status)}}  </span>
                                        @elseif ($order->order_status == 'completed')
                                        <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">{{Helper::convertUtf8($order->order_status)}}  </span>
                                        @elseif ($order->order_status == 'rejected')
                                        <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-600 text-white hover:bg-red-700">{{Helper::convertUtf8($order->order_status)}}  </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{__('Paid amount')}} :</th>
                                    <td>{{$order->total}}{{  Helper::showCurrency() }}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Shipping Charge')}} :</th>
                                    <td>{{$order->shipping_charge}}{{  Helper::showCurrency() }}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Payment Method')}} :</th>
                                    <td>{{Helper::convertUtf8($order->method)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Order Date')}} :</th>
                                    <td>{{Helper::convertUtf8($order->created_at->format('d-m-Y'))}}</td>
                                </tr>
                            </table>
                    </div>
                </div>
            </div>
            @if($order->shipping_name && $order->shipping_email && $order->shipping_number &&  $order->shipping_address)
            <div class="md:w-1/3 pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                        <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                            <h3 class="px-4 mt-1 w-1/2">{{ __('Billing Details') }}</h3>
                        </div>

                        <div class="flex-auto p-6">
                            <table class="table-auto mb-4 bg-transparent  table-bordered">
                                <tr>
                                    <th>{{__('Email')}} :</th>
                                    <td>{{Helper::convertUtf8($order->billing_email)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Phone')}} :</th>
                                    <td> {{$order->billing_number}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('City')}} :</th>
                                    <td>{{Helper::convertUtf8($order->billing_city)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Address')}} :</th>
                                    <td>{{Helper::convertUtf8($order->billing_address)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Country')}} :</th>
                                    <td>{{Helper::convertUtf8($order->billing_country)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Zip Code')}} :</th>
                                    <td>{{Helper::convertUtf8($order->billing_zip)}}</td>
                                </tr>
                            </table>
                    </div>
                </div>
            </div>
            <div class="md:w-1/3 pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                        <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                            <h3 class="px-4 mt-1 w-1/2">{{ __('Shipping Details') }}</h3>
                        </div>

                        <div class="flex-auto p-6">
                            <table class="table-auto mb-4 bg-transparent  table-bordered">
                                <tr>
                                    <th>{{__('Email')}} :</th>
                                    <td>{{Helper::convertUtf8($order->shipping_email)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Phone')}} :</th>
                                    <td> {{$order->shipping_number}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('City')}} :</th>
                                    <td>{{Helper::convertUtf8($order->shipping_city)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Address')}} :</th>
                                    <td>{{Helper::convertUtf8($order->shipping_address)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Country')}} :</th>
                                    <td>{{Helper::convertUtf8($order->shipping_country)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Zip Code')}} :</th>
                                    <td>{{Helper::convertUtf8($order->shipping_zip)}}</td>
                                </tr>
                            </table>
                    </div>
                </div>
            </div>
            @else 
                <div class="md:w-1/2 pr-4 pl-4">
                    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                            <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                                <h3 class="px-4 mt-1 w-1/2">{{ __('Billing Details') }}</h3>
                            </div>

                            <div class="flex-auto p-6">
                                <table class="table-auto mb-4 bg-transparent  table-bordered">
                                    <tr>
                                        <th>{{__('Email')}} :</th>
                                        <td>{{Helper::convertUtf8($order->billing_email)}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('Phone')}} :</th>
                                        <td> {{$order->billing_number}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('City')}} :</th>
                                        <td>{{Helper::convertUtf8($order->billing_city)}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('Address')}} :</th>
                                        <td>{{Helper::convertUtf8($order->billing_address)}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('Country')}} :</th>
                                        <td>{{Helper::convertUtf8($order->billing_country)}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('Zip Code')}} :</th>
                                        <td>{{Helper::convertUtf8($order->billing_zip)}}</td>
                                    </tr>
                                </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                        <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                            <h3 class="px-4 mt-1 w-1/2">{{ __('Order Product') }}</h3>
                        </div>

                        <div class="flex-auto p-6">
                            <table class="table-auto mb-4 bg-transparent  table-bordered table-striped data_table">
                                <thead>
                                    <tr>
                                       <th>{{ __('#') }}</th>
                                       <th>{{__('Image')}}</th>
                                       <th>{{__('Name')}}</th>
                                       <th>{{__('Details')}}</th>
                                       <th>{{__('Price')}}</th>
                                       <th>{{__('Total')}}</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($order->orderitems as $key => $item)
                                    <tr>
                                       <td>{{$key+1}}</td>
                                       <td><img class="w-80" src="{{asset('assets/front/img/'.$item->image)}}" alt="product" ></td>
                                       <td>{{Helper::convertUtf8($item->title)}}</td>
                                       <td>
                                          <b>{{__('Quantity')}}:</b> <span>{{$item->qty}}</span><br>
                                       </td>
                                       <td>{{$item->price}}{{  Helper::showCurrency() }}</td>
                                       <td>{{$item->price * $item->qty}}{{  Helper::showCurrency() }}</td>
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
