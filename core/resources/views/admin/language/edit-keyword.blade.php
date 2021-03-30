
@extends('admin.layout')

@section('content')

    <div class="p-0 -mb-5">
        <div class="container mx-auto sm:px-4 max-w-full">
            <div class="flex flex-wrap ">
            <div class="sm:w-1/2 pr-4 pl-4">
                <h1 class="flex flex-wrap text-lg capitalize text-bold pt-3 pb-3 py-4 px-4 mb-2 m-0 text-gray-900">{{ __('Languages') }}</h1>
            </div><!-- /.col -->
            <div class="sm:w-1/2 pr-4 pl-4">
                <ol class="flex flex-wrap list-reset sm:float-right py-4 px-4 mb-2 m-0">
                <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                <li class="inline-block px-2 py-2 text-gray-700">{{ __('Languages') }}</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container mx-auto sm:px-4 max-w-full">
            <div class="flex flex-wrap ">
                <div class="md:w-full pr-4 pl-4">
                    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                        <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                            <h3 class="px-4 mt-1 w-1/2">{{ $page_title }}</h3>
                            <div class="flex w-1/2 justify-end">
                                <a href="{{ route('admin.language.index') }}" class="inline-block align-middle select-none border whitespace-no-wrap py-1 px-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">
                                    <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="flex-auto p-6 block w-full overflow-auto scrolling-touch" id="app">
                            <form method="post" action="{{route('admin.language.updateKeyword', $la->id)}}" id="langForm">
                                {{ csrf_field() }}
              
                                <div class="flex flex-wrap "> 
                                    <div class="md:w-1/3 pr-4 pl-4 mt-2" v-for="(value, key) in datas" :key="key">
                                        <div class="mb-4">
                                            <label for="title" class="control-label"  style="white-space: normal;">@{{ key }}</label>
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" :value="value" :name="'keys[' + key + ']'">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 flex flex-wrap ">
                                    <div class="sm:w-full pr-4 pl-4 mt-3">
                                        <button type="submit" class="px-2 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg">{{ __('Update') }}</button>
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


@section('script')
    <script src="{{asset('assets/admin/plugins/vue/vue.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/vue/axios.js')}}"></script>
    <script>
        window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
    </script>

    <script>
        window.app = new Vue({
            el: '#app',
            data: {
                datas: {!! $json !!},
            }
        })
    </script>

@endsection
