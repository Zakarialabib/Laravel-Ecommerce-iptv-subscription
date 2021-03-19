@extends('admin.layout')
@section('content')

@if(session()->has('message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
            data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!!
        session()->get('message') !!}</div>
@endif
<section>
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div
                    class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                    <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
                        <h3 class="mt-5 mb-1">{{ __('Admin List') }}</h3>
                        <div class="card-tools flex">
                            <a href="{{ route('admin.createProfile') }}"
                                class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-blue-600 text-white hover:bg-blue-600 py-1 px-2 leading-tight text-xs"><i
                                    class="dripicons-plus"></i>
                                {{ __('Add Admin') }}</a>
                                                   </div>
                    </div>
                    <div class="flex-auto p-6">
                        <table class="w-full max-w-full mb-4 bg-transparent table-striped table-bordered data_table">
                            <thead>
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('username') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($profils as $id=>$profil)
                                    <tr>
                                        <td>
                                            {{ $id }}
                                        </td>
                                        <td>{{ $profil->name }}</td>
                                        <td>{{ $profil->username }}</td>
                                        <td>{{ $profil->email }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">{{ __('action') }}
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                                    user="menu">
                                                    <li>
                                                        <a href="{{ route('admin.editProfile', $profil->id) }}"
                                                            class="btn btn-link"><i class="dripicons-document-edit"></i>
                                                            {{ __('edit') }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection