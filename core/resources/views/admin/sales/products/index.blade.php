@extends('admin.layout')

@section('content')
<div class="content-header">
  <div class="container mx-auto sm:px-4 max-w-full">
      <div class="flex flex-wrap ">
      <div class="sm:w-1/2 pr-4 pl-4">
          <h1 class="flex flex-wrap pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 m-0 text-gray-900">
            {{ __('Sales List') }}
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
      <div class="w-full flex justify-end mb-4">
        <a href="{{route('admin.sales.products.create')}}" class="rounded-md focus:outline-none bg-blue-500 hover:bg-blue-800 text-white text-md py-2 px-3">{{__('Add sale')}}</a>
      </div>
      <div class="w-full overflow-hidden mb-4 border border-gray-200 sm:rounded-lg">
        <table class="w-full divide-y divide-gray-200">
          <thead class="bg-gray-300">
          <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">N</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Reference</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Agent</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach ($sales as $key => $sale)
          <tr class="border-b border-gray-200 hover:bg-gray-100">
            <td class="px-6 py-4 whitespace-nowrap text-center">
              <span>{{ $key + 1 }}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              {{ $sale->reference }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              {{ $sale->user->name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              {{ $sale->admin->name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              {{ $sale->total }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              @if ($sale->payment->status === \App\Payment::STATUS_DUE)
              {{__('DUE')}}
              @elseif ($sale->payment->status === \App\Payment::STATUS_PAID)
              {{__('PAID')}}
              @elseif ($sale->payment->status === \App\Payment::STATUS_PENDING)
              {{__('PENDING')}}
              @elseif ($sale->payment->status === \App\Payment::STATUS_PARTIAL)
              {{__('PARTIAL')}}
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              <div class="w-full flex justify-around">
                <a href="{{route('admin.sales.products.show', ['id' => $sale->id])}}">
                  <i class="fas fa-newspaper"></i>
                </a>
                <a href="{{route('admin.sales.products.edit', ['id' => $sale->id])}}">
                  <i class="fas fa-edit"></i>
                </a>
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
