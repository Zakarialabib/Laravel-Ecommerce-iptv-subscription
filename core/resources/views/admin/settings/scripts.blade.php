@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="sm:w-1/2 pr-4 pl-4">
                <h1 class="flex flex-wrap pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 m-0 text-gray-900">{{ __('Scripts') }}</h1>
            </div><!-- /.col -->
            <div class="sm:w-1/2 pr-4 pl-4">
                <ol class="flex flex-wrap list-reset pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 rounded sm:float-right">
                    <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                    <li class="inline-block px-2 py-2 text-gray-700">{{ __('Scripts') }}</li>
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
                        <h3 class="w-1/2">{{ __('Update Scripts') }} </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="flex-auto p-6">
                        <form class="form-horizontal" action="{{ route('admin.commonsetting.updateScripts') }}" method="POST">
                            @csrf

                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">Tawk.to Status <span
                                            class="text-red-600">*</span></label>

                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="checkbox" {{ $commonsetting->is_tawk_to == '1' ? 'checked' : '' }} data-size="large" name="is_tawk_to" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Active" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Deactive">
                                    @if ($errors->has('is_tawk_to'))
                                        <p class="text-red-600"> {{ $errors->first('is_tawk_to') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">Tawk.to Widget Code<span
                                    class="text-red-600">*</span></label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <textarea type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="tawk_to" rows="5">{!! $commonsetting->tawk_to !!}</textarea>
                                    @if ($errors->has('tawk_to'))
                                        <p class="text-red-600"> {{ $errors->first('tawk_to') }} </p>
                                    @endif
                                </div>
                            </div>

                            {{-- <div class="mb-4 flex flex-wrap  mt-5">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">Messenger Status <span
                                            class="text-red-600">*</span></label>

                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="checkbox" {{ $commonsetting->is_massenger == '1' ? 'checked' : '' }} data-size="large" name="is_massenger" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Active" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Deactive">
                                    @if ($errors->has('is_massenger'))
                                        <p class="text-red-600"> {{ $errors->first('is_massenger') }} </p>
                                    @endif
                                </div>
                            </div> --}}
                            {{-- <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">FB Page ID<span
                                    class="text-red-600">*</span></label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="is_massenger_id" value="{{$commonsetting->is_massenger_id}}" placeholder="Facebook Page ID">
                                    @if ($errors->has('is_massenger_id'))
                                        <p class="text-red-600"> {{ $errors->first('is_massenger_id') }} </p>
                                    @endif
                                </div>
                            </div> --}}

                            <div class="mb-4 flex flex-wrap  mt-5">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Disqus Status') }}<span
                                        class="text-red-600">*</span></label>

                                <div class="sm:w-4/5 pr-4 pl-4">
                                        <input type="checkbox" {{ $commonsetting->is_disqus == '1' ? 'checked' : '' }} data-size="large" name="is_disqus" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Active" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Deactive">
                                        @if ($errors->has('is_disqus'))
                                        <p class="text-red-600"> {{ $errors->first('is_disqus') }} </p>
                                        @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">{{ __('Disqus Shortname') }}<span
                                        class="text-red-600">*</span></label>

                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="disqus" value="{{$commonsetting->disqus}}" placeholder="{{ __('Disqus Shortname') }}">
                                    @if ($errors->has('disqus'))
                                    <p class="text-red-600"> {{ $errors->first('disqus') }} </p>
                                    @endif
                                </div>
                            </div>

                            {{-- <div class="mb-4 flex flex-wrap   mt-5">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">Google Analytics Status<span
                                            class="text-red-600">*</span></label>

                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="checkbox" {{ $commonsetting->is_analytics == '1' ? 'checked' : '' }} data-size="large" name="is_analytics" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Active" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Deactive">
                                    @if ($errors->has('is_analytics'))
                                        <p class="text-red-600"> {{ $errors->first('is_analytics') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 flex flex-wrap ">
                                <label class="sm:w-1/5 pr-4 pl-4 control-label">Google Analytics ID<span class="text-red-600">*</span></label>
                                <div class="sm:w-4/5 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="google_analytics_id" value="{{ $commonsetting->google_analytics }}" placeholder="Google Analytics ID">
                                    @if ($errors->has('google_analytics_id'))
                                        <p class="text-red-600"> {{ $errors->first('google_analytics_id') }} </p>
                                    @endif
                                </div>
                            </div> --}}

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
