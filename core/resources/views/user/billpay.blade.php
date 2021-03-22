@extends('front.layout')

@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")
@section('content')

	<!--Main Breadcrumb Area Start -->
	<div class="main-breadcrumb-area" style="background-image : url('{{ asset('assets/front/img/' . $commonsetting->breadcrumb_image) }}');">
        <div class="overlay"></div>
		<div class="container mx-auto sm:px-4">
			<div class="flex flex-wrap ">
				<div class="lg:w-full pr-4 pl-4">
					<h1 class="pagetitle relative">
						{{ __('User Dashboard') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('User Dashboard') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

    <!-- User Dashboard Start -->
	<section class="user-dashboard-area">
		<div class="container mx-auto sm:px-4">
		  <div class="flex flex-wrap ">
			<div class="lg:w-1/4 pr-4 pl-4 ">
				@includeif('user.dashboard-sidenav')
			</div>
			<div class="lg:w-3/4 pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                    <h5 class="flex py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">{{ __('Bill Pay') }}</h5>
                    <div class="flex-auto p-6">
                        <div class="flex flex-wrap ">
                            <div class="lg:w-full pr-4 pl-4 mt-3 block w-full overflow-auto scrolling-touch">
                                <table class="w-full max-w-full mb-4 bg-transparent table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="px-1 py-2">{{ __('#') }}</th>
                                            <th>{{ __('Package Name') }}</th>
                                            <th>{{ __('Price') }}</th>
                                            <th>{{ __('Method') }}</th>
                                            <th>{{ __('Bill Paid') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
            
                                        @foreach ($bills as $id=>$bill)
                                        <tr>
                                            <td>{{ $id }}</td>
                                            <td>
                                                {{ $bill->package->name }}
                                            </td>
                                            <td>
                                                <strong>{{ $bill->currency_sign }}{{ $bill->package_cost }}</strong> / {{ $bill->package->time }}
                                            </td>
                                            <td>
                                                {{ $bill->method }}
                                            </td>
                                            <td>
                                                {{ $bill->fulldate }}
                                            </td>
                                            <td>
                                                <a href="#" data-id="{{ $bill->id }}" class="inline-flex justify-center py-1 px-2 border border-transparent shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 billpay_view" data-toggle="modal" data-target="#billpay_view"><i class="fas fa-eye mr-0"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
            
                                    </tbody>
                                </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="mt-3 text-center block">
                                     {{ $bills->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		  </div>
		</div>
	
	  </section>
    <!-- User Dashboard End -->
<!-- Billpay view modal -->
<div class="modal" id="billpay_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLaravel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Billpay Info :') }}</h5>
          <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="flex flex-wrap ">
                <div class="lg:w-full pr-4 pl-4">
                    <table class="w-full max-w-full mb-4 bg-transparent border table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">{{ __('Billpay Date') }}</th>
                                <td id="paydate"></td>
                            </tr>
                            
                            <tr>
                                <th scope="row">{{ __('Payment Method') }}</th>
                                <td id="method"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Package Name') }}</th>
                                <td id="packname"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Speed Limit') }}</th>
                                <td><span id="packspeed"></span> <span>{{ __('Mbps') }}</span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Package Price') }}</th>
                                <td><span id="currency_sign"></span> <span id="packprice"></span> / <span id="packtime"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Attendance Id') }}</th>
                                <td id="attendance_id"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Txn Id') }}</th>
                                <td id="txn_id"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
      </div>
    </div>
</div>
@endsection
