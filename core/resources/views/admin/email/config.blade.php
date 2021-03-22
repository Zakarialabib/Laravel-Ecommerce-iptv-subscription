@extends('admin.layout')

@section('content')

<div class="p-0 -mb-5">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
        <div class="sm:w-1/2 pr-4 pl-4">
            <h1 class="flex flex-wrap text-lg capitalize text-bold pt-3 pb-3 py-4 px-4 mb-2 m-0 text-gray-900">{{ __('Email Configuration') }}</h1>
        </div><!-- /.col -->
        <div class="sm:w-1/2 pr-4 pl-4">
            <ol class="flex flex-wrap list-reset sm:float-right py-4 px-4 mb-2 m-0">
            <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="inline-block px-2 py-2 text-gray-700">{{ __('Email Configuration') }}</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="lg:w-full pr-4 pl-4">
                    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                            <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                                <h3 class="px-4 mt-1 w-1/2">{{ __('Email Configuration') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="flex-auto p-6">
                                <form class="form-horizontal" action="{{ route('admin.mail.config.update') }}" method="POST">
                                    @csrf

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="is_smtp" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('SMTP') }}<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <select name="is_smtp" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                                <option value="1" {{ $emailsetting->is_smtp == 1 ? 'selected' : '' }}>{{ __('Activated') }}</option>
                                                <option value="0" {{ $emailsetting->is_smtp == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}</option>
                                            </select>
                                            @if ($errors->has('is_smtp'))
                                                <p class="text-red-600"> {{ $errors->first('is_smtp') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="header_email" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Mail Engine') }}<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <select name="header_email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                                <option value="smtp" {{ $emailsetting->header_email == 'smtp' ? 'selected' : '' }}>{{ __('SMTP') }}</option>
                                            </select>
                                            @if ($errors->has('header_email'))
                                                <p class="text-red-600"> {{ $errors->first('header_email') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="smtp_host" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('SMTP HOST') }}<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="smtp_host" placeholder="{{ __('SMTP HOST') }}" value="{{ $emailsetting->smtp_host }}">
                                            @if ($errors->has('smtp_host'))
                                                <p class="text-red-600"> {{ $errors->first('smtp_host') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="smtp_port" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('SMTP PORT') }}<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="smtp_port" placeholder="{{ __('SMTP PORT') }}" value="{{ $emailsetting->smtp_port }}">
                                            @if ($errors->has('smtp_port'))
                                                <p class="text-red-600"> {{ $errors->first('smtp_port') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="email_encryption" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Encryption') }}</label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="email_encryption" placeholder="{{ __('Encryption') }}" value="{{ $emailsetting->email_encryption }}">
                                            @if ($errors->has('email_encryption'))
                                                <p class="text-red-600"> {{ $errors->first('email_encryption') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="smtp_user" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('SMTP Username') }}<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="smtp_user" placeholder="{{ __('SMTP Username') }}" value="{{ $emailsetting->smtp_user }}">
                                            @if ($errors->has('smtp_user'))
                                                <p class="text-red-600"> {{ $errors->first('smtp_user') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="smtp_pass" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('SMTP Password') }}<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="smtp_pass" placeholder="{{ __('SMTP Password') }}" value="{{ $emailsetting->smtp_pass }}">
                                            @if ($errors->has('smtp_pass'))
                                                <p class="text-red-600"> {{ $errors->first('smtp_pass') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="from_email" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('From Email') }}<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="from_email" placeholder="{{ __('From Email') }}" value="{{ $emailsetting->from_email }}">
                                            @if ($errors->has('from_email'))
                                                <p class="text-red-600"> {{ $errors->first('from_email') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 flex flex-wrap ">
                                        <label for="from_name" class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('From Name') }}<span class="text-red-600">*</span></label>

                                        <div class="sm:w-4/5 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="from_name" placeholder="{{ __('From Name') }}" value="{{ $emailsetting->from_name }}">
                                            @if ($errors->has('from_name'))
                                                <p class="text-red-600"> {{ $errors->first('from_name') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 flex flex-wrap ">
                                        <div class="sm:mx-1/5 sm:w-4/5 pr-4 pl-4">
                                            <button type="submit" class="inline-block align-middle select-none border whitespace-no-wrap py-2 px-4 bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">{{ __('Save') }}</button>
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
