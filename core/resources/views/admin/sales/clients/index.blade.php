@extends('admin.layout')

@section('content')
<div class="content-header">
  <div class="container mx-auto sm:px-4 max-w-full">
      <div class="flex flex-wrap ">
      <div class="sm:w-1/2 pr-4 pl-4">
          <h1 class="flex flex-wrap pt-3 pb-3 m-0 text-gray-900">
            {{ __('Clients List') }}
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
  @csrf
  <div class="container sm:px-4 max-w-full mx-auto">
    <div class="flex flex-wrap ">
      <div class="w-full overflow-hidden mb-4 border border-gray-200 sm:rounded-lg">
        <table id="js-data-tables" class="w-full divide-y divide-gray-200">
          <div class="flex py-3">
            <button id="js-inactive" class="inline-flex justify-center px-2 py-2 mr-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">{{__('INACTIVE')}}</button>
            <button id="js-near-end" class="inline-flex justify-center px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-yellow-400 border border-transparent rounded-lg active:bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:shadow-outline-yellow">{{__('NEAR END')}}</button>
          </div>
          <thead class="bg-gray-300">
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Package') }}</th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Plan') }}</th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('End Date') }}</th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Renew') }}</th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Sales') }}</th>
            </tr>
          </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($clients as $key => $client)
          @foreach ($client->sales as $sale)
              
          <tr class="border-b border-gray-200 hover:bg-gray-100">
            <td class="px-6 py-4 whitespace-nowrap text-center">
              <span>{{ $sale->id }}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              {{ $client->name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              {{ $sale->packageOrder->package->name }}
            </td>
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
            <td class="px-6 py-4 whitespace-nowrap text-center">
              {{ $sale->packageOrder->end_date }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              @if ($sale->packageOrder->package_status === \App\Packageorder::INACTIVE)
              <span class="p-2 text-xs font-normal rounded-full bg-red-600 text-white">{{__('INACTIVE')}}</span>
              @elseif ($sale->packageOrder->package_status === \App\Packageorder::ACTIVE)
              <span class="p-2 text-xs font-normal rounded-full bg-green-600 text-white">{{__('ACTIVE')}}</span>
              @elseif ($sale->packageOrder->package_status === \App\Packageorder::NEAR_END)
              <span class="p-2 text-xs font-normal rounded-full bg-yellow-400 text-white">{{__('NEAR END')}}</span>
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              <button href="#" data-id="{{ $sale->id }}" data-plan ="{{ $sale->packageOrder->plan->type }}" class="js-package-renew inline-flex justify-center px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" data-toggle="modal" data-target="#package-renew">{{__('Renew')}}</button>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              <a href="{{route('admin.sales.clients.show', ['id' => $client->id])}}" class="inline-flex justify-center px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">{{__('Sales')}}</a>
            </td>
          </tr> 
          @endforeach
        @endforeach 
        </tbody>
      </table>
      </div>
    </div>
  </div>
</section>

<!-- Billpay view modal -->
<div class="modal" id="package-renew" tabindex="-1" role="dialog" aria-hidden="true" class="w-1/2">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ __('Package Renew') }}</h5>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.sales.packages.renew')}}" method="POST">
          @csrf
          <input type="hidden" name="sale_id" id="js-sale-id">
          <div class="mb-4 flex flex-wrap items-center">
            <label for="plan" class="w-2/5 pr-4 pl-4 control-label">{{ __('Select Plan') }}<span class="text-red-600">*</span></label>
            <div class="w-3/5 pr-4 pl-4">
              <select name="plan" id="plan" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                <option value="{{\App\Plan::MONTHLY_PLAN}}">{{__('MONTHLY PLAN')}}</option>
                <option value="{{\App\Plan::QUARTER_PLAN}}">{{__('QUARTER PLAN')}}</option>
                <option value="{{\App\Plan::SEMIANNUAL_PLAN}}">{{__('SEMIANNUAL PLAN')}}</option>
                <option value="{{\App\Plan::ANNUAL_PLAN}}">{{__('ANNUAL PLAN')}}</option>
              </select>
            </div>
          </div>
          <div class="mb-4 flex flex-wrap ">
            <div class="mx-1/5 w-4/5 pr-4 pl-4">
                <button type="submit" class="inline-block align-middle select-none border whitespace-no-wrap py-2 px-4 bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">{{ __('Save Bill') }}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/admin/js/clients-sales.js')}}"></script>
<script src="{{asset('assets/admin/js/data-tables.js')}}"></script>
@endsection
