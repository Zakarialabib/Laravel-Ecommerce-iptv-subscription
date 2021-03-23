<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ $setting->website_title }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/admin/css/tailwind.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">
</head>

<body class="hold-transition login-page">

<div class="login-box">
    <div class="login-logo">
    <a class="inline-block pt-1 pb-1 mr-4 text-lg whitespace-no-wrap" href="{{ route('front.index') }}">
    <img src="{{ asset('assets/front/img/'.$commonsetting->header_logo) }}" alt="">
    </a>
    </div>
    <!-- /.login-logo -->
    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
      <div class="flex-auto p-6 login-card-body text-center">
        @if(Session::has('alert'))
        <p class="m-1 text-red-600">{{ Session::get('alert') }}</p>
        @endif
        
        <p class="login-box-msg">{{ __('Login To Go Your Dashboard') }}</p>
  
        <form action="{{ route('admin.auth') }}" method="POST">
          @csrf
          <div class="relative flex items-stretch w-full mb-3">
            <input type="text" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" name="username" value="{{ old('username') }}" placeholder="{{ __('Username') }}">
          </div>
          @if($errors->has('username'))
          <p class="m-1 text-red-600">{{ $errors->first('username') }}</p>
          @endif
          <div class="relative flex items-stretch w-full mb-3">
            <input type="password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" name="password" value="{{ old('password') }}" placeholder="{{ __('Password') }}">
          </div>
          @if($errors->has('password'))
          <p class="m-1 text-red-600">{{ $errors->first('password') }}</p>
          @endif
          <div class="flex flex-wrap ">
            <!-- /.col -->
            <div class="w-full">
              <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin">{{ __('LOGIN') }}</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

    
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
    <!-- jQuery 3 -->
    <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('assets/admin/js/adminlte.min.js') }}"></script>

    </body>
</html>
