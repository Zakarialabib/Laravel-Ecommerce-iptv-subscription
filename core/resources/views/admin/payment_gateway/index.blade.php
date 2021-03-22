@extends('admin.layout')

@section('content')

<div class="p-0 -mb-5">
        <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
            <div class="flex flex-wrap ">
            <div class="sm:w-1/2 pr-4 pl-4">
                <h1 class="flex flex-wrap text-lg capitalize text-bold pt-3 pb-3 py-4 px-4 mb-2 m-0 text-gray-900">{{ __('Payment Gateway') }}</h1>
            </div><!-- /.col -->
            <div class="sm:w-1/2 pr-4 pl-4">
                <ol class="flex flex-wrap list-reset sm:float-right py-4 px-4 mb-2 m-0">
                <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                <li class="inline-block px-2 py-2 text-gray-700">{{ __('Payment Gateway') }}</li>
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
                    <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    <h3 class="px-4 mt-1 w-1/2">{{ __('Payment Gateway List') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="flex-auto p-6">
                    <table id="idtable" class="w-full max-w-full mb-4 bg-transparent table-bordered table-striped data_table">
                        <thead>
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $id=>$gateway)
                        <tr>

                            <td class="px-1 py-2 border-b border-gray-200 text-sm">{{ $gateway->name }}</td>
                            <td class="px-1 py-2 border-b border-gray-200 text-sm">
                            @if($gateway->type == 'automatic')
                                {{ $gateway->getAutoDataText() }}
                            @else
                                {{ mb_strlen(strip_tags($gateway->details),'utf-8') > 250 ? mb_substr(strip_tags($gateway->details),0,250,'utf-8').'...' : strip_tags($gateway->details) }}
                            @endif
                            </td>

                            <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                @if($gateway->status == 1)
                                    <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">{{ __('Active') }}</span>
                                @else
                                    <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-orange-400 text-black hover:bg-orange-500">{{ __('Dactive') }}</span>
                                @endif
                            </td>

                            <td width="18%">
                                <a href="{{ route('admin.payment.edit', $gateway->id) }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-indigo-600 text-white hover:bg-teal-600 py-1 px-2 leading-tight text-xs "><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>
                                @if($gateway->type == 'menual' && $gateway->keyword == null)
                                <a href="javascript:;" data-href="{{ route('admin.payment.delete', $gateway->id ) }}" class="inline-block align-middle text-center select-none px-2 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple delete" data-toggle="modal" data-target=".deleteModel"><i class="fas fa-trash"></i></a>
                                @endif
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
    <div class="modal deleteModel" tabindex="-1" role="dialog"
    aria-labelledby="deleteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">{{ __("Confirm Delete") }}</h5>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <p class="text-center">{{__("Are you sure")}}</p>
            <p class="text-center">{{ __("Do you want to proceed?") }}</p>
        </div>
        <div class="modal-footer">
            <a href="javascript:;" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700" data-dismiss="modal">{{ __("Cancel") }}</a>
            <a href="javascript:;" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-red-600 text-white hover:bg-red-700 btn-delete">{{ __("Delete") }}</a>
        </div>
    </div>
    </div>
    </div>
</section>
@endsection
