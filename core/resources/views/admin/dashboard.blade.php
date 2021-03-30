@extends('admin.layout')

@section('content')
   <!-- Content Header (Page header) -->

   <div class="p-0 -mb-5">
      <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
          <div class="w-full">
            <div class="flex flex-wrap text-lg capitalize text-bold py-4 px-4 mb-2 m-0 text-gray-900">
              <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">{{ __('Welcome back,') }} {{ $adminprofile->name }} !</h1></div>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
              <div class="px-2 lg:w1/4 md:w-1/4 sm:w-1/2">
                <div class="info-box bg-gradient-info">
                  <span class="info-box-icon"><i class="fas fa-user"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Users') }}</span>
                    <h4 class="info-box-number font-normal">{{ $user->count() }}</h4>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <div class="px-2 lg:w1/4 md:w-1/4 sm:w-1/2">
                <div class="info-box bg-gradient-success">
                  <span class="info-box-icon"><i class="fas fa-box-open"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Package') }}</span>
                    <h4 class="info-box-number font-normal">{{ $packages->count() }}</h4>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <div class="px-2 lg:w1/4 md:w-1/4 sm:w-1/2">
                <div class="info-box bg-gradient-warning">
                  <span class="info-box-icon"><i class="fas fa-briefcase"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Service') }}</span>
                    <h4 class="info-box-number font-normal">{{ $service->count() }}</h4>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <div class="px-2 lg:w1/4 md:w-1/4 sm:w-1/2">
                <div class="info-box bg-gradient-danger">
                  <span class="info-box-icon"><i class="fas fa-code-branch"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Branch') }}</span>
                    <h4 class="info-box-number font-normal">{{ $branch->count() }}</h4>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <div class="px-2 lg:w1/4 md:w-1/4 sm:w-1/2">
                <div class="info-box bg-gradient-primary">
                  <span class="info-box-icon"><i class="fab fa-blogger-b"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Blogs') }}</span>
                    <h4 class="info-box-number font-normal">{{ $blogs->count() }}</h4>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <div class="px-2 lg:w1/4 md:w-1/4 sm:w-1/2">
                <div class="info-box bg-gradient-danger">
                  <span class="info-box-icon"><i class="fas fa-star"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Review') }}</span>
                    <h4 class="info-box-number font-normal">{{ $testimonial->count() }}</h4>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <div class="px-2 lg:w1/4 md:w-1/4 sm:w-1/2">
                <div class="info-box bg-gradient-info">
                  <span class="info-box-icon"><i class="fas fa-users"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Team Member') }}</span>
                    <h4 class="info-box-number font-normal">{{ $team->count() }}</h4>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <div class="px-2 lg:w1/4 md:w-1/4 sm:w-1/2">
                <div class="info-box bg-gradient-success">
                  <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Product') }}</span>
                    <h4 class="info-box-number font-normal">{{ $product->count() }}</h4>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
        </div>
        <div class="flex flex-wrap ">
          <div class="md:w-1/2 sm:w-full px-2">
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary  card-outline">
              <div class="flex py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
                <h3 class="mt-1">{{ __('Latest 10 Package :') }}</h3>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="flex-auto p-6">
                <table class="w-full max-w-full mb-4 bg-transparent table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>{{ __('#') }}</th>
                          <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Name') }}</th>
                          <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Price') }}</th>
                          <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Discount Price') }}</th>
                          <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Speed') }}</th>
                          <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Status') }}</th>
                      </tr>
                  </thead>
                  <tbody>

                      @foreach ($latestpackages as $id=>$package)
                      <tr>
                          <td>
                              {{ $id }}
                          </td>
                          <td class="px-1 py-2 border-b border-gray-200 text-sm">
                              {{ $package->name }}
                          </td>
                          <td class="px-1 py-2 border-b border-gray-200 bg-white text-sm">
                              {{ $package->price }}{{  Helper::showCurrency() }}
                          </td>
                          <td class="px-1 py-2 border-b border-gray-200 bg-white text-sm">
                              @if($package->discount_price)
                              {{ $package->discount_price }}{{  Helper::showCurrency() }}
                              @else 
                              <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-indigo-600 text-white hover:bg-teal-600">{{ __('No Discount') }}</span>
                              @endif
                          </td>
                          <td class="px-1 py-2 border-b border-gray-200 bg-white text-sm">
                              {{ $package->speed }}{{ __(' / mbps')}}
                          </td>
                          <td class="px-1 py-2 border-b border-gray-200 bg-white text-sm">
                              @if($package->status == 1)
                                  <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">{{ __('Publish') }}</span>
                              @else
                                  <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-orange-400 text-black hover:bg-orange-500">{{ __('Unpublish') }}</span>
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
          <div class="md:w-1/2 sm:w-full px-2">
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary  card-outline">
              <div class="flex py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
                <h3 class="mt-1">{{ __('Latest 10 Blog Post :') }}</h3>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="flex-auto p-6">
                <table id="idtable" class="w-full max-w-full mb-4 bg-transparent table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>{{ __('#') }}</th>
                          <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Image') }}</th>
                          <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Title') }}</th>
                          <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Category') }}</th>
                          <th class="px-1 py-2 border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal" scope="col">{{ __('Status') }}</th>
                      </tr>
                  </thead>
                  <tbody>
                      
                      @foreach ($latestblogs as $id=>$blog)
                      <tr>
                          <td>{{ ++$id }}</td>
                          <td class="px-1 py-2 border-b border-gray-200 text-sm">
                              <img class="w-80" src="{{ asset('assets/front/img/'.$blog->main_image) }}" alt="">
                          </td>
                          <td class="px-1 py-2 border-b border-gray-200 text-sm">
                              {{ $blog->title }}
                          </td> 
                          <td class="px-1 py-2 border-b border-gray-200 text-sm">
                              {{ $blog->bcategory->name }}
                          </td> 
                          <td class="px-1 py-2 border-b border-gray-200 text-sm">
                                  @if($blog->status == 1)
                                      <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">{{ __('Publish') }}</span>
                                  @else
                                      <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-orange-400 text-black hover:bg-orange-500">{{ __('Unpublish') }}</span>
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
      <!-- Main row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
