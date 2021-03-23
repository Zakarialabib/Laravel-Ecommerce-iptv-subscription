@extends('admin.layout')

@section('content')

<div class="p-0 -mb-5">
        <div class="container mx-auto sm:px-4 max-w-full">
            <div class="flex flex-wrap ">
            <div class="sm:w-1/2 pr-4 pl-4">
                <h1 class="flex flex-wrap text-lg capitalize text-bold pt-3 pb-3 py-4 px-4 mb-2 m-0 text-gray-900">{{ __('Edit Payment Gateway') }} </h1>
            </div><!-- /.col -->
            <div class="sm:w-1/2 pr-4 pl-4">
                <ol class="flex flex-wrap list-reset sm:float-right py-4 px-4 mb-2 m-0">
                <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                <li class="inline-block px-2 py-2 text-gray-700">{{ __('Payment Setting') }}</li>
                <li class="inline-block px-2 py-2 text-gray-700">{{ __('Edit Payment Gateway') }}</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<section class="content">
    <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
            <div class="lg:w-full pr-4 pl-4">
                    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                            <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                                <h3 class="px-4 mt-1 w-1/2">{{ __('Edit Payment Gateway') }}</h3>
                                <div class="flex w-1/2 justify-end">
                                    <a href="{{ route('admin.payment.index') }}" class="inline-flex justify-center py-2 px-4 mr-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="flex-auto p-6">
                                <form class="form-horizontal" action="{{ route('admin.payment.update',$data->id) }}" method="POST">
                                    @csrf
                                    @if($data->type == 'automatic')

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="name" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Name') }}<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="name" placeholder="{{ __('Name') }}" value="{{$data->name}}">
                                            @if ($errors->has('name'))
                                                <p class="text-red-600"> {{ $errors->first('name') }} </p>
                                            @endif
                                        </div>

                                    </div>

                                    @if($data->information != null)
                                    @foreach($data->convertAutoData() as $pkey => $pdata)

                                    @if($pkey == 'sandbox_check')
                                    <div class="mb-4 flex flex-wrap  hidden">
                                        <label for="name" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __( $data->name.' '.ucwords(str_replace('_',' ',$pkey)) ) }}<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="checkbox" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="pkey[{{ __($pkey) }}]" value="1" {{ $pdata == 1 ? "checked":"" }}>
                                        </div>
                                    </div>
                                    @else

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="name" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __( $data->name.' '.ucwords(str_replace('_',' ',$pkey)) ) }}<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="pkey[{{ __($pkey) }}]" placeholder="{{ __( $data->name.' '.ucwords(str_replace('_',' ',$pkey)) ) }}" value="{{ $pdata }}" required="">
                                        </div>
                                    </div>

                                    @endif
                                    @endforeach

                                    @endif
                                    @else

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="title" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Title') }}<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="title" placeholder="{{ __('Title') }}" value="{{$data->title}}">
                                            @if ($errors->has('title'))
                                            <p class="text-red-600"> {{ $errors->first('title') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    @if($data->keyword == null)

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="details" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Description') }}<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <textarea id="area1" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="details">{{$data->details}}</textarea>
                                        </div>
                                    </div>


                                    @endif
                                    @endif
                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="status" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Status') }}<span class="text-red-600">*</span></label>
        
                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <select class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" name="status">
                                               <option value="0" {{ $data->status == '0' ? 'selected' : '' }}>{{ __('Dactive') }}</option>
                                               <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>{{ __('Active') }}</option>
                                              </select>
                                            @if ($errors->has('status'))
                                                <p class="text-red-600"> {{ $errors->first('status') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-4 flex flex-wrap ">
                                        <div class="sm:mx-1/5 sm:w-4/5 pr-4 pl-4">
                                            <button type="submit" class="inline-block align-middle select-none border whitespace-no-wrap py-2 px-4 bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">{{ __('Update') }}</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                            <!-- /.card-body -->
                        </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
@endsection
