@extends('admin.layout')

@section('content')
<div class="content-header">
  <div class="container mx-auto sm:px-4 max-w-full">
      <div class="flex flex-wrap ">
      <div class="sm:w-1/2 pr-4 pl-4">
          <h1 class="flex flex-wrap pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 m-0 text-gray-900">
            {{ __('Client') }} : {{$user->name}}
          </h1>
      </div><!-- /.col -->
      <div class="sm:w-1/2 pr-4 pl-4">
          <ol class="flex flex-wrap list-reset pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 rounded sm:float-right">
          <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
          </ol>
      </div><!-- /.col -->
      </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<section class="content">
  <div class="container sm:px-4 max-w-full mx-auto">
    <div class="flex flex-wrap ">
      <div class="w-full overflow-hidden mb-4 border border-gray-200 sm:rounded-lg">
        <table class="w-full divide-y divide-gray-200">
          <thead class="bg-gray-300">
          <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Reference')}}</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Agent')}}</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Package')}}</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Total')}}</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Payment')}}</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status')}}</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('End Date')}}</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              <i class="fas fa-lock"></i>
            </th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions')}}</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach ($user->sales as $key => $sale)
          <tr class="border-b border-gray-200 hover:bg-gray-100">
            <td class="px-6 py-4 whitespace-nowrap text-center">
              <span>{{ $key + 1 }}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              {{ $sale->reference }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              {{ $sale->admin->name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              {{ $sale->packageOrder->package->name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              {{ $sale->total }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              @if ($sale->payment->status === \App\Payment::STATUS_DUE)
              <span class="p-2 text-xs font-normal rounded-full bg-red-600 text-white"> {{__('DUE')}}</span>
              @elseif ($sale->payment->status === \App\Payment::STATUS_PAID)
              <span class="p-2 text-xs font-normal rounded-full bg-green-600 text-white">{{__('PAID')}}</span>
              @elseif ($sale->payment->status === \App\Payment::STATUS_PENDING)
              <span class="p-2 text-xs font-normal rounded-full bg-blue-600 text-white">{{__('PENDING')}}</span>
              @elseif ($sale->payment->status === \App\Payment::STATUS_PARTIAL)
              <span class="p-2 text-xs font-normal rounded-full bg-yellow-400 text-white">{{__('PARTIAL')}}</span>
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              @if ($sale->packageOrder->package_status === \App\Packageorder::INACTIVE)
              <span class="p-2 text-xs font-normal rounded-full bg-red-600 text-white"> {{__('INACTIVE')}}</span>
              @elseif ($sale->packageOrder->package_status === \App\Packageorder::ACTIVE)
              <span class="p-2 text-xs font-normal rounded-full bg-green-600 text-white">{{__('ACTIVE')}}</span>
              @elseif ($sale->packageOrder->package_status === \App\Packageorder::NEAR_END)
              <span class="p-2 text-xs font-normal rounded-full bg-yellow-400 text-white">{{__('NEAR END')}}</span>
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              {{$sale->packageOrder->end_date}}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              @if (Auth::user()->role->name === 'Super Admin')    
              <div class="w-16 h-10 mx-auto flex items-center rounded-full p-1 duration-300 ease-in-out {{($sale->is_locked) ? 'bg-gray-300' : 'bg-green-400'}}">
                <div data-id="{{$sale->id}}" data-status="{{$sale->is_locked}}" class="sale-lock cursor-pointer bg-white w-8 h-8 rounded-full shadow-md transform duration-100 ease-in-out {{($sale->is_locked) ? 'translate-x-0' : 'translate-x-6'}}"></div>
              </div>
              @elseif(!$sale->is_locked)
              <i class="fas fa-lock-open"></i>
              @else
              <i class="fas fa-lock"></i>
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              <div class="w-full flex justify-around">
                <a href="{{route('admin.sales.packages.show', ['id' => $sale->id])}}">
                  <i class="fas fa-newspaper"></i>
                </a>
                @if (Auth::user()->role->name === 'Super Admin' || !$sale->is_locked)
                <a href="{{route('admin.sales.packages.edit', ['id' => $sale->id])}}">
                  <i class="fas fa-edit"></i>
                </a>                
                @endif
                <button >
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>
            </td>
          </tr> 
          @endforeach 
        </tbody>
      </table>
      </div>
    </div>
  </div>
<section>
@endsection

@section('script')
<script src="{{asset('assets/admin/js/app.js')}}"></script>
<script src="{{asset('assets/admin/js/sales-lock.js')}}"></script>
@endsection
