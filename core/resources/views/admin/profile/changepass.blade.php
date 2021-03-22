@extends('admin.layout')

@section('content')

<div class="p-0 -mb-5">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="sm:w-1/2 pr-4 pl-4">
                <h1 class="flex flex-wrap text-lg capitalize text-bold pt-3 pb-3 py-4 px-4 mb-2 m-0 text-gray-900">{{ __('Admin Profile') }}</h1>
            </div><!-- /.col -->
            <div class="sm:w-1/2 pr-4 pl-4">
                <ol class="flex flex-wrap list-reset sm:float-right py-4 px-4 mb-2 m-0">
                    <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                    <li class="inline-block px-2 py-2 text-gray-700">{{ __('Admin Profile') }}</li>
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
                        <h3 class="px-4 mt-1 w-1/2">{{ __('Update Admin Password') }} </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="flex-auto p-6">
                        <form class="form-horizontal" action="{{ route('admin.updatePassword') }}" method="POST">
                            @csrf
                
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Current Password') }} <span
                                    class="text-red-600">*</span>
                                </label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="old_password" value="" placeholder="{{ __('Your Current Password') }}">
                                    @if ($errors->has('old_password'))
                                        <p class="text-red-600"> {{ $errors->first('old_password') }} </p>
                                    @else
                                    @if ($errors->first('oldPassMatch'))
                                        <span class="text-red-600">
                                            {{"Old password doesn't match with the existing password!"}}
                                        </span>
                                    @endif
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label"> {{ __('New Password') }}<span
                                    class="text-red-600">*</span>
                                </label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="password" value="" placeholder="{{ __('New Password') }}">
                                    @if ($errors->has('password'))
                                    <p class="text-red-600"> {{ $errors->first('password') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Confirm Password') }}<span
                                    class="text-red-600">*</span>
                                </label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="password_confirmation" value="" placeholder="{{ __('Confirm Password') }}">
                                </div>
                            </div>

                            <div class="mb-4 flex flex-wrap ">
                                    <div class="sm:mx-1/5 sm:w-4/5 pr-4 pl-4">
                                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ __('Update') }}</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
    </div>


</section>

@endsection

