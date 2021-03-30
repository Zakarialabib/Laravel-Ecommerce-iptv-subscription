@extends('admin.layout')

@section('content')
<div class="content-header">
  <div class="container mx-auto sm:px-4 max-w-full">
      <div class="flex flex-wrap ">
      <div class="sm:w-1/2 pr-4 pl-4">
          <h1 class="flex flex-wrap pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 m-0 text-gray-900">
            {{ __('Create sale') }}
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
  <div class="container mx-auto sm:px-4 max-w-full">
    <div class="flex flex-wrap ">
      <form class="w-full" action="{{route('admin.sales.packages.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div id="sales">
          <sales-component category="packages" :sale_prop="{{$sale}}" :user="{{Auth::user()}}" lang="{{(request()->session()->has('lang')) ? request()->session()->get('lang') : $lang->code}}"></sales-component>
        </div>
      </form>
    </div>
  </div>
<section>
@endsection

@section('script')
<script src="{{asset('assets/admin/js/app.js')}}"></script>
<script src="{{asset('assets/admin/js/sales.js')}}"></script>
@endsection
