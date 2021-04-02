@extends('admin.layout')

@section('content')
<div class="content-header">
  <div class="container mx-auto sm:px-4 max-w-full">
      <div class="flex flex-wrap ">
      <div class="sm:w-1/2 pr-4 pl-4">
          <h1 class="flex flex-wrap pt-3 pb-3 m-0 text-gray-900">
            {{ __('Sale info') }}
          </h1>
      </div><!-- /.col -->
      <div class="sm:w-1/2 pr-4 pl-4">
          <ol class="flex flex-wrap list-reset pt-3 pb-3 mb-4 rounded sm:float-right">
          <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
          </ol>
      </div><!-- /.col -->
      </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<section class="content">
  <div class="container mx-auto sm:px-4 max-w-full">
    <div class="flex flex-wrap ">
      <div class="container px-3">
        <div class="flex flex-col">
          <div class="w-full overflow-hidden mb-4 border border-gray-200 sm:rounded-lg">
            <table class="w-full divide-y divide-gray-200">
              <thead class="bg-gray-300">
                <tr>
                  <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Reference')}}</th>
                  <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Customer')}}</th>
                  <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Agent')}}</th>
                  <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Document')}}</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-center">{{$sale->reference}}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-center">{{$sale->user->name}}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-center">{{$sale->admin->name}}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-center">
                    @if ($sale->document)    
                    <div class="flex justify-center">
                      <div class="py-2 px-3 bg-gray-300">{{$sale->document}}</div>
                      <a href="{{asset('core/storage/app/sales/documents/'.$sale->document)}}" class="rounded-sm px-3 py-2 focus:outline-none text-white font-bold bg-blue-500 hover:bg-blue-700">
                        <i class="fas fa-download"></i>
                      </a>
                    </div>
                    @else
                    N/A
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="flex flex-col mb-4">
            <h1 class="font-bold text-md py-2">{{__('Sale Items')}}</h1>
            <div class="overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-300">
                  <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">id</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Package')}}</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Plan')}}</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Price')}}</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Start Date')}}</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Status')}}</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                      <span>1</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{$sale->packageOrder->package->name}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                      @if($sale->packageOrder->plan->type === \App\Plan::MONTHLY_PLAN)
                      {{__('MONTHLY PLAN')}}
                      @elseif($sale->packageOrder->plan->type === \App\Plan::QUARTER_PLAN)
                      {{__('QUARTER_PLAN')}}
                      @elseif($sale->packageOrder->plan->type === \App\Plan::SEMIANNUAL_PLAN)
                      {{__('SEMIANNUAL PLAN')}}
                      @elseif($sale->packageOrder->plan->type === \App\Plan::ANNUAL_PLAN)
                      {{__('ANNUAL PLAN')}}
                      @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">{{$sale->packageOrder->package_cost}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">{{$sale->packageOrder->start_date}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                      @if ($sale->packageOrder->package_status === \App\Packageorder::INACTIVE)
                      <span class="p-2 text-xs font-normal rounded-full bg-red-600 text-white"> {{__('INACTIVE')}}</span>
                      @elseif ($sale->packageOrder->package_status === \App\Packageorder::ACTIVE)
                      <span class="p-2 text-xs font-normal rounded-full bg-green-600 text-white">{{__('ACTIVE')}}</span>
                      @elseif ($sale->packageOrder->package_status === \App\Packageorder::NEAR_END)
                      <span class="p-2 text-xs font-normal rounded-full bg-yellow-400 text-white">{{__('NEAR END')}}</span>
                      @endif
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="w-1/3 overflow-hidden mb-4 border border-gray-200 sm:rounded-lg">
            <table class="w-full divide-y divide-gray-200">
              <thead class="bg-gray-300">
                <tr>
                  <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Subtotal')}}</th>
                  <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Tax')}}</th>
                  <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Total')}}</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-center">{{$sale->subtotal}}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-center">{{$sale->tax}}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-center">{{$sale->total}}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="w-1/2 overflow-hidden mb-4 border border-gray-200 sm:rounded-lg">
            <table class="w-full divide-y divide-gray-200">
              <thead class="bg-gray-300">
                <tr>
                  <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Payment status')}}</th>
                  <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Payment method')}}</th>
                  <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Paid amount')}}</th>
                  <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Due')}}</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-center">
                    @if ($sale->payment->status === \App\Payment::STATUS_DUE){{__('DUE')}}@endif
                    @if ($sale->payment->status === \App\Payment::STATUS_PAID){{__('PAID')}}@endif
                    @if ($sale->payment->status === \App\Payment::STATUS_PENDING){{__('PENDING')}}@endif
                    @if ($sale->payment->status === \App\Payment::STATUS_PARTIAL){{__('PARTIAL')}}@endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-center">
                    @if ($sale->payment->method === \App\Payment::METHOD_CASH){{__('CASH')}}@endif
                    @if ($sale->payment->method === \App\Payment::METHOD_CHECK){{__('CHECK')}}@endif
                    @if ($sale->payment->method === \App\Payment::METHOD_DEPOSIT){{__('DEPOSIT')}}@endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-center">{{$sale->payment->paid_amount}}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-center">{{$sale->payment->due}}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="w-full flex justify-between mb-4">
            <textarea
              class="border rounded-sm px-3 py-2 focus:outline-none w-full mr-2"
              name="note"
              cols="30"
              rows="10"
              readonly
            >{{$sale->note}}</textarea>
            <textarea
              class="border rounded-sm px-3 py-2 focus:outline-none w-full"
              name="payment_note"
              id=""
              cols="30"
              rows="10"
              readonly
            >{{$sale->payment->note}}</textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
<section>
@endsection
